<?php
session_start();
// include_once("conexao.php");
include "./mvc/model/conexao.php";
include_once "./mvc/model/hashPagina.php";
// print_r($_POST);
// exit();

$user =  $_SESSION['user'];
$hora_pedido = date('H:i');

$categoria = $_POST['categoria'];
$pesquisa = $_POST['pesquisa'];
$mesa = $_POST['mesa'];
$cliente = $_POST['cliente'];
// print_r($_POST);
?>
<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- Bootstrap core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.2/css/mdb.min.css" rel="stylesheet">
<!-- <link href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
<!-- JQuery -->
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js">
</script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.2/js/mdb.min.js"></script>
<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script> -->
<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script> -->

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css" />

<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>



<div class="row">
    <div class="col-xl-6 col-md-6 mb-4">

        <div class="row">

            <div class="col-8"></div>
            <div class="col-4" id="mensagem" style="visibility: visible"><?php if (isset($_SESSION['msg'])) {
                                                                        echo $_SESSION['msg'];
                                                                        unset($_SESSION['msg']);
                                                                    } ?></div>
        </div>

        <br>

        <?php

$tab_clientes = "SELECT * FROM clientes";
$clientes = mysqli_query($conn, $tab_clientes);

$tab_produtos = "SELECT * FROM `produtos` where nome <> 'Frete' ORDER by id ASC" ;
$produtos = mysqli_query($conn, $tab_produtos);

$tab_pgto = "SELECT * FROM `forma_pagamento` ORDER by id ASC" ;
$pgto = mysqli_query($conn, $tab_pgto);


if ($mesa == 'delivery') {
?>
        <form id="Form" action="mvc/model/ad_pedido.php" method="POST">
            <input type="hidden" id="hash" name="hash">
            <input type="hidden" name="categoria" id="categoria" value="<?php echo $categoria; ?>">
            <input type="hidden" name="mesa" id="mesa" value="<?php echo $mesa; ?>">
            <!-- <input type="hidden" name="cliente" id="cliente" value="<?php echo $cliente; ?>"> -->
            <div class="row">
                <h4 class="col-lg-7">
                    <label for="">Cliente:</label>
                    <input autofocus type="text" class="form-control" width="100%" height="100%" name="cliente"
                        id="cliente" value="<?php echo $cliente ?>">
                </h4>
            </div>

            <input class="btn btn-outline-success" type="submit" name="enviar" value="Finalizar Pedido">

            <?php

} else {

    ?>
  
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    
// In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.js-example-basic-single').select2({
        width: 'resolve',
        dropdownAutoWidth: true,
        tags: true,
        placeholder: "Selecionar um cliente",
        allowClear: true,
        theme: "classic"
    });
});   

