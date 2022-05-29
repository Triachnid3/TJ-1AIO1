<?php
session_start();
//Détruit la session
session_destroy();
// On se déconnecte de la base
$db = null;

header('Location: ../user/login.php');