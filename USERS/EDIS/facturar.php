<?php 
include("conexion.php");
include("funciones.php");
$id=$_GET['id'];
$em=$_GET['empresa'];
$mo=round($_GET['monto']);
$periodo=$_GET['periodo'];
$concepto=con_trans($id);
if($mo<0)
{
	$mo=$mo*-1;
}
list($rut,$raz)=datos_empresa($id);
?>
<html>
<head>
	
   <meta charset="utf-8">
   <title></title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
   <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
   <script>
      $(document).ready(function()
      {
         $("#mostrarmodal").modal("show");
      });
    </script>
</head>

<body>
  
<div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content well"><form action="datos_factura.php?id=<?PHP echo $id;?>&empresa=<?php echo $em;?>&periodo=<?php echo $periodo;?>" method="post">
 
            <div class="modal-header">
              <a href="pfactura.php" type="button" class="close"  ><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></a>
              <h3 class="modal-title" id="ModalLabel">Generar Factura # XXX<br></h3>
              <b><?php echo "RUT.: ".$rut."<BR>Razón: ".$raz."<br>Fecha: ".$date=date('Y-m-d');
              $nuevafecha = strtotime ( '+5 day' , strtotime ( $date ) ) ;	$nuevafecha = date ( 'Y-m-d',$nuevafecha ); echo '<br>Vencimiento: '.obtenerFechaEnLetra($nuevafecha);

              ?></b>
            </div>

            <div class="modal-body">
              
			<table width="750" align="center">
				<thead>
					<th align="center">Item</th>
					<th align="center" width="150">Descripción</th>
					<th align="center">Cant</th>
					<th align="center">Monto</th>
					<th align="center">Iva 19%</th>	
					<th align="center">Exnt</th>
					<th align="center">Dscto %</th>
					<th align="center">Rcrgo %</th>
					<th align="center">Total</th>
				</thead>
				<tbody>
					<td align="center"><input name="item" value="1" size="3" readonly="true"></td>
					<td align="center"><input name="descripcion" size="22" value="<?php echo $concepto;?>"></td>
					<td align="center"><input name="cant" value="1" size="3" readonly="true"></td>
					<td align="center"><input name="monto" value="<?php echo round($mo);?>" size="12" readonly="true"></td>
					<td align="center"><input name="iva" value="<?php echo round($mo*0.19);?>" size="6" readonly="true"></td>
					<td align="center"><select name="exento"><option>NO</option><option>SI</option></select></td>
					<td align="center"><input name="descto" value="0" size="3"></td>
					<td align="center"><input name="recargo" value="0" size="3"></td>
					<td align="center"><input name="total" value="<?php echo round($mo*1.19);?>" size="6" readonly="true"></td>
				</tbody>
			</table>
			<input type="hidden" name="vence" id="oculto" value="<?php echo $nuevafecha; ?>"/>
			
            </div> 


           	<div class="modal-footer">
           	<b>Observaciones: </b><input type="text" size="50" name="observacion" id="oculto"/>
			<button type="submit" class="btn btn-success btn-sm" aria-hidden="true"><span class="fa fa-search"></span>Update</button>
			<a href="pfactura.php" class="btn btn-danger btn-sm">Cerrar</a>



           	</div>
          
        </div>
    	</form> </div>
</div>
</body>
</html>

