<?php
include '.././pdv/mvc/model/conexao.php';

date_default_timezone_set('America/Sao_Paulo');
$data_hora = date('Y-m-d H:i:s');
$hora_pedido = date('H:i');

$valores = $_POST['pedido'];
$dadoscliennte = $_POST['dadoscliennte'];
$telefone = $_POST['telefone'];
$tipoEntrega = $_POST['tipoEntrega'];
$troco = $_POST['troco'];

// print_r($_POST);
// die();

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

if($telefone == "" ){
    $telefone = $_POST['dadoscliennte']['phone'];
}else{
    $telefone = $_POST['telefone'];
}

$tab_telefone = "SELECT id, tel1 FROM `clientes` where REPLACE(REPLACE(REPLACE(REPLACE(tel1, '(', ''), ')', ''), '-', ''),' ','') = REPLACE(REPLACE(REPLACE(REPLACE('$telefone', '(', ''), ')', ''), '-', ''),' ','') and cep <> '' ORDER by id DESC limit 1" ;
$resultado_telefone = mysqli_query($conn, $tab_telefone);
// $menu = array();

if ($resultado_telefone->num_rows == 0 || $tipoEntrega == 'Retirar' ) {

    $dadoscliennte = $_POST['dadoscliennte'];
    $cep = $dadoscliennte['cep'];
    $endereco = $dadoscliennte['endereco'];
    $bairro = $dadoscliennte['bairro'];
    $uf = $dadoscliennte['uf'];
    $numero = $dadoscliennte['numero'];
    $complemento = $dadoscliennte['complemento'];
    $nome = $dadoscliennte['nome'];
    $cidade = $dadoscliennte['cidade'];

    $endNumber = $endereco.", ".$numero;

    $insert_table_cliente = "INSERT INTO `clientes` (`id`, `nome`, `endereco`, `bairro`, `cidade`, `estado`, `complemento`, `cep`, `ponto_referecia`, `tel1`, 
    `tel2`, `email`, `cpf_cnpj`, `rg`, `condominio`, `bloco`, `apartamento`, `local_entrega`, `observacoes`) VALUES
    (null,'$nome','$endNumber','$bairro','$cidade','$uf','$complemento','$cep','','$telefone','','','','','','','','','')";

    $adiciona_cliente = mysqli_query($conn, $insert_table_cliente);

    $id_cliente = $conn->insert_id;

}else{

    $dadoscliennte = $_POST['dadoscliennte'];
    $cep = $dadoscliennte['cep'];
    $endereco = $dadoscliennte['endereco'];
    $bairro = $dadoscliennte['bairro'];
    $uf = $dadoscliennte['uf'];
    $numero = $dadoscliennte['numero'];
    $complemento = $dadoscliennte['complemento'];
    $nome = $dadoscliennte['nome'];
    $cidade = $dadoscliennte['cidade'];

    $endNumber = $endereco.", ".$numero;

    while ($row = $resultado_telefone->fetch_assoc()) {
        $id_cliente = $row['id'];

        $update = "UPDATE `clientes` SET `nome`='$nome',`endereco`='$endNumber',`bairro`='$bairro',`cidade`='$cidade',`estado`='$uf',
        `complemento`='$complemento',`cep`='$cep',`tel1`='$telefone' WHERE id = '$id_cliente' ";
        $update_cliente = mysqli_query($conn, $update);

    }
}
   
    $frete = $_POST['frete'];

    if( $frete <> "" && $frete != 0 ){
        
            $pedido = 'Frete';
            $preco_venda = $frete;
            $quantidade = '1';
    
            $insert_table_frete = "INSERT INTO pedido (numeropedido, delivery,cliente, idmesa, produto, quantidade, hora_pedido, valor, observacao, troco, pgto, usuario, `data` , gorjeta, status ) VALUES
            ('$numeropedido','$tipoEntrega','$id_cliente', '$id_mesa', '$pedido', '$quantidade', '$hora_pedido', '$preco_venda', '$observacoes', '$troco','$pgto','$user','$data_hora' ,'' , 2 )";
          
           $adiciona_pedido_frete = mysqli_query($conn, $insert_table_frete);
        
    }else{
        
    }

    $data = $_POST['pedido'];

    foreach ($data as $index => $elem) {

        $pedido = $elem['name'];
        $preco_venda = $elem['price'];
        $quantidade = $elem['qntd'];

        $insert_table = "INSERT INTO pedido (numeropedido, delivery,cliente, idmesa, produto, quantidade, hora_pedido, valor, observacao, pgto, usuario, `data` , gorjeta, status ) VALUES
        ('$numeropedido','$tipoEntrega','$id_cliente', '$id_mesa', '$pedido', '$quantidade', '$hora_pedido', '$preco_venda', '$observacoes', '$pgto','$user','$data_hora' ,'' , 2 )";
      
      $adiciona_pedido = mysqli_query($conn, $insert_table);

    }

    header("Content-Type: application/json");

    $jsonData = json_encode($numeropedido, JSON_PRETTY_PRINT);
    
    echo $jsonData;
    