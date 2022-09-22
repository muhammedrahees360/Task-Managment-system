<?php
$msg="";
if(isset($_POST["submit"])){
    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];
    
    

    //Instantiate signupcontr class
    include "dbh.classes.php";
    include "login.classes.php";
    include "login-contr.classes.php";
    $login = new loginContr($uid,$pwd);
    // Running error handlers and user signup
    $login->loginUser();
    //Going to back to front page
    
   

}   
