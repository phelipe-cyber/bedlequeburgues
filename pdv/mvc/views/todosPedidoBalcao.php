<?php
// session_start();
// print_r($_SESSION);
// exit();
?>

<script>
$(function() {
var atualiza = function() {
$("#div").load("./mvc/views/pedidos.php");
};

setInterval(function() {
atualiza();
}, 2500); // A CADA 1 SEGUNDO RODA A FUNÇÃO atualiza

});
</script> 


<div class="row">

<div class="col-8" ></div>
<div class="col-4" id="mensagem" style="visibility: visible"><?php if (isset($_SESSION['msg'])) {echo $_SESSION['msg'];  unset($_SESSION['msg']); }?></div>
</div>

<h1 class="col-lg-12 text-center" id="div" style="color: #e84c21;"> Carregando Pedidos...</h1>
