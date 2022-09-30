<?php
 session_start();
include 'email.php';
class vendorController extends Dbh {

   
    
  
        public function index()
                {
                    $id=1;
                    $studentQuery =$this->connect()->prepare( "SELECT * FROM tbproject_list WHERE ?;");
                
                    if(!$studentQuery->execute(array($id)))
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
                                return false;
                            }
                }
        public function getuser($uid)
            {
            
               
                $getuser =$this->connect()->prepare( "SELECT user_name FROM tbuser WHERE user_id=?;");
             
                if(!$getuser->execute(array($uid)))
                    {
                        $getuser = null;
                        header("location: admin.php?error=stmtfailedgetuser");
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
                    header("location: admin.php?error=stmtfaileddetelte");
                    exit();
                }
              
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
            header("location: admin.php?error=stmtfailedinsertuser");
            exit();
        }
     
        if($stmt->rowCount() == 0){
            $stmt = null;
            
            header("location: admin.php?error=invaliemailentered");
            exit();
        }
    
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
       
  
    
        return $data;
    
    }

    public function update($inputData,$id)
            {
                
                
                
                $vendorname = $inputData['vendorname'];
                $projectname = $inputData['projectname'];
                $projectmanager = $inputData['projectmanager'];
                $email = $inputData['email'];
                $duedate = $inputData['duedate'];
                $description = $inputData['description'];
                
                $stmt= $this->connect()->prepare("UPDATE tbproject_list SET vendor_name=?,project_manager= ? ,pm_email= ? ,project_name= ? ,description= ? ,end_date= ? WHERE project_id= ? LIMIT 1");
              
                if(!$stmt->execute(array($vendorname,$projectmanager,$email,$projectname,$description,$duedate,$id))){
                    $stmt = null;
                    header("location: admin.php?error=stmtfailedupdate");
                    exit();
                }
            
                if($stmt->rowCount() == 0){
                    $stmt = null;
                    
                    header("location: admin.php?error=invaliemailentered");
                    exit();
                }
                header('location:insertuser.php?valueupdated');


            }
    public function setuser($username,$vendorname,$projectmanager,$projectname,$pm_email,$duedate,$description)
    {
         
         
                // $uid= $_SESSION['useruid'];
         
                $stmt= $this->connect()->prepare("SELECT * FROM tbuser WHERE  user_name = ?;");
           
                if(!$stmt->execute(array($username)))
                    {
                        $stmt = null;
                        header("location: insertuser.php?error=stmtfailedsetuser");
                        exit();
                    }
        
                if($stmt->rowCount() == 0)
                    {
                        $stmt = null;
                        echo
                        "
                        <script>
                        alert('NO user create one');
                        document.location.href = 'addvendor.php';
                        </script>
                        ";
                    
                    }
                  
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
              
                $userid=$data[0]["user_id"];
               
                $update=$this->connect()->prepare('INSERT INTO tbproject_list( vendor_name,project_manager,pm_email, project_name,description, end_date, users_id, created_by, updated_by) VALUES (?,?,?,?,?,?,?,?,?);');
              
                if(!$update->execute(array($vendorname,$projectmanager,$pm_email,$projectname,$description,$duedate,$userid,$userid,$userid)))
                        {
                            $stmt = null;
                            header("location: insertuser.php?error=stmtfailed");
                            exit();
                        }
                       
                        $email =$pm_email;
                       
                        $sendmail = new email;
                       
                        $subject=  'project created';
                        $email_template = "
                                            <h2>A new project was created:</h2>
                                            <br>
                                            <p>
                                            <br>Vendor Name:$vendorname
                                            <br>Project Manager:$projectmanager
                                            <br>Project Name:$projectname
                                            <br>Description:$description
                                            <br>Due Date:$duedate
                                            </p>

                                            ";
                                            
                        $sendmail->sendmail($subject,$email_template,$email);
                       
                        echo
                            "
                            <script>
                            alert('add successfully');
                            document.location.href = 'insertuser.php';
                            </script>
                            ";
                        // header("location: insertuser.php?error=userisadded");
                        // exit();
                
            }

}