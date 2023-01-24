<?php
session_start();
include('../db.php');

if(isset($_POST['fav']))    
{
    echo $_SESSION['id'];
    echo $_POST['id'];
    $sql = "INSERT INTO user_favorite (id_user,id_movie) VALUES (?,?)";
    $result= $con->prepare($sql);
    $result->execute([$_SESSION['id'], $_POST['id']]);
    header('location:index.php');
}
?>