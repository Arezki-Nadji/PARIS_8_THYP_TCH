<?php
session_start();
include('../db.php');
$sql = "DELETE FROM movie WHERE id=?";
$stmt= $con->prepare($sql);
$stmt->execute([$_GET['id']]);
header('location:movie_list.php');
?>