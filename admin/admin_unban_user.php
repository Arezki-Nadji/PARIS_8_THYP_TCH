<?php
session_start();
include('../db.php');
$sql = "UPDATE user SET ban_status=?WHERE id_user=?";
$stmt= $CON->prepare($sql);
$stmt->execute(["0",$_GET['id_user']]);
header('location:user_list.php');
?>