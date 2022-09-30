<?php
    session_start();
    include "dbh.classes.php";
    include "userfunction.php";
    include 'header.user.php';
  
   
    echo "<br>";
    echo "<br>";
    echo "<br>";
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
    <body style="padding: 3vw;">
    <a  class="btn btn-primary" href="index.php">BACK</a>  
        <h4 style="width: max-content;padding: 10px;margin: 10px;"> Welcome <?= $_SESSION['useruid']  ?></h4>
        
        <h2><hr> Project Progress</h2>
        <?php
     
        
            $project = new userfunction;
          
            $result = $project->viewProject();
            
            if($result)
            {
                foreach($result as $row)
                  {
                    $_SESSION['projectid']=$row['project_id'];
                    $_SESSION['projectname']=$row["project_name"];
                    $_SESSION['projectmanager']=$row["project_manager"]; 
                    
        ?>
        <div style="border: 2px solid black;margin: 30px;padding: 30px;border-radius: 10px;">
                <dl class="row">
                    <dt class="col-sm-3">Vendor Name</dt>
                    <dd class="col-sm-9"><?= $row["vendor_name"] ?></dd>

                    <dt class="col-sm-3">Project Name</dt>
                    <dd class="col-sm-9"><?= $row["project_name"] ?></dd>

                    <dt class="col-sm-3">Project Manager</dt>
                    <dd class="col-sm-9"><?= $row["project_manager"] ?></dd>
                    <dt class="col-sm-3">E-mail</dt>
                    <dd class="col-sm-9"><?= $row["pm_email"] ?></dd>
                    <dt class="col-sm-3">Description</dt>
                    <dd class="col-sm-9"><?= $row["description"] ?></dd>
                    <dt class="col-sm-3">End Date</dt>
                    <dd class="col-sm-9"><?= $row["end_date"] ?></dd>
                </dl>
        </div>
        <?php
                  }
            }else{
                header("location: insertuser.php?error=stmtfailed");
                  }
              
        ?>
         <h4>Task List<hr></h4>
    <form style="float:right;padding:5px" action="newtaskview.php" method="POST">
                            <button type="submit" name="Newtask" class="btn btn-primary" value="<?= $row["user_id"] ?>">+New Task</button>
                        </form>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th> Task id </th>
            <th>Task title</th>
            <th>End date</th>
            <th>Status</th>
            <th>Priority</th>
            <th></th>
            <th></th>
            <th></th>


        </tr>
    </thead>
    <tbody>
        <?php           
            $user = new userfunction ;
            $taskid=$_SESSION['projectid'];
            $result = $user-> viewtask($taskid);
            if($result)
            {
                foreach($result as $row)
                  {
                    ?>
                    <tr>
                    <td><?= $row["task_id"] ?></td>
                    <td><?= $row["task_title"] ?></td>
                    <td><?= $row["enddate"] ?></td>
                    <?php 
                    $status = new userfunction;
                    $resultstatus =$status->taskStatusUser($row['t_status']);
                    ?>
                    <td><?=  $resultstatus ?></td>
                    <?php 
                    $priority = new userfunction;
                    $resultpriority =$priority->taskPriorityUser($row['priority']);
                    ?>
                    <td><?= $resultpriority ?></td>
                    <td>
                        <a href="viewtaskdetail.php?id=<?=$row["task_id"] ?>" class="btn btn-success">View More</a>
                    </td>
                    <td>
                        <a href="edittask.php?id=<?=$row["task_id"] ?>" class="btn btn-primary">Edit</a>
                    </td>
                    <td>
                        <form action="usermodel.php" method="POST">
                            <button type="submit" name="deletetask" class="btn btn-danger" value="<?= $row["task_id"] ?>">Delete</button>
                        </form>
                    </td>
                    </tr>

                    <?php
                  }
                }else{
                    header("location: insertuser.php?error=stmtfailed");
                }
        ?>  
    </tbody> 
</table>
       
    </body>
</html>