<?
require_once ('./php/config.php');
    if($_POST){
        if(isset($_POST['email']) && !empty($_POST['email'])
        && isset($_POST['password']) && !empty($_POST['password'])) {

            $query = $db->prepare('INSERT INTO federations (firstname, lastname, tel, email, password) VALUES (:firstname, :lastname, :tel, :email, :password)');
            $query->bindValue(':firstname', $_POST['firstname'], PDO::PARAM_STR);
            $query->bindValue(':lastname', $_POST['lastname'], PDO::PARAM_STR);
            $query->bindValue(':tel', $_POST['tel'], PDO::PARAM_STR);
            $query->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
            $query->bindValue(':password', password_hash($_POST['password'], PASSWORD_DEFAULT), PDO::PARAM_STR);
            $query->execute();
            $query->closeCursor();
            $_SESSION['message'] = 'Vous êtes inscrit !';
            header('Location: index.php');
        } else {
            $_SESSION['erreur'] = 'Veuillez remplir tous les champs';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- Create a form with input for firstname lastname tel email password -->
    <form action="form_fede.php" method="post">
        <input type="text" name="firstname" placeholder="Prénom">
        <input type="text" name="lastname" placeholder="Nom">
        <input type="number" name="tel" placeholder="Téléphone">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Mot de passe">
        <input type="submit" value="Envoyer">
    </form>
</body>
</html>