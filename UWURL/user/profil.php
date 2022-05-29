<?php
session_start();
require_once('../php/connect.php');

    if(empty($_SESSION['id'])){
        $_SESSION['erreur'] = "Vous n'êtes pas connecté";
        header('Location: ../index.php');
    } else {

        $id = $_SESSION['id'];

        try {
            $query = "SELECT * from `users` where id=:id";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->rowCount();
            $row   = $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Erreur : ".$e->getMessage();
            }
                if($count == 1 && !empty($row)) {
                    $id   = $row['id'];
                    $username  = $row['username'];
                    $email= $row['email'];
                    $rank = $row['rank'];
                }else{
                    $_SESSION['erreur'] = "Erreur!";
                }
        }
    
// Theme
if (isset($_POST['dark']) && $_POST['dark'] = 'dark') {
    $theme = 'dark';
    setcookie('theme', 'dark');
}elseif (isset($_POST['default']) && $_POST['default'] = 'style') {
    $theme = 'style';
    setcookie('theme', 'style');
}    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon profil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <link rel="stylesheet" href="../CSS/link.css">
    <link href="<?php if(isset($theme)){echo '../CSS/'.$theme.'.css';}elseif($_COOKIE['theme']){echo '../CSS/'.$_COOKIE['theme'].'.css';}else{echo '../CSS/style.css';} ?>" rel="stylesheet" type="text/css"/>
</head>
<body>
    <nav>
        <h1><a href="../index.php"><img src="../ressources/logo.png" alt="logo UWUrl"></a></h1>
            <div class="link">
                <a href="../php/close.php" class="btn btn-primary">Se déconnecter</a>
                <a href="ownlink.php" class="btn btn-primary">Mes liens</a>   
                <a href="../index.php" class="btn btn-primary">Accueil</a> 
                <? if ($rank > 0) { echo '<a href="../admin/admin.php" class="btn btn-primary">Administration</a>';}?>      
            </div>
    </nav>

    <h2>Modifier vos informations</h2>

        <main class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                <?php
                        if(!empty($_SESSION['erreur'])){
                            echo '<div class="alert alert-danger" role="alert">
                                    '. $_SESSION['erreur'].'
                                </div>';
                            $_SESSION['erreur'] = "";
                        }
                    ?>
                    <?php
                        if(!empty($_SESSION['message'])){
                            echo '<div class="alert alert-success" role="alert">
                                    '. $_SESSION['message'].'
                                </div>';
                            $_SESSION['message'] = "";
                        }
                    ?>
                    <form action="../php/updateownprofile.php" method="POST">
                        <div class="mb-3">
                        <h3>Changer vos informations</h3>
                            <label for="username" class="form-label">Votre nom d'utilisateur</label>
                            <input type="text" id="username" name="username" class="form-control" value="<?= $username; ?>" placeholder="Entrez votre nom d'utilisateur…" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Votre email</label>
                            <input type="email" id="email" name="email" class="form-control" value="<?= $email; ?>" placeholder="Entrez votre adresse email…" required>
                        </div>
                        <button type="submit" name="btn_submit" class="btn_reload">Mettre à jour</button>
                    </form>
                    <form action="../php/changepass.php" method="POST">
                        <h3>Changer votre mot de passe</h3>
                        <div class="mb-3">
                            <label for="password" class="form-label">Votre mot de passe</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Entrez votre mot de passe…" required>
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">Votre nouveau mot de passe</label>
                            <input type="password" id="new_password" name="new_password" class="form-control" placeholder="Tapez votre nouveau mot de passe…" required>
                        </div>
                        <div class="mb-3">
                            <label for="re_new_password" class="form-label">Confirmer votre nouveau mot de passe</label>
                            <input type="password" id="re_new_password" name="re_new_password" class="form-control" placeholder="Confirmer votre nouveau mot de passe…" required>
                        </div>
                        <button type="submit" name="btn_submit" class="btn_reload">Mettre à jour</button>
                        <a class="btn btn-primary btn_back" href="../index.php" role="button">Retour à l'accueil</a>
                    </form>
                    </div>
                </div>
            </main>
    <div class="themebtn">
        <ul class="theme">
            <li>
                <form method="post" class="theme" id="default">
                    <input type="hidden" value="style" name="default">
                    <button type="submit"><i class="bi bi-sun"></i></button>
                </form>
            </li>
            <li>
                <form method="post" class="theme" id="dark">
                    <input type="hidden" value="dark" name="dark">
                    <button type="submit"><i class="bi bi-moon"></i></button>
                </form>
            </li>
        </ul>
    </div>
            <footer>Raccourcisseur d'URL créé par Mattias, Enzo, Thomas et Mateo. </footer>
            
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="../Javascript/theme.js"></script>
</body>
</html>