<?php

include '.././pdv/mvc/model/conexao.php';

$tab_produtos = "SELECT id, nome as `name`, categoria, categoria as category, detalhes as 'dsc' , TRIM(TRAILING '.00' FROM preco_venda) AS 'price', img FROM `produtos` where categoria <> 'FRETE' and categoria <> '' ORDER by id ASC" ;
$result = mysqli_query($conn, $tab_produtos);
$menu = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $category = $row["categoria"];
        unset($row["categoria"]);
        $menu[$category][] = $row;
    }
}

$conn->close();

header("Content-Type: application/json");

$jsonData = json_encode($menu, JSON_PRETTY_PRINT);


echo $jsonData;


?>

