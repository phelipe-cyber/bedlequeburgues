<?php
	session_start();

	?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>App - Cozinha Pedido</title>
</head>
<body>
	
		<link href="../common/css/bootstrap.min.css" rel="stylesheet"/>
		

		
		<?php
	include_once "../model/conexao.php";

	$id = $_GET['id'];

	$total = $_GET['total'];

	$hora = $_GET['hora'];

	$id_pedido = $_GET['id_pedido'];
	
	$cliente = $_GET['cliente'];

	
	$user = $_SESSION['user'];

	
    $tab_pedido = "SELECT * FROM pedido WHERE numeropedido = $id_pedido and `status` <> 4 ";

	$pedidos = mysqli_query($conn, $tab_pedido);
	$pedidos_2 = mysqli_query($conn, $tab_pedido);
	// $tab_mesas = "SELECT * FROM mesas WHERE id_mesa = $id";

	// $mesas = mysqli_query($conn, $tab_mesas);

	// $rows_mesas = mysqli_fetch_assoc($mesas);

	$i = $_SESSION['loginapp'];
?>


<div class="row" style="background: #2d3339; height: 1%;">

	<h3 class="mb-12 " style="background: #2d3339; width: 1%; " ></h3>
	<a style="background: #2d3339; height: 100%; width: 23%; color: white;" type="button" href="app_cozinha.php" class="btn btn-outline-light"><h4>Voltar</h4></a>
	<h3 class="mb-12 " style="background: #2d3339; width: 16%; " ></h3>

	<?php
                if( $id_pedido <> 0 ){
                  ?>
				  	<h4 class="mb-12 text-center" style="color: white; width: 20%; "><?php echo  $rows_mesas['nome']; ?></h4>
				   <?php
                }else{
                  ?>
					  <h4 class="mb-12 text-center" style="color: white; width: 20%; ">Mesa <?php echo $id . " ". $rows_mesas['nome']; ?></h4>
				   <?php

                }
              ?>




	<h3 class="mb-12 " style="background: #2d3339; width: 36%; " ></h3>


</div>
<div class="mb-12 " style=" height: 5%;" ></div>

