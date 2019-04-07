
<?php
$dir = dirname(__FILE__)."/Logs/2018/13/";
// Abre un  conocaido, y procede a leer el contenido
if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            
           $xml=$dir.$file; 
           $lee=new leeXml();
           $lee->getDtes($xml);



        }
        closedir($dh);
    }
}else{
    echo 'Error';
}

class leeXml{

    function getDtes($xml){
        $nxml=file_get_contents($xml);
       // $xml=dirname(__FILE__)."/FCL/test/T33F2893.xml";
        if(!empty($xml)){
    
        $doc=new DOMDocument();
        @$doc->load($xml);

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
        //Valores Contenidos en los TAGS
            @$re=$rut->item(0)->nodeValue;
        }    
        $receptors=$doc->getElementsByTagName('Receptor');
        foreach($receptors as $receptor)
        {
    //Acceso al TAG 
            $rutr=$receptor->getElementsByTagName('RUTRecep');
        //Valores Contenidos en los TAGS
            @$rr=$rutr->item(0)->nodeValue;
        }    
        $detalles=$doc->getElementsByTagName('Detalle');

            foreach ($detalles as $detalle ) 
            {
               @$nombre[$i]=$detalle->getElementsByTagName('NmbItem');
               @$nom=$nombre[$i]->item(0)->nodeValue;
                               
            }
        $re=substr($re,0,8);
        if($fh == '2018-12-01'){
            
            unlink($xml);
            echo $re.';'.$fl.';'.$fh.'<br>';
            
            $archi=dirname(__FILE__)."/Logs/2018/11/".$re.'_'.$tp.'_'.$fl.'.xml';
 
            $fp = fopen($archi, 'w');
            fwrite($fp, $nxml);
            fclose($fp);

        }elseif($nom == 'E001'){
            $archi=dirname(__FILE__)."/Logs/2018/11/".$re.'_'.$tp.'_'.$fl.'.xml';
 
            $fp = fopen($archi, 'w');
            fwrite($fp, $nxml);
            fclose($fp);
        }

        return true;
    }
    }
}