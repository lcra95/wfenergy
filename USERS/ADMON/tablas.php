<?php 
include ("head.php");
include ("modales.php");
include ("funciones.php");

?>

<body>
  
<?php include("head-nav-main.php");?><!--Menu Principal-->
<div id="wrapper">

<!-- Sidebar -->

<!-- /#sidebar-wrapper -->
<!-- Page Content -->
<div id="page-content-wrapper">


    <div class="container well">
<div class="row">
<div class="col-lg-12">
  <ol class="breadcrumb">
    <li><a href="#">Inicio</a></li>
    <li><a href="#">Configurar</a></li>
    <li class="active">Tablas</li>
  </ol>
<div class="row">
  <div class="col-lg-12">
    <p class="<?php  @$color=$_GET['color'];  echo color($color);?>"><font class="<?php echo color($color);?>"><?PHP echo @$msg=$_GET['msg'];?></font></p>
  </div>  
</div>
  <div class="row">
    
    <div class="col-lg-3 col-md-6 col-xs-12">
      <div class="panel panel-primary">
        <div class="panel-heading">Periodo</div>
        <div class="panel-body">
          Registro y Consulta de Periodos
          <br>
          <a href="" class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#ventana2"></a>&nbsp;&nbsp;&nbsp;
          <a href="" class="glyphicon glyphicon-search" data-toggle="modal" data-target="#ventana3"></a>
        </div>
      </div>
    </div> 

    <div class="col-lg-3 col-md-6 col-xs-12">
      <div class="panel panel-primary">
        <div class="panel-heading">Transacciones</div>
        <div class="panel-body">
          Registro y Consulta de Transacciones
           <br>
          <a class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#ventana"></a>&nbsp;&nbsp;&nbsp;
          <a href="" data-toggle="modal" data-target="#" class="glyphicon glyphicon-search"></a>
        </div>
      </div>
    </div> 

    <div class="col-lg-3 col-md-6 col-xs-12">
      <div class="panel panel-primary">
        <div class="panel-heading">Grupo</div>
        <div class="panel-body">
          Registro y Consulta de Grupos de Transacciones 
           <br>
          <a href="" class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#ventana4"></a>&nbsp;&nbsp;&nbsp;<a href="" data-toggle="modal" data-target="#ventana5" class="glyphicon glyphicon-search"></a>
        </div>
      </div>
    </div>  

    <div class="col-lg-3 col-md-6 col-xs-12">
      <div class="panel panel-primary">
        <div class="panel-heading">Usuarios</div>
        <div class="panel-body">
          Registro y Consulta de Usuarios
           <br>
          <a href="" class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#ventana6"></a>&nbsp;&nbsp;&nbsp;<a href="" data-toggle="modal" data-target="#ventana7" class="glyphicon glyphicon-search"></a>
        </div>
      </div>
    </div> 

</div>   
<div class="row">
    <div class="col-lg-3 col-md-6 col-xs-12">
      <div class="panel panel-primary">
        <div class="panel-heading">Status de Facturas</div>
        <div class="panel-body">
          Registro y Consulta de Status de Facturas
          <br>
          <a href="" class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#ventana9"></a>&nbsp;&nbsp;&nbsp;
          <a href="" class="glyphicon glyphicon-search" data-toggle="modal" data-target="#ventana8"></a>
        </div>
      </div>
    </div>   

    <div class="col-lg-3 col-md-6 col-xs-12">
      <div class="panel panel-primary">
        <div class="panel-heading">Tipo de Transacciones</div>
        <div class="panel-body">
          Registro y Consulta de Tipos de Trasacciones
           <br>
          <a class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#ventana12"></a>&nbsp;&nbsp;&nbsp;
          <a href="" data-toggle="modal" data-target="#ventana13" class="glyphicon glyphicon-search"></a>
        </div>
      </div>
    </div>    

    <div class="col-lg-3 col-md-6 col-xs-12">
      <div class="panel panel-primary">
        <div class="panel-heading">Status de Pagos</div>
        <div class="panel-body">
         Registro y Consulta de Status de Pago
           <br>
          <a href="" class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#ventana14"></a>&nbsp;&nbsp;&nbsp;<a href="" data-toggle="modal" data-target="#ventana15" class="glyphicon glyphicon-search"></a>
        </div>
      </div>
    </div>   

    <div class="col-lg-3 col-md-6 col-xs-12">
      <div class="panel panel-primary">
        <div class="panel-heading">Niveles de Acceso</div>
        <div class="panel-body">
          Registro y Consulta de Niveles de Acceso
           <br>
          <a href="" class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#ventana11"></a>&nbsp;&nbsp;&nbsp;<a href="" data-toggle="modal" data-target="#ventana10" class="glyphicon glyphicon-search"></a>

        </div>
      </div>
    </div>     
