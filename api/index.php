<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';

header("Access-Control-Allow-Origin: *");

require 'conexao/Conexao.php';

$app = AppFactory::create();

$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    
    include('cpf.php');

    $name = $args['name'];

    if ( valida_cpf( '575.663.188-70' ) ) {
        $r = "CPF é válido.";
    } else {
        $r = "CPF Inválido.";
    }
    

    $response->getBody()->write($r);
    return $response;
});

$app->post('/pedido/aluno', function (Request $request, Response $response, array $args) {
    
    $con = Conexao::conectar();

    date_default_timezone_set('America/Sao_Paulo'); 

    $post = $request->getParsedBody();

    $nome = $post['nomeReclamante'];
    $curso = $post['curso'];
    $periodo = $post['periodo'];
    $lab = $post['nomeLab'];
    $pc = $post['pc'];
    $titulo = $post['tituloPedido'];
    $desc = $post['descPedido'];
    $hora = date('h:i:s');
    $status = "Pendente";
    $novo = "true";

    $stmt = $con->prepare("INSERT INTO tbpedido(periodo, turma, lab, computador, titulo, descPedido, nomeAluno, dataPedido,horaPedido,status,novo) VALUES (?,?,?,?,?,?,?,CURDATE(),?,?,?)");
    $stmt->bindValue(1, $periodo);
    $stmt->bindValue(2, $curso);
    $stmt->bindValue(3, $lab);  
    $stmt->bindValue(4, $pc);  
    $stmt->bindValue(5, $titulo);  
    $stmt->bindValue(6, $desc);  
    $stmt->bindValue(7, $nome);    
    $stmt->bindValue(8, $hora);  
    $stmt->bindValue(9, $status);  
    $stmt->bindValue(10, $novo);  

    $stmt->execute();

    $retorna = ['status' => true, 'msg' => 'Pedido enviado com sucesso!'];

    $json = json_encode($retorna);
    

    $response->getBody()->write($json);
    return $response;


});


$app->post('/pedido/prof', function (Request $request, Response $response, array $args) {

    $con = Conexao::conectar();

    include('cpf.php');

    date_default_timezone_set('America/Sao_Paulo'); 

    $post = $request->getParsedBody();

    $nome = $post['nomeReclamante'];
    $curso = $post['curso'];
    $cpf = $post['cpf'];
    $lab = $post['nomeLab'];
    $pc = $post['pc'];
    $titulo = $post['tituloPedido'];
    $desc = $post['descPedido'];
    $hora = date('h:i:s');
    $status = "Pendente";
    $novo = "true";


     if ( valida_cpf($cpf) ) {
        //$r = "CPF é válido.";]
        $stmt = $con->prepare("INSERT INTO tbpedido(turma, lab, computador, titulo, descPedido, nomeProf,cpfProf, dataPedido,horaPedido,status,novo) VALUES (?,?,?,?,?,?,?,CURDATE(),?,?,?)");
        $stmt->bindValue(1, $curso);
        $stmt->bindValue(2, $lab);
        $stmt->bindValue(3, $pc);  
        $stmt->bindValue(4, $titulo);  
        $stmt->bindValue(5, $desc);  
        $stmt->bindValue(6, $nome);  
        $stmt->bindValue(7, $cpf);    
        $stmt->bindValue(8, $hora);
        $stmt->bindValue(9, $status);
        $stmt->bindValue(10, $novo);

        $stmt->execute();


        $retorna = ['status' => true, 'msg' => 'Pedido enviado com sucesso!'];
   
    } else {
        //$r = "CPF Inválido.";
        $retorna = ['status' => false, 'msg' => 'CPF Inválido!'];

    }


    $json = json_encode($retorna);

    $response->getBody()->write($json);
    return $response;

});


$app->post('/cadastro/adm', function (Request $request, Response $response, array $args) {

    $con = Conexao::conectar();

    $post = $request->getParsedBody();

    $id = $post['id'];
    $nome = $post['nomeResponsavel'];
    $user = $post['usuario'];
    $senha = $post['senha'];

    if ($id > 0) {
        
        $stmt = $con->prepare("UPDATE tbadm SET userAdm = ?,nomeAdm = ?,senhaAdm = ? WHERE idAdm = ?");
        $stmt->bindValue(1, $user);
        $stmt->bindValue(2, $nome);
        $stmt->bindValue(3, $senha);  
        $stmt->bindValue(4, $id);  

        $stmt->execute();

        $retorna = ['status' => true, 'msg' => 'Usuário atualizado com sucesso!'];

    }else{

        $stmt = $con->prepare("INSERT INTO tbadm(userAdm,nomeAdm,senhaAdm) VALUES (?,?,?)");
        $stmt->bindValue(1, $user);
        $stmt->bindValue(2, $nome);
        $stmt->bindValue(3, $senha);  

        $stmt->execute();

        $retorna = ['status' => true, 'msg' => 'Usuário cadastrado com sucesso!'];

    }

    $json = json_encode($retorna);

    $response->getBody()->write($json);
    return $response;

});


