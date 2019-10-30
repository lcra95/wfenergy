<?php
include("head.php");
include("conexion.php");
include("funciones.php");
include("head-nav-main.php");

if(isset($_SESSION['msg'])){
  $msg=$_SESSION['msg'];
  echo "<script> alert('$msg')</script>"; 
  unset($_SESSION['msg']);
}
$tpr=mysql_query("SELECT id FROM periodo WHERE activo = 1");
$tte=mysql_fetch_array($tpr);
 if(@$periodo=$_GET['periodo']==""){
   $periodo=$tte[0];
 }else {
   @$periodo=$_GET['periodo'];
 } 
?>
<div id="wrapper">
<div class="container well">
<div class="row">
<div class="col-sm-12">
  <ol class="breadcrumb">
    <li><a href="#">Inicio</a></li>
    <li><a href="#">Factura</a></li>
    <li><a href="#">Gestionar Facturas</a></li>
  </ol>
      <div class="col-sm-12">


<div class="panel panel-default">
<div class="panel-heading"><h4>PENDIENTE POR FACTURAR  </div>
<div class="panel-body">


<div class="table-responsive table-bordered">
<p class="<?php  @$color=$_GET['color'];  echo color(@$color);?>"><font class="<?php echo color(@$color);?>"><?PHP echo @$msg=$_GET['msg'];?></font></p>
<table id="example" class="display" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th align="Center">Empresa</th>
            <th align="Center">Rut</th>
            <th align="Center">Razón Social</th>
            <th align="Center">Monto</th>
            <th align="Center">Periodo</th>
            <th align="Center">Facturar</th>
          </tr>
        </thead>
         <tbody>


<?php 
$sel=mysql_query("SELECT * FROM empresa_transaccion WHERE id_status = 0");
while($row=mysql_fetch_array($sel))
{ 
	$sql2=mysql_query("SELECT * FROM factura_transaccion WHERE id_transaccion = $row[0]");
	if(!$data=mysql_fetch_array($sql2))
	{	
    if(($row[1]<20)&&($row[4]>0))
		{

		
		?>
		      <tr>
             <td><?php echo $row[2];?></td>                                        
             <td><?php echo rut_empresa($row[2]);?></td>
             <td><?php echo razon($row[2]);?></td>
             <td align="Right"><?php echo number_format($row[4]);?></td>
             <td><?php echo $row[3];?></td>
             <td align="Center"><a href="borrador.php?concepto=<?php echo $row[1];?>&id=<?php echo $row[0]; ?>&empresa=<?php echo $row[2]?>&monto=<?php echo $row[4];?>&periodo=<?php echo $periodo;?>">Facturar</a></td>             
          </tr>
		
		<?php 
		}
		else if(($row[1]>=20)&&($row[4]<0))
		{
		?>
		 <tr>
             <td><?php echo $row[2];?></td>                                        
             <td><?php echo rut_empresa($row[2]);?></td>
             <td><?php echo razon($row[2]);?></td>
             <td align="Right"><?php echo number_format(-1*$row[4]);?></td>
             <td align="Center"><a href="borrador.php?concepto=<?php echo $row[1];?>&id=<?php echo $row[0]; ?>&empresa=<?php echo $row[2]?>&monto=<?php echo -1*$row[4];?>&periodo=<?php echo $periodo;?>">Facturar</a></td>             
          </tr>
		
		<?php 
		}
}
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