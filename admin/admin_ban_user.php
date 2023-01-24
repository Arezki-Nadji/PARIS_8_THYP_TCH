<?php
session_start();
include('../db.php');
$sql = "UPDATE user SET ban_status=? WHERE id_user=?";
$stmt= $con->prepare($sql);
if($_GET['ban_status']==1)
{
    $stmt->execute(["0",$_GET['id_user']]);
}else
{
    $stmt->execute(["1",$_GET['id_user']]);
}
header('location:user_list.php');
?>