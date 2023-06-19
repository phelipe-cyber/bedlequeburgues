<?php
session_start();
include_once("conexao.php");

// print_r($_POST);
// exit();

$pedido = $_POST['pedido']? : "" ;
$Quantidade = $_POST['Quantidade']?: "" ;
$valor =  $_POST['valor']?: "" ;
$obs =  $_POST['obs'] ?: "" ;
$id_produto =  $_POST['id'] ?: "" ;

 $insert_table = "INSERT INTO `pedido_previa`( `id`, `id_produto`, `produto`, `quantidade`, `valor`, `observacao`) 
  VALUES (null, '$id_produto', '$pedido', '$Quantidade', '$valor', '$obs')";

$adiciona_pedido = mysqli_query($conn, $insert_table);

$update = "UPDATE `pedido_previa` SET `produto`='$pedido',
`quantidade`='$Quantidade',`valor`='$valor',`observacao`='$obs' WHERE id_produto = $id_produto";

$update_pedido = mysqli_query($conn, $update);

//  echo $update;
 
 echo $insert_table;
//  echo "<br>";

 
//   header("Location: /pdv/?view=pedidos_delivery");

//   $conn->close();

//   echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=/pdv/?view=pedidos_delivery'>";
//   $_SESSION['msg'] = "<div class='alert alert-success' role='alert'> Pedido para $id_mesa cadastrado com sucesso!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
// }
