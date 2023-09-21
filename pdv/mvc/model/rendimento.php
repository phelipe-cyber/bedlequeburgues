<?php
session_start();

date_default_timezone_set('America/Sao_Paulo');
// $data = date('Y-m-d H:i:s');

// $data = date('d/m/Y');

include_once ('./conexao.php');

$rendimento = $_POST['rendimento'];

$data = $_POST['data'];

$cliente = $_POST['cliente'];

$valor = $_POST['valor'];

$pgto = $_POST['pgto'];

//  $insert_table = "INSERT INTO vendas (valor, cliente, rendimento, data) 

 $insert_table = "INSERT INTO vendas ( id_pedido, valor, valor_maquina, cliente, rendimento, pgto, data) VALUES ('', '$valor', '', '$cliente', '$rendimento', '$pgto' , '$data')";

// VALUES ('$valor', '$cliente', '$rendimento', '$data')";


$cadastra_despesa = mysqli_query($conn, $insert_table);

?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
	</head>

	<body> 

	<?php

	if(mysqli_affected_rows($conn)!=-1){

		echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=/pdv/?view=financeiro'>";
		$_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Rendimento Cadastrado com Sucesso<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
	}else{

		echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=/pdv/?view=financeiro'>";	
		$_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro ao Cadastrar Rendimento <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
	}?>

		
	</body>
</html>
<?php $conn->close(); ?>