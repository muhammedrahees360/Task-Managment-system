<?php

class userContr extends dbh {

    public function index()
            {
                $id=1;
                $studentQuery =$this->connect()->prepare( "SELECT * FROM tbuser WHERE ?;");
               
                if(!$studentQuery->execute(array($id))){
                    $studentQuery = null;
                    header("location: admin.php?error=stmtfailed");
                    exit();
                } 
                if($studentQuery->rowCount() > 0){
                    $data = $studentQuery->fetchAll(PDO::FETCH_ASSOC);
                   
                    return $data;
                    }else{
                        return false;
                    }
            }
    public function edit($user_id)
            {   
                $projectQuery = $this->connect()->prepare("SELECT * FROM tbuser WHERE user_id=? LIMIT 1");
                if(!$projectQuery->execute(array($user_id))){
                    $projectQuery = null;
                    header("location: displayuser.php?error=stmtfailed");
                    exit();
                }
                if($projectQuery->rowCount() > 0){
                    $data = $projectQuery->fetchAll(PDO::FETCH_ASSOC);
                    return $data;
                    }else{
                        return false;
                    }     
        }
     public function delete($user_id)
        {           
         
            $Deleteuser = $this->connect()->prepare("DELETE FROM tbuser WHERE user_id= ? LIMIT 1");
            
            if(!$Deleteuser->execute(array($user_id))){
                $Deleteuser = null;
                header("location: displayuser.php?error=stmtfailed");
                exit();
            }
            $deleteproject = $this->connect()->prepare("DELETE FROM tbproject_list WHERE users_id = ?");
            if(!$deleteproject->execute(array($user_id))){
                $deleteproject = null;
                header("location: displayuser.php?error=stmtfailed");
                exit();
            }
          
            if($Deleteuser){
                return true;
            }else{
                return false;
            }
        }
    public function insertuser($id)
    {   
        $stmt= $this->connect()->prepare("SELECT * FROM tbuser WHERE  user_id = ?;");
        if(!$stmt->execute(array($id))){
            $stmt = null;
            header("location: admin.php?error=stmtfailed");
            exit();
        }
        echo $stmt->rowCount();
        if($stmt->rowCount() == 0){
            $stmt = null;
            
            header("location: admin.php?error=invaliemailentered");
            exit();
        }
    
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
  
public function update($inputData,$user_id)
{
    $email = $inputData['email'];
    $username = $inputData['username'];
    $full_name = $inputData['full_name'];
    $stmt= $this->connect()->prepare("UPDATE tbuser SET user_name=?,email=?,full_name=? WHERE user_id =?;");
    if(!$stmt->execute(array($username,$email,$full_name,$user_id))){
        $stmt = null;
        header('location:displayuser.php?error=somethingWrong!');
    }
    header('location:displayuser.php?success=valueupdated');
    exit();
}
public function getuser($uid)
            {
                $getuser =$this->connect()->prepare( "SELECT user_name FROM tbuser WHERE user_id=?;");
             
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
public function create($inputData){
    $username=$inputData['username'];
    $fullname = $inputData['fullname'];
    $email=$inputData['email'];
    $password=password_hash($inputData['password'],PASSWORD_DEFAULT);
    $userrole=$inputData['userrole'];
    $trailid= 1;
    $getuser =$this->connect()->prepare("INSERT INTO `tbuser`( `user_name`, full_name,`email`, `pwd`, `user_role`,`created_by`, `updated_by`) VALUES(?,?,?,?,?,?,?)");
             
    if(!$getuser->execute(array($username, $fullname,$email,$password,$userrole,$trailid,$trailid)))
        {
            $getuser = null;
            header("location: disaplayuser.php?error=stmtfailed");
            exit();
        }
        $setuser =$this->connect()->prepare( "SELECT user_id FROM tbuser WHERE full_name=?;");
        $setuser->execute(array($fullname));   
        $dataset = $setuser->fetchAll(PDO::FETCH_ASSOC);
        $realid=$dataset[0]['user_id'];
        $alteruser =$this->connect()->prepare("UPDATE tbuser SET created_by=?,updated_by=? WHERE user_id =?");       
                    if(!$alteruser->execute(array($realid,$realid,$realid)))
                        {
                            $setuser = null;
                            header("location: dispalyuser.php?error=stmtfailed");
                            exit();
                        }
        $pageupdate=$this->connect()->prepare("SELECT * FROM tbuser WHERE user_role = ?");
        $pageupdate->execute(array(2));
     
      if(($pageupdate->rowCount() == 1) && ($_SESSION['page']=1) )
          {
           $_SESSION['page'] =0;
            return true;
        }else{
                return false;
            }
    }

   
}