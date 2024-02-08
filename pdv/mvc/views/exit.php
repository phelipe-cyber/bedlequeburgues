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
}
echo "<br>";

$vendaspgto = "SELECT
                        id_pedido,
                        pgto,
                        (CASE
                            WHEN c.nome IS NULL THEN `vendas`.cliente 
                            ELSE c.nome
                        END) as cliente,
                        (CAST(valor AS DECIMAL(10, 2))) 'valor',
                        (CAST(valor_maquina AS DECIMAL(10, 2))) 'valor_maquina' ,
                        data,
                        (CASE
                            WHEN valor_maquina IS NOT NULL
                            AND valor_maquina != '' THEN CAST(valor_maquina AS DECIMAL(10, 2))
                            ELSE CAST(valor AS DECIMAL(10, 2))
                        END) AS Rendimento
                        FROM
                        `vendas`
                        left join clientes c on c.id = `vendas`.cliente 
                        WHERE
                        DATE_FORMAT(STR_TO_DATE(`data`, '%d/%m/%Y'), '%Y-%m-%d') >= '$dtinicioFormatada'
                        and DATE_FORMAT(STR_TO_DATE(`data`, '%d/%m/%Y'), '%Y-%m-%d') <= '$dtfimFormatada'
                        ORDER by
                        DATE_FORMAT(STR_TO_DATE(`data`, '%d/%m/%Y'), '%Y-%m-%d'),
                        pgto ASC";
$vendaspgto_re = mysqli_query($conn, $vendaspgto);


$tab_caixa = "SELECT pgto 'pgto', sum(valor) 'valor', sum(valor_maquina) 'valor_maquina' , data, 
SUM(CASE
        WHEN valor_maquina IS NOT NULL AND valor_maquina != '' THEN CAST(valor_maquina AS DECIMAL(10, 2))
        ELSE CAST(valor AS DECIMAL(10, 2))
    END) AS Rendimento
FROM `vendas` WHERE DATE_FORMAT(STR_TO_DATE(`data`, '%d/%m/%Y'), '%Y-%m-%d') >= '$dtinicioFormatada' and DATE_FORMAT(STR_TO_DATE(`data`, '%d/%m/%Y'), '%Y-%m-%d') <= '$dtfimFormatada' GROUP by pgto, DATE_FORMAT(STR_TO_DATE(`data`, '%d/%m/%Y'), '%Y-%m-%d')
UNION
SELECT 'Total', SUM(CAST(valor AS DECIMAL(10, 2))) 'valor', SUM(CAST(valor_maquina AS DECIMAL(10, 2))) 'valor_maquina' , data, 
SUM(CASE
        WHEN valor_maquina IS NOT NULL AND valor_maquina != '' THEN CAST(valor_maquina AS DECIMAL(10, 2))
        ELSE CAST(valor AS DECIMAL(10, 2))
    END) AS Rendimento
FROM `vendas` WHERE DATE_FORMAT(STR_TO_DATE(`data`, '%d/%m/%Y'), '%Y-%m-%d') >= '$dtinicioFormatada' and DATE_FORMAT(STR_TO_DATE(`data`, '%d/%m/%Y'), '%Y-%m-%d') <= '$dtfimFormatada'
GROUP by DATE_FORMAT(STR_TO_DATE(`data`, '%d/%m/%Y'), '%Y-%m-%d') ";

$caixa = mysqli_query($conn, $tab_caixa);
$caixa_rendimento = mysqli_query($conn, $tab_caixa);

 $tab_despesa = "SELECT 'Total Despesa', SUM(valor) valor, data FROM `despesas` where DATE_FORMAT(STR_TO_DATE(`data`, '%d/%m/%Y'), '%Y-%m-%d') >= '$dtinicioFormatada' and DATE_FORMAT(STR_TO_DATE(`data`, '%d/%m/%Y'), '%Y-%m-%d') <= '$dtfimFormatada' 
GROUP by DATE_FORMAT(STR_TO_DATE(`data`, '%d/%m/%Y'), '%Y-%m-%d') ORDER by DATE_FORMAT(STR_TO_DATE(`data`, '%d/%m/%Y'), '%Y-%m-%d') ASC";

// UNION
// SELECT  'Total Despesa', SUM(valor) valor, data FROM `despesas` where DATE_FORMAT(STR_TO_DATE(`data`, '%d/%m/%Y'), '%Y-%m-%d') >= '$dtinicioFormatada' and DATE_FORMAT(STR_TO_DATE(`data`, '%d/%m/%Y'), '%Y-%m-%d') <= '$dtfimFormatada' ORDER by `data` ASC";

$despesa = mysqli_query($conn, $tab_despesa);

