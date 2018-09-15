<script>
$( document ).ready(function() {
    $("#from-datepicker").datepicker({ 
        format: 'yyyy-mm-dd'
    });
    $("#from-datepicker").on("change", function () {
        var fromdate = $(this).val();
        alert(fromdate);
    });
}); 
</script>
<?php 
include("funciones.php");
include("head.php");
@$empresa=$_GET['empresa'];
@$tipo=$_GET['tipo'];
@$fac=$_GET["factura"];
if(@$empresa=="")
{}
else
{
    $sql=mysql_query("SELECT * FROM `empresa` WHERE `id` LIKE '$empresa'");
    $row=mysql_fetch_array($sql);
    $r=$row[1];
    $ra=$row[2];
    $d=$row[5];
    $c=$row[6];
    $ci=$row[7];
    $t=$row[8];
}


?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
<body>
  
<?php include("head-nav-main.php");?><!--Menu Principal-->
<div id="wrapper">
  <div id="page-content-wrapper">
    <div class="container well">
      <div class="row">
<!--<p class="<?php  $color=$_GET['color'];  echo color($color);?>"><font class="<?php echo color($color);?>"><?PHP echo @$msg=$_GET['msg'];?></font></p>
-->

          <div class="col-lg-12">
            <ol class="breadcrumb">
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Configurar</a></li>
                <li class="active">Tablas</li>
            </ol>
            <div class="row">
            <?php if($empresa!="" && $tipo>0 && $fac!="")
            {
            ?>
        <div class="panel panel-default">
                <div class="panel-heading">
                 <div class="row">          
              <div class="col-sm-6">
              <h4>Datos DTE: </h4><br>
              <b>Tipo DTE:</b> <?PHP echo '#'.$tipo.' - '.tipo_dte($tipo);?>
              <br><b>Fecha:</b> <?php echo date("Y-m-d");?>  <br>
              </div>
              <div class="col-sm-6">
              <h4> Datos de Cliente: </h4><br>
              <b>Rut: </b><?php echo $r?><br>
              <b>Razón Social:</b> <?php echo $ra;?><br>
              <b>Dirección:</b> <?php echo $d;?><br>
              <b>Comuna:</b> <?php echo $c;?><br>
              <b>Ciudad:</b> <?php echo $ci;?><br>
              <b>Teléfono:</b> <?php echo $t;?><br>
              <b>Giro:</b> <?php $c;?>
              </div>
                 </div>
                </div>
                
                <div class="panel-body"> 
            <div class="panel-group">    
            
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a class="collapsed" data-toggle="collapse" href="#eliminar" aria-expanded="true">
                      <span class="fa fa-plus-square" aria-hidden="true"></span> ADD Producto / Servicio</a>
                  </h4>
                </div>
         
                <div id="eliminar" class="panel-collapse collapse">
                  <div class="panel-body">
                
                <FORM method="post" action="concepto_fac.php?empresa=<?php echo $empresa;?>&tipo=<?php echo $tipo;?>&factura=<?php echo $fac;?>">
              <div class="form-group">
                <div class="col-sm-4">
                  <SELECT name="tip" class="form-control">
                    <?PHP 
                    $per=mysql_query("SELECT * FROM tipo_transaccion");
                    ?>
                    <?php while($rowa=mysql_fetch_array($per)){?>
                    <option value="<?php echo $rowa[0];?>"><?php echo $rowa[1];?></option>
                    <?php }?>
                  </SELECT>
                </div>
                
                <div class="col-sm-1">
                <input type="text" name="cantidad" class="form-control" placeholder="Cnt" id="formGroup">  
                </div>
              
             
                <div class="col-sm-2">
                  <input type="text" name="monto" class="form-control" id="formGroup" placeholder="Monto">
                </div>


                <div class="col-sm-2">
                <select name="exento" class="form-control"><option value="0">Afecto</option><option value="1">Exento</option></select> 
                </div> 

                <div class="col-sm-1">
                <input type="text" class="form-control" name="recargo" id="formGroup" placeholder="R%">
                </div>     
                <div class="col-sm-1">
                <input type="text" class="form-control" name="descuento" id="formGroup" placeholder="D%">
                </div>     
                <div class="col-sm-1">
                  <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-paper-plane" aria-hidden="true"></i>
                  </button>  
                </div>
              </div> 
              </FORM>

                  </div>
                </div>
              </div>  
            </div>

                </div>
                <div class="panel-footer">


                </div>
            </div>



              <?php }else{?>
              <div class="panel panel-default">
               <form action="gnfactura.php?empresa=<?php echo $empresa;?>" method="post" class="form-vertical">
                <div class="panel-heading">
                  <div class="row">
                    

                    <div class="col-sm-7">
                    
                    <h4> Nueva DTE </h4>
                    
                    </div>

                    <div class="col-sm-2">
                    
                    <SELECT name="periodo" class="form-control">
                    <?PHP 
                    $per=mysql_query("SELECT * FROM periodo");
                    ?>
                    <?php while($rowa=mysql_fetch_array($per)){?>
                    <option value="<?php echo $rowa[0];?>"><?php echo $rowa[0];?></option>
                    <?php }?>
                    </SELECT>   
                    
                    </div>                 
                    <div class="col-sm-2">
                   
                    <?php $sql=mysql_query("SELECT * FROM tipo_documento")?>
                    <select class="form-control" name="tipo">
                      <option value="0">Tipo DTE</option>
                      <?php while($rowa=mysql_fetch_array($sql)){?>
                      <option value="<?php echo $rowa[0]?>"><?php echo $rowa[1];?></option>
                      <?php } ?>
                    </select>
                   
                    </div>
    

                    <div class="col-sm-1">
                    <button type="submit" class="btn btn-success btn-sm" ><i class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></i>
                    </button>  
                    </div>
                 
                 </div>
                </div>
                
                <div class="panel-body"> 





                    <div class="row">
                          <div class="form-group">
                              
                            <div class="col-sm-3">
                              <input type="text" class="form-control" id="formGroup" placeholder="Cliente" Value="<?php echo @$r;?>" >
                            </div>
                          
                                 <div class="col-sm-1">
                          <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#ventana1"><i class="fa fa-binoculars" aria-hidden="true"></i>
                          </button>  
                            </div>
                          
                            <div class="col-sm-4">
                              <input type="text" class="form-control" id="formGroup" placeholder="Razón Social" Value="<?php echo @$ra;?>">
                            </div>
                          

                        
                            <div class="col-sm-4">
                              <input type="text" class="form-control" id="formGroup" placeholder="Giro" Value="<?php echo @$c;?>" >
                            </div>
                          </div>
                    </div><br>

                    <div class="row">
                          <div class="form-group">
                            <div class="col-sm-4">
                              <input type="text" class="form-control" id="formGroup" placeholder="Telefono"  Value="<?php echo @$t;?>">
                            </div>
                        
                          
                         
                            <div class="col-sm-4">
                              <input type="text" class="form-control" id="formGroup" placeholder="Comuna" Value="<?php echo @$c;?>">
                            </div>
                          

                        
                            <div class="col-sm-4">
                              <input type="text" class="form-control" id="formGroup" placeholder="Ciudad" Value="<?php echo @$ci;?>" >
                            </div>
                          </div>
                    </div><br>
                    <div class="row">
                          <div class="form-group">
                            <div class="col-sm-12">
                              <input type="text" class="form-control" id="formGroup" placeholder="Dirección" Value="<?php echo @$d;?>" >
                            </div>
                          </div>
                    </div>   

                </div>
                <div class="panel-footer">


                </div>
    
              </form>
            </div>
            <?php } ?>
