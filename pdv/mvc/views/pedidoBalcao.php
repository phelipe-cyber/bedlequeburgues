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

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css" />

<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>

<script>
    // window.location.reload(true);
</script>

<div class="d-flex justify-content-center">
            <div id="spinner" class="spinner-border text-primary" role="status" style="display: none;">
                <span class="sr-only">Loading...</span>
            </div>
    </div>

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

<div class="col-6">
		<button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#myModalcad">Cadastrar Novo Cliente</button>
</div>

<div class="modal fade bd-example-modal-xl" id="myModalcad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title text-center" id="myModalLabel"> Cadastrar Um Novo Cliente </h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<!-- FIM DO CABEÇALHO DO MODAL DE CADASTRO -->

			</div>
			<div class="modal-body">
			<div id="enderecoResultado" style="display: none;" ></div>
				<!-- CRIA O FORMULÁRIO PARA CADASTRAR E ENVIAR PELO METODO POST PARA O SCRIPT "cadastrar_clientes.php" -->
				<form method="POST" action="mvc/model/cadastrar_cliente.php">
					<div id="cep_select" class="row">

						<div class="form-group col-md-2">
							<label required for="recipient-name" class="col-form-label">CEP:</label>
							<input id="cep" name="cep" type="text" class="form-control" maxlength="09" oninput="initMap()" >
						</div>
					</div>

					<div id="erro_cep" style="display: none;">
						<div class="alert alert-danger">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
							<div id="mensagem_erro">Select</div>
						</div>
					</div>

					<div id="spiner" style="display: none;">
						<div class="text-center">
							<div class="spinner-border" role="status">
								<span class="sr-only">Loading...</span>
							</div>
						</div>
					</div>

					<script>
						
						// $(document).ready(function() {
							// $("#cep_select").on('oninput', function(event) {
								function initMap(){
										
									const inputElement = document.getElementById("cep").value;
									
									const rawCEP = inputElement.trim().replace(/\D/g, ''); // Remove caracteres não numéricos

									if( rawCEP.length == 8 ){
									
									document.getElementById("spiner").style = 'display:block;'
									document.getElementById("enderecoResultado").style ='display:none'
									// Formatação para número de CEP no Brasil (exemplo: 12345-678)
									const formattedCEP = rawCEP.replace(/(\d{5})(\d{3})/, '$1-$2');
									document.getElementById("cep").value = formattedCEP;
									const geocoder = new google.maps.Geocoder();

									document.getElementById("endereco").value = "";									
									document.getElementById("cidade").value = "";
									document.getElementById("bairro").value = "";
									document.getElementById("estado").value = "";

									geocoder.geocode({ 'address': rawCEP }, function (results, status) {
										if (status === 'OK') {
											document.getElementById("spiner").style = 'display:none;';
											console.log(results);
											const lat = results[0].geometry.location.lat();
											const lng = results[0].geometry.location.lng();

											let bairro, cidade, estado, endereco;
											for (const component of results[0].address_components) {
                                           if (component.types.includes("sublocality_level_1")) {
                                                 bairro = component.long_name;
                                          }
                                           if (component.types.includes("administrative_area_level_2")) {
                                                cidade = component.long_name;
                                           }
                                           if (component.types.includes("route")) {
                                                end = component.long_name;
                                           }
                                           if (component.types.includes("administrative_area_level_1")) {
                                                estado = component.long_name;
                                           }
										};

											document.getElementById("endereco").value = end;
											document.getElementById("cidade").value = cidade;
											document.getElementById("bairro").value = bairro;
											document.getElementById("estado").value = estado;

											document.getElementById("lat").value = lat;
											document.getElementById("long").value = lng;

										} else {
											document.getElementById("spiner").style = 'display:none;';
											document.getElementById("enderecoResultado").style = 'display:block'
											document.getElementById("enderecoResultado").textContent = `Não foi possível encontrar as coordenadas e o endereço para o CEP: ${formattedCEP} informado.`;
										}
									});

									
								};

							};
						// });
					</script>

					<div class="row">

						<div class="form-group col-md-4">
							<label for="recipient-name" class="col-form-label">Nome do Cliente:</label>
							<input required name="nome" type="text" class="form-control">
						</div>

						<div class="form-group col-md-6">
							<label for="message-text" class="col-form-label">Endereço:</label>
							<input  id="endereco" name="endereco" type="text" class="form-control">
						</div>

						<div class="form-group col-md-2">
							<label for="message-text" class="col-form-label">Número:</label>
							<input required id="number" name="number" type="text" class="form-control">
						</div>
						<div class="form-group col-md-4">
							<label for="recipient-name" class="col-form-label">Bairro:</label>
							<input  id="bairro" name="bairro" type="text" class="form-control">
						</div>
						<div class="form-group col-md-4">
							<label for="recipient-name" class="col-form-label">Cidade:</label>
							<input  id="cidade" name="cidade" type="text" class="form-control">
						</div>
						<div class="form-group col-md-2">
							<label for="recipient-name" class="col-form-label">Estado:</label>
							<input  id="estado" name="estado" type="text" class="form-control">
						</div>
						<div class="form-group col-md-4">
							<label for="recipient-name" class="col-form-label">Complemento:</label>
							<input  name="complemento" type="text" class="form-control">
						</div>

						<div class="form-group col-md-4">
							<label for="recipient-name" class="col-form-label">Ponto de Referência:</label>
							<input name="pontoreferencia" type="text" class="form-control" id="compra">
						</div>
						<div class="form-group col-md-2">
							<label for="recipient-name" class="col-form-label">Telefone #1:</label>
							<input required onkeyup="mascaraFone(event)" name="tel1" type="text" class="form-control" id="telefone">
						</div>
						<div class="form-group col-md-2">
							<label for="recipient-name" class="col-form-label">Telefone #2:</label>
							<input onkeyup="mascaraFone_2(event)" name="tel2" type="text" class="form-control" id="telefone_2">
						</div>
						<div class="form-group col-md-4">
							<label for="recipient-name" class="col-form-label">E-Mail</label>
							<input name="email" type="text" class="form-control">
						</div>
						<div class="form-group col-md-2">
							<label for="recipient-name" class="col-form-label">CPF/CNPJ:</label>
							<input name="cpfcnpj" type="text" class="form-control">
						</div>
						<div class="form-group col-md-2">
							<label for="recipient-name" class="col-form-label">RG:</label>
							<input name="rg" type="text" class="form-control">
						</div>
						<div class="form-group col-md-4">
							<label for="message-text" class="col-form-label">Condomínio:</label>
							<input name="condominio" type="text" class="form-control"></input>
						</div>
						<div class="form-group col-md-2">
							<label for="message-text" class="col-form-label">Bloco/Edifício:</label>
							<input name="blocoedificio" type="text" class="form-control"></input>
						</div>
						<div class="form-group col-md-2">
							<label for="message-text" class="col-form-label">Apartamento:</label>
							<input name="apartamento" type="text" class="form-control"></input>
						</div>
						
						<div class="form-group col-md-4">
							<label for="message-text" class="col-form-label">Latitude:</label>
							<input id="lat"  name="lat" class="form-control"></input>
						</div>

						<div class="form-group col-md-4">
							<label for="message-text" class="col-form-label">Lontitude:</label>
							<input id="long" name="long" class="form-control"></input>
						</div>

						<div class="form-group col-md-12">
							<label for="message-text" class="col-form-label">Local de Entrega:</label>
							<input name="localentrega" type="text" class="form-control"></input>
						</div>
						<div class="form-group col-md-12">
							<label for="message-text" class="col-form-label">Observações:</label>
							<textarea name="observacoes" class="form-control"></textarea>
						</div>

					</div>

					<div class="modal-footer">

						<button type="submit" class="btn btn-success">Cadastrar</button>
					</div>

				</form>

			</div>
		</div>
		<!-- FIM DO CORPO DA MENSAGEM DO MODAL DE CADASTRO -->
	</div>
