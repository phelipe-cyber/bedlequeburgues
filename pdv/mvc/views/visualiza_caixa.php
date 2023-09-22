<?php
include "./mvc/model/conexao.php";


$tab_caixa = "SELECT * FROM caixa order by `data_hora` DESC ";

$caixa = mysqli_query($conn, $tab_caixa);

?>
<h1 class="display-12">Caixa</h1>

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
<h4> Relação de Caixas :</h4>


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
                <th>Valor Abertura</th>
                <th>Dia Abertura</th>
                <th>Valor Fechamento</th>
                <th>Dia Fechamento</th>

            </tr>
        </thead>
        <tbody>
            <?php
                    $index = 0;
                    while ($rows_caixa = mysqli_fetch_assoc($caixa)) {
                        $dataHora = date('d/m/Y H:i:s', strtotime($rows_caixa['data_hora']));
                        $update_at = $rows_caixa['update_at'];
                        if($update_at == NULL){
                            $update_at == '';
                        }else{
                            $update_at = date('d/m/Y H:i:s', strtotime($rows_caixa['update_at']));
                        }
                    ?>
            <tr>

                <td><?php echo $rows_caixa['valor_abertura'] ?></td>
                <td><?php echo $dataHora ?></td>
                <td><?php echo $rows_caixa['valor_fechamento'] ?></td>
                <td><?php echo $update_at ?></td>
				
            </tr>


            <?php $index++;
                    } ?>


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
