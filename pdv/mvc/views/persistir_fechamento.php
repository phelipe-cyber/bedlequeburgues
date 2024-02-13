<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');

$data = date('d/m/Y');

$hora_pedido = date('H:i');

ini_set( 'display_errors', 0 );//oculta  erros

include "./mvc/model/conexao.php";

$id = $_POST['id'];//id da mesa

$data = date('d/m/Y');

$total = $_POST['valor_pago'];
$total = str_replace(",",".", $total);
$total = number_format($total, 2);

$valor_pago_cliente = $_POST['valor_pago_cliente'];
$valor_pago_cliente = str_replace(",",".", $valor_pago_cliente);
$valor_pago_cliente = number_format($valor_pago_cliente, 2);

$gorjeta = $_POST['gorjeta'];

$gorjeta = str_replace(",",".", $gorjeta);

$acrecimo = $_POST['acrecimo'];

$acrecimo = str_replace(",",".", $acrecimo);

$acrecimo = number_format($acrecimo, 2);

$pgto = $_POST['pgto'];

$frete_ifood = $_POST['frete_ifood'];

 ?>

 <?php
 if($pgto == ""){
	 
	 $pgto = ($_POST['pgto_2']);
	 
	}else{
		
	 $pgto = ($_POST['pgto']);
		
	}
	
	if( $pgto == "" ){
		echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=/pdv/?view=todosPedidoBalcao'>";
		$_SESSION['msg'] = "<div class='alert alert-danger text-center' role='alert'> Forma de pagamento não selecionado!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
		exit();
	 }else{
	
	// Cartão Debito

	if($pgto == "Cartão Debito" ){
		
		$total = $_POST['valor_pago'];
		$porcentagem = 2.39;
		$resultado = $total - ($total * $porcentagem / 100);
		// $R = $total - $resultado;
        $Valor_format = number_format($resultado, 2);

	}elseif( $pgto == 'Cartão Credito' ){
			
		// print_r( "Valor da venda R$ ". $_POST['total']);
		// echo "<br>";
		$total = $_POST['valor_pago'];
		$pctm = 4.99;
		$valor_descontado = $total - ($total * $pctm / 100);
		$Valor_format = number_format($valor_descontado, 2);
			
	}elseif( $pgto == 'Voucher' ){

		$total = $_POST['valor_pago'];
		$pctm = 3.19;
		$valor_descontado = $total - ($total * $pctm / 100);
		$Valor_format = number_format($valor_descontado, 2);

	}elseif($pgto == 'iFood'){

		$total = $_POST['valor_pago'];
		
		// Taxa de comissão do Repasse em 1 Semana
		$pctmRepasse = 1.59;
		$valor_descontado_Repasse = ($total * $pctmRepasse / 100);
		$Valor_Repasse = number_format($valor_descontado_Repasse, 2);
		
		// Comissão iFood
		$pctmComissao = 23.00;
		$valor_descontado_Comissao = ($total * $pctmComissao / 100);
		$Valor_Comisssao = number_format($valor_descontado_Comissao, 2);
		
		// Comissão pela transação do Pagamento
		$pctmTransacao = 3.20;
		$valor_descontado_Transacao = ($total * $pctmTransacao / 100);
		$Valor_Transacao = number_format($valor_descontado_Transacao, 2);
		
		// Taxas e comissões
		$taxascomissao = $Valor_Repasse + $Valor_Comisssao + $Valor_Transacao;
		
		$totalpedido = $total + $frete_ifood;

		$valorliquido = $totalpedido - $frete_ifood -  $taxascomissao;
		
		$Valor_format = $valorliquido;
		
	}
		
	}
	
	// echo $Valor_format;

	// print_r($_POST);

	// exit();

$idmesa = $_POST['idmesa'];


