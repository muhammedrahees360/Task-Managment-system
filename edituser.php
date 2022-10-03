<?php
include('dbh.classes.php');
include_once('userController.php');
 if(isset($_POST['editUser']))
 { 
    $user_id = $_POST['user_id'];
    $inputData = [
        'username'=> $_POST['username'],
        'email'=> $_POST['email']
    ];
    $user = new userContr;
    $result = $user->update($inputData,$user_id);
 }
