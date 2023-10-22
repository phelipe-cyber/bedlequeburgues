
function calculateDistance(origin, destination, apiKey) {
  const url = `https://maps.googleapis.com/maps/api/directions/json?origin=${origin}&destination=${destination}&key=${apiKey}`;
  
  fetch(url)
  .then(response => response.json())
  .then(data => {
    if (data.status === 'OK') {
      const distance = data.routes[0].legs[0].distance.text;
      console.log(`La distancia entre ${origin} y ${destination} es ${distance}`);
    } else {
      console.error('No se pudo calcular la distancia');
    }
  })
  .catch(error => {
    console.error('Error al obtener los datos:', error);
  });
}

// Llama a la función con los puntos de origen y destino y tu clave de API
const origin = '';
const destination = '';
const apiKey = 'AIzaSyDa_Y_n8iDiTspZmmyPhbBWwDJ8IJbHtR8';

calculateDistance(origin, destination, apiKey);
