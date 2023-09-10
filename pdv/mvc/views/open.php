<!DOCTYPE html>
<html>
<head>
    <title>Abertura de Caixa</title>
</head>
<body>
    <h1>Abertura de Caixa</h1>
    <form action="mvc/model/processar_abertura.php" method="POST">

        <div class="row">
            <div class="col-4" id="mensagem" style="visibility: visible"><?php if (isset($_SESSION['msg'])) {echo $_SESSION['msg'];  unset($_SESSION['msg']); }?></div>
        </div>
    
        <div class="form-group col-md-2">
            <label for="recipient-name" class="col-form-label">Valor Inicial:</label>
            <input required type="text" name="valor_inicial" id="valor_inicial" class="form-control" onkeyup="formatarMoeda();">
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">Abrir Caixa</button>
            </div>
        </div>

        <script>
            function formatarMoeda() {
                var elemento = document.getElementById('valor_inicial');
                var valor = elemento.value;
                console.log(valor)
                valor = valor + '';
                valor = parseInt(valor.replace(/[\D]+/g, ''));
                valor = valor + '';
                valor = valor.replace(/([0-9]{2})$/g, ",$1");
                if (valor.length > 6) {
                    valor = valor.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
                }
                if(valor == 'NaN'){
                    valor = null;
                }else{
                    elemento.value = valor;
                }
            }
        </script>

        <script>
            var var1 = document.getElementById("mensagem");
            setTimeout(function() {
                var1.style.display = "none";
            }, 5000)
        
        </script>
    </form>



</body>
</html>
