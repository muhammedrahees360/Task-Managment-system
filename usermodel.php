<?php
session_start();
include('dbh.classes.php');
include('controller/userfunction.php');
    if(isset($_POST['deletetask']))
    {
        $task_id = $_POST['deletetask'];
        $user = new userfunction;
        $result = $user->delete($task_id);
        if($result)
        {
            header("Location:user.php?error=datadeleted");
            exit(0);
        }
        else
        {
            header("Location:user.php?error=somethingwrong!");
            exit(0);
        }
    }
    if(isset($_POST['taskcomment']))
    {
        $tasktitle= $_POST['taskttitle']; 
        $comment = $_POST['taskcomment'];
    
        $user = new userfunction;
        $result = $user->setcomment($comment);
        
    }
    if(isset($_POST['editTask']))
    { 
        $task_id = $_POST['task_id'];
        $inputData = [
            'task_title'=> $_POST['task_title'],
            'enddate'=> $_POST['enddate'],
            'priority'=> $_POST['priority']
        ];
    
        $user = new userfunction;
    
        $result = $user->update($inputData,$task_id);
    }
    if(isset($_POST['edittask']))
    {
    
        $task_id = $_POST['task_id'];
        $status = $_POST['status'];

        $task_title=$_POST['task_title'];
        
    
    
        $user = new userfunction;
        $t_status=$user->taskStatusUser($status);
        $email_template = "
                                                <h2>Task is updated:</h2>
                                                <br>
                                                <p>
                                                <br>Task Title:".$task_title."
                                            
                                                <br>The Status of task is changed to :". $t_status."
                                                
                                                </p>

                                                ";
    
        $result = $user->updatetask($task_id,$status,$email_template);
        

    

        
    }