</div>
<div class="row">
    <div class="col-lg-3 col-md-6 col-xs-12">
      <div class="panel panel-primary">
        <div class="panel-heading">IVA</div>
        <div class="panel-body">
          Registro y Consulta de IVA
          <br>
          <a href="" class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#ventana16"></a>&nbsp;&nbsp;&nbsp;
          <a href="" class="glyphicon glyphicon-search" data-toggle="modal" data-target="#"></a>
        </div>
      </div>
    </div>   

    <div class="col-lg-3 col-md-6 col-xs-12">
      <div class="panel panel-primary">
        <div class="panel-heading">Folio</div>
        <div class="panel-body">
          Registro y Consulta de Folios
           <br>
          <a class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#ventana18"></a>&nbsp;&nbsp;&nbsp;
          <a href="" data-toggle="modal" data-target="#ventana19" class="glyphicon glyphicon-search"></a>
        </div>
      </div>
    </div>    

    <div class="col-lg-3 col-md-6 col-xs-12">
      <div class="panel panel-primary">
        <div class="panel-heading">Filiales</div>
        <div class="panel-body">
         Registro y Consulta de Filiales
           <br>
          <a href="" data-toggle="modal" data-target="#ventana20" class="glyphicon glyphicon-plus"></a>&nbsp;&nbsp;&nbsp;
          <a href="" data-toggle="modal" data-target="#ventana21" class="glyphicon glyphicon-search"></a>
        </div>
      </div>
    </div>   

    <div class="col-lg-3 col-md-6 col-xs-12">
      <div class="panel panel-primary">
        <div class="panel-heading">Proveedores / Clientes</div>
        <div class="panel-body">
          Registro y Consulta de Proveedores / Clientes
           <br>
          <a href="" class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#ventana22"></a>&nbsp;&nbsp;&nbsp;
          <a href="" data-toggle="modal" data-target="#ventana23" class="glyphicon glyphicon-search"></a>

        </div>
      </div>
    </div>     
</div>
<div class="row">
    <div class="col-lg-3 col-md-6 col-xs-12">
      <div class="panel panel-primary">
        <div class="panel-heading">Referencias</div>
        <div class="panel-body">
          Registro de las referencias para facturación del SEN
          <br>
          <a href="" class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#Win1"></a>&nbsp;&nbsp;&nbsp;
          <a href="" class="glyphicon glyphicon-search" data-toggle="modal" data-target="#Win2"></a>
        </div>
      </div>
    </div>   

    <div class="col-lg-3 col-md-6 col-xs-12">
      <div class="panel panel-primary">
        <div class="panel-heading">No Asignado</div>
        <div class="panel-body">
           <br>
          <a class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#"></a>&nbsp;&nbsp;&nbsp;
          <a data-toggle="modal" data-target="#" class="glyphicon glyphicon-search"></a>
        </div>
      </div>
    </div>    

    <div class="col-lg-3 col-md-6 col-xs-12">
      <div class="panel panel-primary">
        <div class="panel-heading">No Asignado</div>
        <div class="panel-body">
           <br>
          <a href="" data-toggle="modal" data-target="#" class="glyphicon glyphicon-plus"></a>&nbsp;&nbsp;&nbsp;
          <a href="" data-toggle="modal" data-target="#" class="glyphicon glyphicon-search"></a>
        </div>
      </div>
    </div>   

    <div class="col-lg-3 col-md-6 col-xs-12">
      <div class="panel panel-primary">
        <div class="panel-heading">No Asignado</div>
        <div class="panel-body">

           <br>
          <a href="" class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#"></a>&nbsp;&nbsp;&nbsp;
          <a href="" data-toggle="modal" data-target="#" class="glyphicon glyphicon-search"></a>

        </div>
      </div>
    </div>     
