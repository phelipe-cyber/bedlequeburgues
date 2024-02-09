<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
$data_hora = date('Y-m-d H:i:s');
include_once("conexao.php");

$tipo = $_POST['tipo'];
$id_usuario = $_POST['id_usuario'];

$insert_table = "INSERT INTO ponto (id_usuario, tipo, data_hora) VALUES ('$id_usuario','$tipo','$data_hora')";
$adiciona = mysqli_query($conn, $insert_table);


if(mysqli_affected_rows($conn)!=-1){

    echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=/pdv/?view=ponto'>";
    $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Cadastrada com Sucesso<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
}else{

    echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=/pdv/?view=ponto'>";	
    $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro ao Cadastrar <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
}?>