</div>

<script>
	function mascaraFone(event) {
    var valor = document.getElementById("telefone").attributes[0].ownerElement['value'];
    var retorno = valor.replace(/\D/g, "");
    retorno = retorno.replace(/^0/, "");
    if (retorno.length > 10) {
      retorno = retorno.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
    } else if (retorno.length > 5) {
      if (retorno.length == 6 && event.code == "Backspace") { 
        // necessário pois senão o "-" fica sempre voltando ao dar backspace
        return; 
      } 
      retorno = retorno.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
    } else if (retorno.length > 2) {
      retorno = retorno.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
    } else {
      if (retorno.length != 0) {
        retorno = retorno.replace(/^(\d*)/, "($1");
      }
    }
    document.getElementById("telefone").attributes[0].ownerElement['value'] = retorno;
    
  }
</script>

<script>
	function mascaraFone_2(event) {
    var valor = document.getElementById("telefone_2").attributes[0].ownerElement['value'];
    var retorno = valor.replace(/\D/g, "");
    retorno = retorno.replace(/^0/, "");
    if (retorno.length > 10) {
      retorno = retorno.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
    } else if (retorno.length > 5) {
      if (retorno.length == 6 && event.code == "Backspace") { 
        // necessário pois senão o "-" fica sempre voltando ao dar backspace
        return; 
      } 
      retorno = retorno.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
    } else if (retorno.length > 2) {
      retorno = retorno.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
    } else {
      if (retorno.length != 0) {
        retorno = retorno.replace(/^(\d*)/, "($1");
      }
    }
    document.getElementById("telefone_2").attributes[0].ownerElement['value'] = retorno;
    
  }
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
                            document.getElementById('spinner').style='display:flex;';
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
                                        document.getElementById('spinner').style='display:none;';
                                        $('#frete').html(html);
                                    },
                                    error: function(err) {
                                        $('#frete').html(html);
                                        document.getElementById('spinner').style='display:none;';

                                    },
                                    });
                                }else{
                                    document.getElementById('spinner').style='display:none;';
                                    document.getElementById('frete').style='display:none';
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
                
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="message-text" class="col-form-label">Troco:</label>
                        <input value="" name="troco" id="troco" type="text" class="form-control">
                    </div>

                    <div class="form-group col-md-3" id="frete_ifood_display" style="display: none;">
                        <label for="message-text" class="col-form-label">Frete iFood:</label>
                        <input value="" name="frete_ifood" id="frete_ifood" type="text" class="form-control">
                    </div>
                    
                    <div class="col-md-6">
                        <div class="" style="display: inherit;">
                            <button type="submit" class="btn btn-xs btn-info" >Finalizar Pedido</button>
                        </div>
                    </div>
                
			    </div>
                
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
                                        <input name="detalhes[<?php echo $rows_produtos['id'] ?>][pedido]" type="hidden"
                                            class="form-control" id="detalhes[<?php echo $rows_produtos['id'] ?>][pedido]"
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


                                        <input id="detalhes[<?php echo $rows_produtos['id'] ?>][preco_venda]"
                                            name="detalhes[<?php echo $rows_produtos['id'] ?>][preco_venda]" type="hidden"
                                            class="form-control" value="<?php echo ($rows_produtos['preco_venda']); ?>">

                                            <input id="detalhes[<?php echo $rows_produtos['id'] ?>][preco_venda_ifood]"
                                            name="detalhes[<?php echo $rows_produtos['id'] ?>][preco_venda_ifood]" type="hidden"
                                            class="form-control" value="<?php echo ($rows_produtos['preco_venda_ifood']); ?>">

                                        <input id="detalhes[<?php echo $rows_produtos['id'] ?>][id]"
                                            name="detalhes[<?php echo $rows_produtos['id'] ?>][id]" type="hidden"
                                            class="form-control" value="<?php echo ($rows_produtos['id']); ?>">
                                    </td>
                                    <td style="text-align: center; display: flex;">

                                        <input id="mais<?php echo $rows_produtos['id'] ?>" class="bg-gradient-success" value="+"
                                            type="button">
                                        </input>

                                        <input readonly id="detalhes[<?php echo $rows_produtos['id'] ?>][quantidade]"
                                            class="bg-gradient-default text-center" style="width:50px;"
                                            name="detalhes[<?php echo $rows_produtos['id'] ?>][quantidade]" min="0" maxlength="5"
                                            name="quantity" value="0" type="number">

                                        <input id="menos<?php echo $rows_produtos['id'] ?>" class="bg-gradient-danger" value="-"
                                            type="button">
                                        </input>

                                        <script>
                                            $(document).ready(function() {

                                                $("#mais<?php echo $rows_produtos['id'] ?>").click(function() {
                                                    document.getElementById('spinner').style='display:flex;';
                                                    $('html, body').animate({scrollTop:0}, 'slow'); //slow, medium, fast
                                                    var opcoesPagamento = document.getElementsByName('pgto');
                                                    var algumSelecionado = false;

                                                    // Iterar sobre os elementos de entrada de rádio
                                                    for (var i = 0; i < opcoesPagamento.length; i++) {
                                                        // Verificar se o rádio está marcado
                                                        if (opcoesPagamento[i].checked) {
                                                            // Exibir o valor selecionado
                                                            algumSelecionado = true;
                                                            // alert("Você selecionou: " + opcoesPagamento[i].value);
                                                            tipopgto = opcoesPagamento[i].value
                                                            // Você pode adicionar mais lógica aqui conforme necessário
                                                        }
                                                    }
                                                    if (!algumSelecionado) {
                                                        alert("Selecionar a forma de pagamento antes de selecionar o Item")
                                                        document.getElementById('spinner').style='display:none;';
                                                    }else{
 
                                                    
                                                    if( tipopgto == 'iFood' ){
                                                        preco_venda_ifood = document.getElementById("detalhes[<?php echo $rows_produtos['id'] ?>][preco_venda_ifood]").value
                                                        total = preco_venda_ifood;
                                                        document.getElementById("frete_ifood_display").style = "display:block;"
                                                        document.getElementById("frete_ifood").required = true;
                                                    }else{
                                                        document.getElementById("frete_ifood_display").style = "display:none;"
                                                        document.getElementById("frete_ifood").required = false;
                                                        valor = document.getElementById("detalhes[<?php echo $rows_produtos['id'] ?>][preco_venda]").value
                                                        total = valor;
                                                    }

                                                    Quantidade = document.getElementById(
                                                            "detalhes[<?php echo $rows_produtos['id'] ?>][quantidade]")
                                                        .value

                                                    Quantidade++;

                                                    Q = document.getElementById(
                                                            "detalhes[<?php echo $rows_produtos['id'] ?>][quantidade]")
                                                        .value = Quantidade;

                                                    pedido = document.getElementById(
                                                            "detalhes[<?php echo $rows_produtos['id'] ?>][pedido]")
                                                        .value
                                                        
                                                    // console.log("Click " + total);

                                                    document.getElementById(
                                                        "detalhes[<?php echo $rows_produtos['id'] ?>][valor_unitario]"
                                                    ).value = total;
                                                
                                                obs =  document.getElementById(
                                                        "detalhes[<?php echo $rows_produtos['id'] ?>][observacoes]"
                                                    ).value;
                                                id =  document.getElementById(
                                                        "detalhes[<?php echo $rows_produtos['id'] ?>][id]"
                                                    ).value;
                                                    hashpagina =  document.getElementById(
                                                        "hash"
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

                                                    console.table(vData);

                                                    $.ajax({
                                                        url: './mvc/model/ad_pedido_previa.php',
                                                        dataType: 'html',
                                                        type: 'POST',
                                                        data: vData,
                                                        beforeSend: function() {
                                                            // document.getElementById('spinner').style='diplay:flex;';

                                                        },
                                                        success: function(html) {
                                                        console.log(html);
                                                        document.getElementById("detalhes[<?php echo $rows_produtos['id'] ?>][observacoes]").value = '';
                                                        document.getElementById('spinner').style='display:none;';
                                                        atualizar_previa();
                                                        },

                                                        error: function(err) {
                                                        document.getElementById('spinner').style='display:none;';


                                                        },

                                                    });
                                                };

                                                });
                                            });
                                        </script>
                                        <script>
                                            $(document).ready(function() {
                                                $("#menos<?php echo $rows_produtos['id'] ?>").click(function() {
                                                    document.getElementById('spinner').style='display:flex;';
                                                    $('html, body').animate({scrollTop:0}, 'slow'); //slow, medium, fast
                                                    Quantidade = document.getElementById(
                                                            "detalhes[<?php echo $rows_produtos['id'] ?>][quantidade]")
                                                        .value
                                                    Quantidade--;

                                                    if( Quantidade == "-1"){

                                                    }else{


                                                    Q = document.getElementById(
                                                            "detalhes[<?php echo $rows_produtos['id'] ?>][quantidade]")
                                                        .value = Quantidade;

                                                    valor = document.getElementById(
                                                            "detalhes[<?php echo $rows_produtos['id'] ?>][preco_venda]")
                                                        .value
                                                        total = valor;

                                                    pedido = document.getElementById(
                                                            "detalhes[<?php echo $rows_produtos['id'] ?>][pedido]")
                                                        .value
                                                        
                                                    // console.log("Click " + total);

                                                    document.getElementById(
                                                        "detalhes[<?php echo $rows_produtos['id'] ?>][valor_unitario]"
                                                    ).value = total;
                                                
                                                obs =  document.getElementById(
                                                        "detalhes[<?php echo $rows_produtos['id'] ?>][observacoes]"
                                                    ).value;
                                                id =  document.getElementById(
                                                        "detalhes[<?php echo $rows_produtos['id'] ?>][id]"
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
                                                        hashpagina: hashpagina,
                                                        botao: 'menos'
                                                    }; 


                                                    console.table(vData);

                                                    $.ajax({
                                                        url: './mvc/model/ad_pedido_previa.php',
                                                        dataType: 'html',
                                                        type: 'POST',
                                                        data: vData,
                                                        beforeSend: function() {
                                                        },
                                                        success: function(html) {
                                                        console.log(html);
                                                        document.getElementById('spinner').style='display:none;';
                                                        atualizar_previa();

                                                        },

                                                        error: function(err) {
                                                            document.getElementById('spinner').style='display:none;';



                                                        },

                                                    });
    
                                                };
                                                });
                                            });
                                        </script>

                                    </td>

                                        
                                                <input id="detalhes[<?php echo $rows_produtos['id'] ?>][valor_unitario]"
                                                class="bg-gradient-default text-center" style="width:50px;" name="" min="0"
                                                maxlength="5" name="quantity" value="0" type="hidden" disabled >
                                        
                                    <td>
                                        <label for=""> <?php echo $rows_produtos['estoque_atual']?></label>
                                    </td>

                                    <td>

                                        <textarea name="detalhes[<?php echo $rows_produtos['id'] ?>][observacoes]" class="form-control"
                                            id="detalhes[<?php echo $rows_produtos['id'] ?>][observacoes]"></textarea>

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
    function atualizar_previa() {
            $("#div").load("./mvc/views/pedidoprevia.php");
    };
</script> 
<!-- <div class="row">

<div class="col-8" ></div>
<div class="col-4" id="mensagem" style="visibility: visible"><?php if (isset($_SESSION['msg'])) {echo $_SESSION['msg'];  unset($_SESSION['msg']); }?></div>

</div> -->
<h1 class="col-xl-6 col-md-6 mb-4" id="div" > </h1>