</div>


<!-- /#page-content-wrapper -->


</div>

    <script src="js/jquery.js"></script>
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
  <script src="js/jquery-1.11.1.min.js"></script>
  <script src="js/bootstrap.js"></script>
</body>
</html>
<?php include("conexion.php");?>



<div class="modal fade" id="ventana" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content well">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">
<span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
</button>
              <h3 class="modal-title" id="ModalLabel">Cargar Transacciones</h3>
              <h4>Asegurese de no haber cargado este archivo previamente, selecciones el periodo y tipo de transaccion correcto</h4></div>
<div class="modal-body">
  
 <form action="control.php" class="form-horizontal" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Periodo</label>
        <div class="col-sm-4">
       <SELECT name="periodo" class="form-control">
      <?PHP 
      $per=mysql_query("SELECT * FROM periodo ORDER BY id DESC");
      ?>
      <option value="1">SELECCIONE</option>
      <?php while($rowa=mysql_fetch_array($per)){?>
      <option value="<?php echo $rowa[0];?>"><?php echo $rowa[0];?></option>
      <?php }?>
      </SELECT>
        </div>
      </div>

            <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Tipo de Transacción</label>
        <div class="col-sm-4">
      <SELECT name="tipo" class="form-control">
      <?PHP 
      $per=mysql_query("SELECT * FROM tipo_transaccion");
      ?>
      <?php while($rowa=mysql_fetch_array($per)){?>
      <option value="<?php echo $rowa[0];?>"><?php echo $rowa[1];?></option>
      <?php }?>
      </SELECT>
        </div>
      </div>

      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">File</label>
        <div class="col-sm-4">
        <input type='file' name='sel_file' size='20' class="btn btn-default btn-sm">
        </div>
      </div> 
      
      <br>
      <div class="form-group">
      <label for="formGroup" class="col-sm-2 control-label"></label>
      <div class="col-sm-4">
      <button type="submit" class="btn btn-success btn-sm" name='submit' ><span class="glyphicon glyphicon-floppy-saved"></span> Submit</button>
      <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove-circle" ></span>Cancelar</button>  

      </div>
      </div>
    </form>



</div>
</div>   
</div>
</div>



<div class="modal fade" id="ventana2" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content well">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">
<span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
</button>
<h3 class="modal-title" id="ModalLabel">Nuevo Periodo</h3>
</div>
<div class="modal-body">
  
      <form action="registros.php?id=rp" class="form-horizontal" method="post">
      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Codigo</label>
        <div class="col-sm-4">
        <input type="text" name="codigo" class="form-control" id="formGroup" value="" placeholder="AAAA-MM" required="true" >
        </div>
      </div>
      
      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Nombre</label>
        <div class="col-sm-4">
        <input type="text" class="form-control" id="formGroup" placeholder="Nombre" name="nombre" required="true">
        </div>
      </div> 
        <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Status</label>
        <div class="col-sm-4">

          <select name="status" id="sel" class="form-control">
            <option value="1">Activar</option>  
            <option value="0">Desactivar</option>           
           
          </select>
        </div>
      </div>
      <br>
      <div class="form-group">
      <label for="formGroup" class="col-sm-2 control-label"></label>
      <div class="col-sm-4">
      <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-floppy-saved"></span>Guardar</button>
      <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove-circle" ></span>Cancelar</button>  


      </div>
      </div>
    </form>



</div>
</div>   
</div>
</div>

<div class="modal fade" id="ventana3" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content well">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">
<span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
</button>
<h3 class="modal-title" id="ModalLabel">Listado de Periodo</h3>
</div>
<div class="modal-body">
  
      <div class="table-responsive table-bordered">
            <?php include('conexion.php');
            $sel=mysql_query("SELECT * FROM periodo");
            $i=0;
            ?>
      <table class="display" id="example" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>#</th>
            <th>Codigo</th>
            <th>Nombre</th>
            <th>Status</th>
            <th>Acción</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          while ($row=mysql_fetch_row($sel)) {
            $i++; 
            ?>
          <tr>
            <td><?php echo $i;?></td>
            <td><?php echo $row[0];?></td>
            <td><?php echo $row[1];?></td>
            <td><?php if($row[2]==1){echo "ACTIVO";}else{echo "INACTIVO";}?></td>
            <td aling="center"><a class="glyphicon glyphicon-pencil"></a>
            <a href="delete.php?id=udpe&ide=<?php echo $row[0];?>" class="glyphicon glyphicon-ok" alt="Activar"></a> 
            <A class="glyphicon glyphicon-trash" href="delete.php?id=dp&ide=<?php echo $row[0];?>"></a>
            </td>                                                            
          </tr>
          <?php }?>

        </tbody>
      </table>
    </div>



