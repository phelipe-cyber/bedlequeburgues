<?php
// Definir o fuso horário para sua localização
date_default_timezone_set('America/Sao_Paulo');

// Obter a data e hora atual
$dataHoraAtual = date('Y-m-d H:i:s'); // Formato: Ano-Mês-Dia Hora:Minuto:Segundo
// echo "Data e Hora Atuais: " . $dataHoraAtual;

$app_hashpagina = md5($dataHoraAtual . $_SESSION['user']);
// echo "Hash da senha (MD5): " . $hashpagina;

$_SESSION['app_hashpagina'] = $app_hashpagina;

// session_unset();