<?PHP 
@$conceptos=borradores($fac);
if($conceptos==0)
{

}
else
{
?>
        <div class="panel panel-success">
                <div class="panel-heading">
                  <div class="row">
                    <div class="col-sm-10">
                      <H4 class="panel-title">Conceptos Facturados</H4>
                    </div>
                <div class="col-sm-2">
                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#ventana2"><i class="fa fa-binoculars" aria-hidden="true"></i>
                Terminar</button>  
                </div>
                  </div>
                  

                </div>
                
                <div class="panel-body"> 
  <div class="table-responsive table-bordered">
            <?php include('conexion.php');
            $sel=mysql_query("SELECT * FROM borrador_concepto WHERE id_factura = $fac");
            $i=0;
            ?>
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Concepto</th>
            <th>Cant</th> 
            <th>Monto</th>  
            <th>Extendido</th>  
            <th>Exento</th>  
            <th>Iva</th>  
            <th>Desc</th>
            <th>Rec</th>  
            <th>Total</th>            
            <th>Acción</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $totalex=0;
          $totatotal=0;
          $totaliva=0;
          while ($row=mysql_fetch_row($sel)) {
            $i++; 
            $totalex=$totalex+$row[6];
            $totatotal=$totatotal+$row[12];
            $totaliva=$totaliva+$row[7];
            ?>
          <tr>
            <td ><?php echo $i;?></td>
            <td><?php echo concepto($row[2]);?></td>
            <td align="right"><?php echo number_format($row[3]);?></td>
            <td align="right"><?php echo number_format($row[4]);?></td>
            <td align="right"><?php echo number_format($row[5]);?></td>
            <td align="right"><?php echo number_format($row[6]);?></td>
            <td align="right"><?php echo number_format($row[7]);?></td>
            <td align="right"><?php echo number_format($row[10]);?></td>
            <td align="right"><?php echo number_format($row[11]);?></td>
            <td align="right"><?php echo number_format($row[12]);?></td>
            <td aling="center"><a class="glyphicon glyphicon-pencil"></a> 
            <A class="glyphicon glyphicon-trash" href="#?id=dg&ide=<?php echo $row[0];?>"></a></td>                                                            
          </tr>
          <?php }?>

        </tbody>
      </table>

                </div>
                <div class="panel-footer">
                  <div class="row">
                    
                    <div class="col-sm-6"></div>
                    <div class="col-sm-2"><b>Exento:</b><BR> <?php echo number_format($totalex);?></div>
                    <div class="col-sm-2"><b>Iva:</b> <BR><?php echo number_format($totaliva);?></div>
                    <div class="col-sm-2"><b>Total:</b><BR> <?php echo number_format($totatotal);?></div>

                  </div>

                </div>
        </div>
<?php 




}


