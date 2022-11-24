<?php

    class Conexao
    {
        public static function conectar()
        {
            
            try{

               	$servidor="192.168.0.108";
			    $banco="bdetecapi-web";
			    $usuario="gab";
			    $senha="12345";

                $conexao = new PDO("mysql:host=$servidor;dbname=$banco",$usuario,$senha);			
                
                $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conexao->exec("SET CHARACTER SET utf8");
                    
                return $conexao;

                
            }catch(Exception $e){

                echo('ERRO AO CONECTAR: '+$e);

            }
        }
    }

?>