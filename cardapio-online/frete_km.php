<?php
include '.././pdv/mvc/model/conexao.php';

// print_r($_POST);

$distanceValue = $_POST['distanceValue'];

$search  = array(" km", ",", " ","0");

$stringSemUnidade =   str_replace($search, "",  $distanceValue);

$tab_km = "SELECT * FROM `frete_valor` WHERE km LIKE '%$stringSemUnidade%' ";
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