?>
           </div>
          </div>  
 
      </div>
    </div>
  </div>
</div>
  </div>
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

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>





<!--Modal Clientes-->
<div class="modal fade" id="ventana1" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content well">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">
<span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
</button>
<h3 class="modal-title" id="ModalLabel">Listado de Clientes</h3>
</div>
<div class="modal-body">
  <?php 
$sql=mysql_query("SELECT * FROM empresa");
?>
<table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Sel</th>
                <th>Razón</th>
                <th>ID</th>
                <th>RUT</th>

            </tr>
        </thead>

        <tbody>
            <?php while($row=mysql_fetch_array($sql)){ ?>
            <tr>
                <td><a href="cambio.php?empresa=<?php echo $row[0];?>" class="fa fa-check-square-o"></a></td>
                <td><?php echo $row[2];?></td>
                <td><?php echo $row[0];?></td>
                <td><?php echo $row[1];?></td>
                
            </tr>
            <?php } ?>
        </tbody>
    </table>


</div>
</div>   
</div>
</div>

<!--MODAL DE OBSERVACIONES -->
<div class="modal fade" id="ventana2" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content well">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">
<span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
</button>
<h4 class="modal-title" id="ModalLabel"><span class="fa fa-plus-square" aria-hidden="true"></span> ADD Observaciones y Finalice</h4>
</div>
<div class="modal-body">


        <form action="nfacturar.php?factura=<?php echo $fac;?>" method="post" class="form-horizontal">



      <div class="form-group">
        <label for="formGroup" class="col-sm-4 control-label">Observaciones</label>
        <div class="col-sm-4">
          <textarea name="observacion" class="form-control" rows="4"></textarea>
        </div>
      </div>      

                <div class="form-group">
                <label class="col-sm-4 control-label">Vecimiento:</label>

                <div class="col-sm-4 input-group date">
                  <div class="input-group-addon">
                    Vence
                  </div>
                  
                  <input type="text"  name="fecha" class="form-control pull-right" id="from-datepicker">
                </div>
                <!-- /.input group -->
              </div>
                    <div class="form-group">
        <label for="formGroup" class="col-sm-4 control-label">Descuento Global</label>
        <div class="col-sm-4">
          <input type="text" name="descuento_g" class="form-control" id="formGroup">
        </div>
      </div>  
      <div class="form-group">
        <label for="formGroup" class="col-sm-4 control-label">Recargo Global</label>
        <div class="col-sm-4">
          <input type="text" name="recargo_g" class="form-control" id="formGroup">          
        </div>
      </div>  
      <br>
            </div>
            <div class="modal-footer">
          <button type="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-floppy-saved"></span>Guardar</button>
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span>Cancelar</button>
             </form>



</div>
</div>   
</div>
</div>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/css/bootstrap-datepicker3.min.css">
<script>
$( document ).ready(function() {
  autoclose: true
    $("#from-datepicker").datepicker({ 
        format: 'yyyy-mm-dd'
    });
    $("#from-datepicker").on("change", function () {
        var fromdate = $(this).val();
   
    });
        $('#from-datepicker').datepicker({
      autoclose: true
    });
}); 
</script>