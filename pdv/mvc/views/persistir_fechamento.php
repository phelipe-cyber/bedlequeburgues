<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
// $data_hora = date('Y-m-d H:i');
$hora_pedido = date('H:i');

ini_set( 'display_errors', 0 );//oculta  erros

include "./mvc/model/conexao.php";

$id = $_POST['id'];//id da mesa

$data = date('d/m/Y');

$total = $_POST['total'];

$total = str_replace(",",".", $total);

$total = number_format($total, 2);

$gorjeta = $_POST['gorjeta'];

$gorjeta = str_replace(",",".", $gorjeta);

$acrecimo = $_POST['acrecimo'];

$acrecimo = str_replace(",",".", $acrecimo);

$acrecimo = number_format($acrecimo, 2);

$valor_pago = $_POST['valor_pago'];

$valor_pago = str_replace(",",".", $valor_pago);

 $total = $total + $gorjeta + $acrecimo;

$venda = $total;

// $total = $total - $valor_pago;

 $pgto = $_POST['pgto'];

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

		// $valor_base = 190;
		// $valor = 185.46;
		// $resultado = ($valor / $valor_base) * 100;
        // $Valor_format = number_format($resultado, 2);
		// var_dump($Valor_format);
		
		$total = $_POST['total'];
		$porcentagem = 97.61;
		$resultado = $total - ($total * $porcentagem / 100);
		$R = $total - $resultado;
        $Valor_format = number_format($R, 2);

	}else{

		
		if( $pgto == 'Cartão Credito' ){
			
			// print_r( "Valor da venda R$ ". $_POST['total']);
			// echo "<br>";
			$total = $_POST['total'];
			$pctm = 4.99;
			$valor_descontado = $total - ($total * $pctm / 100);
			$Valor_format = number_format($valor_descontado, 2);
			
		}
		
		// $Valor_format = $Valor_format = $venda;
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

	$tab_mesas = "UPDATE mesas SET status = '1', nome = '', id_pedido = 0 WHERE id_mesa = $idmesa";
	
	$mesas = mysqli_query($conn, $tab_mesas);

	$insert_table = "INSERT INTO vendas ( id_pedido, valor, valor_maquina, cliente, data, rendimento, pgto) VALUES ( '$id', '$venda', '$Valor_format', '$cliente', '$data', 'Mesa', '$pgto')";

	$produtos_editados = mysqli_query($conn, $insert_table);
	// $exclude_table = "DELETE FROM pedido WHERE numeropedido = '$id'";	
	// $exclude_table = "DELETE FROM pedido WHERE numeropedido = '$id'";	
	 $alterar_table = "UPDATE `pedido` SET `status` = '4', `pgto` = '$pgto' WHERE `numeropedido` = '$id' ";
	 $produto_excluido = mysqli_query($conn, $alterar_table);

	echo "<META HTTP-EQUIV=REFRESH CONTENT = '0;URL=/pdv/?view=todosPedidoBalcao'>";
	$_SESSION['msg'] = "<div class='alert alert-success text-center' role='alert'> Comanda da Mesa encerrada com sucesso!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";

}else if ($total < 0) {

	$tab_pedidos = "SELECT * FROM pedido WHERE idmesa = '$id' ";

	$pedidos = mysqli_query($conn, $tab_pedidos);

	while($rows_produtos = mysqli_fetch_assoc($pedidos)) {
		$produto = $rows_produtos['produto'];
		$valor = $rows_produtos['valor'];
		$quantidade = $rows_produtos['quantidade'];
		$cliente = $rows_produtos['cliente'];

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

	// $exclude_table = "DELETE FROM pedido WHERE idmesa = '$id'";	
	// $produto_excluido = mysqli_query($conn, $exclude_table);

	$alterar_table = "UPDATE `pedido` SET `status` = '4', `pgto` = '$pgto' WHERE `pedido`.`numeropedido` = '$id' ";
	$produto_excluido = mysqli_query($conn, $alterar_table);

	$tab_mesas = "UPDATE mesas SET nome = '$cliente', status = '1'  WHERE id_mesa = $idmesa";
	$mesas = mysqli_query($conn, $tab_mesas);

	$insert_table = "INSERT INTO vendas ( id_pedido, valor, valor_maquina, cliente, data, rendimento, pgto) VALUES ( '$id', '$venda', '$Valor_format', '$cliente', '$data', 'Mesa', '$pgto')";
	
	$produtos_editados = mysqli_query($conn, $insert_table);

	// $total = abs($total);?>
	<!-- <h2 class="mb-10 text-center" style="color: black; padding: 20px;">Fechamento de Comanda Efetuado!</h2> -->
 	<!-- <div class="form-group col-md-6"> -->
  					<!-- <label for="recipient-name" class="col-xl-12 text-center" style="font-size: 25px; background: green; color: white; ">Valor Pago Cliente</label> -->
  					<!-- <input autofocus name="valor_pago" id="valor_pago" style="font-size: 25px" class="col-xl-12 col-md-6 mb-4 text-center" type="text" name="pagamento" value=""> -->
  				<!-- </div><h4 class="mb-10 text-center" style="color: red; padding: 20px; font-size: 30px;">TROCO: R$ <?php echo number_format($total, 2); ?></h4> -->
 	<h4 class="text-center" ><a class="form-group col-md-6 btn btn-success" href="?view=Dashboard1" type="button" style="font-size: 25px;">VOLTAR</a></h4> 

<?php } else { ?>


<div class="alert alert-danger text-center" role="alert">
   <h4><b>Valor digitado Está Abaixo do Valor Original ! O valor <?php $valor_pago; ?> foi abatido do total</b></h4>
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

<?php } } ?>