</script>


            <form id="Form" action="mvc/model/ad_pedido_balcao.php" method="POST">
                    <div class="row" style="padding: 10px;" >
                        <label for=""> <b>********* TIPO: *********</label></b>&nbsp;&nbsp;
                        <div class="custom-control custom-switch">
                            <input checked value="Local" type="checkbox" class="custom-control-input" id="customSwitch">
                            <label id="custom-control-label" class="custom-control-label" for="customSwitch">Local</label>
                            <input type="hidden" name="tipo" id="tipo" value="Local" >
                        </div>
                    </div>
                        
                <input type="hidden" id="hash" name="hashpagina" value="<?php echo $hashpagina ?>">
                
                <input type="hidden" name="categoria" id="categoria" value="<?php echo $categoria; ?>">
                <input type="hidden" name="mesa" id="mesa" value="<?php echo $mesa; ?>">
                <!-- <input type="hidden" name="cliente" id="cliente" value="<?php echo $cliente; ?>"> -->
                <div class="row">
                    <h4 class="col-lg-12">
                        <label for="">* Cliente:</label>
                        <br>
                        <!-- <input autofocus type="text" class="form-control" width="100%" height="100%" name="cliente" id="cliente" value="" required> -->
                        <select style="width: 70%"  class="js-example-basic-single" name="cliente" id="cliente" value="" required>
                            <?php while ($rows_clientes = mysqli_fetch_assoc($clientes)) {
                                ?>
                                <option value=""></option>
                                <option value="<?php echo $rows_clientes['id']?>">
                                <?php 
                                    echo  $rows_clientes['nome'] ." | ". $rows_clientes['tel1']
                                ?> 
                                </option>
                                
                                <?php
                                
                            }
                            ?>
                            </select>
                            </h4>

                </div>

                <div id="frete" style="display: none;" class="row">
                    <h4 class="col-lg-12">
                        <label for="">* Frete:</label>
                            <div class="alert alert-primary" role="alert">
                                
                            </div>    
                    </h4>

                </div>

                <script>
                    $(document).ready(function() {
                        $("#cliente").change(function() {
                            let id_cliente = document.getElementById("cliente").value;
                                console.log(id_cliente);
                                var vData = {
                                    id_cliente: id_cliente
                                };
                                if( id_cliente > 0 ){
                                    $.ajax({
                                    url: './mvc/model/frete.php',
                                    method: "POST",
                                    data: vData,
                                    success: function(html) {
                                        document.getElementById('frete').style = 'display:block;';
                                        $('#frete').html(html);
                                    },
                                    error: function(err) {
                                        $('#frete').html(html);
                                    },
                                    });
                                }
                        })
                    });
                    </script>
                        
                        <script>

                            $(document).ready(function() {
                                $("#customSwitch").click(function() {

                                    var isChecked = document.getElementById("customSwitch").checked;
                                    // console.log(isChecked);

                                    if (isChecked == false) {

                                            var labe1 = document.getElementById('custom-control-label');
                                            labe1.innerText = "Levar";
                                            
                                            document.getElementById('tipo').value = 'Levar'
                                            

                                    } else {

                                        var labe1 = document.getElementById('custom-control-label');
                                            labe1.innerText = "Local";
                                            
                                            document.getElementById('tipo').value = 'Local'

                                    }

                                });
                            });
                        </script>
                    

                <b>
                    <label for="">* Forma de Pagamento:</label>
                </b>
                <div class="row">

                <?php
                    while ($rows_pgto = mysqli_fetch_assoc($pgto)) {
                ?>

                    <div class="form-group col-md-3">
                        <div class="form-check">
                            <input name="pgto" class="form-check-input" type="radio" value="<?php echo ($rows_pgto['value']) ?>" id="<?php echo ($rows_pgto['tipo']) ?>">
                            <label class="form-check-label" for="<?php echo ($rows_pgto['tipo']) ?>"><?php echo ($rows_pgto['tipo']) ?></label>
                        </div>
                    </div>
                <?php
                    }
                ?>
                    

                </div>

                <input class="btn btn-outline-success" type="submit" name="enviar" value="Finalizar Pedido">

                <?php
    }
        ?>
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
                                <th class="th-sm">Estoque Atual</th>
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
                                    <input name="detalhes[<?php echo $index ?>][pedido]" type="hidden"
                                        class="form-control" id="detalhes[<?php echo $index ?>][pedido]"
                                        value="<?php echo ($rows_produtos['nome']); ?>">
                                    <p style="color: #4D4D4D;">
                                        <b>
                                            R$ <?php echo ($rows_produtos['preco_venda']); ?>
                                        </b>
                                    </p>
                                    <?php
                                        
                                    if( $rows_produtos['categoria'] <> 'BEBIDAS' ){
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
                                                    "hash"
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
                                                    url: './mvc/model/ad_pedido_previa.php',
                                                    dataType: 'html',
                                                    type: 'POST',
                                                    data: vData,
                                                    beforeSend: function() {
                                                        // document.getElementById('spiner').style =
                                                        //     'display:block;';
                                                    },
                                                    success: function(html) {
                                                       console.log(html);

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
                                                    "hash"
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
                                                    url: './mvc/model/ad_pedido_previa.php',
                                                    dataType: 'html',
                                                    type: 'POST',
                                                    data: vData,
                                                    beforeSend: function() {
                                                        // document.getElementById('spiner').style =
                                                        //     'display:block;';
                                                    },
                                                    success: function(html) {
                                                       console.log(html);

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
                                       
                                <td>
                                    <label for=""> <?php echo $rows_produtos['estoque_atual']?></label>
                                </td>

                                <td>

                                    <textarea name="detalhes[<?php echo $index ?>][observacoes]" class="form-control"
                                        id="detalhes[<?php echo $index ?>][observacoes]"></textarea>

                                </td>

                            </tr>

                            <?php $index++;
                    };
                    
                    ?>

                        </tbody>
                    </table>
                </div>
                <script>
                    $(document).ready(function() {
                        $('#dtBasicExample').DataTable({
                            "paging": true, // false to disable pagination (or any other option)
                            "ordering": false, // false to disable sorting (or any other option)
                            "searching": true,
                            "language": {
                                "url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json"
                            }
                        });
                        $('.dataTables_length').addClass('bs-select');
                    });
                </script>
                <script type="text/javascript">
                    var var1 = document.getElementById("mensagem");
                    setTimeout(function() {
                        var1.style.display = "none";
                    }, 5000)
                </script>
            </form>

          
    </div>

    <script>

    </script>

   <?php 

    // include_once "./mvc/model/apagar_previa.php";
    // include_once "./mvc/views/pedidoprevia.php";

   ?>

<script>
    $(function() {
    var atualiza = function() {
        $("#div").load("./mvc/views/pedidoprevia.php");
    };

    setInterval(function() {
    atualiza();
    }, 100); // A CADA 1 SEGUNDO RODA A FUNÇÃO atualiza

    });
</script> 
<!-- <div class="row">

<div class="col-8" ></div>
<div class="col-4" id="mensagem" style="visibility: visible"><?php if (isset($_SESSION['msg'])) {echo $_SESSION['msg'];  unset($_SESSION['msg']); }?></div>

</div> -->

<h1 class="col-xl-6 col-md-6 mb-4" id="div" > </h1>