</div>
</div>   
</div>
</div>

<div class="modal fade" id="ventana4" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content well">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">
<span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
</button>
<h3 class="modal-title" id="ModalLabel">Nuevo Grupo Transacción</h3>
</div>
<div class="modal-body">
  
           <?php $conp=mysql_query("SELECT * FROM grupo_transaccion");
                  $conts=mysql_num_rows($conp);
                  $codigos=$conts+1;
            ?>
              
      <form action="registros.php?id=rg" class="form-horizontal" method="post">
      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Codigo</label>
        <div class="col-sm-4">
        <input type="text" name="codigo" class="form-control" id="formGroup" value="<?php echo $codigos;?>" readonly="true" >
        </div>
      </div>
      
      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Nombre</label>
        <div class="col-sm-4">
        <input type="text" class="form-control" id="formGroup" placeholder="Nombre" name="nombre">
        </div>
      </div> 
      
      <br>
      <div class="form-group">
      <label for="formGroup" class="col-sm-2 control-label"></label>
      <div class="col-sm-4">
      <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-floppy-saved"></span>Guardar</button>
      <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove-circle" ></span>Cancelar</button>  
      </div>
      </div>
    </form> 



</div>
</div>   
</div>
</div>

<div class="modal fade" id="ventana5" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content well">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">
<span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
</button>
<h3 class="modal-title" id="ModalLabel">Listado de Grupos de Transacciones</h3>
</div>
<div class="modal-body">
  

    <div class="table-responsive table-bordered">
            <?php include('conexion.php');
            $sel=mysql_query("SELECT * FROM grupo_transaccion");
            $i=0;
            ?>
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Codigo</th>
            <th>Nombre</th>            
            <th>Acción</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          while ($row=mysql_fetch_row($sel)) {
            $i++; 
            ?>
          <tr>
            <td><?php echo $i;?></td>
            <td><?php echo $row[0];?></td>
            <td><?php echo $row[1];?></td>
            <td aling="center"><a class="glyphicon glyphicon-pencil"></a> 
<A class="glyphicon glyphicon-trash" href="delete.php?id=dg&ide=<?php echo $row[0];?>"></a></td>                                                            
          </tr>
          <?php }?>

        </tbody>
      </table>
    </div>


</div>
</div>   
</div>
</div>

<div class="modal fade" id="ventana6" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content well">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">
<span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
</button>
<h3 class="modal-title" id="ModalLabel">Nuevo Usuario</h3>
</div>
<div class="modal-body">
  
            <?php $conp=mysql_query("SELECT * FROM filial");
               
            ?>
              
      <form action="registros.php?id=ru" class="form-horizontal" method="post">
            <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Nombre</label>
        <div class="col-sm-4">
        <input type="text" class="form-control" id="formGroup" placeholder="Nombre" name="nombre">
        </div>
      </div> 

      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Apellido</label>
        <div class="col-sm-4">
        <input type="text" name="apellido" class="form-control" id="formGroup" placeholder="Apellido">
        </div>
      </div>
    
      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-4">
        <input type="text" class="form-control" id="formGroup" placeholder="Email" name="email">
        </div>
      </div> 
            <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Filial</label>
        <div class="col-sm-4">
          <select name="filial" id="sel" class="form-control">
          <?php 
          while($roo=mysql_fetch_array($conp))
          {
            ?>
          <option value="<?php echo $roo[0];?>"><?php echo $roo[1];?></option>
          <?php
        }
          ?>
          </select>
        </div>
      </div>
       <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Nivel de Acceso</label>
        <div class="col-sm-4">
          <select name="nivel" id="sel" class="form-control">
          <?php 
          $cnp=mysql_query("SELECT * FROM nivel_acceso");
          while($ro=mysql_fetch_array($cnp))
          {
            ?>
          <option value="<?php echo $ro[0];?>"><?php echo $ro[1];?></option>
          <?php
        }
          ?>
          </select>
        </div>
      </div>

      <br>
      <div class="form-group">
      <label for="formGroup" class="col-sm-2 control-label"></label>
      <div class="col-sm-4">
      <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-floppy-saved"></span>Guardar</button>
      <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove-circle" ></span>Cancelar</button>  
      </div>
      </div>
    </form> 



