<?php 
include("conexion.php");
include("funciones.php");
include("11pesos.php");
$tpr=mysql_query("SELECT id FROM periodo WHERE activo = 1");
$tte=mysql_fetch_array($tpr);
 if(@$periodo=$_GET['periodo']==""){$periodo=$tte[0];}else {@$periodo=$_GET['periodo'];} ?>
<?php include("head.php");?>
<body>
  
<?php include("head-nav-main.php");?><!--Menu Principal-->
<div id="wrapper">

<!-- Page Content -->
<div id="page-content-wrapper">
<?php 

//$t=$_SESSION["id"];
      list($ting,$tegr,$ttotal)=calculo2($periodo); 
      list ($acu,$p)=acumulado($periodo);

      ?>







<div class="container well">
<div class="row">
    <div class="col-sm-12">
        <h3>Bienvenido <?php @include("sesion.php");?></h3>
        <ol class="breadcrumb">
        <li><a href="#">Inicio</a></li>
        <!--<li><a href="#">Cuadro de Pagos</a></li>-->
        <!--<li class="active"><a href="#" data-toggle="modal" data-target="#ventana"><i class="fa fa-asterisk"></i> Nuevo Registro</a></li>--> 
        </ol>
    </div>
        <div class="col-sm-6">
            <div class="panel panel-default">
              <div class="panel-heading">
                <i class="fa fa-bar-chart-o"></i>
                <h4 class="box-title"><font color="#d00101">Energia (KWh) Mensual</font> </h4>  
              </div>
              <div class="panel-body">
                <div class="resultados"><canvas id="grafico"></canvas></div>
              </div>
              <div class="panel-footer">
                <div class="div" align="rigth"> <a href="export_g3.php" class="fa fa-download"></a> Descargar Data </div>
              </div>
            </div>
        </div>
            <div class="col-sm-6">
            <div class="panel panel-default">
              <div class="panel-heading">
                <i class="fa fa-bar-chart-o"></i>
                <h4 class="box-title">Produccion Menusal CLP</h4>  
              </div>
              <div class="panel-body">
                <div class="resultados"><canvas id="grafico1"></canvas></div>
              </div>
              <div class="panel-footer" >
                <div class="div" align="rigth"> <a href="export_g2.php" class="fa fa-download"></a> Descargar Data </div>
            
              </div>
            </div>
        </div>
  </div>
<div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <i class="fa fa-bar-chart-o"></i>
                <h4 class="box-title"><font color="#d00101">Energia (KWh) Diaria</font> </font></h4>  
              </div>
              <div class="panel-body">
                <div class="resultados"><canvas id="grafico2"></canvas></div>
              </div>
              <div class="panel-footer">
                <div class="div" align="rigth"> <a href="export_g4.php" class="fa fa-download"></a> Descargar Data </div>
              </div>
            </div>
        </div>
</div> 

<div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <i class="fa fa-bar-chart-o"></i>
                <h4 class="box-title">Valor de la Energia en USD$</h4>  
              </div>
              <div class="panel-body">
                <div class="resultados"><canvas id="grafico3"></canvas></div>
              </div>
              <div class="panel-footer">
                <div class="div" align="rigth"> <a href="export_g1.php" class="fa fa-download"></a> Descargar Data </div>
              </div>
            </div>
        </div>
</div> 

</div>


    
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
  <script src="js/bootstrap.js"></script>
<script type="text/javascript" src="Graphics/js/jquery.js"></script>
<script type="text/javascript" src="Graphics/js/chartJS/Chart.min.js"></script>



</body>
</html>


<!--GRAFICO DE ENERGIA AL 2017-->
    <script>
            $(document).ready(mostrarResultados(2016));  
                function mostrarResultados(año){
                    $.ajax({
                        type:'POST',
                        url:'Graphics/controlador/proceso.php',
                        data:'año='+año,
                        success:function(data){

                            var valores = eval(data);

                            var ee   = valores[0];
                            var er  = valores[1];
                            var fe   = valores[2];
                            var fr   = valores[3];
                            var me  = valores[4];
                            var mr   = valores[5];
                            var ae = valores[6];
                            var ar = valores[7];  
                            var mae= valores[8];
                            var mar= valores[9];
                            var je= valores[10];
                            var jr= valores[11];
                            var jle= valores[12];
                            var jlr= valores[13];
                            var age= valores[14];
                            var agr= valores[15];
                            var se= valores[16];
                            var sr= valores[17];                            
                            var oe= valores[18];
                            var or= valores[19];
                            var ne= valores[20];
                            var nr= valores[21];
                            var de= valores[22];
                            var dr= valores[23];                            
                            var Datos = {
                                    labels : ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                                    datasets : [
                                        {   
                                            label: 'Energia',
                                            fillColor : 'rgba(249, 11, 11, 1)', //COLOR DE LAS BARRAS
                                            strokeColor : 'rgba(249, 11, 11, 1)', //COLOR DEL BORDE DE LAS BARRAS
                                            highlightFill : 'rgba(60,141,188,0.8)', //COLOR "HOVER" DE LAS BARRAS
                                            highlightStroke : 'rgba(60,141,188,0.8)', //COLOR "HOVER" DEL BORDE DE LAS BARRAS
                                            data : [ee, fe, me, ae, mae, je, jle, age, se, oe, ne, de]
                                        }
                                    ]
                                }
                                
                            var contexto = document.getElementById('grafico').getContext('2d');
                            window.Barra = new Chart(contexto).Bar(Datos, { responsive : true });
                        }
                    });
                    return false;
                }
    </script>
