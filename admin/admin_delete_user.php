<?php
session_start();
include('../db.php');
$sql = "DELETE FROM user WHERE id_user=?";
$stmt= $con->prepare($sql);
$stmt->execute([$_GET['id_user']]);
header('location:user_list.php');
?>