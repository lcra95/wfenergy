<?php 
include("funciones.php");
include("conexion.php");
$fac=4;


function GenEncabezadoXML($fac)//Esta funciones Genera la seccion <Documento/> Para que sean los datos documentos

{

$rutdaniel="24675367-9";

list($frut,$fraz,$fdir,$fcom,$fciu,$fema,$ftel,$fsuc,$fgir)=filial();

list($st,$obs,$fec,$ven,$emp,$per,$tip)=ultimate_factura($fac);

$date= date('Y-m-d');

$time=date('h:i:s');

list($rut,$raz,$dir,$com,$ciu,$con,$gir)=ultimate_empresa($emp);

list($totext,$totex,$ivat,$total,$iva)=ultimate_montos($fac);

list($f,$desde,$hasta,$caf)=folio_activo();

$did='F'.$fac.'T'.$tip; 


$encabezado="<EnvioDTE>
    <Fecl>
        <ModoSimulacion>true</ModoSimulacion>
        <Certificado>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</Certificado>
        <Clave>latin2017*</Clave>
    </Fecl>
    <Caratula>
        <RutEmisor>".$frut."</RutEmisor>
        <RutEnvia>".$rutdaniel."</RutEnvia>
        <RutReceptor>".$rut."</RutReceptor>
        <FchResol>2017-06-21</FchResol>
        <NroResol>0</NroResol>
    </Caratula>
    <SetDTE>    
        <DTE>
            <Documento>
                <TipoDTE>".$tip."</TipoDTE>
                <Folio>".$fac."</Folio>
                <FchEmis>".$date."</FchEmis>    
            </Documento>
            <Emisor>
                <RUTEmisor>".$frut."</RUTEmisor>
                <RznSoc>".$fraz."</RznSoc>
                <GiroEmis>".$fgir."</GiroEmis>
                <Acteco>741400</Acteco>
                <DirOrigen>".$fdir."</DirOrigen>
                <CmnaOrigen>".$fcom."</CmnaOrigen>
            </Emisor>
            <Receptor>
                <RUTRecep>".$rut."</RUTRecep>
                <RznSocRecep>".$raz."</RznSocRecep>
                <GiroRecep>".$gir."</GiroRecep>
                 <DirRecep>".$dir."</DirRecep>
                <CmnaRecep>".$com."</CmnaRecep>
            </Receptor>
            <Totales>
                <MntNeto>".round($totext)."</MntNeto>
                <MntExe>".round($totex)."</MntExe>
                <TasaIVA>".$iva."</TasaIVA>
                <IVA>".round($ivat)."</IVA>
                <MntTotal>".round($total)."</MntTotal>
            </Totales>
            <Detalles>
            ".conceptosxml($fac)."
            </Detalles>
            <TED>PD94bWwgdmVyc2lvbj0iMS4wIj8+CjxBVVRPUklaQUNJT04+CjxDQUYgdmVyc2lvbj0iMS4wIj4KPERBPgo8UkU+NzY1ODQyNDgtNDwvUkU+CjxSUz5MQVRJTiBTRVJWSUNFUyBTUEE8L1JTPgo8VEQ+MzM8L1REPgo8Uk5HPjxEPjE8L0Q+PEg+NTA8L0g+PC9STkc+CjxGQT4yMDE3LTA3LTAzPC9GQT4KPFJTQVBLPjxNPnNjZWZNckt4RlBzc20yUC9nMEcydW9lckt6TUtpWkkrNERocGo0WmczR3ZId1picjRwa1lpdEFYN1BVSVM5RFkzblhHYmV1cURnRnlKMlVwVXFMUFd3PT08L00+PEU+QXc9PTwvRT48L1JTQVBLPgo8SURLPjEwMDwvSURLPgo8L0RBPgo8RlJNQSBhbGdvcml0bW89IlNIQTF3aXRoUlNBIj5kVTZ1VFMrbFVXN3NwZjgvMVh6RUlMTFdvU3VCbTk5cFlwQ3JCQXNnYUZOMXFZcXhUTmZ6WnM4YnFUS1RLTUhBRi96Z0l5aGNBeGQrelVITlpDd3lNUT09PC9GUk1BPgo8L0NBRj4KPFJTQVNLPi0tLS0tQkVHSU4gUlNBIFBSSVZBVEUgS0VZLS0tLS0KTUlJQk9RSUJBQUpCQUxISG56S3lzUlQ3TEp0ai80TkJ0cnFIcXlzekNvbVNQdUE0YVkrR1lOeHJ4OEdXNitLWgpHSXJRRit6MUNFdlEyTjUxeG0zcnFnNEJjaWRsS1ZLaXoxc0NBUU1DUUhhRkZNeDNJTGluY3hKQ3FsZUJKSHhhCmNoek1zYkVNS2VyUVJsK3U2ejJjRTBmcGh6Y2V4VjAyVnJQQ2Zyc0xyelBUelZkS1VwRnBiQkl3ay93bVQvc0MKSVFEYlhYaVZNZWNwaG93VW1wcktjQTBZSWZvNlorQW8xL0NqK0FBczVwZkZId0loQU05NFFBdmVBOGI0Y29GRQp0bi9ETWpudXZkZ0RIQVZiOHF3VUhCNXgwWkpGQWlFQWtqNVFZM2FhRzY4SURieG5NYUFJdXNGUmZFVkFHenFnCmJWQUFIZThQMkw4Q0lRQ0tVQ3F5bEFLRXBhR3JneVJWTE13bW55azZyTDFZNS9jZFlyMXBvVFpoZ3dJZ1BML2kKZGFURjdwQm1Rb2FOcFBuTll0TC85ZXU5YUMxMVg1ZXIrTm9CYi9zPQotLS0tLUVORCBSU0EgUFJJVkFURSBLRVktLS0tLQo8L1JTQVNLPgoKPFJTQVBVQks+LS0tLS1CRUdJTiBQVUJMSUMgS0VZLS0tLS0KTUZvd0RRWUpLb1pJaHZjTkFRRUJCUUFEU1FBd1JnSkJBTEhIbnpLeXNSVDdMSnRqLzROQnRycUhxeXN6Q29tUwpQdUE0YVkrR1lOeHJ4OEdXNitLWkdJclFGK3oxQ0V2UTJONTF4bTNycWc0QmNpZGxLVktpejFzQ0FRTT0KLS0tLS1FTkQgUFVCTElDIEtFWS0tLS0tCjwvUlNBUFVCSz4KPC9BVVRPUklaQUNJT04+Cg==</TED>
            <Impresion>
                <Plantilla>plantilla.rtm</Plantilla>
            </Impresion>
        </DTE>
    </SetDTE>
</EnvioDTE>";        
return $encabezado;
}

