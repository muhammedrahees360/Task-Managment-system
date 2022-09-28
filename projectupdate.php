<?php

include('dbh.classes.php');

include('userController.php');

if(isset($_POST['deleteUser']))
{
 
    $project_id = $_POST['deleteUser'];
   
    $user = new userController;
    
   $result = $user->delete($project_id);
    if($result){
        header("location: insertuser.php?error=noerrordatadeleted");
        exit();
    }else{
        header("location: insertuser.php?errorindeletecolumn");
        exit();
    }

}
if(isset($_POST['update']))
{
    $id = $_POST['project_id'];
    
    $inputData = [
        'vendorname' => $_POST['vendorname'],
        'projectname' => $_POST['projectname'],
        'projectmanager' => $_POST['projectmanager'],
        'email' => $_POST['email'],
        'duedate' => $_POST['duedate'],
        'description' =>$_POST['description']
    ];
    
    $project1 = new userController;
 
    $result = $project1->update($inputData,$id);
    if($result){
        header("location: insertuser.php");
    }else{

    }
}
if(isset($_POST["addvendor"])){
   
    $uid=$_POST['uid'];
    $vendorname=$_POST['vname'];
    $projectmanager=$_POST['pmanager'];
    $projectname=$_POST['pname'];
    $pm_email=$_POST['pemail'];
    $duedate=$_POST['duedate'];
    $description=$_POST['description'];
    //Instantiate signupcontr class
 
  
  
    $setuser = new userController;
    $result = $setuser->setuser($uid,$vendorname,$projectmanager,$projectname,$pm_email,$duedate,$description);
  
    //Going to back to front page
               
   

}   