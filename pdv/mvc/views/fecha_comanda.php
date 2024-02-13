<?php
	include "./mvc/model/conexao.php";

	$id = $_POST['id'];

	$id_pedido = $_POST['id_pedido'];

	$num = $_POST['num'];

	$total = $_POST['total'];

	$tab_pedidos = "SELECT * FROM pedido WHERE numeropedido = '$id' group by numeropedido ";

	$pedidos = mysqli_query($conn, $tab_pedidos);

	while ($rows_pedidos = mysqli_fetch_assoc($pedidos)) {

		$idmesa = $rows_pedidos['idmesa'];
		$pgto = $rows_pedidos['pgto'];
		$frete_ifood = $rows_pedidos['$frete_ifood'];
		
	}

	

	?>
  <form method="POST" action="?view=persistir_fechamento">

  	<input type="hidden" name="idmesa" id="idmesa" value="<?php echo $idmesa; ?>"> <?php
																						// exit();
																						?>


  	<div class="row">

  		<!-- Earnings (Monthly) Card Example -->
  		<div class="col-xl-6 col-md-6 mb-4">

  			<label for="recipient-name" class="col-xl-12 text-center" style="font-size: 35px; background: #00739b; color: white; padding: 0%; ">Pedido: <?php echo $id; ?></label>
  			<div class="row" style="padding: 1%;">
  				<!-- <div class="form-group col-md-12">
  					<label for="recipient-name" class="col-xl-12 text-center" style="font-size: 25px; background: gray; color: white; ">Total Fatura R$ </label>
  					<input style="font-size: 25px" class="col-xl-12 col-md-6 mb-4 text-center" type="reset" name="pagamento" value="<?php echo number_format($total, 2); ?>" disabled>
  					<input type="hidden" name="total" id="total" value="<?php echo $total; ?>">
				</div> -->
				  <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
				  <input type="hidden" name="total" id="total" value="<?php echo $total; ?>">
				  <input type="hidden" name="frete_ifood" id="frete_ifood" value="<?php echo $frete_ifood; ?>">

  			</div>

  			<!-- <div class="row">

  				<div class="form-group col-md-6">
  					<label for="recipient-name" class="col-xl-12 text-center" style="font-size: 25px; background: #ffad00; color: white; ">Gorjeta R$ </label>
  					<input name="gorjeta" id="gorjeta" style="font-size: 25px" class="col-xl-12 col-md-6 mb-4 text-center" type="text" name="pagamento" value="">
  				</div>

  				<div class="form-group col-md-6">
  					<label for="recipient-name" class="col-xl-12 text-center" style="font-size: 25px; background: #ff6a2e; color: white; ">Acrécimos ou Frete R$ </label>
  					<input name="acrecimo" id="acrecimo" style="font-size: 25px" class="col-xl-12 col-md-6 mb-4 text-center" type="text" name="pagamento" value="0.00">
  				</div>

  				<script>
  					$(document).ready(function() {

  						$("#acrecimo").on('keydown', function(event) {

  							if (event.keyCode === 9 || event.keyCode === 13) {

  								var total = document.getElementById("total").value

  								var acrecimo = document.getElementById("acrecimo").value

  								var tarifa = (total.replace(",", "."));
  								var taxa = (acrecimo.replace(",", "."));
  								var total_acrecimo = (parseFloat(tarifa) + parseFloat(taxa));

  								var arredonda = (Math.round(total_acrecimo * 100)) / 100;

  								var acrecimo = document.getElementById("valor_frete").value = arredonda;


  							};

  						});
  					});
  				</script>

  			</div> -->

  			<div class="row">

  				<div id="valor_pago_style" class="form-group col-md-6" style="display: block;" >
  					<label for="recipient-name" class="col-xl-12 text-center" style="font-size: 25px; background: green; color: white; ">Valor Pago</label>
  					<input autofocus required name="valor_pago_cliente" id="valor_pago" style="font-size: 25px" class="col-xl-12 col-md-6 mb-4 text-center" type="text" value="">
  				</div>

  				<script>
  					$(document).ready(function() {

  						$("#valor_pago").on('keyup', function(event) {
								// console.log(event);
  							// if (event.keyCode === 9 || event.keyCode === 13) {
								
  								var valor_pago = document.getElementById("valor_pago").value;

  								var valor_frete = document.getElementById("valor_frete").value;

  								var total = document.getElementById("total").value;
								//   console.log(valor_pago);

  								if (valor_frete == "") {
  									valor_frete = "0.00";

  									var tarifa = (valor_pago.replace(",", "."));
  									var taxa = (total.replace(",", "."));

  									var total = (parseFloat(tarifa) - parseFloat(taxa));

  									var arredonda = "R$ " + (Math.round(total * 100)) / 100;
  									console.log(arredonda);

									  if(valor_pago == '' || arredonda == 'NaN' ){
											arredonda = null;
											document.getElementById("troco").innerHTML =  null;
										}else{
											document.getElementById("troco").innerHTML =  arredonda;
										}
											document.getElementById('troco_display').style = 'display:block';

  								} else {
  									var valor_frete = document.getElementById("valor_frete").value;

  									var tarifa = (valor_pago.replace(",", "."));
  									var taxa = (valor_frete.replace(",", "."));
  									var total = (parseFloat(tarifa) - parseFloat(taxa));

  									var arredonda = "R$ " + (Math.round(total * 100)) / 100;
  									// console.log(arredonda);
									  if(valor_pago == '' || arredonda == 'NaN' ){
											arredonda = null;
											document.getElementById("troco").innerHTML =  null;
										}else{
											document.getElementById("troco").innerHTML =  arredonda;
										}
											document.getElementById('troco_display').style = 'display:block';
  									};

  							// };

  						});
  					});
  				</script>

  				<div id="valor_pago_style_total" class="form-group col-md-6">
  					<label for="recipient-name" class="col-xl-12 text-center" style="font-size: 25px; background: blue; color: white; ">Valor Total \ Desconto</label>
  					<input autofocus name="valor_pago" id="valor_frete" style="font-size: 25px" class="col-xl-12 col-md-6 mb-4 text-center" type="text" value="<?php echo number_format($total, 2); ?>">
  				</div>

  			</div>

  			<div id="troco_display" class="row" style="display: block;">

  				<div class="col-xl-12 col-md-6 mb-4">
  					<div style="font-size: 25px; background: #fe422d; color: white;">
  						<div class="card-body">
  							<div class="row no-gutters align-items-center">
  								<div class="col mr-2 text-center">
  									<div class=" font-weight-bold text-uppercase mb-1">Troco</div>
  									<div id="troco"> </div>
  								</div>
  								<div class="col-auto">
  									<i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
  								</div>
  							</div>
  						</div>
  					</div>
  				</div>

  			</div>

  		



  		</div>

  		<div class="col-xl-6 col-md-6 mb-4">
  			<div class="row">

  				<div class="col-xl-12 col-md-6 mb-4">
  					<div style="font-size: 25px; background: #fe422d; color: white;">
  						<div class="card-body">
  							<div class="row no-gutters align-items-center">
  								<div class="col mr-2">
  									<div class=" font-weight-bold text-uppercase mb-1">Forma de Pagamento</div>
  									<div>*** <?php echo $pgto; ?> ***</div>
  									<input name="pgto_2" class="form-control" type="hidden" value="<?php echo $pgto; ?>" id="">
  									<div class=" font-weight-bold text-uppercase mb-1">Total</div>
  									<div>R$ <?php echo number_format($total, 2); ?></div>
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
  				<?php while ($rows_produtos = mysqli_fetch_assoc($pedidos)) { ?>
  					<div class="col-xl-6 col-md-6 mb-4">
  						<h7 style="color: red;"><?php echo $rows_produtos['quantidade']; ?>X</h7>
  						<div class="card border-left-danger ">
  							<div class="card-body">


  								<div class="col mr-2">
  									<div class=" font-weight-bold text-uppercase mb-1"><?php echo $rows_produtos['produto']; ?></div>
  									<div class="h5 mb-0 font-weight-bold text-danger-800" style="color: red;">R$ <?php echo $rows_produtos['valor']; ?></div>
  									<input type="text" name="idmesa" id="idmesa" value="<?php echo $rows_produtos['idmesa']; ?>">
  								</div>


  							</div>
  						</div>
  					</div>

  				<?php } ?>



  			</div>
  			
  				<div class="row" style="padding: 0%;">

  				<div class="form-group col-md-12">
  					<label for="recipient-name" class="col-xl-12 text-center" style="font-size: 25px; background: #c42eff; color: white; ">Forma de Pgto </label>
  					<!-- <input name="acrecimo" id="acrecimo" style="font-size: 25px" class="col-xl-12 col-md-6 mb-4 text-center" type="text" name="pagamento" value="0.00"> -->
  				</div>
  				<!-- <div class="form-group col-md-3">
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
  				</div> -->
				  <?php
				  $tab_pgto = "SELECT * FROM `forma_pagamento` ORDER by id ASC" ;
				  $pgtor = mysqli_query($conn, $tab_pgto);
                    while ($rows_pgto = mysqli_fetch_assoc($pgtor)) {
						
						// echo $pgto;
						// echo "<br>"; 
						// echo $rows_pgto['tipo'];

						if( $pgto == 'Dinheiro' || $pgto == "" ){
							?>
							<script>
  									document.getElementById('valor_pago_style').style = 'display:block';
  									document.getElementById('valor_pago_style_total').style = 'display:block';
							</script>
							<?php	
						}else{
							?>
							<script>
  									document.getElementById('valor_pago_style').style = 'display:block';
  									document.getElementById('valor_pago_style_total').style = 'display:block';
									
							</script>
							<?php	
						}

						if( $pgto == $rows_pgto['tipo'] ){
							?>
							
							<div class="form-group col-md-3">
								<div class="form-check">
									<input checked name="pgto" class="form-check-input" type="radio" value="<?php echo ($rows_pgto['value']) ?>" id="<?php echo ($rows_pgto['tipo']) ?>">
									<label class="form-check-label" for="<?php echo ($rows_pgto['tipo']) ?>"><?php echo ($rows_pgto['tipo']) ?></label>
								</div>
							</div>
						<?php
						}else{
							?>

							<div class="form-group col-md-3">
								<div class="form-check">
									<input required name="pgto" class="form-check-input" type="radio" value="<?php echo ($rows_pgto['value']) ?>" id="<?php echo ($rows_pgto['tipo']) ?>">
									<label class="form-check-label" for="<?php echo ($rows_pgto['tipo']) ?>"><?php echo ($rows_pgto['tipo']) ?></label>
								</div>
							</div>
                <?php

						}
                
                    }
                ?>

  			</div>

  			<button class="form-group col-md-12 btn btn-success" type="submit" style="font-size: 30px;">Efetuar Pagamento</button>
  			
  			
  		</div>



  	</div>
  </form>