</div>
</div>   
</div>
</div>

<div class="modal fade" id="ventana7" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content well">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">
<span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
</button>
<h3 class="modal-title" id="ModalLabel">Listado de Usuarios</h3>
</div>
<div class="modal-body">
  

        <div class="table-responsive table-bordered">
            <?php include('conexion.php');
            $sel=mysql_query("SELECT * FROM usuario");
            $i=0;
            ?>
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Indicador</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Teléfono</th>
            <th>Filial</th>
            <th>Acción</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          while ($row=mysql_fetch_row($sel)) {
            $i++; 
            ?>
          <tr>
            <td><?php echo $i;?></td>
            <td><?php echo $row[0];?></td>
            <td><?php echo $row[2];?></td>
            <td><?php echo $row[3];?></td>
            <td><?php echo $row[4];?></td>
            <td><?php   
            $sql22=mysql_query("SELECT * FROM filial WHERE rut LIKE '$row[6]'");
  $dta=mysql_fetch_array($sql22);
 echo  $dta[1];
;?></td>
            <td aling="center"><a class="glyphicon glyphicon-pencil"></a> 
              <A class="glyphicon glyphicon-trash" href="delete.php?id=du&ide=<?php echo $row[0];?>"></a>
              </td>                                                            
          </tr>
          <?php }?>

        </tbody>
      </table>
    </div>


</div>
</div>   
</div>
</div>

<div class="modal fade" id="ventana8" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content well">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">
<span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
</button>
<h3 class="modal-title" id="ModalLabel">Listado de Status de Facturas</h3>
</div>
<div class="modal-body">
  
<div class="table-responsive table-bordered">
            <?php
            $sel=mysql_query("SELECT * FROM status_factura");
            $i=0;
            ?>
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Codigo</th>
            <th>Nombre</th>            
            <th>Acción</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          while ($row=mysql_fetch_row($sel)) {
            $i++; 
            ?>
          <tr>
            <td><?php echo $i;?></td>
            <td><?php echo $row[0];?></td>
            <td><?php echo $row[1];?></td>
            <td aling="center"><a class="glyphicon glyphicon-pencil"></a> 
            <A class="glyphicon glyphicon-trash" href="delete.php?id=dsf&ide=<?php echo $row[0];?>"></a></td>                                                            
          </tr>
          <?php }?>

        </tbody>
      </table>
    </div>



</div>
</div>   
</div>
</div>

<div class="modal fade" id="ventana9" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content well">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">
<span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
</button>
<h3 class="modal-title" id="ModalLabel">Nuevo Status de Factura</h3>
</div>
<div class="modal-body">
  
           <?php $conp=mysql_query("SELECT * FROM status_factura");
                  $conts=mysql_num_rows($conp);
                  $codigos=$conts+1;
            ?>
              
      <form action="registros.php?id=rsf" class="form-horizontal" method="post">
      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Codigo</label>
        <div class="col-sm-4">
        <input type="text" name="codigo" class="form-control" id="formGroup" value="<?php echo $codigos;?>" readonly="true" >
        </div>
      </div>
      
      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Nombre</label>
        <div class="col-sm-4">
        <input type="text" class="form-control" id="formGroup" placeholder="Nombre" name="nombre">
        </div>
      </div> 
      
      <br>
      <div class="form-group">
      <label for="formGroup" class="col-sm-2 control-label"></label>
      <div class="col-sm-4">
      <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-floppy-saved"></span>Guardar</button>
      <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove-circle" ></span>Cancelar</button>  
      </div>
      </div>
    </form> 




