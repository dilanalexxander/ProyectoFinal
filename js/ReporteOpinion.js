var xValues = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"];
      var y1Values = [15,25,35,17,32,12,3,0];
      var y2Values = [7,12,17,8,16,6,1,0];
      var y3Values = [3,6,12,14,26,5,2,0];
      
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

      var xValues2 = ["1 Estrella", "2 Estrellas", "3 Estrellas", "4 Estrellas", "5 Estrellas"];
      var yValues2 = [2,4,26,17,51];
      var barColors = ["red", "orange", "yellow", "limegreen", "green"];

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