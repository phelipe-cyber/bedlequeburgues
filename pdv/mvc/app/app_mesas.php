<?php
session_start();
// print_r($_SESSION);
// exit();
?>
<!-- INICIO DA CHAMADA DA CLASSE JQUERY-->
  <!-- Bootstrap core JavaScript-->

  <script src="/pdv/mvc/common/vendor/jquery/jquery.min.js"></script>
  
  <script src="/pdv/mvc/common/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  
  <!-- Core plugin JavaScript-->
  <script src="/pdv/mvc/common/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="/pdv/mvc/common/js/sb-admin-2.min.js"></script>
  <!-- FIM DA CHAMADA DA CLASSE JQUERY-->

  <script src="/pdv/mvc/common/vendor/chart.js/Chart.min.js"></script>

  <script src="/pdv/mvc/common/vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="/pdv/mvc/common/js/bootstrap-datepicker.min.js"></script>
  <script src="/pdv/mvc/common/js/bootstrap-datepicker.pt-BR.min.js"></script>
<!-- FIM DA CHAMADA DOS SCRIPTS JS!-->

<script>
$(function() {
var atualiza = function() {
  $("#div").load("app_carrega_mesas.php");
};

setInterval(function() {
  atualiza();
}, 1000); // A CADA 1 SEGUNDO RODA A FUNÇÃO atualiza

});
</script> 


<div class="row">

<div class="col-8" ></div>
<div class="col-4" id="mensagem" style="visibility: visible"><?php if (isset($_SESSION['msg'])) {echo $_SESSION['msg'];  unset($_SESSION['msg']); }?></div>
</div>

<h1 class="col-lg-12 text-center" id="div" style="color: #e84c21;"> Carregando Mesas...</h1>
