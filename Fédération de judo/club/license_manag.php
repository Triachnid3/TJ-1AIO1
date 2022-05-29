<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title>Fédération de Judo</title>
</head>
<body>
<!-- NavBar -->
<nav class="navbar navbar-expand-lg navbar-dark ">
    <div class="container-fluid">
        <img class="logo" src="../ressources/logo.png" alt="" width="100" height="100">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link " aria-current="#" href="../index.php">Accueil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " aria-current="#" href="../club_list.php">Différents Club</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " aria-current="#" href="#">Contact</a>
            </li>
        </ul>
        <ul class="d-grid gap-2 d-md-flex justify-content-md-end marker">
            <? if(isset($_SESSION['id']) AND $_SESSION['rank'] == 0){ ?>
            <li class="nav-item justify-content-end">
                <a class="nav-link" aria-current="#" href="profil.php">Profil</a>
            </li>
            <li class="nav-item">
                    <a class="nav-link " aria-current="#" href="../php/logout.php">Déconnexion</a>
            </li>
            <? }elseif(isset($_SESSION['id']) AND $_SESSION['rank'] == 1){ ?>
            <li class="nav-item">
                <a class="nav-link" aria-current="#" href="../club/p_club.php">Gérer le club</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="#" href="../php/logout.php">Déconnexion</a>
            </li>
            <? }elseif(isset($_SESSION['id']) AND $_SESSION['rank'] == 2){ ?>
            <li class="nav-item">
                <a class="nav-link" aria-current="#" href="../federation/user_manag.php">Back Office</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="#" href="../php/logout.php">Déconnexion</a>
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

<!-- Footer -->
<footer>Prototype créé par Mattias, Enzo, Thomas et Mateo. </footer>
</body>
</html>