while ($rows_rendimento = mysqli_fetch_assoc($caixa_rendimento)) { 
    $rendimento =  $rows_rendimento['Rendimento'];
}
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
            <input readonly type="text" name="valor_final" value="<?php echo $rendimento ?>" id="valor_final" class="form-control" onkeyup="formatarMoeda();">
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


    <form action="?view=exit" method="POST">
        <div class="row" style="text-align-last: center;" >
        <div class= "col-3" >
            <p>Data inicio: <input autocomplete="off" required name="dtinicio" type="text" id="datepicker"></p>
            </div>
            
            <div class= "col-3" >
                <p>Data fim: <input autocomplete="off" required name="dtfim" type="text" id="datepicker2"></p>
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
                <th>Tipo de Pagamento</th>
                <th>Valor Pago Cliente</th>
                <th>Valor Maquininha</th>
                <th>Rendimento C/ Desconto Maquininha</th>
                <th>Data</th>

            </tr>
        </thead>
        <tbody>
            <?php
                    $index = 0;
                    while ($rows_caixa = mysqli_fetch_assoc($caixa)) { 
                    ?>
            <tr>
                
                <?php
                    //  echo $rows_caixa['pgto']
                    if( $rows_caixa['pgto'] == 'Total'){ 
                        $rendimento = $rows_caixa['Rendimento'];
                        ?> 
                            <td style="color: blue; height: 50px;"> <?php echo $rows_caixa['pgto'] ?></td>
                            <td style="color: blue; height: 50px;">R$ <?php echo number_format($rows_caixa['valor'], 2); ?></td>
                            <td style="color: blue; height: 50px;">R$ <?php echo number_format($rows_caixa['valor_maquina'], 2); ?></td>
                            <td style="color: blue; height: 50px;">R$ <?php echo number_format($rows_caixa['Rendimento'], 2); ?></td>
                                <td style="color: blue; height: 50px;"><?php echo $rows_caixa['data'] ?></td>
                         <?php
                    }else{
                        $rendimento = $rows_caixa['Rendimento'];
                        ?> 
                                <td > <?php echo $rows_caixa['pgto'] ?></td>
                                <td >R$ <?php echo number_format($rows_caixa['valor'], 2); ?></td>
                                <td >R$ <?php echo number_format($rows_caixa['valor_maquina'], 2); ?></td>
                                <td >R$ <?php echo number_format($rows_caixa['Rendimento'], 2); ?></td>
                                <td ><?php echo $rows_caixa['data'] ?></td>
                
                <?php } ?>
            </tr>


            <?php $index++;
                    } ?>


        </tbody>
    </table>
</div>

<br>

<h1>Vendas do dia Por ordem de pagamento</h1>
<div class="table-responsive">
    <table id="dtBasicExample" class="table table-striped table-bordered table-sm reponsive" cellspacing="0"
        width="100%">
        <thead>
            <tr>
                <th>Qtde.</th>
                <th>ID Pedido</th>
                <th>Cliente</th>
                <th>Tipo de Pagamento</th>
                <th>Valor Pago Cliente</th>
                <th>Valor Maquininha</th>
                <th>Rendimento C/ Desconto Maquininha</th>
                <th>Data</th>

            </tr>
        </thead>
        <tbody>
            <?php
                    $index = 1;
                    while ($rows_vendaspgto = mysqli_fetch_assoc($vendaspgto_re)) { 
                    ?>
            <tr>
                
                <?php
                    //  echo $rows_caixa['pgto']
                    if( $rows_caixa['pgto'] == 'Total'){ 
                        $rendimento = $rows_caixa['Rendimento'];
                        ?> 
                            <td style="color: blue; height: 50px;"> <?php echo $rows_vendaspgto['pgto'] ?></td>
                            <td style="color: blue; height: 50px;">R$ <?php echo number_format($rows_vendaspgto['valor'], 2); ?></td>
                            <td style="color: blue; height: 50px;">R$ <?php echo number_format($rows_vendaspgto['valor_maquina'], 2); ?></td>
                            <td style="color: blue; height: 50px;">R$ <?php echo number_format($rows_vendaspgto['Rendimento'], 2); ?></td>
                                <td style="color: blue; height: 50px;"><?php echo $rows_vendaspgto['data'] ?></td>
                         <?php
                    }else{
                        $rendimento = $rows_vendaspgto['Rendimento'];
                        ?> 
                                <td > <?php echo $index ?></td>
                                <td > <?php echo $rows_vendaspgto['id_pedido'] ?></td>
                                <td > <?php echo $rows_vendaspgto['cliente'] ?></td>
                                <td > <?php echo $rows_vendaspgto['pgto'] ?></td>
                                <td >R$ <?php echo number_format($rows_vendaspgto['valor'], 2); ?></td>
                                <td >R$ <?php echo number_format($rows_vendaspgto['valor_maquina'], 2); ?></td>
                                <td >R$ <?php echo number_format($rows_vendaspgto['Rendimento'], 2); ?></td>
                                <td ><?php echo $rows_vendaspgto['data'] ?></td>
                
                <?php } ?>
            </tr>


            <?php $index++;
                    } ?>


        </tbody>
    </table>
</div>

<br>

<h1>Despesas do dia</h1>
<div class="table-responsive">
    <table id="dtBasicExample2" class="table table-striped table-bordered table-sm reponsive" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Valor despesa</th>
                <th>Valor Liquido</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            <?php
                    $index = 0;
                    while ($rows_despesa = mysqli_fetch_assoc($despesa)) { 
                        
                    ?>
            <tr>

                <td> <?php echo $rows_despesa['Total Despesa'] ?></td>
               <td style="color: red; height: 50px;" >R$ <?php echo number_format($rows_despesa['valor'], 2); ?></td>
               <td style="color: red; height: 50px;" >R$ <?php echo number_format($rows_despesa['valor'] - $rendimento, 2); ?></td>
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
