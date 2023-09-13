    <?php

    include "./mvc/model/conexao.php";

    $tab_novo_pedido = "SELECT * FROM pedido p  where p.`status` = 2 limit 1";
    $novo_pedido_conn = mysqli_query($conn, $tab_novo_pedido);
    $rows_novo_pedido = mysqli_num_rows($novo_pedido_conn);
   
    while ($row = $novo_pedido_conn->fetch_assoc()) {
        $numeropedido = $row['numeropedido'];
        $statusNotificacao = $row['notificacao'];
    };

    if ($rows_novo_pedido != 0  ) {
            echo "ok";
        ?>
            <audio src="mvc/common/som/som.mp3" type="audio/mp3" id="audio" autoplay="true" autostart="true"></audio>
            <?php

        if( $statusNotificacao == 'true' ){
                
                // $notificacao = "UPDATE pedido SET notificacao = 'false' WHERE numeropedido LIKE '$numeropedido' ";
                // $grava_notificacao = mysqli_query($conn, $notificacao) or die(mysqli_error($conn));

                echo '<script>
                if ("Notification" in window) {
                    // Solicita permissão para exibir notificações
                    Notification.requestPermission().then(function (permission) {
                        if (permission === "granted") {
                            // Cria uma nova notificação
                            var notificacao = new Notification("Novo pedido: ' .$numeropedido. ' ", {
                                // body: "Chegou um novo pedido ",
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

        }
    }else{
        echo "erro";
    }
  


    $conn->close();
