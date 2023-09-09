<?php
session_start();
// Conectar ao banco de dados ou realizar outras operações necessárias
include "conexao.php";
date_default_timezone_set('America/Sao_Paulo');
$data_hora = date('Y-m-d H:i:s');
$data = date('Y-m-d');
$hora_pedido = date('H:i');
$user =  $_SESSION['user'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $valor_final = $_POST['valor_final'];
    // Inserir o valor inicial no banco de dados ou em algum lugar apropriado
    // echo "Caixa aberto com sucesso! Valor inicial: $valor_inicial";
    $sql_valida = "SELECT * FROM `caixa` WHERE CAST(update_at AS DATE) = '$data' order by id desc";
    $conn_valida = mysqli_query($conn, $sql_valida);
    
    // print_r(mysqli_fetch_assoc($conn_valida));
    
    $select_table = mysqli_fetch_assoc($conn_valida);
    // echo $id;
    // exit();
    if(mysqli_fetch_assoc($conn_valida) != ""){
        echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=/pdv/?view=exit'>";	
		$_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro ao fazer fechar, caixa já fechado Hoje <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
    }else{

            $sql_valida = "SELECT * FROM `caixa` WHERE CAST(data_hora AS DATE) = '$data' order by id desc";
            $conn_valida = mysqli_query($conn, $sql_valida);
            
            $select_table = mysqli_fetch_assoc($conn_valida);
            $id = $select_table['id'];
		    echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=/pdv/?view=exit'>";
	    	$_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Caixa fechado com sucesso! Valor final: $valor_final<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                
            $sql = "UPDATE `caixa` SET `valor_fechamento`= '$valor_final', `status`='2', `update_at`='$data_hora' WHERE id = '$id' ";
            $adiciona = mysqli_query($conn, $sql);
            // print_r(mysqli_affected_rows($conn));
            
            if(mysqli_affected_rows($conn) != -1){
                echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=/pdv/?view=exit'>";
                $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Caixa fechado com sucesso! Valor final: $valor_final<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            }else{
                echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=/pdv/?view=exit'>";	
                $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro ao fazer o fechamento  <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
            }
        }
    
} else {
    echo "Acesso não autorizado.";
}

?>
