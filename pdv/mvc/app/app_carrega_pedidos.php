<?php
session_start();

?>
<link href="../common/css/bootstrap.min.css" rel="stylesheet" />

<?php
include_once "../model/conexao.php";

// $tab_mesas = "SELECT * FROM mesas";
// $tab_mesas = "SELECT * FROM pedido WHERE `status` <> 4";
$tab_mesas = "SELECT * FROM pedido p  
    left JOIN clientes c on c.id = p.cliente
    where p.`status` <> 4 and p.status_cozinha <> 2
    group by p.numeropedido
    ORDER BY `p`.`numeropedido` ASC";

$mesas = mysqli_query($conn, $tab_mesas);

$i = $_SESSION['loginapp'];

// print_r($_SESSION);

if ($i == 1) {
?>

  <div class="row" style="background: #2d3339; height: 6%;">    
    
    <!-- <h6 class="" style="color: black; width: 20%; ">Mesas</h6> -->

	<a style="background: #2d3339; height: 100%; width: 23%; color: white;" type="button" href="app_mesas.php" class="btn btn-outline-light"><h4>Voltar</h4></a>

  </div>


  <div class="mb-12" style=" height: 5%;"></div>


  <div class="container">
    <div class="row">


      <?php


      while ($rows_mesas = mysqli_fetch_assoc($mesas)) {
        // print_r($rows_mesas);
        $nome = utf8_encode($rows_mesas['nome']);
        $id_mesa = $rows_mesas['id_mesa'];

        $id_pedido = $rows_mesas['id_pedido'];
        $cliente = $rows_mesas['nome'];



        if ($rows_mesas['status'] == 1) {
          $cor = 'card bg-success';
          $status = 'Livre';
          $link_mesas = "mesasLivres";
        }
        if ($rows_mesas['status'] == 2) {
          $cor = 'card bg-danger';
          $status = 'Em Espera';
          $link_mesas = "mesasLivres";
        }
        if ($rows_mesas['status'] == 3) {
          $cor = 'card bg-warning';
          $status = 'Atendida';
          $link_mesas = "mesasLivres";
        }

            // print_r($row);
          //recebe e soma todos os pedidos
          $quantidade = $rows_mesas['quantidade'];
          $valor = $rows_mesas['valor'];

          if ($valor != NULL && $quantidade != NULL) {

            $subtotal = $valor;
            $total += $subtotal;

            //armazena o ultimo id de pedido feito pela mesma mesa
            $idpedido = $rows_mesas['idpedido'];

            //recebe a hora do ultimo pedido
            $hora = $rows_mesas['hora_pedido'];
            
            $id_pedido = $rows_mesas['numeropedido'];

            $cliente = $rows_mesas['cliente'];
            
            
        } else {
            
            $total = 0;
        }
        
      ?>


        <div class="col-6" style="text-align: center;">

          <form method="GET" action="app_visualizapedido.php">

            <div class=" <?php echo $cor; ?> text-white shadow">
              <div class="card-body" style="text-align: center;">

              <?php
                if( $id_pedido <> 0 ){
                    ?><h4 class="mb-10 text-center"> <?php echo 'Pedido: '. $id_pedido ?></h4> <?php
                  ?><h4 class="mb-10 text-center"> <?php echo $cliente ?></h4> <?php
                }else{
                  ?><h4 class="mb-10 text-center">Mesa <?php echo $id_mesa ?></h4> <?php

                }
              ?>

                <button type="submit" class="btn  btn-outline-light" style="text-align: center;" data-toggle="modal"> Abrir <?php echo $rows_mesas['id_mesa']; ?></button>
              </div>
            </div>


            <input name="id_pedido" type="hidden" id="id_pedido" value="<?php echo $id_pedido; ?>">
            <input name="cliente" type="hidden" id="cliente" value="<?php echo $nome; ?>">
            <input name="id" type="hidden" id="id" value="<?php echo $rows_mesas['id_mesa']; ?>">
            <input name="total" type="hidden" id="total" value="<?php echo $total; ?>">
            <input name="hora" type="hidden" id="hora" value="<?php echo $hora; ?>">
            <input name="senha" type="hidden" id="senha" value="<?php echo $pass; ?>">
            <input name="login" type="hidden" id="login" value="<?php echo $login; ?>">
            <!-- <input class="<?php echo $cor; ?>" type="submit" style="width:100%; height:15%; color: white;" value="<?php echo $id_mesa; ?>"> -->
          </form>

        </div>

      <?php } ?>

    </div>


  <?php } else {
    
    ?>
    <script>
      window.location.href='app_login.php'
    </script>
<?php
  // header('Location: /pdv/mvc/app/app_login.php');
}
  ?>

<script type="text/javascript">
    var var1 = document.getElementById("mensagem");
    setTimeout(function() {
        var1.style.visibility = "hidden";
    }, 5000)
</script>