function ultimate_conpcepto($fac)
{
$id=$fac;
$rutdaniel="24675367-9";

list($frut,$fraz,$fdir,$fcom,$fciu,$fema,$ftel,$fsuc,$fgir)=filial();

list($st,$obs,$fec,$ven,$emp,$per,$tip)=ultimate_factura($fac);

$date= date('Y-m-d');

$time=date('h:i:s');

list($rut,$raz,$dir,$com,$ciu,$con,$gir)=ultimate_empresa($emp);

list($totext,$totex,$ivat,$total,$iva)=ultimate_montos($fac);

list($f,$desde,$hasta,$caf)=folio_activo();




    $sql=mysql_query("SELECT * FROM tipo_transaccion WHERE id= $id");

    $row=mysql_fetch_array($sql);

    return $row[1];

}

function solicitap($fac)

{

$i=0;

$sql=mysql_query("SELECT * FROM factura_concepto WHERE id_factura = $fac");

while($row=mysql_fetch_array($sql))

{

    return $con = ultimate_conpcepto($row[2]);

    break;

}

    



}

function conceptosxml($fac) //esta funcion obtine de la base de datos los datos de los conceptos facturados
{

$rutdaniel="24675367-9";

list($frut,$fraz,$fdir,$fcom,$fciu,$fema,$ftel,$fsuc,$fgir)=filial();

list($st,$obs,$fec,$ven,$emp,$per,$tip)=ultimate_factura($fac);

$date= date('Y-m-d');

$time=date('h:i:s');

list($rut,$raz,$dir,$com,$ciu,$con,$gir)=ultimate_empresa($emp);

list($totext,$totex,$ivat,$total,$iva)=ultimate_montos($fac);

list($f,$desde,$hasta,$caf)=folio_activo();



$buffermedio="";

$i=0;

$cont=1;



    $sql3=mysql_query("SELECT * FROM `factura_concepto` WHERE `id_factura` = $fac");

    while($row=mysql_fetch_array($sql3))

    {

        $con[$i]=$row[2];

        $cant[$i]=$row[3];

        $prec[$i]=$row[4];

        $ext[$i]=$row[5];

        $exe[$i]=$row[6];

        $tot[$i]=$row[12];

        $i++;

    }

    $tamano=sizeof($cant);

    for($a=0;$a<$tamano;$a++)

    {

        $buffer3[$a]='<Detalle>
            <NroLinDet>'.$cont.'</NroLinDet>
            <CdgItem>
                <TpoCodigo>CFN</TpoCodigo>
                <VlrCodigo>'.$con[$a].'</VlrCodigo>
            </CdgItem>
            <NmbItem>'.ultimate_conpcepto($con[$a]).'</NmbItem>
            <QtyItem>'.$cant[$a].'</QtyItem>
            <UnmdItem>UN</UnmdItem>
            <PrcItem>'.round($prec[$a]).'</PrcItem>
            <MontoItem>'.round($ext[$a]).'</MontoItem>
        </Detalle>';

        $cont++;

            $buffermedio=$buffermedio.$buffer3[$a];

    }

return $buffermedio;

}

$b2=GenEncabezadoXML($fac);
$files=fopen("DTE/EnvioDTE.xml","w+");
fwrite ($files,$b2);
fclose($files);


?>
<A href="DTE/EnvioDTE.xml">hERE</A>