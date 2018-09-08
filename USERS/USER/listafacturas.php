<?php 
include("conexion.php");
include("funciones.php");
$tpr=mysql_query("SELECT id FROM periodo WHERE activo = 1");
$tte=mysql_fetch_array($tpr);
@$periodo=$tte[0];
?>

<?php include("head.php");?>
<body>
  
<?php include("head-nav-main.php");?><!--Menu Principal-->
<div id="wrapper">

<div id="page-content-wrapper">
<?php 

$t=$_SESSION["id"];

?>
<div class="container well">
  <div class="row">
    <div class="col-sm-12">

      <ol class="breadcrumb">
         <li><a href="#">Inicio</a></li>
          <li><a href="#">Cuadro de Pagos</a></li>
      </ol>
    <div class="panel panel-default">
        <div class="panel-heading">
          <h4> SELECCIONE PERIODO</h4> 
        </div>
        <div class="panel-body">
          <form action="listafacturas.php" method="get">
            <SELECT name="periodo">
            <?PHP 
              $per=mysql_query("SELECT * FROM periodo");
            ?>
            <?php 
              while($rowa=mysql_fetch_array($per))
              {
            ?>
              <option value="<?php echo $rowa[0];?>">
                <?php echo $rowa[0];?>
              </option>
            <?php 
              }
            ?>
            </SELECT>
          </div>
         </div>
        <div class="panel-footer">  
          <button type="submit" class="btn btn-success btn-sm" aria-hidden="true"><span class="fa fa-search"></span>Ver Info</button>  
        </div>
          </form>
        </div></div></div>
<div class="container well">
<div class="row">
<div class="col-sm-12">
<div class="col-sm-12">

   
 
      </div>

      <div class="panel panel-default">
        <div class="panel-heading">
       <h4> LISTADO DE FACTURAS DE <?php if(@$periodo=$_GET['periodo']==""){$periodo=$tte[0];}else {@$periodo=$_GET['periodo'];} echo $periodo;?></h4> 
     
        </div>
        <div class="panel-body">
<div class="table-responsive table-bordered">

<?php include('conexion.php');
$sel=mysql_query("SELECT *
FROM `factura`
WHERE `id_periodo` LIKE '$periodo'");
?>

<table id="example" class="display" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th align="Center">Factuta N°</th>
            <th align="Center">Fecha</th>
            <th align="Center">Razón Social</th>
            <th align="Center">Rut</th>
            <th align="Center">Monto</th>
            <th align="Center">IVA</th>
            <th align="Center">Total</th>
            <th align="Center">Status</th>
          </tr>
        </thead>
         <tbody>
        <?php 

  while($q=mysql_fetch_array($sel))

  {    
  
        $t=ultimo_status($q[0]);
              list($rut,$razon)=ultimate_empresa($q[5]);
          $color=cambia_color($t);
            ?>
          <tr>
             <td align="Center"><a target="_blank" href="pfac.php?factura=<?php echo $q[0];?>" class="fa fa-file-text"></a>
             <a target="_blank" class="fa fa-file-code-o" href="facturas/<?php echo $q[0]?>.xml"></a> 
             </td>      
             <td><?php echo $q[3];    ?></td>                                   
             <td><?php  echo $razon;  ?></td>
             <td><?php  echo $rut;
              list($totext,$totex,$ivat,$total,$iva)=ultimate_montos($q[0]);

             ?></td>
             <td align="Right"><?php echo number_format($totext);?></td>
             <td align="Right"><?php echo number_format($ivat);?></td>
             <td align="Right"><?php echo number_format($total);?></td>
            
             <td align="Center" class="<?php echo $color; ?>">
                <div align="left">
                  <a target="_blank" class="fa fa-search" href="seguimiento.php?fac=<?php echo $q[0];?>&rut=<?php echo $rut;?>"></a>
                  <a class="fa fa-check-square-o"></a>
                  <!--<a class="fa fa-check-square-o" href="update.php?fac=<?php echo $q[0];?>&periodo=<?php echo $periodo;?>&sta=<?php echo dfsta($t);?>"></a>-->
                  <?php  echo dfsta($t); ?></div></td>             
          </tr>
          <?php   
    }?>

        </tbody>
    </table>




     
    </div>
 
        </div>

 
        <div class="panel-footer">    </div>
      </div>
 
    </div>        

</div>
<!-- /#page-content-wrapper -->


</div>

    
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
  <script src="js/bootstrap.js"></script>



