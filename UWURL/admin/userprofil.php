<?php
session_start();
    if(empty($_SESSION['id'])) {
        $_SESSION['erreur'] = "Veuillez vous connecter avant de rejoindre le site" ;
        header('Location: ../user/login.php');
    }else{
        if ($_SESSION['rank'] < 1) {
            $_SESSION['erreur'] = "Vous n'avez pas la permission de vous rendre dans l'administration. Si vous pensez que c'est une erreur, veuillez contacter l'un des administrateurs du site" ;
            header('Location: ../index.php');
        } else {
            $id = $_SESSION['id'];
        }
    }


    require_once('../php/connect.php');

    $userid = $_GET['id'];
        try {
            $query = "SELECT * from `users` where id=:userid";
            $sql = $db->prepare($query);
            $sql->bindParam(':userid', $userid, PDO::PARAM_STR);
            $sql->execute();
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Erreur : ".$e->getMessage();
            }
            $userid   = $row['id'];
            $username  = $row['username'];
            $email= $row['email'];
            $rank = $row['rank'];
            $isdeleted = $row['isdeleted'];


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
    <title>Profil de l'utilisateur</title>
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
                <a href="../user/profil.php" class="btn btn-primary">Profil</a>  
                <a href="../user/ownlink.php" class="btn btn-primary">Mes liens</a>   
                <a href="../index.php" class="btn btn-primary">Accueil</a>
                <a href="admin.php" class="btn btn-primary">Administration</a>  
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

                    <form action="../php/useredit.php" method="POST">
                        <div class="mb-3">
                        <h3>Changer les informations de l'utilisateur : <?= $userid ?></h3>
                            <label for="username" class="form-label">Le nom d'utilisateur : </label>
                            <input type="text" id="username" name="username" class="form-control" value="<?= $username; ?>" placeholder="Entrez le nom d'utilisateur…" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">L'adresse e-mail : </label>
                            <input type="email" id="email" name="email" class="form-control" value="<?= $email; ?>" placeholder="Entrez l'adresse email…" required>
                        </div>
                        <div class="mb-3">
                            <label for="rank" class="form-label">Rang : </label>
                            <select name="rank" id="rank" required>
                                <option <?  if($rank == 0){ echo 'selected="selected"';}else{ echo '';}?> value="0">Utilisateur</option>
                                <option <?  if($rank == 1){ echo 'selected="selected"';}else{ echo '';}?> value="1">Administrateur</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="isdeleted" class="form-label">L'utilisateur est-il désactivé? </label>
                            <select name="isdeleted" id="isdeleted" required>
                                <option <?  if($isdeleted == 0){ echo 'selected="selected"';}else{ echo '';}?> value="0">Actif</option>
                                <option <?  if($isdeleted == 1){ echo 'selected="selected"';}else{ echo '';}?> value="1">Désactivé</option>
                            </select>
                        </div>
                        <input type="number" hidden value="<?= $userid ?>" name="id" id="id">
                        <button type="submit" name="btn_submit" class="btn btn-primary btn_reload">Mettre à jour</button>
                    </form>
                        <a class="btn btn-primary" href="admin.php" role="button">Retour à l'administration</a>
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