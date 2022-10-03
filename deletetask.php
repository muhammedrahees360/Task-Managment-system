<?php
include('dbh.classes.php');
include_once('taskController.php');
if(isset($_POST['deletetask']))
{
    $task_id = $_POST['deletetask'];
    $user = new taskContr;
    $result = $user->delete($task_id);
    $id=$_SESSION['projectidadmin'];
    if($result)
    {
        header("Location:taskdisp.php?id=$id");
        exit(0);
    }
    else
    {
        header("Location:taskdisp.php?error=somethingwrong!");
        exit(0);
    }
}
if(isset($_POST['taskcomment']))
{
    $comment = $_POST['taskcomment'];
    
    $user = new taskContr;
    $result = $user->setcomment($comment);
    
}