<!--/GRAFICO DE ENERGIA AL 2017-->
<!--GRAFICO DE INGRESOS AL 2017-->

<script>
            $(document).ready(mostrarResultados(2016));  
                function mostrarResultados(año){
                    $.ajax({
                        type:'POST',
                        url:'Graphics/controlador/procesar.php',
                        data:'año='+año,
                        success:function(data){

                            var valores = eval(data);

                            var e   = valores[0];
                            var f   = valores[1];
                            var m   = valores[2];
                            var a   = valores[3];
                            var ma  = valores[4];
                            var j   = valores[5];
                            var jl  = valores[6];
                            var ag  = valores[7];
                            var s   = valores[8];
                            var o   = valores[9];
                            var n   = valores[10];
                            var d   = valores[11];
                                
                            var Datos = {
                                    labels : ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                                    datasets : [
                                        {
                                            fillColor : 'rgba(60,141,188,0.9)', //COLOR DE LAS BARRAS
                                            strokeColor : 'rgba(60,141,188,0.8)', //COLOR DEL BORDE DE LAS BARRAS
                                            highlightFill : 'rgba(73,206,180,0.6)', //COLOR "HOVER" DE LAS BARRAS
                                            highlightStroke : 'rgba(66,196,157,0.7)', //COLOR "HOVER" DEL BORDE DE LAS BARRAS
                                            data : [e, f, m, a, ma, j, jl, ag, s, o, n, d]
                                        },

                                    ]
                                }
                                
                            var contexto = document.getElementById('grafico1').getContext('2d');
                            window.Barra = new Chart(contexto).Bar(Datos, { responsive : true });
                        }
                    });
                    return false;
                }
    </script>
<!--/GRAFICO DE INGRESOS AL 2017-->

<!--GRAFICO DE ENERGIA AL PERIODO-->
    <script>
            $(document).ready(mostrarResultados(2016));  
                function mostrarResultados(año){
                    $.ajax({
                        type:'POST',
                        url:'Graphics/controlador/diario_mes.php',
                        data:'año='+año,
                        success:function(data){
                            
                            var valores = eval(data);

                            var   ae= valores[0];
                            var   ar= valores[1];
                            var   be= valores[2];
                            var   br= valores[3];
                            var   ce= valores[4];
                            var   cr= valores[5];
                            var   de= valores[6];
                            var   dr= valores[7];  
                            var   ee= valores[8];
                            var   er= valores[9];
                            var   fe= valores[10];
                            var   fr= valores[11];
                            var   ge= valores[12];
                            var   gr= valores[13];
                            var   he= valores[14];
                            var   hr= valores[15];
                            var   ie= valores[16];
                            var   ir= valores[17];                            
                            var   je= valores[18];
                            var   jr= valores[19];
                            var   ke= valores[20];
                            var   kr= valores[21];
                            var   le= valores[22];
                            var   lr= valores[23];      
                            var   me= valores[24];
                            var   mr= valores[25];
                            var   ne= valores[26];
                            var   nr= valores[27];  
                            var   oe= valores[28];
                            var   or= valores[29];
                            var   pe= valores[30];
                            var   pr= valores[31];
                            var   qe= valores[32];
                            var   qr= valores[33];
                            var   re= valores[34];
                            var   rr= valores[35];
                            var   se= valores[36];
                            var   sr= valores[37];  
                            var   te= valores[38];
                            var   tr= valores[39];
                            var   ue= valores[40];
                            var   ur= valores[41];
                            var   ve= valores[42];
                            var   vr= valores[43];
                            var   we= valores[44];
                            var   wr= valores[45];
                            var   xe= valores[46];
                            var   xr= valores[47];  
                            var   ze= valores[48];
                            var   zr= valores[49];              
                            var   aae= valores[50];
                            var   aar= valores[51];
                            var   bbe= valores[52];
                            var   bbr= valores[53];
                            var   cce= valores[54];
                            var   ccr= valores[55];
                            var   dde= valores[56];
                            var   ddr= valores[57];  
                            var   eee= valores[58];
                            var   eer= valores[59];
                            var   ffe= valores[60];
                            var   ffr= valores[61];                           
                            var Datos = {
                                            labels : ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6', 'Day 7', 'Day 8', 
                                            'Day 9', 'Day 10', 'Day 11', 'Day 12', 'Day 13', 'Day 14', 'Day 15', 'Day 16', 'Day 17', 'Day 18', 
                                            'Day 19', 'Day 20', 'Day 21', 'Day 22', 'Day 23', 'Day 24', 'Day 25', 'Day 26', 'Day 27', 'Day 28', 'Day 29', 'Day 30', 'Day 31'],                                    
                                    datasets : [
                                        {   
                                            label: 'Energia',
                                            fillColor : 'rgba(249, 11, 11, 1)', //COLOR DE LAS BARRAS
                                            strokeColor : 'rgba(249, 11, 11, 1)', //COLOR DEL BORDE DE LAS BARRAS
                                            highlightFill : 'rgba(60,141,188,0.8)', //COLOR "HOVER" DE LAS BARRAS
                                            highlightStroke : 'rgba(60,141,188,0.8)', //COLOR "HOVER" DEL BORDE DE LAS BARRAS
                                            data : [ae, be, ce, de, ee, fe, ge, he, ie, je, ke, le, me, ne, oe, pe, qe, re, se, te, ue, ve, we, xe, ze, aae, bbe, cce, dde, eee, ffe]                                            
                                        }
                                    ]
                                }
                                
                            var contexto = document.getElementById('grafico2').getContext('2d');
                            window.Barra = new Chart(contexto).Bar(Datos, { responsive : true });
                        }
                    });
                    return false;
                }
    </script>
