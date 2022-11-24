<?php 

    session_start();

    include('../api/conexao/Conexao.php');

    $con = Conexao::conectar();


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>PMPCL- Usuários</title>
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
            <li><a href="pedidosManutencao.php"><i class="fas fa-cogs"></i>Pedidos de manutenção</a></li>
            <li><a href="laboratorios.php"><i class="fas fa-desktop"></i>Laboratórios</a></li>
            <li id="liAtual"><a href="usuarios.php" id="aAtual"><i class="fas fa-address-card" id="iAtual"></i>Usuários</a></li>
        </ul> 
        <div class="rodape">Etec de Guaianazes - © 2022</div>
    </div>
    <div class="main_content">
        <div class="header"><a href="../index.php"><button class="btnSair">Sair</button></a></div>  
        <div class="info">
          <div class="titulo">Responsáveis pela manutenção</div>
          <div class="boxFormLabs">
            <h3>Cadastrar um novo responsável</h3>
            <form class="formLab" id="cad_adm">
                <div class="inputsForms">
                    <div class="combInputUser">
                        <label>Nome:</label> 
                        <input class="inputForms" type="text" value="<?php echo @$_GET['nome'] ?>" name="nomeResponsavel" id="nomeResponsavel" placeholder="Alicia Ferreira" required>
                        <input type="hidden" name="id" id="id" value="<?php echo @$_GET['id'] ?>">
                    </div>
                    <div class="combInputUser">
                        <label>Usuário:</label>
                        <input class="inputForms" type="text" value="<?php echo @$_GET['user'] ?>" name="usuario" id="usuario" placeholder="Ali_Ferreira" required>
                    </div>
                    <div class="combInputUser">
                        <label>Senha:</label>
                        <input class="inputForms" type="password" value="<?php echo @$_GET['senha'] ?>" name="senha" id="senha" placeholder="****" required>
                    </div>
                    <!-- <div class="combInputUser">
                        <label>Confirmar senha:</label>
                        <input class="inputForms confSenha" type="password" name="senha" id="senha" placeholder="****" required>
                    </div> -->
                </div>
                <div class="btnsForm">
                    <input class="btnCancelar" type="reset" value="Cancelar">
                    <input class="btnSalvar" type="submit" value="Salvar">
                </div>
            </form>
          </div>
          <div class="boxTbLabs">
            <h3 class="tituloBox">Responsáveis  cadastrados</h3>
            <a href="../adm-pdf.php"><img class="iconPdf" src="../assets/imgs/carbon_document-pdf.png" alt="icone para gerar pdf"></a>
            <div class="divTb">
                <table class="tb">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nome</th>
                            <th>Usuário</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php 

                            $stmt = $con->prepare("SELECT * FROM tbadm");
                            $stmt->execute();
                      
                            while($row = $stmt->fetch(PDO::FETCH_BOTH)){ ?>
                                <tr>         
                                    <td><?php echo $row[0];?></td>
                                    <td><?php echo $row[2];?></td>
                                    <td><?php echo $row[1];?></td>
                                    <td class="btnsTb">
                                        <a href="?id=<?php echo $row[0];?>&user=<?php echo $row[2];?>&nome=<?php echo $row[1];?>&senha=<?php echo $row[3];?>"><button class="btnEditar">Editar</button></a><br>

                                        <form id="delete<?php echo $row[0];?>">
                                            <input type="hidden" name="id2" id="id2" value="<?php echo $row[0];?>">
                                        <button class="btnExcluir" type="submit">Excluir</button>



                                        <script type="text/javascript">
                                            
                                            const formCad<?php echo $row[0];?> = document.getElementById('delete<?php echo $row[0];?>');

                                            if(formCad<?php echo $row[0];?>){
                                                formCad<?php echo $row[0];?>.addEventListener("submit",async (e) =>{
                                                   
                                                    e.preventDefault();
                                                
                                                    const dadosForm<?php echo $row[0];?> = new FormData(formCad<?php echo $row[0];?>);

                                                    const dados<?php echo $row[0];?> = await fetch("http://localhost:8000/delete/adm",{
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
                                                                window.location = "usuarios.php";
                                                             }else{
                                                                  window.location = "usuarios.php";           
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
        
        const formCad = document.getElementById('cad_adm');

        if(formCad){
            formCad.addEventListener("submit",async (e) =>{
               
                e.preventDefault();
            
                const dadosForm = new FormData(formCad);

                const dados = await fetch("http://localhost:8000/cadastro/adm",{
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
                            window.location = "usuarios.php";
                         }else{
                              window.location = "usuarios.php";           
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