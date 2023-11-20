<?php
include "./mvc/model/conexao.php";


$tab_clientes = "SELECT pf.id,  pf.numeropedido, c.nome as nome, pf.cliente as nome_cliente, SUM(valor) as valor  FROM `pedido_fiado` pf LEFT join clientes c on c.id = pf.cliente where `status` = 1 GROUP by pf.numeropedido";

$clientes = mysqli_query($conn, $tab_clientes);

?>

<h4> Relação de Fiados :</h4>


<div class="table-responsive">
    <!-- <div class="col-2"> -->
    <!-- <div class="flex-center flex-column"> -->
    <!-- <div class="card card-body"> -->

    <!-- <div class="table-responsive"> -->
    <table id="dtBasicExample" class="table table-striped table-bordered table-sm reponsive" cellspacing="0"
        width="100%">
        <!-- <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%"> -->
        <thead>
            <tr>
                <th>ID</th>
                <th>Pedido</th>
                <th>Nome</th>
                <th>Valor</th>
                <th>Ação</th>

            </tr>
        </thead>
        <tbody>
            <?php
                    $index = 0;
                    while ($rows_clientes = mysqli_fetch_assoc($clientes)) {
                       $nome = $rows_clientes['nome'];
                       $nome_cliente = $rows_clientes['nome_cliente']; 
                    ?>

            <tr>

                <td><?php echo $rows_clientes['id'] ?></td>
                <td><?php echo $rows_clientes['numeropedido'] ?></td>
                <td>
                    <?php
                        if( !$nome ){
                            $nome = $rows_clientes['nome_cliente']; 
                        }else{
                            $nome = $rows_clientes['nome'];
                        }
                        echo $nome;
                     ?>
                 </td>
                <td style="font-size: 20px; color: red;">R$ <?php echo number_format($rows_clientes['valor'], 2); ?></td>

                <td>
                    <form method="POST" action="?view=fecha_comanda">
                        <input name="id" type="hidden" value="<?php echo $rows_clientes['numeropedido'] ?>">
                        <!-- <input name="num" type="hidden" value="<?php echo $rows_clientes['numeropedido'] ?>"> -->
                        <input name="total" type="hidden" value="<?php echo $rows_clientes['valor'] ?>">
                        <button type="submit" class="btn btn-danger btn-icon-split btn-sm">Fechar</button>
                    </form>

                    <form method="POST" action="?view=adicionar_pedido_balcao">
                        <input name="id" type="hidden" id="id" value="<?php echo $rows_clientes['numeropedido']; ?>">
						<button type="submit" class="btn btn-primary btn-icon-split btn-sm">Visualizar</button>
                    </form>
                
                </td>

            </tr>

           
            <?php $index++;
        } ?>


        </tbody>
    </table>
</div>


<script>
$(document).ready(function() {
    $('#dtBasicExample').DataTable({
        "paging": true, // false to disable pagination (or any other option)
        "ordering": true, // false to disable sorting (or any other option)
        "searching": true,
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json"
        }
    });
    $('.dataTables_length').addClass('bs-select');
});
</script>

<script type="text/javascript">
	var var1 = document.getElementById("mensagem");
	setTimeout(function() {
		var1.style.visibility = "hidden";
	}, 5000)
</script>
