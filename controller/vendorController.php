<?php
 session_start();
include './email.php';
class vendorController extends Dbh {

   
    
  
        public function index()
                {
                    $id=1;
                    $studentQuery =$this->connect()->prepare( "SELECT * FROM tbproject_list WHERE ?;");
                
                    if(!$studentQuery->execute(array($id)))
                        {
                            $studentQuery = null;
                            header("location: admin.php?error=stmtfailed");
                            exit();
                        }
                
                    if($studentQuery->rowCount() > 0)
                        {
                            $data = $studentQuery->fetchAll(PDO::FETCH_ASSOC);
                            return $data;
                        }else{
                                return false;
                            }
                }
        public function getuser($uid,$value,$select)
            {
            
               
                $getuser =$this->connect()->prepare( "SELECT $select FROM tbuser WHERE $value=?;");
             
                if(!$getuser->execute(array($uid)))
                    {
                        $getuser = null;
                        header("location: admin.php?error=stmtfailed");
                        exit();
                    }
                   
                if($getuser->rowCount() > 0)
                    {
                        $data = $getuser->fetchAll(PDO::FETCH_ASSOC);
                       
                        return $data;
                    }else{
                            return false;
                        }
            }


    public function edit($id)
            {   
               
              
               
                $projectQuery = $this->connect()->prepare("SELECT * FROM tbproject_list WHERE project_id=? LIMIT 1");
                if(!$projectQuery->execute(array($id)))
                    {
                        $projectQuery = null;
                        header("location: admin.php?error=stmtfailededit");
                        exit();
                    }
                if($projectQuery->rowCount() > 0)
                    {
                        $data = $projectQuery->fetchAll(PDO::FETCH_ASSOC);
                    
                        return $data;
                    }else
                        {
                            return false;
                        }
               
              
            }
    public function delete($project_id)
        {
       
            
            $projectDeleteQuery = $this->connect()->prepare("DELETE FROM tbproject_list WHERE project_id= ? LIMIT 1");
        
                if(!$projectDeleteQuery->execute(array($project_id)))

                {
                    $projectDeleteQuery = null;
                    header("location: insertuser.php?error=stmtfaileddetelte");
                    exit();
                }
            $taskdelete =$this->connect()->prepare("DELETE FROM tbtask_title WHERE project_id= ?");
            $taskdelete->execute(array($project_id));
            // $commentdelete =$this->connect()->prepare("DELETE FROM tbtask_comment WHERE project_id= ?");
            // $commentdelete->execute(array($project_id));
                if($projectDeleteQuery)
                {
                    return true;
                }else{
                    return false;
                    }
        }
    public function insertuser($id)
    {
       
        $stmt= $this->connect()->prepare("SELECT * FROM tbproject_list WHERE  project_id = ?;");
        if(!$stmt->execute(array($id))){
            $stmt = null;
            header("location: admin.php?error=stmtfailed");
            exit();
        }
     
        if($stmt->rowCount() == 0){
            $stmt = null;
            
            header("location: admin.php?error=stmtfailed");
            exit();
        }
    
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
       
  
    
        return $data;
    
    }

    public function update($inputData,$id)
            {
                $vendorname = $inputData['vendorname'];
                $projectname = $inputData['projectname'];
                $duedate = $inputData['duedate'];
                $description = $inputData['description'];   
                $stmt= $this->connect()->prepare("UPDATE tbproject_list SET vendor_name=?,project_name= ? ,description= ? ,end_date= ? WHERE project_id= ? LIMIT 1");              
                if(!$stmt->execute(array($vendorname,$projectname,$description,$duedate,$id))){
                    $stmt = null;
                    header("location: admin.php?error=stmtfailedupdate");
                    exit();
                }
            
                if($stmt->rowCount() == 0){
                    $stmt = null;
                    
                    header("location: admin.php?error=invaliemailentered");
                    exit();
                }
                header('location:insertuser.php?success=valueupdated');


            }
    public function setuser($username,$vendorname,$projectname,$duedate,$description)
    {
         
         
                // $uid= $_SESSION['useruid'];
         
                $stmt= $this->connect()->prepare("SELECT * FROM tbuser WHERE  user_name = ?;");
           
                if(!$stmt->execute(array($username)))
                    {
                        $stmt = null;
                        header("location: insertuser.php?error=stmtfailed");
                        exit();
                    }
        
                if($stmt->rowCount() == 0)
                    {
                        $stmt = null;
                        header("location: insertuser.php?error=userinvalid");
                        exit();
                       
                    
                    }
                  
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
               $useremail=$data[0]['email'];
                $userid=$data[0]["user_id"];
           
                $update=$this->connect()->prepare('INSERT INTO tbproject_list( vendor_name, project_name,description, end_date, users_id, created_by, updated_by) VALUES (?,?,?,?,?,?,?);');
              
                if(!$update->execute(array($vendorname,$projectname,$description,$duedate,$userid,$userid,$userid)))
                        {
                            $stmt = null;
                            header("location: insertuser.php?error=stmtfailed");
                            exit();
                        }
                       
                        $email =$useremail;
                       
                        $sendmail = new email;
                       
                        $subject=  'project created';
                        $email_template = "
                                            <h2>A new project was created:</h2>
                                            <br>
                                            <p>
                                            <br>Vendor Name:$vendorname
                                         
                                            <br>Project Name:$projectname
                                            <br>Description:$description
                                            <br>Due Date:$duedate
                                            </p>

                                            ";          
                        $sendmail->sendmail($subject,$email_template,$email);
                        header("location: insertuser.php?success=vendoradded");
                        exit();
                       
                        header("location: insertuser.php?error=userisadded");
                        exit();
                
            }

}