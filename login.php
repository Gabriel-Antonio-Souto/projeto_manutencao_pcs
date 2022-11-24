<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>PMPCL - Login </title>
    <link rel="shortcut icon" href="assets/imgs/logo_manutencao.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/estilo.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <style></style>
</head>
<body>
    <div class="cabecalho">
        <img src="assets/imgs/logo_manutencao.png" alt="logo do projeto">
        <p class="txtLogo">PMPCL</p>
        <a href="index.php" class="btnC"><button class="btnCabecalho" >Voltar</button></a>
    </div>
    <div class="boxLogin">
        <form class="formLogin" id="login">
            <fieldset>
                <legend>Login</legend>
                <input class="inputLogin" type="text" name="usuario" id="usuario" placeholder="Usuário" required>
                <input class="inputLogin" type="password" name="senha" id="senha" placeholder="Senha" required>
                <input class="btnLogin" type="submit" value="Entrar">
            </fieldset>
        </form>
    </div>
    <div class="rodape">Etec de Guaianazes - © 2022</div>




    <script src="assets/js/sweetalert2.js"></script>
    <script type="text/javascript">
        
        const formCad = document.getElementById('login');

        if(formCad){
            formCad.addEventListener("submit",async (e) =>{
               
                e.preventDefault();
            
                const dadosForm = new FormData(formCad);

                const dados = await fetch("http://localhost:8000/login",{
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
                            window.location = "area-restrita/dashboard.php";

                         }else{
                            window.location = "area-restrita/dashboard.php";           
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