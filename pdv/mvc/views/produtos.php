<?php
include "./mvc/model/conexao.php";

date_default_timezone_set('America/Sao_Paulo');
$data_hoje = date('Y-m-d');

$dtinicio = $_POST['dtinicio'];
$dtfim = $_POST['dtfim'];

if( $dtinicio != "" || $dtfim != "" ){
     $dtinicioFormatada = $_POST['dtinicio'];
     $dtfimFormatada = $_POST['dtfim'];

}else{
     $dtinicioFormatada = date('Y-m-d');
     $dtfimFormatada = date('Y-m-d');
   // Obtém a data atual
    $dataAtual = new DateTime();

    // Obtém o primeiro dia do mês
    $primeiroDiaDoMes = new DateTime($dataAtual->format('Y-m-01'));

    // Obtém o último dia do mês
    $ultimoDiaDoMes = new DateTime($dataAtual->format('Y-m-t'));

    // Formate as datas conforme necessário
    $dtinicioFormatada = $primeiroDiaDoMes->format('Y-m-d');
    $dtfimFormatada = $ultimoDiaDoMes->format('Y-m-d');

}
echo "<br>";

$tab_produto = "SELECT
 produto,
 SUM(quantidade) as qtde,
 DATE_FORMAT(`data`, '%d/%m/%Y') AS data,
 SUM(CAST(REPLACE(TRIM(valor), ',', '.') AS DECIMAL(10,2))) AS novo_valor
FROM
 pedido
WHERE
DATE_FORMAT(`data`, '%Y-%m-%d') >= '$dtinicioFormatada' and DATE_FORMAT(`data`, '%Y-%m-%d') <= '$dtfimFormatada'
GROUP by
 produto
ORDER by
 `qtde` desc ;
";

$produto = mysqli_query($conn, $tab_produto);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Produtos</title>

</head>
<body>
    <h1>Data para busca</h1>

    <form action="?view=produtos" method="POST">
        <div class="row" style="text-align-last: center;" >
        <div class= "col-3" >
            <p>Data inicio: <input required name="dtinicio" type="text" id="datepicker"></p>
            </div>
            
            <div class= "col-3" >
                <p>Data fim: <input required name="dtfim" type="text" id="datepicker2"></p>
            </div>

            <div class= "col-7" >
                <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-info">Buscar</button>
                        </div>
                </div>
            </div>
        </div>
    </form>   


    <script>
        
        $(function(){
            $("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
        });

        $(function(){
            $("#datepicker2").datepicker({ dateFormat: 'yy-mm-dd' });
        });

        jQuery(function($){

            $.datepicker.regional['pt-BR'] = {

                closeText: 'Fechar',

                prevText: '&#x3c;Anterior',

                nextText: 'Pr&oacute;ximo&#x3e;',

                currentText: 'Hoje',

                monthNames: ['Janeiro','Fevereiro','Mar&ccedil;o','Abril','Maio','Junho',

                'Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],

                monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun',

                'Jul','Ago','Set','Out','Nov','Dez'],

                dayNames: ['Domingo','Segunda-feira','Ter&ccedil;a-feira','Quarta-feira','Quinta-feira','Sexta-feira','S&aacute;bado'],

                dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','S&aacute;b'],

                dayNamesMin: ['Dom','Seg','Ter','Qua','Qui','Sex','S&aacute;b'],

                weekHeader: 'Sm',

                dateFormat: 'dd/mm/yy',

                firstDay: 0,

                isRTL: false,

                showMonthAfterYear: false,

                yearSuffix: ''};

            $.datepicker.setDefaults($.datepicker.regional['pt-BR']);

            });

    </script>

<h1>Vendas do mês Produtos</h1>
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
                <th>Produtos</th>
                <th>Quantidade Saída</th>
                <th>Valor</th>
                <!-- <th>Data Saída</th> -->
            </tr>
        </thead>
        <tbody>
            <?php
                    $index = 0;
                    while ($rows_produto = mysqli_fetch_assoc($produto)) { 
                    ?>
            <tr>
                <?php
                        ?>
                            <td > <?php echo $rows_produto['produto'] ?></td>
                            <td > <?php echo $rows_produto['qtde'] ?></td>
                            <td > <?php echo $rows_produto['novo_valor'] ?></td>
                            <!-- <td > <?php echo $rows_produto['data'] ?></td> -->
                <?php } ?>
            </tr>
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

</body>
</html>
