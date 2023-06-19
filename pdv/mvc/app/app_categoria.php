<?php
session_start();
?><link href="../common/css/bootstrap.min.css" rel="stylesheet"/> <?php

include_once "../model/conexao.php";

$id = $_GET['id'];


// echo $tab_mesas = "SELECT * FROM mesas WHERE id_mesa = $id";
 $tab_mesas = "SELECT * FROM mesas as M
					LEFT JOIN pedido as P on P.idmesa = M.id_mesa
					WHERE id_mesa = $id";

	$mesas = mysqli_query($conn, $tab_mesas);

	$mesas = mysqli_fetch_assoc($mesas);

	$cliente = $mesas['nome'];

	$status = $mesas['status'];

	$numeropedido = $mesas['numeropedido'];


	$i = $_SESSION['loginapp'];

    if($i == 1){

?>
<div class="row" style="background: #2d3339; height: 13%;">

	<h3 class="mb-12 " style="background: #2d3339; width: 5%; " ></h3>
	<a style="background: #2d3339; height: 100%; width: 23%; color: white; " type="button" href="app_mesas.php" class="btn btn-outline-light"><h4>voltar</h4></a>
	<h3 class="mb-12 " style="background: #2d3339; width: 16%; " ></h3>

	<h4 class="mb-12 text-center" style="color: white; width: 20%; ">Mesa <?php echo $id . " ". $cliente; ?></h4>

	<!-- <h4  class="mb-12 text-center" style="color: white; width: 20%; ">Mesa <?php echo $id; ?></h4> -->

<h3 class="mb-12 " style="background: #2d3339; width: 36%; " ></h3>


</div>
<div class="mb-12 " style=" height: 5%;" ></div>


<div class="container"  >
	<div class="row ">
		
	<h2 class="col-lg-12 text-center" style="color: black;">Categorias</h2>


<?php


$tab_pedidos = "SELECT * FROM pedido WHERE idmesa = $id";

$pedidos = mysqli_query($conn, $tab_pedidos);


$tab_produtos = "SELECT * FROM produtos";

$produtos = mysqli_query($conn, $tab_produtos);



$comparativo = array();
while ($cat = mysqli_fetch_assoc($produtos)) {

	$categoria = $cat['categoria'];

	if (in_array("$categoria", $comparativo) != true) {
		array_push($comparativo, $categoria);
		?>


		<div class="col-6" style="">
			<form method="GET" action="app_pedido.php">
			<div class="form-group" >

			<!-- <div class=" <?php echo $cor; ?> text-white shadow"> -->
                <!-- <div class="card-body" style="text-align: center;"> -->
                  <!-- <h4 class="mb-10 text-center">Mesa <?php echo $id_mesa; ?></h4> -->
                    <button type="submit" class="btn  btn-warning" style="text-align: center;" data-toggle="modal">  <?php echo $categoria; ?></button>
                <!-- </div> -->
              <!-- </div> -->

				<input type="hidden" name="id" id="id" value="<?php echo $id?>">
				<input type="hidden" name="categoria" id="categoria" value="<?php echo $categoria?>">
				<input type="hidden" name="mesa" id="mesa" value="<?php echo $id; ?>">
				<input type="hidden" name="cliente" id="cliente" value="<?php echo $cliente; ?>">
				<input type="hidden" name="numeropedido" id="numeropedido" value="<?php echo $numeropedido; ?>">

				
				<!-- <input type="submit" class="btn btn-warning" name="categoria" value="<?php echo $categoria?>" style="width:100%; height:60%;"></input> -->
								
			</div>
			</form>
		</div>


<?php 

	} 
}; 

?>

	</div>


<!-- Extra large modal -->
<div class="modal fade bd-example-modal-xl" id="sair" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
     sair
    </div>
  </div>
</div>


<?php } else { 
	 ?>
	 <script>
	   window.location.href='app_lohin.php'
	 </script>
   <?php
//   header('Location: app_login.php');
}
  ?>

  <script src="../common/js/jquery-3.3.1.slim.min.js" ></script>
  <script src="../common/js/popper.min.js" ></script>
  <script src="../common/js/bootstrap.min.js" ></script>