<?php 
include "dbh.classes.php";
include "controller/login-contr.classes.php";

if(isset($_POST["submit"]))
    {
        
        $uid = $_POST['uid'];
        $pwd = $_POST['pwd']; 
        $login = new loginContr();
        $result= $login->loginUser($uid,$pwd);
        
    }   
if(isset($_POST['reset-request-submit']))
{
    $email=$_POST['email'];
    
    $password =new loginContr();

    $pass =$password->forgetpass($email);
    
    
}