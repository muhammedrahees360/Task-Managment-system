<?php
class taskContr extends dbh {
    public function index()
            {
                $id=1;
                $studentQuery =$this->connect()->prepare( "SELECT * FROM tbtask_title WHERE ?;");
               
                if(!$studentQuery->execute(array($id))){
                    $studentQuery = null;
                    header("location: taskdisp.php?error=stmtfailed");
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
                        header('location:taskdisp.php?valueupdated');
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
}
