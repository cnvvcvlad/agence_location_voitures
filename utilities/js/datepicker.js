/* variables */

var date_debut = document.getElementById('date_debut');
var date_fin = document.getElementById('date_fin');
var prix = document.getElementById('prix').value;

 console.log(prix);


/* FONCTIONS */

date_debut.addEventListener('change', function() {

    date_fin.disabled = false;

    date_fin.min = date_debut.value;

    date_fin.addEventListener('change', function(){
       var jours =  nbJour(date_debut.value, date_fin.value);


       document.getElementsByClassName('prix_ttc')[0].value =prix*jours;
       document.getElementsByClassName('prix_ttc')[1].innerHTML = jours + ' jours pour ' + prix*jours + "€";

    });
});


date_fin.addEventListener('focus', function() {
    var dateMax = new Date(date_debut.value);

    dateMax.setDate(dateMax.getDate() + 10);
    var d = dateMax.toJSON();
    date_fin.max = d.substring(0, 10);

    // console.Log(dateMax);
});

function nbJour(d1, d2) {
    var date1 = new Date(d1);
    var date2 = new Date(d2);


    return (date2 - date1)/86400000 + 1;
    //console.log((date2 - date1)/86400000 + 1); // calcul du nr de jours, obtient 1 pour 1 jour de reservation

}
