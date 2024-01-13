<?php

session_start();

include_once('./conexao.php');

//recebe o valor que vem da tag [<input name="nome" type="text" class="form-control" id="recipient-name">]
//recebe o valor que vem da tag [<textarea name="detalhes" class="form-control" id="detalhes-text"></textarea>]
//recebe o valor que vem da tag invisivel [<input name="id" type="hidden" id="id_Produto">]

//$nome = $POST['nome'];
$id = mysqli_real_escape_string($conn, $_POST['id']);
$codigo = mysqli_real_escape_string($conn, $_POST['codigo']);
$nome = mysqli_real_escape_string($conn, $_POST['nome']); // proteção contra sql injection
$detalhes = mysqli_real_escape_string($conn, $_POST['detalhes']);
$categoria = mysqli_real_escape_string($conn, $_POST['categoria']);
$preco_custo = mysqli_real_escape_string($conn, $_POST['preco_custo']);
$preco_custo = str_replace(',', '.', $preco_custo);
$preco_venda = mysqli_real_escape_string($conn, $_POST['preco_venda']);
$preco_venda = str_replace(',', '.', $preco_venda);
$preco_venda_ifood = mysqli_real_escape_string($conn, $_POST['preco_venda_ifood']);
$preco_venda_ifood = str_replace(',', '.', $preco_venda_ifood);
$estoque_atual = mysqli_real_escape_string($conn, $_POST['estoque_atual']);
$estoque_minimo = mysqli_real_escape_string($conn, $_POST['estoque_minimo']);
$data_compra = mysqli_real_escape_string($conn, $_POST['data_compra']);
$data_compra = str_replace('-', '/', $data_compra);
$data_validade = mysqli_real_escape_string($conn, $_POST['data_validade']);
$data_validade = str_replace('-', '/', $data_validade);
$unidade = mysqli_real_escape_string($conn, $_POST['unidade']);
$marca = mysqli_real_escape_string($conn, $_POST['marca']);
$fornecedor = mysqli_real_escape_string($conn, $_POST['fornecedor']);
$observacoes = mysqli_real_escape_string($conn, $_POST['observacoes']);
$categoria = strtoupper($categoria);

// print_r($_FILES);
// print_r($_POST);
// die();
$img_edit = $_FILES['imgproduto']['name'];
if ($img_edit == "") {
	$img_edit = $_POST['img'];
} else {
	$img_antiga = $_POST['img'];
	@unlink( "../../../cardapio-online/img/cardapio/cardapioonline/".$img_antiga );
	$img_edit = $id ."_".$nome."_".$_FILES['imgproduto']['name'];
	move_uploaded_file($_FILES['imgproduto']['tmp_name'], "../../../cardapio-online/img/cardapio/cardapioonline/" . $img_edit);
}

// $nome_arquivo_inport = $_FILES['foto']['name']['ftcliente'];
// if($nome_arquivo_inport == ""){
// }else{
//   @unlink( "imagens_cliente/".$ftcliente );
//   $nome_arquivo_inport = $_FILES['foto']['name']['ftcliente'];
//   $nome_arquivoftcliente = $id_edit ."_". "self". "_". $data_hora_salve ."_". $nome_arquivo_inport;
//   move_uploaded_file($_FILES['foto']['tmp_name']['ftcliente'], "imagens_cliente/" . $nome_arquivoftcliente);
//   $Sql_update = "UPDATE `fotos_clientes` SET `ftcliente`='$nome_arquivoftcliente' WHERE id_cliente =  '$id_edit' ";
//   $salvar = mysqli_query($conn, $Sql_update);
// }

//echo "$id - $nome - $detalhes";

$insert_table = "UPDATE produtos SET
	nome = '$nome', 
	categoria = '$categoria', 
	detalhes = '$detalhes', 
	codigo = '$codigo', 
	preco_custo = '$preco_custo', 
	preco_venda = '$preco_venda', 
	estoque_atual = '$estoque_atual', 
	estoque_minimo = '$estoque_minimo', 
	data_compra = '$data_compra', 
	data_validade = '$data_validade', 
	unidade = '$unidade', 
	marca = '$marca', 
	fornecedor = '$fornecedor', 
	observacoes = '$observacoes',
	preco_venda_ifood = '$preco_venda_ifood',
	img = '$img_edit'
	 WHERE id = $id ";

$produtos_editados = mysqli_query($conn, $insert_table);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<title></title>
</head>

<body>
	<?php

	if(mysqli_affected_rows($conn)!=-1){

		echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=/pdv/?view=tabela'>";
		$_SESSION['msg'] = "<div class='alert alert-success' role='alert'>O Produto foi Editado com Sucesso<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
	}else{

		echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=/pdv/?view=tabela'>";	
		$_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro ao Editar Produto <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
	}
	?>


</body>

</html>

<?php $conn->close(); ?>