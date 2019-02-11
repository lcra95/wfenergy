<?php 
session_start();
include_once ('Config.php');
include_once ('../ADMON/head.php');
include_once ("../ADMON/head-nav-main.php");


$id= $_GET['id'];
$periodo=$_GET['periodo'];


?>
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
<div class="panel-heading"><h4>Detalle de <?php echo $_SESSION['desc'];?> para el periodo <?php echo $periodo;?></h4> <br> </div>
<div class="panel-body">
<div class="table-responsive table-bordered">

<table id="example" class="display" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th align="Center">Rut</th>
            <th align="Center">Razón Social</th>
            <th align="Center">Tipo Factura</th>
            <th align="Center">Referencia</th>
            <th align="Center">Cuadro de Pago</th>
            <th align="Center">Monto</th>
            <th align="Center">Detalle</th>
          </tr>
        </thead>
         <tbody>
 
        <?php
            $dbSelect= "SELECT * FROM detalle_balance WHERE periodo ='$periodo' AND tipo_fact = $id";
            $result = $mysqli->query($dbSelect);
            while ($row = mysqli_fetch_assoc($result)){ 
                // echo '<pre>';
                // print_r($row);
        ?>
          <tr>                                        
             <td><?php echo $row['RUT_Deudor'];?></td>
             <td><?php echo utf8_encode($row['Razon_Deudor']);?></td>
             <td><?php echo utf8_encode($row['key']);?></td>
             <td><?php echo $row['referencia'];?></td>
             <td><?php echo $row['codigo'];?></td> 
             <td align="Right"><?php echo $row['monto'];?></td>  
             <td align="Center"><a href="">Ver</a></td>           
          </tr>
        <?php 
            }
        ?>        
        </tbody>
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