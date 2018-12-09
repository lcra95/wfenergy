<?php
include_once ("conexion.php");


class leeXml{


    function getDtes($xml, $pdf){

        $doc=new DOMDocument();
        $doc->load($xml);
        $encabezados=$doc->getElementsByTagName('IdDoc');
		foreach ($encabezados as $encabezado) 
		{
		//Acceso al TAG
            $TipoDTE=$encabezado->getElementsByTagName('TipoDTE');
            $folio=$encabezado->getElementsByTagName('Folio');
			$fecha=$encabezado->getElementsByTagName('FchEmis');
		//Valores Contenidos en los TAGS
            $fl=$folio->item(0)->nodeValue;
            $fh=$fecha->item(0)->nodeValue;
            $tp=$TipoDTE->item(0)->nodeValue;
		}
			
        $emisors=$doc->getElementsByTagName('Emisor');
		foreach($emisors as $emisor)
		{
	//Acceso al TAG 
			$rut=$emisor->getElementsByTagName('RUTEmisor');
			$razon=$emisor->getElementsByTagName('RznSoc');
			$giro=$emisor->getElementsByTagName('GiroEmis');
			$direccion=$emisor->getElementsByTagName('DirOrigen');
			$comuna=$emisor->getElementsByTagName('CmnaOrigen');
			$ciudad=$emisor->getElementsByTagName('CiudadOrigen');
		//Valores Contenidos en los TAGS
			@$re=$rut->item(0)->nodeValue;
			@$rze=$razon->item(0)->nodeValue;
			@$gre=$giro->item(0)->nodeValue;
			@$dre=$direccion->item(0)->nodeValue;
			@$coe=$comuna->item(0)->nodeValue;
			@$cie=$ciudad->item(0)->nodeValue;
        }
        $totales=$doc->getElementsByTagName('Totales');
        foreach ($totales as $total) 
        {
        //Acceso al TAG		
            $definitivo=$total->getElementsByTagName('MntTotal');
            $iva=$total->getElementsByTagName('IVA');
            if($exento=$total->getElementsByTagName('MntExe'))
            {
                @$ex=$exento->item(0)->nodeValue;
            }else{
                $ex=0;
            }
            $neto=$total->getElementsByTagName('MntNeto');
        //Valores Contenidos en los TAGS
            @$df=$definitivo->item(0)->nodeValue;
            @$iv=$iva->item(0)->nodeValue;
            @$nt=$neto->item(0)->nodeValue;
        }

        $sel=mysql_query("SELECT * FROM factura_recibida WHERE folio = $fl AND rut_emisor = '$re'");
        $result=mysql_num_rows($sel);
        
        if($result == 0){
            $sql=mysql_query("INSERT INTO factura_recibida (`id`, `folio`, `tipo`, `fechaemision`, `rut_emisor`, `total`, `iva`, `exento`, `neto`, `pdf`) VALUES (NULL, '$fl', '$tp', '$fh','$re','$df','$iv','$ex','$nt', '$pdf')");
            $sql2=mysql_query("INSERT INTO acreedor (`rut_acreedor`, `razonsocial`, `giro`, `comuna`, `ciudad`, `direccion`) VALUES('$re','$rze','$gre','$coe','$cie','$dre')");
            $detalles=$doc->getElementsByTagName('Detalle');
            $i=0;
            $nom='';
            $des='';
            foreach ($detalles as $detalle ) 
            {
                if(@$nombre[$i]=$detalle->getElementsByTagName('NmbItem')){
                    @$nom=$nombre[$i]->item(0)->nodeValue;
                }	
                if(@$descripcion[$i]=$detalle->getElementsByTagName('DscItem')){
                    @$des=$descripcion[$i]->item(0)->nodeValue;
                }	
                $cantidad[$i]=$detalle->getElementsByTagName('QtyItem');
                $precio[$i]=$detalle->getElementsByTagName('PrcItem');
                $unidad[$i]=$detalle->getElementsByTagName('UnmdItem');
                $monto[$i]=$detalle->getElementsByTagName('MontoItem');
                @$can=$cantidad[$i]->item(0)->nodeValue;
                @$pr=$precio[$i]->item(0)->nodeValue;
                @$un=$unidad[$i]->item(0)->nodeValue;
                @$mon=$monto[$i]->item(0)->nodeValue;
                $i++;
                $sql3=mysql_query("INSERT INTO factura_recibida_concepto (`id`, `folio`, `rut_emisor`, `descripcion`, `nombre`, `cantidad`, `precio`, `unidad`, `monto`) 
                VALUES (NULL, '$fl', '$re', '$des', '$nom', '$can', '$pr', '$un', '$mon');");
            }

        }else{
            return false;
        }    
        return true;
    }
}


?>