<?php
require('inc/modele.php');

    $actionVehicule = execRequete("SELECT vehicule.*,  a.id_agence as ida, a.titre as agence_titre FROM agences as a INNER JOIN vehicule ON vehicule.id_agence=a.id_agence");
    $actionVehicule = $actionVehicule -> fetchAll(); 


// var_dump($actionVehicule);

//  On a le header et le footer sur la meme page

include('inc/header.php');

//include('tmp/id_vehicule.php');
include('tmp/vehicule.php');



?>


<?php include('inc/footer.php'); ?>

<script crossorigin="anonymous"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script crossorigin="anonymous"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script crossorigin="anonymous"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


</body>
</html>

