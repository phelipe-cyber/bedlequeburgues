setTimeout(function() {
    $(document).ready(function () {
        cardapio.eventos.init();
    })
}, 3000);

var cardapio = {};

var MEU_CARRINHO = [];
var MEU_ENDERECO = null;

var VALOR_CARRINHO = 0;
var VALOR_ENTREGA = 0.00;
var VALOR_ENTREGA_2 = 0.00;

var CELULAR_EMPRESA = '5511989655124';

cardapio.eventos = {

    init: () => {
        cardapio.metodos.obterCategoriaMenu();
        cardapio.metodos.obterItensCardapio();
        cardapio.metodos.carregarBotaoLigar();
        cardapio.metodos.carregarBotaoReserva();
        cardapio.metodos.getLocationButton();
    }

}


cardapio.metodos = {

    // obtem a lista de itens do cardápio
    obterItensCardapio: (categoria = 'LANCHE', vermais = false) => {

        var filtro = MENU[categoria];
        
        // var categoriaNoSpaces = categoria.replace(/\s/g, '');

        if (!vermais) {
            $("#itensCardapio").html('');
            $("#btnVerMais").removeClass('hidden');
        }

        $.each(filtro, (i, e) => {

            let temp = cardapio.templates.item
            .replace(/\${img}/g, e.img)
            .replace(/\${nome}/g, e.name)
            .replace(/\${dsc}/g, e.dsc)
            .replace(/\${preco}/g, parseFloat(e.price).toFixed(2).replace('.', ','))
            .replace(/\${id}/g, e.id)

            // botão ver mais foi clicado (12 itens)
            if (vermais && i >= 8 && i < 150) {
                $("#itensCardapio").append(temp)
            }

            // paginação inicial (8 itens)
            if (!vermais && i < 8) {
                $("#itensCardapio").append(temp)
                // $("#containermenu").append(menucategoria)

            }

        })

        // remove o ativo
        $(".container-menu a").removeClass('active');

        var categoria = categoria.replace(/\s/g, '---');

        // seta o menu para ativo
        $("#menu-" + categoria).addClass('active')

    },

    // obtem a lista das categorias
    obterCategoriaMenu: () =>{
        if (typeof MENU === 'object') {

            var filtro = MENU;

            PropertyName =  Object.keys(filtro);

            $.each(PropertyName, (i, e) => {

                var category = e.replace(/\s/g, '---');

                let menucategoria = cardapio.templates.categoriamenu.replace(/\${id}/g, category).replace(/\${nome}/g, e)
                $("#containermenu").append(menucategoria)

            })}
        else{
            console.error('MENU não é um objeto válido.');
        }
    },

    // clique no botão de ver mais
    verMais: () => {

        var ativo = $(".container-menu a.active").attr('id').split('menu-')[1];
        cardapio.metodos.obterItensCardapio(ativo, true);

        $("#btnVerMais").addClass('hidden');

    },

    // diminuir a quantidade do item no cardapio
    diminuirQuantidade: (id) => {

        let qntdAtual = parseInt($("#qntd-" + id).text());

        if (qntdAtual > 0) {
            $("#qntd-" + id).text(qntdAtual - 1)
        }

    },

    // aumentar a quantidade do item no cardapio
    aumentarQuantidade: (id) => {

        let qntdAtual = parseInt($("#qntd-" + id).text());
        
        $("#qntd-" + id).text(qntdAtual + 1)

    },

    // adicionar ao carrinho o item do cardápio
    adicionarAoCarrinho: (id) => {

        let qntdAtual = parseInt($("#qntd-" + id).text());
            
        if (qntdAtual > 0) {

            // obter a categoria ativa
            var categoria = $(".container-menu a.active").attr('id').split('menu-')[1];
            var categoria = categoria.replace(/---/g, ' ');

            // obtem a lista de itens
            let filtro = MENU[categoria];

            // obtem o item
            let item = $.grep(filtro, (e, i) => { return e.id == id });

            if (item.length > 0) {

                // validar se já existe esse item no carrinho
                let existe = $.grep(MEU_CARRINHO, (elem, index) => { return elem.id == id });

                // caso já exista o item no carrinho, só altera a quantidade
                if (existe.length > 0) {
                    let objIndex = MEU_CARRINHO.findIndex((obj => obj.id == id));
                    MEU_CARRINHO[objIndex].qntd = MEU_CARRINHO[objIndex].qntd + qntdAtual;
                }
                // caso ainda não exista o item no carrinho, adiciona ele 
                else {
                    item[0].qntd = qntdAtual;
                    MEU_CARRINHO.push(item[0])
                }      
                
                cardapio.metodos.mensagem('Item adicionado ao carrinho', 'success')
                $("#qntd-" + id).text(0);

                cardapio.metodos.atualizarBadgeTotal();

            }

        }else{

            cardapio.metodos.mensagem('Quantidade não selecionada')
        }

    },

    // atualiza o badge de totais dos botões "Meu carrinho"
    atualizarBadgeTotal: () => {

        var total = 0;

        $.each(MEU_CARRINHO, (i, e) => {
            total += e.qntd
        })

        if (total > 0) {
            $(".botao-carrinho").removeClass('hidden');
            $(".container-total-carrinho").removeClass('hidden');
        }
        else {
            $(".botao-carrinho").addClass('hidden')
            $(".container-total-carrinho").addClass('hidden');
        }

        $(".badge-total-carrinho").html(total);

    },

    // abrir a modal de carrinho
    abrirCarrinho: (abrir) => {

        if (abrir) {
            $("#modalCarrinho").removeClass('hidden');
            cardapio.metodos.carregarCarrinho();
        }
        else {
            $("#modalCarrinho").addClass('hidden');
        }

    },

    // altera os texto e exibe os botões das etapas
    carregarEtapa: (etapa) => {

        if (etapa == 1) {
           
            if (VALOR_ENTREGA == 0 && MEU_CARRINHO.length > 0) {
                cardapio.metodos.mensagem('O Frete é adicionado na próxima etapa', 'primary');
            }
            
            $("#tipoEntrega").addClass('hidden');
            $("#getLocationButton").addClass('hidden');
            
            $("#lblTituloEtapa").text('Seu carrinho:');
            $("#itensCarrinho").removeClass('hidden');
            $("#localEntrega").addClass('hidden');
            $("#resumoCarrinho").addClass('hidden');

            $(".etapa").removeClass('active');
            $(".etapa1").addClass('active');

            $(".container-total").removeClass('hidden');

            $("#btnEtapaPedido").removeClass('hidden');
            $("#btnEtapaEndereco").addClass('hidden');
            $("#btnEtapaResumo").addClass('hidden');
            $("#btnVoltar").addClass('hidden');
        }
        
        if (etapa == 2) {

            cardapio.metodos.tipoEntregaEtapa2();

        }

        if (etapa == 3) {

            cardapio.metodos.tipoEntregaEtapa3();
        }

    },

    // botão de voltar etapa
    voltarEtapa: () => {

        let etapa = $(".etapa.active").length;
        console.log(etapa -1);
        cardapio.metodos.carregarEtapa(etapa - 1);

    },

    // carrega a lista de itens do carrinho
    carregarCarrinho: () => {

        cardapio.metodos.carregarEtapa(1);

        if (MEU_CARRINHO.length > 0) {

            $("#itensCarrinho").html('');

            $.each(MEU_CARRINHO, (i, e) => {

                let temp = cardapio.templates.itemCarrinho.replace(/\${img}/g, e.img)
                .replace(/\${nome}/g, e.name)
                .replace(/\${preco}/g, parseFloat(e.price).toFixed(2).replace('.', ','))
                .replace(/\${id}/g, e.id)
                .replace(/\${qntd}/g, e.qntd)

                $("#itensCarrinho").append(temp);

                // último item
                if ((i + 1) == MEU_CARRINHO.length) {
                    cardapio.metodos.carregarValores();
                }

            })

        }
        else {
            $("#itensCarrinho").html('<p class="carrinho-vazio"><i class="fa fa-shopping-cart"></i> Seu carrinho está vazio.</p>');
            cardapio.metodos.carregarValores();
        }

    },

    // diminuir quantidade do item no carrinho
    diminuirQuantidadeCarrinho: (id) => {

        let qntdAtual = parseInt($("#qntd-carrinho-" + id).text());

        if (qntdAtual > 1) {
            $("#qntd-carrinho-" + id).text(qntdAtual - 1);
            cardapio.metodos.atualizarCarrinho(id, qntdAtual - 1);
        }
        else {
            cardapio.metodos.removerItemCarrinho(id)
        }

    },

    // aumentar quantidade do item no carrinho
    aumentarQuantidadeCarrinho: (id) => {

        let qntdAtual = parseInt($("#qntd-carrinho-" + id).text());
        $("#qntd-carrinho-" + id).text(qntdAtual + 1);
        cardapio.metodos.atualizarCarrinho(id, qntdAtual + 1);

    },

    // botão remover item do carrinho
    removerItemCarrinho: (id) => {

        MEU_CARRINHO = $.grep(MEU_CARRINHO, (e, i) => { return e.id != id });
        cardapio.metodos.carregarCarrinho();

        // atualiza o botão carrinho com a quantidade atualizada
        cardapio.metodos.atualizarBadgeTotal();
        
    },

    // atualiza o carrinho com a quantidade atual
    atualizarCarrinho: (id, qntd) => {

        let objIndex = MEU_CARRINHO.findIndex((obj => obj.id == id));
        MEU_CARRINHO[objIndex].qntd = qntd;

        // atualiza o botão carrinho com a quantidade atualizada
        cardapio.metodos.atualizarBadgeTotal();

        // atualiza os valores (R$) totais do carrinho
        cardapio.metodos.carregarValores();

    },

    // carrega os valores de SubTotal, Entrega e Total
    carregarValores: () => {

        VALOR_CARRINHO = 0;

        $("#lblSubTotal").text('R$ 0,00');
        $("#lblValorEntrega").text('+ R$ 0,00');
        $("#lblValorTotal").text('R$ 0,00');

        $.each(MEU_CARRINHO, (i, e) => {

            VALOR_CARRINHO += parseFloat(e.price * e.qntd);

            if ((i + 1) == MEU_CARRINHO.length) {
                $("#lblSubTotal").text(`R$ ${VALOR_CARRINHO.toFixed(2).replace('.', ',')}`);
                $("#lblValorEntrega").text(`+ R$ ${VALOR_ENTREGA.toFixed(2).replace('.', ',')}`);
                $("#lblValorTotal").text(`R$ ${(VALOR_CARRINHO + VALOR_ENTREGA).toFixed(2).replace('.', ',')}`);
            }

        })

    },

    // carregar a etapa enderecos
    carregarEndereco: () => {

        if (MEU_CARRINHO.length <= 0) {
            cardapio.metodos.mensagem('Seu carrinho está vazio.')
            return;
        } 

        cardapio.metodos.carregarEtapa(2);

    },


    // buscar dados cliente pelo telefone
    buscarteldados: () => {
        $(".container-spinner").removeClass('hidden');

        // cria a variavel com o valor do telefone
        var phone = $("#phone").val().trim().replace(/\D/g, '');

        // verifica se o telefone possui valor informado
        if (phone != "") {

            // Expressão regular para validar o Telefone
            var validaphone = /^[0-9]{11}$/;
            
            if (validaphone.test(phone)) {

                      var vData = {
                       phone: phone
                      };
                      $.ajax({
                          url: 'dadostel.php',
                          dataType: 'json',
                          type: 'POST',
                          data: vData,
                          success: function(dados) {
                                if (dados != null) {
                                    $(".container-spinner").addClass('hidden');
                                    $("#txtEndereco").val(dados.endereco);
                                    $("#txtBairro").val(dados.bairro);
                                    $("#txtCidade").val(dados.cidade);
                                    $("#ddlUf").val(dados.estado);
                                    $("#txtCEP").val(dados.cep);
                                    $("#txtNome").val(dados.nome);
                                    $("#txtComplemento").val(dados.complemento);
                                    // $("#txtNumero").focus();
                                    $(".searchCep").addClass('hidden');

                                    cardapio.metodos.mensagem('Seus dados foram inseridos, por favor validar!','success');
                                }else{
                                    $(".container-spinner").addClass('hidden');
                                    cardapio.metodos.mensagem('Cadastro não encontrado. Preencha as informações manualmente.');
                                    $("#txtEndereco").val('');
                                    $("#txtBairro").val('');
                                    $("#txtCidade").val('');
                                    $("#ddlUf").val('-1');
                                    $("#txtCEP").val('');
                                    $("#txtNome").val('');
                                    $("#txtComplemento").val('');
                                    $("#txtNumero").val('');
                                    // $("#txtCEP").focus();
                                    $(".searchCep").removeClass('hidden');

                                }
                          },
                          error: function(err) {
                            $(".container-spinner").addClass('hidden');
                           cardapio.metodos.mensagem('Telefone não localizado');
                           $("#phone").focus();
                          },
                      });  
            }
            else {
                $(".container-spinner").addClass('hidden');
                cardapio.metodos.mensagem('Formato do Telefone inválido.');
                $("#phone").focus();
            }

        }
        else {
            $(".container-spinner").addClass('hidden');
            cardapio.metodos.mensagem('Informe o Telefone, por favor.');
            $("#phone").focus();
        }
   },

    //formatar dados telefone
    formatPhoneNumberBuscar: (input) =>{

        const rawNumber = input.value.trim().replace(/\D/g, ''); // Remove caracteres não numéricos
        const rawPhone = input.value.trim().replace(/\D/g, ''); // Remove caracteres não numéricos
        // Formatação para número de telefone no Brasil (exemplo: (11) 98765-4321)
        if (rawNumber.length <= 10) {
            const formattedNumber = rawNumber.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
            input.value = formattedNumber;
        } else {
            const formattedNumber = rawNumber.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
            input.value = formattedNumber;
        }

        if(rawPhone.length == 11 ){
            $(".container-spinner").removeClass('hidden');
            $(".searchPhone").addClass('hidden');

            if (rawPhone != "") {

                // Expressão regular para validar o Telefone
                var validaphone = /^[0-9]{11}$|^[0-9]{10}$/ ;
                  
                        if (validaphone.test(rawPhone)) {
                                var vData = {
                                phone: rawPhone
                                };
                                $.ajax({
                                    url: 'dadostel.php',
                                    dataType: 'json',
                                    type: 'POST',
                                    data: vData,
                                    success: function(dados) {
                                            if (dados != null) {
                                                var frase = dados.endereco;
                                                var palavras = frase.split(",");

                                                $("#txtEndereco").val(palavras[0]);
                                                // $("#txtBairro").val(dados.bairro);
                                                // $("#txtCidade").val(dados.cidade);
                                                // $("#ddlUf").val(dados.estado);
                                                // $("#txtCEP").val(dados.cep);
                                                $("#txtNome").val(dados.nome);
                                                $("#txtComplemento").val(dados.complemento);
                                                $("#txtNumero").val(palavras[1]);
                                                // $(".searchCep").addClass('hidden');
                                                $(".container-spinner").addClass('hidden');
            
                                                cardapio.metodos.mensagem('Seus dados foram inseridos, por favor validar!','success');
                                            }else{
                                                cardapio.metodos.mensagem('Cadastro não encontrado. Preencha as informações manualmente.');
                                                // $("#txtEndereco").val('');
                                                // $("#txtBairro").val('');
                                                // $("#txtCidade").val('');
                                                // $("#ddlUf").val('-1');
                                                // $("#txtCEP").val('');
                                                // $("#txtNome").val('');
                                                // $("#txtComplemento").val('');
                                                // $("#txtNumero").val('');
                                                // $("#phone").focus();
                                                // $(".searchCep").removeClass('hidden');
                                                $(".container-spinner").addClass('hidden');

            
                                            }
                                    },
                                    error: function(err) {
                                    cardapio.metodos.mensagem('Telefone não localizado');
                                    $("#phone").focus();
                                    },
                                });  
                        }
                        else {
                            cardapio.metodos.mensagem('Formato do Telefone inválido.');
                            $("#phone").focus();
                        }
    
            }
            else {
                cardapio.metodos.mensagem('Informe o Telefone, por favor.');
                $("#phone").focus();
            }
        }
        if(rawPhone.length == 10){
            $(".searchPhone").removeClass('hidden');
        }

    },
    //formatar dados telefone
    formatPhoneNumber: (input) =>{

        const rawNumber = input.value.trim().replace(/\D/g, ''); // Remove caracteres não numéricos
        const rawPhone = input.value.trim().replace(/\D/g, ''); // Remove caracteres não numéricos
        // Formatação para número de telefone no Brasil (exemplo: (11) 98765-4321)
        if (rawNumber.length <= 10) {
            const formattedNumber = rawNumber.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
            input.value = formattedNumber;
        } else {
            const formattedNumber = rawNumber.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
            input.value = formattedNumber;
        }

        if(rawPhone.length == 11 ){
            $(".searchPhone").addClass('hidden');

            if (rawPhone != "") {

                // Expressão regular para validar o Telefone
                var validaphone = /^[0-9]{11}$|^[0-9]{10}$/ ;
                  
                        if (validaphone.test(rawPhone)) {
                                
                        }
                        else {
                            cardapio.metodos.mensagem('Formato do Telefone inválido.');
                            $("#phone").focus();
                        }
    
            }
            else {
                cardapio.metodos.mensagem('Informe o Telefone, por favor.');
                $("#phone").focus();
            }
        }

    },

    //formatar dados CEP
    formatCEP: (input) =>{

        const rawCEP = input.value.trim().replace(/\D/g, ''); // Remove caracteres não numéricos
        // Formatação para número de CEP no Brasil (exemplo: 12345-678)
        const formattedCEP = rawCEP.replace(/(\d{5})(\d{3})/, '$1-$2');
                
        input.value = formattedCEP;

        // verifica se o CEP possui valor informado
        if (rawCEP != "") {
            
            if( rawCEP.length == 8 ){
            $(".container-spinner").removeClass('hidden');

            // Expressão regular para validar o CEP
            var validacep = /^[0-9]{8}$/;

            if (validacep.test(rawCEP)) {

                $.getJSON("https://viacep.com.br/ws/" + rawCEP + "/json/?callback=?", function (dados) {

                    if (!("erro" in dados)) {

                        cardapio.metodos.mensagem('CEP encontrado.  As informações foram preenchida.','success');

                        // Atualizar os campos com os valores retornados
                        $("#txtEndereco").val(dados.logradouro);
                        $("#txtBairro").val(dados.bairro);
                        $("#txtCidade").val(dados.localidade);
                        $("#ddlUf").val(dados.uf);
                        // $("#txtNome").focus();

                        var vData = {
                            cep: formattedCEP
                           };
                           $.ajax({
                               url: 'frete.php',
                               dataType: 'json',
                               type: 'POST',
                               data: vData,
                               success: function(dados) {
                                     if (dados != null) {
                                         $(".container-spinner").addClass('hidden');
                                         VALOR_ENTREGA = parseFloat(dados.valor)
                                         VALOR_ENTREGA_2 = parseFloat(dados.valor)
                                         
                                         $("#lblValorEntrega").text(`+ R$ ${VALOR_ENTREGA.toFixed(2).replace('.', ',')}`);
                                         $("#lblValorTotal").text(`R$ ${(VALOR_CARRINHO + VALOR_ENTREGA).toFixed(2).replace('.', ',')}`);
                                         cardapio.metodos.mensagem('Entrega: R$ ' + VALOR_ENTREGA.toFixed(2).replace('.', ','),'success');
             
                                     }else{
                                         $(".container-spinner").addClass('hidden');
                                         cardapio.metodos.mensagem('Erro no frete');
                                         VALOR_ENTREGA = 0.00
                                         $("#lblValorEntrega").text(`+ R$ ${VALOR_ENTREGA.toFixed(2).replace('.', ',')}`);
                                         $("#lblValorTotal").text(`R$ ${(VALOR_CARRINHO + VALOR_ENTREGA).toFixed(2).replace('.', ',')}`);
                                     }
                               },
                               error: function(err) {
                                 $(".container-spinner").addClass('hidden');
                                cardapio.metodos.mensagem('Erro',err);
                                
                               },
                           });  

                    }
                    else {
                        $(".container-spinner").addClass('hidden');
                        cardapio.metodos.mensagem('CEP não encontrado. Preencha as informações manualmente.');
                        $("#txtEndereco").val('');
                        $("#txtBairro").val('');
                        $("#txtCidade").val('');
                        $("#ddlUf").val('-1');
                        $("#txtCEP").val('');
                        $("#txtNome").val('');
                        $("#txtComplemento").val('');
                        $("#txtNumero").val('');
                        $("#txtCEP").focus();
                    }

                })

            }
            else {
                $(".container-spinner").addClass('hidden');
                cardapio.metodos.mensagem('Formato do CEP inválido.');
                $("#txtCEP").focus();
            }

        }
    }
        else {
            $(".container-spinner").addClass('hidden');
            cardapio.metodos.mensagem('Informe o CEP, por favor.');
            $("#txtCEP").focus();
        }
        

    },

    // API ViaCEP
    // buscarCep: () => {

    //     // cria a variavel com o valor do cep
    //     var cep = $("#txtCEP").val().trim().replace(/\D/g, '');

    //          // verifica se o CEP possui valor informado
    //     if (cep != "") {
    //         if( cep.length == 8 ){
    //                 // Expressão regular para validar o CEP
    //                 var validacep = /^[0-9]{8}$/;

    //                 if (validacep.test(cep)) {

    //                     $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

    //                         if (!("erro" in dados)) {

    //                             // Atualizar os campos com os valores retornados
    //                             $("#txtEndereco").val(dados.logradouro);
    //                             $("#txtBairro").val(dados.bairro);
    //                             $("#txtCidade").val(dados.localidade);
    //                             $("#ddlUf").val(dados.uf);
    //                             $("#txtNome").focus();
    //                             cardapio.metodos.mensagem('CEP preenchido com sucesso');
    //                             alert("CEP preenchido com sucesso")

    //                         }
    //                         else {
    //                             cardapio.metodos.mensagem('CEP não encontrado. Preencha as informações manualmente.');
    //                             $("#txtEndereco").focus();
    //                         }

    //                     })

    //                 }
    //                 else {
    //                     cardapio.metodos.mensagem('Formato do CEP inválido.');
    //                     $("#txtCEP").focus();
    //                 }

    //             }
    //     }
    //     else {
    //         cardapio.metodos.mensagem('Informe o CEP, por favor.');
    //         $("#txtCEP").focus();
    //     }
        
       

    // },

    // validação antes de prosseguir para a etapa 3
    resumoPedido: () => {

        var tipoEntrega = document.getElementById("flexSwitchCheckChecked").checked;

        console.log(tipoEntrega)

        if (tipoEntrega) {

        let phone = $("#phone").val().trim();
        let cep = $("#txtCEP").val().trim();
        let endereco = $("#txtEndereco").val().trim();
        let bairro = $("#txtBairro").val().trim();
        let cidade = $("#txtCidade").val().trim();
        let uf = $("#ddlUf").val().trim();
        let numero = $("#txtNumero").val().trim();
        let complemento = $("#txtComplemento").val().trim();
        let nome = $("#txtNome").val().trim();

        if (cep.length <= 0) {
            cardapio.metodos.mensagem('Informe o CEP, por favor.');
            $("#txtCEP").focus();
            return;
        }

        if (phone.length <= 0) {
            cardapio.metodos.mensagem('Informe o Telefone, por favor.');
            $("#phone").focus();
            return;
        }

        if (nome.length <= 0) {
            cardapio.metodos.mensagem('Informe o Nome, por favor.');
            $("#txtNome").focus();
            return;
        }
       
        if (endereco.length <= 0) {
            cardapio.metodos.mensagem('Informe o Endereço, por favor.');
            $("#txtEndereco").focus();
            return;
        }

        if (bairro.length <= 0) {
            cardapio.metodos.mensagem('Informe o Bairro, por favor.');
            $("#txtBairro").focus();
            return;
        }

        if (numero.length <= 0) {
            cardapio.metodos.mensagem('Informe o Número, por favor.');
            $("#txtNumero").focus();
            return;
        }

        if (cidade.length <= 0) {
            cardapio.metodos.mensagem('Informe a Cidade, por favor.');
            $("#txtCidade").focus();
            return;
        }

        if (uf == "-1") {
            cardapio.metodos.mensagem('Informe a UF, por favor.');
            $("#ddlUf").focus();
            return;
        }

        MEU_ENDERECO = {
            cep: cep,
            endereco: endereco,
            bairro: bairro,
            cidade: cidade,
            uf: uf,
            numero: numero,
            complemento: complemento,
            nome: nome,
            phone: phone

        }

        cardapio.metodos.carregarEtapa(3);
        cardapio.metodos.carregarResumo();
    }else{

        let nomeRetira = $("#txtNomeRetira").val().trim();
        let phoneRetira = $("#phoneRetira").val().trim();

        if (phoneRetira.length <= 0) {
            cardapio.metodos.mensagem('Informe o Telefone, por favor.');
            $("#phoneRetira").focus();
            return;
        }

        if (nomeRetira.length <= 0) {
            cardapio.metodos.mensagem('Informe o Nome, por favor.');
            $("#txtNomeRetira").focus();
            return;
        }

        cardapio.metodos.carregarEtapa(3);
        cardapio.metodos.carregarResumo();
    }

    },

    // carrega a etapa de Resumo do pedido
    carregarResumo: () => {

        $("#listaItensResumo").html('');

        $.each(MEU_CARRINHO, (i, e) => {

            let temp = cardapio.templates.itemResumo.replace(/\${img}/g, e.img)
                .replace(/\${nome}/g, e.name)
                .replace(/\${preco}/g, parseFloat(e.price).toFixed(2).replace('.', ','))
                .replace(/\${qntd}/g, e.qntd)

            $("#listaItensResumo").append(temp);

        });

        $("#resumonome").html(`${MEU_ENDERECO.nome}`);
        $("#resumoEndereco").html(`${MEU_ENDERECO.endereco}, ${MEU_ENDERECO.numero}, ${MEU_ENDERECO.bairro}`);
        $("#cidadeEndereco").html(`${MEU_ENDERECO.cidade}-${MEU_ENDERECO.uf} / ${MEU_ENDERECO.cep} ${MEU_ENDERECO.complemento}`);

        cardapio.metodos.finalizarPedido();

    },

    // Atualiza o link do botão do WhatsApp
    finalizarPedido: () => {

        if (MEU_CARRINHO.length > 0 && MEU_ENDERECO != null) {

            var texto = 'Olá! gostaria de fazer um pedido:';
            texto += `\n*Nome:* ${MEU_ENDERECO.nome}`;
            texto += `\n*Itens do pedido:*\n\n\${itens}`;
            texto += '\n*Endereço de entrega:*';
            texto += `\n${MEU_ENDERECO.endereco}, ${MEU_ENDERECO.numero}, ${MEU_ENDERECO.bairro}`;
            texto += `\n${MEU_ENDERECO.cidade}-${MEU_ENDERECO.uf} / ${MEU_ENDERECO.cep} ${MEU_ENDERECO.complemento}`;
            texto += `\n\n*Total (com entrega): R$ ${(VALOR_CARRINHO + VALOR_ENTREGA).toFixed(2).replace('.', ',')}*`;

            var itens = '';

            $.each(MEU_CARRINHO, (i, e) => {

                itens += `*${e.qntd}x* ${e.name} ....... R$ ${parseFloat(e.price).toFixed(2).replace('.', ',')} \n`;

                // último item
                if ((i + 1) == MEU_CARRINHO.length) {

                    texto = texto.replace(/\${itens}/g, itens);

                    // converte a URL
                    let encode = encodeURI(texto);
                    let URL = `https://wa.me/${CELULAR_EMPRESA}?text=${encode}`;

                    // $("#btnEtapaResumo").attr('href', URL);
                }

            })

        }

    },

    //Validar click
    validateClick: () =>{

            $(".container-spinner").removeClass('hidden');
            
            if (MEU_CARRINHO.length > 0 && MEU_ENDERECO != null) {
                let phone = $("#phone").val().trim();
                
                var vMEU_CARRINHO = {
                    pedido: MEU_CARRINHO,
                    dadoscliennte: MEU_ENDERECO,
                    telefone:phone,
                    frete:VALOR_ENTREGA,
                    tipoEntrega:TIPO_ENTREGA
                };
                $("#modalCarrinho").html('');
                $("#modalCarrinho").addClass('hidden');
                $(".botao-carrinho").addClass('hidden');
                $("#imgLogo").removeClass('hidden');

                $.ajax({
                    url: 'salvarPedido.php',
                    dataType: 'json',
                    type: 'POST',
                    data: vMEU_CARRINHO,
                    success: function(pedidoNew) {
                            if (pedidoNew != null) {
                                    $(".container-spinner").addClass('hidden');
                                    cardapio.metodos.mensagem('Seu Pedido: ' + pedidoNew + ' foi enviado ','success');
                                    cardapio.metodos.reload();
                            }else{
                                    $(".container-spinner").addClass('hidden');
                                    cardapio.metodos.mensagem('Pedido não enviado!');
                            }
                    },
                    error: function(err) {
                        $(".container-spinner").addClass('hidden');
                        cardapio.metodos.mensagem('Error',err);
                    },
                });
            }
    },

    // carrega o link do botão reserva
    carregarBotaoReserva: () => {

        var texto = 'Olá! gostaria de fazer uma *reserva*';

        let encode = encodeURI(texto);
        let URL = `https://wa.me/${CELULAR_EMPRESA}?text=${encode}`;

        $("#btnReserva").attr('href', URL);

    },

    // carrega o botão de ligar
    carregarBotaoLigar: () => {

        $("#btnLigar").attr('href', `tel:${CELULAR_EMPRESA}`);

    },

    // abre o depoimento
    abrirDepoimento: (depoimento) => {

        $("#depoimento-1").addClass('hidden');
        $("#depoimento-2").addClass('hidden');
        $("#depoimento-3").addClass('hidden');

        $("#btnDepoimento-1").removeClass('active');
        $("#btnDepoimento-2").removeClass('active');
        $("#btnDepoimento-3").removeClass('active');

        $("#depoimento-" + depoimento).removeClass('hidden');
        $("#btnDepoimento-" + depoimento).addClass('active');

    },

    // mensagens
    mensagem: (texto, cor = 'danger', tempo = 3900) => {

        let id = Math.floor(Date.now() * Math.random()).toString();

        let msg = `<div id="msg-${id}" role="alert" class="alert alert-${cor}"> ${texto}</div>`;

        $("#container-mensagens").append(msg);

        setTimeout(() => {
            $("#msg-" + id).removeClass('fadeInDown');
            $("#msg-" + id).addClass('fadeOutUp');
            setTimeout(() => {
                $("#msg-" + id).remove();
            }, 800);
        }, tempo)

    },

    reload: () => {

         setTimeout(function() {
            location.reload(true);
        }, 2000); // 5000 milissegundos = 5 segundos

    },

    tipoEntregaEtapa2: () => {

        var tipoEntrega = document.getElementById("flexSwitchCheckChecked").checked;

        if (tipoEntrega == true) {

            var labe1 = document.getElementById('form-check-label');
            labe1.innerText = "Entrega";
            
            document.getElementById('flexSwitchCheckChecked').value = 'Entrega'
            TIPO_ENTREGA = 'Entrega';

            VALOR_ENTREGA = VALOR_ENTREGA_2;
            $("#lblValorEntrega").text(`+ R$ ${VALOR_ENTREGA.toFixed(2).replace('.', ',')}`);
            $("#lblValorTotal").text(`R$ ${(VALOR_CARRINHO + VALOR_ENTREGA).toFixed(2).replace('.', ',')}`);

            $("#itensCarrinho").addClass('hidden');
            $("#entregaTipo").addClass(`hidden`);
            
            $("#lblTituloEtapa").text('Endereço de entrega:');
            $("#localEntrega").removeClass('hidden');
            $("#getLocationButton").addClass('hidden');
            $("#resumoCarrinho").addClass('hidden');
            
            $(".container-total").addClass('hidden');
            
            $(".etapa").removeClass('active');
            $(".etapa1").addClass('active');
            $(".etapa2").addClass('active');
            
            $("#btnEtapaPedido").addClass('hidden');
            $("#clienteRetira").addClass('hidden');
            $("#btnEtapaEndereco").removeClass('hidden');
            $("#btnEtapaResumo").addClass('hidden');
            $("#btnVoltar").removeClass('hidden');
            
            $("#resumoCarrinhoLocalEntrega").removeClass('hidden');
            $("#tipoEntrega").removeClass('hidden');

        } else {

            $("#itensCarrinho").addClass('hidden');
            
            $("#lblTituloEtapa").text('Endereço de entrega:');
            $("#localEntrega").addClass('hidden');
            $("#resumoCarrinho").addClass('hidden');
            
            $(".container-total").addClass('hidden');
            
            $(".etapa").removeClass('active');
            $(".etapa1").addClass('active');
            $(".etapa2").addClass('active');
            
            $("#btnEtapaPedido").addClass('hidden');
            $("#btnEtapaEndereco").removeClass('hidden');
            $("#btnEtapaResumo").addClass('hidden');
            $("#btnVoltar").removeClass('hidden');
            
            $("#resumoCarrinhoLocalEntrega").removeClass('hidden');
            $("#tipoEntrega").removeClass('hidden');

            var labe1 = document.getElementById('form-check-label');
            labe1.innerText = "Retirar";
            $("#entregaTipo").removeClass(`hidden`);
            $("#entregaTipo").text(`Retirar`);
            
            $("#clienteRetira").removeClass('hidden');
            

            document.getElementById('flexSwitchCheckChecked').value = 'Retirar'
            TIPO_ENTREGA = 'Retirar';
            VALOR_ENTREGA = 0.00
            $("#lblValorEntrega").text(`+ R$ ${VALOR_ENTREGA.toFixed(2).replace('.', ',')}`);
            $("#lblValorTotal").text(`R$ ${(VALOR_CARRINHO + VALOR_ENTREGA).toFixed(2).replace('.', ',')}`);

           
        }
    },

    tipoEntregaEtapa3: () => {

        var tipoEntrega = document.getElementById("flexSwitchCheckChecked").checked;

        if (tipoEntrega == true) {

            var labe1 = document.getElementById('form-check-label');
            labe1.innerText = "Entrega";
            document.getElementById('flexSwitchCheckChecked').value = 'Entrega';
            TIPO_ENTREGA = 'Entrega';
            
            VALOR_ENTREGA = VALOR_ENTREGA_2;
            $("#lblValorEntrega").text(`+ R$ ${VALOR_ENTREGA.toFixed(2).replace('.', ',')}`);
            $("#lblValorTotal").text(`R$ ${(VALOR_CARRINHO + VALOR_ENTREGA).toFixed(2).replace('.', ',')}`);
            
            $("#entregaTipo").addClass(`hidden`);

            $("#lblTituloEtapa").text('Resumo do pedido:');
            $("#itensCarrinho").addClass('hidden');
            $("#localEntrega").addClass('hidden');
            $("#resumoCarrinho").removeClass('hidden');

            $(".container-total").removeClass('hidden');

            $(".etapa").removeClass('active');
            $(".etapa1").addClass('active');
            $(".etapa2").addClass('active');
            $(".etapa3").addClass('active');

            $("#btnEtapaPedido").addClass('hidden');
            $("#btnEtapaEndereco").addClass('hidden');
            
            $("#btnEtapaResumo").removeClass('hidden');
            $("#btnVoltar").removeClass('hidden');

            $("#tipoEntrega").removeClass('hidden');

            $("#clienteRetira").addClass('hidden');


        } else {

            $("#lblTituloEtapa").text('Resumo do pedido:');
            $("#itensCarrinho").addClass('hidden');
            $("#localEntrega").addClass('hidden');
            $("#resumoCarrinho").removeClass('hidden');

            $(".container-total").removeClass('hidden');

            $(".etapa").removeClass('active');
            $(".etapa1").addClass('active');
            $(".etapa2").addClass('active');
            $(".etapa3").addClass('active');

            $("#btnEtapaPedido").addClass('hidden');
            $("#btnEtapaEndereco").addClass('hidden');
            
            $("#btnEtapaResumo").removeClass('hidden');
            $("#btnVoltar").removeClass('hidden');

            $("#tipoEntrega").removeClass('hidden');

            $("#resumoCarrinhoLocalEntrega").addClass('hidden');
            
            var labe1 = document.getElementById('form-check-label');
            labe1.innerText = "Retirar";
            document.getElementById('flexSwitchCheckChecked').value = 'Retirar';
            TIPO_ENTREGA = 'Retirar';

            $("#clienteRetira").addClass('hidden');
            
            let nome = $("#txtNomeRetira").val().trim();
            let phone = $("#phoneRetira").val().trim();
            
            $("#entregaTipo").removeClass(`hidden`);
            $("#entregaTipo").text(`Retirar: `+ nome);
            
            MEU_ENDERECO = {
                nome: nome,
                phone: phone
            };

            VALOR_ENTREGA = 0.00
            $("#lblValorEntrega").text(`+ R$ ${VALOR_ENTREGA.toFixed(2).replace('.', ',')}`);
            $("#lblValorTotal").text(`R$ ${(VALOR_CARRINHO + VALOR_ENTREGA).toFixed(2).replace('.', ',')}`);

           
        }
    },

    getLocationButton: () =>{
        var locationInfo = document.getElementById("locationInfo");

        if ("geolocation" in navigator) {
            
            // Obtenha a localização do dispositivo
            navigator.geolocation.getCurrentPosition(function(position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;

                // Chame a API de geocodificação da Google
                var apiKey = "AIzaSyDa_Y_n8iDiTspZmmyPhbBWwDJ8IJbHtR8"; // Substitua com a sua própria chave da API da Google
                var apiUrl = `https://maps.googleapis.com/maps/api/geocode/json?latlng=${latitude},${longitude}&key=${apiKey}`;

                fetch(apiUrl)
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === "OK") {
                            var address = data.results[0].formatted_address;
                            let bairro, cidade, estado, endereco,street_number,postal_code;
											for (const component of data.results[0].address_components) {
                                           if (component.types.includes("sublocality_level_1")) {
                                                 bairro = component.long_name;
                                          }
                                           if (component.types.includes("administrative_area_level_2")) {
                                                cidade = component.long_name;
                                           }
                                           if (component.types.includes("route")) {
                                                endereco = component.long_name;
                                           }
                                           if (component.types.includes("administrative_area_level_1")) {
                                                estado = component.long_name;
                                                short_name = component.short_name;
                                           }
                                           if (component.types.includes("street_number")) {
                                                street_number = component.long_name;
                                           }
                                           if (component.types.includes("postal_code")) {
                                                postal_code = component.long_name;
                                           }
                                           if (component.types.includes("administrative_area_level_1")) {
                                                short_name = component.short_name;
                                           }
										};
                                        $("#txtEndereco").val(endereco);
                                        $("#txtBairro").val(bairro);
                                        $("#txtCidade").val(cidade);
                                        $("#ddlUf").val(short_name);
                                        $("#txtCEP").val(postal_code);
                                        $("#txtNome").val('');
                                        $("#txtComplemento").val('');
                                        $("#txtNumero").val(street_number);
                                        $("#txtCEP").focus();

                                        const latDestino = latitude
                                        const lngDestino = longitude
                                        
                                        const latOrigem = '-23.548308'
                                        const lngOrigem = '-46.893372'

                                        cardapio.metodos.calculateDistance(latDestino, lngDestino,latOrigem,lngOrigem);
                                        // var vData = {
                                        //     cep: postal_code
                                        //    };
                                        
                                        //    $.ajax({
                                        //        url: 'frete.php',
                                        //        dataType: 'json',
                                        //        type: 'POST',
                                        //        data: vData,
                                        //        success: function(dados) {
                                        //              if (dados != null) {
                                        //                  $(".container-spinner").addClass('hidden');
                                        //                  VALOR_ENTREGA = parseFloat(dados.valor)
                                        //                  VALOR_ENTREGA_2 = parseFloat(dados.valor)
                                                         
                                        //                  $("#lblValorEntrega").text(`+ R$ ${VALOR_ENTREGA.toFixed(2).replace('.', ',')}`);
                                        //                  $("#lblValorTotal").text(`R$ ${(VALOR_CARRINHO + VALOR_ENTREGA).toFixed(2).replace('.', ',')}`);
                                        //                  cardapio.metodos.mensagem('Entrega: R$ ' + VALOR_ENTREGA.toFixed(2).replace('.', ','),'success');
                             
                                        //              }else{
                                        //                  $(".container-spinner").addClass('hidden');
                                        //                 //  cardapio.metodos.mensagem('Erro no frete');
                                        //                  VALOR_ENTREGA = 0.00
                                        //                  $("#lblValorEntrega").text(`+ R$ ${VALOR_ENTREGA.toFixed(2).replace('.', ',')}`);
                                        //                  $("#lblValorTotal").text(`R$ ${(VALOR_CARRINHO + VALOR_ENTREGA).toFixed(2).replace('.', ',')}`);
                                                        
                                        //                  const latDestino = latitude
                                        //                  const lngDestino = longitude
                                                         
                                        //                  const latOrigem = '-23.548308'
                                        //                  const lngOrigem = '-46.893372'

                                        //                  cardapio.metodos.calculateDistance(latDestino, lngDestino,latOrigem,lngOrigem);
                        
                                        //              }
                                        //        },
                                        //        error: function(err) {
                                        //          $(".container-spinner").addClass('hidden');
                                        //          cardapio.metodos.mensagem('Erro',err);
                                                                                
                                        //        },
                                        //    }); 

                        } else {
                            locationInfo.textContent = "Erro ao obter o endereço.";
                        }
                    })
                    .catch(error => {
                        locationInfo.textContent = "Erro ao obter o endereço.";
                    });
            });
        } else {
            locationInfo.textContent = "Geolocalização não suportada pelo navegador.";
        }
    },
    
