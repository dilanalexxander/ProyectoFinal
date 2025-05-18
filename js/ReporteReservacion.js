var xValues = ["10:00", "10:15", "10:30", "10:45","11:00", "11:15", "11:30", "11:45"];
var yValues = [5,10,7,9,5,10,7,9,0];

new Chart("reporteHoras", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      data: yValues,
      backgroundColor: "orange"
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Horario"
    },
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});

var xValues2 = ["Canceladas", "Confirmadas"];
var yValues2 = [74,26];
var barColors = ["red", "green"];

new Chart("reporteReservas", {
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