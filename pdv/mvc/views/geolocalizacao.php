<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
ini_set('display_errors', 0); //oculta  erros
include "./mvc/model/conexao.php";


if(isset($_POST['cep'])){
	$cep = $_POST['cep'];
	$tab_frete = "SELECT * FROM `cep_coordinates` where postcode = '$cep' ORDER BY `cep_coordinates`.`id` DESC ";
	$frete = mysqli_query($conn, $tab_frete);
}else{

}


?>
<h1 class="display-12">Geolocalização</h1>


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
	<div class="col-2">
		<button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#myModalcad">Cadastrar Novo</button>
	</div>

	
</div>
	<form method="POST" action="">
		<div class="row">
			<div class="col-2">
				<label for="recipient-name" class="col-form-label">CEP:</label>
				<input required placeholder="00000-000" id="txtCEP" type="text" name="cep" class="form-control" maxlength="9" value="" oninput="formatCEP()">
			</div>
			<div class="col-6" style="padding: 40px;" >
				<button type="submit" class="btn btn-xs btn-success">Buscar CEP</button>
			</div>
		</div>
		<script>
			 function formatCEP() {	
				const inputElement = document.getElementById('txtCEP');
				let cep = inputElement.value.replace(/\D/g, '');

				if (cep.length > 5) {
					cep = cep.substring(0, 5) + '-' + cep.substring(5, 8);
				}
					inputElement.value = cep;
				}

		</script>
	</form>

	<!-- CONSTRUÇÃO DO MODAL DE CADASTRO -->
<div class="modal fade bd-example-modal-xl" id="myModalcad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title text-center" id="myModalLabel"> Cadastrar Novo CEP </h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<!-- FIM DO CABEÇALHO DO MODAL DE CADASTRO -->

			</div>
			<div class="modal-body">

				<!-- CRIA O FORMULÁRIO PARA CADASTRAR E ENVIAR PELO METODO POST PARA O SCRIPT "cadastrar_clientes.php" -->
				<form method="POST" action="mvc/model/cadastrar_cep.php">

					<div id="erro_cep" style="display: none;">
						<div class="alert alert-danger">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
							<div id="mensagem_erro">Select</div>
						</div>
					</div>

					<div id="spiner" style="display: none;">
						<div class="text-center">
							<div class="spinner-border" role="status">
								<span class="sr-only">Loading...</span>
							</div>
						</div>
					</div>

					<div class="row text-center" >

						<div class="form-group col-md-2">
							<label for="recipient-name" class="col-form-label">CEP:</label>
							<input required placeholder="00000-000" id="txtCEP_2" type="text" name="cep_2" class="form-control" maxlength="9" value="" oninput="formatCEP_2()">
						</div>
						<script>
							function formatCEP_2() {	
								const inputElement = document.getElementById('txtCEP_2');
								let cep = inputElement.value.replace(/\D/g, '');

								if (cep.length > 5) {
									cep = cep.substring(0, 5) + '-' + cep.substring(5, 8);
								}
									inputElement.value = cep;
								}

						</script>
						<div class="form-group col-md-2">
							<label for="message-text" class="col-form-label">Longitude:</label>
							<input required placeholder="-46.8902651" id="longitude" name="longitude" type="text" class="form-control">
						</div>
						<div class="form-group col-md-2">
							<label for="recipient-name" class="col-form-label">Latitude:</label>
							<input required placeholder="-23.4993162" id="latitude" name="latitude" type="text" class="form-control">
						</div>
						
					</div>

					<div class="modal-footer">

						<button type="submit" class="btn btn-success">Cadastrar</button>
					</div>

				</form>

			</div>
		</div>
		<!-- FIM DO CORPO DA MENSAGEM DO MODAL DE CADASTRO -->
	</div>
</div>



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
                <th>CEP</th>
                <th>Longitude</th>
				<th>Latitude</th>
				<th>Ação</th>

            </tr>
        </thead>
        <tbody>
            <?php
                    $index = 0;
                    while ($rows_frete = mysqli_fetch_assoc($frete)) {
                    ?>

            <tr>

                <td><?php echo $rows_frete['postcode'] ?></td>
                <td><?php echo $rows_frete['lon']?></td>
                <td><?php echo $rows_frete['lat'] ?></td>
                
				<td>

						<button type="button" class="btn btn-warning btn-icon-split btn-sm" data-toggle="modal" data-target="#exampleModal" data-id="<?php echo $rows_frete['id']; ?>" data-nome="<?php echo $rows_frete['postcode']; ?>" data-endereco="<?php echo $rows_frete['lon']; ?>" data-bairro="<?php echo $rows_frete['lat']; ?>" >
							Editar
						</button>

					
				</td>
            </tr>

            
            <?php $index++;
                    } ?>


        </tbody>
    </table>
</div>

<div class="modal fade bd-example-modal-xl" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Geolocalização</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<!-- CRIA O FORMULÁRIO PARA CADASTRAR E ENVIAR PELO METODO POST PARA O SCRIPT "cadastrar_produtos.php" -->
				<form method="POST" action="mvc/model/editar_geo.php">
					<div class="row">
						<div class="form-group col-md-4">
							<label for="recipient-name" class="col-form-label">CEP:</label>
							<input name="cep" nome="nome" id="nome" type="text" class="form-control">
						</div>

						<div class="form-group col-md-6">
							<label for="message-text" class="col-form-label">Longitude</label>
							<input name="longitude" id="endereco" type="text" class="form-control">
						</div>
						<div class="form-group col-md-6">
							<label for="message-text" class="col-form-label">Latitude</label>
							<input name="latitude" id="bairro" type="text" class="form-control">
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
		var bairro = button.data('bairro')


		var modal = $(this)
		// modal.find('.modal-title').text(nome)
		modal.find('#id').val(id)
		modal.find('#nome').val(nome)
		modal.find('#endereco').val(endereco)
		modal.find('#bairro').val(bairro)
		
	})
</script>
