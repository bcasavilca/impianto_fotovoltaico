<?php 

include_once("connection.php");
?><!DOCTYPE html>
<html>
<head> 
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
     <title>Previsão do Tempo</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>

   
        td,tr{
        padding:5px 10px 5px 10px;
       
        border: 0.5px solid black;
    }
    .red {
      color: red;
    }
    .highlight {
      background-color: yellow;
    }
  </style>
     <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

   
<div class="menu">
<a href="https://spirano-it.000webhostapp.com/index.php"><button class="intervento active" >Intervento</button></a>
<a href="https://spirano-it.000webhostapp.com/historic.php"><button class="storico">Storico</button></a>
<a href="https://spirano-it.000webhostapp.com/deposito.php"><button class="deposito">Deposito</button></a>
</div>

<div class="conteudo_intervento">
  
 
</div>
  <div id="current_weather"></div>
  <div id="hourly"></div>
  <div id="cloud_cover"></div>

  <script>
    // Faz uma solicitação HTTP GET para a API
    $.get("https://api.open-meteo.com/v1/forecast?latitude=45.58&longitude=9.65&current_weather=true&current=cloud_cover&hourly=temperature_2m,relativehumidity_2m,windspeed_180m", function(response) {
  // Manipula a resposta para exibir os dados relevantes
  var currentWeather = response.current_weather;
  var hourly = response.hourly;
  var cloud_cover = response.cloud_cover;

// Cria uma data e hora atual
var now = new Date();
// Adiciona uma hora
now.setHours(now.getHours());

  // Converte a velocidade do vento de m/s para km/h
  var windSpeedKmH = currentWeather.windspeed * 3.6;


  $("#current_weather").html("<span style='margin-left: 20px; margin-right: 20px;'>Ora </span>" +
    "<span><i class='fas fa-thermometer-half'></i> " + currentWeather.temperature + "°C</span>" + 
    "<span style='margin-left: 20px; margin-right: 20px;'><i class='fas fa-wind'></i>" + windSpeedKmH.toFixed(1) + "km/h</span>" +
    "<span><i class='fas fa-compass' style='transform: rotate(" + currentWeather.winddirection + "deg);'></i>" + currentWeather.winddirection + "°</span>" +
    "<span>" + currentWeather.cloud_cover + "</span>" );




  var hourlyHtml = "<h4>Previsione di Vento</h4>";
  hourlyHtml += "<table><tr><th>Ora</th><th>Velocitá di Vento</th></tr>";

  // Faz um loop apenas nas primeiras 24 horas do dia atual
  for (var i = 0; i < 24; i++) {
    // Obtém a hora atual no formato "HH:00"
    var currentHour = now.getHours().toString().padStart(2, '0') + ":00";
    // Obtém a hora da previsão no formato "HH:00"
    var hourlyTime = hourly.time[i].slice(11, 13) + ":00";

    // Se a hora atual for igual à hora da previsão, adiciona a classe "highlight" à linha da tabela
    var highlightClass = currentHour === hourlyTime ? "highlight" : "";

    // Converte a velocidade do vento de m/s para km/h
    var hourlyWindSpeedKmH = hourly.windspeed_180m[i] * 3.6;

    // Adiciona a classe "red" à linha da tabela se a velocidade do vento for superior a 20 km/h
    var hourlyRowClass = hourlyWindSpeedKmH > 20 ? "red" : "";
    
    hourlyHtml += "<tr class='" + hourlyRowClass + " " + highlightClass + "'><td>" + hourly.time[i] + "</td>";
    
    hourlyHtml += "<td>" + hourlyWindSpeedKmH.toFixed(1) + " km/h</td></tr>";
  }
      hourlyHtml += "</table>";
      $("#hourly").html(hourlyHtml);
    });
  </script>
</body>
</html>


