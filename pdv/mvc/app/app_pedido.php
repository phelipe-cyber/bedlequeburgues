<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App - Pedido</title>
</head>

<body>

    <link href="../common/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"> -->
    <!-- Bootstrap core CSS -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- Material Design Bootstrap -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.2/css/mdb.min.css" rel="stylesheet"> -->
    <link href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js">
    </script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.2/js/mdb.min.js">
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

    <form method="POST" action="../model/app_gravadb.php">
        <?php

    $categoria = $_GET['categoria'];
    $mesa = $_GET['mesa'];
    $cliente = $_GET['cliente'];
    $id_pedido = $_GET['id_pedido'];

    $id = $_GET['id'];
    $numeropedido = $_GET['numeropedido'];

    include_once "../model/conexao.php";

    $tab_produtos = "SELECT * FROM produtos ";

    $produtos = mysqli_query($conn, $tab_produtos);


    $i = $_SESSION['loginapp'];

    if ($i == 1) {


    ?>


        <div class="row" style="background: #2d3339; height: 1%;">

            <h3 class="mb-12 " style="background: #2d3339; width: 1%; "></h3>
            <a style="background: #2d3339; height: 100%; width: 23%; color: white;" type="button" href="app_mesas.php"
                class="btn btn-outline-light">
                <h4>Voltar</h4>
            </a>
            <h3 class="mb-12 " style="background: #2d3339; width: 16%; "></h3>

            <h4 class="mb-12 text-center" style="color: white; width: 20%; ">Mesa
                <?php echo $id . " " . $rows_mesas['nome']; ?></h4>
            <!-- <h4 class="mb-12 col-lg-12 text-center" style="color: white; width: 20%; "><?php echo  $rows_mesas['nome']; ?></h4> -->

            <h3 class="mb-12 " style="background: #2d3339; width: 36%; "></h3>


        </div>

        <div class="mb-12 " style=" height: 5%;"></div>

        <div class="mb-12 " style=" height: 5%;"></div>

        <div class="row" style="padding: 39px;">

            <?php

        if ($id_pedido == "") {

        ?>
            <div class="row">
                <h4 class="col-lg-7">
                    <label for="">Cliente:</label>
                    <input autofocus type="text" class="form-control" width="100%" height="100%" name="cliente"
                        id="cliente" value="" required>
                    <input autofocus type="hidden" class="form-control" width="100%" height="100%" name="numeropedido"
                        id="numeropedido" value="<?php echo $id_pedido ?>">
                    <input autofocus type="hidden" class="form-control" width="100%" height="100%" name="id" id="id"
                        value="<?php echo $_GET['id'] ?>">

                </h4>
            </div>
            <?php

        } else {

        ?>
            <div class="row">
                <h4 class="col-lg-7">
                    <label for="">Cliente:</label>
                    <input autofocus type="text" class="form-control" width="100%" height="100%" name="cliente"
                        id="cliente" value="<?php echo $cliente ?>">
                    <input autofocus type="hidden" class="form-control" width="100%" height="100%" name="numeropedido"
                        id="numeropedido" value="<?php echo $id_pedido ?>">
                    <input autofocus type="hidden" class="form-control" width="100%" height="100%" name="id" id="id"
                        value="<?php echo $_GET['id'] ?>">

                </h4>
            </div>
            <?php

        }

        ?>


            <div class="mb-12 " style=" height: 5%;"></div>

            <input class="btn btn-outline-success" type="submit" name="enviar" value="Finalizar Pedido">

            <h3 class="col-lg-6 text-center" style="color: black;"><?php echo $categoria; ?></h3>

        </div>

        <div class="table-responsive">
            <!-- <div class="col-2"> -->
            <!-- <div class="flex-center flex-column"> -->
            <!-- <div class="card card-body"> -->

            <!-- <div class="table-responsive"> -->
            <table id="dtBasicExample" class="table table-striped table-bordered table-sm reponsive" cellspacing="0"
                width="100%">
                <!-- <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%"> -->
                <thead>
                    <tr>
                        <th class="th-sm">Nome</th>
                        <th class="th-sm">Qtde.</th>
                        <th class="th-sm">Observação</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
            $index = 0;
            while ($rows_produtos = mysqli_fetch_assoc($produtos)) {
            ?>

                    <tr>
                        <td style="color: #4D4D4D;"><?php echo ($rows_produtos['nome']); ?>
                            <input name="detalhes[<?php echo $index ?>][pedido]" type="hidden" class="form-control"
                                id="pedido" value="<?php echo ($rows_produtos['nome']); ?>">
                            <p style="color: #4D4D4D;">
                                <b>
                                    R$ <?php echo ($rows_produtos['preco_venda']); ?>
                                </b>
                            </p>
                            <input name="detalhes[<?php echo $index ?>][preco_venda]" type="hidden" class="form-control"
                                id="preco_venda" value="<?php echo ($rows_produtos['preco_venda']); ?>">
                        </td>
                        <td style="text-align: center; display: flex;">
                            <input style="background-color: green;" class="bg-gradient-success" value="+" type="button"
                                onclick="this.parentNode.querySelector('input[type=number]').stepUp()"></input>
                            <input class="bg-gradient-default text-center" style="width:50px;"
                                name="detalhes[<?= $index ?>][quantidade]" min="0" maxlength="5" name="quantity"
                                value="0" type="number">
                            <input style="background-color: red;" class="bg-gradient-danger" value="-" type="button"
                                onclick="this.parentNode.querySelector('input[type=number]').stepDown()"></input>
                        </td>

                        <td>

                            <textarea name="detalhes[<?php echo $index ?>][observacoes]" class="form-control"
                                id="observacoes"></textarea>

                        </td>

                    </tr>

                    <?php $index++;
            } ?>


                </tbody>
            </table>
        </div>
        <script>
        $(document).ready(function() {
            $('#dtBasicExample').DataTable({
                "paging": false, // false to disable pagination (or any other option)
                "ordering": true, // false to disable sorting (or any other option)
                "searching": true,
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json"
                }
            });
            $('.dataTables_length').addClass('bs-select');
        });
        </script>


        <!-- Extra large modal -->
        <div class="modal fade bd-example-modal-xl" id="sair" tabindex="-1" role="dialog"
            aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    sair
                </div>
            </div>
        </div>


        <?php } else {
    ?>
        <script>
        window.location.href = 'app_login.php'
        </script>
        <?php
      // header('Location: app_login.php');
    }
    ?>


        <!-- <script src="../common/js/jquery-3.3.1.slim.min.js"></script> -->
        <!-- <script src="../common/js/popper.min.js"></script> -->
        <!-- <script src="../common/js/bootstrap.min.js"></script> -->

</body>

</html>