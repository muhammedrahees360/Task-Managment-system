<?php
include('dbconn.php');
include_once('taskController.php');
if(isset($_POST['deletetask']))
{
    $task_id = $_POST['deletetask'];
    $user = new taskContr;
    $result = $user->delete($task_id);
    if($result)
    {
        header("Location:taskdisp.php?error=datadeleted");
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