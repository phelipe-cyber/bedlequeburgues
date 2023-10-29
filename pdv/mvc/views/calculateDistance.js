
function calculateDistance(origin, destination, apiKey) {
  const url = `https://maps.googleapis.com/maps/api/directions/json?origin=${origin}&destination=${destination}&key=${apiKey}`;
  
  fetch(url)
  .then(response => response.json())
  .then(data => {
    if (data.status === 'OK') {
      const distance = data.routes[0].legs[0].distance.text;
      console.log(`La distancia entre ${origin} y ${destination} es ${distance}`);
      $(".container-spinner").addClass('hidden');
      VALOR_ENTREGA = parseFloat(dados.valor)
      VALOR_ENTREGA_2 = parseFloat(dados.valor)
      
      $("#lblValorEntrega").text(`+ R$ ${VALOR_ENTREGA.toFixed(2).replace('.', ',')}`);
      $("#lblValorTotal").text(`R$ ${(VALOR_CARRINHO + VALOR_ENTREGA).toFixed(2).replace('.', ',')}`);
      cardapio.metodos.mensagem('Entrega: R$ ' + VALOR_ENTREGA.toFixed(2).replace('.', ','),'success');


    } else {
      console.error('No se pudo calcular la distancia');
      $(".container-spinner").addClass('hidden');
      cardapio.metodos.mensagem('Erro no frete');
      VALOR_ENTREGA = 0.00
      $("#lblValorEntrega").text(`+ R$ ${VALOR_ENTREGA.toFixed(2).replace('.', ',')}`);
      $("#lblValorTotal").text(`R$ ${(VALOR_CARRINHO + VALOR_ENTREGA).toFixed(2).replace('.', ',')}`);

    }
  })
  .catch(error => {
    console.error('Error al obtener los datos:', error);
    $(".container-spinner").addClass('hidden');
    cardapio.metodos.mensagem('Erro',err);
  });
}

// Llama a la función con los puntos de origen y destino y tu clave de API
const origin = '';
const destination = '';
const apiKey = 'AIzaSyDa_Y_n8iDiTspZmmyPhbBWwDJ8IJbHtR8';

calculateDistance(origin, destination, apiKey);