calculateDistance: (latDestino, lngDestino,latOrigem,lngOrigem) => {

    var directionsService = new google.maps.DirectionsService();
            var directionsRenderer = new google.maps.DirectionsRenderer();
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                center: {lat: -23.548308, lng: -46.893372}
            });
            
            var localizacao_origem = new google.maps.LatLng(latOrigem, lngOrigem);

            var localizacao_destino = new google.maps.LatLng(latDestino, lngDestino);

            var marker_origem = new google.maps.Marker({
                position: localizacao_origem,
                map: map,
                title: 'Bedlek Burgues' // Título do marcador (opcional)
            });

            var marker_destino = new google.maps.Marker({
                position: localizacao_destino,
                map: map,
                title: 'Minha Localização' // Título do marcador (opcional)
            });
            
            var infowindowA = new google.maps.InfoWindow({
                content: 'Bedlek Burgues'
            });

            var infowindowb = new google.maps.InfoWindow({
                content: 'Minha Localização'
            });

            marker_origem.addListener('click', function() {
                infowindowA.open(map, marker_origem);
            });

            marker_destino.addListener('click', function() {
                infowindowb.open(map, marker_destino);
            });

            directionsRenderer.setMap(map);

            var origin = new google.maps.LatLng(latOrigem, lngOrigem); // Substitua latOrigem e lngOrigem pelas coordenadas de origem
            var destination = new google.maps.LatLng(latDestino, lngDestino); // Substitua latDestino e lngDestino pelas coordenadas de destino

            var request = {
                origin: origin,
                destination: destination,
                travelMode: 'DRIVING' // Você pode escolher outros modos, como 'WALKING', 'BICYCLING', 'TRANSIT', etc.
            };

            directionsService.route(request, function(response, status) {
                if (status == 'OK') {

                    var route = response.routes[0];
                    var distance = route.legs[0].distance.text;
                    var duration = route.legs[0].duration.text;

                    cardapio.metodos.mensagem('Distância: ' + distance,'success');
                    cardapio.metodos.mensagem('Tempo estimado: ' + duration,'success');
                    // document.getElementById('map').style = "overflow: visible"
                    var vData = {
                        distanceValue: distance
                       };
                    
                    $.ajax({
                        url: 'frete_km.php',
                        dataType: 'json',
                        type: 'POST',
                        data: vData,
                        success: function(dados) {
                              if (dados != null) {
                                  $(".container-spinner").addClass('hidden');
                                  VALOR_ENTREGA = parseFloat(dados.valor)
                                  VALOR_ENTREGA_2 = parseFloat(dados.valor)
                                  
                                  $("#lblValorEntrega").text(`+ R$ ${VALOR_ENTREGA.toFixed(2).replace('.', ',')}`);
                                  $("#lblValorTotal").text(`R$ ${(VALOR_CARRINHO + VALOR_ENTREGA).toFixed(2).replace('.', ',')}`);
                                  cardapio.metodos.mensagem('Entrega: R$ ' + VALOR_ENTREGA.toFixed(2).replace('.', ','),'success');
      
                              }else{
                                  $(".container-spinner").addClass('hidden');
                                 //  cardapio.metodos.mensagem('Erro no frete');
                                  VALOR_ENTREGA = 0.00
                                  $("#lblValorEntrega").text(`+ R$ ${VALOR_ENTREGA.toFixed(2).replace('.', ',')}`);
                                  $("#lblValorTotal").text(`R$ ${(VALOR_CARRINHO + VALOR_ENTREGA).toFixed(2).replace('.', ',')}`);
                                 
                              }
                        },
                        error: function(err) {
                          $(".container-spinner").addClass('hidden');
                          cardapio.metodos.mensagem('Erro',err);
                                                         
                        },
                    }); 


                }
            });
        }

},

