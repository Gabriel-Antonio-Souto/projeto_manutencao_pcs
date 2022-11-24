<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Laboratório', 'Quantidade de Pedidos de Manutenção'],
          ['Lab 1', 11],
          ['Lab 2', 2],
          ['Lab 3', 2],
          ['Lab 4', 2],
          ['Lab 5', 7],
          ['Lab 6', 7]
        ]);

        var options = {
          title: 'Quantidade de Pedidos de Manutenção por Laboratório',
          titleTextStyle:{ color: '#fff', fontSize: 18},
          //backgroundColor: 'transparent',
          backgroundColor: '#204070',
          colors:['#003B85','#004F92', '#006DB2', '#3E77B6', '#4E97D1', '#7BB4E3', '#90B1DB', '#A3CEEF', '#BBD2EC', '#DFE9F5'],
          legend: {position: 'left', textStyle: {color: '#fff', fontSize: 16}},
          chartArea:{width:'80%',height:'80%'} 
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);     
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;" ></div>
  </body>
</html>
