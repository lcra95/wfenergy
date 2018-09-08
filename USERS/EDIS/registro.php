<?php 
include("conexion.php");
include("funciones.php");
include("11pesos.php");
$tpr=mysql_query("SELECT id FROM periodo WHERE activo = 1");
$tte=mysql_fetch_array($tpr);
 if(@$periodo=$_GET['periodo']==""){$periodo=$tte[0];}else {@$periodo=$_GET['periodo'];} ?>
<?php include("head.php");?>
<body>
  
<?php include("head-nav-main.php");?><!--Menu Principal-->
<div id="wrapper">

<!-- Page Content -->
<div id="page-content-wrapper">
<?php 

$t=$_SESSION["id"];
      list($ting,$tegr,$ttotal)=calculo2($periodo); 
      list ($acu,$p)=acumulado($periodo);

      ?>

<div class="container well">
<div class="row">
    <div class="col-sm-12">

        <ol class="breadcrumb">
    <li><a href="#">Inicio</a></li>
    <li><a href="#">Cuadro de Pagos</a></li>
<!--<li class="active"><a href="#" data-toggle="modal" data-target="#ventana"><i class="fa fa-asterisk"></i> Nuevo Registro</a></li>
 --> </ol>
        <div class="panel panel-default">
        <div class="panel-heading">
       <h4> SELECCIONE PERIODO</h4> 
     
        </div>
        <div class="panel-body">
<form action="registro.php" method="get">
      
      <table width="100%">
      <tr>
      <td rowspan="2" valign="top" width="65%">
      <SELECT name="periodo" >
      <?PHP 
      $per=mysql_query("SELECT * FROM periodo");
      ?>
      <h4><option value="<?php echo $periodo;?>"><?php echo $periodo;?></option></h4>
      <?php while($rowa=mysql_fetch_array($per)){?>
      <h4><option value="<?php echo $rowa[0];?>"><?php echo $rowa[0];?></option></h4>
      <?php }?>
      </SELECT>
      </td>
      <td align="center"><h4>Perido <?php echo $periodo;?></h4></td>
      <td align="center"><h4>Acumulado <?php echo $p;?></h4></td>
      </tr>
      <tr>
        <td align="right"><?php echo number_format($ttotal);?></td>
        <td align="right"><?php echo $acu;?></td>
      </tr>
      </table>

     
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

    <table width="100%">
      <tr>
        <th rowspan="2" valign="top">
          <h4 > CUADRO DE PAGOS PERIODO <?php if(@$periodo=$_GET['periodo']==""){$periodo=$tte[0];}else {@$periodo=$_GET['periodo'];} echo $periodo;?><br><br> <a href="export_facturar.php?periodo=<?php echo $periodo;?>" class="fa fa-download"></a> Descargar Data Excel</h4> 
        </th>
        <th align="center"><h4>Ingreso Neto </h4></th>
        <th align="center"><h4>Engreso Neto</h4></th>
        <th align="center" class="<?php echo color_importe($ttotal);?>"><h4>Margen Neto</h4></th>
      </tr>
      <tr>
        
       <td align="right"> <?php echo number_format($ting);?></td>
       <td align="right"><?php echo number_format($tegr);?></td>
       <td align="right" class="<?php echo color_importe($ttotal);?>"><?php echo number_format($ttotal);?></td>
      </tr>
    </table>
        </div>
        <div class="panel-body">
          <div class="table-responsive table-bordered">
            <?php include('conexion.php');

$sql=mysql_query("SELECT distinct id_transaccion FROM empresa_transaccion WHERE periodo LIKE '$periodo'");
$i=0;
?>
<table id="example" class="display" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>Grupo</th>
            <th>Concpeto</th>
            <th>Ingreso Neto</th>
            <th>Egreso Neto</th>
            <th>Margen Neto</th>
            <th>Detalle</th>
          </tr>
        </thead>

         <tbody>
        <?php 
        
          $sumaing=0;  
         $sumaeg=0; 
  while($q=mysql_fetch_array($sql))
  {
      list($ing,$egr,$total)=calculo($periodo,$q[0]);
            $sumaing=$sumaing+$ing;
            $sumaeg=$sumaeg+$egr;


            ?>
          <tr> 
            <td><?php echo grupo($q[0]);?></td>
            <td><?php echo concepto($q[0]);?></td>
            <td align="Right"><?php echo number_format($ing);?></td>
            <td align="Right"><?php echo number_format($egr);?></td>
            <td align="Right"><?php echo number_format($ing-$egr);?></td>
            <td><a href="detalle.php?tit=<?php echo $q[0];?>&peri=<?php echo $periodo;?>">Detalles</a></td>                                                      
          </tr>
          <?php   
    }?>

        </tbody>
                <tfoot>
          <tr>
            
            
            <td><b>Totales:</b></td>
            <td><b>Todos los Conceptos</b></td>
            <td><b>Ingreso Neto</b> <?php echo number_format($sumaing);?></td>
            <td><b>Egreso Neto</b> <?php echo number_format($sumaeg);
            $importe=color_importe($sumaing-$sumaeg);
            ?></td>
            <td colspan="2" class="<?php    echo $importe;?>"><b>Margen Neto</b> <?php echo number_format($sumaing-$sumaeg);?></td>
            
          </tr>
        </tfoot>
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




</body>
</html>