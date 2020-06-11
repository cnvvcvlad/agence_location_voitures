<?php

    require('inc/modele.php');

// INSCRIPTION


    if( isset($_POST['pseudo'])) {

        extract($_POST); // on peut avoir accés à $pseudo, $nom ...

        $logExist = execRequete("SELECT * FROM membre WHERE pseudo = :login", ["login" => $pseudo]);

        $mailExist = execREquete("SELECT * FROM membre WHERE email = :email", ["email" => $email]);

        if($logExist->rowCount() != 0){
            echo "<div class='text text-center'> ce login existe déjà</div>";
        }
        if($mailExist->rowCount() != 0) {
          echo "<div class='text text-center'> ce email existe déjà</div>";
          } else {

        $query = ("REPLACE INTO membre (pseudo, mdp, nom, prenom, email, civilite, statut, date_enregistrement) VALUES(:pseudo, :mdp, :nom, :prenom, :mail, :civilite, 0, Now())"); // on est en position admin (1)

        $res = execRequete($query, array("pseudo" => $pseudo,
                                        "mdp" => md5($mdp),
                                        "nom" => $nom,
                                        "prenom" => $prenom,
                                        "mail" => $email,
                                        "civilite" => $civilite));


        $_SESSION['erreur'] = "<h3 class='inscription'>Inscription réussie</h3>";


      header("location: ".RACINE_SITE);
        }
    }

?>