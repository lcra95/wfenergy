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
$tpr=mysql_query("SELECT id FROM periodo WHERE activo = 1");
$tte=mysql_fetch_array($tpr);
 if(@$periodo=$_GET['periodo']==""){
   $periodo=$tte[0];
 }else {
   @$periodo=$_GET['periodo'];
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
    <form action="listafacturas.php" method="get">            
            <div class="panel panel-default">

               <div class="panel-heading">
                  <h4> SELECCIONE PERIODO</h4>
               </div>
               <div class="panel-body">
               
                     <table width="100%">
                        <tr>
                           <td rowspan="2" valign="top" width="65%">
                              <SELECT name="periodo" >
                                 <?PHP 
                                    $per=mysql_query("SELECT * FROM periodo  ORDER BY id DESC");
                                    ?>
                                 <h4>
                                    <option value="<?php echo @$periodo;?>"><?php echo @$periodo;?></option>
                                 </h4>
                                 <?php while($rowa=mysql_fetch_array($per)){?>
                                 <h4>
                                    <option value="<?php echo $rowa[0];?>"><?php echo $rowa[0];?></option>
                                 </h4>
                                 <?php }?>
                              </SELECT>
                           </td>
                           <td align="center">
                              
                           </td>
                           <td align="center">
                             
                           </td>
                        </tr>
                        <tr>
                           <td align="right"></td>
                           <td align="right"></td>
                        </tr>
                     </table>
               </div>
            </div>
            <div class="panel-footer">  
            <button type="submit" class="btn btn-success btn-sm" aria-hidden="true"><span class="fa fa-search"></span>Ver Info</button>  
            </div>
          </form>
    
    </div>
    <div class="col-sm-12">
      <div class="panel panel-default">
          <div class="panel-heading">
            <h4> LISTADO DE FACTURAS <?php echo @$periodo;?></h4> 
          </div>
          <div class="panel-body">
            <div class="table-responsive table-bordered">
              <?php 
              $sel=mysql_query("SELECT * FROM `factura` WHERE id_periodo = '$periodo'");
              $sel1=mysql_query("SELECT nc.* FROM nota_credito nc JOIN factura f on nc.num_doc_ref = f.id AND f.id_periodo = '$periodo' ");
              $sel2=mysql_query("SELECT nd.* FROM nota_debito nd JOIN nota_credito nc on nd.num_doc_ref = nc.folio JOIN factura f on f.id = nc.num_doc_ref and f.id_periodo = '$periodo'");
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
                        <a target="_blank" class="fa fa-file-code-o" target="_blank" href="<?php echo $codFact[1]?>"></a>         
                      </td> 
                      <td align="Center">
                        <a href="nota_credito.php?id=<?php echo $q[0];?>" class="fa fa-trash" onclick="return confirm('¿Esta Seguro que Deseas Anularlo?')"></a>            
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
                        <td align="Center" class="<?php echo @$color; ?>">
                        <a target="_blank" href="<?php echo $codFact[2]?>" class="fa fa-file-text"></a>
                        <a target="_blank" class="fa fa-file-code-o" target="_blank" href="decoder.php?id=<?php echo $q[0];?>"></a>         
                        </td> 
                        <td align="Center">
                          <a href="nota_debito.php?id=<?php echo $data[1];?>" class="fa fa-trash" onclick="return confirm('¿Esta Seguro que Deseas Anularlo?')"></a>            
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
                        <td align="Center" class="<?php echo @$color; ?>">
                        <a target="_blank" href="<?php echo $codFact[2]?>" class="fa fa-file-text"></a>
                        <a target="_blank" class="fa fa-file-code-o" target="_blank" href="decoder.php?id=<?php echo $q[0];?>"></a>         
                        </td> 
                        <td align="Center">
                          <a href="nota_credito1.php?id=<?php echo $data[1];?>" class="fa fa-trash" onclick="return confirm('¿Esta Seguro que Deseas Anularlo?')"></a>            
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



