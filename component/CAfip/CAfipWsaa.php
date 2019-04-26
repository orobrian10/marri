<?php

# Author: Gerardo Fisanotti - DvSHyS/DiOPIN/AFIP - 13-apr-07
# Function: Get an authorization ticket (TA) from AFIP WSAA
# Input:
#        WSDL, CERT, PRIVATEKEY, PASSPHRASE, SERVICE, URL
#        Check below for its definitions
# Output:
#        TA.xml: the authorization ticket as granted by WSAA.
#==============================================================================
# Version 2.0
# Author: Sebastián Soto - FreeIT
# Changes: Object programming; Yii2 updating
#==============================================================================

namespace app\components\CAfip;

use Yii;
use yii\base\Component;

class CAfipWsaa extends Component {

    public $wsn;
    private $ta;
    private $path;
    private $cert;
    private $privateKey;
    private $passPhrase = "xxxxx";
//    private $proxy_host = "127.0.0.1";
//    private $proxy_port = "3128";
//    
//  Dirección de Homologación    
    private $url = "https://wsaahomo.afip.gov.ar/ws/services/LoginCms";
    private $wsdl = "https://wsaahomo.afip.gov.ar/ws/services/LoginCms?wsdl";

//  Dirección de Producción    
//  private $url  = "https://wsaa.afip.gov.ar/ws/services/LoginCms";
//  private $wsdl = "https://wsaa.afip.gov.ar/ws/services/LoginCms?wsdl";

    private function createTRA($SERVICE) {
        $traFile = $this->path . '/TRA.xml';

        $TRA = new \SimpleXMLElement(
                '<?xml version="1.0" encoding="UTF-8"?>' .
                '<loginTicketRequest version="1.0">' .
                '</loginTicketRequest>');

        $TRA->addChild('header');
        $TRA->header->addChild('uniqueId', date('U'));
        $TRA->header->addChild('generationTime', date('c', date('U') - 60));
        $TRA->header->addChild('expirationTime', date('c', date('U') + 60));
        $TRA->addChild('service', $SERVICE);
        $TRA->asXML($traFile);
    }

#==============================================================================
# This functions makes the PKCS#7 signature using TRA as input file, CERT and
# PRIVATEKEY to sign. Generates an intermediate file and finally trims the 
# MIME heading leaving the final CMS required by WSAA.

    private function signTRA() {
        $traXml = $this->path . '/TRA.xml';
        $traTmp = $this->path . '/TRA.tmp';

        $STATUS = openssl_pkcs7_sign($traXml, $traTmp, "file://" . $this->cert, array("file://" . $this->privateKey, $this->passPhrase), array(), !PKCS7_DETACHED
        );
        if (!$STATUS) {
            exit("ERROR generating PKCS#7 signature\n");
        }
        $inf = fopen($traTmp, "r");
        $i = 0;
        $CMS = "";
        while (!feof($inf)) {
            $buffer = fgets($inf);
            if ($i++ >= 4) {
                $CMS.=$buffer;
            }
        }
        fclose($inf);
        unlink($traTmp);
        return $CMS;
    }

#==============================================================================

    private function callWSAA($CMS) {
        $client = new \SoapClient($this->wsdl, array(
            //'proxy_host'     => PROXY_HOST,
            //'proxy_port'     => PROXY_PORT,
            'soap_version' => SOAP_1_2,
            'location' => $this->url,
            'trace' => 1,
            'exceptions' => 0
        ));
        $results = $client->loginCms(array('in0' => $CMS));

        $request = $this->path . Yii::$app->user->identity->id . "_request-loginCms.xml";
        $response = $this->path . Yii::$app->user->identity->id . "_response-loginCms.xml";

        file_put_contents($request, $client->__getLastRequest());
        file_put_contents($response, $client->__getLastResponse());
        if (is_soap_fault($results)) {
            exit("SOAP Fault: " . $results->faultcode . "\n" . $results->faultstring . "\n");
        }
        return $results->loginCmsReturn;
    }

#==============================================================================

    public function createToken($wsn) {
// Inicializa    
        ini_set("soap.wsdl_cache_enabled", "0");
        $this->wsn = $wsn;

//  Creo el XML
        $this->createTRA($this->wsn);

//  Firmo la comunicación con los certificados
        $CMS = $this->signTRA();

//  Invoco al Web Service
        $this->ta = $this->callWSAA($CMS);

        $taFile = $this->path . '/TA.xml';

        if (!file_put_contents($taFile, $this->ta)) {
            exit();
        }
    }

    public function getResponse() {
        return new \SimpleXMLElement($this->ta);
    }

    public function checkFiles() {
// Verifica existencia de los archivos
        $this->path = Yii::getAlias("@app") . "/components/CAfip/Wsaa/";
        $this->cert = $this->path . Yii::$app->user->identity->id . ".crt";
        $this->privateKey = $this->path . Yii::$app->user->identity->id . ".key";

        $return = true;

        if (!file_exists($this->cert)) {
            Yii::$app->session->addFlash("cafip", "Error: No se ha encontrado el certificado");
            $return = false;
        }

        if (!file_exists($this->privateKey)) {
            Yii::$app->session->addFlash("cafip", "No se ha encontrado la clave privada");
            $return = false;
        }

        return $return;
    }

}

?>
