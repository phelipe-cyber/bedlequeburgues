<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
ini_set('display_errors', 0); //oculta  erros
include "./mvc/model/conexao.php";


$tab_frete = "SELECT * FROM `frete_valor` ORDER BY `frete_valor`.`id` ASC";

$frete = mysqli_query($conn, $tab_frete);

?>
<h1 class="display-12">Fretes</h1>

<div class="row">


	<div class="col-4" id="mensagem" style="visibility: visible">
		<?php


		if (isset($_SESSION['msg'])) {
			echo $_SESSION['msg'];
			unset($_SESSION['msg']);
		}
		?>
	</div>

	<div class="col-6">
	</div>

	<!-- <div class="col-2">
		<button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#myModalcad">Cadastrar Novo</button>

	</div> -->

</div>


<script>
	function mascaraFone(event) {
    var valor = document.getElementById("telefone").attributes[0].ownerElement['value'];
    var retorno = valor.replace(/\D/g, "");
    retorno = retorno.replace(/^0/, "");
    if (retorno.length > 10) {
      retorno = retorno.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
    } else if (retorno.length > 5) {
      if (retorno.length == 6 && event.code == "Backspace") { 
        // necessário pois senão o "-" fica sempre voltando ao dar backspace
        return; 
      } 
      retorno = retorno.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
    } else if (retorno.length > 2) {
      retorno = retorno.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
    } else {
      if (retorno.length != 0) {
        retorno = retorno.replace(/^(\d*)/, "($1");
      }
    }
    document.getElementById("telefone").attributes[0].ownerElement['value'] = retorno;
    
  }
</script>
<script>
	function mascaraFone_2(event) {
    var valor = document.getElementById("telefone_2").attributes[0].ownerElement['value'];
    var retorno = valor.replace(/\D/g, "");
    retorno = retorno.replace(/^0/, "");
    if (retorno.length > 10) {
      retorno = retorno.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
    } else if (retorno.length > 5) {
      if (retorno.length == 6 && event.code == "Backspace") { 
        // necessário pois senão o "-" fica sempre voltando ao dar backspace
        return; 
      } 
      retorno = retorno.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
    } else if (retorno.length > 2) {
      retorno = retorno.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
    } else {
      if (retorno.length != 0) {
        retorno = retorno.replace(/^(\d*)/, "($1");
      }
    }
    document.getElementById("telefone_2").attributes[0].ownerElement['value'] = retorno;
    
  }
</script>

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
                <!-- <th>ID</th> -->
                <th>KM</th>
                <th>Valor KM</th>
				<th>Ação</th>


            </tr>
        </thead>
        <tbody>
            <?php
                    $index = 0;
                    while ($rows_frete = mysqli_fetch_assoc($frete)) {
                    ?>

            <tr>

                <!-- <td><?php echo $rows_frete['id'] ?></td> -->
                <td><?php echo $rows_frete['km'] ." km"?></td>
                <td><?php echo $rows_frete['valor'] ?></td>
				<td>

				
						<!-- <button type="button" class="btn btn-primary btn-icon-split btn-sm" data-toggle="modal" data-target="#myModal<?php echo $rows_frete['id']; ?>">Visualizar</button> -->

						<button type="button" class="btn btn-warning btn-icon-split btn-sm" data-toggle="modal" data-target="#exampleModal" data-id="<?php echo $rows_frete['id']; ?>" data-nome="<?php echo $rows_frete['km']; ?>" data-endereco="<?php echo $rows_frete['valor']; ?>" >
							Editar
						</button>

						<!-- <button type="button" class="btn btn-danger btn-icon-split btn-sm" data-toggle="modal" data-target="#excluirModal<?php echo $rows_frete['id']; ?>">Excluir</button> -->

				</td>
            </tr>

            <!-- CONSTRUÇÃO DO MODAL DE VIZUALIZAÇÃO -->
            <div class="modal fade bd-example-modal-xl" id="myModal<?php echo $rows_frete['id']; ?>" tabindex="-1"
                role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <!-- <h4 class="modal-title text-center" id="myModalLabel"><b><?php echo $rows_frete['km']; ?></b></h4> -->
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <!-- FIM DO CABEÇALHO DO MODAL DE VIZUALIZAÇÃO -->


                        </div>
                        <div class="modal-body">
                            <p><b>KM: </b><?php echo $rows_frete['km']; ?></p>
                            <p><b>Valor: </b><?php echo $rows_frete['valor']; ?></p>
                            
                           

                        </div>
                    </div>
                    <!-- FIM DO CORPO DA MENSAGEM DO MODAL DE VIZUALIZAÇÃO -->
                </div>
            </div>

            <!-- CONSTRUÇÃO DO MODAL DE EXCLUZÃO -->

            <div class="modal fade bd-example-modal-xl" id="excluirModal<?php echo $rows_frete['id']; ?>"
                tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-xl" role="document">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title text-center" id="myModalLabel"><b>Excluir o Item
                                    <?php echo" ( ". $rows_frete['km']." km )"; ?> da sua lista?</b></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <!-- FIM DO CABEÇALHO DO MODAL DE EXCLUZÃO -->

                        </div>

                        <div class="modal-body">

                            <p><b>Km: </b><?php echo $rows_frete['km']; ?></p>
                            <p><b>Valor: </b><?php echo $rows_frete['valor']; ?></p>
                           
                          

                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                                <a href="mvc/model/exclui_frete.php?id=<?php echo $rows_frete['id']; ?>"><button
                                        type="button" class="btn btn-xs btn-danger">Excluir</button></a>
                            </div>

                        </div>

                    </div>
                </div>
                <!-- FIM DO CORPO DA MENSAGEM DO MODAL DE EXCLUZÃO -->


            </div>

            <?php $index++;
                    } ?>


        </tbody>
    </table>
</div>

<div class="modal fade bd-example-modal-xl" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Frete</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<!-- CRIA O FORMULÁRIO PARA CADASTRAR E ENVIAR PELO METODO POST PARA O SCRIPT "cadastrar_produtos.php" -->
				<form method="POST" action="mvc/model/editar_frete.php">
					<div class="row">
						<div class="form-group col-md-4">
							<label for="recipient-name" class="col-form-label">KM:</label>
							<input name="km" nome="nome" id="nome" type="text" class="form-control">
						</div>

						<div class="form-group col-md-6">
							<label for="message-text" class="col-form-label">Valor</label>
							<input name="valor" id="endereco" type="text" class="form-control">
						</div>
						
					</div>
					<!--cria um campo invisivel "hidden" para pegar o id "id_Produto"-->
					<input name="id" type="hidden" id="id">

					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-warning">Editar</button>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>


<script>
$(document).ready(function() {
    $('#dtBasicExample').DataTable({
        "paging": true, // false to disable pagination (or any other option)
        "ordering": false, // false to disable sorting (or any other option)
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


<script type="text/javascript">
	$('#exampleModal').on('show.bs.modal', function(event) {

		var button = $(event.relatedTarget) // Button that triggered the modal

		var id = button.data('id')
		var nome = button.data('nome')
		var endereco = button.data('endereco')


		var modal = $(this)
		// modal.find('.modal-title').text(nome)
		modal.find('#id').val(id)
		modal.find('#nome').val(nome)
		modal.find('#endereco').val(endereco)
		
	})
</script>
