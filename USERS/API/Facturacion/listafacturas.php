<?php 
session_start();
include("conexion.php");
include("funciones.php");
include("head.php");
if(isset($_SESSION['msg'])){
  $msg=$_SESSION['msg'];
  echo "<script> alert('$msg')</script>"; 
  unset($_SESSION['msg']);
}
?>
<body>
  
  <?php include("head-nav-main.php");?><!--Menu Principal-->
  <div id="wrapper">

    <div id="page-content-wrapper">
      <div class="container well">
        <div class="row">
          <div class="col-sm-12">

            <ol class="breadcrumb">
              <li><a href="#">Inicio</a></li>
                <li><a href="#">Lista de Facturas</a></li>
            </ol>
          </div>

    <div class="col-sm-12">
      <div class="panel panel-default">
          <div class="panel-heading">
            <h4> LISTADO DE FACTURAS</h4> 
          </div>
          <div class="panel-body">
            <div class="table-responsive table-bordered">
              <?php 
              $sel=mysql_query("SELECT * FROM `factura`");
              $sel1=mysql_query("SELECT * FROM nota_credito");
              $sel2=mysql_query("SELECT * FROM nota_debito");
              ?>
              <table id="example" class="display" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th align="Center">DTE N°</th>
                    <th align="center">Tipo</th>
                    <th align="Center">Fecha</th>
                    <th align="Center">Razón Social</th>
                    <th align="Center">Rut</th>
                    <th align="Center">Monto</th>
                    <th align="Center">IVA</th>
                    <th align="Center">Total</th>
                    <th align="Center">Ver</th>
                    <th align="Center">X</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                      while($q=mysql_fetch_array($sel)){    
                    
                        $t=ultimo_status($q[0]);
                        list($rut,$razon)=ultimate_empresa($q[5]);
                        $color=cambia_color($t);
                    ?>
                    <tr>
                      <?php 
                        $codFac=mysql_query("SELECT * FROM factura_docs WHERE id_factura = $q[0]");
                        $codFact=mysql_fetch_array($codFac);
                      ?>

                      <td align="Center"><?php echo $q[0];?></td>      
                      <td align="Center">33</td>
                      <td align="Center"><?php echo $q[3];    ?></td>                                   
                      <td><?php  echo $razon;  ?></td>
                      <td><?php  echo $rut;
                            list($totext,$totex,$ivat,$total,$iva)=ultimate_montos($q[0]);
                          ?>
                      </td>
                      <td align="Right"><?php echo number_format($totext);?></td>
                      <td align="Right"><?php echo number_format($ivat);?></td>
                      <td align="Right"><?php echo number_format($total);?></td>
                      <td align="Center" class="<?php echo $color; ?>">
                        <a target="_blank" href="<?php echo $codFact[2]?>" class="fa fa-file-text"></a>
                        <a target="_blank" class="fa fa-file-code-o" target="_blank" href="decoder.php?id=<?php echo $q[0];?>"></a>         
                      </td> 
                      <td align="Center">
                        <a href="nota_credito.php?id=<?php echo $q[0];?>" class="fa fa-trash"></a>            
                      </td>
                                
                    </tr>
                    <?php } ?>
                    <?php 
                      while($data=mysql_fetch_array($sel1)){
                        list($totext,$totex,$ivat,$total,$iva)=ultimate_montos($data[4]);
                        $emp=empresaNota($data[4]);
                        list($rut,$razon)=ultimate_empresa($emp);
                     
                        $codFac=mysql_query("SELECT * FROM factura_docs WHERE id_factura = $data[1]");
                        $codFact=mysql_fetch_array($codFac);
                    ?>
                    <tr>
                        <td align="center"><?php echo $data[1];?></td>
                        <td align="center"><?php echo $data[2];?></td>
                        <td align="center"><?php echo $data[5];?></td>
                        <td><?php  echo $razon;  ?></td>
                        <td><?php  echo $rut;  ?></td>
                        <td align="Right"><?php echo number_format($totext);?></td>
                        <td align="Right"><?php echo number_format($ivat);?></td>
                        <td align="Right"><?php echo number_format($total);?></td>
                        <td align="Center" class="<?php echo $color; ?>">
                        <a target="_blank" href="<?php echo $codFact[2]?>" class="fa fa-file-text"></a>
                        <a target="_blank" class="fa fa-file-code-o" target="_blank" href="decoder.php?id=<?php echo $q[0];?>"></a>         
                        </td> 
                        <td align="Center">
                          <a href="nota_debito.php?id=<?php echo $data[1];?>" class="fa fa-trash"></a>            
                        </td>                        
                    </tr>
                      <?php } ?>    
                      <?php 
                      while($data=mysql_fetch_array($sel2)){
                       
                        $datos=notaDatos($data[4]);
                        list($totext,$totex,$ivat,$total,$iva)=ultimate_montos($datos);
                        $emp=empresaNota($datos);
                        list($rut,$razon)=ultimate_empresa($emp);
                     
                        $codFac=mysql_query("SELECT * FROM factura_docs WHERE id_factura = $data[1]");
                        $codFact=mysql_fetch_array($codFac);
                    ?>
                    <tr>
                        <td align="center"><?php echo $data[1];?></td>
                        <td align="center"><?php echo $data[2];?></td>
                        <td align="center"><?php echo $data[5];?></td>
                        <td><?php  echo $razon;  ?></td>
                        <td><?php  echo $rut;  ?></td>
                        <td align="Right"><?php echo number_format($totext);?></td>
                        <td align="Right"><?php echo number_format($ivat);?></td>
                        <td align="Right"><?php echo number_format($total);?></td>
                        <td align="Center" class="<?php echo $color; ?>">
                        <a target="_blank" href="<?php echo $codFact[2]?>" class="fa fa-file-text"></a>
                        <a target="_blank" class="fa fa-file-code-o" target="_blank" href="decoder.php?id=<?php echo $q[0];?>"></a>         
                        </td> 
                        <td align="Center">
                          <a href="nota_debito.php?id=<?php echo $data[1];?>" class="fa fa-trash"></a>            
                        </td>                        
                    </tr>
                      <?php } ?>    
                  </tbody>
              </table>      
            </div>
          </div>
        </div>
    </div>                    
  </div>        
</body> 
<script>
  $("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
  });
</script>
<script src="js/bootstrap.js"></script>
</html>



