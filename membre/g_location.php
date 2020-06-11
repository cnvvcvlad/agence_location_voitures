<?php

    require('../inc/modele.php');

    $locVehicule = execRequete("SELECT c.id_commande, v.id_vehicule, v.id_agence, c.date_heure_depart, c.date_heure_fin, c.prix_total, m.statut, (DATEDIFF(c.date_heure_fin, c.date_heure_depart ) + 1) AS jours FROM (membre m INNER JOIN commande c ON m.id_membre=c.id_membre) INNER JOIN vehicule v ON v.id_vehicule = c.id_vehicule");
    $locVehicule = $locVehicule -> fetchAll();
     //var_dump($locVehicule);


?>

<?php
require('../inc/header.php');
?>
<div class="container">
    <table class="table table-bordered table-hover table-primary table-responsive">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Location</th>
                <th scope="col">Véhicule</th>
                <th scope="col">Agence</th>
                <th scope="col">Début</th>
                <th scope="col">Fin</th>
                <th scope="col">Prix total</th>
                <th scope="col">Nr de jours</th>
                <th scope="col">Statut</th>
                <th scope="col">Actions</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach($locVehicule as $cle => $valeur): ?>
            <tr>
                <td><?= $valeur['id_commande'] ?></td>
                <td><?= $valeur['id_vehicule'] ?></td>
                <td><?= $valeur['id_agence'] ?></td>
                <td><?= $valeur['date_heure_depart'] ?></td>
                <td><?= $valeur['date_heure_fin'] ?></td>
                <td><?= $valeur['prix_total'] ?></td>                
                <td><?= $valeur['jours'] ?></td>               
                <td><?= $valeur['statut'] ?></td>
                <td><i class="fas fa-search"> </i><a href="?modif=modification&id=<?= $valeur['id_commande'] ?>"> <i class="far fa-edit" style="color:black;"></i></a>
                    <a href="?supp=suppression&id=<?= $valeur['id_commande'] ?>"> <i class="fas fa-trash-alt" style="color:black;"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>

<script type="text/javascript" src="<?= RACINE_SITE.'utilities/js/datepicker.js' ?>"></script>

<?php

include('../tmp/vehicule.php');

require('../inc/footer.php');

?>