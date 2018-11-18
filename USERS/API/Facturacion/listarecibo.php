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
                <li><a href="#">Lista de Facturas Recibidas</a></li>
            </ol>
          </div>

    <div class="col-sm-12">
      <div class="panel panel-default">
          <div class="panel-heading">
            <h4> LISTADO DE FACTURAS RECIBIDAS</h4> 
          </div>
          <div class="panel-body">
            <div class="table-responsive table-bordered">
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
                        $sql='SELECT fr.folio, fr.fechaemision, fr.tipo, fr.rut_emisor, a.razonsocial, fr.neto, fr.iva, fr.total, fr.exento 
                        FROM factura_recibida fr 
                        JOIN acreedor a ON fr.rut_emisor = a.rut_acreedor';
                        $sel=mysql_query($sql);
                        $array=array();
                        while($data=mysql_fetch_array($sel)){
                    ?>
                    <tr>
                      <td align="Center"><?php echo $data['folio'];?></td>      
                      <td align="Center"><?php echo $data['tipo'];?></td>
                      <td align="Center"><?php echo $data['fechaemision'];?></td>                                   
                      <td><?php echo $data['razonsocial'];?></td>
                      <td align="Center"><?php echo $data['rut_emisor'];?></td>
                      <td align="Right"><?php if($data['iva'] == 0) echo $data['exento']; else echo  $data['neto']; ?></td>
                      <td align="Right"><?php echo $data['iva'];?></td>
                      <td align="Right"><?php echo $data['total'];?></td>
                      <td align="Center" class="">
                        <a href="#" class="fa fa-file-text"></a>
                        <a target="_blank" class="fa fa-file-code-o" target="_blank" href="<?php $rest = substr($data['rut_emisor'], 0, -2); echo '../Logs/Recepcion/'.$rest.'_'.$data['tipo'].'_'.$data['folio'].'.xml'?>"></a>         
                      </td> 
                      <td align="Center">
                        <a href="#" class="fa fa-trash" onclick="return confirm('¿Esta Seguro que Deseas Anularlo?')"></a>            
                      </td>
                        <?php }?>          
                    </tr>
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



