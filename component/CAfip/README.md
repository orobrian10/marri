<h1>CAfip2</h1>
<br>
<p>CAfip2 son dos clases para Yii Framework 2 para ser utilizadas en proyectos que requieran conectarse a los Web Services de AFIP.</p>

<br>
<h2>Instalación</h2>

<ol>
<li>Crear los directorios 
  <pre>[raiz del proyecto]/components/CAfip</pre>
  <pre>[raiz del proyecto]/components/CAfip/Wsaa</pre>
</li>
<li>Descargar los archivos del repositorio dentro del directorio CAfip creado.</li>
<li>Colocar dentro del directorio Wsaa los certificados (archivo .crt y .key) con nombre de archivo igual al id de usuario en el sistema (Yii::$app->user->identity->id).</li>
</ol>

<br>
<h2>Uso</h2>

<b><i>Solicitar un Token de acceso:</b></i>
<pre>
// $wsn es el nombre del WS según AFIP. Ej: wsfe (Web Service de Factura Electrónica)
if (Yii::$app->CAfipWsaa->checkFiles()) {
  Yii::$app->CAfipWsaa->createToken($wsn);
}

$wsaaResponse = Yii::$app->CAfipWsaa->getResponse();
</pre>

<b><i>Informar documento al WS de Factura Electrónica:</b></i>
<pre>
$this->customer = Yii::$app->user->identity->id;
$this->ptovta = $post['AfipWsfe']['ptovta'];
$this->imptotal = $post['AfipWsfe']['imptotal'];
$this->impneto = $post['AfipWsfe']['impneto'];
$this->impiva = $post['AfipWsfe']['impiva'];
$this->indiva = $post['AfipWsfe']['indiva'];
$this->tipodoc = $post['AfipWsfe']['tipodoc'];
$this->doccomp = $post['AfipWsfe']['doccomp'];
$this->cbtefech = \DateTime::createFromFormat('d/m/Y', $this->cbtefech)->format('Ymd');

if (Yii::$app->CAfipWsfe->callCAESolicitar($this)) {
  $response = Yii::$app->CAfipWsfe->getResponse();
} else {
  return false;
}

if (isset($response->FECAESolicitarResult->Errors)) {
  $errors = $response->FECAESolicitarResult->Errors;
} else {
  $errors = $response->FECAESolicitarResult->FeDetResp->FECAEDetResponse->Observaciones;
}

if (isset($errors)) {
  foreach ($errors as $error) {
//  Método para manipular los códigos de error que entrega AFIP. Ver el manual de desarrollador oficial
    $this->erroresAfip($error); 
  }
} else
  if ($response->FECAESolicitarResult->FeCabResp->Resultado == 'A') { // Aprobado
    $this->cbtenro = $response->FECAESolicitarResult->FeDetResp->FECAEDetResponse->CbteDesde;
    $this->cae = $response->FECAESolicitarResult->FeDetResp->FECAEDetResponse->CAE;
    $this->caevto = \DateTime::createFromFormat('Ymd', $response->FECAESolicitarResult->FeDetResp->FECAEDetResponse->CAEFchVto)->format('Y-m-d');
    $this->cbtefech = \DateTime::createFromFormat('Ymd', $this->cbtefech)->format('Y-m-d');
    return true;
}
</pre>
