<?php
// On démarre une session
session_start();

if($_POST){
    if(isset($_POST['username']) && !empty($_POST['username'])
    && isset($_POST['email']) && !empty($_POST['email'])
    && isset($_POST['password']) && !empty($_POST['password'])
    && isset($_POST['re_password']) && !empty($_POST['re_password'])
    ){
        // On inclut la connexion à la base
        require_once('../php/connect.php');

        // On nettoie les données envoyées
        $username = strip_tags($_POST['username']);
        $email = strip_tags($_POST['email']);

        // On crypte les MDP
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $re_password = $_POST['re_password'];

        $mailverif = 'SELECT email FROM users WHERE email=:email;';
            $mail = $db->prepare($mailverif);
            $mail->bindValue(':email', $email, PDO::PARAM_STR);
            $mail->execute();
            $verifmail = $mail->fetch();

        $userverif = 'SELECT username FROM users WHERE username=:username;';
            $user = $db->prepare($userverif);
            $user->bindValue(':username', $username, PDO::PARAM_STR);
            $user->execute();
            $verifuser = $user->fetch();


        if (empty($verifmail)) {
            if (empty($verifuser)) {
                // On teste les MDP
                if (password_verify($re_password, $password)) {
            
                    $sql = 'INSERT INTO `users` (`username`, `email`, `password`) VALUES (:username, :email, :password);';

                    $query = $db->prepare($sql);
                    $query->bindValue(':username', $username, PDO::PARAM_STR);
                    $query->bindValue(':email', $email, PDO::PARAM_STR);
                    $query->bindValue(':password', $password, PDO::PARAM_STR);
                    $query->execute();
            
                    $_SESSION['message'] = "Votre compte a été créeé avec succès !";
                    header('Location: login.php');

                }else{
                    $_SESSION['erreur'] = "Les mots de passe ne correspondent pas";
                }
            } else {
                $_SESSION['erreur'] = "Le nom d'utilisateur existe déjà";
            }
        } else {
            $_SESSION['erreur'] = "L'adresse email existe déjà";
        }
    }else{
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <link rel="stylesheet" href="../CSS/link.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Inscription</title>
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
                <h1>Inscription</h1>
                <form method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Votre nom d'utilisateur</label>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Entrez votre nom d'utilisateur…" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Votre email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Entrez votre adresse email…" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Votre mot de passe</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Entrez votre mot de passe…" required>
                    </div>
                    <div class="mb-3">
                        <label for="re_password" class="form-label">Retapez votre mot de passe</label>
                        <input type="password" id="re_password" name="re_password" class="form-control" placeholder="Retapez votre mot de passe…" required>
                    </div>
                    <button type="submit" name="btn_submit" class="btn btn-primary btn-register">Inscription</button>
                    <a class="btn btn-primary" href="login.php" role="button">Connexion</a>
                </form>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>