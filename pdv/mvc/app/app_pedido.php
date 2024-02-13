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
    <!-- <link href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
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
    include_once "app_hash.php";

    // include_once "../model/apagar_previa.php";

    $tab_produtos = "SELECT * FROM produtos where nome <> 'Frete' and categoria <> 'Frete' ";

    $produtos = mysqli_query($conn, $tab_produtos);
        
    $selectSQL = ("SELECT * FROM `pedido_previa` where quantidade <> '' and hashpagina = '$app_hashpagina' order by id ASC ");
    
    $recebidos = mysqli_query($conn, $selectSQL);
    $index = 1;
    while ($row_usuario = mysqli_fetch_assoc($recebidos)) {
        $valor[] = number_format($row_usuario['valor'],2);
        
    }

    @$valor_total = array_sum( $valor );
    $valor_real = number_format($valor_total, 2);


    $i = $_SESSION['loginapp'];

    if ($i == 1) {


    ?>
        <input type="hidden" id="app_hash" name="app_hash" value="<?php echo $app_hashpagina ?>">

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

                    <input autofocus type="text" class="form-control" width="100%" height="100%" name="cliente" id="cliente" value="" required>
                    
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
                    <input autofocus required type="text" class="form-control" width="100%" height="100%" name="cliente"
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
                    <table id="dtBasicExample" class="table table-striped table-bordered table-sm reponsive"
                        cellspacing="0" width="100%">
                        <!-- <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%"> -->
                        <thead>
                            <tr>
                                <th class="th-sm">Nome</th>
                                <th class="th-sm">Qtde.</th>
                                <!-- <th class="th-sm">Valor Total</th> -->
                                <th class="th-sm">Observação</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                    $index = 0;
                    
                    while ($rows_produtos = mysqli_fetch_assoc($produtos)) {
                    ?>

                            <tr>
                                <?php  
                                    if( $rows_produtos['nome'] == 'Frete' ){

                                    }else{

                                    
                                ?>
                                <td style="color: #4D4D4D;"><?php echo ($rows_produtos['nome']); ?>
                                    <input name="detalhes[<?php echo $index ?>][pedido]" type="hidden"
                                        class="form-control" id="detalhes[<?php echo $index ?>][pedido]"
                                        value="<?php echo ($rows_produtos['nome']); ?>">
                                    <p style="color: #4D4D4D;">
                                        <b>
                                            R$ <?php echo ($rows_produtos['preco_venda']); ?>
                                        </b>
                                    </p>
                                    <?php
                                        
                                    if( $rows_produtos['categoria'] == 'LANCHE' ){
                                        echo ($rows_produtos['detalhes']);
                                    }else{

                                    }

                                    ?>


                                    <input id="detalhes[<?php echo $index ?>][preco_venda]"
                                        name="detalhes[<?php echo $index ?>][preco_venda]" type="hidden"
                                        class="form-control" value="<?php echo ($rows_produtos['preco_venda']); ?>">

                                    <input id="detalhes[<?php echo $index ?>][id]"
                                        name="detalhes[<?php echo $index ?>][id]" type="hidden"
                                        class="form-control" value="<?php echo ($rows_produtos['id']); ?>">
                                </td>
                                <td style="text-align: center; display: flex;">

                                    <input id="mais<?php echo $index ?>" class="bg-gradient-success" value="+"
                                        type="button">
                                    </input>

                                    <input readonly id="detalhes[<?php echo $index ?>][quantidade]"
                                        class="bg-gradient-default text-center" style="width:50px;"
                                        name="detalhes[<?php echo $index ?>][quantidade]" min="0" maxlength="5"
                                        name="quantity" value="0" type="number">

                                    <input id="menos<?php echo $index ?>" class="bg-gradient-danger" value="-"
                                        type="button">
                                    </input>

                                    <script>
                                        $(document).ready(function() {
                                            $("#mais<?php echo $index ?>").click(function() {
                                                
                                                Quantidade = document.getElementById(
                                                        "detalhes[<?php echo $index ?>][quantidade]")
                                                    .value

                                                Quantidade++;

                                                Q = document.getElementById(
                                                        "detalhes[<?php echo $index ?>][quantidade]")
                                                    .value = Quantidade;

                                                valor = document.getElementById(
                                                        "detalhes[<?php echo $index ?>][preco_venda]")
                                                    .value
                                                    total = valor;

                                                pedido = document.getElementById(
                                                        "detalhes[<?php echo $index ?>][pedido]")
                                                    .value
                                                    
                                                // console.log("Click " + total);

                                                document.getElementById(
                                                    "detalhes[<?php echo $index ?>][valor_unitario]"
                                                ).value = total;
                                               
                                              obs =  document.getElementById(
                                                    "detalhes[<?php echo $index ?>][observacoes]"
                                                ).value;
                                              id =  document.getElementById(
                                                    "detalhes[<?php echo $index ?>][id]"
                                                ).value;
                                               
                                                hashpagina =  document.getElementById(
                                                    "app_hash"
                                                ).value;
                                               
                                                var vData = {
                                                    id: id,
                                                    pedido: pedido,
                                                    Quantidade: 1,
                                                    valor: total,
                                                    obs: obs,
                                                    hashpagina: hashpagina,
                                                    botao: 'mais'
                                                }; 

                                                console.log(vData);

                                                $.ajax({
                                                    url: '../model/ad_pedido_previa.php',
                                                    dataType: 'html',
                                                    type: 'POST',
                                                    data: vData,
                                                    beforeSend: function() {
                                                        // document.getElementById('spiner').style =
                                                        //     'display:block;';
                                                    },
                                                    success: function(html) {
                                                       console.log(html);
                                                       atualizar_previa();


                                                    },

                                                    error: function(err) {
                                                        document.getElementById('spiner').style =
                                                            'display:none;';

                                                    },

                                                });


                                            });
                                        });
                                    </script>
                                    <script>
                                        $(document).ready(function() {
                                            $("#menos<?php echo $index ?>").click(function() {
                                                Quantidade = document.getElementById(
                                                        "detalhes[<?php echo $index ?>][quantidade]")
                                                    .value
                                                Quantidade--;

                                                if( Quantidade == "-1"){

                                                }else{


                                                Q = document.getElementById(
                                                        "detalhes[<?php echo $index ?>][quantidade]")
                                                    .value = Quantidade;

                                                valor = document.getElementById(
                                                        "detalhes[<?php echo $index ?>][preco_venda]")
                                                    .value
                                                    total = Q * valor;

                                                pedido = document.getElementById(
                                                        "detalhes[<?php echo $index ?>][pedido]")
                                                    .value
                                                    
                                                // console.log("Click " + total);

                                                document.getElementById(
                                                    "detalhes[<?php echo $index ?>][valor_unitario]"
                                                ).value = total;
                                               
                                              obs =  document.getElementById(
                                                    "detalhes[<?php echo $index ?>][observacoes]"
                                                ).value;
                                              id =  document.getElementById(
                                                    "detalhes[<?php echo $index ?>][id]"
                                                ).value;
                                               
                                                hashpagina =  document.getElementById(
                                                    "app_hash"
                                                ).value;
                                               
                                                var vData = {
                                                    id: id,
                                                    pedido: pedido,
                                                    Quantidade: Quantidade,
                                                    valor: total,
                                                    obs: obs,
                                                    hashpagina: hashpagina
                                                }; 

                                                console.log(vData);

                                                $.ajax({
                                                    url: '../model/ad_pedido_previa.php',
                                                    dataType: 'html',
                                                    type: 'POST',
                                                    data: vData,
                                                    beforeSend: function() {
                                                        // document.getElementById('spiner').style =
                                                        //     'display:block;';
                                                    },
                                                    success: function(html) {
                                                       console.log(html);
                                                       atualizar_previa();

                                                    },

                                                    error: function(err) {
                                                        document.getElementById('spiner').style =
                                                            'display:none;';

                                                    },

                                                });
  
                                            };
                                            });
                                        });
                                    </script>

                                </td>

                                       
                                            <input id="detalhes[<?php echo $index ?>][valor_unitario]"
                                            class="bg-gradient-default text-center" style="width:50px;" name="" min="0"
                                            maxlength="5" name="quantity" value="0" type="hidden" disabled >
                                       

                                <td  >

                                    <textarea name="detalhes[<?php echo $index ?>][observacoes]" class="form-control"
                                        id="detalhes[<?php echo $index ?>][observacoes]"></textarea>

                                </td>

                            </tr>

                            <?php $index++;
                    } 
                }
                    
                    ?>

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

<br><br><br><br><br><br><br>

        <!-- <script src="../common/js/jquery-3.3.1.slim.min.js"></script> -->
        <!-- <script src="../common/js/popper.min.js"></script> -->
        <!-- <script src="../common/js/bootstrap.min.js"></script> -->

<style>
    body {margin:0;}

    .navbar {
    overflow: hidden;
    background-color: #333;
    position: fixed;
    bottom: 0;
    width: 100%;
    }

    .navbar a {
    float: left;
    display: block;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
    }

    .navbar a:hover {
    background: #ddd;
    color: black;
    }

    .main {
    padding: 16px;
    margin-bottom: 30px;
    height: 1500px; /* Used in this example to enable scrolling */
    }
</style>

<div id="div" class="navbar">
  <a href=""> <?php echo $valor_real ?> </a>
</div>

<script>
    function atualizar_previa() {
            $("#div").load("app_previa.php");
    };
</script> 


</body>
</html>