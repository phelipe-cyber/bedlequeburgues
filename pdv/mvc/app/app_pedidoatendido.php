<?php

include_once "../model/conexao.php";

$id = $_GET['id'];

	$tab_mesas = "UPDATE mesas SET status = '3'  WHERE id_mesa = $id";

	$mesas = mysqli_query($conn, $tab_mesas);


	$update_pedido_mesa = "UPDATE pedido SET status = '3'  WHERE idmesa = $id";

	$UpdatePedidoMesas = mysqli_query($conn, $update_pedido_mesa);

	echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=app_mesas.php'>";

	$conn->close();


?>