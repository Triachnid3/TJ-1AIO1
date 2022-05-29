<?php 
    // On inclut la connexion à la base
    require_once ('./php/config.php');
    /* On séléctionne les clubs pour pouvoir les boucler dans une selectbox */
    $reqclub = $db->prepare('SELECT * FROM clubs');
    $reqclub->execute();
    $clubs = $reqclub->fetchAll();

    if($_POST){
        if (isset($_POST['firstname']) && !empty($_POST['firstname'])
        && isset($_POST['lastname']) && !empty($_POST['lastname'])
        && isset($_POST['email']) && !empty($_POST['email'])
        && isset($_POST['password']) && !empty($_POST['password'])
        && isset($_POST['re_password']) && !empty($_POST['re_password'])
        && isset($_POST['address']) && !empty($_POST['address'])
        && isset($_POST['city']) && !empty($_POST['city'])
        && isset($_POST['zip']) && !empty($_POST['zip'])
        && isset($_POST['country']) && !empty($_POST['country'])
        && isset($_POST['tel']) && !empty($_POST['tel'])
        && isset($_POST['birthdate']) && !empty($_POST['birthdate'])
        ) {
            // On nettoie les données envoyées
            $firstname = strip_tags($_POST['firstname']);
            $lastname = strip_tags($_POST['lastname']);
            $email = strip_tags($_POST['email']);
            $address = strip_tags($_POST['address']);
            $city = strip_tags($_POST['city']);
            $zip = strip_tags($_POST['zip']);
            $country = strip_tags($_POST['country']);
            $tel = strip_tags($_POST['tel']);
            $birthdate = strip_tags($_POST['birthdate']);
            // On crypte les MDP
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $re_password = $_POST['re_password'];

            $mailverif = 'SELECT email FROM judokas WHERE email=:email';
                $mail = $db->prepare($mailverif);
                $mail->bindValue(':email', $email, PDO::PARAM_STR);
                $mail->execute();
                $verifmail = $mail->fetch();

            if (empty($verifmail)) {
                // On teste les MDP
                if (password_verify($re_password, $password)) {

                    $sql = 'INSERT INTO `judokas` (`firstname`, `lastname`, `email`, `password`, `address`, `city`, `zip`, `country`, `tel`, `birthdate`) 
                            VALUES (:firstname, :lastname, :email, :password, :address, :city, :zip, :country, :tel, :birthdate);';

                    $query = $db -> prepare($sql);
                    $query -> bindValue(':firstname', $firstname, PDO::PARAM_STR);
                    $query -> bindValue(':lastname', $lastname, PDO::PARAM_STR);
                    $query -> bindValue(':email', $email, PDO::PARAM_STR);
                    $query -> bindValue(':password', $password, PDO::PARAM_STR);
                    $query -> bindValue(':address', $address, PDO::PARAM_STR);
                    $query -> bindValue(':city', $city, PDO::PARAM_STR);
                    $query -> bindValue(':zip', $zip, PDO::PARAM_STR);
                    $query -> bindValue(':country', $country, PDO::PARAM_STR);
                    $query -> bindValue(':tel', $tel, PDO::PARAM_STR);
                    $query -> bindValue(':birthdate', $birthdate, PDO::PARAM_STR);
                    $query -> execute();
                    $_SESSION['message'] = 'Votre compte a bien été créé !';
                    header('Location: login.php');
                    // print_r($query);
                    // echo '<br>';
                    // echo $birthdate;
                } else {
                    $_SESSION['erreur'] = 'Les mots de passe ne correspondent pas';
                }
            } else { 
                $_SESSION['erreur'] = 'Cette adresse mail est déjà utilisée';
            }
        } else {
            $_SESSION['erreur'] = "Veuillez remplir tous les champs obligatoires !";
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
    <h1>Register</h1>
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
        <p class="required"><span class="red">*</span> = Champs obligatoires</p>

        <div class="mb-3">
            <label for="firstname" class="form-label">Prénom <span class="red">*</span></label>
            <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Entrez votre prénom…" required>
        </div>
        <div class="mb-3">
            <label for="lastname" class="form-label">Nom <span class="red">*</span></label>
            <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Entrez votre nom…" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Votre email <span class="red">*</span></label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Entrez votre adresse email…" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Votre mot de passe <span class="red">*</span></label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Entrez votre mot de passe…" required>
        </div>
        <div class="mb-3">
            <label for="re_password" class="form-label">Retapez votre mot de passe <span class="red">*</span></label>
            <input type="password" id="re_password" name="re_password" class="form-control" placeholder="Retapez votre mot de passe…" required>
        </div>
        <div class="mb-3">
            <label for="tel" class="form-label">Numéro de téléphone <span class="red">*</span></label>
            <input type="tel" pattern="+[0-9]{2}[0-9]{9}" id="tel" name="tel" class="form-control" placeholder="Entrez votre numéro de téléphone…" required>
        </div>
        <div class="mb-3">
            <label for="birthdate" class="form-label">Date de naissance <span class="red">*</span></label>
            <input type="date" id="birthdate" name="birthdate" class="form-control" placeholder="Entrez votre date de naissance…" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Adresse <span class="red">*</span></label>
            <input type="text" id="address" name="address" class="form-control" placeholder="Entrez votre adresse…" required>
        </div> 
        <div class="mb-3">
            <label for="city" class="form-label">Ville <span class="red">*</span></label>
            <input type="text" id="city" name="city" class="form-control" placeholder="Entrez votre ville…" required>
        </div> 
        <div class="mb-3">
            <label for="zip" class="form-label">Votre code postal <span class="red">*</span></label>
            <input type="text" id="zip" name="zip" class="form-control" placeholder="Entrez votre code postal…" required>
        </div> 
        <div class="mb-3">
            <label for="country" class="form-label">Pays <span class="red">*</span></label>
            <input type="text" id="country" name="country" class="form-control" placeholder="Entrez votre pays…" required>
        </div>
        <div class="mb-3">
            <label for="id_club" class="form-label">Votre club</label>
            <select name="id_club" id="id_club" class="form-control">
                <option value="">Choisissez votre club</option>
                    <?php
                    foreach($clubs as $club) {
                        echo '<option value="'.$club['id'].'">'.$club['club_name'].'</option>';
                    }
                    ?>
            </select>
        </div>
        
        <button type="submit" name="submit" class="btn btn-primary">S'inscrire</button>
        <a class="btn btn-primary justify-content-end" href="login" role="button">Se connecter</a>
    </form>
    <!-- Footer -->
<footer>Prototype créé par Mattias, Enzo, Thomas et Mateo. </footer>
</body>
</html>