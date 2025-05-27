function graficarOpiniones(){
    var desde = $("#fecha_Inicio").val();
    var hasta = $("#fecha_Final").val();

if(desde === '' || hasta === ''){
        alert("Favor de seleccionar el rango de fechas para realizar el reporte.");
        return;

    }else{
         var xhr = new XMLHttpRequest();

         var datos = new FormData();
         datos.append('accion', "opiniones");
         datos.append('fechaDesde', desde);
         datos.append('fechaHasta', hasta);

          xhr.open('POST', '../php/ModeloReportes.php', true);
          console.log("fecha:", desde);
          console.log("fecha:", hasta);
          xhr.onload = function () {
            console.log("Respuesta:", xhr.responseText);
            if (xhr.status === 200) {
                try {
            var jsonResponse = JSON.parse(xhr.responseText);
                var jsonResponse = JSON.parse(xhr.responseText);
                var xValues = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"];
                var y1Values = [jsonResponse["Dias"][0][0],jsonResponse["Dias"][1][0],jsonResponse["Dias"][2][0],jsonResponse["Dias"][3][0],jsonResponse["Dias"][4][0],jsonResponse["Dias"][5][0],jsonResponse["Dias"][6][0],0];
                var y2Values = [jsonResponse["Dias"][0][1],jsonResponse["Dias"][1][1],jsonResponse["Dias"][2][1],jsonResponse["Dias"][3][1],jsonResponse["Dias"][4][1],jsonResponse["Dias"][5][1],jsonResponse["Dias"][6][1],0];
                var y3Values = [jsonResponse["Dias"][0][2],jsonResponse["Dias"][1][2],jsonResponse["Dias"][2][2],jsonResponse["Dias"][3][2],jsonResponse["Dias"][4][2],jsonResponse["Dias"][5][2],jsonResponse["Dias"][6][2],0];
                
                var xValues2 = ["1 Estrella", "2 Estrellas", "3 Estrellas", "4 Estrellas", "5 Estrellas"];
                var yValues2 = [jsonResponse["Estrellas"][0],jsonResponse["Estrellas"][1],jsonResponse["Estrellas"][2],jsonResponse["Estrellas"][3],jsonResponse["Estrellas"][4],0];
                var barColors = ["red", "orange", "yellow", "limegreen", "green"];

                new Chart("reporteCalificaciones", {
                    type: "bar",
                    data: {
                    labels: xValues,
                    datasets: [{
                        label: "Positivo",
                        data: y1Values,
                        backgroundColor: "green"
                    }, {
                        label: "Neutras",
                        data: y2Values,
                        backgroundColor: "yellow"
                    },{
                        label: "Negativas",
                        data: y3Values,
                        backgroundColor: "red"
                    }
                    ]
                    },  
                    options: {
                    legend: {
                        display: true,
                        position: 'bottom'
                    },
                    }
                
                });
                
                new Chart("reporteEstrellas", {
                    type: "doughnut", data: {
                    labels: xValues2,
                    datasets: [{
                        data: yValues2,
                        backgroundColor: barColors
                    }]
                    },
                    options: {
                    legend: {
                        display: true,
                        position: 'bottom'
                    },
                    }
                });


            } catch (e) {
            console.error("La respuesta no es un JSON válido:", e);
            alert("Hubo un error en el servidor. Revisa la consola.");
        }
            
            } else {
                alert("Error al realizar tu consulta");
            }
        }
         xhr.onerror = function () {
            alert("Error de red. Verifica tu conexión.");
        };
          xhr.send(datos);


    }
       
}