<?
    session_start();
    require_once('../php/config.php');
    if($_SESSION['rank'] == 2 && $_SESSION['id']){
        $rank = 'fédération';
        
    }else {
        $_SESSION['erreur'] = 'Vous n\'avez pas les droits pour accéder à cette page';
        header('Location: ../index.php');
    }
    //Request judokas info
    $query = $db->prepare('SELECT * FROM judokas');
    $query->execute();
    $judokas = $query->fetchAll();
    $query->closeCursor();
    //Request clubs info
    $query = $db->prepare('SELECT * FROM clubs');
    $query->execute();
    $clubs = $query->fetchAll();
    $query->closeCursor();
    //Request féderations info
    $query = $db->prepare('SELECT * FROM federations');
    $query->execute();
    $federations = $query->fetchAll();
    $query->closeCursor();

    
?>
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
    <link rel="stylesheet" href="../css/style.css">
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
                <a class="nav-link " aria-current="#" href="../contact.php">Contact</a>
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
<main style="width:80%;margin:0 auto;">
    <h1 class="my-3">Gestion des utilisateurs</h1>
        <a href="club_add" class="btn btn-dark">Ajouter un compte pour un club</a>
        <h2 class="my-3">Gestion des judokas</h2>
            <table class="judoka_manag table table-dark table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>N° de série</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Adresse e-mail</th>
                        <th>Adresse</th>
                        <th>N° de téléphone</th>
                        <th>Date de naissance</th>
                        <th>Sexe</th>
                        <th>Certificat médical</th>
                        <th>Vignette de mutuelle</th>
                        <th>Photo</th>
                        <th>Club</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($judokas as $judoka){
                    ?>
                    <tr>
                        <td><?= $judoka['id'] ?></td>
                        <td><?= $judoka['serial_number'] ?></td>
                        <td><?= $judoka['lastname'] ?></td>
                        <td><?= $judoka['firstname'] ?></td>
                        <td><?= $judoka['email'] ?></td>
                        <td><?= $judoka['address'].', '.$judoka['city'].', '.$judoka['zip'].', '.$judoka['country'] ?></td>
                        <td><?= $judoka['tel'] ?></td>
                        <td><?= $judoka['birthdate'] ?></td>
                        <td><?= $judoka['sex'] ?></td>
                        <td><? if($judoka['certif_path'] == NULL){echo 'Certificat indisponible';}else{echo '<a href="'.$judoka['certif_path'].'" target="_blank">Afficher</a>';}?></td>
                        <td><? if($judoka['mutuelle_path'] == NULL){echo 'Vignette de mutuelle indisponible';}else{echo '<a href="'.$judoka['mutuelle_path'].'" target="_blank">Afficher</a>';}?></td>
                        <td><? if($judoka['photo_path'] == NULL){echo 'Certificat indisponible';}else{echo '<a href="'.$judoka['photo_path'].'" target="_blank">Afficher</a>';}?></td>
                        <td>Club encore à faire</td>
                        <td><a href="user_manag.php?action=delete&id=<?= $judoka['id']?>">Supprimer</a> <a href="user_edit?id=<?= $judoka['id'] ?>">Modifier</a></td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        <h2 class="my-3">Gestion des clubs</h2>
            <table class="clubs_manag table table-dark table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom du club</th>
                        <th>Adresse e-mail</th>
                        <th>Adresse</th>
                        <th>N° de téléphone</th>
                        <th>Date de création</th>
                        <th>Logo du club</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($clubs as $club){
                    ?>
                    <tr>
                        <td><?= $club['id'] ?></td>
                        <td><?= $club['club_name'] ?></td>
                        <td><?= $club['email'] ?></td>
                        <td><?= $club['address'].', '.$club['city'].', '.$club['zip'] ?></td>
                        <td><?= $club['tel'] ?></td>
                        <td><?= $club['founding_date'] ?></td>
                        <td><? if($club['logo_club'] == NULL){echo 'Logo indisponible';}else{echo '<a href="'.$club['logo_club'].'" target="_blank">Afficher</a>';}?></td>
                        <td><a href="club_manag.php?action=delete&id=<?= $club['id']?>">Supprimer</a> <a href="club_edit?id=<?= $club['id'] ?>">Modifier</a></td>
                    </tr>
                    <?php
                        }
                    ?>
            </table>
</main>
<!-- Footer -->
<footer>Prototype créé par Mattias, Enzo, Thomas et Mateo. </footer>
</body>
</html>