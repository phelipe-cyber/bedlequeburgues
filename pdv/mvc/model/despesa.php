<?php
session_start();
include_once ('./conexao.php');

date_default_timezone_set('America/Sao_Paulo');
// $data = date('Y-m-d H:i:s');
$despesa = $_POST['despesa'];

$data = $_POST['data'];

$quantidade = $_POST['qtde'];

$stringComR = $_POST['valor'];
$string_formatada = preg_replace("/[^0-9,]+/i", "", $stringComR);
$valor = str_replace(',', '.', $string_formatada);

$stringComR_VU = $_POST['valor_unitario'];
$string_format_UV = preg_replace("/[^0-9,]+/i", "", $stringComR_VU);
$valor_unitario = str_replace(',', '.', $string_format_UV);

$tab_produtos = "SELECT * FROM `produtos` where nome <> 'Frete' and id = '$despesa' ORDER by id desc" ;
$produtos = mysqli_query($conn, $tab_produtos);

while ($rows_produtos = mysqli_fetch_assoc($produtos)) {
	$estoque_atual = $rows_produtos['estoque_atual'];
	$produto = $rows_produtos['nome'];
}

if( $produto == "" ){
	$produto = $_POST['despesa'];
}

$insert_table = "INSERT INTO despesas (valor, valor_unitario, despesa, qtde, data) VALUES ('$valor', '$valor_unitario','$produto','$quantidade', '$data')";
$cadastra_despesa = mysqli_query($conn, $insert_table);

$quantidadeAtual = $estoque_atual + $quantidade;

$update = "UPDATE `produtos` SET `estoque_atual` = '$quantidadeAtual' WHERE `produtos`.`id` = '$despesa' ";
$updatequantidade = mysqli_query($conn, $update);
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
	</head>

	<body> 

	<?php

	if(mysqli_affected_rows($conn)!=-1){

		echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=/pdv/?view=despesas'>";
		$_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Despesa Cadastrada com Sucesso<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
	}else{

		echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=/pdv/?view=despesas'>";	
		$_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro ao Cadastrar Despesa <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
	}?>

		
	</body>
</html>
<?php $conn->close(); ?>