<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>
<script>
    function calcularHashMD5(conteudo) {
        return CryptoJS.MD5(conteudo).toString();
    }

    window.onload = function() {

        function getDataHoraAtual() {
            const dataHoraAtual = new Date();
            const ano = dataHoraAtual.getFullYear();
            const mes = dataHoraAtual.getMonth() + 1;
            const dia = dataHoraAtual.getDate();
            const hora = dataHoraAtual.getHours();
            const minutos = dataHoraAtual.getMinutes();
            const segundos = dataHoraAtual.getSeconds();

            return `${dia}/${mes}/${ano} ${hora}:${minutos}:${segundos}`;
        }
        const dataHoraAtualString = getDataHoraAtual();
        // console.log(`Data e hora atual: ${dataHoraAtualString}`);
        // var conteudoPagina = document.documentElement.outerHTML;
        var hashPagina = calcularHashMD5(dataHoraAtualString);
        // console.log('Hash MD5 da página:', hashPagina);
        $('#hash').val(hashPagina);
        $('#hash_previa').val(hashPagina);

        // Armazena um valor no localStorage
        localStorage.setItem('hashpagina', hashPagina);

        // Recupera o valor do localStorage
        const hashpagina = localStorage.getItem('hashpagina');
        console.log("localStorage_Hash",hashpagina);


    };
</script> -->

<?php
// Definir o fuso horário para sua localização
date_default_timezone_set('America/Sao_Paulo');

// Obter a data e hora atual
$dataHoraAtual = date('Y-m-d H:i:s'); // Formato: Ano-Mês-Dia Hora:Minuto:Segundo
// echo "Data e Hora Atuais: " . $dataHoraAtual;
$hashpagina = md5($dataHoraAtual . $_SESSION['user']);

// echo "Hash da senha (MD5): " . $hashpagina;

$_SESSION['hashpagina'] = $hashpagina;

// session_unset();