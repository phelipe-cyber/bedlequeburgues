<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
$data_hora = date('Y-m-d H:i');
$hora_pedido = date('H:i');

// print_r($_POST);
// exit();
?>

<link href="../common/css/bootstrap.min.css" rel="stylesheet" />

<?php
include_once "conexao.php";

$detalhes = $_POST['detalhes'];

//    $nome = $_GET['nome'];
//    $preco = $_GET['preco'];
//    $cliente = $_GET['cliente'];
//    $quantidade = $_GET['quantidade'];
//    $observacoes = $_GET['observacoes'];
//    $categoria = $_GET['categoria'];
//    $mesa = $_GET['mesa'];
$usuarioid = $_SESSION['usuarioid'];

$numeropedido = $_POST['numeropedido'];
$id_pedido = $_POST['id_pedido'];

$id_mesa = $_POST['id'];

$user =  $_SESSION['user'];

$cliente = $_POST['cliente'];

// echo($numeropedido);
// exit();

if ($numeropedido == "" || $numeropedido ==  0 ) {
	
	$result_usuarios = ("SELECT MAX(numeropedido) as 'Pedido'FROM `pedido` ORDER BY numeropedido DESC limit 1 ");
	$recebidos = mysqli_query($conn, $result_usuarios);

	while ($row_usuario = mysqli_fetch_assoc($recebidos)) {

		$novo_pedido = $row_usuario['Pedido'];
	}
	if ($novo_pedido == null) {
		$novo_pedido = "1001";
	} else {

		$result_usuarios = ("SELECT MAX(numeropedido)+1 as 'Pedido'FROM `pedido` ORDER BY numeropedido DESC limit 1 ");
		$recebidos = mysqli_query($conn, $result_usuarios);

		while ($row_usuario = mysqli_fetch_assoc($recebidos)) {

			$novo_pedido = $row_usuario['Pedido'];
		}
	};

	$numeropedido = $novo_pedido;


	foreach ($detalhes as $detalhesPedidos) {

		$nome = $detalhesPedidos['pedido'];

		// $id_mesa = $_GET['id'];
		$preco_venda = $detalhesPedidos['preco_venda'];
		$quantidade = $detalhesPedidos['quantidade'];
		$observacoes = $detalhesPedidos['observacoes'];
		$categoria = $detalhesPedidos['categoria'];
		$mesa = $detalhesPedidos['mesa'];

		if ($quantidade == 0)
			continue;

		$insert_table = "INSERT INTO pedido (numeropedido, delivery,cliente, idmesa, produto, quantidade, hora_pedido, valor, observacao, pgto, usuario, data, gorjeta, `status`) VALUES
	 	('$numeropedido','','$cliente', '$id_mesa', '$nome', '$quantidade', '$hora_pedido', '$preco_venda', '$observacoes', '', '$user', '$data_hora' ,'', 2 )";
		$adiciona_pedido = mysqli_query($conn, $insert_table);
		
		$update_table = "UPDATE mesas SET status = '2', nome = '$cliente' , id_pedido = '$numeropedido' WHERE id_mesa = '$id_mesa' ";
		$update_table = mysqli_query($conn, $update_table);

		
	}
	
		echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../app/app_mesas.php'>";
		$conn->close();

	exit();
} else {


	$usuarioid = $_SESSION['usuarioid'];
	$numeropedido = $_POST['numeropedido'];
	$id_pedido = $_POST['id_pedido'];

	$id_mesa = $_POST['id'];


	// print_r($detalhes);

	foreach ($detalhes as $detalhesPedidos) {

		$nome = $detalhesPedidos['pedido'];
		// $id_mesa = $_GET['id'];
		$preco_venda = $detalhesPedidos['preco_venda'];
		$quantidade = $detalhesPedidos['quantidade'];
		$observacoes = $detalhesPedidos['observacoes'];
		$categoria = $detalhesPedidos['categoria'];
		$mesa = $detalhesPedidos['mesa'];

		if ($quantidade == 0)
			continue;

		 $insert_table = "INSERT INTO pedido (numeropedido, delivery,cliente, idmesa, produto, quantidade, hora_pedido, valor, observacao, pgto, usuario, data, gorjeta, `status`) VALUES
			('$numeropedido','','$cliente', '$id_mesa', '$nome', '$quantidade', '$hora_pedido', '$preco_venda', '$observacoes', '', '$user', '$data_hora' ,'', 2 )";
		$adiciona_pedido = mysqli_query($conn, $insert_table);
		// echo "<br>";
		$update_table = "UPDATE mesas SET status = '2', nome = '$cliente' , id_pedido = '$numeropedido' WHERE id_mesa = '$id_mesa' ";
		$update_table = mysqli_query($conn, $update_table);

	}
	echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../app/app_mesas.php'>";
	$conn->close();
};
?>




<script src="../common/js/jquery-3.3.1.slim.min.js"></script>
<script src="../common/js/popper.min.js"></script>
<script src="../common/js/bootstrap.min.js"></script>