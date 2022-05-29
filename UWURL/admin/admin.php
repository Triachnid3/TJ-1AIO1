<?php 
session_start();
require_once('../php/connect.php');


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

        //user info selection with search
    if(isset($_POST['column_name']) && !empty($_POST['column_name'])
    && isset($_POST['search_opt']) && !empty($_POST['search_opt'])) {
        $column_name = $_POST['column_name'];
        $search_opt = $_POST['search_opt'];

        try{                       //SELECT * FROM users WHERE username LIKE '%test%';
        $searchQuery = 'SELECT * FROM users WHERE '.$column_name.' LIKE ?';
        $search = $db->prepare($searchQuery);
        $search->execute(array('%'.$search_opt.'%'));
        $searchresult = $search->fetchAll(PDO::FETCH_ASSOC);
            // print_r($searchresult);
            // echo json_encode($searchresult);
        }catch(PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
        // echo 'Column ' .$column_name. ' Search opt ' .$search_opt. ' Search query ' .$searchQuery;

    } else {
        //Basic user info selection
            $sql = $db->prepare('SELECT * FROM users');
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        }

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
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <link rel="stylesheet" href="../CSS/link.css">
    <link href="<?php if(isset($theme)){echo '../CSS/'.$theme.'.css';}elseif($_COOKIE['theme']){echo '../CSS/'.$_COOKIE['theme'].'.css';}else{echo '../CSS/style.css';} ?>" rel="stylesheet" type="text/css"/>
    <title>Administration</title>
</head>
<body class="admin"> 
    <nav>
        <h1><a href="../index.php"><img src="../ressources/logo.png" alt="logo UWUrl"></a></h1>
                <div class="link">
                    <a href="../php/close.php" class="btn btn-primary">Se déconnecter</a>
                    <a href="../user/profil.php" class="btn btn-primary">Profil</a>  
                    <a href="../user/ownlink.php" class="btn btn-primary">Mes liens</a>   
                   <a href="../index.php" class="btn btn-primary">Accueil</a>
                   <!-- <a href="../admin/admin.php" class="btn btn-primary">Administration</a> -->
                </div>
        </nav>
        <main>
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
            <h1>Modifier un utilisateur</h1>
                    <form method="POST">
                        <select name="column_name" id="column_name" class="btn btn-primary dropdown-toggle admin_dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <option value="username">Nom d'utilisateur</option>
                            <option value="email">Adresse e-mail</option>
                        </select>
                        <input type="text" name="search_opt" id="search_opt" placeholder="Terme à rechercher" class="form-control">
                        <button type="submit" class="btn_search"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg></button>
                    </form>
                    <? if (isset($searchresult) && !empty($searchresult)){ ?>
                        <form method="POST">
                            <input type="text" name="column_name" id="column_name" class="form-control" hidden>
                            <input type="text" name="search_opt" id="search_opt" class="form-control" hidden>
                            <button type="submit" class="btn btn-primary">Réinitialiser la recherche</button>
                        </form>
                        <? } ?>
                    <div id="table-wrapper">
                        <div id="table-scroll">
                            <table class="table table-stripped border border-dark">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nom d'utilisateur</th>
                                        <th>Email</th>
                                        <th>Rang</th>
                                        <th>Actif</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if (!empty($searchresult)) {
                                        foreach($searchresult as $row2) { ?>
                                            <tr>
                                                <td><?= $row2['id'] ?></td>
                                                <td><?= $row2['username'] ?></td>
                                                <td><?= $row2['email'] ?></td>
                                                <td><? if ($row2['rank'] > 0) {
                                                        echo 'Administrateur ';
                                                        echo '<a href="../php/rank.php?id='.$row2['id'].'&rank='.$row2['rank'].'"><i class="uil uil-user-minus"></i></a>';
                                                    } else{
                                                        echo 'Utilisateur ';
                                                        echo '<a href="../php/rank.php?id='.$row2['id'].'&rank='.$row2['rank'].'"><i class="uil uil-user-plus"></i></a>';
                                                    } ?></td>
                                                <td>
                                                    <? if ($row2['isdeleted'] == 0) {
                                                            echo 'Oui ';
                                                        } else{
                                                            echo 'Non ';
                                                        } ?> 
                                                </td>
                                                <td>
                                                    <a href="history.php?id=<?=$row2['id']?>"><i class="uil uil-clock"></i></a>
                                                    <a href="userprofil.php?id=<?=$row2['id']?>"><i class="uil uil-edit"></i></a>
                                                    
                                                </td>
                                            </tr>
                                    <? } 
                                    } else {
                                        foreach($result as $row) { ?>
                                            <tr>
                                                <td><?= $row['id'] ?></td>
                                                <td><?= $row['username'] ?></td>
                                                <td><?= $row['email'] ?></td>
                                                <td><? if ($row['rank'] == 1) {
                                                        echo 'Administrateur ';
                                                        echo '<a href="../php/rank.php?id='.$row['id'].'&rank='.$row['rank'].'"><i class="uil uil-user-minus"></i></a>';
                                                    } else{
                                                        echo 'Utilisateur ';
                                                        echo '<a href="../php/rank.php?id='.$row['id'].'&rank='.$row['rank'].'"><i class="uil uil-user-plus"></i></a>';
                                                    } ?></td>
                                                <td>
                                                    <? if ($row['isdeleted'] == 0) {
                                                            echo 'Oui ';
                                                        } else{
                                                            echo 'Non ';
                                                        } ?> 
                                                </td>
                                                <td>
                                                    <a href="history.php?id=<?=$row['id']?>"><i class="uil uil-clock"></i></a>
                                                    <a href="userprofil.php?id=<?=$row['id']?>"><i class="uil uil-edit"></i></a>
                                                
                                                </td>
                                            </tr>
                                    <? 
                                    }
                                    }
                                    ?>
                                </tbody>
                            </table>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="../Javascript/theme.js"></script>
</body>
</html>