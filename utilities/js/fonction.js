


/* FONCTIONS */

// Impossibilite de choisir une date de fin avant de celle de debut
function dateFin() {
    var debut = document.getElementById('date_debut').value;
    document.getElementById('date_fin').min = debut;
}


// Message de se connecter pour les visiteurs
function connexion() {
    alert('Connectez ou inscrivez-vous');
}