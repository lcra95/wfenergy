<?php 
session_start();
include_once ('Config.php');
include_once ('../ADMON/head.php');
include_once ("../ADMON/head-nav-main.php");


$id= $_GET['id'];
$periodo=$_GET['periodo'];


?>
<div id="wrapper">
<div class="container well">
<div class="row">
<div class="col-sm-12">
  <ol class="breadcrumb">
    <li><a href="#">Inicio</a></li>
    <li><a href="#">Cuadro de Pagos</a></li>
    <li><a href="#">Detalles</a></li>
  </ol>
      <div class="col-sm-12">


<div class="panel panel-default">
<div class="panel-heading"><h4>Detalle de <?php echo $_SESSION['desc'];?> para el periodo <?php echo $periodo;?></h4> <br> </div>
<div class="panel-body">
<div class="table-responsive table-bordered">

<table id="example" class="display" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th align="Center">Id</th>
            <th align="Center">Rut</th>
            <th align="Center">Razón Social</th>
            <th align="Center">Tipo Factura</th>
            <th align="Center">Referencia</th>
            <th align="Center">Cuadro de Pago</th>
            <th align="Center">Monto</th>
          </tr>
        </thead>
         <tbody>
 
        <?php
            $dbSelect= "SELECT * FROM detalle_balance WHERE periodo ='$periodo' AND tipo_fact = $id";
            $result = $mysqli->query($dbSelect);
            while ($row = mysqli_fetch_assoc($result)){ 
                // echo '<pre>';
                // print_r($row);
        ?>
          <tr>                                        
             <td align="Center">
              <a value="<?php echo $row['id']?>" onclick="traelo(<?php echo $row['id']; ?>)">
                <?php echo $row['id']?>
              </a>
              </td>           
             <td><?php echo $row['RUT_Deudor'];?></td>
             <td><?php echo utf8_encode($row['Razon_Deudor']);?></td>
             <td><?php echo utf8_encode($row['key']);?></td>
             <td><?php echo $row['referencia'];?></td>
             <td><?php echo $row['codigo'];?></td> 
             <td align="Right"><?php echo $row['monto'];?></td>  
          </tr>
        <?php 
            }
        ?>        
        </tbody>
    </table>

</div>
</div>
<div class="panel-footer">    </div>
</div>
</div>        
</div>
 </div>
 
    </div>        

</div>
<!-- /#page-content-wrapper -->
</div>

</div>




<div class="modal fade" id="ventana16" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content well">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">
<span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span>
</button>
    <h3 class="modal-title" id="ModalLabel" align = "center">Detalle de Instrucción</h3>
      <div class="modal-body">
         <table width="100%">
            <tr>
              <td colspan="6" align="center"><h4>Datos del Deudor</h4></td>
            </tr>
            <tr>
              <td><h4>Razón: </h4></td>
              <td id = "vRAZON"></td>
              <td><h4>Rut: </h4></td>
              <td id = "vRUT"></td>
              <td><h4>Contacto: </h4></td>
              <td id = "vCONTACTO"></td>
            </tr>
            <tr>
              <td><h4>Giro: </h4></td>
              <td colspan = "5" id = "vGIRO"></td>
            </tr>
            <tr>
            <td><h4>Dirección: </h4></td>
            <td colspan="5" id = "vDIRECCION"></td>
            </tr>
         </table>
         <table width="100%">
            <tr>
              <td colspan = "6" align = "center"><h4>Cuadro de Pagos</h4></td>
            </tr>
            <tr>
              <td><h4>Cuadro: </h4></td>
              <td id = "vKEY"></td>
              <td><h4>Referencia: </h4></td>
              <td id = "vREFERENCIA"></td>
              <td><h4>Publicación: </h4></td>
              <td id = "vPUBLICACION"></td>
            </tr>
         </table>
         <table width="100%">
            <tr>
              <td colspan = "10" align = "center"><h4>Detalle de Facturación</h4></td>
            </tr>
            <tr>
              <td align = "center"><h4>Código</h4></td>
              <td align = "center"><h4>Descripción</h4></td>
              <td align = "center"><H4>Cant</H4></td>
              <td align = "center"><h4>Precio</h4></td>
              <td align = "center"><h4>Total</h4></td>
            </tr>
            <tr>
              <td id="vTIPOFAC" align = "center"></td>
              <td id="vDESC"></td>
              <td id="vCANT" align = "center"> 1</td>
              <td id="vMONTO" align="right"></td>
              <td id="vTOTAL" align="right"></td>            
            </tr>
            <tr>
              <td colspan = "4"><br></td>
            </tr>
            <tr>
              <td colspan = "3" rowspan = "3"></td>
              <td align="right"><strong>Sub-Total</strong></td>
              <td id = "vSUBTOTAL" align="right"></td>
            </tr>
            <tr>
              <td align="right"><strong>Iva</strong></td>
              <td id = "vIVA" align="right"></td>
            </tr>
            <tr>
              <td align="right"><strong>Total</strong></td>
              <td id = "vDEF" align="right"></td>
            </tr>
         </table>
         <table width = "100%">
            <tr>
              <td align = "right" width = "50%">
                <input type="hidden" id="bfactura">
                <button onclick="factura()" class ="btn btn-success" >Facturar</button>
              </td>
              <td align = "left" width = "50%">
                <button class ="btn btn-danger" data-dismiss="modal" >Cancelar</button>
              </td>
            </tr>
            <tr>
              <td id = "resultado" colspan = "2"></td>
            </tr>
         </table>
      </div>
