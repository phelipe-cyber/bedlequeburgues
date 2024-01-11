<?php
include "conexao.php";

// print_r($_POST);

$id_cliente = $_POST['id_cliente'];

$tab_clientes = "SELECT c.id, c.cep, cc.lon, cc.lat FROM clientes c 
LEFT JOIN cep_coordinates cc on c.cep = cc.postcode WHERE c.id = '$id_cliente' ";

$clientes = mysqli_query($conn, $tab_clientes);
while ($rows_clientes = mysqli_fetch_assoc($clientes)) {

    $cep = $rows_clientes['cep'];
    $lon = $rows_clientes['lon'];
    $lat = $rows_clientes['lat'];
};


// die();
function calcularDistancia($latitude1, $longitude1, $latitude2, $longitude2)
{
    // Raio da Terra em km
    $raioTerra = 6371;

    // Converter as coordenadas de graus para radianos
    $latitude1 = deg2rad($latitude1);
    $longitude1 = deg2rad($longitude1);
    $latitude2 = deg2rad($latitude2);
    $longitude2 = deg2rad($longitude2);

    // Diferença entre as latitudes e longitudes
    $deltaLatitude = $latitude2 - $latitude1;
    $deltaLongitude = $longitude2 - $longitude1;

    // Cálculo da distância utilizando a fórmula de Haversine
    $a = sin($deltaLatitude / 2) * sin($deltaLatitude / 2) + cos($latitude1) * cos($latitude2) * sin($deltaLongitude / 2) * sin($deltaLongitude / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    $distancia = $raioTerra * $c;
    $arradondar = ceil($distancia);

    return $arradondar;
}

// -23,525295, -46,90247
// -23,552183, -46,891602

// Exemplo de utilização
$latitude1 = -23.5446545; // Latitude da primeira coordenada em graus
$longitude1 = -46.8964596; // Longitude da primeira coordenada em graus

$latitude2 =  $lat; // Latitude da segunda coordenada em graus
$longitude2 = $lon; // Longitude da segunda coordenada em graus

$distancia = calcularDistancia($latitude1, $longitude1, $latitude2, $longitude2);

$km = ceil($distancia);

$tab_km = "SELECT * FROM `frete_valor` WHERE km LIKE '$km' ";
$sql_km = mysqli_query($conn, $tab_km);

while ($rows_km = mysqli_fetch_assoc($sql_km)) {

    $km = $rows_km['km'];
    $valor = $rows_km['valor'];
};

// echo "A distância é de aproximadamente " . round($distancia, 2) . " km.";
if ($lon == "") {
?>
    <h4 class="col-lg-12">
        <label for="">* Frete:</label>
        <div class="alert alert-danger" role="alert">
            <?php echo "Erro ao calcular o frete ( Sem Latitude e Longitude ) ou CEP: " . $cep . " incorreto " ?>
        </div>
    </h4>
<?php



} else {
?>
    <h4 class="col-lg-12">
        <label for="">* Frete:</label>
        <div class="alert alert-primary" role="alert">
            <?php echo "A distância é de aproximadamente " . $distancia . " km." ?>
            <p>
                <?php echo "Valor do Frete R$ " . $valor ?>
            </p>
            <div class="custom-control custom-switch">
                <input value="<?php echo ($id_cliente) ?>" type="checkbox" class="custom-control-input" id="customSwitch<?php echo $id_cliente ?>">
                <label class="custom-control-label" for="customSwitch<?php echo ($id_cliente) ?>"></label>
                <input id="id_user<?php echo ($id_cliente) ?>" value="<?php echo ($id_cliente) ?>" type="hidden">
            </div>
        </div>

    </h4>

    <input type="hidden" name="valor_frete" id="valor_frete" value="<?php echo $valor; ?>">


    <script>
        $(document).ready(function() {
            $("#customSwitch<?php echo $id_cliente ?>").click(function() {
                document.getElementById('spinner').style='display:flex;';

                var isChecked = document.getElementById("customSwitch<?php echo $id_cliente ?>").checked;
                console.log(isChecked);

                if (isChecked == false) {

                    let valor_frete = document.getElementById("valor_frete").value;
                    let hashpagina =  document.getElementById( "hash").value;

                    var vData = {
                        id: 1,
                        pedido: "FRETE",
                        Quantidade: 0,
                        valor: valor_frete,
                        hashpagina: hashpagina

                    };
                    $.ajax({
                        url: './mvc/model/ad_pedido_previa.php',
                        dataType: 'html',
                        type: 'POST',
                        data: vData,
                        success: function(html) {
                            document.getElementById('spinner').style='display:none;';

                        },
                        error: function(err) {
                            document.getElementById('spinner').style='display:none;';

                        },
                    });


                } else {

                    let valor_frete = document.getElementById("valor_frete").value;
                    let hashpagina =  document.getElementById( "hash").value;
                    document.getElementById('spinner').style='display:flex;';

                    var vData = {
                        id: 1,
                        pedido: "FRETE",
                        Quantidade: 1,
                        valor: valor_frete,
                        hashpagina: hashpagina,
                        botao: 'mais'

                    };
                    console.log(vData);
                    $.ajax({
                        url: './mvc/model/ad_pedido_previa.php',
                        dataType: 'html',
                        type: 'POST',
                        data: vData,
                        success: function(html) {
                            document.getElementById('spinner').style='display:none;';

                        },
                        error: function(err) {
                            document.getElementById('spinner').style='display:none;';

                        },
                    });

                }

            });
        });
    </script>

<?php
}
?>