if ($total > 0) {

	$tab_pedidos = "SELECT * FROM pedido WHERE numeropedido = $id";

	$pedidos = mysqli_query($conn, $tab_pedidos);

	while($rows_produtos = mysqli_fetch_assoc($pedidos)) {

		$produto = $rows_produtos['produto'];
		$valor = $rows_produtos['valor'];
		$quantidade = $rows_produtos['quantidade'];
		$cliente = $rows_produtos['cliente'];
		$numeropedido = $rows_produtos['numeropedido'];
		$delivery = $rows_produtos['delivery'];
		$idmesa = $rows_produtos['idmesa'];
		$hora_pedido = $rows_produtos['hora_pedido'];
		$observacao = $rows_produtos['observacao'];
		$usuario = $rows_produtos['usuario'];
		$gorjeta = $rows_produtos['gorjeta'];
		$status = $rows_produtos['status'];
		$frete_ifood = $rows_produtos['frete_ifood'];

		$tab_produto = "SELECT * FROM produtos WHERE nome LIKE '$produto' AND preco_venda LIKE '$valor'";
		$estoque = mysqli_query($conn, $tab_produto) or die(mysqli_error($conn));

		while ($row_produto = mysqli_fetch_assoc($estoque)) {
			if($row_produto['estoque_minimo'] != 0){

				$id2 = $row_produto['id'];
				$atualiza_estoque = $row_produto['estoque_atual'] - $quantidade;
				
				$insert_table = "UPDATE produtos SET estoque_atual = '$atualiza_estoque' WHERE id LIKE '$id2'";
				$grava_atualização = mysqli_query($conn, $insert_table) or die(mysqli_error($conn));
			}
		}

	}

	if( $pgto == 'Fiado' ){

		$tab_mesas = "UPDATE mesas SET status = '1', nome = '', id_pedido = 0 WHERE id_pedido = '$id' ";
		$mesas = mysqli_query($conn, $tab_mesas);

		$alterar_table = "UPDATE `pedido` SET `status` = '4', `pgto` = '$pgto' WHERE `numeropedido` = '$id' ";
		$produto_excluido = mysqli_query($conn, $alterar_table);
		
		echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=/pdv/?view=todosPedidoBalcao'>";
		$_SESSION['msg'] = "<div class='alert alert-success text-center' role='alert'> Comanda da Mesa Fiado encerrada com sucesso!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
	
		
	}else{

		$tab_mesas = "UPDATE mesas SET status = '1', nome = '', id_pedido = 0 WHERE id_pedido = '$id' ";
		$mesas = mysqli_query($conn, $tab_mesas);
	
		$insert_table = "INSERT INTO vendas ( id_pedido, valor, valor_maquina, cliente, data, rendimento, pgto) VALUES ( '$id', '$valor_pago_cliente', '$Valor_format', '$cliente', '$data', 'Mesa', '$pgto')";
		$produtos_editados = mysqli_query($conn, $insert_table);

		$alterar_table = "UPDATE `pedido` SET `status` = '4', `pgto` = '$pgto' WHERE `numeropedido` = '$id' ";
		$produto_excluido = mysqli_query($conn, $alterar_table);

		$alterar_table_fiado = "UPDATE `pedido_fiado` SET `status` = '4' WHERE `numeropedido` = '$id' ";
		$alt_fiado = mysqli_query($conn, $alterar_table_fiado);
		
		 
		 echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=/pdv/?view=todosPedidoBalcao'>";
		 $_SESSION['msg'] = "<div class='alert alert-success text-center' role='alert'> Comanda da Mesa encerrada com sucesso!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
	 
	}
	
}else if ($total < 0) {

	$tab_pedidos = "SELECT * FROM pedido WHERE idmesa = '$id' ";

	$pedidos = mysqli_query($conn, $tab_pedidos);

	while($rows_produtos = mysqli_fetch_assoc($pedidos)) {
		$produto = $rows_produtos['produto'];
		$valor = $rows_produtos['valor'];
		$quantidade = $rows_produtos['quantidade'];
		$cliente = $rows_produtos['cliente'];
		$numeropedido = $rows_produtos['numeropedido'];
		$delivery = $rows_produtos['delivery'];
		$idmesa = $rows_produtos['idmesa'];
		$hora_pedido = $rows_produtos['hora_pedido'];
		$observacao = $rows_produtos['observacao'];
		$usuario = $rows_produtos['usuario'];
		$gorjeta = $rows_produtos['gorjeta'];
		$status = $rows_produtos['status'];
		$pgto = $rows_produtos['pgto'];


		$tab_produto = "SELECT * FROM produtos WHERE nome LIKE '$produto' AND preco_venda LIKE '$valor'";
		$estoque = mysqli_query($conn, $tab_produto) or die(mysqli_error($conn));

		while ($row_produto = mysqli_fetch_assoc($estoque)) {
			if($row_produto['estoque_minimo'] != 0){

				$id2 = $row_produto['id'];
				$atualiza_estoque = $row_produto['estoque_atual'] - $quantidade;
				
				$insert_table = "UPDATE produtos SET estoque_atual = '$atualiza_estoque' WHERE id LIKE '$id2'";
				$grava_atualização = mysqli_query($conn, $insert_table) or die(mysqli_error($conn));
			}
		}
	}

	if( $pgto == 'Fiado' ){

		$tab_mesas = "UPDATE mesas SET status = '1', nome = '', id_pedido = 0 WHERE id_pedido = '$id' ";
		$mesas = mysqli_query($conn, $tab_mesas);

		$alterar_table = "UPDATE `pedido` SET `status` = '4', `pgto` = '$pgto' WHERE `numeropedido` = '$id' ";
		$produto_excluido = mysqli_query($conn, $alterar_table);
		
		echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=/pdv/?view=todosPedidoBalcao'>";
		$_SESSION['msg'] = "<div class='alert alert-success text-center' role='alert'> Comanda da Mesa Fiado encerrada com sucesso!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
	
		
	}else{

		$tab_mesas = "UPDATE mesas SET status = '1', nome = '', id_pedido = 0 WHERE id_pedido = '$id' ";
		$mesas = mysqli_query($conn, $tab_mesas);
	
		$insert_table = "INSERT INTO vendas ( id_pedido, valor, valor_maquina, cliente, data, rendimento, pgto) VALUES ( '$id', '$valor_pago_cliente', '$Valor_format', '$cliente', '$data', 'Mesa', '$pgto')";
		$produtos_editados = mysqli_query($conn, $insert_table);

		$alterar_table = "UPDATE `pedido` SET `status` = '4', `pgto` = '$pgto' WHERE `numeropedido` = '$id' ";
		$produto_excluido = mysqli_query($conn, $alterar_table);
		
		$alterar_table_fiado = "UPDATE `pedido_fiado` SET `status` = '4' WHERE `numeropedido` = '$id' ";
		$alt_fiado = mysqli_query($conn, $alterar_table_fiado);
		 
		 echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=/pdv/?view=todosPedidoBalcao'>";
		 $_SESSION['msg'] = "<div class='alert alert-success text-center' role='alert'> Comanda da Mesa encerrada com sucesso!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
	 
	}


	?>
	<h4 class="text-center" ><a class="form-group col-md-6 btn btn-success" href="?view=Dashboard1" type="button" style="font-size: 25px;">VOLTAR</a></h4> 

<?php } else { ?>


<div class="alert alert-danger text-center" role="alert">
   <h4><b>Valor digitado Está Abaixo do Valor Original ! O valor <?php $valor; ?> foi abatido do total</b></h4>
</div>

  <?php
//   include "./mvc/model/conexao.php";


//   $tab_pedidos = "SELECT * FROM pedido WHERE idmesa = $id";

//   $pedidos = mysqli_query($conn, $tab_pedidos);


?> 


<!-- <div class="row">

  
  <div class="col-xl-6 col-md-6 mb-4">

  	<form method="POST" action="?view=persistir_fechamento">
	<label for="recipient-name" class="col-xl-12 text-center" style="font-size: 35px; background: #00739b; color: white; padding: 5%; ">Pagamento Mesa <?php echo $id;?></label>
  		<div class="row" style="padding: 1%;">
	  		<div class="form-group col-md-12">
	  			<label for="recipient-name" class="col-xl-12 text-center" style="font-size: 25px; background: gray; color: white; ">Total Fatura R$ </label>
	  			<input style="font-size: 25px" class="col-xl-12 col-md-6 mb-4 text-center" type="reset" name="pagamento" value="<?php echo number_format($total, 2);?>" disabled>
	  			<input type="hidden" name="total" id="total" value="<?php echo $total; ?>">
	  			<input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
	  		</div>
  		</div>

  		<div class="row" style="padding: 0%;">

  				<div class="form-group col-md-12">
  					<label for="recipient-name" class="col-xl-12 text-center" style="font-size: 25px; background: #ff6a2e; color: white; ">Acrécimos ou Frete R$ </label>
  					<input name="acrecimo" id="acrecimo" style="font-size: 25px" class="col-xl-12 col-md-6 mb-4 text-center" type="text" name="pagamento" value="">
  				</div>


  			</div>
  			<div class="row" style="padding: 0%;">

  				<div class="form-group col-md-12">
  					<label for="recipient-name" class="col-xl-12 text-center" style="font-size: 25px; background: #c42eff; color: white; ">Forma de Pgto </label>
  					</div>
  				<div class="form-group col-md-3">
  					<div class="form-check">
  						<input name="pgto" class="form-check-input" type="checkbox" value="Dinheiro" id="Dinheiro">
  						<label class="form-check-label" for="Dinheiro">Dinheiro</label>
  					</div>
  				</div>
  				<div class="form-group col-md-3">
  					<div class="form-check">
  						<input name="pgto" class="form-check-input" type="checkbox" value="Cartão Debito" id="Cartao_Debito">
  						<label class="form-check-label" for="Cartao_Debito">Cartão Debito</label>
  					</div>
  				</div>
  				<div class="form-group col-md-3">
  					<div class="form-check">
  						<input name="pgto" class="form-check-input" type="checkbox" value="Cartão Credito" id="Cartao_credito">
  						<label class="form-check-label" for="Cartao_credito">Cartão Credito</label>
  					</div>
  				</div>
  				<div class="form-group col-md-3">
  					<div class="form-check">
  						<input name="pgto" class="form-check-input" type="checkbox" value="Pix" id="pix">
  						<label class="form-check-label" for="pix">Pix</label>
  					</div>
  				</div>
  			</div>

  		<button class="form-group col-md-12 btn btn-success" type="submit" style="font-size: 30px;">Efetuar Pagamento</button>

  	</form>

  </div>

  <div class="col-xl-6 col-md-6 mb-4">
  	<div class="row">
  	
		<div class="col-xl-12 col-md-6 mb-4" >
		  <div style="font-size: 25px; background: #fe422d; color: white;">
		    <div class="card-body">
		      <div class="row no-gutters align-items-center">
		        <div class="col mr-2">
		          <div class=" font-weight-bold text-uppercase mb-1">Total</div>
		          <div >R$ <?php echo number_format($total, 2);?></div>
		        </div>
		        <div class="col-auto">
		          <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
		        </div>
		      </div>
		    </div>
		  </div>
		</div>

	</div>

  	<div class="row">
		<?php while($rows_produtos = mysqli_fetch_assoc($pedidos)) { ?>
	  <div class="col-xl-6 col-md-6 mb-4"><h7 style="color: red;"><?php echo $rows_produtos['quantidade'];?>X</h7>
	    <div class="card border-left-danger ">
	      <div class="card-body">
	      	
	        
	          <div class="col mr-2">
	            <div class=" font-weight-bold text-uppercase mb-1" ><?php echo $rows_produtos['produto'];?></div>
	            <div class="h5 mb-0 font-weight-bold text-danger-800" style="color: red;">R$ <?php echo $rows_produtos['valor'];?></div>
	          </div>

	        
	     </div>
	    </div>
	  </div>

		<?php } ?>



	</div>
  </div>

  
</div> -->

<?php } ?>

