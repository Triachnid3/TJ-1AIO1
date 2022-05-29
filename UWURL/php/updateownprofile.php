<?php
    session_start();
    require_once('connect.php');
    if($_POST){
        if(isset($_POST['username']) && !empty($_POST['username'])
        && isset($_POST['email']) && !empty($_POST['email'])
        ){
            $id = $_SESSION['id'];
            $username = strip_tags($_POST['username']);
            $email = strip_tags($_POST['email']);

            try {
                $query = "UPDATE `users` SET `username`=:username, `email`=:email, modifieddate=now(), modifieruser=:modifieruser WHERE `id`=:id";
                $stmt = $db->prepare($query);
                $stmt->bindValue(':username', $username, PDO::PARAM_STR);
                $stmt->bindValue(':email', $email, PDO::PARAM_STR);
                $stmt->bindValue(':modifieruser', $id, PDO::PARAM_STR);
                $stmt->bindValue(':id', $id, PDO::PARAM_STR);
                $stmt->execute(); 
                // echo $fname. ' ' .$lname. ' ' .$email. ' ' .$id;
                // echo ' Uptade réalisée';
                $_SESSION['message'] = "Mise à jour effectuée!";
                header('Location: ../user/profil.php');
            } catch (PDOException $e) {
                echo "Erreur : ".$e->getMessage();
              }
        }else{
            $_SESSION['erreur'] = "Le formulaire est vide!";
            header('Location: ../user/profil.php');
        }
    }
?>
