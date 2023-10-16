<?php
session_start();

?>
<link href="../common/css/bootstrap.min.css" rel="stylesheet" />

<?php
include_once "../model/conexao.php";

$tab_mesas = "SELECT * FROM mesas";

$mesas = mysqli_query($conn, $tab_mesas);

$i = $_SESSION['loginapp'];

// print_r($_SESSION);

if ($i == 1) {
?>

  <div class="row text-center" style="background: #2d3339; height: 6%; ">

    <a style=" font-size: 20px; color: #888888;" class="dropdown-item" href="app_cozinha.php">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Pedidos COZINHA
    </a>

  </div>


  <div class="mb-12 " style=" height: 5%;"></div>


  <div class="container">
    <div class="row">


      <?php


      while ($rows_mesas = mysqli_fetch_assoc($mesas)) {

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


        //inicia a seleção da tabela pedido
        $tab_pedido = "SELECT * FROM pedido WHERE numeropedido = $id_pedido and `status` <> 4";
        $pedido = mysqli_query($conn, $tab_pedido);

        $total = 0;

        while ($row = mysqli_fetch_assoc($pedido)) {

          //recebe e soma todos os pedidos
          $quantidade = $row['quantidade'];
          $valor = $row['valor'];

          if ($valor != NULL && $quantidade != NULL) {

            $subtotal = $valor;
            $total += $subtotal;

            //armazena o ultimo id de pedido feito pela mesma mesa
            $idpedido = $row['idpedido'];

            //recebe a hora do ultimo pedido
            $hora = $row['hora_pedido'];
            
            $id_pedido = $row['numeropedido'];

            $cliente = $row['cliente'];
            
            
        } else {
            
            $total = 0;
        }
        
      ?>

        <?php

        }

        ?>

        <div class="col-6" style="text-align: center;">

          <form method="GET" action="app_visualizamesa.php">

            <div class=" <?php echo $cor; ?> text-white shadow">
              <div class="card-body" style="text-align: center;">

              <?php
                if( $id_pedido <> 0 ){
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