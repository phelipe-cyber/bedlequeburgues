<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
$data_hora = date('Y-m-d H:i');
$hora_pedido = date('H:i');

include_once ("conexao.php");


if( $_POST['pedido'] <> ""){
  print_r($_POST);
  echo "Não Vazio";
  die();
  
$numeropedido = $_POST['pedido'];

$user =  $_SESSION['user'];
$detalhes =  $_POST['detalhes'];
$cliente = ($_POST['cliente']);
$cliente_2 = ($_POST['cliente']);
$pgto = $_POST['pgto'];

$sql_previa = "SELECT * FROM `pedido_previa` where quantidade <> '' and hashpagina = '$hashpagina' GROUP BY id_produto order by id ASC";
    $pedido_previa = mysqli_query($conn, $sql_previa);

 while ($rows_previa = mysqli_fetch_assoc($pedido_previa)) {
    // print_r($rows_previa);
    
  $quantidade = $rows_previa['quantidade'];
  $pedido =     ($rows_previa['produto']);
  $preco_venda = $rows_previa['valor'];
  $observacoes = $rows_previa['observacao'];

   $insert_table = "INSERT INTO pedido (numeropedido, delivery,cliente, idmesa, produto, quantidade, hora_pedido, valor, observacao, pgto ,usuario, `data`, gorjeta, status) VALUES
  ('$numeropedido','','$cliente', '$id_mesa', '$pedido', '$quantidade', '$hora_pedido', '$preco_venda', '$observacoes','$pgto','$user', '$data_hora','', 1 )";
 
  $adiciona_pedido = mysqli_query($conn, $insert_table);
  
  $insert_table = "UPDATE mesas SET status = '2', nome = '$cliente', id_pedido = '$numeropedido' WHERE id_mesa = $id_mesa";
  $adiciona_pedido_2 = mysqli_query($conn, $insert_table);

};

header("Location: /pdv/?view=todosPedidoBalcao");
$conn->close();


echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=/pdv/?view=pedidoBalcao'>";
$_SESSION['msg'] = "<div class='alert alert-success' role='alert'> Pedido para $cliente_2 cadastrado com sucesso!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";


    exit();
}else{

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
$hashpagina = $_POST['hashpagina'];

// foreach ($detalhes as $detalhesPedidos) {

  // $quantidade = $detalhesPedidos['quantidade'];
  // $pedido =     ($detalhesPedidos['pedido']);
  // $preco_venda = $detalhesPedidos['preco_venda'];
  // $observacoes = $detalhesPedidos['observacoes'];
  
  
  // if ($quantidade == 0 )
  // continue;
  
  // print_r($_POST);
//   echo "<br>";
  // print_r($_POST['cliente']);
  // exit();

  $sql_previa = "SELECT * FROM `pedido_previa` where quantidade <> '' and hashpagina = '$hashpagina' GROUP BY id_produto order by id ASC";
    $pedido_previa = mysqli_query($conn, $sql_previa);

 while ($rows_previa = mysqli_fetch_assoc($pedido_previa)) {
    // print_r($rows_previa);
    
  $quantidade = $rows_previa['quantidade'];
  $pedido =     ($rows_previa['produto']);
  $preco_venda = $rows_previa['valor'];
  $observacoes = $rows_previa['observacao'];
  
  $insert_table = "INSERT INTO pedido (numeropedido, delivery,cliente, idmesa, produto, quantidade, hora_pedido, valor, observacao, pgto, usuario, `data` , gorjeta, status ) VALUES
  ('$numeropedido','','$cliente', '$id_mesa', '$pedido', '$quantidade', '$hora_pedido', '$preco_venda', '$observacoes', '$pgto','$user','$data_hora' ,'' , 1 )";

$adiciona_pedido = mysqli_query($conn, $insert_table);

$insert_table = "UPDATE mesas SET status = '2', nome = '$cliente' , id_pedido = '$numeropedido' WHERE id_mesa = $id_mesa";
$adiciona_pedido_2 = mysqli_query($conn, $insert_table);

};
//  die();

$novoIdInserido = $conn->insert_id;

// header("Location: /pdv/?view=todosPedidoBalcao");
// header("Location: /pdv/mvc/model/imprime_balcao.php");

// echo "<script language='javascript'>window.open('/pdv/mvc/model/imprime_balcao.php','_blank');</script>";
// $conn->close(); 
echo "<META http-equiv='refresh' content='0;URL=/pdv/mvc/model/imprimir.php' target='_blank'>";

$_SESSION['novoIdInserido'] = $numeropedido;
$_SESSION['$cliente'] = $cliente;

// echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=/pdv/?view=pedidoBalcao'>";
$_SESSION['msg'] = "<div class='alert alert-success' role='alert'> Pedido para $numeropedido cadastrado com sucesso!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";

}