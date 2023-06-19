<?php  

include "./mvc/common/som/";

//seleciona o numero de linhas da tabela
$consulta = $conexao->query("SELECT COUNT(*) FROM toyota_base where statuz='NOVO'");                            

//atribui a variavel $num_rows o numero de linhas
$num_rows = $consulta->fetchColumn();

//verifica se o numero de linhas é maior que 0 (zero)                       
if($num_rows > 0){
    //toca o som de alerta
    echo "<embed src='0000136.mp3'width='1' height='1'>";
}

?>