cardapio.templates = {
    // <img src="\${img}" />

    item: `
        <div class="col-12 col-lg-3 col-md-3 col-sm-6 mb-5 animated fadeInUp">
            <div class="card card-item" id="\${id}">
                <div class="img-produto">
                    <img src=./img/cardapio/cardapioonline/\${img} />
                </div>
                <p class="title-produto text-center mt-4">
                    <b>\${nome}</b>
                </p>
                <p class="price-produto text-center">
                    <b>R$ \${preco}</b>
                </p>
                <p class="dsc-produto text-center">
                    \${dsc}
                </p>
                <div class="add-carrinho">
                    <span class="btn-menos" onclick="cardapio.metodos.diminuirQuantidade('\${id}')"><i class="fas fa-minus"></i></span>
                    <span class="add-numero-itens" id="qntd-\${id}">0</span>
                    <span class="btn-mais" onclick="cardapio.metodos.aumentarQuantidade('\${id}')"><i class="fas fa-plus"></i></span>
                    <span class="btn btn-add" onclick="cardapio.metodos.adicionarAoCarrinho('\${id}')"><i class="fa fa-shopping-cart"></i></span>
                </div>
            </div>
        </div>
    `,

    itemCarrinho: `
        <div class="col-12 item-carrinho">
            <div class="img-produto">
            <img src=./img/cardapio/cardapioonline/\${img} />
            </div>
            <div class="dados-produto">
                <p class="title-produto"><b>\${nome}</b></p>
                <p class="price-produto"><b>R$ \${preco}</b></p>
            </div>
            <div class="add-carrinho">
                <span class="btn-menos" onclick="cardapio.metodos.diminuirQuantidadeCarrinho('\${id}')"><i class="fas fa-minus"></i></span>
                <span class="add-numero-itens" id="qntd-carrinho-\${id}">\${qntd}</span>
                <span class="btn-mais" onclick="cardapio.metodos.aumentarQuantidadeCarrinho('\${id}')"><i class="fas fa-plus"></i></span>
                <span class="btn btn-remove no-mobile" onclick="cardapio.metodos.removerItemCarrinho('\${id}')"><i class="fa fa-times"></i></span>
            </div>
        </div>
    `,

    itemResumo: `
        <div class="col-12 item-carrinho resumo">
            <div class="img-produto-resumo">
            <img src=./img/cardapio/cardapioonline/\${img} />
            </div>
            <div class="dados-produto">
                <p class="title-produto-resumo">
                    <b>\${nome}</b>
                </p>
                <p class="price-produto-resumo">
                    <b>R$ \${preco}</b>
                </p>
            </div>
            <p class="quantidade-produto-resumo">
                x <b>\${qntd}</b>
            </p>
        </div>
    `,

    categoriamenu: `
    <a id="menu-\${id}" class="btn-group btn btn-white btn-sm mr-3"  onclick="cardapio.metodos.obterItensCardapio('\${nome}')">
        <i class="fas fa-hamburger"></i>&nbsp; \${nome}
    </a>
    `,

}
