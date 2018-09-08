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

<?php $sql=mysql_query("SELECT * FROM pago WHERE id_proceso_pago = $id");?>
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
            <th align="Center">Monto</th>
            <th align="Center">Iva</th>
            <th align="Center">Total</th>
            <th align="Center">Factura</th>
          </tr>
        </thead>
         <tbody>
        <?php 
  while($q=mysql_fetch_array($sql))
  {
  			list($rut,$razon)=empresa_pago($q[2]);
            ?>
          <tr>
             <td align="Center"><?php echo $q[0];?></td> 
             <td align="Center"><?php echo $q[1];?></td>                                         
             <td><?php echo $razon;?></td>
             <td><?php echo $rut;?></td>
             <td align="Right"><?php echo number_format($q[4]);?></td>
             <td align="Right"><?php echo number_format($q[5]);?></td>
             <td align="Right"><?php echo number_format($q[6]);?></td>    
             <TD align="Right"><?php echo update_factura($q[0],$q[3]); ?></TD>         
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
            <th align="Center">Monto</th>
            <th align="Center">Iva</th>
            <th align="Center">Total</th>
            <th align="Center">Factura</th>
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