<!--GRAFICO DE ENERGIA AL PERIODO-->

<!--COSTO MARGINAL  DE LA ENERGIA-->
<script>
            $(document).ready(mostrarResultados(2016));  
               
                function mostrarResultados(año){
                    var Datos;
                    $.ajax({
                        type:'POST',
                        url:'Graphics/controlador/costo_marginal.php',
                        data:'año='+año,
                        
                        success:function(data){
                            
                            var valores = eval(data);
                           
                            var   ae= valores[0];
                            var   be= valores[1];
                            var   ce= valores[2];
                            var   de= valores[3];
                            var   ee= valores[4];
                            var   fe= valores[5];
                            var   ge= valores[6];
                            var   he= valores[7];  
                            var   ie= valores[8];
                            var   je= valores[9];
                            var   ke= valores[10];
                            var   le= valores[11];
                            var   me= valores[12];
                            var   ne= valores[13];
                            var   oe= valores[14];
                            var   pe= valores[15];
                            var   qe= valores[16];
                            var   re= valores[17];                            
                            var   se= valores[18];
                            var   te= valores[19];
                            var   ue= valores[20];
                            var   ve= valores[21];
                            var   we= valores[22];
                            var   xe= valores[23];      
                            var   ye= valores[24];
                            var   ze= valores[25];
                            var   aae= valores[26];
                            var   bbe= valores[27];  
                            var   cce= valores[28];
                            var   dde= valores[29];
                            var   eee= valores[30];
                            
                                

                            Datos = {
                                    labels : [
                                        '1','2','3','4','5','6','7','8','9','10','11','12','13','14','15'
                                        ,'16','17','18','19','20','21','22','23','24','25','26','27','28'
                                        ,'29','30','31'
                                        ],
                                    datasets : [
                                            {   
                                            label: 'Promedio',
                                            fillColor : 'rgba(39, 81, 221, 0)', //COLOR DE LAS BARRAS
                                            strokeColor : 'rgba(39, 81, 221, 1)', //COLOR DEL BORDE DE LAS BARRAS
                                            //highlightFill : 'rgba(39, 221, 118, 1)', //COLOR "HOVER" DE LAS BARRAS
                                            //highlightStroke : 'rgba(39, 221, 118, 1)', //COLOR "HOVER" DEL BORDE DE LAS BARRAS
                                            data : [ae, 
                                            be, 
                                            ce, 
                                            de, 
                                            ee, 
                                            fe, 
                                            ge, 
                                            he, 
                                            ie, 
                                            je, 
                                            ke, 
                                            le, 
                                            me, 
                                            ne, 
                                            oe, 
                                            pe, 
                                            qe, 
                                            re,
                                            se, 
                                            te, ue, ve, we, xe, ye, ze, aae, bbe, cce, dde, eee]                                            

                                        }
                                    ]
                                }
                                
                            var contexto = document.getElementById('grafico3').getContext('2d');
                            window.Barra = new Chart(contexto).Line(Datos, { responsive : true });
                        }
                    });
                    
                    return false;
                }
    </script>