<?php
 include('dbh.classes.php');
include_once('controller/userController.php');
if(isset($_POST['saveUser'])){
    $inputData = [
    'username'=> $_POST['user_name'],
    'fullname'=> $_POST['full_name'],
    'email'=> $_POST['email'],
    'password'=> $_POST['pwd'],
    'userrole'=> $_POST['user_role']
    ]; 
    $user = new userContr;
    $result = $user->create($inputData); 
    if($result)
       {
        header('location:addvendor.php?error=somethingWrong!');
       }else
          {
            header("location:displayuser.php?success='useradded'");         
          }
}
if(isset($_POST['deleteUser']))
{
    $user_id = $_POST['delete_user_id'];
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
if(isset($_POST['editUser']))
{ 
   $user_id = $_POST['user_id'];
   $inputData = [
       'username'=> $_POST['username'],
        'full_name'=> $_POST['full_name'],
       'email'=> $_POST['email']
   ];
   $user = new userContr;
   $result = $user->update($inputData,$user_id);
}
