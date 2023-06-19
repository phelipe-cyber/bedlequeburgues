<?php
session_start();
include_once("conexao.php");

// print_r($_POST);
// exit();

$user =  $_SESSION['user'];
$hora_pedido = date('H:i');
// $pedido = $_POST['pedido'];
// $preco_venda = $_POST['preco_venda'];
// $quantidade = $_POST['quantidade'];
// $observacoes = $_POST['observacoes'];
$id_mesa = $_POST['id_mesa'];
$cliente = $_POST['cliente'];
$detalhes =  $_POST['detalhes'];
$mesa =  $_POST['mesa'];


if($mesa == 'delivery'){
  $status = 5;
}else{
  $status = 1;
}

foreach ($detalhes as $detalhesPedidos) {

  $quantidade = $detalhesPedidos['quantidade'];
  $pedido =     ($detalhesPedidos['pedido']);
  $preco_venda = $detalhesPedidos['preco_venda'];
  $observacoes = $detalhesPedidos['observacoes'];


  if ($quantidade == 0)
    continue;


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


 $insert_table = "INSERT INTO pedido ( numeropedido, delivery,cliente, idmesa, produto, quantidade, hora_pedido, valor, observacao, usuario, gorjeta, status) 
 VALUES ('$numeropedido','','$cliente', '$mesa', '$pedido', '$quantidade', '$hora_pedido', '$preco_venda', '$observacoes', '$user', '', $status )";

//  echo $insert_table;
//  echo "<br>";
  $adiciona_pedido = mysqli_query($conn, $insert_table);

  $update_table = "UPDATE mesas SET status = '2', nome = '$cliente', id_pedido = '$numeropedido' WHERE id_mesa = $id_mesa";
  $update_pedido = mysqli_query($conn, $update_table);
 
  header("Location: /pdv/?view=pedidos_delivery");

  $conn->close();

  echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=/pdv/?view=pedidos_delivery'>";
  $_SESSION['msg'] = "<div class='alert alert-success' role='alert'> Pedido para $id_mesa cadastrado com sucesso!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
}
