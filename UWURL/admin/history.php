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


// Theme
if (isset($_POST['dark']) && $_POST['dark'] = 'dark') {
    $theme = 'dark';
    setcookie('theme', 'dark');
}elseif (isset($_POST['default']) && $_POST['default'] = 'style') {
    $theme = 'style';
    setcookie('theme', 'style');
}

require_once('../php/config.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <link rel="stylesheet" href="../CSS/link.css">
    <link href="<?php if(isset($theme)){echo '../CSS/'.$theme.'.css';}elseif($_COOKIE['theme']){echo '../CSS/'.$_COOKIE['theme'].'.css';}else{echo '../CSS/style.css';} ?>" rel="stylesheet" type="text/css"/>
    <title>Historique utilisateur</title>
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

        <h2>Historique utilisateur</h2>

        <div class="wrapper">
        <?php
            $creatorid = $_GET['id'];
            $sql2 = mysqli_query($conn, "SELECT * FROM url WHERE creator_id = $creatorid ORDER BY id DESC");
                if(mysqli_num_rows($sql2) > 0){;
        ?>
            <div class="statistics">
                <?php
                    $sql3 = mysqli_query($conn, "SELECT COUNT(*) FROM url");
                    $res = mysqli_fetch_assoc($sql3);

                    $sql4 = mysqli_query($conn, "SELECT clicks FROM url");
                    $total = 0;
                    
                    while($count = mysqli_fetch_assoc($sql4)){
                        $total = $count['clicks'] + $total;
                    }
                ?>
                    <span>Nombre de liens au total : <span><?php echo end($res) ?></span> & Nombre de clics totaux : <span><?php echo $total ?></span></span>
                <a href="../php/delete.php?delete=all">Tout Supprimer</a><a href="../php/activate.php?activate=all">Tout activer</a>
            </div>
            <div class="urls-area">
                <div class="title">
                    <li>URL raccourcie</li>
                    <li>URL de base</li>
                    <li>Nombre de clics</li>
                    <li>Status</li>
                   <li>Actions</li>
                </div>
        <?php
            while($row = mysqli_fetch_assoc($sql2)){
        ?>
            <div class="data">
                <li>
                    <a href="<?php echo $domain.$row['shorten_url'] ?>" target="_blank">
                        <?php
                            if($domain.strlen($row['shorten_url']) > 50){
                                echo $domain.substr($row['shorten_url'], 0, 50) . '...';
                            }else{
                                echo $domain.$row['shorten_url'];
                            }
                        ?>
                    </a>
                </li> 
                <li>
                    <?php
                        if(strlen($row['full_url']) > 60){
                            echo substr($row['full_url'], 0, 60) . '...';
                        }else{
                            echo $row['full_url'];
                        }
                    ?>
                </li> 
                <li><?= $row['clicks'] ?></li>
                <li><?= $row['status'] ?></li>
                <?='<li><a href="../php/delete.php?id='.$row['id'].'">Supprimer </a><a href="../php/activate.php?id='.$row['id'].'">Activer </a></li>';?>
            </div>
            <?php
                }
            ?>
        </div>
        <?php
            }else{echo 'Aucun lien trouvé !';}
        ?>
        </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="../Javascript/script.js"></script>
<script src="../Javascript/theme.js"></script>
</body>
</html>