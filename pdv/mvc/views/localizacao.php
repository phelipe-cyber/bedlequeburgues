<!DOCTYPE html>
<html>
<head>
    <title>Localização e Geocodificação</title>
</head>
<body>
    
    <button id="getLocationButton">Obter Localização</button>
    <p id="permissionStatus">Permissão: Aguardando...</p>
    <p id="locationInfo">Endereço: Aguardando...</p>

    <script>
        
        // Verifique se o navegador suporta geolocalização
        var getLocationButton = document.getElementById("getLocationButton");
        var locationInfo = document.getElementById("locationInfo");
        var permissionStatus_2 = document.getElementById("permissionStatus");

        // getLocationButton.addEventListener("click", function() {
                if ("geolocation" in navigator) {
                    navigator.permissions.query({ name: 'geolocation' }).then(function(permissionStatus) {
                        if (permissionStatus.state === "granted") {
                            // Permissão de localização concedida
                            console.log("A localização está ativa e a permissão foi concedida.");
                            permissionStatus_2.textContent = "Permissão: Concedida";

                        } else {
                            // Permissão de localização não concedida
                            console.log("A permissão para localização não foi concedida.");
                            permissionStatus_2.textContent = "Permissão: Não concedida";
                        }
                    });
                // Obtenha a localização do dispositivo
                navigator.geolocation.getCurrentPosition(function(position) {
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;
                    console.log("A localização está ativa e a permissão foi concedida.");
                    permissionStatus_2.textContent = "Permissão: Concedida";
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
                permissionStatus_2.textContent = "Geolocalização não suportada pelo navegador.";

            }
            // });
    </script>
</body>
</html>
