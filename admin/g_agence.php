<?php

    require('../inc/modele.php');


    $agences = execRequete("SELECT * FROM agences");
    $agences = $agences -> fetchAll();    


    /* Cas de suppression */


    if(isset($_GET['supp']) && $_GET['supp'] == 'suppression') {
        /* Avant de supprimer une agence on met la condition de tranférer les véhicules */
        $actionVehicule = execRequete("SELECT id_vehicule  FROM vehicule WHERE id_agence = ?", array($_GET['id']));
        $actionVehicule = $actionVehicule -> fetchAll();   

        if (count($actionVehicule) != 0) {
            echo('<h3>Veuillez transférer les véhicules dans une autre agence!</h3>');
            
        }if (count($actionVehicule) == 0) {
            execRequete("DELETE FROM agences WHERE id_agence = ?", array($_GET['id']));
            header("location: ".RACINE_SITE."admin/g_agence.php");
        }
    }

    /* Cas de  modification */

    if(isset($_GET['modif']) && $_GET['modif'] == 'modification' ) {
        $agence_actuel = execREquete("SELECT * FROM agences WHERE id_agence = ?", array($_GET['id']));

        $agence_actuel = $agence_actuel->fetch();
    } 


    /* cas ajout */

    if(isset($_POST['titre'])) {
        if(isset($_POST['change'])) // Condition pour utiliser la photo actuelle de l'agence
            $nom_photo = $_POST['change'];
            extract($_POST);

        if(isset($_FILES['photo'])) {
            if($_FILES['photo']['size'] <= 1000000) {
                $extension = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];
                $info = pathinfo($_FILES['photo']['name']);
                $extension_up = $info['extension'];

                if(in_array($extension_up, $extension)) {
                    $dateEnrPhoto = Date("d_m_Y_h_i_s");
                    $nom_photo = $dateEnrPhoto.'_'. basename($_FILES['photo']['name']); // nouvelle insertion de l'image
                    $root = $_SERVER['DOCUMENT_ROOT'].RACINE_SITE.'utilities/img';
                    move_uploaded_file($_FILES['photo']['tmp_name'], $root.'/'.$nom_photo);
                }
            }
        }



        
        // les paramètres doivent correspondre dans la table à modifier (agences)
        execRequete("REPLACE INTO agences VALUES (:id_agence, :titre, :adresse, :ville, :cp, :description, :photo)",

            array(
                    "id_agence" => $id_agence,
                    "titre" => $titre,
                    "adresse" => $adresse,
                    "ville" => $ville,
                    "cp" => $cp,
                    "description" => $description,
                    "photo" => $nom_photo));

       header("location:" .RACINE_SITE."admin/g_agence.php");  //empeche de renvoyer les données la 2 eme fois, egalement 
        // ça nous pemet d'afficher instantanement les nouvelle données de la base
    }
    

?>





<?php
    require('../inc/header.php');
?>

    <div class="container">
        <table class="table table-bordered table-hover table-info table-responsive">
            <thead class="thead-dark">
                <tr>
                    <th>Agence</th>
                    <th>titre</th>
                    <th>adresse</th>
                    <th>ville</th>
                    <th>cp</th>
                    <th>description</th>
                    <th>photo</th>
                    <th>actions</th>
                </tr>
            </thead> 
            <?php foreach ($agences as $key => $value): ?>
                <tr>
                    <td><?= $value['id_agence']; ?></td>
                    <td><?= $value['titre']; ?></td>
                    <td><?= $value['adresse']; ?></td>
                    <td><?= $value['ville']; ?></td>
                    <td><?= $value['cp']; ?></td>
                    <td><?= $value['description']; ?></td>
                    <td><img alt="image agence" width="100" height="100" src= "<?= RACINE_SITE.'/utilities/img/'. $value['photo']; ?>"></td>
                    <td><i class="fas fa-search"></i><a href="?modif=modification&id=<?= $value['id_agence']; ?>"> <i class="far fa-edit" style="color:black;"></i></a>
                        <a href="?supp=suppression&id=<?= $value['id_agence']; ?>"> <i class="fas fa-trash-alt" style="color:black;"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>        
        </table>
    </div>
    <hr>

    <!-- Formulaire Gestion Agence -->
   <h3 class="text-center">formulaire Ajout / Modification Agence</h3>


    <div class="container">
        <form action="" method= "post" class="formulaire" enctype="multipart/form-data">            
            <input type="hidden" name="id_agence" value="<?= $agence_actuel['id_agence'] ?? 0 ?>">

            <div class="row">
                <div class="form-group col-md-5 col-lg-5">
                    <label class="my-1 mr-2 font-weight-bold" for="titre">Titre</label>
                    <div class="input-group">
                        <input class="form-control mb-2 mr-sm-2" name="titre" placeholder="Titre de l'agence"
                               type="text" value="<?= $agence_actuel['titre'] ?? '' ?>">
                    </div>
                </div>
                <div class="form-group col-md-0 col-2"></div>
                <div class="form-group col-md-5 col-lg-5">
                    <label  class="my-1 mr-2 font-weight-bold" for="adresse">Adresse</label>
                    <div class="input-group">
                        <input class="form-control mb-2 mr-sm-2" name="adresse"
                               placeholder="Adresse de l'agence" type="text"
                               value="<?= $agence_actuel['adresse'] ?? '' ?>">
                    </div>
                </div>
            </div>        
        
            <div class="row">
                <div class="form-group col-md-5 col-lg-5">
                    <label class="my-1 mr-2 font-weight-bold" for="description">Description</label>
                    <div class="input-group">
                        <textarea class="form-control" id="description" name="description" rows="2" value=""><?= $agence_actuel['description'] ?? '' ?></textarea>
                    </div>
                </div>
                <div class="form-group col-md-0 col-2"></div>
                <div class="form-group col-md-5 col-lg-5">
                    <label class="my-1 mr-2 font-weight-bold" for="ville">Ville</label>
                    <input class="form-control mb-2 mr-sm-2" name="ville" placeholder="Ville"
                           type="text" value="<?= $agence_actuel['ville'] ?? '' ?>">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-5 col-lg-5">
                    <label class="my-1 mr-2 font-weight-bold" for="photo">Photo</label>
                    <div class="input-group">
                    <i class="fas fa-camera" style="font-size:31px;"></i>                    
                        <input name="photo" type="file" value="">
                    </div>
                        <!-- Condition pour utiliser la photo actuelle de l'agence -->
                        <?php if(isset($agence_actuel['photo'])):  ?>
                            <input name="change" type="hidden" value="<?=$agence_actuel['photo'] ?>">
                            <img alt="image agence" height="100"
                                 src="<?= (RACINE_SITE . '/utilities/img/' . $agence_actuel['photo']) ?? '' ?>"
                                 width="100">
                        <?php endif;?>
                </div>
                
                <div class="form-group col-md-0 col-2"></div>
                <div class="form-group col-md-5 col-lg-5">
                    <label class="my-1 mr-2 font-weight-bold" for="ville">Code Postal</label>
                    <input class="form-control mb-2 mr-sm-2" name="cp" placeholder="Code postal"
                           type="text" value="<?= $agence_actuel['cp'] ?? '' ?>">
                </div>
            </div>

            <div class="row">
                <div class="modal-footer form-group col-sm-3 col-md-5 col-lg-7">
                    <input class="btn btn-primary" type="submit" value="Enregistrer">
                </div>
            </div>
        </form>
    </div>
