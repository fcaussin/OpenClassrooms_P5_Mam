// Objet Weather
var Weather = {
  iMorning:"",
  iAfternoon:"",
  dMorning:"",
  dAfternon:"",
  wMorning:"",
  wAfternoon:"",
  tMorning:"",
  tAfternoon:"",

  // Methode: INITIALISE LE COMPOSANT WEATHER
  initWeather: function(api) {
    Weather.displayWeather(api);
  },

  // METHODE: Afficher la météo
  displayWeather: function(api) {
    Weather.ajaxGet(api, function (reponse) {
      var datas = JSON.parse(reponse);

      // Récupère les données météo
      var apiDatas = datas.list;

      // Récupère le jour de la date de demain
      var dayOfTomorrow = new Date(Date.now() + 24*60*60*1000).getDate();

      // Récupère le jour de la date d'aujourd'hui
      var dayOfToday = new Date(Date.now()).getDate();

      // Pour chaque prévision météo
      apiDatas.forEach(function(apiData) {

        // Récupère le jour et l'heure de chaque prévision
        var day = new Date(apiData.dt*1000).getDate();
        var hour = new Date(apiData.dt*1000).getHours();

        console.log(day + " " + hour);

       // Si le jour correspond à demain
        if (day === dayOfTomorrow) {
          switch (hour) {
            case 8:
              // Récupère id de l'icone
              iMorning = apiData.weather[0].icon;
              // Récupère le temps prévu
              wMorning = apiData.weather[0].description;
              // Récupère la température prévue
              tMorning = apiData.main.temp;
              // Récupère la date et l'heure
              dMorning = new Date(apiData.dt*1000).toLocaleString();
              // Envoie le chemin de l'image
              var imgMorning = "img/" + iMorning + ".png";

              // Affiche les informations météo
              $('.iconMorning').attr('src', imgMorning);
              $('.dateMorning').text(dMorning);
              $('.tempMorning').text("Température : " + tMorning + " °C");
              $('.weatherMorning').text(wMorning);
            break;

            case 14:
              // Récupère id de l'icone
              iAfternoon = apiData.weather[0].icon;
              // Récupère le temps prévu
              wAfternoon = apiData.weather[0].description;
              // Récupère la température prévue
              tAfternoon = apiData.main.temp;
              // Récupère la date et l'heure
              dAfternoon = new Date(apiData.dt*1000).toLocaleString();
              // Envoie le chemin de l'image
              var imgAfternoon = "img/" + iAfternoon + ".png";

              // Affiche les informations météo
              $('.iconAfternoon').attr('src', imgAfternoon);
              $('.dateAfternoon').text(dAfternoon);
              $('.tempAfternoon').text("Température : " + tAfternoon + " °C");
              $('.weatherAfternoon').text(wAfternoon);
            break;
          }
        }
      });
    });
  },

  // METHODE: AJAX GET
  ajaxGet: function(url, callback) {
    var req = new XMLHttpRequest();
    req.open("GET", url);
    req.addEventListener("load", function (){
      if (req.status >= 200 && req.status < 400) {
        // Appelle la fonction callback en lui passant la réponse de la reqête
        callback(req.responseText);
      } else {
        console.error(req.status + " " + req.statusText + " " + url);
      }
    });
    req.addEventListener("error", function () {
      console.error("Erreur réseau avec l'URL " + url);
    });
    req.send(null);
  }
};
