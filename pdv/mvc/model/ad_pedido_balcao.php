<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
$data_hora = date('Y-m-d H:i');
$hora_pedido = date('H:i');

include_once ("conexao.php");


if( $_POST['pedido'] <> ""){
 
  $numeropedido = $_POST['pedido'];
  $hashpagina = $_POST['hashpagina'];
  $user =  $_SESSION['user'];
  $pgto = ($_POST['pgto']);
  $hashpagina = $_POST['hashpagina'];
  $id_cliente = $_POST['id_cliente'];
  $user =  $_SESSION['user'];
  $detalhes =  $_POST['detalhes'];
  $pgto = $_POST['pgto'];
  $cliente_2 = $_POST['nomecliente'];
  $tipo = $_POST['tipo'];
  $troco = $_POST['troco'];
  $frete_ifood = $_POST['frete_ifood'];

  $sql_previa = "SELECT * FROM `pedido_previa` where quantidade <> '' and hashpagina = '$hashpagina' order by id ASC";
      $pedido_previa = mysqli_query($conn, $sql_previa);

  while ($rows_previa = mysqli_fetch_assoc($pedido_previa)) {
      // print_r($rows_previa);
      
    $quantidade = $rows_previa['quantidade'];
    $pedido =     ($rows_previa['produto']);
    $preco_venda = $rows_previa['valor'];
    $observacoes = $rows_previa['observacao'];
    $id_produto = $rows_previa['id_produto'];

    if ($pgto == 'Fiado'){
      $insert_table_fiado = "INSERT INTO pedido_fiado (id, numeropedido, delivery,cliente, idmesa, produto, quantidade, hora_pedido, valor, observacao,troco ,pgto, usuario, `data` ,gorjeta, `status`) 
      VALUES ( NULL, '$numeropedido','$tipo','$cliente', '$mesa', '$produto', '$quantidade', '$hora_pedido', '$valor', '$observacoes','$troco' ,'$pgto', '$usuario', '$data','', $status )";	
      $adiciona_pedido_fiado = mysqli_query($conn, $insert_table_fiado);
    }

    $insert_table = "INSERT INTO pedido (numeropedido, delivery,cliente, idmesa, produto, quantidade, hora_pedido, valor, observacao, troco, pgto ,usuario, `data`, gorjeta, status, frete_ifood ) VALUES
    ('$numeropedido','$tipo','$id_cliente', '$id_mesa', '$pedido', '$quantidade', '$hora_pedido', '$preco_venda', '$observacoes','$troco','$pgto','$user', '$data_hora','', 1,'$frete_ifood' )";
    $adiciona_pedido = mysqli_query($conn, $insert_table);
    
    $insert_table = "UPDATE mesas SET status = '2', nome = '$cliente', id_pedido = '$numeropedido' WHERE id_mesa = $id_mesa";
    $adiciona_pedido_2 = mysqli_query($conn, $insert_table);
    
    $delete_previa = "DELETE FROM pedido_previa WHERE hashpagina = '$hashpagina'";
    $delete_previa_mysqli = mysqli_query($conn, $delete_previa);

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

  header("Location: /pdv/?view=todosPedidoBalcao");
  $conn->close();


  echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=/pdv/?view=pedidoBalcao'>";
  $_SESSION['msg'] = "<div class='alert alert-success' role='alert'> Pedido para $cliente_2 editado com sucesso!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";


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
  $cliente = ($_POST['cliente']);
  $cliente_2 = ($_POST['cliente']);
  $pgto = ($_POST['pgto']);
  $tipo = ($_POST['tipo']);
  $hashpagina = $_POST['hashpagina'];
  $troco = $_POST['troco'];
  $frete_ifood = $_POST['frete_ifood'];

  $sql_previa = "SELECT * FROM `pedido_previa` where quantidade <> '' and hashpagina = '$hashpagina' order by id ASC";
  $pedido_previa = mysqli_query($conn, $sql_previa);

  while ($rows_previa = mysqli_fetch_assoc($pedido_previa)) {
      // print_r($rows_previa);
      
    $quantidade = $rows_previa['quantidade'];
    $pedido =     ($rows_previa['produto']);
    $preco_venda = $rows_previa['valor'];
    $observacoes = $rows_previa['observacao'];
    $id_produto = $rows_previa['id_produto'];

    if ($pgto == 'Fiado'){
      $insert_table_fiado = "INSERT INTO pedido_fiado (id, numeropedido, delivery,cliente, idmesa, produto, quantidade, hora_pedido, valor, observacao,troco, pgto, usuario, `data` ,gorjeta, `status`) 
      VALUES ( NULL, '$numeropedido', '$tipo' ,'$cliente', '$id_mesa', '$pedido', '$quantidade', '$hora_pedido', '$preco_venda', '$observacoes','$troco' ,'$pgto', '$user', '$data_hora','', 1 )";	
      $adiciona_pedido_fiado = mysqli_query($conn, $insert_table_fiado);
    }
    
    $insert_table = "INSERT INTO pedido (numeropedido, delivery,cliente, idmesa, produto, quantidade, hora_pedido, valor, observacao, troco, pgto, usuario, `data` , gorjeta, status, frete_ifood ) VALUES
    ('$numeropedido','$tipo','$cliente', '$id_mesa', '$pedido', '$quantidade', '$hora_pedido', '$preco_venda', '$observacoes', '$troco','$pgto','$user','$data_hora' ,'' , 1, '$frete_ifood' )";
  $adiciona_pedido = mysqli_query($conn, $insert_table);

  $insert_table = "UPDATE mesas SET status = '2', nome = '$cliente' , id_pedido = '$numeropedido' WHERE id_mesa = $id_mesa";
  $adiciona_pedido_2 = mysqli_query($conn, $insert_table);

  $delete_previa = "DELETE FROM pedido_previa WHERE hashpagina = '$hashpagina'";
  $delete_previa_mysqli = mysqli_query($conn, $delete_previa);

  };

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

    $novoIdInserido = $conn->insert_id;


  echo "<META http-equiv='refresh' content='0;URL=/pdv/mvc/model/imprimir.php' target='_blank'>";

  $_SESSION['novoIdInserido'] = $numeropedido;
  $_SESSION['$cliente'] = $cliente;

  // echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=/pdv/?view=pedidoBalcao'>";
  $_SESSION['msg'] = "<div class='alert alert-success' role='alert'> Pedido para $numeropedido cadastrado com sucesso!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";

}