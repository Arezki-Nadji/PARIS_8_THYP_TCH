<?php
    $host = 'localhost';
    $dbname= 'recommendation_system_refact';
    $username = 'root';
    $password = '';
    try
    {
        $con = new PDO ("mysql:host=$host;
                         dbname=$dbname",
                         $username,$password);
    }
    catch(PDOException $e)
    {
        die('Error : ' . $e->getMessage());
    }
?>