<?php 
require_once('./php/config.php');
session_start(); 


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fédération de Judo</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Boostrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Maven+Pro&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
   <!-- NavBar -->
   <nav class="navbar navbar-expand-lg navbar-dark ">
    <div class="container-fluid">
        <img class="logo" src="./ressources/logo.png" alt="" width="100" height="100">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link " aria-current="#" href="index.php">Accueil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " aria-current="#" href="club_list.php">Différents Club</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " aria-current="#" href="#">Contact</a>
            </li>
        </ul>
        <ul class="d-grid gap-2 d-md-flex justify-content-md-end marker">
            <? if(isset($_SESSION['id']) && $_SESSION['rank'] == 0){ ?>
            <li class="nav-item justify-content-end">
                <a class="nav-link" aria-current="#" href="user/profil.php">Profil</a>
            </li>
            <li class="nav-item">
                    <a class="nav-link " aria-current="#" href="php/logout.php">Déconnexion</a>
            </li>
            <? }elseif(isset($_SESSION['id']) && $_SESSION['rank'] == 1){ ?>
            <li class="nav-item">
                <a class="nav-link" aria-current="#" href="club/p_club.php">Gérer le club</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="#" href="php/logout.php">Déconnexion</a>
            </li>
            <? }elseif(isset($_SESSION['id']) && $_SESSION['rank'] == 2){ ?>
            <li class="nav-item">
                <a class="nav-link" aria-current="#" href="federation/user_manag.php">Back Office</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="#" href="php/logout.php">Déconnexion</a>
            </li>
            <? }else{ ?>
            <li class="nav-item justify-content-end">
                <a class="btn btn-primary" href="login.php" role="button">Se connecter</a>
            </li>
            <li class="nav-item justify-content-end">
                <a class="btn btn-primary" href="register.php" role="button">S'enregistrer</a>
            </li>
            <? } ?>
        </ul>
    </div>
  </div>
</nav>
<main style="display:block;margin:0 auto;">
<form class="row justify-content-center" method="post">
        <div class="col-md-8 p-5">
            <h1>Formulaire de contact</h1>
            <label for="exampleFormControlInput1" class="form-label">Nom</label>
            <input type="text" class="form-control" name="nom" id="exampleFormControlInput1" placeholder="">
            
            <label for="exampleFormControlInput1" class="form-label">Prénom</label>
            <input type="text" class="form-control" name="prenom" id="exampleFormControlInput1" placeholder="">
            
            <label for="exampleFormControlInput1" class="form-label">Société</label>
            <input type="text" class="form-control" name="societe" id="exampleFormControlInput1" placeholder="">
            
            <label for="exampleFormControlInput1" class="form-label">Adresse Mail</label>
            <input type="email" class="form-control" name="email" id="exampleFormControlInput1" placeholder="name@example.com">
            
            <label for="exampleFormControlInput1" class="form-label">N° de Téléphone</label>
            <input type="text" class="form-control" name="telephone" id="exampleFormControlInput1" placeholder="+ 32 234 567 88">
            
            <label for="exampleFormControlTextarea1" class="form-label">Question</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="question"></textarea>
            
            <input class="btn btn-primary" type="submit" value="Envoyer">
        </div>
    </form>

            <!-- <button type="button" class="btn btn-primary">Vous avez une question? Contactez-nous ici!</button> -->
            <div class="p-5">
            <div class="container-fluid">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2542.9184290872363!2d4.436944216102184!3d50.4053577794692!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c226759b15803b%3A0xcc51f879d97b9c78!2sSq.%20des%20Martyrs%2C%206000%20Charleroi!5e0!3m2!1sfr!2sbe!4v1652255917482!5m2!1sfr!2sbe" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            </div>

</main>
<!-- Footer -->
<footer>Prototype créé par Mattias, Enzo, Thomas et Mateo. </footer>
  <!-- JS Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>