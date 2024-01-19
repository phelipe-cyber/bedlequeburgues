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

$hashpagina = $_POST['hashpagina'];
$troco = $_POST['troco'];

// echo($numeropedido);
// exit();

if ($numeropedido == "" || $numeropedido ==  0 ) {

$result_usuarios = ("SELECT MAX(numeropedido) as 'Pedido'FROM `pedido`ORDER BY numeropedido DESC limit 1 ");
$recebidos = mysqli_query($conn, $result_usuarios);

while ($row_usuario = mysqli_fetch_assoc($recebidos)) {

    $pedido = $row_usuario['Pedido'];
}
if ($pedido == null) {
    $pedido = "1001";
} else {


    $result_usuarios = ("SELECT MAX(numeropedido)+1 as 'Pedido'FROM `pedido` ORDER BY numeropedido DESC limit 1 ");
    $recebidos = mysqli_query($conn, $result_usuarios);

    while ($row_usuario = mysqli_fetch_assoc($recebidos)) {

        $pedido = $row_usuario['Pedido'];
    }
};

$numeropedido = $pedido;

$user =  $_SESSION['user'];
// $detalhes =  $_POST['detalhes'];
$cliente = ($_POST['cliente']);
$cliente_2 = ($_POST['cliente']);
$pgto = ($_POST['pgto']);
$tipo = ($_POST['tipo']);
$hashpagina = $_POST['app_hash'];

  $sql_previa = "SELECT * FROM `pedido_previa` where quantidade <> '' and hashpagina = '$hashpagina' order by id ASC";
    $pedido_previa = mysqli_query($conn, $sql_previa);

 while ($rows_previa = mysqli_fetch_assoc($pedido_previa)) {
    // print_r($rows_previa);
	// exit();
    
  $quantidade = $rows_previa['quantidade'];
  $pedido =     ($rows_previa['produto']);
  $preco_venda = $rows_previa['valor'];
  $observacoes = $rows_previa['observacao'];
  $id_produto = $rows_previa['id_produto'];

  
  $insert_table = "INSERT INTO pedido (numeropedido, delivery,cliente, idmesa, produto, quantidade, hora_pedido, valor, observacao, troco, pgto, usuario, `data` , gorjeta, status, frete_ifood ) VALUES
  ('$numeropedido','$tipo','$cliente', '$id_mesa', '$pedido', '$quantidade', '$hora_pedido', '$preco_venda', '$observacoes', '$troco','$pgto','$user','$data_hora' ,'' , 1, '$frete_ifood' )";

$adiciona_pedido = mysqli_query($conn, $insert_table);

$insert_table = "UPDATE mesas SET status = '2', nome = '$cliente' , id_pedido = '$numeropedido' WHERE id_mesa = $id_mesa";
$adiciona_pedido_2 = mysqli_query($conn, $insert_table);

};
//  die();

$tab_produtos = "SELECT * FROM `produtos` where nome <> 'Frete' and id = '$id_produto' ORDER by id ASC" ;
$produtos = mysqli_query($conn, $tab_produtos);

while ($rows_produtos = mysqli_fetch_assoc($produtos)) {
       $estoque_atual = $rows_produtos['estoque_atual'];
}

if( $estoque_atual == "" ){
  }else{

    $quantidadeAtual = $estoque_atual - $quantidade;
    $update = "UPDATE `produtos` SET `estoque_atual` = '$quantidadeAtual' WHERE `produtos`.`id` = '$id_produto' ";
    $updatequantidade = mysqli_query($conn, $update);

  }


  echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../app/app_mesas.php'>";
  $conn->close();
  exit();

} else {

	$numeropedido = $_POST['numeropedido'];
	$hashpagina = $_POST['app_hash'];
	$user =  $_SESSION['user'];
	$pgto = ($_POST['pgto']);
	$cliente = $_POST['cliente'];
	$user =  $_SESSION['user'];
	$detalhes =  $_POST['detalhes'];
	$pgto = $_POST['pgto'];
	$tipo = $_POST['tipo'];
	
	 $sql_previa = "SELECT * FROM `pedido_previa` where quantidade <> '' and hashpagina = '$hashpagina' order by id ASC";
		$pedido_previa = mysqli_query($conn, $sql_previa);
	
	 while ($rows_previa = mysqli_fetch_assoc($pedido_previa)) {
		
	  $quantidade = $rows_previa['quantidade'];
	  $pedido =     ($rows_previa['produto']);
	  $preco_venda = $rows_previa['valor'];
	  $observacoes = $rows_previa['observacao'];
	  $id_produto = $rows_previa['id_produto'];
	
	
	  $insert_table = "INSERT INTO pedido (numeropedido, delivery,cliente, idmesa, produto, quantidade, hora_pedido, valor, observacao, troco, pgto, usuario, `data` , gorjeta, status, frete_ifood ) VALUES
	  ('$numeropedido','$tipo','$cliente', '$id_mesa', '$pedido', '$quantidade', '$hora_pedido', '$preco_venda', '$observacoes', '$troco','$pgto','$user','$data_hora' ,'' , 1, '$frete_ifood' )";
  
	  $adiciona_pedido = mysqli_query($conn, $insert_table);
	  
	  $insert_table = "UPDATE mesas SET status = '2', nome = '$cliente', id_pedido = '$numeropedido' WHERE id_mesa = $id_mesa";
	  $adiciona_pedido_2 = mysqli_query($conn, $insert_table);
	  
	  $tab_produtos = "SELECT * FROM `produtos` where nome <> 'Frete' and id = '$id_produto' ORDER by id ASC" ;
	  $produtos = mysqli_query($conn, $tab_produtos);
	  
	  while ($rows_produtos = mysqli_fetch_assoc($produtos)) {
			 $estoque_atual = $rows_produtos['estoque_atual'];
	  }
	
	  if( $estoque_atual == "" ){
	  }else{
	
		$quantidadeAtual = $estoque_atual - $quantidade;
		$update = "UPDATE `produtos` SET `estoque_atual` = '$quantidadeAtual' WHERE `produtos`.`id` = '$id_produto' ";
		$updatequantidade = mysqli_query($conn, $update);
	
	  }
	
	};
	
	echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=../app/app_mesas.php'>";
	$conn->close();
	exit();
};
?>




<script src="../common/js/jquery-3.3.1.slim.min.js"></script>
<script src="../common/js/popper.min.js"></script>
<script src="../common/js/bootstrap.min.js"></script>