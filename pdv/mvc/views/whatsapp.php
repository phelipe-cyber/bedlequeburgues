<?php
include "./mvc/model/conexao.php";

// virgula = %2C
// Qubra de linha = %0A
// Numero Nº = n%C2%BA
?>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- Bootstrap core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.2/css/mdb.min.css" rel="stylesheet">
<!-- <link href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js">
</script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.2/js/mdb.min.js"></script>
<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script> -->
<!-- <script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script> -->

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css" />

<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
<?php

// print_r($_POST);

$id_pedido = $_POST['id_pedido'];

$tab_cliente = "SELECT * FROM pedido p left JOIN clientes c on c.id = p.cliente where  p.numeropedido = '$id_pedido' limit 1";
$cliente = mysqli_query($conn, $tab_cliente);

$tab_pedido = "SELECT * FROM pedido p  where  p.numeropedido = '$id_pedido'";
$pedido = mysqli_query($conn, $tab_pedido);

while ($rows_cliente = mysqli_fetch_assoc($cliente)) {
  // print_r($rows_cliente);
  $numeropedido = $rows_cliente['numeropedido'];
  $nome = $rows_cliente['nome'];
  $endereco = $rows_cliente['endereco'];
  $bairro = $rows_cliente['bairro'];
  $pgto = $rows_cliente['pgto'];
  $complemento = $rows_cliente['complemento'];
  //  $rows_cliente['tel1'];
  $tel = preg_replace("/[^0-9,]+/i", "", $rows_cliente['tel1']);
};


$msg = "Ola. $nome%0A
Recebemos seu Pedido: *$numeropedido*...
%0A%0A
-Pedido será *entregue* no endereço:
%0A
$endereco $bairro
%0A
$complemento
%0A
----------------------------------------
";

$produto[] = "";
$index = 1;
while ($rows_pedido = mysqli_fetch_assoc($pedido)) {
  // print_r($rows_pedido);
  if ($rows_pedido['observacao'] == "") {
    $obs = "";
  } else {
    $obs = "%0A*Obs:* " . $rows_pedido['observacao'];
  }
  $produto[] = "$index Item | " . $rows_pedido['quantidade'] . "x" . " ( " . $rows_pedido['produto'] . " ) " . "R$" . number_format($rows_pedido['valor'], 2) . $obs . "%0A";
  $observacao = $rows_pedido['observacao'];
  $valor[] = number_format($rows_pedido['valor'], 2);
  // $msg2[] = "$index Item | $produto'%0A'";
  $index++;
};

foreach ($produto as $itens) {
  $itensConcatenados .= $itens . '%0A';
}

@$valor_total = array_sum($valor);
$valor_real = number_format($valor_total, 2);

$msg3 = "
----------------------------------------
%0A
*Forma de pagamento:* $pgto
%0A
*Valor total:* $valor_real
";

$msg4 = $msg . $itensConcatenados . $msg3;


?>
<!-- Whatsapp -->
<!-- <a class="btn text-white" style="background-color: #25d366;" href="href=https://api.whatsapp.com/send?phone=55<?php echo $tel . "&text=" . $msg ?>" role="button">
  <i class="fab fa-whatsapp"></i>
</a> -->

<input id="number" type="text" value="<?php echo $tel ?>">
<input id="message" text="text" value="<?php echo $msg4 ?>">

<script>
  let number = document.getElementById("number").value;
  let message = document.getElementById("message").value;

  var vData = "number=55" + number + "&message=" + message;
  console.log(vData);

  var xhr = new XMLHttpRequest();
  xhr.withCredentials = true;

  xhr.addEventListener("readystatechange", function() {
    if (this.readyState === 4) {
      console.log(this.responseText);
    }
  });

  xhr.onload = function() {
    if (xhr.status === 200) {
      // Requisição bem-sucedida
      console.log(xhr.responseText);
    } else {
      // Algo deu errado
      console.error('Erro na requisição. Status:', xhr.status);
    }
  };

  xhr.onerror = function() {
    console.error('Erro na requisição.');
  };

  // xhr.open("POST", "http://localhost:8000/send-message");
  xhr.open("POST", "https://whatsapp-api-ph-b4d70f6eb4d2.herokuapp.com/send-message");
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  // xhr.setRequestHeader('Access-Control-Allow-Origin', '*');
  window.location.href = "?view=todosPedidoBalcao";


  xhr.send(vData);

  // })
  // });
</script>


<!-- <a target='_blank' href='https://api.whatsapp.com/send?phone=55<?php echo $tel . "&text=" . $msg4 ?>'> <i class='fab fa-whatsapp' style='font-size:30px;color:green;'></i> </a> -->


<!-- https://api.whatsapp.com/send?phone=5511964081280&text=Ola.Recebemos%20seu%20pedido...%20-Pedido%20ser%C3%A1%20entregue%20no%20endere%C3%A7o:%20Rua%20Biotonico,%20n%C2%BA%20205,%20Vila%20Urup%C3%AAs%20----------------------------------------%201x%20Pizza%20Grande%20-%20Batata%201x%20Pizza%20Grande%20-%20Salame%20*%20Obs:%20Metade%20salame%20/%20metade%20nordestina%20----------------------------------------%20Forma%20de%20pagamento:%20Pix%2011948758597%20Valor%20entrega:%20R$%203,00%20Valor%20total:%20R$%2086,00 -->