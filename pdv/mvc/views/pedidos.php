<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<!-- <button id="activateButton" style="display:none" >Ativar Notificações</button> -->
<div class="col-12">
    <button id="activateButton" style="display:none" type="submit" class="btn btn-outline-info" data-toggle="modal" data-target=""><b>Ativar Notificações</b></button>
</div>
    <br>
    <script>
        // Verifique se o navegador suporta a API de Notificações
        if ("Notification" in window) {
          var activateButton = document.getElementById("activateButton");
            // console.log(Notification.permission)
            if( Notification.permission == 'default' ){
                document.getElementById("activateButton").style ='';
            }
          // Adicione um ouvinte de evento ao botão para solicitar permissão ao usuário
          activateButton.addEventListener("click", function () {
            // Verifique se as notificações já estão permitidas; se não, solicite permissão ao usuário
            if (Notification.permission !== "granted") {

                Notification.requestPermission().then(function (permission) {
                // Se o usuário permitir, mostre uma mensagem de confirmação
                if (permission === "granted") {
                  alert("Notificações ativadas com sucesso!");
                }
              });
            } else {
              // Se as notificações já estiverem permitidas, mostre uma mensagem de confirmação
              alert("Notificações já estão ativadas.");
            }
          });
        }
    </script>


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

    $tab_novo_pedido = "SELECT * FROM pedido p  where p.`status` = 2 limit 1";
    $novo_pedido_conn = mysqli_query($conn, $tab_novo_pedido);
    $rows_novo_pedido = mysqli_num_rows($novo_pedido_conn);

    while ($row = $novo_pedido_conn->fetch_assoc()) {
        // print_r($row);
        $numeropedido = $row['numeropedido'];
        $statusNotificacao = $row['notificacao'];
        $tipoEntrega = $row['delivery'];
    };

    if ($rows_novo_pedido != 0  ) {
            
        ?>
            <audio src="mvc/common/som/som.mp3" type="audio/mp3" id="audio" autoplay="true" autostart="true"></audio>
            <?php
    }else{
       
    }
           
         $select_notificacao = "SELECT * FROM pedido p  where p.`notificacao` = 'true' limit 1";
         $select_notificacao_conn = mysqli_query($conn, $select_notificacao);
     
         while ($row_notificacao = $select_notificacao_conn->fetch_assoc()) {
                $numeropedido = $row_notificacao['numeropedido'];
                $statusNotificacao = $row_notificacao['notificacao'];
                $tipoEntrega = $row_notificacao['delivery'];
                
                $notificacao = "UPDATE pedido SET notificacao = 'false' WHERE numeropedido LIKE '$numeropedido' ";
                $grava_notificacao = mysqli_query($conn, $notificacao) or die(mysqli_error($conn));
                 
                 echo    '<script>
                             if ("Notification" in window) {
                                 // Solicita permissão para exibir notificações
                                 Notification.requestPermission().then(function (permission) {
                                     if (permission === "granted") {
                                         // Cria uma nova notificação
                                         var notificacao = new Notification("Novo pedido: ' .$numeropedido. ' ", {
                                             body: "Chegou um novo pedido para: '.$tipoEntrega.' ",
                                             icon: "mvc/common/img/logo_bedlek.ico"
                                         });
                                         // Manipula o clique na notificação (opcional)
                                         notificacao.onclick = function () {
                                             window.open("/pdv/?view=todosPedidoBalcao");
                                         };
                                     } else {
                                         alert("Permissão para notificações negada.");
                                     }
                                 });
                             } else {
                                 alert("Este navegador não suporta notificações.");
                             }
                             
                             </script>';
                };

?>

    <meta charset="utf-8">

    <div class="row">

        <?php


        while ($rows_mesas = mysqli_fetch_assoc($mesas)) {
                // print_r($rows_mesas);

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
            <div class="col-lg-2" style="height: auto;">
                <div class=" <?php echo $cor; ?> text-white shadow">

                    <div class="card-body" style="text-align: center;">
                        <h4 class="mb-10 text-center"><?php echo ($nome); ?></h4>

                        <form method="POST" action="?view=adicionar_pedido_balcao">
                            <input name="id" type="hidden" id="id" value="<?php echo $rows_mesas['numeropedido']; ?>">
                            <button type="submit" class="btn  btn-outline-light" style="text-align: center;" data-toggle="modal"> Abrir - Pedido <?php echo $rows_mesas['numeropedido']; ?></button>
                            <h4 class="mb-10 text-center"><?php echo $rows_mesas['delivery']; ?></h4>
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