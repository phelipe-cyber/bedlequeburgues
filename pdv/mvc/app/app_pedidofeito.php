<?php

include_once "../model/conexao.php";

$id_pedido = $_GET['id_pedido'];

 $tab_mesas = "UPDATE pedido SET status_cozinha = '2'  WHERE numeropedido = '$id_pedido' ";

	$mesas = mysqli_query($conn, $tab_mesas);

	echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=app_cozinha.php'>";

	$conn->close();


?>