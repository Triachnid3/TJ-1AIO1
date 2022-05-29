<?php
    session_start();
    require_once('connect.php');
    if($_POST){
        if(isset($_POST['password']) && !empty($_POST['password'])
        && isset($_POST['new_password']) && !empty($_POST['new_password'])
        && isset($_POST['re_new_password']) && !empty($_POST['re_new_password'])
        ){
            $id = $_SESSION['id'];
            $newpass = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
            $renewpass = $_POST['re_new_password'];
            if (password_verify($renewpass, $newpass)) {
                try {
                    $query = "SELECT `password` from `users` where `id`=:id";
                    $stmt = $db->prepare($query);
                    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                    $stmt->execute();
                    $row   = $stmt->fetch(PDO::FETCH_ASSOC);
                    $dbpass = $row['password'];
                } catch (\Throwable $th) {
                    echo "Erreur : ".$e->getMessage();
                }
                        if (password_verify($_POST['password'], $dbpass)){
                            try {
                                $query = "UPDATE `users` SET `password`=:newpass WHERE `id`=:id";
                                $stmt = $db->prepare($query);
                                $stmt->bindValue(':newpass', $newpass, PDO::PARAM_STR);
                                $stmt->bindValue(':id', $id, PDO::PARAM_STR);
                                $stmt->execute();
                                // echo 'Ancien mdp ' .$pass. ' Mdp db ' .$dbpass. ' Nv mdp ' .$newpass. ' Re-new mdp ' .$renewpass;
                                $_SESSION['message'] = "Votre mot de passe à bien été modififié!";
                                header('Location: ../user/profil.php');
                            } catch (PDOException $e) {
                                echo "Erreur : ".$e->getMessage();
                                }
                        }else{
                            $_SESSION['erreur'] = "L'ancien mot de passe n'est pas le bon!";
                            header('Location: ../user/profil.php');
                        }
                }else{
                    $_SESSION['erreur'] = "Les nouveaux mots de passe ne sont pas identiques!";
                    header('Location: ../user/profil.php');
                }
            }else{
                $_SESSION['erreur'] = "Le formulaire est vide!";
                header('Location: ../user/profil.php');
            }
        }else{
            $_SESSION['erreur'] = "Le formulaire est vide!";
            header('Location: ../user/profil.php');
        }
?>