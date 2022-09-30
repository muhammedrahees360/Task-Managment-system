<?php
include('dbconn.php');
include_once('userController.php');
if(isset($_POST['deleteUser']))
{
    $user_id = $_POST['deleteUser'];
    $user = new userContr;
    $result = $user->delete($user_id);
    if($result)
    {
        header("Location:displayuser.php?error=datadeleted");
        exit(0);
    }
    else
    {
        header("Location:displayuser.php?error=somethingwrong!");
        exit(0);
    }
}