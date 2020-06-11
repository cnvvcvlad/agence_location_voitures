<?php

    require('../inc/modele.php');

    //$choixAgence = execRequete("SELECT a.titre FROM agences AS a INNER JOIN vehicule AS v ON a.id_agence = v.id_vehicule");
    //$choixAgence = $choixAgence -> fetchAll();

    $agence = execRequete("SELECT * FROM agences");
    $agence = $agence -> fetchAll();

    $actionVehicule = execRequete("SELECT vehicule.*,  agences.titre as agence_titre FROM agences INNER JOIN vehicule ON vehicule.id_agence=agences.id_agence");
    $actionVehicule = $actionVehicule -> fetchAll();    


    /* Cas de suppression */

    if(isset($_GET['supp']) && $_GET['supp'] == 'suppression') {
        execRequete("DELETE FROM vehicule WHERE id_vehicule = ?", array($_GET['id']));
        header("location: ".RACINE_SITE."admin/g_vehicule.php");
    }


    /* Cas de  modification */

    if(isset($_GET['modif']) && $_GET['modif'] == 'modification' ) {
        $vehicule_actuel = execRequete("SELECT * FROM vehicule WHERE id_vehicule = ?", array($_GET['id']));

        $vehicule_actuel = $vehicule_actuel->fetch();
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
        execRequete("REPLACE INTO vehicule VALUES (:id_vehicule, :id_agence, :titre, :marque, :modele, :description, :photo, :prix_journalier)",

            array(
                    "id_vehicule" => $id_vehicule,
                    "id_agence" => $agence,
                    "titre" => $titre,
                    "marque" => $marque,
                    "modele" => $modele,                    
                    "description" => $description,
                    ":photo" => $nom_photo,
                    "prix_journalier" => $prix
                     ));

        header("location:" .RACINE_SITE."admin/g_vehicule.php");  //empeche de renvoyer les données la 2 eme fois, egalement 
        // ça nous pemet d'afficher instantanement les nouvelle données de la base
    }
    
?>

<?php
    require('../inc/header.php');
?>

    <div class="container">    
        <table class="table table-bordered table-hover table-success table-responsive">
            <thead class="thead-dark">
                <tr>
                    <th>vehicule</th>
                    <th>Agence</th>
                    <th>titre</th>
                    <th>marque</th>
                    <th>modèle</th>
                    <th>description</th>
                    <th>photo</th>
                    <th>prix</th>
                    <th>actions</th>
                </tr>
            </thead> 
            <?php foreach ($actionVehicule as $key => $value): ?>
                <tr>
                <!-- Les index doivent correspondre au noms de colonnes de la bdd -->
                    <td><?= $value['id_vehicule']; ?></td>
                    <td><?= $value['agence_titre']; ?></td>
                    <td><?= $value['titre']; ?></td> 
                    <td><?= $value['marque']; ?></td>
                    <td><?= $value['modele']; ?></td>
                    <td><?= $value['description']; ?></td>
                    <td><img alt="image vehicule" width="100px" height="100px" src= "<?= RACINE_SITE.'/utilities/img/'. $value['photo']; ?>"></td>
                    <td><?= $value['prix_journalier']; ?></td>
                    <td><i class="fas fa-search"></i><a href="?modif=modification&id=<?= $value['id_vehicule']; ?>"><i class="far fa-edit" style="color:black;"></i></a>
                        <a href="?supp=suppression&id=<?= $value['id_vehicule']; ?>"><i class="fas fa-trash-alt" style="color:black;"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>        
        </table>
    </div>
    <hr>

    <!-- Formulaire Gestion Agence -->
    <h3 class="text-center">formulaire Ajout / Modification Vehicule</h3>

    <div class="container">
        <form action="" method= "post" class="formulaire" enctype="multipart/form-data">            
        <input type="hidden" name="id_vehicule" value="<?= $vehicule_actuel['id_vehicule'] ?? 0 ?>">

            <div class="row">
                <div class="form-group col-md-5 col-lg-5">
                    <label for="agence"></label>            
                    <select required  name="agence" class="form-control" id="agence">
                    <option required value="">-- Choisir l'Agence --</option>
                    <?php foreach ($agence as $key => $valAgence): ?>
                        <option value="<?= $valAgence['id_agence'] ?>" <?= isset($vehicule_actuel['id_agence']) && $vehicule_actuel['id_agence'] == $valAgence['id_agence'] ? 'selected' : '' ?>><?="Agence de ".$valAgence['titre']; ?></option>                        
                    <?php endforeach; ?>  
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-5 col-lg-5">
                    <label class="my-1 mr-2 font-weight-bold" for="titre">Titre</label>
                    <div class="input-group">
                        <input class="form-control mb-2 mr-sm-2" name="titre" placeholder="Titre de l'annonce"
                               type="text" value="<?= $vehicule_actuel['titre'] ?? '' ?>">
                    </div>
                </div>
                <div class="form-group col-md-0 col-2"></div>
                <div class="form-group col-md-5 col-lg-5">
                    <label class="my-1 mr-2 font-weight-bold" for="photo">Photo</label>
                    <div class="input-group">
                        <i class="fas fa-camera" style="font-size:31px;"></i>                    
                        <input  type="file" name="photo">                        
                    </div>
                    <!-- Condition pour utiliser la photo actuelle de l'agence -->
                    <?php if(isset($vehicule_actuel['photo'])):  ?>
                        <input type="hidden" name="change" value="<?=$vehicule_actuel['photo'] ?>">
                        <img height="100px"
                             src="<?= RACINE_SITE . '/utilities/img/' . $vehicule_actuel['photo'] ?? '' ?>"
                             width="100px">
                    <?php endif;?>
                </div>                
            </div>        
        
            <div class="row">
                <div class="form-group col-md-5 col-lg-5">
                    <label  class="my-1 mr-2 font-weight-bold" for="marque">Marque</label>
                    <div class="input-group">
                        <input class="form-control mb-2 mr-sm-2" name="marque"
                               placeholder="Marque" type="text" value="<?= $vehicule_actuel['marque'] ?? '' ?>">
                    </div>
                </div>
                <div class="form-group col-md-0 col-2"></div>
                <div class="form-group col-md-5 col-lg-5">
                    <label class="my-1 mr-2 font-weight-bold" for="description">Description</label>
                    <div class="input-group">
                        <textarea class="form-control" id="description" name="description" rows="2" value=""><?= $vehicule_actuel['description'] ?? '' ?></textarea>
                    </div>
                </div>                
            </div>

            <div class="row">                
                <div class="form-group col-md-5 col-lg-5">
                    <label class="my-1 mr-2 font-weight-bold" for="ville">Modèle</label>
                    <input class="form-control mb-2 mr-sm-2" name="modele" placeholder="Modele"
                           type="text" value="<?= $vehicule_actuel['modele'] ?? '' ?>">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-5 col-lg-5">
                    <label class="my-1 mr-2 font-weight-bold" for="prix">Prix</label>
                    <input class="form-control mb-2 mr-sm-2" name="prix"
                           placeholder="Prix journalier" type="number"
                           value="<?= $vehicule_actuel['prix_journalier'] ?? '' ?>">
                </div>
            </div>
            <div class="row">
                <div class="modal-footer form-group col-sm-3 col-md-5 col-lg-7">
                    <input class="btn btn-primary" type="submit" value="Enregistrer">
                </div>
            </div>
        </form>
    </div>