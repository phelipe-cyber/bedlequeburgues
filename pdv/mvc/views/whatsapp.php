<?php
include "./mvc/model/conexao.php";

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

<input id="number" type="hidden" value="<?php echo $tel ?>">
<input id="message" type="hidden" value="<?php echo $msg4 ?>">

<script>
  let number = document.getElementById("number").value;
  let message = document.getElementById("message").value;

  var vData = "number=55" + number + "&message=" + message;
    //   console.log(vData);

    var xhr = new XMLHttpRequest();
    xhr.withCredentials = true;

    xhr.addEventListener("readystatechange", function() {
    if(this.readyState === 4) {
        console.log(this.responseText);
    }
    });

    xhr.open("POST", "http://localhost:8000/send-message");
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send(vData);
    // xhr.open("POST", "https://whatsapp-api-ph-b4d70f6eb4d2.herokuapp.com/send-message");

</script>
<?php
  $conn->close();
  echo "<META HTTP-EQUIV=REFRESH CONTENT = '3;URL=/pdv/?view=todosPedidoBalcao'>";
?>