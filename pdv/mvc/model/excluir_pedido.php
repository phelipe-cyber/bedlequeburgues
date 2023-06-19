<?php
include "conexao.php";
// print_r($_POST);
// die();
$id = $_POST['id'];

$excluir = "DELETE FROM `pedido` WHERE `pedido`.`numeropedido` = '$id' ";
// print_r($excluir);
$grava_atualização = mysqli_query($conn, $excluir) or die(mysqli_error($conn));

echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=/pdv/?view=todosPedidoBalcao'>";
$conn->close();
