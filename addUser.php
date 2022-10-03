<?php
   include "dbh.classes.php";
   include "userController.php";
   if(isset($_POST['saveUser'])){
         $inputData = [
         'username'=> $_POST['user_name'],
         'email'=> $_POST['email'],
         'password'=> $_POST['pwd'],
         'userrole'=> $_POST['user_role']
         ]; 
         $user = new userContr;
         $result = $user->create($inputData);
         if($result)
            {
               header('location:displayuser.php?value added sucesssfully');
            }else
               {
               header('location:displayuser.php?error=somethingWrong!');
               }
}