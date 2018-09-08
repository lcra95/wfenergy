<?php include("head.php");
@$tit=$_GET['tit'];
@$peri=$_GET['peri'];
include("funciones.php");
?>

<?php include("head-nav-main.php");?>
<div id="wrapper">
<div class="container well">
<div class="row">
<div class="col-sm-12">
  <ol class="breadcrumb">
    <li><a href="#">Inicio</a></li>
    <li><a href="#">Cuadro de Pagos</a></li>
    <li><a href="#">Detalles</a></li>
  </ol>
      <div class="col-sm-12">


<div class="panel panel-default">
<div class="panel-heading"><h4>DETALLE DE <?php echo concepto($tit);?></4> <br> </div>
<div class="panel-body">

<?php
$sel=mysql_query("SELECT * FROM `empresa_transaccion` WHERE `id_transaccion` = $tit AND `periodo` LIKE '$peri'");
  if($tit <= 2)
  {


?>
<div class="table-responsive table-bordered">



<table id="example" class="display" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th align="Center">Empresa</th>
            <th align="Center">Rut</th>
            <th align="Center">Razón Social</th>
            <th align="Center">Factuta N°</th>
            <th align="Center">Monto</th>
            <th align="Center">Fecha Factura</th>
            <th align="Center">Status</th>
          </tr>
        </thead>
         <tbody>
        <?php 
  while($q=mysql_fetch_array($sel))
  {

            ?>
          <tr>
             <td><?php echo $q[2];?></td>                                        
             <td><?php echo rut_empresa($q[2]);?></td>
             <td><?php echo razon($q[2]);?></td>
             <td align="Center"><a target="_blank"  href="factura.php?fac=<?php echo factura($q[0]);?>&rut=<?php echo rut_empresa($q[2]);?>"><?php echo $fa=factura($q[0]);?></a></td>
             <td align="Right"><?php echo number_format($q[4]);?></td>
             <td align="Center"><?php echo ffactura($q[0]);?></td> 
             <td align="Center"><?php echo status_fac($fa);?></td>             
          </tr>
          <?php   
    }?>

        </tbody>
    </table>






<?php
  }
  else
    {

?>

<div class="table-responsive table-bordered">



<table id="example" class="display" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th align="Center">Empresa</th>
            <th align="Center">Rut</th>
            <th align="Center">Razón Social</th>
            <th align="Center">Proceso de Pago</th>
            <th align="Center">Monto</th>
            <th align="Center">Status</th>
          </tr>
        </thead>
         <tbody>
        <?php 
  while($q=mysql_fetch_array($sel))
  {

            ?>
          <tr>
             <td><?php echo $q[2];?></td>                                        
             <td><?php echo rut_empresa($q[2]);?></td>
             <td><?php echo razon($q[2]);?></td>
             <td align="Center"><a target="_blank"  href="#?fac=<?php echo factura($q[0]);?>&rut=<?php echo rut_empresa($q[2]);?>"><?php echo $fa=proceso($q[0]);?></a></td>
             <td align="Right"><?php echo number_format($q[4]);?></td>
             <td align="Center"><?php echo @status_pago($fa);?></td>             
          </tr>
          <?php   
    }?>

        </tbody>
    </table>






<?php 

    }
?>



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