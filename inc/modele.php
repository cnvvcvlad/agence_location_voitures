<?php
session_start();
    $pdo = new PDO('mysql:host=localhost;dbname=projet_sira', 'root', '',
                    [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);

    
    $pdo->exec("SET NAMES UTF8");

    define("RACINE_SITE", "/SIRA29.08.2019/"); // dossier à correspondre
    require_once("fonction.php");

?>