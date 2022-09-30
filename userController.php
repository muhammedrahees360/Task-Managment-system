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
            $projectDeleteQuery = $this->connect()->prepare("DELETE FROM tbuser WHERE user_id= ? LIMIT 1");
            if(!$projectDeleteQuery->execute(array($user_id))){
                $projectDeleteQuery = null;
                header("location: displayuser.php?error=stmtfailed");
                exit();
            }
           
            if($projectDeleteQuery){
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
    $stmt= $this->connect()->prepare("UPDATE tbuser SET user_name=?,email=? WHERE user_id =?;");
    if(!$stmt->execute(array($username,$email,$user_id))){
        $stmt = null;
        header('location:displayuser.php?error=somethingWrong!');
    }
    header('location:displayuser.php?valueupdated');
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
    $email=$inputData['email'];
    $password=$inputData['password'];
    $userrole=$inputData['userrole'];
    $trailid= 1;
    $getuser =$this->connect()->prepare("INSERT INTO `tbuser`( `user_name`, `email`, `pwd`, `user_role`,`created_by`, `updated_by`) VALUES(?,?,?,?,?,?)");
             
    if(!$getuser->execute(array($username,$email,$password,$userrole,$trailid,$trailid)))
        {
            $getuser = null;
            header("location: disaplayuser.php?error=stmtfailed");
            exit();
        }
       
      if($getuser->rowCount() > 0)
          {
            $getuser =$this->connect()->prepare( "SELECT user_id FROM tbuser WHERE user_id=?;");
            $dataset = $getuser->fetchAll(PDO::FETCH_ASSOC);
            $realid=$dataset[0]['user_id'];
            $alteruser =$this->connect()->prepare("UPDATE tbuser SET created_by=?,updated_by=? WHERE user_id =?");       
                        if(!$alteruser->execute(array($realid,$realid,$realid)))
                            {
                                $getuser = null;
                                header("location: dispalyuser.php?error=stmtfailed");
                                exit();
                            }
            return $dataset;
        }else{
                return false;
            }
    }

   
}