<?php
function calcularDistancia($latitude1, $longitude1, $latitude2, $longitude2) {
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
    $a = sin($deltaLatitude/2) * sin($deltaLatitude/2) + cos($latitude1) * cos($latitude2) * sin($deltaLongitude/2) * sin($deltaLongitude/2);
    $c = 2 * atan2(sqrt($a), sqrt(1-$a));
    $distancia = $raioTerra * $c;

    return $distancia;
}

// -23,525295, -46,90247
// -23,552183, -46,891602

// Exemplo de utilização
$latitude1 = -23.525295; // Latitude da primeira coordenada em graus
$longitude1 = -46.891602; // Longitude da primeira coordenada em graus

$latitude2 = -23.552183; // Latitude da segunda coordenada em graus
$longitude2 = -46.891602; // Longitude da segunda coordenada em graus

$distancia = calcularDistancia($latitude1, $longitude1, $latitude2, $longitude2);

echo "A distância é de aproximadamente " . round($distancia, 2) . " km.";
