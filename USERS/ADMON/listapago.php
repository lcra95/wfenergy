<?php 
include("head.php");
$id=$_GET['id'];
include("head-nav-main.php");
include("conexion.php");
include("funciones.php");


?>
<div id="wrapper">
<div class="container well">
<div class="row">
<div class="col-sm-12">
  <ol class="breadcrumb">
    <li><a href="#">Inicio</a></li>
    <li><a href="#">Pagos</a></li>
    <li><a href="#">Procesos de Pago</a></li>
    <li><a href="#">Detalles</a></li>
  </ol>
      <div class="col-sm-12">

<?php $sql=mysql_query("SELECT 
p.id, p.fecha, fr.folio, fr.rut_emisor, a.razonsocial, fr.total, fr.iva, fr.exento, fr.neto
FROM pago p 
JOIN factura_recibida fr ON p.id_factura_recibida = fr.id
JOIN acreedor a ON fr.rut_emisor = a.rut_acreedor 
WHERE p.id_proceso_pago = $id");?>
<div class="panel panel-default">
<div class="panel-heading"><h4>DETALLE DE PROCESO DE PAGOS ID  <?PHP echo $id;?></4> <br><br> <a href="export_pagos.php?idp=<?php echo $id;?>" class="fa fa-download"></a> Descargar Data Excel</div>
<div class="panel-body">



<div class="table-responsive table-bordered">



<table id="example" class="display" cellspacing="0" width="100%">
        <thead>
          <tr>
          	<th aling="Center">Id Pago</th>
          	<th align="Center">Fecha</th>
		      	<th align="Center">Razón Social</th>
            <th align="Center">Rut</th>
            <th align="Center">Neto</th>
            <th align="Center">Iva</th>
            <th align="Center">Exento</th>
            <th align="Center">Total</th>
            <th align="Center">Folio</th>
          </tr>
        </thead>
         <tbody>
        <?php 
  while($q=mysql_fetch_array($sql))
  {
?>
          <tr>
             <td align="Center"><?php echo $q['id'];?></td> 
             <td align="Center"><?php echo $q['fecha'];?></td>                                         
             <td><?php echo $q['razonsocial'];?></td>
             <td><?php echo $q['rut_emisor'];?></td>
             <td align="Right"><?php echo number_format($q['neto']);?></td>
             <td align="Right"><?php echo number_format($q['iva']);?></td>
             <td align="Right"><?php echo number_format($q['exento']);?></td>
             <td align="Right"><?php echo number_format($q['total']);?></td>    
             <TD align="Right"><a target="_blank" href="../API/Facturacion/pdfread.php?id=<?php echo $q['folio'] ?>"><?php echo $q['folio']; ?></a></TD>         
          </tr>
          <?php   
 }?>

        </tbody>
        <TFOOT>
        <tr>
          	<th aling="Center">Id Pago</th>
          	<th align="Center">Fecha</th>
		      	<th align="Center">Razón Social</th>
            <th align="Center">Rut</th>
            <th align="Center">Neto</th>
            <th align="Center">Iva</th>
            <th align="Center">Exento</th>
            <th align="Center">Total</th>
            <th align="Center">Folio</th>
          </tr>

        </TFOOT>
    </table>




</div>
</div>
<div class="panel-footer">    </div>
</div>
</div>        
</div>
 </div>
 
    </div>        

</div>
<!-- /#page-content-wrapper -->
</div>

</div>


    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

  <script src="js/bootstrap.js"></script>