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
$hashpagina =  $_POST['hashpagina'] ?: "" ;

  if(!$Quantidade){
    
    $delete = "DELETE FROM pedido_previa WHERE id_produto = '$id_produto' and hashpagina = '$hashpagina'";
    $delete = mysqli_query($conn, $delete);
    if (!$adiciona_pedido) {
      // There was an error in the query
      die("Error: " . mysqli_error($conn));
    }
  }else{


    $sql_select = "SELECT * FROM `pedido_previa` WHERE id_produto = '$id_produto' and hashpagina = '$hashpagina' ";
    $result_select = mysqli_query($conn, $sql_select);

    while ($rows_select = mysqli_fetch_assoc($result_select)) {
        $id_produto_result = $rows_select['id_produto'];
        $hashpagina = $rows_select['hashpagina'];
    }

    if(!$id_produto_result || !$hashpagina){
  
      $insert_table = "INSERT INTO `pedido_previa`( `id`, `id_produto`, `produto`, `quantidade`, `valor`, `observacao`,`hashpagina`) 
      VALUES (null, '$id_produto', '$pedido', '$Quantidade', '$valor', '$obs', '$hashpagina')";
      $adiciona_pedido = mysqli_query($conn, $insert_table);
        if (!$adiciona_pedido) {
          // There was an error in the query
          die("Error: " . mysqli_error($conn));
        }
    }else{

      $update = "UPDATE `pedido_previa` SET `produto`='$pedido',
      `quantidade`='$Quantidade',`valor`='$valor',`observacao`='$obs' WHERE id_produto = $id_produto and hashpagina = '$hashpagina'";
      $update_pedido = mysqli_query($conn, $update);
      if (!$update_pedido) {
        // There was an error in the query
        die("Error: " . mysqli_error($conn));
      }

    }
  }
//  echo $update;
 
//  echo $insert_table;
//  echo "<br>";

 
//   header("Location: /pdv/?view=pedidos_delivery");

//   $conn->close();

//   echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=/pdv/?view=pedidos_delivery'>";
//   $_SESSION['msg'] = "<div class='alert alert-success' role='alert'> Pedido para $id_mesa cadastrado com sucesso!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
// }
