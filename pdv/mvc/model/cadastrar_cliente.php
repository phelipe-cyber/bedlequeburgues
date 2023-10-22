<?php
	
	session_start();

	include_once ('./conexao.php');
	
	//recebe o valor que vem da tag [<input name="nome" type="text" class="form-control" id="recipient-name">]
	//recebe o valor que vem da tag [<textarea name="detalhes" class="form-control" id="detalhes-text"></textarea>]
	//recebe o valor que vem da tag invisivel [<input name="id" type="hidden" id="id_Produto">]
	
	//$nome = $POST['nome'];
	$nome = mysqli_real_escape_string($conn, $_POST['nome']);
	$endereco = mysqli_real_escape_string($conn, $_POST['endereco']);// proteção contra sql injection
	$bairro = mysqli_real_escape_string($conn, $_POST['bairro']);
	$cidade = mysqli_real_escape_string($conn, $_POST['cidade']);
	$estado = mysqli_real_escape_string($conn, $_POST['estado']);
	$complemento = mysqli_real_escape_string($conn, $_POST['complemento']);
	$cep = mysqli_real_escape_string($conn, $_POST['cep']);
	$pontoreferencia = mysqli_real_escape_string($conn, $_POST['pontoreferencia']);
	$tel1 = mysqli_real_escape_string($conn, $_POST['tel1']);
	$tel2 = mysqli_real_escape_string($conn, $_POST['tel2']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$cpfcnpj = mysqli_real_escape_string($conn, $_POST['cpfcnpj']);
	$rg = mysqli_real_escape_string($conn, $_POST['rg']);
	$condominio = mysqli_real_escape_string($conn, $_POST['condominio']);
	$blocoedificio = mysqli_real_escape_string($conn, $_POST['blocoedificio']);
	$apartamento = mysqli_real_escape_string($conn, $_POST['apartamento']);
	$localentrega = mysqli_real_escape_string($conn, $_POST['localentrega']);
	$observacoes = mysqli_real_escape_string($conn, $_POST['observacoes']);
	$number = mysqli_real_escape_string($conn, $_POST['number']);

	$endNumber = $endereco . " ,". $number;

	$insert_table = "INSERT INTO clientes (nome, endereco, bairro, cidade, estado, complemento, cep, ponto_referecia, tel1, tel2, email, cpf_cnpj, rg, condominio, bloco, apartamento, local_entrega, observacoes) VALUES ('$nome', '$endNumber', '$bairro', '$cidade', '$estado', '$complemento', '$cep', '$pontoreferencia', '$tel1', '$tel2', '$email', '$cpfcnpj', '$rg', '$condominio', '$blocoedificio', '$apartamento', '$localentrega', '$observacoes')";	
	$cadastra_cliente = mysqli_query($conn, $insert_table);

	$lat = mysqli_real_escape_string($conn, $_POST['lat']);
	$long = mysqli_real_escape_string($conn, $_POST['long']);

	$select_geo = "SELECT * FROM `cep_coordinates` WHERE postcode = '$cep' ";
	$conn_geo = mysqli_query($conn, $select_geo);

	while ($rows_geo = mysqli_fetch_assoc($conn_geo)) {
		$postcode = $rows_geo['postcode'];
	}
		if($postcode == ""){
			$insert_table_geo = "INSERT INTO `cep_coordinates`(`postcode`, `lon`, `lat`, `cd_geocodi`) VALUES ('$cep','$long','$lat','')";	
			$cadastra_geo = mysqli_query($conn, $insert_table_geo);
		}else{

		}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title></title>
</head>
<body>
	<?php

	if(mysqli_affected_rows($conn)!=-1){

		echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=/pdv/?view=clientes'>";
		$_SESSION['msg'] = "<div class='alert alert-success' role='alert'>O Cliente foi Cadastrado com Sucesso<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
	}else{

		echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=/pdv/?view=clientes'>";	
		$_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro ao cadastrar Cliente <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
	}?>

</body>
</html>

<?php $conn->close(); ?>