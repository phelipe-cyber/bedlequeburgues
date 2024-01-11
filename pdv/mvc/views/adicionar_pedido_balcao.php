<?php
include "./mvc/model/conexao.php";

// virgula = %2C
// Qubra de linha = %0A
// Numero Nº = n%C2%BA

$id = $_POST['id'];

$id_pedido = $_POST['id'];

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
  $id_cliente = $rows_cliente['cliente']; 
  $tipo = $rows_cliente['delivery']; 
  //  $rows_cliente['tel1'];
  $tel = preg_replace("/[^0-9,]+/i", "", $rows_cliente['tel1']);
};


$msg ="Ola. $nome%0A
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
    if($rows_pedido['observacao'] =="" ){
      $obs = "";
    }else{
        $obs = "%0A*Obs:* ". $rows_pedido['observacao'];
    }
    $produto[] = "$index Item | ". $rows_pedido['quantidade'] . "x" . " ( " . $rows_pedido['produto'] . " ) " . "R$". number_format( $rows_pedido['valor'] ,2) .$obs."%0A";
    $observacao = $rows_pedido['observacao'];
    $valor[] = number_format( $rows_pedido['valor'] ,2);
    // $msg2[] = "$index Item | $produto'%0A'";
    $index ++;
};

foreach ($produto as $itens) {
  $itensConcatenados .= $itens . '%0A';
}

@$valor_total = array_sum($valor);
$valor_real = number_format($valor_total, 2);

$msg3 ="
----------------------------------------
%0A
*Forma de pagamento:* $pgto
%0A
*Valor total:* $valor_real
";

$msg4 = $msg . $itensConcatenados. $msg3;


?>
<!-- Whatsapp -->
<!-- <a class="btn text-white" style="background-color: #25d366;" href="href=https://api.whatsapp.com/send?phone=55<?php echo $tel . "&text=" . $msg ?>" role="button">
  <i class="fab fa-whatsapp"></i>
</a> -->



<!-- https://api.whatsapp.com/send?phone=5511964081280&text=Ola.Recebemos%20seu%20pedido...%20-Pedido%20ser%C3%A1%20entregue%20no%20endere%C3%A7o:%20Rua%20Biotonico,%20n%C2%BA%20205,%20Vila%20Urup%C3%AAs%20----------------------------------------%201x%20Pizza%20Grande%20-%20Batata%201x%20Pizza%20Grande%20-%20Salame%20*%20Obs:%20Metade%20salame%20/%20metade%20nordestina%20----------------------------------------%20Forma%20de%20pagamento:%20Pix%2011948758597%20Valor%20entrega:%20R$%203,00%20Valor%20total:%20R$%2086,00 -->

<?php


//  $tab_pedidos = "SELECT * FROM pedido WHERE numeropedido = $id";
$tab_pedidos = "SELECT * FROM pedido p  
left JOIN clientes c on c.id = p.cliente
where numeropedido = '$id'";

$pedidos = mysqli_query($conn, $tab_pedidos);

$tab_mesas = "SELECT * FROM pedido p  
left JOIN clientes c on c.id = p.cliente
where numeropedido = '$id'";

$mesas = mysqli_query($conn, $tab_mesas);

$mesas = mysqli_fetch_assoc($mesas);

$cliente = $mesas['nome'];

if( empty($cliente) ){
    $cliente = ($mesas['cliente']);
}

$status = $mesas['status'];

$pgto = $mesas['pgto'];

$data_pedido = $mesas['data'];


