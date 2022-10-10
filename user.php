<?php
    session_start();
    include "dbh.classes.php";
    include "controller/userfunction.php";
    if(isset( $_SESSION['useruid'])){
    include 'header.user.php';
    echo "<br>";
    echo "<br>";
    echo "<br>";
    if(isset($_GET["error"])){
  
        if($_GET["error"] == 'stmtfailed'){
          echo "<p>Something went wrong,try again</p>";
        }
        elseif($_GET["error"] == 'none'){
          echo "<p style='color:green;'>Login Successful</p>";
        }
      }
   
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
    <body style="padding: 3vw;">
        <h4 style="width: max-content;padding: 10px;margin: 10px;"> Welcome <?= $_SESSION['useruid']  ?></h4>
        <h5><hr> Project Progress</h5>
        <?php
            $user_id= $_SESSION['userid'];
            $table='tbproject_list';
            $value='users_id';
            $index = 0;
            $project = new userfunction;
            $result = $project->viewProject($user_id,$table,$value);
           
            $table1='tbuser';
            $value1 ='user_id';
            $pass_value1=$result[0]['users_id'];
            $userdetail=$project->viewProject($pass_value1,$table1,$value1);
            $_SESSION['projectmanager']=$userdetail[0]["full_name"];  
            if($result)
            {
                foreach($result as $row)
                  {
                    $_SESSION['projectid']=$row['project_id'];
                    $_SESSION['projectname']=$row["project_name"];
                              
        ?>
        <div style="border: 2px solid black;margin: 30px;padding: 30px;border-radius: 10px;">
                <dl class="row">
                    <dt class="col-sm-3">Vendor</dt>
                    <dd class="col-sm-9"><?= $row["vendor_name"] ?></dd>

                    <dt class="col-sm-3">Project</dt>
                    <dd class="col-sm-9"><?= $row["project_name"] ?></dd>

                    <dt class="col-sm-3">Project Manager</dt>
                    <dd class="col-sm-9"><?= $userdetail[0]["full_name"]?></dd>
                    <dt class="col-sm-3">E-mail</dt>
                    <dd class="col-sm-9"><?= $userdetail[0]["email"] ?></dd>
                    <dt class="col-sm-3">Description</dt>
                    <dd class="col-sm-9">
                        <?php 
                        if (strlen($row['description']) > 50) {
                        $str = '<span id="dots' . $index . '" style="overflow-wrap:break-word;max-width:300px">' . substr($row['description'], 0, 20) . '...</span><span id="more' . $index . '"><span>';
                        echo '<td><div style="overflow-wrap:break-word;max-width:500px">' . $str . '</span></div>
                                <a  onclick="myFunction(' . $index . ',\'' . $row['description'] . '\')" id="myBtn' . $index . '" style="vertical-align-top;cursor:alias;color:blue;">more...</a></td>
                                <script>
                                function myFunction(id,description) {
                                var dots = document.getElementById("dots"+id);
                                var moreText = document.getElementById("more"+id);
                                var btnText = document.getElementById("myBtn"+id);
                                if (dots.style.display === "none") {
                                    dots.style.display = "inline";
                                    btnText.innerHTML = "more.."; 
                                    moreText.style.display = "none";
                                } else {
                                    dots.style.display = "none";
                                    btnText.innerHTML = "..less"; 
                                    moreText.style.display = "inline";
                                    moreText.innerText = description.toString() ;
                                }
                                }
                                </script>';
                        } else {
                        echo '<td><div style="overflow-wrap:break-word;">' . $row['description'] . '</div></td>';
                         } ?></dd>
                    <dt class="col-sm-3">End Date</dt>
                    <dd class="col-sm-9"><?= $row["end_date"] ?></dd>
                </dl>
        </div>
        <?php
                  }
                 
            }else{
                header("location: user.php?error=stmtfailed");
                  }
               
        ?>
         <h4>Task List<hr></h4>
   <?php
         if(isset($_GET["success"])){
  
            if($_GET["success"] == 'statusupdated'){
              echo "<center><p style='color:green;'>Status Updated</p></center>";
            }
            
          }   
   ?>
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
                        <a href="edittask.php?id=<?=$row["task_id"] ?>" class="btn btn-primary">Update</a>
                    </td>
                    <td>
                        <!-- <form action="usermodel.php" method="POST">
                            <button type="submit" name="deletetask" class="btn btn-danger" value="<?= $row["task_id"] ?>">Delete</button>
                        </form> -->
                    </td>
                    </tr>

                    <?php
                  }
                  
                }else{
                    echo "Currently No Task is Assigned ";
                    exit();
                }
        ?>  
    </tbody> 
</table>
       
    </body>
</html>
<?php
    }else{
        header("location:index.php");
    }

?>  
