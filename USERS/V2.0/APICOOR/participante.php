<?php 
include_once ('Config.php');
include_once ('getData.php');
$curl = new getDatos();

$sql = "SELECT e.url FROM endpoints e WHERE e.nombre = 'Participante'"; 
$result = $mysqli->query($sql);
$row = mysqli_fetch_assoc($result);
$url = $row['url'].'&id=110';
echo $url;

$result = $curl->getData($url);
$arr =json_decode($result,1);

echo '<pre>';
    print_r($arr);

for ($i = 0; $i < $arr['count']; $i++){
    
    // Datos del Participante

    $id = $arr['results'][$i]['id'];
    $name =  utf8_decode($arr['results'][$i]['name']);
    $rut = $arr['results'][$i]['rut']; 
    $dv = $arr['results'][$i]['verification_code'];
    $razon = utf8_decode($arr['results'][$i]['business_name']);
    $giro =  utf8_decode($arr['results'][$i]['commercial_business']);
    $email = trim($arr['results'][$i]['dte_reception_email']);       
    $cuenta = $arr['results'][$i]['bank_account'];
    $banco = $arr['results'][$i]['bank'];
    $direccion = utf8_decode($arr['results'][$i]['commercial_address']);
    $direccionPostal =utf8_decode($arr['results'][$i]['postal_address']);
    $encargado =utf8_decode($arr['results'][$i]['manager']);
    
    $direccion = str_replace("'", "", $direccion);
    $direccionPostal = str_replace("'", "", $direccionPostal);
    
    //Datos de Pagos
    
    $contactoPago = $arr['results'][$i]['payments_contact'];
    @$cpNombre = utf8_decode($contactoPago['first_name']);
    @$cpApellido= utf8_decode($contactoPago['last_name']);
    @$cpDireccion = utf8_decode($contactoPago['address']);
    @$cpTelefono = $contactoPago['phones'][0];
    @$cpMail = $contactoPago['email'];
    $cpTc = CP;
    
    //Datos de Facturacion

    $contactoFacturacion = $arr['results'][$i]['bills_contact'];
    @$cbNombre = utf8_decode($contactoFacturacion['first_name']);
    @$cbApellido= utf8_decode($contactoFacturacion['last_name']);
    @$cbDireccion = utf8_decode($contactoFacturacion['address']);
    @$cbTelefono = $contactoFacturacion['phones'][0];
    @$cbMail = $contactoFacturacion['email'];
    $cbTc = CB;

    // $participanteInsert ="INSERT INTO participante VALUES ('$id','$name','$rut','$dv','$razon','$giro','$email','$cuenta','$banco','$direccion','$direccionPostal','$encargado')";
    // $result = $mysqli->query($participanteInsert);

    // if($result){
    //     $cpInsert = "INSERT INTO contacto VALUES (NULL,'$id','$cpTc','$cpNombre','$cpApellido','$cpDireccion','$cpTelefono','$cpMail')";
    //     $mysqli->query($cpInsert);
        
    //     $cbInsert = "INSERT INTO contacto VALUES (NULL,'$id','$cbTc','$cbNombre','$cbApellido','$cbDireccion','$cbTelefono','$cbMail')";
    //     $mysqli->query($cbInsert);
    // }else{

    //     echo $id.'- '.$mysqli->error.'<BR>';
    // }

}

?>