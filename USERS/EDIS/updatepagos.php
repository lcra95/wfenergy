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
  $id=$_GET['id']; 
  $pro=$_GET['pro'];

  ?>
<body>
   <div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4>¿Desea Actualizar el Pago N° <?php echo $id;?>?</h4>
           </div>
           <div class="modal-body">
       

           <form action="actualizarpago.php?id=<?php echo $id;?>&pro=<?php echo $pro;?>" class="form-horizontal" method="post">
        <div class="form-group">
        <label for="formGroup" class="col-sm-3 control-label">Numero de Factura</label>
        <div class="col-sm-4">
          <input type="text" name="factura" class="form-control" id="formGroup" require="true" >
        </div>
      </div>

          
       </div>
           <div class="modal-footer">
             <button type="submit" class="btn btn-success btn-sm" aria-hidden="true"><span class="fa fa-search"></span>Update</button>

          <a href="listapago.php?id=<?php echo $pro?>" class="btn btn-danger btn-sm">Cerrar</a>
           </div>
         </form>
      </div>
   </div>
</div>
</body>
</html>