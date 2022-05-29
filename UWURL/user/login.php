<?php
    session_start();
        if(isset($_POST['username']) && !empty($_POST['username'])
        && isset($_POST['password']) && !empty($_POST['password'])
        ){
            // On inclut la connexion à la base
            require_once('../php/connect.php');
            // On nettoie les données envoyées
            $username = strip_tags($_POST['username']);
            // On crypte les MDP
            $password = $_POST['password'];

            try {
                $query = "SELECT * from `users` where `username`=:username"; //password_verify($re_password, $password)
                $stmt = $db->prepare($query);
                $stmt->bindParam('username', $username, PDO::PARAM_STR);
                $stmt->execute();
                $count = $stmt->rowCount();
                $row   = $stmt->fetch(PDO::FETCH_ASSOC);
                if($count == 1 && !empty($row)) {
                    if (password_verify($password, $row['password'])) {
                        if ($row['isdeleted'] == 0) {
                            $_SESSION['id'] = $row['id'];
                            $_SESSION['username']   = $row['username'];
                            $_SESSION['rank'] = $row['rank'];
                            // echo $username . ' ' .$password. ' ' .$_SESSION['id']. ' ' .$_SESSION['username'] ;
                            header('Location: ../index.php');
                        } else {
                            $_SESSION['erreur'] = "Votre compte est désactivé, veuillez contacter un administrateur!";
                        }
                    } else {
                        $_SESSION['erreur'] = "Le mot de passe est invalide!";
                    }
                } else {
                    $_SESSION['erreur'] = "Le nom d'utilisateur n'existe pas!";
                  }
                } catch (PDOException $e) {
                  echo "Erreur : ".$e->getMessage();
                }
            }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <link rel="stylesheet" href="../CSS/link.css">
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
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

                <h1> Bienvenue sur UwUrl</h1>
                        <h2>Connexion</h2>
                <form method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Votre nom d'utilistateur</label>
                        <input type="username" id="username" name="username" class="form-control" placeholder="Entrez votre nom d'utilsateur..." required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Votre mot de passe</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Entrez votre mot de passe..." required>
                    </div>
                    <button type="submit" name="btn_submit" class="btn btn-login">Connexion</button>
                    <a class="btn btn-primary" href="register.php" role="button">Inscription</a>
                </form>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>