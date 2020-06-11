<?php

    $actionVehicule = execRequete("SELECT vehicule.*,  agences.titre as agence_titre FROM agences INNER JOIN vehicule ON vehicule.id_agence=agences.id_agence");
    $actionVehicule = $actionVehicule -> fetchAll(); 



?>


<div class="container d-flex flex-row-reverse">
    <div class="form-group col-sm-4 col-md-3 col-lg-2">
        <label class="my-1 mr-2 font-weight-bold" for="prix">Filtres</label>
            <select class="form-control custom-select mr-sm-2" id="filtr" name="prix" required>
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
                    <script type="text/javascript">
                        function connexion() {alert('Connectez ou inscrivez-vous');}
                    </script>
                    <button onclick="connexion()" class="btn btn-success">Réserver et Payer</button></a>
            <?php else : ?>
            <a href="<?= RACINE_SITE.'/membre/location_membre.php?loc=location&id='. $value['id_vehicule'].'&id_agence='.$value['id_agence'] ?>"><button  class="btn btn-success">Réserver et Payer</button></a>
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>