</div>   
</div>
</div>

    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
function factura() {

  var id = $("#bfactura").val();
  var url = 'facturar.php';
  var data = {"id" : id};

  $.ajax({
    type: "POST",
    url: url,
    data: data,
    beforeSend: function () {
      $("#resultado").html("Procesando, espere por favor...");
    },
    success:  function (response) {
      $("#resultado").html(response);
    }
  });
  
}





function traelo(id){

          $('#ventana16').modal('show');        
          var url = 'seeDetails.php';
          url += '?id='+id;
          var iva;
          var total;
          $.getJSON(url , function (data){

            $("#bfactura").val(data.id);
            $("#vRUT").text(data.RUT_Deudor);
            $("#vRAZON").text(data.Razon_Deudor);
            $("#vGIRO").text(data.giro_comercial);
            $("#vCONTACTO").text(data.Contacto);
            $("#vDIRECCION").text(data.direccion);
            $("#vKEY").text(data.codigo);
            $("#vREFERENCIA").text(data.referencia);
            $("#vPUBLICACION").text(data.fechaPublicacion);
            $("#vSYSPR").text(data.prefijo_systema);
            $("#vVENTANA").text(data.id_ventana);
            $("#vTIPOFAC").text(data.tipo_fact);
            $("#vDESC").text(data.titulo);
            $("#vMONTO").text(data.monto);
            $("#vTOTAL").text(data.monto);
            $("#vSUBTOTAL").text(data.monto);
            
            iva = Math.round( data.monto * 0.19 );
            total =Math.round( data.monto * 1.19 );


            $("#vIVA").text(iva);
            $("#vDEF").text(total);
            
//             Contacto: "PedroAcevedo Chavarria"
// RUT_Acreedor: "76555400-4"
// RUT_Deudor: "94272000-9"
// Razon_Acreedor: "TRANSELEC S.A."
// Razon_Deudor: "Aes Gener S.A."
// archivoCarta: "http://ppagos-sen.coordinadorelectrico.cl/uploads/cdec_ppagos/cdecsen/cartas/2019/audit/auxiliary_files/DE00580-19.pdf"
// codigo: "SEN_[PTN_][Ene19][L][V01]"
// correo: "link.pacevedo@aes.com"
// direccion: "Rosario Norte 532 Piso 19 Las Condes SANTIAGO"
// fechaPublicacion: "2019-02-05"
// giro_comercial: null
// id: "801095
// id_ventana: "236"
// key: "SEN_[PTN_][Ene19]"
// monto: "716990213"
// numeroCarta: "DE00580"
// periodo: "2019-01-01"
// prefijo_systema: "SEN_"
// referencia: "DE00580A19C24S0333"
// tipo_fact: "1"
// titulo: null

          });
     }

    </script>

  <script src="../ADMON/js/bootstrap.js"></script>