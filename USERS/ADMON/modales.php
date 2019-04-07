<div class="modal fade" id="ventana17" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content well">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">
<span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
</button>
<h3 class="modal-title" id="ModalLabel">Listado de Montos de Iva</h3>
</div>
<div class="modal-body">
  
   <div class="table-responsive table-bordered">
            <?php include('conexion.php');
            $sel=mysql_query("SELECT * FROM iva");
            $i=0;
            ?>
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Codigo</th>
            <th>Monto</th>
          
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
            
            <td aling="center"><a class="glyphicon glyphicon-pencil"></a> <A class="glyphicon glyphicon-trash"></a></td>                                                            
          </tr>
          <?php }?>

        </tbody>
      </table>
    </div>



</div>
</div>   
</div>
</div>

<div class="modal fade" id="ventana19" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content well">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">
<span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
</button>
<h3 class="modal-title" id="ModalLabel">Listado de Folios</h3>
</div>
<div class="modal-body">
  
   <div class="table-responsive table-bordered">
            <?php include('conexion.php');
            $sel=mysql_query("SELECT * FROM folio");
            $i=0;
            ?>
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Codigo</th>
            <th>Desde</th>
            <th>Hasta</th>
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
            <td><?php echo $row[2];?></td>
            <td><?php if($row[3]==1){ echo "ACTIVO";} else { echo "INACTIVO";}?></td>
            
            <td aling="center"><a class="glyphicon glyphicon-pencil"></a> 
            <A class="glyphicon glyphicon-trash" href="delete.php?id=dfo&ide=<?php echo $row[0];?>"></a></td>                                                            
          </tr>
          <?php }?>

        </tbody>
      </table>
    </div>



</div>
</div>   
</div>
</div>
           <?php $conp=mysql_query("SELECT * FROM folio");
                  $conts=mysql_num_rows($conp);
                  $codigos=$conts+1;
            ?>
<div class="modal fade" id="ventana18" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content well">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">
<span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
</button>
<h3 class="modal-title" id="ModalLabel">Nuevo Folio</h3>
</div>
<div class="modal-body">
  
      <form action="registros.php?id=rf" class="form-horizontal" method="post">
      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Codigo</label>
        <div class="col-sm-4">
        <input type="text" name="codigo" class="form-control" id="formGroup" value="<?php echo $codigos; ?>" readonly="true" >
        </div>
      </div>
      
      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Desde</label>
        <div class="col-sm-4">
        <input type="text" class="form-control" id="formGroup" placeholder="Desde" name="desde" required="true">
        </div>
      </div> 
      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Hasta</label>
        <div class="col-sm-4">
        <input type="text" class="form-control" id="formGroup" placeholder="Hasta" name="hasta" required="true">
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


<div class="modal fade" id="ventana20" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content well">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">
<span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
</button>
<h3 class="modal-title" id="ModalLabel">Nueva Filial</h3>
</div>
<div class="modal-body">
  
      <form action="registros.php?id=rfil" class="form-horizontal" method="post">

      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">RUT</label>
        <div class="col-sm-4">
        <input type="text" name="codigo" class="form-control" id="formGroup" placeholder="RUT" required="true"  >
        </div>
      </div>
      
      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Razón Social</label>
        <div class="col-sm-4">
        <input type="text" class="form-control" id="formGroup" placeholder="Razón Social" name="razon" required="true">
        </div>
      </div> 
            <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Dirección</label>
        <div class="col-sm-4">
        <input type="text" class="form-control" id="formGroup" placeholder="Direccion" name="direccion" required="true">
        </div>
      </div> 
      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Comuna</label>
        <div class="col-sm-4">
        <input type="text" class="form-control" id="formGroup" placeholder="Comuna" name="comuna" required="true">
        </div>
      </div> 
      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Ciudad</label>
        <div class="col-sm-4">
        <input type="text" class="form-control" id="formGroup" placeholder="Ciudad" name="ciudad" required="true">
        </div>
      </div>
            <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Teléfono</label>
        <div class="col-sm-4">
        <input type="text" class="form-control" id="formGroup" placeholder="Teléfono" name="contacto" required="true">
        </div>
      </div>
            <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-4">
        <input type="text" class="form-control" id="formGroup" placeholder="Email" name="email" required="true">
        </div>
      </div>
                  <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Sucursal</label>
        <div class="col-sm-4">
        <input type="text" class="form-control" id="formGroup" placeholder="Sucursal" name="sucursal" required="true">
        </div>
      </div>
      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Giro</label>
        <div class="col-sm-4">
        <input type="text" class="form-control" id="formGroup" placeholder="Giro" name="giro" required="true">
        </div>
      </div> 
      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Actividad Comercial</label>
        <div class="col-sm-4">
        <input type="text" class="form-control" id="formGroup" placeholder="Ateco" name="ateco" required="true">
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

