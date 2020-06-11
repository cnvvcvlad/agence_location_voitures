<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?=RACINE_SITE . 'utilities/css/style.css' ?>">
    <link rel="stylesheet" href="<?=RACINE_SITE . 'utilities/css/bootstrap/css/bootstrap.css' ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">


    <title>Accueil</title>
</head>
<body>
    <header>
        <div class="">
            <h1 class="text-center text-white">Bienvenue à bord</h1>
            <h3 class="text-center text-white">Location de vehicule 24/24 7j/7</h3>
        </div>

        <?php if(isConnected()): ?> <!-- Menu hamburger à faire-->
            <div class="text-center">
            <strong class="text-left text-white">Bonjour <?= $_SESSION['membre']['prenom']; ?></strong>
            <a href="<?= RACINE_SITE ?>"><button class="btn btn-warning">Accueil</button></a>
            <a href="<?= RACINE_SITE .'membre/g_location.php'?>"><button class="btn btn-warning">Mon Compte</button></a>
            <a href="<?= RACINE_SITE .'admin/contact.php'?>"><button class="btn btn-warning">Contactez-nous</button></a>


            <?php if(isAdmin()): ?> <!-- Menu hamburger à faire-->
                <a href="<?= RACINE_SITE .'admin/g_agence.php'?>"><button class="btn btn-info">Agence</button></a>
                <a href="<?= RACINE_SITE .'admin/g_vehicule.php'?>"><button class="btn btn-info">Véhicule</button></a>
                <a href="<?= RACINE_SITE .'admin/g_membre.php'?>"><button class="btn btn-info">Membre</button></a>
                <a href="<?= RACINE_SITE .'admin/g_cmde.php'?>"><button class="btn btn-info">Commandes</button></a>
                

            <?php endif; ?>
            <a href="<?= RACINE_SITE .'connexion.php?action=deconnect' ?>">
            <button class="btn btn-danger">Déconnexion</button></a>
            <?php else: ?>
            </div>
        <div class="text-center">        
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#Inscription" data-whatever="@mdo">Inscription</button>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#Connexion" data-whatever="@mdo">Connexion</button>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#Contact" data-whatever="@mdo">Contactez-nous</button>
            <?php endif; ?>

            <div class="modal fade" id="Inscription" tabindex="-1" role="dialog" aria-labelledby="InscriptionLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="InscriptionLabel">Inscription</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="<?= RACINE_SITE .'inscription.php'?>">
                                <div class="form-group">
                                    <input class="form-control" id="login" name="pseudo" placeholder="Login" required
                                           type="text">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" id="mdp" name="mdp" placeholder="Mot de passe" required
                                           type="password">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" id="nom" name="nom" placeholder="Nom" required
                                           type="text">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" id="prenom" name="prenom" placeholder="Prenom" required
                                           type="text">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" id="" name="email" placeholder="Email" required
                                           type="email">
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="civilite" required>
                                            <option value="">-- Choisir la civilité --</option>
                                            <option value="m">Homme</option>
                                            <option value="f">Femme</option>  
                                    </select>
                                </div>                                 
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-dismiss="modal" type="button">Fermer</button>
                                    <input class="btn btn-primary" type="submit" value="Enregistrer">
                                </div>
                            </form>                     
                        </div>
                    </div>
                </div>
            </div>

            <div aria-hidden="true" aria-labelledby="ConnexionLabel" class="modal fade" id="Connexion" role="dialog"
                 tabindex="-1">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ConnexionLabel">Connexion</h5>
                            <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= RACINE_SITE . 'connexion.php'?>" method="post">
                                <div class="form-group">
                                    <input class="form-control" name="login" placeholder="Login" type="text">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="mdp" placeholder="Mot de passe" type="password">
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-dismiss="modal" type="button">Fermer</button>
                                    <input class="btn btn-primary" type="submit" value="Valider">
                                </div>
                            </form>                     
                        </div>                   
                    </div>
                </div>
            </div>
            <div aria-hidden="true" aria-labelledby="ContactLabel" class="modal fade" id="Contact" role="dialog"
                 tabindex="-1">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ContactLabel">Contactez-nous</h5>
                            <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="#">
                                <div class="form-group">
                                    <label class="h4" for="name">Nom</label>
                                    <input class="form-control" id="name" placeholder="Votre nom" required type="text">
                                </div>
                                <div class="form-group">
                                    <label class="h4" for="email">Email</label>
                                    <input class="form-control" id="" placeholder="Votre email" required
                                           type="email">
                                </div>
                                <div class="form-group">
                                    <label class="h4 " for="message">Message</label>
                                    <textarea class="form-control" id="message" placeholder="Entrer le message" required
                                              rows="3"></textarea>
                                </div>
                                <div class="modal-footer">
                                    <input class="btn btn-primary" type="submit" value="Envoyer">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


    </header>

    <main>
        <?php
            if(isset($_SESSION['erreur'])){
                echo $_SESSION['erreur'];
                unset($_SESSION['erreur']); // on détruit la variable erreur
            }if (isset($_SESSION['inscription'])) {
                echo $_SESSION['inscription'];
                unset($_SESSION['inscription']); // détruit la variable inscription
            }
        ?>


        