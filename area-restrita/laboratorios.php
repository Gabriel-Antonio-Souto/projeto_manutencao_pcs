<?php 

    session_start();

    include('../api/conexao/Conexao.php');

    $con = Conexao::conectar();


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>PMPCL- Laboratórios</title>
    <link rel="shortcut icon" href="../assets/imgs/logo_manutencao.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/estiloAreaRestrita.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    </style>
</head>
<body>
<div class="wrapper">
    <div class="sidebar">
        <img class="logo" src="../assets/imgs/logo_manutencao.png" alt="logo do projeto">
        <h2>PMPCL</h2>
        <ul>
            <li><a href="dashboard.php"><i class="fas fa-home"></i>Dashboard</a></li>
            <li><a href="pedidosManutencao.php"><i class="fas fa-cogs"></i>Pedidos de manutenção</a></li>
            <li id="liAtual"><a href="laboratorios.php" id="aAtual"><i class="fas fa-desktop" id="iAtual"></i>Laboratórios</a></li>
            <li><a href="usuarios.php"><i class="fas fa-address-card"></i>Usuários</a></li>
        </ul> 
        <div class="rodape">Etec de Guaianazes - © 2022</div>
    </div>
    <div class="main_content">
        <div class="header"><a href="../index.php"><button class="btnSair">Sair</button></a></div>  
        <div class="info">
          <div class="titulo">Laboratórios</div>
          <div class="boxFormLabs">
            <h3>Cadastrar um novo laboratório</h3>
            <form id="cad_lab">
                <div class="inputsForms">
                    <div class="combInputLab">
                        <label>Nome:</label> 
                        <input class="inputForms nomeLab" value="<?php echo @$_GET['lab'] ?>" type="text" name="nomeLab" id="nomeLab" placeholder="Lab 1" required>
                        <input type="hidden" name="id" value="<?php echo @$_GET['id'] ?>" id="id">
                    </div>
                    <div class="combInputLab quantPcs">
                        <label>Quantidade de PCs:</label>
                        <input class="inputForms" type="number" value="<?php echo @$_GET['qtd'] ?>" name="quantPcs" id="quantPcs" placeholder="10" required>
                    </div>
                    <div class="combInputLab obs">
                        <label>Obs:</label>
                        <input class="inputForms" type="text" value="<?php echo @$_GET['obs'] ?>" name="obs" id="obs" placeholder="Escreva uma observação sobre esse lab...">
                    </div>
                </div>
                <div class="btnsForm">
                    <input class="btnCancelar" type="reset" value="Cancelar">
                    <input class="btnSalvar" type="submit" value="Salvar">
                </div>
            </form>
          </div>
          <div class="boxTbLabs">
            <h3 class="tituloBox">Laboratórios cadastrados</h3>
            <a href="../labs-pdf.php"><img class="iconPdf" src="../assets/imgs/carbon_document-pdf.png" alt="icone para gerar pdf"></a>
            <div class="divTb">
                <table class="tb">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nome</th>
                            <th>Quantidade de PCs</th>
                            <th>Observações</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 

                            $stmt = $con->prepare("SELECT * FROM tblab");
                            $stmt->execute();
                      
                            while($row = $stmt->fetch(PDO::FETCH_BOTH)){ ?>
                        <tr>
                            <td><?php echo $row[0];?></td>
                            <td><?php echo $row[1];?></td>
                            <td><?php echo $row[2];?></td>
                            <td><?php echo $row[3];?></td>
                            <td class="btnsTb">
                                <a href="?id=<?php echo $row[0];?>&lab=<?php echo $row[1];?>&qtd=<?php echo $row[2];?>&obs=<?php echo $row[3];?>"><button class="btnEditar">Editar</button></a><br>

                                <form id="delete<?php echo $row[0];?>">
                                    
                                    <input type="hidden" name="id2" id="id2" value="<?php echo $row[0];?>">
                                        <button class="btnExcluir" type="submit">Excluir</button>



                                        <script type="text/javascript">
                                            
                                            const formCad<?php echo $row[0];?> = document.getElementById('delete<?php echo $row[0];?>');

                                            if(formCad<?php echo $row[0];?>){
                                                formCad<?php echo $row[0];?>.addEventListener("submit",async (e) =>{
                                                   
                                                    e.preventDefault();
                                                
                                                    const dadosForm<?php echo $row[0];?> = new FormData(formCad<?php echo $row[0];?>);

                                                    const dados<?php echo $row[0];?> = await fetch("http://localhost:8000/delete/lab",{
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
                                                                window.location = "laboratorios.php";
                                                             }else{
                                                                  window.location = "laboratorios.php";           
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
    <script type="text/javascript">
        
        const formCad = document.getElementById('cad_lab');

        if(formCad){
            formCad.addEventListener("submit",async (e) =>{
               
                e.preventDefault();
            
                const dadosForm = new FormData(formCad);

                const dados = await fetch("http://localhost:8000/cadastro/lab",{
                    method: "POST",
                    body: dadosForm
                });
            
                const resposta = await dados.json();
                console.log(resposta);

                if(resposta['status']){

                    Swal.fire({
                        text: resposta['msg'],
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Fechar'
                      }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = "laboratorios.php";
                         }else{
                              window.location = "laboratorios.php";           
                         }
                      })

                }else{
                    Swal.fire({
                      text: resposta['msg'],
                      icon: 'error',
                      showCancelButton: false,
                      confirmButtonColor: '#3085d6',
                      confirmButtonText: 'Fechar'
                    });
                }

            });
        }

    </script>
</body>
</html>