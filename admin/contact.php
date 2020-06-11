<?php

    require('../inc/modele.php');

?>

<?php

    require('../inc/header.php');

?>

    <div class="container">
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="name" class="h4">Nom</label>
                <input class="form-control" id="" placeholder="Votre nom" required type="text">
            </div>
            <div class="form-group col-sm-6">
                <label class="h4" for="email">Email</label>
                <input class="form-control" id="" placeholder="Votre mail" required type="email">
            </div>
        </div>
        <div class="form-group">
            <label class="h4 " for="message">Message</label>
            <textarea class="form-control" id="" placeholder="Entrer le message" required rows="5"></textarea>
        </div>
        <button class="btn btn-success btn-lg pull-right " id="form-submit" type="submit">Submit</button>
    </div>



<?php
require('../inc/footer.php');

?>
