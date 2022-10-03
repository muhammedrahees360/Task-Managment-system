<?php
include('dbh.classes.php');
include_once('taskController.php');
if(isset($_POST['editTask']))
 { 
    $task_id = $_POST['task_id'];
    $inputData = [
        'task_title'=> $_POST['task_title'],
        'enddate'=> $_POST['enddate'],
        'priority'=> $_POST['priority']
    ];
    $user = new taskContr;
    $result = $user->update($inputData,$task_id);
 }




 