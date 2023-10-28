<!DOCTYPE html>
<html>
<head>
    <title>Localização e Geocodificação</title>
</head>
<body>
    <button id="getLocationButton">Obter Localização</button>
    <p id="locationInfo">Endereço: Aguardando localização...</p>

    <script>
        // Verifique se o navegador suporta geolocalização
        var getLocationButton = document.getElementById("getLocationButton");
        var locationInfo = document.getElementById("locationInfo");

        
        getLocationButton.addEventListener("click", function() {
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
                                locationInfo.textContent = "Endereço: " + address;
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
            });
    </script>
</body>
</html>
