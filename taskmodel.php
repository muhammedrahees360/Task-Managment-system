<?php
session_start();
 include('dbh.classes.php');
include_once('controller/taskController.php');
if(isset($_POST['savetask']))
    {    
            $inputData = [
                'task_title'=> $_POST['task_title'],
                'description'=> $_POST['description'],
                'enddate'=> $_POST['enddate'],
                'priority'=> $_POST['priority'],
                't_status'=> $_POST['t_status']
            ];
            $user = new taskContr; 
            $getstatus =$user-> taskStatusUser($inputData['t_status']);
            $getpriority = $user->taskPriorityUser($inputData['priority']);
            $result = $user->create($inputData);
            $email=$_SESSION['email'];
            $subject=  'Task created in '.$_SESSION['projectname'];
            $email_template = "
                            <h2>Task is created:</h2>
                            <br>
                            <p>
                            <br>Task Title:".$inputData['task_title']."
                            <br>Description:".$inputData['description']."
                            <br>Due Date:".$inputData['enddate']."
                            <br>Priority:".$getpriority."
                            <br>status:".$getstatus."
                            </p>
                            ";
            $email_v=$user->mailnewtask($email,$subject,$email_template);
            $taskid=$result[0]['task_id'];   
            $projectid=$result[0]['project_id'];                                                                                           
            $img_name = $_FILES['my_image']['name'];
            $img_size = $_FILES['my_image']['size'];
            $tmp_name = $_FILES['my_image']['tmp_name'];
            $error = $_FILES['my_image']['error'];        
                                    if($error ===0)
                                        {
                                            if($img_size> 125000)
                                                {
                                                    $em = "sorryyourfileistoolarge!";
                                                    header("Location: newtaskview.php?error=$em") ;
                                                }else{
                                                            $img_ex = pathinfo($img_name,PATHINFO_EXTENSION);
                                                            $img_ex_lc =strtolower($img_ex);                        
                                                            $allowed_exs = array('jpg','jpeg','png');
                                                            if(in_array($img_ex_lc,$allowed_exs))
                                                                {
                                                                    $new_img_name = uniqid("IMG-" , true).'.'.$img_ex_lc;
                                                                    $img_upload_path = 'Uploads/'.$new_img_name;                                                                   
                                                                     move_uploaded_file($tmp_name,$img_upload_path);
                                                                    $uploadimage = new taskContr;                                                        
                                                                    $resultoftask = $uploadimage->uploadimage($new_img_name,$taskid );
                                                                    header("Location: taskdisp.php?id=$projectid") ;
                                                                    exit();  
                                                                }else{
                                                                        $em = "youcantuploadthefileofthistype";
                                                                        header("Location: newtaskview.php?error=$em") ;
                                                                    }
                                                    }
                                        }else{
                                           
                                                header("Location: taskdisp.php?id=$projectid&success=taskadded") ;
                                            }       
                }

if(isset($_POST['taskcomment']))
         {
            $comment = $_POST['taskcomment'];  
            $tasktitle= $_POST['taskttitle'];         
            $user = new taskContr;
            $result = $user->setcomment($comment,$tasktitle);                           
                        }
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

if(isset($_POST['editTask']))
        { 
            $task_id = $_POST['task_id'];
            $inputData = [
                'task_title'=> $_POST['task_title'],
                'enddate'=> $_POST['enddate'],
                'priority'=> $_POST['priority'],
                'description'=> $_POST['description']
            ];
            
            $user = new taskContr;

            $result = $user->update($inputData,$task_id);
        }
