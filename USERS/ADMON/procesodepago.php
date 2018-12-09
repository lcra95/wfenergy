<?php 
include("conexion.php");
include("funciones.php");
include("head.php");

?>

<body>
  
<?php include("head-nav-main.php");?><!--Menu Principal-->
<div id="wrapper">

<!-- Page Content -->
<div id="page-content-wrapper">
<?php 

$t=$_SESSION["id"];

?>

<div class="container well">
<div class="row">
  <ol class="breadcrumb">
    <li><a href="#">Inicio</a></li>
    <li><a href="#">Pagos</a></li>
    <li><a href="#">Procesos de Pago</a></li>
    <li class="active"><a href="#" data-toggle="modal" data-target="#ventana"><i class="fa fa-asterisk"></i> Nuevo Proceso de Pago</a></li>
 
  </ol>
<div class="col-sm-12">

   
 
      </div>

      <div class="panel panel-default">
        <div class="panel-heading">
       <h4> LISTA DE PROCESOS DE PAGOS</h4> 
     
        </div>
        <div class="panel-body">
          <div class="table-responsive table-bordered">
 <p class="<?php  @$color=$_GET['color'];  echo color($color);?>"><font class="<?php echo color($color);?>"><?PHP echo @$msg=$_GET['msg'];?></font></p>

            <?php include('conexion.php');

?>
<table id="example" class="display" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>ID</th>
            <th>Fecha Inicio</th>
            <th>Fecha Cierre</th>
            <th>Pagos</th>
            <th>Status</th>

          </tr>
        </thead>
  <tbody>
  	<?php $i=0;$sel=mysql_query("SELECT * FROM `proceso_pago`");
		while($row=mysql_fetch_array($sel))
		{
			$i++;
			$sql=mysql_query("SELECT * FROM pago WHERE id_proceso_pago = $row[0]");
			$k=mysql_num_rows($sql);
	?>
       
          <tr> 
            <td align="center"><a href="listapago.php?id=<?php echo $row[0];?>"><?php echo $row[0];?></a></td>
            <td align="center"><?php echo $row[4];?></td>
            <td  align="center"></td>
            <td align="center"><?php echo $k;?></td>
            <td align="center"><?php echo status_pago($row[2]);?></td>                                                      
          </tr>
   
   <?php }?>
        </tbody>
     
                <tfoot>
          <tr>
            <th>ID</th>
            <th>Fecha Inicio</th>
            <th>Fecha Cierre</th>
            <th>Pagos</th>
            <th>Status</th>

          </tr>
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




<div class="modal fade" id="ventana" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content well">
 
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
              <h3 class="modal-title" id="ModalLabel">Nuevo Proceso de Pago</h3>
            </div>

            <div class="modal-body">
              
           <form action="new_pay_process.php" class="form-horizontal" method="post">
      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">N° de Cuenta</label>
        <div class="col-sm-4">
          <input type="text" name="cuenta" class="form-control" id="formGroup" placeholder="Numero de Cuenta" required="true" >
        </div>
      </div>
      
      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Fecha</label>
        <div class="col-sm-4">
          <input  type="text" class="form-control" id="formGroup" placeholder="Nombre" name="fecha" value="<?php echo date('Y-m-d');?>" readonly="true">
        </div>
      </div>

            <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Descripción</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" id="formGroup" placeholder="Detalles del Proceso" name="detalle" value="" required="true" >
        </div>
      </div>
      <br>

      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label"></label>
        <div class="col-sm-4">
          <button type="submit" class="btn btn-success btn-sm" aria-hidden="true"><span class="glyphicon glyphicon-floppy-saved"></span>Guardar</button>
             <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove-circle" ></span>Cancelar</button>

        </div>
      </div>
      
    </form> 
            </div> 
          </div>
        </div>
      </div>

 


</body>
</html>