<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>PMPCL - Pedido de Manutenção </title>
    <link rel="shortcut icon" href="assets/imgs/logo_manutencao.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/estilo.css">
    <style>
        .boxFormPedMan{
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        h2{
            font-size: 30px;
            margin-top: 25px;
        }

        .fieldsetPM{
            width: 700px;
            border: solid 2px;
            border-radius: 15px;
            border-color: #FFFFFF;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
            padding: 15px;
        }

        .reclamante{
            height: 150px;
        }

        .espPedido{
            height: 320px;
        }

        .legendPM{
            font-size: 25px;
            margin-left: 15px;
        }

        .inputPM{
            width: 95%;
            height: 35px;
            border-radius: 5px;
            border-color: #7ED6F2; 
            background-color: transparent;
            margin-bottom: 18px;
            padding-left: 10px;
            color: #fff;
        }

        .rowInputs{
            width: 97.3%;
            display: inline-flex;
        }

        .tp1{
            margin-right: 2%;
        }

        #descPedido{
            height: 150px;
        }

        .btnEnviar{
            width: 100%;
            height: 45px;
            background-color: #50C3E8;
            border-color: #50C3E8;
            border-radius: 5px;
            color: #FFFFFF;
            text-transform: uppercase;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 70px;
        }

    </style>
</head>
<body>
    <div class="cabecalho">
        <img src="assets/imgs/logo_manutencao.png" alt="logo do projeto">
        <p class="txtLogo">PMPCL</p>
        <a href="index.php" class="btnC"><button class="btnCabecalho" >Voltar</button></a>
    </div>
    <div class="boxFormPedMan">
        <h2>Formulário do Pedido de Manutenção</h2>
        <form class="formPedidoManutencao" id="ped_aluno">
            <fieldset class="fieldsetPM reclamante">
                <legend class="legendPM">Reclamante</legend>
                <input class="inputPM" type="text" name="nomeReclamante" id="nomeReclamante" placeholder="Nome" required>
                <div class="rowInputs">
                    <input class="inputPM tp1" type="text" name="curso" id="curso" placeholder="Curso" required>
                    <input class="inputPM" type="text" name="periodo" id="periodo" placeholder="Período" required>
                </div>
            </fieldset>
            <fieldset class="fieldsetPM espPedido">
                <legend class="legendPM">Especificação do Pedido</legend>
                <div class="rowInputs">
                    <input class="inputPM tp1" type="text" name="nomeLab" id="nomeLab" placeholder="Laboratório" required>
                    <input class="inputPM" type="text" name="pc" id="pc" placeholder="Computador" required>
                </div>
                <input class="inputPM" type="text" name="tituloPedido" id="tituloPedido" placeholder="Título do Pedido" required>
                <textarea class="inputPM"  name="descPedido" id="descPedido" placeholder="Descreva o problema aqui..." required></textarea>
            </fieldset>
            <button class="btnEnviar" type="submit">Enviar</button>
        </form>
    </div>
    <div class="rodape" style="bottom: 0px; position: relative;">Etec de Guaianazes - © 2022</div>



    <script src="assets/js/sweetalert2.js"></script>
    <script type="text/javascript">
        
        const formCad = document.getElementById('ped_aluno');

        if(formCad){
            formCad.addEventListener("submit",async (e) =>{
               
                e.preventDefault();
            
                const dadosForm = new FormData(formCad);

                const dados = await fetch("http://localhost:8000/pedido/aluno",{
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
                            location.reload('formPedManutencao-aluno.php');
                         }else{
                              location.reload('formPedManutencao-aluno.php');           
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