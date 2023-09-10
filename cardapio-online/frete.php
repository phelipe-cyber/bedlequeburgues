<?php
include '.././pdv/mvc/model/conexao.php';

// print_r($_POST);

$cep = $_POST['cep'];

$tab_clientes = "SELECT * FROM cep_coordinates WHERE postcode = '$cep' ";

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

    $menu = $rows_km;
};

$conn->close();

header("Content-Type: application/json");

$jsonData = json_encode($menu, JSON_PRETTY_PRINT);

echo $jsonData;
