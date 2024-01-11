<?php
session_start();
include_once("conexao.php");

$pedido = $_POST['pedido']? : "" ;
$Quantidade = $_POST['Quantidade']?: "" ;
$Valor =  $_POST['valor']?: "" ;
$obs =  $_POST['obs'] ?: "" ;
$id_produto =  $_POST['id'] ?: "" ;
$hashpagina =  $_POST['hashpagina'] ?: "" ;

$botao =  $_POST['botao'] ?: "";

if( $botao == 'mais' ){
  $insert_table = "INSERT INTO `pedido_previa`( `id`, `id_produto`, `produto`, `quantidade`, `valor`, `observacao`,`hashpagina`) 
  VALUES (null, '$id_produto', '$pedido', '$Quantidade', '$Valor', '$obs', '$hashpagina')";
  $adiciona_pedido = mysqli_query($conn, $insert_table);
    if (!$adiciona_pedido) {
      // There was an error in the query
      die("Error: " . mysqli_error($conn));
    }
}elseif( $botao == 'deletar' ){

  // $delete = "DELETE FROM pedido_previa WHERE id_produto = '$id_produto' and hashpagina = '$hashpagina'";
  $delete = "DELETE FROM pedido_previa WHERE id = '$id_produto' AND hashpagina = '$hashpagina' ORDER BY id DESC LIMIT 1";

  $delete_item = mysqli_query($conn, $delete);
  if (!$delete_item) {
    // There was an error in the query
    die("Error: " . mysqli_error($conn));
  }
  

}else{
  
  // $delete = "DELETE FROM pedido_previa WHERE id_produto = '$id_produto' and hashpagina = '$hashpagina'";
  $delete = "DELETE FROM pedido_previa WHERE id_produto = '$id_produto' AND hashpagina = '$hashpagina' ORDER BY id DESC LIMIT 1";
  $delete_item = mysqli_query($conn, $delete);
  if (!$delete_item) {
    // There was an error in the query
    die("Error: " . mysqli_error($conn));
  }

}