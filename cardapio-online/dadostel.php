<?php

include '.././pdv/mvc/model/conexao.php';

$tel = $_POST['phone'];

$tab_telefone = "SELECT * FROM `clientes` where REPLACE(REPLACE(REPLACE(REPLACE(tel1, '(', ''), ')', ''), '-', ''),' ','') = '$tel' and cep <> '' ORDER by id DESC limit 1" ;
$resultado_telefone = mysqli_query($conn, $tab_telefone);
// $menu = array();

if ($resultado_telefone->num_rows > 0) {
    while ($row = $resultado_telefone->fetch_assoc()) {
        // $category = $row["categoria"];
        // unset($row["categoria"]);
        $menu = $row;
    }
}

$conn->close();

header("Content-Type: application/json");

$jsonData = json_encode($menu, JSON_PRETTY_PRINT);

echo $jsonData;


?>

