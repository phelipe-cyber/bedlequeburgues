<?php
session_start();
?>
<html lang="pt-br">
<!-- <title>Pedido - Balcão</title> -->
<?php
date_default_timezone_set('America/Sao_Paulo');
// $data_hora = date('d/m/Y - H:i:s');
$hora_pedido = date('H:i');
include "conexao.php";

// print_r($_POST);


$id = $_POST['id'];
$cliente = $_POST['cliente'];
$pgto = $_POST['pgto'];

if( empty($id) ){
    
    $id = $_SESSION['novoIdInserido'];
    $cliente = $_SESSION['cliente'];
}

// print_r($_SESSION);

    // $data_pedido = $_POST['data_pedido'];

    

    //  $select_DB = "SELECT * FROM pedido WHERE numeropedido LIKE '$id'";

     $select_DB = "SELECT * FROM pedido p  
left JOIN clientes c on c.id = p.cliente
where numeropedido = '$id'";

     $Result_pedido = mysqli_query($conn, $select_DB) or die(mysqli_error($conn));

     while ($rows_Result_pedido = mysqli_fetch_assoc($Result_pedido)) {
        //   print_r($rows_Result_pedido);
     $data_hora = date('d/m/Y H:i:s', strtotime( $rows_Result_pedido['data']));
     $pgto = $rows_Result_pedido['pgto'];
     $cliente = $rows_Result_pedido['nome'];
     
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

<h1 class="text-center col-lg-1"><b>Pedido #<?php echo $id ?></b> </h1>

<div class="row">
    <!--<a class="text-center col-lg-1"><b>Forma de Pgto: </b><?php echo $pgto; ?></a><br>-->
    <!-- <a class="text-center"><b><?php echo $pgto; ?></b><br> -->
    <label> <b>Forma de Pgto: </b><?php echo $pgto; ?> </label>
    <hr>


    <a class="text-center col-lg-2"><b>Cliente: </b><?php echo $cliente ?></a></br>
    <a class="text-center col-lg-2"><b>Data Hora: </b><?php echo $data_hora ?></a>
    <!-- <hr> -->
    <!--<table BORDER RULES=rows id="dtBasicExample" class="" cellspacing="0" width="100%"-->
        <!--style="text-align: center">-->
        <thead>
            <tr >
                <!--<th class="th-sm">#</th>-->
                <!--<th class="th-sm">Descrição</th>-->
                <!--<th class="th-sm">Valor Unit</th>-->
                <!--<th class="th-sm">Qtde Unit</th>-->
                <!--<th class="th-sm">Obs</th>-->
                <!--<th class="th-sm">Total</th>-->
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
                <!--<td class="th-sm"> <?php echo $index ?> </td>-->
                <td class="th-sm"> <?php echo $produto ?> </td>
                <br>
                <!--<td class="th-sm"> <?php echo $valor ?> </td>-->
                <td class="th-sm"> <b> <?php echo $quantidade ?> </b> Un. </td>
                <td class="th-sm"> <?php echo $obs ?> </td>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <td class="th-sm"> <?php echo "R$ ". $total ?> </td>

            </tr>
            
<br>

            <!-- <a class="text-center col-lg-2"> # <?php echo $i; ?></a> -->
            <!-- </br> -->
            <!-- <b>
                    <a class="text-center"><?php echo $produto; ?></a>    
                </b>
                &nbsp;&nbsp;
            <a class="text-center col-lg-2">un.</a>
            <a class="text-center"> <b> <?php echo $quantidade ?></a> </b>
            &nbsp;&nbsp;
            <a class="text-center">R$ <b><?php echo $total ?></b> </a>
            </br>
                <a class="text-center col-lg-2">Obs : <?php echo $obs; ?></a>
             -->



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
        ?>

</div>

<hr>
<label for=""><b>Local da entrega:</b></label>
<hr>
<h3 class="text-center col-lg-1"><b><?php echo $endereco ?></b> </h3>
<label for=""> <b>Complemento:</b> <?php echo $complemento?> </label><br>
<label for=""> <b>Ponto Referecia: </b> <?php echo $ponto_referecia?> </label><br>
<label for=""> <b>Condominio</b> <?php echo $condominio ?> </label><br>
<label for=""> <b>Bloco / Torre: </b> <?php echo $bloco ?> </label> <br>
<label for=""> <b>Apto: </b> <?php echo $apartamento?> </label><br>
<label for=""> <?php echo $cep." | ". $bairro ." - ". $cidade ." - ".$estado?> </label><br>
<label for=""> <b> Contato: </b> <?php echo $tel1 ?> </label><br>
<label for=""> <?php echo $tel2 ?> </label><br>

</body>

<script>
    window.print();
    // window.addEventListener("afterprint", function(event) { window.close(); });
    // window.onafterprint();
    // window.location.href = '/pdv/?views=todosPedidoBalcao';
</script>

<?php
    echo "<META http-equiv='refresh' content='1;URL=/pdv/?views=todosPedidoBalcao' target='_blank'>";
    // $fileToPrint = 'caminho/para/seu/arquivo.pdf';
    // $printerName = 'nome_da_impressora';
    
    // $command = "lp -d $printerName $fileToPrint";
    // exec($command);
?>

</html>