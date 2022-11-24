<?php 

    session_start();

    include('../api/conexao/Conexao.php');

    $con = Conexao::conectar();

    $stmt = $con->prepare("UPDATE tbpedido SET novo = 'false'");
    $stmt->execute();


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>PMPCL- Pedidos de Manutenção</title>
    <link rel="shortcut icon" href="../assets/imgs/logo_manutencao.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/estiloAreaRestrita.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>
<body>
<div class="wrapper">
    <div class="sidebar">
        <img class="logo" src="../assets/imgs/logo_manutencao.png" alt="logo do projeto">
        <h2>PMPCL</h2>
        <ul>
            <li><a href="dashboard.php"><i class="fas fa-home"></i>Dashboard</a></li>
            <li id="liAtual"><a href="pedidosManutencao.php" id="aAtual"><i class="fas fa-cogs" id="iAtual"></i>Pedidos de Manutenção</a></li>
            <li><a href="laboratorios.php"><i class="fas fa-desktop"></i>Laboratórios</a></li>
            <li><a href="usuarios.php"><i class="fas fa-address-card"></i>Usuários</a></li>
        </ul> 
        <div class="rodape">Etec de Guaianazes - © 2022</div>
    </div>
    <div class="main_content">
        <div class="header"><a href="../index.php"><button class="btnSair">Sair</button></a></div>  
        <div class="info">
          <div class="titulo">Pedidos de Manutenção</div>
          <div class="boxPedManutencao">
            <?php

            if(isset($_GET['busca1']) && isset($_GET['busca2'])){
               
                $stmt = $con->prepare("SELECT * FROM tbpedido");
                $stmt->execute();

            }else{

            
            if (isset($_GET['busca1'])) {
                $pendete = $_GET['busca1'];

                $stmt = $con->prepare("SELECT * FROM tbpedido WHERE status = '$pendete' ORDER BY idPedido DESC");
                $stmt->execute();

            }elseif(isset($_GET['busca2'])){
                $resolvido = $_GET['busca2'];

                $stmt = $con->prepare("SELECT * FROM tbpedido WHERE status = '$resolvido' ORDER BY idPedido DESC");
                $stmt->execute();

            }else{

                $stmt = $con->prepare("SELECT * FROM tbpedido ORDER BY idPedido DESC");
                $stmt->execute();
            }
              
          }

            
                
                          
            ?>
            <form class="buscasPM" action="" method="get">
                <input type="checkbox" name="busca1" value="Pendente" id="buscaPM"> Pendentes
                <input type="checkbox" name="busca2" value="Resolvido" id="buscaPM"> Concluídos
              
                <input style="margin-left: 5px;" class="btnConcluir" type="submit" value="Buscar">
              
            </form>
            <a href="../pedidos-pdf.php"><img class="iconPdf" src="../assets/imgs/carbon_document-pdf.png" alt="icone para gerar pdf"></a>
            <div class="divTb">
                <table class="tb">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Data</th>
                            <th>Hora</th>
                            <th>Assunto</th>
                            <th>Descrição</th>
                            <th>Laboratório</th>
                            <th>PC</th>
                            <th>Status</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                         <?php 

                            while($row = $stmt->fetch(PDO::FETCH_BOTH)){ ?>
                                <tr>
                                    <td><?php echo $row[0];?></td>
                                    <td><?php echo $row[10];?></td>
                                    <td><?php echo $row[11];?></td>
                                    <td><?php echo $row[5];?></td>
                                    <td><?php echo $row[6];?></td>
                                    <td><?php echo $row[3];?></td>
                                    <td><?php echo $row[4];?></td>
                                    <td><?php echo $row[12];?></td>
                                    <td>
                                        <form id="update<?php echo $row[0];?>">
                                    
                                        <input type="hidden" name="id2" id="id2" value="<?php echo $row[0];?>">
                                        <button class="btnConcluir" type="submit">Concluir</button>


                                        <script type="text/javascript">
                                            
                                            const formCad<?php echo $row[0];?> = document.getElementById('update<?php echo $row[0];?>');

                                            if(formCad<?php echo $row[0];?>){
                                                formCad<?php echo $row[0];?>.addEventListener("submit",async (e) =>{
                                                   
                                                    e.preventDefault();
                                                
                                                    const dadosForm<?php echo $row[0];?> = new FormData(formCad<?php echo $row[0];?>);

                                                    const dados<?php echo $row[0];?> = await fetch("http://localhost:8000/update/pedido",{
                                                        method: "POST",
                                                        body: dadosForm<?php echo $row[0];?>
                                                    });
                                                
                                                    const resposta<?php echo $row[0];?> = await dados<?php echo $row[0];?>.json();
                                                    console.log(resposta<?php echo $row[0];?>);

                                                    if(resposta<?php echo $row[0];?>['status']){

                                                        Swal.fire({
                                                            text: resposta<?php echo $row[0];?>['msg'],
                                                            icon: 'success',
                                                            showCancelButton: false,
                                                            confirmButtonColor: '#3085d6',
                                                            confirmButtonText: 'Fechar'
                                                          }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                window.location = "pedidosManutencao.php";
                                                             }else{
                                                                  window.location = "pedidosManutencao.php";           
                                                             }
                                                          })

                                                    }else{
                                                        Swal.fire({
                                                          text: resposta<?php echo $row[0];?>['msg'],
                                                          icon: 'error',
                                                          showCancelButton: false,
                                                          confirmButtonColor: '#3085d6',
                                                          confirmButtonText: 'Fechar'
                                                        });
                                                    }

                                                });
                                            }

                                        </script>
                                    </form>
                                    </td>
                                </tr>
                           <?php }?>
                    </tbody>    
                </table>
            </div>
          </div>
        </div>
    </div>
</div>

<script src="../assets/js/sweetalert2.js"></script>

</body>
</html>