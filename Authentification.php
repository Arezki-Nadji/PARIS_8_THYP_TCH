<?php
session_start();
?>
<!DOCTYPE html>
<html lang="eng">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="css/style.css">
    </head>
        <title>Login</title>
    </head>
    
    <body>
        <div class="wrapper fadeInDown">
            <div id="formContent">
            <!-- Tabs Titles -->
                <!-- Icon -->
                <div class="fadeIn first">
                <img src="https://img.freepik.com/vecteurs-premium/logo-film-colore_18099-26.jpg?w=2000" id="icon" alt="User Icon" />
                </div>

                <!-- Login Form -->
                <form method="POST">
                <input type="text" id="username" class="fadeIn second" name="username" placeholder="username">
                <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
                <input type="submit" name="login" class="fadeIn fourth" value="login">
                </form>

                <!-- Remind Passowrd -->
                <div id="formFooter">
                
                </div>

            </div>
        </div>
<?php
include('db.php');
if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $response = $con->query($sql);
    if($response->rowCount()>0)
    {
        
        if($data=$response->fetch())
        {
            $_SESSION['username']=$data['username'];
            $_SESSION['id']=$data['id_user'];
            $_SESSION['type']=$data['type'];
            $_SESSION['ban_status']=$date['ban_status'];
            if($data['type']=="admin")
            {
                
                header('location:admin/admin.php');
            }
            else
            {
                header('location:user/index.php');
            }
        }
    }
}
?>
</body>