<div class="modal fade" id="ventana21" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content well">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">
<span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
</button>
<h3 class="modal-title" id="ModalLabel">Listado de Filiales</h3>
</div>
<div class="modal-body">
  
   <div class="table-responsive table-bordered">
            <?php include('conexion.php');
            $sel=mysql_query("SELECT * FROM filial");
            $i=0;
            ?>
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Codigo</th>
            <th>Nombre</th>
            <th>Direccion</th>
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
            <td><?php echo $row[2];?></td>
            
            <td aling="center"><a class="glyphicon glyphicon-pencil"></a> 
            <A class="glyphicon glyphicon-trash" href="delete.php?id=dfi&ide=<?php echo $row[0];?>"></a></td>                                                            
          </tr>
          <?php }?>

        </tbody>
      </table>
    </div>



</div>
</div>   
</div>
</div>


<div class="modal fade" id="ventana22" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content well">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">
<span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
</button>
<h3 class="modal-title" id="ModalLabel">Nuevo Proveedor / Cliente</h3>
</div>
<div class="modal-body">
  
     <form action="registros.php?id=recp" class="form-horizontal" method="post">

        <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">ID</label>
        <div class="col-sm-4">
        <input type="text" name="ide" class="form-control" id="formGroup" placeholder="ID" required="true"  >
        </div>
      </div>
      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">RUT</label>
        <div class="col-sm-4">
        <input type="text" name="codigo" class="form-control" id="formGroup" placeholder="RUT" required="true"  >
        </div>
      </div>
      
      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Razón Social</label>
        <div class="col-sm-4">
        <input type="text" class="form-control" id="formGroup" placeholder="Razón Social" name="razon" required="true">
        </div>
      </div> 

            <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Cuenta</label>
        <div class="col-sm-4">
        <input type="text" class="form-control" id="formGroup" placeholder="Cuenta Bancaria" name="cuenta" required="true">
        </div>
      </div> 
      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Codigo</label>
        <div class="col-sm-4">
        <input type="text" class="form-control" id="formGroup" placeholder="Condigo de Cuenta Bancaria" name="codigoc" required="true">
        </div>
      </div> 
            <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Dirección</label>
        <div class="col-sm-4">
        <input type="text" class="form-control" id="formGroup" placeholder="Direccion" name="direccion" required="true">
        </div>
      </div> 
      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Comuna</label>
        <div class="col-sm-4">
        <input type="text" class="form-control" id="formGroup" placeholder="Comuna" name="comuna" required="true">
        </div>
      </div> 
      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Ciudad</label>
        <div class="col-sm-4">
        <input type="text" class="form-control" id="formGroup" placeholder="Ciudad" name="ciudad" required="true">
        </div>
      </div>
            <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Contacto</label>
        <div class="col-sm-4">
        <input type="text" class="form-control" id="formGroup" placeholder="Contacto" name="contacto" required="true">
        </div>
      </div>
      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-4">
        <input type="text" class="form-control" id="formGroup" placeholder="Email" name="email" required="true">
        </div>
      </div>
      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Giro</label>
        <div class="col-sm-4">
        <input type="text" class="form-control" id="formGroup" placeholder="Giro" name="giro" required="true">
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

