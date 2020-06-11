<?php



function connect(){
    $pdo = new PDO("mysql:host=localhost;dbname=projet_sira","root","");
    array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND
    => 'SET NAMES utf8'); 
    return $pdo;

}

// INSCRIPTION


// CONNEXION 
function execRequete($req, $params = array()) {
    global $pdo; // globalisation de la variable pdo
	$res = $pdo-> prepare($req);

    if(!empty($params)){
        foreach ($params as $key => $value) {
            $params[$key] = htmlspecialchars($value);
        }
    }
    $res->execute($params);
    
	return $res;
}

function isConnected() {
    if(isset($_SESSION['membre']))
        return true;
    return false;
}

function isAdmin(){
    if(isConnected() && $_SESSION['membre']['statut'] == 1)
        return true;
    return false;
}





?>