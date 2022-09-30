<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password reset</title>
</head>
<body>
<?php
        include("dbh.classes.php");
        include("login-contr.classes.php");
        if(isset($_GET['email'])&& isset($_GET['token']))
             {
                $email=$_GET['email'];
                $token=$_GET['token'];
                date_default_timezone_set('Asia/kolkata');
                $date = date("Y-m-d");
                $resetpass = new loginContr();
                $result= $resetpass->resetpass($token,$date,$email);
             }
        if(isset($_POST['updatepassword']))
        {
           $password=$_POST['password'];
           $email=$_POST['email'];
           $setpass = new loginContr();               
           $result= $setpass->setpass($password,$email);
        }
    ?>  
</body>
</html>