</div>
</div>   
</div>
</div>


<div class="modal fade" id="ventana10" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content well">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">
<span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
</button>
<h3 class="modal-title" id="ModalLabel">Listado de Niveles de Usuarios</h3>
</div>
<div class="modal-body">
<div class="table-responsive table-bordered">
            <?php
            $sel=mysql_query("SELECT * FROM nivel_acceso");
            $i=0;
            ?>
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Codigo</th>
            <th>Nombre</th>            
            <th>Acción</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          while ($row=mysql_fetch_row($sel)) {
            $i++; 
            ?>
          <tr>
            <td><?php echo $i;?></td>
            <td><?php echo $row[0];?></td>
            <td><?php echo $row[1];?></td>
            <td aling="center"><a class="glyphicon glyphicon-pencil"></a>
            <A class="glyphicon glyphicon-trash" href="delete.php?id=dnu&ide=<?php echo $row[0];?>"></a></td>                                                            
          </tr>
          <?php }?>

        </tbody>
      </table>
    </div>


</div>
</div>   
</div>
</div>

<div class="modal fade" id="ventana11" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content well">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">
<span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
</button>
<h3 class="modal-title" id="ModalLabel">Nuevo Nivel de Acceso</h3>
</div>
<div class="modal-body">
            <?php $conp=mysql_query("SELECT * FROM nivel_acceso");
                  $conts=mysql_num_rows($conp);
                  $codigos=$conts+1;
            ?>
              
      <form action="registros.php?id=rna" class="form-horizontal" method="post">
      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Codigo</label>
        <div class="col-sm-4">
        <input type="text" name="codigo" class="form-control" id="formGroup" value="<?php echo $codigos;?>" readonly="true" >
        </div>
      </div>
      
      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Nombre</label>
        <div class="col-sm-4">
        <input type="text" class="form-control" id="formGroup" placeholder="Nombre" name="nombre">
        </div>
      </div> 
      
      <br>
      <div class="form-group">
      <label for="formGroup" class="col-sm-2 control-label"></label>
      <div class="col-sm-4">
      <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-floppy-saved"></span>Guardar</button>
      <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove-circle" ></span>Cancelar</button>  
      </div>
      </div>
    </form> 
</div>
</div>   
</div>
</div>


<div class="modal fade" id="ventana12" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content well">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">
<span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
</button>
<h3 class="modal-title" id="ModalLabel">Nuevo Tipo de Transaccion</h3>
</div>
<div class="modal-body">
  

 <form action="registros.php?id=rtt" class="form-horizontal" method="post">
      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Codigo</label>
        <div class="col-sm-4">
        <input type="text" name="codigo" class="form-control" id="formGroup" >
        </div>
      </div>
      
      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Nombre</label>
        <div class="col-sm-4">
        <input type="text" class="form-control" id="formGroup" placeholder="Nombre" name="nombre" required="true">
        </div>
      </div> 
            <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Grupo de Transacción</label>
        <div class="col-sm-4">
      <SELECT name="grupo" class="form-control">
      <?PHP 
      $per=mysql_query("SELECT * FROM grupo_transaccion");
      ?>
      <?php while($rowa=mysql_fetch_array($per)){?>
      <option value="<?php echo $rowa[0];?>"><?php echo $rowa[1];?></option>
      <?php }?>
      </SELECT>
        </div>
      </div>
      <br>
      <div class="form-group">
      <label for="formGroup" class="col-sm-2 control-label"></label>
      <div class="col-sm-4">
      <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-floppy-saved"></span>Guardar</button>
      <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove-circle" ></span>Cancelar</button>  


      </div>
      </div>
    </form>



</div>
</div>   
</div>
</div>