$app->post('/login', function (Request $request, Response $response, array $args) {
   
    try{
        session_start();

        $con = Conexao::conectar();

        $post = $request->getParsedBody();

        $user = $post['usuario'];
        $senha = $post['senha'];

        $stmt = $con->prepare("SELECT * FROM tbadm WHERE 
            userAdm = :e and senhaAdm = :s");
        $stmt->bindValue(":e", $user);
        $stmt->bindValue(":s", $senha);
        $stmt->execute();

                $idBanco = '';
                $userBanco = '';
                $senhaBanco = '';

            while($row = $stmt->fetch(PDO::FETCH_BOTH)){

                $idBanco = $row['idAdm'];
                $userBanco = $row['userAdm'];
                $senhaBanco = $row['senhaAdm'];
                
            }

            if (($user == $userBanco)&& ($senha == $senhaBanco)){

                $_SESSION['id'] = $idBanco;
                $_SESSION['user'] = $userBanco;
                $_SESSION['senha'] = $senhaBanco;

                $retorna = ['status' => true, 'msg' => 'Login realizado com sucesso!'];

            
            }else{
                
                
                $retorna = ['status' => false, 'msg' => 'Usuário ou senha incorretos!'];


            }

        }catch(Exception $e){

            $retorna = ['status' => false, 'msg' => $e];

        }

    $json = json_encode($retorna);

    $response->getBody()->write($json);
    return $response;


});




$app->post('/delete/adm', function (Request $request, Response $response, array $args) {

    $con = Conexao::conectar();

    $post = $request->getParsedBody();

    $id = $post['id2'];
       
        $stmt = $con->prepare("DELETE FROM tbadm WHERE idAdm = ?");
        $stmt->bindValue(1, $id);  

        $stmt->execute();

        $retorna = ['status' => true, 'msg' => 'Usuário deletado com sucesso!'];

    
    $json = json_encode($retorna);

    $response->getBody()->write($json);
    return $response;

});




$app->post('/cadastro/lab', function (Request $request, Response $response, array $args) {

    $con = Conexao::conectar();

    $post = $request->getParsedBody();

    $id = $post['id'];
    $nomeLab = $post['nomeLab'];
    $qtdPcs = $post['quantPcs'];
    $obs = $post['obs'];

    if ($id > 0) {
        
        $stmt = $con->prepare("UPDATE tblab SET nomeLab = ?,qntdComputador = ?,obsLab = ? WHERE idLab = ?");
        $stmt->bindValue(1, $nomeLab);
        $stmt->bindValue(2, $qtdPcs);
        $stmt->bindValue(3, $obs);  
        $stmt->bindValue(4, $id);  

        $stmt->execute();

        $retorna = ['status' => true, 'msg' => 'Laboratório atualizado com sucesso!'];

    }else{

        $stmt = $con->prepare("INSERT INTO tblab(nomeLab,qntdComputador,obsLab) VALUES (?,?,?)");
        $stmt->bindValue(1, $nomeLab);
        $stmt->bindValue(2, $qtdPcs);
        $stmt->bindValue(3, $obs);   

        $stmt->execute();

        $retorna = ['status' => true, 'msg' => 'Laboratório cadastrado com sucesso!'];

    }

    $json = json_encode($retorna);

    $response->getBody()->write($json);
    return $response;

});



$app->post('/delete/lab', function (Request $request, Response $response, array $args) {

    $con = Conexao::conectar();

    $post = $request->getParsedBody();

    $id = $post['id2'];
       
        $stmt = $con->prepare("DELETE FROM tblab WHERE idLab = ?");
        $stmt->bindValue(1, $id);  

        $stmt->execute();

        $retorna = ['status' => true, 'msg' => 'Laboratório deletado com sucesso!'];

    
    $json = json_encode($retorna);

    $response->getBody()->write($json);
    return $response;

});



$app->post('/update/pedido', function (Request $request, Response $response, array $args) {

    $con = Conexao::conectar();

    $post = $request->getParsedBody();

    $id = $post['id2'];
    $status = 'Resolvido';
       
        $stmt = $con->prepare("UPDATE tbpedido set status = ? WHERE idPedido = ?");
        $stmt->bindValue(1, $status);  
        $stmt->bindValue(2, $id);  

        $stmt->execute();

        $retorna = ['status' => true, 'msg' => 'Pedido resolvido com sucesso!'];

    
    $json = json_encode($retorna);

    $response->getBody()->write($json);
    return $response;

});



$app->run();