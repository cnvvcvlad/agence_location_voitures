<?php
    require('../inc/modele.php');

   // var_dump($_POST);


  if(isset($_POST)) {
    extract($_POST);

    $book = execRequete("INSERT INTO commande ( id_membre, id_vehicule, id_agence, date_heure_depart, date_heure_fin, prix_total, date_enregistrement) VALUES (:id_membre, :id_vehicule, :id_agence, :date_heure_depart, :date_heure_fin, :prix_total, Now())",
      array(
        "id_membre" => $id_mem,
        "id_vehicule" => $id_vehicule,
        "id_agence" => $id_agence,
        "date_heure_depart" => $date_debut,
        "date_heure_fin" => $date_fin,
        "prix_total" => $prix_ttc
      ));     

      // var_dump($book);
  }

  header("location:g_location.php");
?>