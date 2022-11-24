<?php
	require_once("api/conexao/Conexao.php");
 
	$con = Conexao::conectar();

	$resultado ="";


		$stmt = $con->prepare("SELECT * FROM tbpedido");
        $stmt->execute();

		while($row = $stmt->fetch(PDO::FETCH_BOTH)){

			$resultado .= "<tr><th>". $row[0]."</td><th>". $row[2]."</td><th>". $row[3]."</td><th>". $row[4]."</td><th>". $row[5]."</td><th>". $row[6]."</td><th>". $row[10]."</td><th>". $row[11]."</td><th>". $row[12]."</td></tr>";
            //$resultado1 .= $row['idCategoria'] . " ";
			//$resultado .= $row['categoria'] . "<br />";				
		}	

	// include autoloader
	require_once("dompdf/autoload.inc.php");
	
	//referenciar o DomPDF com namespace
	use Dompdf\Dompdf;
	
	//Criando a Instancia
	$dompdf = new DOMPDF();

	// Carrega seu HTML (Conteúdo)
	$dompdf->load_html(
		"	
		<style>

		body{
			font-family:Arial, Helvetica, sans-serif;
		}

		table, th, td {
			border: 1px solid black;
		 }
		 table {
			border-collapse: collapse;
		}
		
		table, th, td {
			border: 1px solid black;
		}
		table {
			border: 1px solid black;
		}
		table {
			width: 100%;
		}
		
		th {
			text-align: left;
		}

		th, td {
			padding: 15px;
			text-align: left;
		}
		
		tr:hover {background-color: #f5f5f5}
		tr:nth-child(even) {background-color: #f2f2f2}
		#ta {
			background-color: #204070;
			color: white;
		}

		</style>
		
			<h1 style='text-align: center;'> Pedidos Cadastrados </h1>			
			
			<h2> Pedidos: </h2>		
			
            <table>
    <thead>
        <tr>
            <th id='ta' scope='col'>ID</th>
            <th id='ta' scope='col'>Curso</th>
            <th id='ta' scope='col'>Lab</th>
            <th id='ta' scope='col'>PC</th>
            <th id='ta' scope='col'>Título</th>
            <th id='ta' scope='col'>Desc</th>
            <th id='ta' scope='col'>data</th>
            <th id='ta' scope='col'>Hora</th>
            <th id='ta' scope='col'>Status</th>
        </tr>
    </thead>
    <tbody>
            $resultado
    </tbody>
</table>

		"
	);
	
	$dompdf->setPaper('A4', 'landscape'); //landscape	
		
	//Renderizar o html
	$dompdf->render();

	//Exibibir a página
	$dompdf->stream(
		"pedidos.pdf", 
		array(
			"Attachment" => false //Para realizar o download somente alterar para true
		)
	);
?>