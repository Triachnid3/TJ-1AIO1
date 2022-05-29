<?php
    include "config.php";
    if(isset($_GET['id'])){
        $active_id = mysqli_real_escape_string($conn, $_GET['id']);
        $sql = mysqli_query($conn, "UPDATE url SET status = 1 WHERE id = '{$active_id}'");
        if($sql){
            header("Location: ../index.php");
        }else{
            header("Location: ../index.php");
        }
    }elseif(isset($_GET['activate'])){
        $sql3 = mysqli_query($conn, "UPDATE url SET status = 1");
        if($sql3){
            header("Location: ../index.php");
        }else{
            header("Location: ../index.php");
        }
    }else{
        header("Location: ../index.php");
    }
?>