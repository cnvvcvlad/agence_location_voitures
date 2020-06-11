<?php
    require('../inc/modele.php');
?>

<?php
    include('../inc/header.php');

        if(isset($_GET['loc']) && $_GET['loc'] == 'location')  {
            $locationVehicule = execRequete("SELECT vehicule.*, agences.titre as agence_titre FROM agences INNER JOIN vehicule ON vehicule.id_agence = agences.id_agence WHERE id_vehicule = ?", array($_GET['id']));
            $locationVehicule = $locationVehicule -> fetchAll();  

        }
        
?>


<div class="container">
    <div class="text text-center"><h2 class="display-3">Récapitulatif</h2></div>

    <?php foreach($locationVehicule as $value): ?>
    
    <div class="row">
        <div class="col-4">
            <img width=80% src="<?= RACINE_SITE.'utilities/img/'. $value['photo']; ?>" alt="photo voiture">
            <div><span>Image non contractuelle</span></div>
        </div>
        <div class="col-4">
            <h3><?= $value['titre']; ?> </h3>
            <h4><?= $value['description']; ?></h4>
            <h4><?= 'Agence de '. $value['agence_titre']; ?></h4>
            <h4 ><?= $value['prix_journalier'].'€/jour'; ?></h4>
            
        </div>
        <div class="col-4">
            <form action="reserver_cmd.php" method="post">
            <fieldset>
            <legend>Réserver maintenant</legend>
                <input type="hidden" name='id_mem' value="<?= $_SESSION['membre']['id_membre'] ?>">
                <input type="hidden" name='id_vehicule' value="<?= $_GET['id'] ?>">
                <input type="hidden" name='id_agence' value="<?= $_GET['id_agence'] ?>">
                <input id="prix" type="hidden" name='prix_journalier' value="<?= $value['prix_journalier'] ?>" >
                <input class="prix_ttc" type="hidden" name='prix_ttc' value="">
                
                <div class="form-group row">
                <label for="date-input" class="col-2 col-form-label">Début</label>
                <div class="col-10">
                    <input class="form-control" id="date_debut" min="<?= Date('Y-m-d'); ?>" name="date_debut"
                           oninput="dateFin()" required type="date" value="">
                </div>
                </div>
                <div class="form-group row">
                <label class="col-2 col-form-label" for="date-input">Fin</label>
                <div class="col-10">
                    <input class="form-control" id="date_fin" min="" name="date_fin" required type="date" value="">                    
                </div>
                </div> 
                <strong><span class="prix_ttc" name="prix_ttc" value=""></span></strong><br>           
                <button class="btn btn-primary" type="submit">Valider</button>
            
            
            </fieldset>
            </form>
        </div>
    </div>
    
    <?php endforeach; ?>
</div>


<script src="../utilities/js/datepicker.js" type="text/javascript"></script>
<script src="<?= RACINE_SITE.'utilities/js/fonction.js' ?>" type="text/javascript"></script>



<?php
    include('../inc/footer.php');