if ($status == 1 || $status == 2 || $status == 3 || $status == 4 ) { ?>

<h4 class="mb-10 text-center" style="font-size: 32px; color: green;">Cliente: <?php echo ($cliente); ?></h4>


<h4 class="mb-10 text-center">Pedido: <?php echo $id; ?>
<!-- <a target='_blank' href='https://api.whatsapp.com/send?phone=55<?php echo $tel . "&text=" . $msg4 ?>'> <i class='fab fa-whatsapp' style='font-size:50px;color:green;'></i> </a> -->

<form method="POST" action="?view=whatsapp">
    <input type="hidden" name="id_pedido" value="<?php echo $id; ?>">
    <!-- <a target='_blank' > <i class='fab fa-whatsapp' style='font-size:50px;color:green;'></i> </a> -->
    <button class='fab fa-whatsapp' style='font-size:50px;color:green;'>  </button>
</form>

</h4>

<form method="POST" action="?view=novo_item">

    <h4 class="mb-10 text-center">
        <button type="submit" class="btn btn-outline-success" data-toggle="modal" data-target=""><b>Novo
                Item</b></button>
    </h4>

    <input type="hidden" name="pedido" value="<?php echo $id; ?>">
    <input type="hidden" name="nomecliente" value="<?php echo $cliente; ?>">
    <input type="hidden" name="pgto" value="<?php echo $pgto; ?>">
    <input type="hidden" name="id_cliente" value="<?php echo $id_cliente?>">
    <input type="hidden" name="pgto" value="<?php echo $pgto; ?>">
    <input type="hidden" name="tipo" value="<?php echo $tipo; ?>">

</form>

<div class="row">
    <div class="col-md-4">
        <form method="POST" action="/pdv/mvc/model/imprimir.php" target="_blank">
            <input name="id" type="hidden" value="<?php echo $id; ?>">
            <input name="cliente" type="hidden" value="<?php echo $cliente; ?>">
            <input name="pgto" type="hidden" value="<?php echo $pgto; ?>">
            <input name="data_pedido" type="hidden" value="<?php echo $data_pedido; ?>">

            <button type="submit" class="btn btn-outline-success">Imprimir</button>
        </form>
    </div>

    <div class="col-md-4 offset-md-4">
        <form method="POST" action="/pdv/mvc/model/excluir_pedido.php">
            <input name="id" type="hidden" value="<?php echo $id; ?>">
            <button type="submit" class="btn btn-outline-danger">Excluir Pedido</button>
        </form>
    </div>

</div>
<h4> Relação de Produtos :</h4>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>#</th>

                <th>Pedido</th>
                <th>Observações</th>
                <th>Quantidade</th>
                <th>Valor Unitário</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>


            <?php
				$num = 0;
				$total = 0;
				// mysqli_fetch_assoc senpre retorna um array associaivo
				while ($rows_produtos = mysqli_fetch_assoc($pedidos)) {
					$num += 1;
                    // print_r($rows_produtos);
					$quantidade = $rows_produtos['quantidade'];
					$valor = $rows_produtos['valor'];
					$id_produto = $rows_produtos['idpedido'];

					$subtotal = $valor ;
					$total += $subtotal;

				?>
            <tr>
                <td><?php echo $num ?></td>
                <td><?php echo ($rows_produtos['produto']) ?></td>
                <td><?php echo $rows_produtos['observacao']; ?></td>
                <td><?php echo $rows_produtos['quantidade']; ?></td>
                

                <td>R$ <?php echo number_format($rows_produtos['valor'], 2); ?></td>
                <td>
                    <button type="button" class="btn btn-danger btn-icon-split btn-sm" data-toggle="modal"
                        data-idmesa="<?php echo  $id; ?>" data-idpedido="<?php echo  $id; ?>"
                        data-produto="<?php echo  $rows_produtos['produto']; ?>" 
                        data-idproduto="<?php echo  $rows_produtos['idpedido']; ?>" 
                        data-target="#excluir">Excluir
                        Item</button>
                    <button type="button" class="btn btn-warning btn-icon-split btn-sm" data-toggle="modal"
                        data-target="#editar" data-idpedido="<?php echo  $id; ?>"
                        
                        data-id="<?php echo $id; ?>"
                        data-idproduto="<?php echo  $rows_produtos['idpedido']; ?>" 
                        data-produto="<?php echo  $rows_produtos['produto']; ?>"
                        data-obs="<?php echo  $rows_produtos['observacao']; ?>"

                        data-quantidade="<?php echo  $rows_produtos['quantidade']; ?>">Editar Item</button>
                </td>
                <td></td>
            </tr>
            <?php } ?>


            <tr>
                <th><b>TOTAL:</b></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th style="font-size: 22px; color: red;">R$: <?php echo number_format($total, 2); ?></th>
                <th>
                    <form method="POST" action="?view=fecha_comanda">
                        <input name="id" type="hidden" value="<?php echo $id; ?>">
                        <input name="num" type="hidden" value="<?php echo $num; ?>">
                        <input name="total" type="hidden" value="<?php echo $total; ?>">
                        <button type="submit" class="btn btn-outline-danger">Fechar Mesa</button>
                    </form>

                </th>

            </tr>

        </tbody>
    </table>
</div>


<?php } else {  ?>

<h3 class="display-12 text-center">Adicionar Pedido</h3>
<h4 class="mb-10 text-center">Pedido <?php echo $id; ?></h4>




<h4> Relação de Produtos :</h4>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>ID</th>
                <th>Pedido</th>
                <th>Observações</th>
                <th>Quantidade</th>
                <th>Valor Unitário</th>
                <th></th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td>1</td>
                <td>Nulo</td>
                <td>Vazio</td>
                <td>Mesa Livre</td>
                <td>0</td>

                <td style="font-size: 22px; color: red;">R$ 0.00</td>
                <td></td>
            </tr>


        </tbody>
    </table>
</div>

<?php } ?>


