<?php
session_start();
include('dbconn.php');
include_once('taskController.php');
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
            $result = $user->create($inputData);
            $email=$_SESSION['pmemail'];
            $subject=  'Task created in'.$_SESSION['projectname'];
            $email_template = "
                            <h2>Task is created:</h2>
                            <br>
                            <p>
                            <br>Task Title:".$inputData['task_title']."
                            <br>Description:".$inputData['description']."
                            <br>Due Date:".$inputData['enddate']."
                            <br>Priority:".$inputData['priority']."
                            <br>t_status:".$inputData['t_status']."
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
                                                    $em = "sorry your file is too large!";
                                                    header("Location: addfile.php?error=$em") ;
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
                                                                    echo
                                                                    "
                                                                    <script>
                                                                    alert('new task added');
                                                                    document.location.href = 'taskdisp.php?id=$projectid';
                                                                    </script>
                                                                    ";
                                                                }else{
                                                                        $em = "you can't upload the file of this type";
                                                                        header("Location: insertuser.php?error=$em") ;
                                                                    }
                                                    }
                                        }else{
                                                $em = "unknown error occured!";
                                                header("Location: taskdisp.php?id=$projectid") ;
                                            }       
                }