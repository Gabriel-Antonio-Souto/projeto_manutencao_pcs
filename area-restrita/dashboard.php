<?php 

    session_start();

    include('../api/conexao/Conexao.php');

    $con = Conexao::conectar();

    $stmt = $con->prepare("SELECT COUNT(idPedido) as total FROM tbpedido");
    $stmt->execute();

    $totalPedidos = '';
    
    while($row = $stmt->fetch(PDO::FETCH_BOTH)){ 
        $totalPedidos = $row[0];
    }


    $stmt1 = $con->prepare("SELECT COUNT(idPedido) as total FROM tbpedido WHERE status = 'Pendente'");
    $stmt1->execute();

    $pendete = '';
    
    while($row1 = $stmt1->fetch(PDO::FETCH_BOTH)){ 
        $pendete = $row1[0];
    }

    $stmt2 = $con->prepare("SELECT COUNT(idPedido) as total FROM tbpedido WHERE status = 'Resolvido'");
    $stmt2->execute();

    $resolvido = '';
    
    while($row2 = $stmt2->fetch(PDO::FETCH_BOTH)){ 
        $resolvido = $row2[0];
    }

    $stmt3 = $con->prepare("SELECT COUNT(idPedido) as total FROM tbpedido WHERE novo = 'true'");
    $stmt3->execute();

    $novos = '';
    
    while($row3 = $stmt3->fetch(PDO::FETCH_BOTH)){ 
        $novos = $row3[0];
    }


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>PMPCL- Dashboard</title>
    <link rel="shortcut icon" href="../assets/imgs/logo_manutencao.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/estiloAreaRestrita.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
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
          backgroundColor: 'transparent',
          colors:['#003B85','#004F92', '#006DB2', '#3E77B6', '#4E97D1', '#7BB4E3', '#90B1DB', '#A3CEEF', '#BBD2EC', '#DFE9F5'],
          legend: {position: 'left', textStyle: {color: '#fff', fontSize: 16}},
          chartArea:{width:'100%',height:'100%'} 
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);     
      }
    </script>
    <style>
        .boxCardsInfos{
            width: 100%;
            display: inline-flex;
        }

        .cardInfo{
            width: 25%;
            height: 100%;
            background: #204070;
            border-radius: 15px;
            margin-right: 10px;
            padding: 15px;
        }

        .ultCard{
            margin-right: 0px;
        }

        .iconCardInfo{
            margin-right: 10px;
            float: left;
            vertical-align: middle;
        }

        .descCardInfo{
            margin-top: -5px;
            margin-bottom: 2.5px;
        }

        .boxGraficosInfo{
            width: 100%;
            height: 65%;
            display: inline-flex;
        }

        .boxGrafco1{
            width: 50%;
            height: 100%;
            background: #204070;
            border-radius: 15px;
            margin-right: 10px;
            padding: 15px;
        }

        .boxGrafco2{
            width: 50%;
            height: 100%;
            background: #204070;
            border-radius: 15px;
            padding: 15px;
        }

        .grafico{
            width: 100%;
            height: 100%;
            margin-top: 50px;
        }

    </style>
</head>
<body>
<div class="wrapper">
    <div class="sidebar">
        <img class="logo" src="../assets/imgs/logo_manutencao.png" alt="logo do projeto">
        <h2>PMPCL</h2>
        <ul>
            <li id="liAtual"><a href="dashboard.php" id="aAtual"><i class="fas fa-home" id="iAtual"></i>Dashboard</a></li>
            <li><a href="pedidosManutencao.php"><i class="fas fa-cogs"></i>Pedidos de manutenção</a></li>
            <li><a href="laboratorios.php"><i class="fas fa-desktop"></i>Laboratórios</a></li>
            <li><a href="usuarios.php"><i class="fas fa-address-card"></i>Usuários</a></li>
        </ul> 
        <div class="rodape">Etec de Guaianazes - © 2022</div>
    </div>
    <div class="main_content">
        <div class="header"><a href="../index.php"><button class="btnSair">Sair</button></a></div>  
        <div class="info">
          <div class="titulo">Dashboard</div>
          <div class="boxCardsInfos">
            <div class="cardInfo">
                <img class="iconCardInfo" src="../assets/imgs/Notifications.png" align="left" alt="">
                <p class="descCardInfo">Novos Pedidos</p>
                <h1><?php echo $novos;?></h1>
            </div>
            <div class="cardInfo">
                <img class="iconCardInfo" src="../assets/imgs/Maintenance Date.png" align="left" alt="">
                <p class="descCardInfo">Pendentes</p>
                <h1><?php echo $pendete;?></h1>
            </div>
            <div class="cardInfo">
                <img class="iconCardInfo" src="../assets/imgs/Done all.png" align="left" alt="">
                <p class="descCardInfo">Resolvidos</p>
                <h1><?php echo $resolvido;?></h1>
            </div>
            <div class="cardInfo ultCard">
                <img class="iconCardInfo" src="../assets/imgs/Assignment.png" align="left" alt="">
                <p class="descCardInfo">Total de Pedidos</p>
                <h1><?php echo $totalPedidos;?></h1>
            </div>
          </div>
          <div class="boxGraficosInfo">
            <div class="boxGrafco1">
                <h3 class="tituloBox">Quantidade de Pedidos de Manutenção por Mês</h3>
                <div class="grafico"></div>
            </div>
            <div class="boxGrafco2">
                <h3 class="tituloBox">Quantidade de Pedidos de Manutenção por Laboratório</h3>
                <!-- <div class="grafico" id="piechart"></div> -->
            </div>
          </div>
        </div>
    </div>
</div>
</body>
</html>