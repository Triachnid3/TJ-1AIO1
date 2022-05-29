<?php 
session_start();
$id = $_SESSION['id'];
require_once('connect.php');

    if (isset($_GET['id']) && isset($_GET['rank'])) {
        $userid = $_GET['id'];
        $rank= $_GET['rank'];
        if ($rank > 0) {

            $query = "UPDATE users SET rank = 0, modifieddate=now(), modifieruser=:modifieruser where id=:id";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id', $userid, PDO::PARAM_STR);
            $stmt->bindValue(':modifieruser', $id, PDO::PARAM_STR);
            $stmt->execute();
            $_SESSION['message'] = 'Le compte séléctionné est passé au rang "Utilisateur"';
            header('Location: ../admin/admin.php');

        } else {

                $query = "UPDATE users SET rank = 1, modifieddate=now(), modifieruser=:modifieruser where id=:id";
                $stmt = $db->prepare($query);
                $stmt->bindParam(':id', $userid, PDO::PARAM_STR);
                $stmt->bindValue(':modifieruser', $id, PDO::PARAM_STR);
                $stmt->execute();
                $_SESSION['message'] = 'Le compte séléctionné est passé au rang "Administrateur"';
                header('Location: ../admin/admin.php');
        }
        
    } else {
        $_SESSION['erreur'] = 'Une erreur s\'est produite.';
        header('Location: ../admin/admin.php');
    }
    



?>