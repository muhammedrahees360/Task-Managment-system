<?php
 session_start();
require 'email.php';
class userfunction extends Dbh 
        {
            
            public function getimage($taskid,$variabe,$table,$value) 
            {
               
                    $update=$this->connect()->prepare("SELECT $variabe FROM $table WHERE $value = ?");
                
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
                public function viewProject($user_id,$table,$value)
                        {
                               
                               
                               $studentQuery =$this->connect()->prepare( "SELECT * FROM $table WHERE $value=?;");
                           
                               if(!$studentQuery->execute(array($user_id)))
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
                                           echo "No project is Assigned";
                                           exit();
                                       }

                        }
                public function viewtask($taskid)
                {
               
                    $studentQuery =$this->connect()->prepare( "SELECT * FROM tbtask_title WHERE project_id=?;");
                   
                    if(!$studentQuery->execute(array($taskid))){
                        $studentQuery = null;
                       
                        header("location: taskdisp.php?id=$taskid");
                        exit();
                    } 
                   
                    if($studentQuery->rowCount() > 0){
                        
                        $data = $studentQuery->fetchAll(PDO::FETCH_ASSOC);
                        
                        return $data;
                        }else{
                        
                            return false;
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
            public function user($userid)
            {
               
                   if($userid == 1)
                    {
                        return "Admin";
                             
                    }else
                        {
                               return $_SESSION['useruid'];
                        }
            }

            public function delete($task_id)
                    {           
                        $projectDeleteQuery = $this->connect()->prepare("DELETE FROM tbtask_title WHERE task_id= ? LIMIT 1");
                        if(!$projectDeleteQuery->execute(array($task_id))){
                            $projectDeleteQuery = null;
                            header("location: user.php?error=stmtfailed");
                            exit();
                        }
                       
                        if($projectDeleteQuery){
                            return true;
                        }else{
                            return false;
                        }
                    }   
                    
        public function gettask($id)
                    {
                    
                     
                        $gettask =$this->connect()->prepare( "SELECT * FROM tbtask_title WHERE task_id=?;");
                       
                        if(!$gettask->execute(array($id)))
                            {
                                $gettask = null;
                                header("location: user.php?error=stmtfailedgettask");
                                exit();
                            }
                         
                        if($gettask->rowCount() > 0)
                            {
                                $data = $gettask->fetchAll(PDO::FETCH_ASSOC);
                                
                                return $data;
                            }else{
                                    return false;
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
                            header("location: viewtaskdetail.php?id=$taskid");
                            
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
                        $id=$_SESSION['projectidadmin'];

                        header("location:user.php?id=$id");
                        exit();
                    }

        public function updatetask($task_id,$status,$email_template)
                    {
                        
                        
                        $stmt= $this->connect()->prepare("UPDATE tbtask_title SET t_status=? WHERE task_id =?;");
                        if(!$stmt->execute(array($status,$task_id))){
                            $stmt = null;
                            header('location:taskdisp.php?error=somethingWrong!');
                        }
                        $role=1;
                        $stmtemail=$this->connect()->prepare("SELECT * FROM tbuser WHERE user_role=?");
                        if(!$stmtemail->execute(array($role))){
                            $stmtemail = null;
                            header('location:taskdisp.php?error=somethingWrong!');
                        }
                        $data = $stmtemail->fetchAll(PDO::FETCH_ASSOC); 
                        $id=$_SESSION['projectidadmin'];
                        $email=$data[0]['email'];
                        $subject="Change in status of Task ";
                        $sendmail = new email;
                        $sendmail->sendmail($subject,$email_template,$email);
                        header("location:user.php?success=statusupdated");
                    }
        }