<!-- Modal CATEGORIAS-->
<!-- <div class="modal fade bd-example-modal-lg" id="Modal_categorias" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle" style="color: black;">Categorias</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" style="background: black;">


				<div class="container-fluid ">

					<div class="row">


						<?php

						$tab_produtos = "SELECT * FROM produtos";

						$produtos = mysqli_query($conn, $tab_produtos);

						$comparativo = array();
						while ($cat = mysqli_fetch_assoc($produtos)) {

							$categoria = $cat['categoria'];

							if (in_array("$categoria", $comparativo) != true) {
								array_push($comparativo, $categoria);
						?>

								<form method="POST" action="?view=novo_item">
									<div class="form-group">
										<input type="hidden" name="pesquisa" id="pesquisa" value=" ">
										<input type="hidden" name="mesa" id="mesa" value="<?php echo $id; ?>">
										<input type="hidden" name="cliente" id="cliente" value="<?php echo $cliente; ?>">
										<input type="submit" class="btn btn-outline-warning" name="categoria" value="<?php echo $categoria ?>"></input><label type="hidden" style="width: 10px;"></label>

									</div>
								</form>


						<?php
							}
						};

						?>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

			</div>
		</div>
	</div>
</div> -->




<!-- Modal -->
<div class="modal fade" id="excluir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="color:white; background: #e74a3b;">
                <form method="POST" action="mvc/model/exclui_pedido.php">
                    <h4 class="mb-10 text-center">Excluir item do pedido:</h4>
                    <input name="pedido" type="hidden" class="form-control" id="pedido">
                    <input name="produto" type="button" class="form-control" id="produto"
                        style="color: red; background: white; font-size: 22px;">
                    <input name="mesa" type="hidden" class="form-control" id="mesa">
                    <input name="idproduto" type="hidden" class="form-control" id="idproduto">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger">Excluir</button>

            </div>
            </form>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <form method="POST" action="mvc/model/edita_pedido.php">
                    <div class="row">

                        <div class="form-group col-md-2">
                            <label for="recipient-name" class="col-form-label">Qtd</label>
                            <input name="quantidade" type="text" class="form-control" id="quantidade">
                            <input name="idpedido" type="hidden" class="form-control" id="idpedido">
                            <input name="idproduto" type="hidden" class="form-control" id="idproduto">
                        </div>
                        <div class="form-group col-md-10">
                            <label for="recipient-name" class="col-form-label">Produto</label>
                            <input name="produto" type="text" class="form-control" id="produto">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="recipient-name" class="col-form-label">Obs</label>
                            <textarea name="obs" type="text" class="form-control" id="obs"></textarea>
                        </div>
                    </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger">Editar</button>

            </div>
            </form>
        </div>
    </div>
</div>



<!-- CRIA O SCRIPT JQUERY PARA TRATAR DOS DADOS QUE VEEM COM A CHAMADA DA REQUIZIÇÃO DO MODAL -->

<script type="text/javascript">
$('#excluir').on('show.bs.modal', function(event) {

    var button = $(event.relatedTarget) // Button that triggered the modal

    var recipientpedido = button.data('idpedido')
    var recipientidproduto = button.data('idproduto')
    var recipientproduto = button.data('produto')
    var recipientmesa = button.data('idmesa')

    var modal = $(this)
    modal.find('#pedido').val(recipientpedido)
    modal.find('#produto').val(recipientproduto)
    modal.find('#mesa').val(recipientmesa)
    modal.find('#idproduto').val(recipientidproduto)


})
</script>

<script type="text/javascript">
$('#editar').on('show.bs.modal', function(event) {

    var button = $(event.relatedTarget) // Button that triggered the modal

    var idpedido = button.data('idpedido')
    var idproduto = button.data('idproduto')
    var quantidade = button.data('quantidade')
    var produto = button.data('produto')
    var obs = button.data('obs')



    var modal = $(this)
    modal.find('.modal-header').text('Edita Pedido  ' + idpedido)
    modal.find('#idpedido').val(idpedido)
    modal.find('#idproduto').val(idproduto)
    modal.find('#quantidade').val(quantidade)
    modal.find('#produto').val(produto)
    modal.find('#obs').val(obs)


})
</script>