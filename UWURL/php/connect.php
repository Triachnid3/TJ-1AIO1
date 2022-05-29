<?php
try{
    // Connexion à la base
    $db = new PDO('mysql:host=localhost;dbname=iy2bt_uwurl', 'root', 'root');
    $db->exec('SET NAMES "UTF8"');
} catch (PDOException $e){
    echo 'Erreur : '. $e->getMessage();
    die();
}
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);