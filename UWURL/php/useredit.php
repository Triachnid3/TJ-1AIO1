<?php
    session_start();
    if(empty($_SESSION['id'])) {
        $_SESSION['erreur'] = "Veuillez vous connecter avant de rejoindre le site" ;
        header('Location: ../user/login.php');
    }else{
        if ($_SESSION['id'] < 1) {
            $_SESSION['erreur'] = "Vous n'avez pas la permission de vous rendre dans l'administration. Si vous pensez que c'est une erreur, veuillez contacter l'un des administrateurs du site" ;
            header('Location: ../index.php');
        } else {
            $id = $_SESSION['id'];
        }
    }

    require_once('connect.php');

            $userid   = $_POST['id'];
            $username  = $_POST['username'];
            $email= $_POST['email'];
            $rank = $_POST['rank'];
            $isdeleted = $_POST['isdeleted'];   

            try {
                $query = "UPDATE `users` SET `username`=:username, `email`=:email, rank=:rank, isdeleted=:isdeleted, modifieruser=:modifieruser, modifieddate=now() WHERE `id`=:id";
                $stmt = $db->prepare($query);
                $stmt->bindValue(':username', $username, PDO::PARAM_STR);
                $stmt->bindValue(':email', $email, PDO::PARAM_STR);
                $stmt->bindValue(':rank', $rank, PDO::PARAM_STR);
                $stmt->bindValue(':isdeleted', $isdeleted, PDO::PARAM_STR);
                $stmt->bindValue(':modifieruser', $id, PDO::PARAM_STR);
                $stmt->bindValue(':id', $userid, PDO::PARAM_STR);
                $stmt->execute(); 
                // echo $username. ' ' .$email. ' ' .$rank. ' ' .$isdeleted. ' ' .$id. ' '. ' ' .$userid;
                // echo ' Uptade réalisée';
                $_SESSION['message'] = "Mise à jour effectuée!";
                header('Location: ../admin/userprofil.php?id='.$userid.'');
            } catch (PDOException $e) {
                echo "Erreur : ".$e->getMessage();
              }
?>