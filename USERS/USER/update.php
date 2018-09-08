<html>
<head>
   <meta charset="utf-8">
   <title></title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
   <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
   <script>
      $(document).ready(function()
      {
         $("#mostrarmodal").modal("show");
      });
    </script>
</head>
<?php 
include("conexion.php");
  $fact=$_GET['fac']; 
  $periodo=$_GET['periodo'];
  $sta=$_GET['sta'];
  $sql1=mysql_query("SELECT * FROM status_factura WHERE descripcion LIKE '$sta'");
  $m=mysql_fetch_array($sql1);
  $id=$m[0];
  ?>
<body>
   <div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4>¿Desea Cambiar Status a Fact N° <?php echo $fact;?>?</h4>
           </div>
           <div class="modal-body">
       

           <form action="actualizar.php?factura=<?php echo $fact;?>&periodo=<?php echo $periodo;?>" class="form-horizontal" method="post">
        <div class="form-group">
        <label for="formGroup" class="col-sm-3 control-label">Status Actual</label>
        <div class="col-sm-4">
          <input type="text" name="caja" class="form-control" id="formGroup" value="<?php echo $sta; ?>" readonly="true" >
        </div>
      </div>
      
      <div class="form-group">
        <label for="formGroup" class="col-sm-3 control-label">Nuevo Status</label>
        <div class="col-sm-4">
          <?php $sql=mysql_query("SELECT * FROM status_factura WHERE id > $id");?>
          <SELECT name="status" class="form-control">
            <?php while ($row=mysql_fetch_array($sql)) {?>
            <option value="<?php echo $row[0]?>"><?php echo $row[1];?></option>
            <?php }?>
          </SELECT>


        </div>
      </div>
          
       </div>
           <div class="modal-footer">
             <button type="submit" class="btn btn-success btn-sm" aria-hidden="true"><span class="fa fa-search"></span>Update</button>

          <a href="listafacturas.php?periodo=<?php echo $periodo;?>" class="btn btn-danger btn-sm">Cerrar</a>
           </div>
         </form>
      </div>
   </div>
</div>
</body>
</html>