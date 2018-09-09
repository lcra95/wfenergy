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
                        url:'controlador/diario_mes.php',
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
                                    'Day 19', 'Day 20', 'Day 21', 'Day 22', 'Day 23', 'Day 24', 'Day 25', 'Day 26', 'Day 27', 'Day 28', 'Day 29', 'Day 30', 'Day 31'],                                    datasets : [
                                        {   
                                            label: 'Energia',
                                            fillColor : 'rgba(249, 11, 11, 1)', //COLOR DE LAS BARRAS
                                            strokeColor : 'rgba(249, 11, 11, 1)', //COLOR DEL BORDE DE LAS BARRAS
                                            highlightFill : 'rgba(60,141,188,0.8)', //COLOR "HOVER" DE LAS BARRAS
                                            highlightStroke : 'rgba(60,141,188,0.8)', //COLOR "HOVER" DEL BORDE DE LAS BARRAS
data : [ae, be, ce, de, ee, fe, ge, he, ie, je, ke, le, me, ne, oe, pe, qe, re, se, te, ue, ve, we, xe, ze, aae, bbe, cce, dde, eee, ffe]                                            
                                        },
                                        {
                                            label: 'Radiacion',
                                            fillColor : 'rgba(249, 222, 21, 1)', //COLOR DE LAS BARRAS
                                            strokeColor : 'rgba(249, 222, 21, 1)', //COLOR DEL BORDE DE LAS BARRAS
                                            highlightFill : 'rgba(210, 214, 222, 1)', //COLOR "HOVER" DE LAS BARRAS
                                            highlightStroke : 'rgba(210, 214, 222, 1)', //COLOR "HOVER" DEL BORDE DE LAS BARRAS
data : [ar, br, cr, dr, er, fr, gr, hr, ir, jr, kr, lr, mr, nr, or, pr, qr, rr, sr, tr, ur, vr, wr, xr, zr, aar, bbr, ccr, ddr, eer, ffr]
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
</html>
