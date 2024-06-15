function renderweather(weather){
    console.log(weather);
 var resultsContainer = document.querySelector("#weather-results")

/* var wind = document.createElement("h7");
 wind.textContent = "vento attuale: "+weather.wind.speed+" m/s";
 resultsContainer.append(wind);*/

 var wind = document.createElement("h7");
 wind.textContent = "vento attuale: "+(weather.wind.speed* 3.6).toFixed(2)+" km/h";
 resultsContainer.append(wind);

 details.append("")
}


    function fetchweather(query){
        var url ="https://api.openweathermap.org/data/2.5/weather?lat=45.58&lon=9.65&appid=6b92c576d7cce0187ce4f8292fbf0b1c";

        fetch(url)
        .then((response) => response.json())
        .then((data) => renderweather(data));

    }

	function dayforecast(forecast){
		document.querySelector('').innerHTML="";
		for(let i=0;i<5;i++){
			
		}
        for (let i = 0; i < myArray.length; i++) {
            console.log(myArray[i]);
        }
	}

    fetchweather();
