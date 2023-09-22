<?php
session_start();

include_once ('./conexao.php');

$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$cep = $_POST['cep_2'];

 $insert_table = "INSERT INTO `cep_coordinates`(`postcode`, `lon`, `lat`, `cd_geocodi`) 
VALUES ('$cep','$longitude','$latitude','NULL') ";
$edita_cliente = mysqli_query($conn, $insert_table);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title></title>
</head>
<body>
	<?php

	if(mysqli_affected_rows($conn)!=-1){

		echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=/pdv/?view=geolocalizacao'>";
		$_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Cadastrado com Sucesso<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
	}else{

		echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=/pdv/?view=geolocalizacao'>";	
		$_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro ao Cadastrar  <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
	}?>


</body>
</html>

<?php $conn->close(); ?>