<?php
session_start();

include_once ('./conexao.php');

$id = $_POST['pedido'];
$mesa = $_POST['mesa'];
$idproduto = $_POST['idproduto'];


$exclude_table = "DELETE FROM pedido WHERE idpedido = '$idproduto' and numeropedido = '$id' ";

$produto_excluido = mysqli_query($conn, $exclude_table);

	echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=/pdv/?view=todosPedidoBalcao'>";
		$_SESSION['msg'] = "<div class='alert alert-success' role='alert'> Pedido da mesa $mesa excluido com sucesso!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";

$conn->close();

?>