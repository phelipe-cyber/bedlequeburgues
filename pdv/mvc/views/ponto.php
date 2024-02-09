<?php
session_start();
include "./mvc/model/conexao.php";
include_once "./mvc/model/hashPagina.php";

date_default_timezone_set('America/Sao_Paulo');
$data_hora = date('Y-m-d H:i:s');

$usuario = ("SELECT * FROM `usuarios` ORDER BY id DESC ");
$mysli_usuario = mysqli_query($conn, $usuario);
// print_r($mysli_usuario);

// while ($row_usuario = mysqli_fetch_assoc($mysli_usuario)) {
//  print_r($row_usuario);
// }
// die();
?>
<div class="row">
    <div class="col-8"></div>
    <div class="col-4 text-center" id="mensagem" style="visibility: visible"> <?php
                                                                                if (isset($_SESSION['msg'])) {
                                                                                    echo $_SESSION['msg'];
                                                                                    unset($_SESSION['msg']);
                                                                                }
                                                                                ?></div>
</div>

<script type="text/javascript">
    var var1 = document.getElementById("mensagem");
    setTimeout(function() {
        var1.style.visibility = "hidden";
    }, 5000)
</script>


<form id="Form" action="mvc/model/salvar_ponto.php" method="POST">

    <div class="row">
        <h4 class="col-lg-6">
            <label for="">* Nome:</label>
            <br>
            <!-- <input autofocus type="text" class="form-control" width="100%" height="100%" name="cliente" id="cliente" value="" required> -->
            <select style="width: 70%" class="js-example-basic-single" name="id_usuario" id="id_usuario" value="" required>
                <?php while ($row_usuario = mysqli_fetch_assoc($mysli_usuario)) { ?>
                    <option value=""></option>
                    <option value="<?php echo $row_usuario['id'] ?>">
                        <?php
                        echo  $row_usuario['login']
                        ?>
                    </option>

                <?php

                }
                ?>
            </select>
        </h4>


    </div>

    <div class="row" style="padding: 10px;">
        <label for=""> <b>********* TIPO: *********</label></b>&nbsp;&nbsp;
        <div class="custom-control custom-switch">
            <input checked value="Entrada" type="checkbox" class="custom-control-input" id="customSwitch">
            <label id="custom-control-label" class="custom-control-label" for="customSwitch">Entrada</label>
            <input type="hidden" name="tipo" id="tipo" value="Entrada">
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#customSwitch").click(function() {

                var isChecked = document.getElementById("customSwitch").checked;
                // console.log(isChecked);

                if (isChecked == false) {

                    var labe1 = document.getElementById('custom-control-label');
                    labe1.innerText = "Saída";

                    document.getElementById('tipo').value = 'Saída'


                } else {

                    var labe1 = document.getElementById('custom-control-label');
                    labe1.innerText = "Entrada";

                    document.getElementById('tipo').value = 'Entrada'

                }

            });
        });
    </script>

    <br>
    <input class="btn btn-outline-success" type="submit" name="registrar" value="Registrar">
</form>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('.js-example-basic-single').select2({
            width: 'resolve',
            dropdownAutoWidth: true,
            tags: true,
            placeholder: "Selecionar Nome",
            allowClear: true,
            theme: "classic"
        });
    });
</script>