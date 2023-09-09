<!DOCTYPE html>
<html>
<head>
    <title>Fechamento de Caixa</title>
</head>
<body>
    <h1>Fechamento de Caixa</h1>
    <form action="mvc/model/processar_fechamento.php" method="POST">

        <div class="row">
            <div class="col-4" id="mensagem" style="visibility: visible"><?php if (isset($_SESSION['msg'])) {echo $_SESSION['msg'];  unset($_SESSION['msg']); }?></div>
        </div>

        <div class="form-group col-md-2">
            <label for="recipient-name" class="col-form-label">Valor Final:</label>
            <!-- <input required type="text" name="valor_final" id="valor_final" class="form-control"> -->
            <input required type="text" name="valor_final" id="valor_final" class="form-control" onblur="formatarValor(this)">
        </div>
       
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">Fechar Caixa</button>
            </div>
        </div>
        <script>
            function formatarValor(input) {
                // Remove qualquer formatação anterior
                input.value = input.value.replace(/\D/g, '');

                // Formata o valor como moeda brasileira
                input.value = formatarMoeda(input.value);
            }

            function formatarMoeda(valor) {
                return parseFloat(valor).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
            }

            var var1 = document.getElementById("mensagem");
            setTimeout(function() {
                var1.style.display = "none";
            }, 5000)
            
    </script>
    </form>
</body>
</html>