<div class="modal fade" id="ventana13" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content well">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">
<span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
</button>
<h3 class="modal-title" id="ModalLabel">Listado de Tipos de Transacciones</h3>
</div>
<div class="modal-body">
  
 <div class="table-responsive table-bordered">
            <?php include('conexion.php');
            $sel=mysql_query("SELECT * FROM tipo_transaccion");
            $i=0;
            ?>
      <table class="display" id="example1" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>#</th>
            <th>Codigo</th>
            <th>Nombre</th>
            <th>Status</th>
            <th>Acción</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            while ($row=mysql_fetch_row($sel)) {
            $i++; 
          ?>
          <tr>
            <td><?php echo $i;?></td>
            <td><?php echo $row[0];?></td>
            <td><?php echo $row[1];?></td>
            <td><?php echo grupo($row[0]);?></td>
            <td aling="center">
              <a class="glyphicon glyphicon-pencil"></a> 
              <A class="glyphicon glyphicon-trash" href="delete.php?id=dtt&ide=<?php echo $row[0]; ?>"></a></td>                                                            
          </tr>
            <?php }?>
        </tbody>
      </table>

    </div>




</div>
</div>   
</div>
</div>


<div class="modal fade" id="ventana14" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content well">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">
<span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
</button>
<h3 class="modal-title" id="ModalLabel">Nuevo Status de Pago</h3>
</div>
<div class="modal-body">
  
        <?php $conp=mysql_query("SELECT * FROM status_pago");
                  $conts=mysql_num_rows($conp);
                  $codigos=$conts+1;
            ?>
              
      <form action="registros.php?id=rsp" class="form-horizontal" method="post">
      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Codigo</label>
        <div class="col-sm-4">
        <input type="text" name="codigo" class="form-control" id="formGroup" value="<?php echo $codigos;?>" readonly="true" >
        </div>
      </div>
      
      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Nombre</label>
        <div class="col-sm-4">
        <input type="text" class="form-control" id="formGroup" placeholder="Nombre" name="nombre" required="true">
        </div>
      </div> 
      
      <br>
      <div class="form-group">
      <label for="formGroup" class="col-sm-2 control-label"></label>
      <div class="col-sm-4">
      <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-floppy-saved"></span>Guardar</button>
      <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove-circle" ></span>Cancelar</button>  
      </div>
      </div>
    </form> 





</div>
</div>   
</div>
</div>

<div class="modal fade" id="ventana15" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content well">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">
<span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
</button>
<h3 class="modal-title" id="ModalLabel">Listado de Status de Pagos</h3>
</div>
<div class="modal-body">
  
<div class="table-responsive table-bordered">
            <?php
            $sel=mysql_query("SELECT * FROM status_pago");
            $i=0;
            ?>
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Codigo</th>
            <th>Nombre</th>            
            <th>Acción</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          while ($row=mysql_fetch_row($sel)) {
            $i++; 
            ?>
          <tr>
            <td><?php echo $i;?></td>
            <td><?php echo $row[0];?></td>
            <td><?php echo $row[1];?></td>
            <td aling="center"><a class="glyphicon glyphicon-pencil"></a>
            <A class="glyphicon glyphicon-trash" href="delete.php?id=dsp&ide=<?php echo $row[0];?>"></a></td>                                                            
          </tr>
          <?php }?>

        </tbody>
      </table>
    </div>



</div>
</div>   
</div>
</div>

<div class="modal fade" id="ventana16" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content well">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">
<span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
</button>
              <h3 class="modal-title" id="ModalLabel">Monto de IVA</h3>
              <div class="modal-body">
  

           <?php $conp=mysql_query("SELECT * FROM iva");
           $row=mysql_fetch_array($conp);
           $codigos=$row[0];
              ?>
              
      <form action="registros.php?id=riv" class="form-horizontal" method="post">
      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Codigo</label>
        <div class="col-sm-4">
        <input type="text" name="codigo" class="form-control" id="formGroup" value="<?php echo $codigos;?>" readonly="true" >
        </div>
      </div>
      
      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Monto</label>
        <div class="col-sm-4">
        <input type="text" class="form-control" id="formGroup" placeholder="Nombre" name="nombre" value="<?php echo $row[1];?>" required="true">
        </div>
      </div> 
      
      <br>
      <div class="form-group">
      <label for="formGroup" class="col-sm-2 control-label"></label>
      <div class="col-sm-4">
      <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-floppy-saved"></span>Guardar</button>
      <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove-circle" ></span>Cancelar</button>  
      </div>
      </div>
    </form> 
 



</div>
</div>   
</div>
</div>


<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable();
    $('#example1').DataTable();
    $('#example2').DataTable();
    $('#example3').DataTable();
} );

</script>