<?php if (mysqli_num_rows($pedidos) != 0 ){?>
    <?php
        while($rows_pedidos_2 = mysqli_fetch_assoc($pedidos_2)){
            $delivery = $rows_pedidos_2['delivery'];
        }
    ?>
<h2 class="col-lg-12 text-center" style="color: black;"><?php echo 'Pedido: ' . $id_pedido ; ?></h2>
<h2 class="col-lg-12 text-center" style="color: black;"><?php echo 'Tipo: '. $delivery ; ?></h2>
<h2 class="col-lg-12 text-center" style="color: #da7016;"><?php echo 'Horário: '.$hora; ?></h2>

<div class="mb-12 " style=" height: 5%;" ></div>


	<div class="col-12 " style="">

		<!-- <form method="GET" action="app_categoria.php"> -->
		<form method="GET" action="app_pedido.php">
			<input name="id" type="hidden" id="id" value="<?php echo $id; ?>">
			<input name="id_pedido" type="hidden" id="id_pedido" value="<?php echo $id_pedido; ?>">
			<input name="cliente" type="hidden" id="cliente" value="<?php echo $cliente; ?>">

			<!-- <input class="btn btn-success" type="submit" style="width:100%; height:10%; color: white; font-size: 20px;" value="Adicionar Pedido"> -->
		</form>

	</div>

	<div class="col-12 " style="">
   
		<form method="GET" action="app_pedidofeito.php">
			<input name="id" type="hidden" id="id" value="<?php echo $id; ?>">
            <input name="id_pedido" type="hidden" id="id_pedido" value="<?php echo $id_pedido; ?>">
			<input class="btn btn-warning" type="submit" style="width:100%; height:10%; color: white; font-size: 20px;" value="Pedido Pronto">
		</form>

	</div>


    <table class="table">
      <thead>
        <tr>

		  <!-- <th class="col-lg-1 "><b>#</b> </th> -->
          <th class="col-auto"><b>Pedido</b> </th>
          <th class="col-auto"><b>Qtd</b> </th>
          <!-- <th class="col-lg-1 "><b>Preço Unitário</b> </th> -->
          <th class="col-auto"><b>Obs</b> </th>
          <!-- <th class="col-lg-1 "><b>Pedido</b> </th> -->
        </tr>
      </thead>


<?php
	$row = 1;
    while($rows_pedidos = mysqli_fetch_assoc($pedidos)){?>
      <tbody>
        <tr>

		  <!-- <td><b><?php echo $row;?></b></td> -->
          <td style="color: #ac4549; "><b><?php echo $rows_pedidos['produto'];?></b></td>
          <td><b><?php echo $rows_pedidos['quantidade']." x";?></b></td>
          <!-- <td>R$ <?php echo $rows_pedidos['valor'];?></td> -->
          <td><?php echo $rows_pedidos['observacao'];?></td>
          <!-- <td><?php echo $rows_pedidos['numeropedido'];?></td> -->
		  <input name="numeropedido" type="hidden" id="numeropedido" value="<?php echo $rows_pedidos['numeropedido']; ?>">
          
        </tr>


		<?php $row ++; } ?>


	            <!-- <tr>
	              <th><b>TOTAL:</b></th>
	              <th></th>
	              <th style="font-size: 18px; color: red;">R$ </th>
	              <th style="font-size: 18px; color: red;"><?php echo number_format($total, 2);?></th>
	            </tr> -->

		</tbody>
    </table>

<div class="mb-12 " style=" height: 10%;" ></div>


<?php }else if (mysqli_num_rows($pedidos) != 0 && $rows_mesas['status'] == 3){?>

<h2 class="col-lg-12 text-center" style="color: black;">Horário do Último Pedido</h2>
<h2 class="col-lg-12 text-center" style="color: #da7016;"><?php echo $hora; ?></h2>
<div class="mb-12 " style=" height: 5%;" ></div>


	<div class="col-12 " style="">

		<!-- <form method="GET" action="app_categoria.php"> -->
		<form method="GET" action="app_pedido.php">
			<input name="id" type="hidden" id="id" value="<?php echo $id; ?>">
			<input name="id_pedido" type="hidden" id="id_pedido" value="<?php echo $id_pedido; ?>">
			<input name="cliente" type="hidden" id="cliente" value="<?php echo $cliente; ?>">
			<input class="btn btn-success" type="submit" style="width:100%; height:10%; color: white; font-size: 20px;" value="Adicionar Pedido">
		</form>

	</div>


    <table class="table">
      <thead>
        <tr>
          
          <th class="col-lg-1 "><b>#</b> </th>
          <th class="col-lg-1 "><b>Pedido</b> </th>
          <th class="col-lg-1 "><b>Qtd</b> </th>
          <th class="col-lg-1 "><b>Preço Unitário</b> </th>
          <th class="col-lg-1 "><b>Obs</b> </th>
          <th class="col-lg-1 "><b>Pedido</b> </th>
        </tr>
      </thead>


<?php
	$row = 1;
    while($rows_pedidos = mysqli_fetch_assoc($pedidos)){?>
      <tbody>
        <tr>
          
          <td><b><?php echo $row;?></b></td>
          <td style="color: #ac4549;"><b><?php echo $rows_pedidos['produto'];?></b></td>
          <td><?php echo $rows_pedidos['quantidade'];?></td>
          <td>R$ <?php echo $rows_pedidos['valor'];?></td>
          <td><?php echo $rows_pedidos['observacao'];?></td>
          <td><?php echo $rows_pedidos['numeropedido'];?></td>
		  <input name="numeropedido" type="hidden" id="numeropedido" value="<?php echo $rows_pedidos['numeropedido']; ?>">
          
        </tr>
      


   <?php $row ++; } ?>

	            <tr>
	              <th><b>TOTAL:</b></th>
	              <th></th>
	              <th style="font-size: 18px; color: red;">R$ </th>
	              <th style="font-size: 18px; color: red;"><?php echo number_format($total, 2);?></th>
	            </tr>

		</tbody>
    </table>

<div class="mb-12 " style=" height: 10%;" ></div>


<?php }else{?>

<div class="mb-12 " style=" height: 5%;" ></div>
<!-- <div class="mb-12 text-center" style=" height: 15%; color: #45863f;" ><h1><b>Mesa Vazia</b></h1></div> -->


	<div class="col-12 " style="">

		<!-- <form method="GET" action="app_categoria.php"> -->
		<form method="GET" action="app_pedido.php">
			<input name="id" type="hidden" id="id" value="<?php echo $id; ?>">
			<input name="id_pedido" type="hidden" id="id_pedido" value="<?php echo $id_pedido; ?>">
			<input name="cliente" type="hidden" id="cliente" value="<?php echo $cliente; ?>">
			<!-- <input class="btn btn-success" type="submit" style="width:100%; height:10%; color: white; font-size: 20px;" value="Adicionar Pedido"> -->
		</form>

	</div>

<?php }?>


  <script src="../common/js/jquery-3.3.1.slim.min.js" ></script>
  <script src="../common/js/popper.min.js" ></script>
  <script src="../common/js/bootstrap.min.js" ></script>
  </body>
</html>

