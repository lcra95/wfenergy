<?php 
    //session_start();
    include_once ("Config.php");
    include_once ("../ADMON/head.php");
    $periodo = '2019-02-01';
?>
<body>
   <?php include_once ("../ADMON/head-nav-main.php");?><!--Menu Principal-->
   <div id="wrapper">
   <!-- Page Content -->
   <div id="page-content-wrapper">
   <div class="container well">
      <div class="row">
         <div class="col-sm-12">
            <ol class="breadcrumb">
               <li><a href="#">Inicio</a></li>
               <li><a href="#">Cuadro de Pagos</a></li>
               <!--<li class="active"><a href="#" data-toggle="modal" data-target="#ventana"><i class="fa fa-asterisk"></i> Nuevo Registro</a></li>
                  --> 
            </ol>
         </div>
      </div>
   </div>
   <div class="container well">
      <div class="row">
         <div class="col-sm-12">
            <div class="col-sm-12">
            </div>
            <div class="panel panel-default">
               <div class="panel-heading">
               </div>
               <div class="panel-body">
                  <div class="table-responsive table-bordered">
                     <table id="example" class="display" cellspacing="0" width="100%">
                        <thead>
                           <tr>
                              <th>Id</th>
                              <th>Concpeto</th>
                              <th>Carta SEN</th>
                              <th>Publicado</th>
                              <th>Monto</th>
                              <th>Detalle</th>
                           </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $bselect = "SELECT * FROM balance WHERE periodo = '$periodo'";
                            $result = $mysqli->query($bselect);
                            while ($row = mysqli_fetch_assoc($result)){ 
                        ?>
                           <tr>
                              <td><?php echo $row['tipo_fact'];?></td>
                              <td><?php echo utf8_encode($row['titulo']);?></td>
                              <td><a href="<?php echo $row['archivoCarta'];?>" target ="_blank"><?php echo $row['numeroCarta'];?></a></td>
                              <td><?php echo $row['fechaPublicacion'];?></td>
                              <td align ="right"><?php echo $row['monto'];?></td>
                              <td align = "center"><a href="detalle.php?periodo=<?php echo $periodo?>&id=<?php echo $row['tipo_fact']; $_SESSION['desc']= $row['titulo'];?>">Detalle</a></td> 
                           </tr>
                        <?php } ?>
                        </tbody>
                        <tfoot>
                           <!-- <tr>
                              <td><b>Totales:</b></td>
                              <td><b>Todos los Conceptos</b></td>
                              <td><b>Ingreso Neto</b></td>
                              <td><b>Egreso Neto</b></td>
                              <td colspan="2"><b>Margen Neto</b></td>
                           </tr> -->
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
