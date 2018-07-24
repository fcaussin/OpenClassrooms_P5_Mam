
$(document).ready(function(){
  $('.parallax').parallax();
  $('.sidenav').sidenav();
  $('.collapsible').collapsible();
  $('.modal').modal();
  $('select').formSelect();
  $('.datepicker').datepicker({
		format: 'dd-mm-yyyy',
    firstDay: 1,
    i18n: {
      cancel: "Annuler",
      months: ["Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre"],
      monthsShort: ["Jan", "Fev", "Mars", "Avr", "Mai", "Juin", "Juil", "Août", "Sept", "Oct", "Nov", "Dec"],
      weekdays: ["Dimanche","Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"],
      weekdaysShort: ["Dim","Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"],
      weekdaysAbbrev: ["D","L", "M", "M", "J", "V", "S"],
      today: 'Aujourd\'hui'
    }
  });
});

$('.dropdown-trigger').dropdown();
