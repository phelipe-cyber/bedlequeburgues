<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<style>
    .meu-elemento {
        padding: 5px; /* Define o padding de 20 pixels em todos os lados do elemento */
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @page {
            size: 58mm auto; /* Define o tamanho do papel para a impressora térmica */
        }
        
        body {
            margin: 0;
            padding: 0;
        }
        
        /* Outros estilos da sua página aqui */
    </style>
</head>
<body>
<div class="meu-elemento">

<?php
date_default_timezone_set('America/Sao_Paulo');
$hora_pedido = date('H:i');
include "conexao.php";

$id = $_POST['id'];
$cliente = $_POST['cliente'];
$pgto = $_POST['pgto'];
$troco = $rows_Result_pedido['troco'];

if( empty($id) ){
    
    $id = $_SESSION['novoIdInserido'];
    $cliente = $_SESSION['cliente'];
}

     $select_DB = "SELECT * FROM pedido p  
left JOIN clientes c on c.id = p.cliente
where numeropedido = '$id'";

     $Result_pedido = mysqli_query($conn, $select_DB) or die(mysqli_error($conn));

     while ($rows_Result_pedido = mysqli_fetch_assoc($Result_pedido)) {
        //   print_r($rows_Result_pedido);
     $data_hora = date('d/m/Y H:i:s', strtotime( $rows_Result_pedido['data']));
     $pgto = $rows_Result_pedido['pgto'];
     $cliente = $rows_Result_pedido['nome'];
     $tipo = $rows_Result_pedido['delivery'];
     $troco = $rows_Result_pedido['troco'];
     
          if( empty($cliente) ){
             $cliente = ($rows_Result_pedido['cliente']);
         }


     }
     
     ?>

<div style="text-align: center;">

    <label for="">Bedlek Burgue's</label>
    <br>
    <!-- <label for="">CNPJ - </label>
    <br> -->
    <label for="">R. Nicolau Maevsky, 1410 - Vale do Sol Jandira - SP</label>
    <br>
    <label for="">06622-005</label>
</div>

<h2 class="text-center col-lg-1"><b>Pedido #<?php echo $id ?></b> </h2>

<div class="row">
    <!--<a class="text-center col-lg-1"><b>Forma de Pgto: </b><?php echo $pgto; ?></a><br>-->
    <!-- <a class="text-center"><b><?php echo $pgto; ?></b><br> -->
    <label> <b>Forma de Pgto: </b><?php echo $pgto; ?> </label>
    <hr>

    <a class="text-center col-lg-2"><b>Cliente: </b><?php echo $cliente ?></a></br>
    <a class="text-center col-lg-2"><b>Data Hora: </b><?php echo $data_hora ?></a></br>
    <a class="text-center col-lg-2"><b>* Tipo: </b><?php echo $tipo ?></a></br>
    <a class="text-center col-lg-2"><b>* Troco: </b><?php echo $troco ?></a>
        <thead>
            <tr >
            </tr>
        </thead>
        <tbody>

            <?php

        include_once "conexao.php";

        $idpedido = '';
        $total = 0;
        $i = 0;
        $index = 1;

        // $tab_cliente = "SELECT * FROM pedido WHERE numeropedido LIKE '$id'";
        $tab_cliente = "SELECT * FROM pedido p  left JOIN clientes c on c.id = p.cliente where numeropedido = '$id'";

        $pedido = mysqli_query($conn, $tab_cliente) or die(mysqli_error($conn));

        while ($rows_clientes = mysqli_fetch_assoc($pedido)) {
                // print_r($rows_clientes);
            if ($idpedido != $rows_clientes['idpedido']) {
                $idpedido = $rows_clientes['idpedido'];
                $total = 0;
            }

            $produto = ($rows_clientes['produto']);
            $quantidade = $rows_clientes['quantidade'];
            $valor = $rows_clientes['valor'];
            $cliente = $rows_clientes['nome'];
            $obs = $rows_clientes['observacao'];
            $numeropedido = $rows_clientes['numeropedido'];
            $totalValor = $rows_clientes['totalValor'];
            $pgto = $rows_clientes['pgto'];
            $data_hora = $rows_clientes['data'];

            $endereco = $rows_clientes['endereco'];
            $bairro = $rows_clientes['bairro'];
            $cidade = $rows_clientes['cidade'];
            $estado = $rows_clientes['estado'];
            $complemento = $rows_clientes['complemento'];
            $cep = $rows_clientes['cep'];
            $ponto_referecia = $rows_clientes['ponto_referecia'];
            $tel1 = $rows_clientes['tel1'];
            $tel2 = $rows_clientes['tel2'];
            $condominio = $rows_clientes['condominio'];
            $bloco = $rows_clientes['bloco'];
            $apartamento = $rows_clientes['apartamento'];

            $subtotal = $valor ;
            $total += $subtotal;

            $i++;

            $total = number_format($total, 2); ?>

            <tr  >
                    <hr>
                <font size="3"> <b><?php echo $quantidade . " x " .$produto ?></b></font><br/>
                <?php
                    if( $obs != "" ){
                        ?>
                           <font size="4"> <b> * Obs.: <?php echo $obs ?></b></font> <br/>
                        <?php
                    }else{
                    }
                ?>
                <td class="th-sm"> <?php echo "R$ ". $total ?> </td>

            </tr>
            
            <?php
            $index ++;
           }
        ?>
        </tbody>
    </table>
    <!-- <hr> -->
    <?php
        $valorTotal = "SELECT sum(  valor ) AS totalValor FROM pedido WHERE numeropedido = '$id'";

        $pedido = mysqli_query($conn, $valorTotal);

        while ($rows_clientes = mysqli_fetch_assoc($pedido)) {
            $Total = $rows_clientes['totalValor'];
        ?>
        <hr>
    <a class="text-center"><b>Valor Total:</b></a>
    <a class="text-center">R$: <b><?php echo number_format($Total, 2); ?></b></a><br><br>
    <?php
        }
     if( $cep != "" ){
        ?>
                <label for=""><b>Local da entrega:</b></label></br>
                <label for=""><b><?php echo $endereco ?></b> </label></br></br>
                <label for=""> <b>Complemento:</b> <?php echo $complemento?> </label></br>
                <label for=""> <b>Ponto Referecia: </b> <?php echo $ponto_referecia?> </label></br>
                <label for=""> <b>Condominio</b> <?php echo $condominio ?> </label></br>
                <label for=""> <b>Bloco / Torre: </b> <?php echo $bloco ?> </label> </br>
                <label for=""> <b>Apto: </b> <?php echo $apartamento?> </label></br>
                <label for=""> <?php echo $cep." | ". $bairro ." - ". $cidade ." - ".$estado?> </label></br>
                <label for=""> <b> Contato: </b> <?php echo $tel1 ?> </label></br>
                <label for=""> <?php echo $tel2 ?> </label></br>
        <?php
     }   
        ?>

</div>



</body>

<script>
    window.print();
    window.addEventListener("afterprint", function(event) { window.close(); });
    window.onafterprint();
</script>

<?php
    echo "<META http-equiv='refresh' content='1;URL=/pdv/?views=todosPedidoBalcao' target='_blank'>";
?>


</div>
</body>
</html>
