<?php

    require('../inc/modele.php');

        $membres = execRequete("SELECT * FROM membre");
        $membres = $membres -> fetchAll();


    /* Cas de suppression */

    if(isset($_GET['supp']) && $_GET['supp'] == 'suppression') {
        execRequete("DELETE FROM membre WHERE id_membre = ?", array($_GET['id']));
        header("location: ".RACINE_SITE."admin/g_membre.php");
    }

    /* Cas de  modification */

    if(isset($_GET['modif']) && $_GET['modif'] == 'modification' ) {
        $membre_actuel = execRequete("SELECT * FROM membre WHERE id_membre = ?", array($_GET['id']));

        $membre_actuel = $membre_actuel->fetch();
    } 


    

    /* cas ajout */

    if(isset($_POST['pseudo'])) {
        extract($_POST);
        
        
        // les paramètres doivent correspondre dans la table à modifier (membre)
        execRequete("REPLACE INTO membre (id_membre, pseudo, mdp, nom, prenom, email, civilite, statut, date_enregistrement) VALUES (:id_membre, :pseudo, :mdp, :nom, :prenom, :mail, :civilite, :statut, Now())",

            array("pseudo" => $pseudo,
                    "id_membre" => $id_membre,
                    "mdp" => md5($mdp),
                    "nom" => $nom,
                    "prenom" => $prenom,
                    "mail" => $mail,
                    "civilite" => $civilite,
                    "statut" => $statut ));

        header("location:" .RACINE_SITE."admin/g_membre.php"); // empeche de renvoyer les données la 2 eme fois, egalement
        //  ça nous pemet d'afficher instantanement les nouvelle données de la base
    }
    


    require('../inc/header.php');
?>
    <div class="container">
    <table class="table table-bordered table-hover table-primary table-responsive">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Pseudo</th>
                <th scope="col">Prénom</th>
                <th scope="col">Nom</th>
                <th scope="col">Email</th>
                <th scope="col">Civilité</th>
                <th scope="col">Statut</th>
                <th scope="col">Date enrégistrement</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($membres as $cle => $valeur): ?>
            <tr>
                <td><?= $valeur['pseudo'] ?></td>
                <td><?= $valeur['prenom'] ?></td>
                <td><?= $valeur['nom'] ?></td>
                <td><?= $valeur['email'] ?></td>
                <td><?= $valeur['civilite'] ?></td>
                <td><?= $valeur['statut'] ?></td>
                <td><?= $valeur['date_enregistrement'] ?></td>
                <td><i class="fas fa-search"> </i><a href="?modif=modification&id=<?= $valeur['id_membre'] ?>"> <i class="far fa-edit" style="color:black;"></i></a>
                    <a href="?supp=suppression&id=<?= $valeur['id_membre'] ?>"> <i class="fas fa-trash-alt" style="color:black;"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>


    <h3 class="text-center">formulaire Ajout / Modification Membre</h3>
 

    <div class="container">
        <form action="" method="post" class="formulaire">
            <input name="id_membre" required type="hidden" value="<?= $membre_actuel['id_membre'] ?? 0 ?>">

            <div class="row">
                <div class="form-group col-md-5 col-lg-5">
                <label class="my-1 mr-2 font-weight-bold" for="pseudo">Pseudo</label>
                    <div class="input-group">    
                        <div class="input-group-text mb-2"><i class="fas fa-user"></i></div>            
                        <input class="form-control mb-2 mr-sm-2" name="pseudo" placeholder="pseudo" required
                               type="text" value="<?= $membre_actuel['pseudo'] ?? '' ?>">
                    </div>
                </div>  
                <div class="form-group col-md-0 col-2"></div>
                <div class="form-group col-md-5 col-lg-5">
                <label class="my-1 mr-2 font-weight-bold" for="">Email</label>
                    <div class="input-group">                    
                        <div class="input-group-text mb-2"><i class="fas fa-envelope"></i></div>
                            <input class="form-control mb-2 mr-sm-2" name="mail" placeholder="Votre email" required
                                   type="email" value="<?= $membre_actuel['email'] ?? '' ?>">
                    </div>
                </div>
            </div>       

            <div class="row">
                <div class="form-group col-md-5 col-lg-5">               
                    <label class="my-1 mr-2 font-weight-bold" for="mdp">Mot de passe</label>
                    <div class="input-group">
                        <div class="input-group-text mb-2"><i class="fas fa-lock"></i></div>
                        <input class="form-control mb-2 mr-sm-2" name="mdp" placeholder="Votre password" required
                               type="password" value="<?= $membre_actuel['mdp'] ?? '' ?>">
                    </div>
                </div>
                <div class="form-group col-md-2 col-lg-2"></div>
                <div class="form-group col-sm-4 col-md-3 col-lg-2">
                    <label class="my-1 mr-2 font-weight-bold" for="civilite">Civilité</label>
                    <select class="form-control custom-select mr-sm-2" name="civilite" required>
                        <option value="">-- Choisir --</option>
                        <option value="m" <?= isset($membre_actuel['civilite']) && $membre_actuel['civilite'] == 'm' ? 'selected' : ''?>>Homme</option>
                        <option value="f" <?= isset($membre_actuel['civilite']) && $membre_actuel['civilite'] == 'f' ? 'selected' :''?>>Femme</option>  
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-5 col-lg-5">
                    <label class="my-1 mr-2 font-weight-bold" for="nom">Nom</label>
                    <div class="input-group">  
                        <div class="input-group-text mb-2"><i class="fas fa-pen"></i></div>                  
                        <input class="form-control mb-2 mr-sm-2" name="nom" placeholder="Nom" required
                               type="text" value="<?= $membre_actuel['nom'] ?? '' ?>">
                    </div>
                </div>
                <div class="form-group col-md-2 col-lg-2"></div>  
                <div class="form-group col-sm-4 col-md-3 col-lg-2">
                    <label class="my-1 mr-2 font-weight-bold" for="statut">Statut</label>
                        <select class="form-control custom-select mr-sm-2" name="statut" required>
                            <option value="">-- Choisir --</option>                  
                            <option value="0" <?= isset($membre_actuel['statut']) && $membre_actuel['statut'] == '0' ? 'selected' : ''?>>Client</option>  
                            <option value="1" <?= isset($membre_actuel['statut']) && $membre_actuel['statut'] == '1' ? 'selected' : ''?>>Admin</option>
                        </select>
                </div> 
            </div>

            <div class="row">
                <div class="form-group col-sm-5  col-lg-5">
                    <label class="my-1 mr-2 font-weight-bold" for="">Prénom</label>
                    <div class="input-group">   
                        <div class="input-group-text mb-2"><i class="fas fa-pen"></i></div>                 
                        <input class="form-control mb-2 mr-sm-2" name="prenom" placeholder="Votre prenom" required
                               type="text" value="<?= $membre_actuel['prenom'] ?? '' ?>">
                    </div>
                </div>
                <div class="form-group col-sm-2 col-lg-5"></div>
                <div class="form-group col-sm-3 col-lg-2 modal-footer">
                    <input class="btn btn-primary" type="submit" value="Enregistrer">
                </div>       
            </div>
        </form>
    </div>
