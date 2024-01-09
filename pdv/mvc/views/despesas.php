<?php
include "./mvc/model/conexao.php";

date_default_timezone_set('America/Sao_Paulo');
$data_hoje = date('d/m/Y');

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

$tab_produtos = "SELECT * FROM `produtos` where nome <> 'Frete'  ORDER by id ASC";
$produtos = mysqli_query($conn, $tab_produtos);

$tab_despesas = "SELECT id, valor, valor_unitario, despesa, qtde, DATE_FORMAT(STR_TO_DATE(`data`, '%d/%m/%Y'), '%d/%m/%Y') as data FROM despesas where DATE_FORMAT(STR_TO_DATE(`data`, '%d/%m/%Y'), '%Y-%m-%d') >= '$dtinicioFormatada' and DATE_FORMAT(STR_TO_DATE(`data`, '%d/%m/%Y'), '%Y-%m-%d') <= '$dtfimFormatada' order by id desc ";
$despesas = mysqli_query($conn, $tab_despesas);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Produtos</title>

</head>
<body>
<div class="row">
		<div class="col-8"></div>
		<div class="col-4 text-center" id="mensagem" style="visibility: visible"> <?php
        		if (isset($_SESSION['msg'])) {
			echo $_SESSION['msg'];
			unset($_SESSION['msg']);
		}
		?></div>
	</div>
    
    <script type="text/javascript">
		var var1 = document.getElementById("mensagem");
		setTimeout(function() {
			var1.style.visibility = "hidden";
		}, 5000)
	</script>

    <h1>Data Para Busca</h1>

    <form action="?view=despesas" method="POST">
        <div class="row" style="text-align-last: center;" >
        <div class= "col-3" >
            <p>Data inicio: <input required name="dtinicio" type="text" id="datepicker" class="form-control"></p>
            </div>
            
            <div class= "col-3" >
                <p>Data fim: <input required name="dtfim" type="text" id="datepicker2" class="form-control"></p>
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
        $(function(){
            $('#datepicker3').datepicker({
                dateFormat: 'd/m/yy'
            });
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

                dateFormat: 'd/m/Y',

                firstDay: 0,

                isRTL: false,

                showMonthAfterYear: false,

                yearSuffix: ''};

            $.datepicker.setDefaults($.datepicker.regional['pt-BR']);

            });

    </script>

<form method="POST" action="mvc/model/despesa.php">
            <div class="row">
                <h4 class="col-lg-6">
                    <label for="">* Produtos:</label>
                    <br>
                    <select style="width: 70%" class="js-example-basic-single" name="despesa" id="despesa" value="" required>
                        <?php while ($rows_produtos = mysqli_fetch_assoc($produtos)) {
                        ?>
                            <option value=""></option>
                            <option value="<?php echo $rows_produtos['id'] ?>">
                                <?php
                                echo  $rows_produtos['nome']
                                ?>
                            </option>

                        <?php

                        }
                        ?>
                    </select>
                </h4>
            </div>
            
            <div class="row">
			<div class="form-group col-md-2">
				<label for="message-text" class="col-form-label">Data:</label>
				<input id="datepicker3" value="<?= $data_hoje ?>" name="data" id="data" type="text" class="form-control">
			</div>
            <div class="form-group col-md-3">
                <label for="message-text" class="col-form-label">Valor Unitario:</label>
                <input required value="" type="text" id="valor" name="valor_unitario" class="form-control" oninput="formatarInputComoMoeda()">
            </div>
			<div class="form-group col-md-2">
				<label for="message-text" class="col-form-label">Quantidade:</label>
				<input value="" name="qtde" id="quantidade"  type="text" class="form-control" oninput="somartotal()">
			</div>
            
			<div class="form-group col-md-3">
				<label for="message-text" class="col-form-label">Valor TOTAL:</label>
				<input readonly value="" name="valor" id="valortotal" type="text" class="form-control">
			</div>
            
			<div class="form-group col-md-3" style="display: inherit;">
                <button type="submit" class="btn btn-info">Salvar</button>
            </div>
            
			</div>
            <script>
                function somartotal(){
                        
                    const quantidade = parseFloat(document.getElementById('quantidade').value);
                    if(!isNaN(quantidade)  ){
                        
                        const valor = document.getElementById('valor').value;
                        const string_sem_moeda = valor.replace(/R\$\s*/g, '');
                        var stringSemPonto = string_sem_moeda.replace('.', '');
                        var stringComPonto = stringSemPonto.replace(',', '.');
                        const soma = quantidade * stringComPonto;
                        const somaFormatada = soma.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
                        document.getElementById('valortotal').value = somaFormatada

                    }else{
                        document.getElementById('valortotal').value = "";
                    }

                }
            </script>
            <script>
                function formatarInputComoMoeda() {
                    const inputElement = document.getElementById('valor');
                    
                    const valorEntrada = inputElement.value.replace(/\D/g, ''); // Remove tudo que não for dígito (números)
                    const valorNumerico = parseFloat(valorEntrada) / 100; // Dividido por 100 para tratar centavos
                    const valorFormatado = valorNumerico.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
                    
                    document.getElementById('valor').value = valorFormatado;

                }
            </script>

</form>

<h1>Despesas</h1>

<div class="table-responsive">
        <!-- <div class="col-2"> -->
        <!-- <div class="flex-center flex-column"> -->
        <!-- <div class="card card-body"> -->

        <!-- <div class="table-responsive"> -->
        <table id="dtBasicExample" class="table table-striped table-bordered table-sm reponsive" cellspacing="0" width="100%">
            <!-- <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%"> -->
            <thead>
                <tr>
                    <th class="text-center">Data</th>
					<th class="text-center">Despesa</th>
					<th class="text-center">Quantidade</th>
					<th class="text-center">Valor Unitario</th>
					<th class="text-center">Valor</th>
					<th class="text-center">Categoria</th>

                </tr>
            </thead>
            <tbody>
            <?php

                $total2 = 0;

                while ($rows_despesas = mysqli_fetch_assoc($despesas)) {
                    
                    $id2 = $rows_despesas['id'];
                    $data2 = $rows_despesas['data'];
                    $despesa2 = $rows_despesas['despesa'];
                    $quantidade = $rows_despesas['qtde'];
                    $valor_unitario = $rows_despesas['valor_unitario'];
                    $valor2 = $rows_despesas['valor'];
                    $total2 += $valor2;

                ?>

                    <tr>
                        <td class="text-center"><b><?php echo $data2; ?></b></td>
                        <td class="text-center"><b><?php echo $despesa2; ?></b></td>
                        <td class="text-center"><b><?php echo $quantidade; ?></b></td>
                        <td class="text-center" style="color: red;">R$ <?php echo ($valor_unitario); ?></td>
                        <td class="text-center" style="color: red;">R$ <?php echo ($valor2); ?></td>
                        <td class="text-center">
                            <div style="width: 100%; color: red;">Despesa</div>
                        </td>
                        
                    </tr>
                <?php
                }

                ?>

            </tbody>
        </table>
    </div>

    <div class="text-center">
        <h4 style="width: 100%; color: red;"><b>Total: R$ -<?php echo number_format($total2, 2); ?></b></h4>
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

<script>
            // In your Javascript (external .js resource or <script> tag)
            $(document).ready(function() {
                $('.js-example-basic-single').select2({
                    width: 'resolve',
                    dropdownAutoWidth: true,
                    tags: true,
                    placeholder: "Selecionar um Produto",
                    allowClear: true,
                    theme: "classic"
                });
            });
        </script>

</body>
</html>
