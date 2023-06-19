<?php
include "./mvc/model/conexao.php";
// print_r($_POST);

$id = $_POST['id'];

$aceitar = "UPDATE pedido SET status = 1 WHERE numeropedido LIKE '$id' ";
// print_r($aceitar);

// $grava_atualização = mysqli_query($conn, $aceitar);

$grava_atualização = mysqli_query($conn, $aceitar) or die(mysqli_error($conn));

echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=/pdv/?view=todosPedidoBalcao'>";
$conn->close();

