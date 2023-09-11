<?php
include "./mvc/model/conexao.php";

date_default_timezone_set('America/Sao_Paulo');
$data_hoje = date('d/m/Y');


$tab_caixa = "SELECT pgto 'pgto', SUM(valor) 'valor', SUM(valor_maquina) 'valor_maquina' , data FROM `vendas` 
WHERE data = '$data_hoje'
GROUP by pgto;";
$caixa = mysqli_query($conn, $tab_caixa);

$tab_despesa = "SELECT SUM(valor) valor, data FROM `despesas` where data = '$data_hoje' GROUP by DATA";

$despesa = mysqli_query($conn, $tab_despesa);


?>
<!DOCTYPE html>
<html>
<head>
    <title>Fechamento de Caixa</title>
</head>
<body>
    <h1>Fechamento de Caixa</h1>
    <form action="mvc/model/processar_fechamento.php" method="POST">

        <div class="row">
            <div class="col-4" id="mensagem" style="visibility: visible"><?php if (isset($_SESSION['msg'])) {echo $_SESSION['msg'];  unset($_SESSION['msg']); }?></div>
        </div>

        <div class="form-group col-md-2">
            <label for="recipient-name" class="col-form-label">Valor Final:</label>
            <!-- <input required type="text" name="valor_final" id="valor_final" class="form-control"> -->
            <input required type="text" name="valor_final" id="valor_final" class="form-control" onkeyup="formatarMoeda();">
        </div>
       
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">Fechar Caixa</button>
            </div>
        </div>
        <script>
            function formatarMoeda() {
                var elemento = document.getElementById('valor_final');
                var valor = elemento.value;
                console.log(valor)
                valor = valor + '';
                valor = parseInt(valor.replace(/[\D]+/g, ''));
                valor = valor + '';
                valor = valor.replace(/([0-9]{2})$/g, ",$1");
                if (valor.length > 6) {
                    valor = valor.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
                }
                if(valor == 'NaN'){
                    valor = null;
                }else{
                    elemento.value = valor;
                }
            }
        </script>

        <script>
            var var1 = document.getElementById("mensagem");
            setTimeout(function() {
                var1.style.display = "none";
            }, 5000)
        
        </script>
    </form>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- Bootstrap core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.2/css/mdb.min.css" rel="stylesheet">
<!-- <link href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.2/js/mdb.min.js"></script>
<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script> -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css" />

<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
<h1>Vendas do dia</h1>
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
                <th>Tipo de pagamento</th>
                <th>Valor</th>
                <th>Valor Maquininha</th>
                <th>Data</th>

            </tr>
        </thead>
        <tbody>
            <?php
                    $index = 0;
                    while ($rows_caixa = mysqli_fetch_assoc($caixa)) { 
                    ?>
            <tr>

                <td><?php echo $rows_caixa['pgto'] ?></td>
				<td>R$ <?php echo number_format($rows_caixa['valor'], 2); ?></td>
				<td>R$ <?php echo number_format($rows_caixa['valor_maquina'], 2); ?></td>
				<td><?php echo $rows_caixa['data'] ?></td>
               
            </tr>


            <?php $index++;
                    } ?>


        </tbody>
    </table>
</div>

<h1>Despesas do dia</h1>
<div class="table-responsive">
    <table id="dtBasicExample2" class="table table-striped table-bordered table-sm reponsive" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Valor despesa total</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            <?php
                    $index = 0;
                    while ($rows_despesa = mysqli_fetch_assoc($despesa)) { 
                    ?>
            <tr>

               <td>R$ <?php echo number_format($rows_despesa['valor'], 2); ?></td>
               <td> <?php echo $rows_despesa['data'] ?></td>
               
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
        "ordering": false, // false to disable sorting (or any other option)
        "searching": false,
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json"
        }
    });
    $('.dataTables_length').addClass('bs-select');
});
</script>
<script>
$(document).ready(function() {
    $('#dtBasicExample2').DataTable({
        "paging": false, // false to disable pagination (or any other option)
        "ordering": false, // false to disable sorting (or any other option)
        "searching": false,
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json"
        }
    });
    $('.dataTables_length').addClass('bs-select');
});
</script>



</body>
</html>
