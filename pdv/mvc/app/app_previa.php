<?php
session_start();
// include_once("conexao.php");
// include "./mvc/model/conexao.php";
$app_hashpagina = $_SESSION['app_hashpagina'];

print_r($_SESSION);
// print_r($_POST);
?>
<!-- <h1 class="" id="div" > </h1> -->

<!-- <div id="div"> -->

<!-- <div class="col-xl-6 col-md-6 mb-4"> -->
        <div class="row" style="padding: 1%;">
            <div class="form-group col-md-12">
                <label for="recipient-name" class="col-xl-12 text-center"
                    style="font-size: 25px; background: gray; color: white; ">Valor Total Previsto</label>
                
                    <input id="pagamento" class="col-xl-12 col-md-6 mb-4 text-center" type="text"
                    name="pagamento" value="0.00" disabled>

                    <table id="dtBasicExample" class="table table-striped table-bordered table-sm reponsive"
                        cellspacing="0" width="auto">
                            
        
        <?php

include_once "../model/conexao.php";
    
    
echo    $selectSQL = ("SELECT * FROM `pedido_previa` where quantidade <> '' and hashpagina = '$app_hashpagina' order by id ASC ");
    
    $recebidos = mysqli_query($conn, $selectSQL);
    $index = 1;
    while ($row_usuario = mysqli_fetch_assoc($recebidos)) {
        
        // echo "<tbody>";
        // echo "<tr>";

        // echo "<td>";
            // echo "#" ." ".$index ;
        // echo "</td>";

        // echo "<td>";
        // echo $produto = "<b>" . $row_usuario['quantidade'] ."x" . "</b> ( " . $row_usuario['produto'] . " )";
        // echo "<br>";
        // echo $observacao = $row_usuario['observacao'];
        // echo "</td>";
        
        // echo $quantidade = $row_usuario['quantidade'];
        // echo "<br>";
        // echo "<td>";
        // echo "R$ ". number_format($row_usuario['valor'],2);
        // echo "</td>";
        
         $valor[] = number_format($row_usuario['valor'],2);
        // echo "<br>";

        // echo "</tr>";

        // echo "<tbody>";
        // $index ++;
    }
    
    ?>
                    </table>
<?php
                    @$valor_total = array_sum( $valor );
                    $valor_real = number_format($valor_total, 2)
                    ?>

<script>


    var valorFormatado = <?php echo ($valor_real); ?>.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
    console.log(valorFormatado);

        document.getElementById("pagamento").value = valorFormatado

</script>

</div>
        </div>
</div>
