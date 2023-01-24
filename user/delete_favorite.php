<?php
session_start();
include('../db.php');

if(isset($_POST['del_fav']))
{
    echo $_SESSION['id'];
    echo $_POST['id'];
    include('../db.php');
    $sql = "DELETE FROM user_favorite WHERE id_movie=? AND id_user=?";
    $stmt= $con->prepare($sql);
    $stmt->execute([$_POST['id'],$_SESSION['id']]);
    header('location:index.php');
   
}
?>