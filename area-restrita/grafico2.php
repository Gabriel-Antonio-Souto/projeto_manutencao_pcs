<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Mês', 'Quantidade de Pedidos'],
          ['Jan',  0],
          ['Fev',  0],
          ['Mar',  5],
          ['Abr',  10],
          ['Mai',  4],
          ['Jun',  8],
          ['Jul',  0],
          ['Ago',  10],
          ['Set',  11],
          ['Out',  15],
          ['Nov',  9],
          ['Dez',  0]
        ]);

        var options = {
          hAxis: {title: 'Mês',  titleTextStyle: {color: '#fff', opacity: 0.5}},
          vAxis: {minValue: 0},
          backgroundColor: '#204070',
          legend: {textStyle: {color: '#fff'}},
          chartArea:{width:'75%',height:'75%'} 
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 100%; height: 500px;"></div>
  </body>
</html>