<div class="modal fade" id="ventana23" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content well">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">
<span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
</button>
<h3 class="modal-title" id="ModalLabel">Listado de Proveedores / Clientes</h3>
</div>
<div class="modal-body">
  
   <div class="table-responsive table-bordered">
            <?php include('conexion.php');
            $sel=mysql_query("SELECT * FROM empresa");
            $i=0;
            ?>
      <table class="display" id="example2" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>#</th>
            <th>Codigo</th>
            <th>Nombre</th>
            <th>Direccion</th>
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
            <td><?php echo $row[2];?></td>
            
            <td aling="center"><a class="glyphicon glyphicon-pencil"></a> 
              <A href="delete.php?id=dcp&ide=<?php echo $row[0];?>"class="glyphicon glyphicon-trash"></a></td>                                                            
          </tr>
          <?php }?>

        </tbody>
      </table>
    </div>



</div>
</div>   
</div>
</div>




<div class="modal fade" id="Win1" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content well">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">
<span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
</button>
<h3 class="modal-title" id="ModalLabel">Nueva Referencia</h3>
</div>
<div class="modal-body">
  
      <form action="registros.php" class="form-horizontal" method="post">

      <input type="hidden" name="key" value="referencia">      
      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Código Referencia</label>
        <div class="col-sm-4">
        <input type="text" class="form-control" id="formGroup" placeholder="DE05562A18C40S0264" name="cod_ref" required="true">
        </div>
      </div>       
      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Emisor</label>
        <div class="col-sm-4">
        <input type="text" class="form-control" id="formGroup" placeholder="Emisor" name="emisor" value="SEN" readonly="true">
        </div>
      </div> 
      <div class="form-group">
        <label for="formGroup" class="col-sm-2 control-label">Fecha Emisión</label>
        <div class="col-sm-4">
        <input type="text" class="form-control" id="formGroup" placeholder="YYYY-MM-DD" name="fecha" required="true" >
        </div>
      </div> 
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
        <label for="formGroup" class="col-sm-2 control-label">Cuadro de Pagos</label>
        <div class="col-sm-4">
        <input type="text" class="form-control" id="formGroup" placeholder="SEN_[TEE_][Oct18][L][V01]" name="nemo" required="true">
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

<div class="modal fade" id="Win2" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content well">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">
<span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
</button>
<h3 class="modal-title" id="ModalLabel">Listado de Referencias</h3>
</div>
<div class="modal-body">
  
      <div class="table-responsive table-bordered">
            <?php include('conexion.php');
            $nsel=mysql_query("SELECT r.id, r.id_periodo,r.codigo_ref, r.emisor,r.nemotecnico, r.fecha, tt.descripcion FROM referencia r JOIN tipo_transaccion tt ON r.id_concepto = tt.id");
            $i=0;
            ?>
      <table class="display" id="example3" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>#</th>
            <th>Concepto</th>
            <th>Cod Referencia</th>
            <th>Cuadro de Pagos</th>
            <th>Emisor</th> 
            <th>Periodo</th>
            <th>Fecha</th>
            <th>Acción</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          while ($row=mysql_fetch_row($nsel)) {
            $i++; 
             ?>
          <tr>
            <td><?php echo $row[0];?></td>
            <td><?php echo $row[6];?></td>
            <td><?php echo $row[2];?></td>
            <td><?php echo $row[4];?></td>
            <td><?php echo $row[3];?></td>
            <td><?php echo $row[1];?></td>
            <td><?php echo $row[5];?></td>
            <td aling="center">
              <a href="#" class="glyphicon glyphicon-pencil"></a> 
              <A href="#" class="glyphicon glyphicon-trash"></a>
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







