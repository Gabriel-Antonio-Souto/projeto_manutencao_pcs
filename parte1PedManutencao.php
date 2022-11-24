<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>PMPCL - Pedido de Manutenção</title>
    <link rel="shortcut icon" href="assets/imgs/logo_manutencao.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/estilo.css">
    <style>
        .iconProfAluno{
            width: 49%;
            margin-right: 10px;
        }

        .btnsReclamante{
            width: 49%;
            float: right;
        }

        .btnReclamante{
            width: 200px;
            height: 200px;
            background: #50C3E8;
            border-color: #50C3E8;
            border-radius: 25px;
            color: #fff;
            font-size: 20px;
            font-weight: bold;
            text-transform: uppercase;
            margin: 20px;
            margin-left: 0px;
        }
    </style>
</head>
<body>
    <div class="cabecalho">
        <img src="assets/imgs/logo_manutencao.png" alt="logo do projeto">
        <p class="txtLogo">PMPCL</p>
        <a href="index.php" class="btnC"><button class="btnCabecalho" >Voltar</button></a>
    </div>
    <div class="conteinerParte1PedManutenção">
        <img class="iconProfAluno" src="assets/imgs/img1.png" align="left">
       
        <div class="btnsReclamante"> 
            <h2>Em qual desses você se encaixa para fazer o pedido de manutenção?</h2>
            <a href="formPedManutencao-aluno.php"><button class="btnReclamante">Aluno</button></a>
            <a href="formPedManutencao-prof.php"><button class="btnReclamante">Professor</button></a>
        </div>
    </div>
    <div class="rodape">Etec de Guaianazes - © 2022</div>
</body>
</html>