<?php


    // liste de vehicules par ordre croissant ou decroissant
    if( isset($_GET['action']) && $_GET['action'] == 'filtre') {
        $vehicules = execRequete("SELECT v.* a.titre as titreageance FROM vehicule v INNER JOIN  agences a ON v.id_agence = a.id_agence ORDER BY v.prix_journalier".$_GET['ordre']);
}



    $actionVehicule = execRequete("SELECT vehicule.*,  agences.titre as agence_titre FROM agences INNER JOIN vehicule ON vehicule.id_agence=agences.id_agence");
    $actionVehicule = $actionVehicule -> fetchAll();

?>


<div class="container d-flex flex-row-reverse">
    <div class="form-group col-sm-4 col-md-3 col-lg-2">
        <label class="my-1 mr-2 font-weight-bold" for="prix">Filtres</label>
            <select class="form-control custom-select mr-sm-2" id="filtre" name="prix" required>
                <option value="">-- Choisir --</option>                  
                <option href="<?= RACINE_SITE?>?action=filtre&ordre=asc#filtre">Prix Croissant</option>
                <option href="<?= RACINE_SITE?>?action=filtre&ordre=desc#filtre">Prix Décroissant</option>
            </select>            
    </div> 
</div>



<div class="container">

    <?php foreach($actionVehicule as $value): ?>
    <div class="row">
        <div class="col-6">
            <img width=80% src="<?= RACINE_SITE.'/utilities/img/'. $value['photo']; ?>" alt="photo voiture">
        </div>
        <div class="col-6">
            <h3><?= $value['titre']; ?> </h3>
            <h4><?= $value['description']; ?></h4>
            <h4><?= 'Agence de '. $value['agence_titre']; ?></h4>
            <h4><?= $value['prix_journalier'].'€/jour'; ?></h4>
                <?php if(!isset($_SESSION['membre'])) : ?>
                <a href="<?= RACINE_SITE.'index.php' ?>">                    
                <button onclick="connexion()" class="btn btn-success">Réserver et Payer</button></a>
                <?php else : ?>
            <a href="<?= RACINE_SITE.'/membre/location_membre.php?loc=location&id='. $value['id_vehicule'].'&idagence='.$value['id_agence'] ?>"><button  class="btn btn-success">Réserver et Payer</button></a>
            
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<script src="<?=RACINE_SITE. 'utilities/js/fonction.js' ?>" type="text/javascript"></script>