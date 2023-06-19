    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.2/css/mdb.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.2/js/mdb.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css"/>
 
 <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
 

    <?php

    $categoria = $_POST['categoria'];
    $pesquisa = $_POST['pesquisa'];
    $mesa = $_POST['mesa'];
    $cliente = $_POST['cliente'];
    $nomecliente = $_POST['nomecliente'];
    $pedido = $_POST['pedido'];
    $pgto = $_POST['pgto'];

    ?>

<form action="mvc/model/ad_pedido_balcao.php" method="POST">
            
    <div class="row">
        <h4 class="col-lg-3">
            <label for="">Pedido: <?php echo $pedido ?></label>
            <br>    
            <label for="">Cliente: <?php echo $nomecliente ?></label>
        </h4>
    </div>


    <?php
    include "./mvc/model/conexao.php";

    ?>
    <input type="hidden" name="pedido" value="<?php echo $pedido ?>">
    <input type="hidden" name="cliente" value="<?php echo $nomecliente ?>">
    <input type="hidden" name="pgto" value="<?php echo $pgto ?>">
    
        <input class="btn btn-outline-success" type="submit" name="enviar" value="Incluir no Pedido">
      
    <?php

    $tab_produtos = "SELECT * FROM produtos ";

    $produtos = mysqli_query($conn, $tab_produtos);

    ?>
    <div style="justify-content:center; align-items: center; width: 100%; ">
        <!-- <div class="col-2"> -->
        <!-- <div class="flex-center flex-column"> -->
        <!-- <div class="card card-body"> -->

        <!-- <div class="table-responsive"> -->
        <table id="dtBasicExample" class="table table-striped table-bordered table-sm reponsive" cellspacing="0" width="100%">
            <!-- <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%"> -->
            <thead>
                <tr>

                    <!-- <th class="th-sm">#</th> -->
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
                        <!-- <td><?php echo $rows_produtos['id']; ?> -->

                        </td>

                        <td style="color: #4D4D4D;"><?php echo ($rows_produtos['nome']); ?>
                                <input name="detalhes[<?php echo $index ?>][pedido]" type="hidden" class="form-control" id="pedido" value="<?php echo ($rows_produtos['nome']); ?>">
                                <p style="color: #4D4D4D;">
                                    <b>
                                        R$ <?php echo ($rows_produtos['preco_venda']); ?>
                                    </b>
                                </p>
                                <input name="detalhes[<?php echo $index ?>][preco_venda]" type="hidden" class="form-control" id="preco_venda" value="<?php echo ($rows_produtos['preco_venda']); ?>">
                            </td>
                        <td>
                            <input class="bg-gradient-success" value="+" type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()"></input>
                            <input class="bg-gradient-default text-center" style="width:50px;" name="detalhes[<?= $index ?>][quantidade]" min="0" maxlength="5" name="quantity" value="0" type="number">
                            <input class="bg-gradient-danger" value="-" type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()"></input>
                        </td>

                        <td>

                            <textarea name="detalhes[<?php echo $index ?>][observacoes]" class="form-control" id="observacoes"></textarea>

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

    </form>