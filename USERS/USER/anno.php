    function manejaJSON() {
            
            var http_request = new XMLHttpRequest();
            var url = "respuestajson.php"; // Esta URL deberia devolver datos JSON
             
            // Descarga los datos JSON del servidor.
            http_request.onreadystatechange = function (){
            
                    if (http_request.readyState == 4) {
                        if (http_request.status == 200) {
                        
                          var cadCodificadaJSON = http_request.responseText; 
                          
                          var objDatos = eval("(" + cadCodificadaJSON + ")"); //Creamos el objeto utilizando la cadena codificada
                    
                          //Ahora con el objeto desplegamos los datos mandados desde el servidor
                          document.getElementById("divNombre").innerHTML = objDatos.nombre[0];
                          document.getElementById("divVeces").innerHTML = objDatos.veces[0];
                                     var chartData = [{
                                        country: objDatos.nombre[0],
                                        value: objDatos.veces[0]
                                    }, {
                                        country: objDatos.nombre[1],
                                        value: objDatos.veces[1]
                                    }, {
                                        country: objDatos.nombre[2],
                                        value: objDatos.veces[2]
                                    }, {
                                        country: objDatos.nombre[3],
                                        value: objDatos.veces[3]
                                    }, {
                                        country: objDatos.nombre[4],
                                        value: objDatos.veces[4]
                                    }, {
                                        country: objDatos.nombre[5],
                                        value: objDatos.veces[5]
                                    }];
                        return chartData;
                 
                        
                        
                        } else {
                          alert("Ocurrio un problema con la URL.");
                        }
                        
                        http_request = null;
                      }
                    }
            
            
            http_request.open("GET", url, true);
            http_request.send(null);
            }
                
                manejaJSON();
                var chart;
                var legend;
           
                AmCharts.ready(function () {
                    // PIE CHART
                    chart = new AmCharts.AmPieChart();
                    chart.dataProvider = chartData;
                    chart.titleField = "country";
                    chart.valueField = "value";
                    chart.outlineColor = "#FFFFFF";
                    chart.outlineAlpha = 0.8;
                    chart.outlineThickness = 2;
                    // this makes the chart 3D
                    chart.depth3D = 15;
                    chart.angle = 30;
     
                    // WRITE
                    chart.write("chartdiv");
                });