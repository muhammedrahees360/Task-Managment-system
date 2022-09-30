<?php
session_start();
require 'email.php';
class taskContr extends dbh {
    public function getimage($taskid)
            {     
                    $update=$this->connect()->prepare("SELECT image_url FROM image WHERE task_id = ?");   
                        if(!$update->execute(array($taskid)))
                                {
                                    $update = null;
                                    echo "not worked";
                                    header("location: viewimage.php?error=stmtfailed");
                                    exit();
                                }
                                if($update->rowCount() > 0)
                                {
                                    $data = $update->fetchAll(PDO::FETCH_ASSOC);
                                    
                                    return $data;
                                }else{
                                        return false;
                                    }
            } 
    public function index($trailid)
            {  
                // $id=$_SESSION['projectidadmin'];
                $studentQuery =$this->connect()->prepare( "SELECT * FROM tbtask_title WHERE project_id=?;");
               
                if(!$studentQuery->execute(array($trailid))){
                    $studentQuery = null;
                    header("location: taskdisp.php?error=stmtfailed");
                    exit();
                } 
                echo $studentQuery->rowCount();     
                if($studentQuery->rowCount() > 0){
                    $data = $studentQuery->fetchAll(PDO::FETCH_ASSOC);       
                    return $data;
                    }else{
                        return false;
                    }
            }
    public function edit($user_id)
            {   
                $projectQuery = $this->connect()->prepare("SELECT * FROM tbtask_title WHERE task_id=? LIMIT 1");
                if(!$projectQuery->execute(array($user_id))){
                    $projectQuery = null;
                    header("location: taskdisp.php?error=stmtfailed");
                    exit();
                }
                if($projectQuery->rowCount() > 0){
                    $data = $projectQuery->fetchAll(PDO::FETCH_ASSOC);
                    return $data;
                    }else{
                        return false;
                    }     
        }
    public function mailnewtask($email,$subject,$email_template){                        
                            $sendmail = new email;
                            $sendmail->sendmail($subject,$email_template,$email);
                            return true;
    }  
     public function update($inputData,$task_id)
                    {
                        $task_title = $inputData['task_title'];
                        $enddate = $inputData['enddate'];
                        $priority = $inputData['priority'];
                        $stmt= $this->connect()->prepare("UPDATE tbtask_title SET task_title=?,enddate=?,priority=? WHERE task_id =?;");
                        if(!$stmt->execute(array($task_title,$enddate,$priority,$task_id))){
                            $stmt = null;
                            header('location:taskdisp.php?error=somethingWrong!');
                        }
                        $gettask=$this->connect()->prepare("SELECT * FROM tbtask_title WHERE task_id=? ");
                        if(!$gettask->execute(array($task_id))){
                            $stmt = null;
                            header('location:taskdisp.php?error=somethingWrong IN GETTING TASK!');
                        }
                        if($gettask->rowCount() > 0){
                            $data = $gettask->fetchAll(PDO::FETCH_ASSOC);  
                             $id=$_SESSION['projectidadmin'];
                            $email = $_SESSION['pmemail'];
                            $sendmail = new email;
                            $subject=  'Task update in'.$_SESSION['projectname'];
                            $email_template = "
                                            <h2>Task is updated:</h2>
                                            <br>
                                            <p>
                                            <br>Task Title:".$data[0]['task_title']."
                                            <br>Due Date:".$data[0]['enddate']."
                                            <br>Priority:".$data[0]['priority']."
                                            </p>
                                            ";  
                            $sendmail->sendmail($subject,$email_template,$email);
                            echo
                            "
                            <script>
                            alert('send mail with update');
                            document.location.href = 'insertuser.php';
                            </script>
                            ";
                            }else{
                                echo
                            "
                            <script>
                            alert('mail is not send');
                            document.location.href = 'insertuser.php';
                            </script>
                            "; 
                            }     
                        header("location:taskdisp.php?id=$id");
                        exit();
                    }
    public function delete($task_id)
                    {           
                        $projectDeleteQuery = $this->connect()->prepare("DELETE FROM tbtask_title WHERE task_id= ? LIMIT 1");
                        if(!$projectDeleteQuery->execute(array($task_id))){
                            $projectDeleteQuery = null;
                            header("location: taskdisp.php?error=stmtfailed");
                            exit();
                        }
                        if($projectDeleteQuery){
                            return true;
                        }else{
                            return false;
                        }
                    } 
        public function viewProject($project_id)
                    {
                        //    $user_id= $_SESSION['userid'];     
                           $studentQuery =$this->connect()->prepare( "SELECT * FROM tbproject_list WHERE project_id=?;");
                           if(!$studentQuery->execute(array($project_id)))
                               {
                                   $studentQuery = null;
                                   header("location: admin.php?error=stmtfailedindex");
                                   exit();
                               }
                           if($studentQuery->rowCount() > 0)
                               {
                                   $data = $studentQuery->fetchAll(PDO::FETCH_ASSOC);  
                                   return $data;
                               }else{                                     
                                      echo "no row dispalyed in view project taskcontroller";
                                       exit();
                                   }
                    }
            public function gettask($taskid)
                    {   
                           $studentQuery =$this->connect()->prepare( "SELECT * FROM tbtask_title WHERE task_id=?;");                        
                           if(!$studentQuery->execute(array($taskid)))
                               {
                                   $studentQuery = null;
                                   header("location: taskdisp.php?error=stmtfailedindex");
                                   exit();
                               }                     
                           if($studentQuery->rowCount() > 0)
                               {
                                   $data = $studentQuery->fetchAll(PDO::FETCH_ASSOC);
                                  
                                   return $data;
                               }else{
                                       echo "no row dispalyed in gettask";
                                       exit();
                                   }
                    }
                    public function taskStatusUser($status)
                    {
                           if($status == 1)
                            {
                                return 'Started';         
                            }elseif($status == 2)
                                {
                                       return "On-progress";
                                }else
                                    {
                                        return "Done";
                                    }
                    }
                    public function taskPriorityUser($priority)
                    {
                           if($priority == 1)
                            {
                                return 'Critical';
                                     
                            }elseif($priority == 2)
                                {
                                       return "Important";
                                }elseif($priority == 3)
                                        {
                                            return "Normal";
                                        }else
                                            {
                                                return "Low";
                                            }
                    }
                    public function setcomment($comment)
                    {  
                        $taskid=$_SESSION['taskid'];                       
                        $userid=$_SESSION['userid'];                        
                        $taskcomment =$this->connect()->prepare( "INSERT INTO `tbtask_comment`(`task_id`, `user_id`, `comments`, `created_by`, `updated_by`) VALUES (?,?,?,?,?)");                     
                        if(!$taskcomment->execute(array($taskid,$userid,$comment,$userid,$userid)))
                            {
                                $taskcomment = null;
                                header("location: user.php?");                                
                                exit();
                            }
                        if($taskcomment->rowCount()==1){
                            header("location: admintaskview.php?id=$taskid");             
                        }else{
                            echo"tasksetcommentfunction not working";
                            exit();
                        }
                    }
        public function getcomment()
        {
            $taskid=$_SESSION['taskid'];
            $getcomment=$this->connect()->prepare("SELECT * FROM tbtask_comment WHERE task_id=? ");
            if(!$getcomment->execute(array($taskid)))
                {
                    $getcomment = null;
                    header("location: viewtaskdetail.php?error=stmtfailedgetcomment");
                    exit();
                }
            if($getcomment->rowCount() > 0)
                {
                    $data = $getcomment->fetchAll(PDO::FETCH_ASSOC);                   
                        $num =sizeof($data); 
                        $_SESSION['num']=$num;                 
                            return $data;
                        }else{
                                return false;
                            }
        }
        public function create($inputData){
            $task_title=$inputData['task_title'];
            $description=$inputData['description'];
            $enddate=$inputData['enddate'];
            $priority=$inputData['priority'];
            $t_status=$inputData['t_status'];
            $projectid=$_SESSION['projectidadmin'];
            $userid=$_SESSION['userid']; 
            $addtask =$this->connect()->prepare( "INSERT INTO `tbtask_title`(`project_id`, `task_title`, `description`, `t_status`, `priority`, `created_by`, `updated_by`, `enddate`) VALUES (?,?,?,?,?,?,?,?)");                   
                        if(!$addtask->execute(array($projectid,$task_title,$description,$t_status,$priority,$userid,$userid,$enddate)))
                            {
                                $addtask = null;
                                return false;    
                                exit();
                            }
                            $gettask=$this->connect()->prepare(("SELECT task_id,project_id FROM tbtask_title WHERE task_title=? AND description=?"));
                            if(!$gettask->execute(array($task_title,$description)))
                            {
                                $addtask = null;
                                return false;
                                exit();
                            }
                            $data = $gettask->fetchAll(PDO::FETCH_ASSOC);  
                           return $data;
        }
        public function uploadimage($name,$taskid)
    {
            $update=$this->connect()->prepare("INSERT INTO image (task_id,image_url) VALUES (?,?)");
                if(!$update->execute(array($taskid,$name)))
                        {
                            $update = null;
                            echo "not worked";
                            header("location: insertuser.php?error=stmtfailed");
                            exit();
                        }                        
                       return true;
                        
    }                 
}
