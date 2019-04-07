<?php 
include_once ('Config.php');
mysqli_set_charset($mysqli,"utf8");

$id = $_POST['id'];
$sqlQuery = "SELECT * FROM detalle_balance WHERE id = $id";
$result = $mysqli->query($sqlQuery);

$row = mysqli_fetch_assoc($result); 

$iva = round($row['monto'] * 0.19);
$total = round($row['monto'] * 1.19);

$fac = proxima_factura();
$tipo = 33;
$date = date('Y-m-d');
$fac = $fac + 110;
$xml = '<?xml version="1.0" encoding="UTF-8"?>
<DTE xmlns="http://www.sii.cl/SiiDte" version="1.0">
<Documento ID="F'.$fac.'T'.$tipo.'">
        <Encabezado>
            <IdDoc>
                <TipoDTE>'.$tipo.'</TipoDTE>
                <Folio>'.$fac.'</Folio>
                <FchEmis>'.$date.'</FchEmis>
                <FchVenc>'.$date.'</FchVenc>
            </IdDoc>
            <Emisor>
                <RUTEmisor>'.$row['RUT_Acreedor'].'</RUTEmisor>
                <RznSoc>'.$row['Razon_Acreedor'].'</RznSoc>
                <GiroEmis>'.$row['giro_acreedor'].'</GiroEmis>
                <Acteco>'.$row['ateco'].'</Acteco>
                <DirOrigen>'.$row['dir_acreedor'].'</DirOrigen>
                <CmnaOrigen>LAS CONDES </CmnaOrigen>
                <CiudadOrigen>SANTIAGO</CiudadOrigen>
                <CdgVendedor>No</CdgVendedor>
            </Emisor>
            <Receptor>
                <RUTRecep>'.$row["RUT_Deudor"].'</RUTRecep>
                <RznSocRecep>'.utf8_encode($row["Razon_Deudor"]).'</RznSocRecep>
                <GiroRecep>'.utf8_encode($row["giro_comercial"]).'</GiroRecep>
                <Contacto>'.$row["Contacto"].'</Contacto>
                <DirRecep>'.utf8_encode($row["direccion"]).'</DirRecep>
                <CmnaRecep>'.$row["comuna"].'</CmnaRecep>
                <CiudadRecep>'.$row["ciudad"].'</CiudadRecep>
            </Receptor>
            <Totales>
                <MntNeto>'.$row["monto"].'</MntNeto>
                <MntExe>0</MntExe>
                <TasaIVA>19</TasaIVA>
                <IVA>'.$iva.'</IVA>
                <MntTotal>'.$total.'</MntTotal>
            </Totales>
        </Encabezado><Detalle>
    <NroLinDet>1</NroLinDet>
    <CdgItem>
        <TpoCodigo>INT</TpoCodigo>
        <VlrCodigo>'.$row["tipo_fact"].'</VlrCodigo>
    </CdgItem>
    <NmbItem>'.utf8_encode($row["titulo"]).'</NmbItem>
    <QtyItem>1</QtyItem>
    <UnmdItem>UN</UnmdItem>
    <PrcItem>'.$row["monto"].'</PrcItem>
    <MontoItem>'.$row["monto"].'</MontoItem>
</Detalle>
<Referencia>
    <NroLinRef>1</NroLinRef>
    <TpoDocRef>SEN</TpoDocRef>
    <FolioRef>'.$row["referencia"].'</FolioRef>
    <FchRef>'.$row["fechaPublicacion"].'</FchRef>
    <RazonRef>'.$row["codigo"].'</RazonRef>
</Referencia></Documento>
</DTE>';

$files=fopen("../API/Logs/DTE/$fac.xml","w+");
fwrite ($files,$xml);
fclose($files);

header("location: ../API/NEnvio.php?id=$fac.xml");
?>