<?php
    require('../inc/modele.php');

    $commandes = execRequete("SELECT c.id_commande, m.id_membre, v.id_vehicule, v.id_agence, c.date_heure_depart, c.date_heure_fin, c.prix_total, c.date_enregistrement FROM (membre m INNER JOIN commande c ON m.id_membre=c.id_membre) INNER JOIN vehicule v ON c.id_vehicule=v.id_vehicule GROUP BY c.id_commande, m.id_membre, v.id_vehicule, v.id_agence, c.date_heure_depart, c.date_heure_fin, c.prix_total, c.date_enregistrement;  ");

    $commandes = $commandes -> fetchAll();



?>


<?php
    require('../inc/header.php');
?>

    <div class="container">
        <table class="table table-bordered table-striped table-responsive">
            <thead class="thead-dark">
                <tr>
                    <th>Commande</th>
                    <th>Membre</th>
                    <th>Vehicule</th>
                    <th>Agence</th>
                    <th>date_heure_depart</th>
                    <th>date_heure_fin</th>
                    <th>prix_total</th>
                    <th>date_enregistrement</th>
                    <th>Actions</th>
                </tr>
            </thead> 
            <?php foreach ($commandes as $key => $value): ?>
                <tr>
                    <td><?= $value['id_commande']; ?></td>
                    <td><?= $value['id_membre']; ?></td>
                    <td><?= $value['id_vehicule']; ?></td>
                    <td><?= $value['id_agence']; ?></td>
                    <td><?= $value['date_heure_depart']; ?></td>
                    <td><?= $value['date_heure_fin']; ?></td>
                    <td><?= $value['prix_total']; ?></td>
                    <td><?= $value['date_enregistrement']; ?></td>                    
                    <td><i class="fas fa-search"></i><a href="?modif=modification&id=<?= $value['id_agence']; ?>"> <i class="far fa-edit" style="color:black;"></i></a>
                        <a href="?supp=suppression&id=<?= $value['id_agence']; ?>"> <i class="fas fa-trash-alt" style="color:black;"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <hr>


    <h3 class="text-center">formulaire Ajout / Modification Commande</h3>
 

    <div class="container">
        <form action="" class="formulaire" method="post">
            <input type="hidden" name="id_membre" required value="<?= $membre_actuel['id_membre'] ?? 0 ?>">

            <div class="row">
                <div class="form-group col-md-5 col-lg-3">
                    <label class="my-1 mr-2 font-weight-bold" for="pseudo">Membre</label>
                    <div class="input-group">    
                        <div class="input-group-text mb-2"><i class="fas fa-user"></i></div>            
                        <input class="form-control mb-2 mr-sm-2" name="membre" placeholder="Membre" required
                               type="text" value="<?= $membre_actuel['pseudo'] ?? '' ?>">
                    </div>
                </div>  
                <div class="form-group col-md-0 col-1"></div>
                <div class="form-group col-md-5 col-lg-3">
                    <label class="my-1 mr-2 font-weight-bold" for="">Vehicule</label>
                    <div class="input-group">                    
                        <div class="input-group-text mb-2"><i class="fas fa-envelope"></i></div>
                            <input class="form-control mb-2 mr-sm-2" name="mail" placeholder="Vehicule"
                                   type="text" value="<?= $membre_actuel['email'] ?? '' ?>">
                    </div>
                </div>
                <div class="form-group col-md-0 col-1"></div>
                <div class="form-group col-md-5 col-lg-3">
                    <label class="my-1 mr-2 font-weight-bold" for="mdp">Agence</label>
                    <div class="input-group">
                        <div class="input-group-text mb-2"><i class="fas fa-envelope"></i></div>
                        <input class="form-control mb-2 mr-sm-2" name="mdp" placeholder="Agence"
                               type="text" value="<?= $membre_actuel['mdp'] ?? '' ?>">
                    </div>
                </div>
            </div>       

            <div class="row">


                <div class="form-group col-md-5 col-lg-5">
                    <label class="my-1 mr-2 font-weight-bold" for="date-input">Début</label>
                    <div class="input-group">
                        <input class="form-control" id="date_debut" min="<?= Date('Y-m-d'); ?>" max="" name="date_debut"
                               oninput="dateFin()" required type="date" value="">
                    </div>
                </div>
                <div class="form-group col-md-0 col-1"></div>

                <div class="form-group col-md-5 col-lg-5">
                    <label class="my-1 mr-2 font-weight-bold" for="date-input">Fin</label>
                    <div class="input-group">
                        <input class="form-control" id="date_fin" min="" max="" name="date_fin" required type="date" value="">
                        <script type="text/javascript">
                            function dateFin() {
                                var debut = document.getElementById('date_debut').value;
                                document.getElementById('date_fin').min = debut;
                            }
                        </script>
                    </div>
                    <div class="form-group col-sm-3 col-lg-2 modal-footer">
                        <input class="btn btn-primary" type="submit" value="Enregistrer">
                    </div>
                </div>
            </div>


        </form>
    </div>
