<?php 
session_start();

if(empty($_SESSION['id'])) {
    $_SESSION['erreur'] = "Veuillez vous connecter avant de rejoindre le site" ;
    header('Location: user/login.php');
}else{
    $id = $_SESSION['id'];
}

  include "php/config.php";
  $new_url = "";
  if(isset($_GET)){
    foreach($_GET as $key=>$val){
      $u = mysqli_real_escape_string($conn, $key);
      $new_url = str_replace('/', '', $u);
    }
      $sql = mysqli_query($conn, "SELECT full_url FROM url WHERE shorten_url = '{$new_url}'");
      if(mysqli_num_rows($sql) > 0){
        $sql2 = mysqli_query($conn, "UPDATE url SET clicks = clicks + 1 WHERE shorten_url = '{$new_url}'");
        if($sql2){
            $full_url = mysqli_fetch_assoc($sql);
            header("Location:".$full_url['full_url']);
          }
      }
  }

//   Rank
$rankquery = mysqli_query($conn, "SELECT * FROM users WHERE id = '{$id}'");
$rank = mysqli_fetch_assoc($rankquery);

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
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="CSS/link.css">
    <link href="<?php if(isset($theme)){echo '../CSS/'.$theme.'.css';}elseif($_COOKIE['theme']){echo '../CSS/'.$_COOKIE['theme'].'.css';}else{echo '../CSS/style.css';} ?>" rel="stylesheet" type="text/css"/>
    <title>Accueil</title>
</head>
<body>
<? if ($rank['rank'] > 0) { ?>
    <style>
        .urls-area li:nth-child(1){
        max-width: 30%;
        }
        .urls-area li:nth-child(2){
        max-width: 45%;
        }
        .urls-area li:nth-child(3){
        max-width: 11%;
        }
        .urls-area li:nth-child(4){
        max-width: 14%;
        }
    </style>
    <? } else { ?>
        <style>
            .urls-area li:nth-child(1){
            max-width: 35%;
            }
            .urls-area li:nth-child(2){
            max-width: 60%;
            }
            .urls-area li:nth-child(3){
            max-width: 15%;
            }
        </style>
      <?  } ?>

    <nav>
        <h1><a href="index.php"><img src="ressources/logo.png" alt="logo UWUrl"></a></h1>
            <div class="link">
                <a href="php/close.php" class="btn btn-primary">Se déconnecter</a>
                <a href="user/profil.php" class="btn btn-primary">Profil</a>  
                <a href="user/ownlink.php" class="btn btn-primary">Mes liens</a>   
                <? if ($rank['rank'] > 0) { echo '<a href="admin/admin.php" class="btn btn-primary">Administration</a>';}?> 
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
        <div class="wrapper">
            <form action="#" autocomplete="off">
                <input type="text" spellcheck="false" name="full_url" placeholder="Entrer ou coller une longue URL" required>
                <i class="url-icon uil uil-link"></i>
                <button>Raccourcir</button>
            </form>
        <?php
            $sql2 = mysqli_query($conn, "SELECT * FROM url WHERE status  = 1 ORDER BY id DESC");
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
                <? if($rank['rank']>0){ echo '<a href="php/delete.php?delete=all">Tout supprimer</a>';}?>
            </div>
            <div class="urls-area">
                <div class="title">
                    <li>URL raccourcie</li>
                    <li>URL de base</li>
                    <li>Nombre de clics</li>
                    <? if($rank['rank']>0){ echo '<li>Action</li>';}?>
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
                <li><?php echo $row['clicks'] ?></li>
                <? if($rank['rank']>0){ echo '<li><a href="php/delete.php?id='.$row['id'].' ">Supprimer</a></li>';} ?>
            </div>
            <?php
                }
            ?>
        </div>
        <?php
            }
        ?>
        </div>

        <div class="blur-effect"></div>
        <div class="popup-box">
        <div class="info-box">Votre lien raccourci est prêt. Vous pouvez modifer la partie derrière "uwurl.fr/" maintenant, mais cela sera impossible une fois sauvegardé.</div>
            <form action="#" autocomplete="off">
                <label>Modifier votre lien raccourci</label>
                <input type="text" class="shorten-url" spellcheck="false" required>
                <i class="copy-icon uil uil-copy-alt"></i>
                <button>Sauvegarder</button>
            </form>
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
    <script src="Javascript/script.js"></script>
    <script src="Javascript/theme.js"></script>
</body>
</html>