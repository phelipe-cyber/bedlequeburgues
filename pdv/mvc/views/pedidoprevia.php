<?php
session_start();
// include_once("conexao.php");
// include "./mvc/model/conexao.php";
// print_r($_SESSION);

$hashpagina = $_SESSION['hashpagina'];
// echo $hashpagina
?>
<!-- <h1 class="" id="div" > </h1> -->

<!-- <div id="div"> -->

<!-- <div class="col-xl-6 col-md-6 mb-4"> -->
<div class="row" style="padding: 1%;">
    <div class="form-group col-md-12">
        <label for="recipient-name" class="col-xl-12 text-center" style="font-size: 25px; background: gray; color: white; ">Valor Total Previsto</label>

        <input id="pagamento" class="col-xl-12 col-md-6 mb-4 text-center" type="text" name="pagamento" value="0.00" disabled>

        <table id="dtBasicExample" class="table table-striped table-bordered table-sm reponsive" cellspacing="0" width="auto">


            <?php

            include_once "../model/conexao.php";


            $selectSQL = ("SELECT * FROM `pedido_previa` where quantidade <> '' and hashpagina = '$hashpagina' order by id ASC ");

            $recebidos = mysqli_query($conn, $selectSQL);
            $index_previa = 1;
            while ($row_usuario = mysqli_fetch_assoc($recebidos)) {

                // echo "<tbody>";
                echo "<tr>";

                echo "<td>";
                echo "#" . " " . $index_previa;
                echo "</td>";

                echo "<td>";
                echo $produto = "<b>" . $row_usuario['quantidade'] . "x" . "</b> ( " . $row_usuario['produto'] . " )";
                echo "<br>";
                echo $observacao = $row_usuario['observacao'];
                echo "</td>";

                $quantidade = $row_usuario['quantidade'];
                // echo "<br>";
                echo "<td>";
                echo "R$ " . number_format($row_usuario['valor'], 2);
                echo "</td>";

                $valor[] = number_format($row_usuario['valor'], 2);
                // echo "<br>";
                echo "<td>";
                echo '<button id=id'.$row_usuario['id'].' type="button" class="btn btn-primary btn-sm">X</button>';
                echo "</td>";

                echo "</tr>";
               ?>
               <td>
                   <input id="id_deletar<?php echo $row_usuario['id'] ?>" class="" value="<?php echo $row_usuario['id'] ?>" type="hidden"></input>
               </td>

                <script>
                                        $(document).ready(function() {
                                            $("#id<?php echo $row_usuario['id'] ?>").click(function() {
                                                document.getElementById('spinner').style='display:flex;';

                                                id_deletar = document.getElementById(
                                                        "id_deletar<?php echo $row_usuario['id'] ?>")
                                                    .value

                                                hashpagina =  document.getElementById(
                                                    "hash"
                                                ).value;
                                               
                                                var vData = {
                                                    id: id_deletar,
                                                    hashpagina: hashpagina,
                                                    botao: 'deletar'
                                                }; 

                                                console.table(vData);

                                                $.ajax({
                                                    url: './mvc/model/ad_pedido_previa.php',
                                                    dataType: 'html',
                                                    type: 'POST',
                                                    data: vData,
                                                    beforeSend: function() {
                                                    },
                                                    success: function(html) {
                                                        document.getElementById('spinner').style='display:none;';


                                                       console.table(html);
                                                       Quantidade = document.getElementById("detalhes[<?php echo $row_usuario['id_produto'] ?>][quantidade]").value
                                                       Quantidade-- ;
                                                        Q = document.getElementById("detalhes[<?php echo $row_usuario['id_produto'] ?>][quantidade]").value = Quantidade;
                                                    },

                                                    error: function(err) {
                                                        document.getElementById('spinner').style='display:none;';


                                                    },

                                                });


                                            });
                                        });
                                    </script>
            <?php

                // echo "<tbody>";
                $index_previa++;
            }

            ?>
        </table>
        <?php
        @$valor_total = array_sum($valor);
        $valor_real = number_format($valor_total, 2)
        ?>

        <script>
            var valorFormatado = <?php echo ($valor_real); ?>.toLocaleString('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            });
            console.log(valorFormatado);

            document.getElementById("pagamento").value = valorFormatado
        </script>

            

    </div>
</div>
</div>