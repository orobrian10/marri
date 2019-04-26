<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CAfipWsfe
 *   Send a billing document to the AFIP "Facturacion Electronica" Web Service
 * 
 * 
 * @author Sebastian Soto sebastian.soto@freeit.com.ar
 */

namespace app\components\CAfip;

use Yii;
use yii\base\Component;
use app\models\AfipWsaa;
use app\models\Customers;

class CAfipWsfe extends Component {

    private $response = array();
//  Direcciones de Homologación    
    private $wsdl = "https://wswhomo.afip.gov.ar/wsfev1/service.asmx?WSDL";
    private $url = "https://wswhomo.afip.gov.ar/wsfev1/service.asmx";
//  Direcciones de Producción
//    private $wsdl = "https://servicios1.afip.gov.ar/wsfev1/service.asmx?WSDL";
//    private $url  = "https://servicios1.afip.gov.ar/wsfev1/service.asmx";

    private $soapClient;
    private $request = array();
    private $wsfe; // Instancia del modelo AfipWsfe
    private $billNumber;
    private $customer;
    private $token;

    public function callCAESolicitar($wsfe) {

        $this->wsfe = $wsfe;

        // Autenticacion (WSAA)
        $this->token = AfipWsaa::getLast('wsfe');

        if (!$this->token) {
            return false;
        }

        // Datos del cliente
        $this->customer = Customers::findOne(Yii::$app->user->identity->id);

        if (!$this->customer) {
            return false;
        }

        $this->soapClient = new \SoapClient($this->wsdl, array(
            //'proxy_host'     => PROXY_HOST,
            //'proxy_port'     => PROXY_PORT,
            'soap_version' => SOAP_1_2,
            'location' => $this->url,
            'trace' => 1,
            'exceptions' => 0,
            'encoding' => 'utf-8'
        ));

        $this->createFECAESolicitarRequest();

        //echo "<pre>"; print_r($this->request); echo "</pre>"; die;

        $this->response = $this->soapClient->FECAESolicitar($this->request);

        //echo "<pre>"; print_r($this->response); echo "</pre>"; die;
        // Si llegó hasta acá quiere decir que la comunicación fue existosa
        return true;
    }

    public function getResponse() {
        return $this->response;
    }

    public function getOperations() {
        return $this->soapClient->__getFunctions();
    }

    public function callDummy() {
        return $this->soapClient->FEDummy();
    }

    private function callFECompUltimoAutorizado() {
        $request = array('Auth' => array(
                'Token' => $this->token->token,
                'Sign' => $this->token->sign,
                'Cuit' => (float) $this->customer->cuit,
            ),
            'PtoVta' => $this->customer->ptovta,
            'CbteTipo' => $this->wsfe->cbtetipo);

        $response = $this->soapClient->FECompUltimoAutorizado($request);

        return $response->FECompUltimoAutorizadoResult->CbteNro;
    }

    private function createFECAESolicitarRequest() {
        // Siguiente número de comprobante a autorizar
        $cbte = $this->callFECompUltimoAutorizado() + 1;

        $this->request = array('Auth' => array('Token' => $this->token->token,
                        'Sign' => $this->token->sign,
                        'Cuit' => (float) $this->customer->cuit),
                    'FeCAEReq' => array(
                        'FeCabReq' => array('CantReg' => 1,
                            'PtoVta' => $this->customer->ptovta,
                            'CbteTipo' => $this->wsfe->cbtetipo),
                        'FeDetReq' => array('FECAEDetRequest' => array('Concepto' => 1,
                                'DocTipo' => (int) $this->wsfe->tipodoc, // Tipo documento destinatario
                                'DocNro' => (float) $this->wsfe->doccomp, // Documento destinatario
                                'CbteDesde' => $cbte,
                                'CbteHasta' => $cbte,
                                'CbteFch' => $this->wsfe->cbtefech,
                                'ImpTotal' => $this->wsfe->imptotal,
                                'ImpNeto' => $this->wsfe->impneto,
                                'ImpTotConc' => 0,
                                'ImpOpEx' => 0,
                                'ImpTrib' => 0,
                                'ImpIVA' => $this->wsfe->impiva,
                                'MonId' => 'PES',
                                'MonCotiz' => 1,
                                'Iva' => array('AlicIva' => array('Id' => $this->wsfe->indiva,
                                        'BaseImp' => $this->wsfe->impneto,
                                        'Importe' => $this->wsfe->impiva))))));

        if ($this->wsfe->cbtetipo == 11)
            unset($this->request['FeCAEReq']['FeDetReq']['FECAEDetRequest']['Iva']);
    }

}
