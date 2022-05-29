<?php  
require_once ('./php/config.php');
if($_POST){
    if(isset($_POST['email']) && !empty($_POST['email'])
    && isset($_POST['password']) && !empty($_POST['password'])) {
        //nettoyage des variables
        $email = strip_tags($_POST['email']);
        $password = strip_tags($_POST['password']);
        // On vérifie si l'adress email existe dans la table judoka
        $judokareq = $db->prepare('SELECT * FROM judokas WHERE email = :email');
        $judokareq->bindValue(':email', $email, PDO::PARAM_STR);
        $judokareq->execute();
        $judoka = $judokareq->fetch();
        $judokarow = $judokareq->rowCount();
        // On vérifie si l'adress email existe dans la table club
        $clubreq = $db->prepare('SELECT * FROM clubs WHERE email = :email');
        $clubreq->bindValue(':email', $email, PDO::PARAM_STR);
        $clubreq->execute();
        $club = $clubreq->fetch();
        $clubrow = $clubreq->rowCount();
        // On vérifie si l'adress email existe dans la table federation
        $federationreq = $db->prepare('SELECT * FROM federations WHERE email = :email');
        $federationreq->bindValue(':email', $email, PDO::PARAM_STR);
        $federationreq->execute();
        $federation = $federationreq->fetch();
        $federationrow = $federationreq->rowCount();
    
            if($judokarow == 1) {
                if(password_verify($password, $judoka['password'])) {
                    session_start(); 
                    $_SESSION['id'] = $judoka['id'];
                    $_SESSION['rank'] = 0;
                    $_SESSION['message'] = 'Vous êtes connecté !';
                    header('Location: index.php');
                } else {
                    $_SESSION['erreur'] = 'Votre mot de passe est incorrect';
                }
            } elseif($clubrow == 1) {
                    if(password_verify($password, $club['password'])) {
                        session_start(); 
                        $_SESSION['id'] = $club['id'];
                        $_SESSION['rank'] = 1;
                        $_SESSION['message'] = 'Vous êtes connecté !';
                        header('Location: index.php');
                    } else {
                        $_SESSION['erreur']  = 'Votre mot de passe est incorrect';
                    }
            } elseif($federationrow == 1) {
                    if(password_verify($password, $federation['password'])) {
                        session_start(); 
                        $_SESSION['id'] = $federation['id'];
                        $_SESSION['rank'] = 2;
                        $_SESSION['message'] = 'Vous êtes connecté !';
                        header('Location: index.php');
                    } else {
                        $_SESSION['erreur']  = 'Votre mot de passe est incorrect';
                    }
            } else {
                $_SESSION['erreur'] = 'Votre adresse email n\'existe pas';
            }
        } else {
            $_SESSION['erreur'] = 'Veuillez remplir tous les champs';
        }
    }
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
    <link rel="stylesheet" href="./css/style.css">
    <title>Fédération de Judo</title>
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
            <? if(isset($_SESSION['id']) AND $_SESSION['rank'] == 0){ ?>
            <li class="nav-item justify-content-end">
                <a class="nav-link" aria-current="#" href="user/profil.php">Profil</a>
            </li>
            <li class="nav-item">
                    <a class="nav-link " aria-current="#" href="php/logout.php">Déconnexion</a>
            </li>
            <? }elseif(isset($_SESSION['id']) AND $_SESSION['rank'] == 1){ ?>
            <li class="nav-item">
                <a class="nav-link" aria-current="#" href="club/p_club.php">Gérer le club</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="#" href="php/logout.php">Déconnexion</a>
            </li>
            <? }elseif(isset($_SESSION['id']) AND $_SESSION['rank'] == 2){ ?>
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
    <h1>Login</h1>
    <?php 
        if (isset($_SESSION['erreur'])) {
            echo '<div class="alert alert-danger" role="alert">'.$_SESSION['erreur'].'</div>';
            unset($_SESSION['erreur']);
        }
        if (isset($_SESSION['message'])) {
            echo '<div class="alert alert-success" role="alert">'.$_SESSION['message'].'</div>';
            unset($_SESSION['message']);
        }
    ?>	
    <form method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Votre adresse mail</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Entrez votre email..." required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Votre mot de passe</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Entrez votre mot de passe..." required>
        </div>
        <button type="submit" name="btn_submit" class="btn btn-primary">Connexion</button>
        <a class="btn btn-primary" href="register.php" role="button">Inscription</a>
    </form>
    <!-- Footer -->
<footer>Prototype créé par Mattias, Enzo, Thomas et Mateo. </footer>
</body>
</html>