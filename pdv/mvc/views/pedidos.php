<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php

    include_once "../model/conexao.php";

    // $tab_mesas = "SELECT * FROM pedido where `status` <> 4 group by numeropedido";
    $tab_mesas = "SELECT * FROM pedido p  
    left JOIN clientes c on c.id = p.cliente
    where p.`status` <> 4
    group by p.numeropedido
    ORDER BY `p`.`numeropedido` ASC";

    $mesas = mysqli_query($conn, $tab_mesas);

    $num_rows = mysqli_num_rows($mesas);


    ?>
    <meta charset="utf-8">

    <div class="row">

        <?php


        while ($rows_mesas = mysqli_fetch_assoc($mesas)) {
                // print_r($rows_mesas);
            if ($rows_mesas['status']  == 2 ) {
                ?>
                    <audio src="https://cdns-preview-8.dzcdn.net/stream/821246fb5d7e2ff6975f65ef7460a708-0.mp3" type="audio/wav" id="audio" autoplay="false" autostart="false"></audio>
                <?php
                }else{
            
                }

            $nome = ($rows_mesas['nome']);

            if( empty($nome) ){
                $nome = ($rows_mesas['cliente']);
            }
            $id_mesa = $rows_mesas['numeropedido'];


            if ($rows_mesas['status'] == 1) {
                $cor = 'card bg-success';
                $status = 'Livre';
                $link_mesas = "mesasLivres";
            }
            if ($rows_mesas['status'] == 2) {
                $cor = 'card bg-danger';
                $status = 'Em Espera';
                $link_mesas = "mesasLivres";
            }
            if ($rows_mesas['status'] == 3) {
                $cor = 'card bg-warning';
                $status = 'Atendida';
                $link_mesas = "mesasLivres";
            }

            //inicia a seleção da tabela pedido
            $tab_pedido = "SELECT * FROM pedido WHERE numeropedido = $id_mesa";
            $pedido = mysqli_query($conn, $tab_pedido);

            $total = 0;


            while ($row = mysqli_fetch_assoc($pedido)) {



                //recebe e soma todos os pedidos
                $quantidade = $row['quantidade'];
                $valor = $row['valor'];


                if ($valor != NULL && $quantidade != NULL) {

                    $subtotal = $valor * $quantidade;
                    $total += $subtotal;

                    //armazena o ultimo id de pedido feito pela mesma mesa
                    $idpedido = $row['numeropedido'];
                    //recebe a hora do ultimo pedido
                    $hora = $row['hora_pedido'];
                } else {

                    $total = 0;
                }
            }

        ?>

            <!--todo dado vindo do banco de dados deve ser trazido e tratado antes de ir para modal-->
            <div class="col-lg-4" style="height: auto;">
                <div class=" <?php echo $cor; ?> text-white shadow">

                    <div class="card-body" style="text-align: center;">
                        <h4 class="mb-10 text-center"><?php echo ($nome); ?></h4>

                        <form method="POST" action="?view=adicionar_pedido_balcao">
                            <input name="id" type="hidden" id="id" value="<?php echo $rows_mesas['numeropedido']; ?>">
                            <button type="submit" class="btn  btn-outline-light" style="text-align: center;" data-toggle="modal"> Abrir - Pedido <?php echo $rows_mesas['numeropedido']; ?></button>
                        </form>
                        <?php
                        if ($rows_mesas['status']  == 2 ) {
                        ?>
                            <form method="POST" action="?view=aceitar">
                                <input name="id" type="hidden" id="id" value="<?php echo $rows_mesas['numeropedido']; ?>">
                                <button type="submit" class="btn  btn-outline-light" style="text-align: center;" data-toggle="modal"> Aceitar </button>
                            </form>
                            <?php
                        }else{
                            
                        }
                        
                        ?>
                        <!-- <form method="POST" action="?view=whatsapp">
                            <input name="id_pedido" type="hidden" id="id" value="<?php echo $rows_mesas['numeropedido']; ?>">
                            <button type="submit" class="btn  btn-outline-light" style="text-align: center;" data-toggle="modal"> Enviar - Pedido</button>
                        </form> -->
                    </div>
                </div>
            </div>


        <?php } ?>


    </div>

    <script type="text/javascript">
        var var1 = document.getElementById("mensagem");
        setTimeout(function() {
            var1.style.visibility = "hidden";
        }, 5000)
    </script>