<html>
    <head>
        <title>Estadistica</title>
        <meta charset="UTF-8">
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/chartJS/Chart.min.js"></script>
    </head>
    <style>
        .caja{
            margin: auto;
            max-width: 250px;
            padding: 20px;
            border: 1px solid #BDBDBD;
        }
        .caja select{
            width: 100%;
            font-size: 16px;
            padding: 5px;
        }
        .resultados{
            margin: auto;
            margin-top: 40px;
            width: 1000px;
        }
    </style>
    <body> 
        <div class="resultados"><canvas id="grafico"></canvas></div>
    </body>
    <script>
            $(document).ready(mostrarResultados(2016));  
                function mostrarResultados(año){
                    $.ajax({
                        type:'POST',
                        url:'controlador/costo_marginal.php',
                        data:'año='+año,
                        success:function(data){

                            var valores = eval(data);

                            var a= valores[0];
                            var b= valores[1];
                            var c= valores[2];
                            var d= valores[3];
                            var e= valores[4];
                            var f= valores[5];
                            var g= valores[6];
                            var h= valores[7];  
                            var i= valores[8];
                            var j= valores[9];
                            var k= valores[10];
                            var l= valores[11];
                            var m= valores[12];
                            var n= valores[13];
                            var o= valores[14];
                            var p= valores[15];
                            var q= valores[16];
                            var r= valores[17];                            
                            var Datos = {
                                    labels : ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
                                    datasets : [
                                        {
                                            label: 'Minimo',
                                            fillColor : 'rgba(249, 222, 21, 0.2)', //COLOR DE LAS BARRAS
                                            strokeColor : 'rgba(249, 222, 21, 1)', //COLOR DEL BORDE DE LAS BARRAS
                                           // highlightFill : 'rgba(210, 214, 222, 1)', //COLOR "HOVER" DE LAS BARRAS
                                            //highlightStroke : 'rgba(210, 214, 222, 1)', //COLOR "HOVER" DEL BORDE DE LAS BARRAS
                                            data : [g, h, i, j, k, l]
                                        },
                                        {   
                                            label: 'Maximo',
                                            fillColor : 'rgba(249, 11, 11, 0.2)', //COLOR DE LAS BARRAS
                                            strokeColor : 'rgba(249, 11, 11, 1)', //COLOR DEL BORDE DE LAS BARRAS
                                            //highlightFill : 'rgba(60,141,188,0.8)', //COLOR "HOVER" DE LAS BARRAS
                                            //highlightStroke : 'rgba(60,141,188,0.8)', //COLOR "HOVER" DEL BORDE DE LAS BARRAS
                                            data : [a, b, c, d, e, f]
                                        },
                                        {   
                                            label: 'Promedio',
                                            fillColor : 'rgba(39, 81, 221, 0.2)', //COLOR DE LAS BARRAS
                                            strokeColor : 'rgba(39, 81, 221, 1)', //COLOR DEL BORDE DE LAS BARRAS
                                            //highlightFill : 'rgba(39, 221, 118, 1)', //COLOR "HOVER" DE LAS BARRAS
                                            //highlightStroke : 'rgba(39, 221, 118, 1)', //COLOR "HOVER" DEL BORDE DE LAS BARRAS
                                            data : [m, n, o, p, q, r]
                                        }

                                    ]
                                }
                                
                            var contexto = document.getElementById('grafico').getContext('2d');
                            window.Barra = new Chart(contexto).Line(Datos, { responsive : true });
                        }
                    });
                    return false;
                }
    </script>
</html>
