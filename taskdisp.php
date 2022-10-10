<?php
        session_start();
        if(isset( $_SESSION['useruid'])){
        include('dbh.classes.php');
        include "controller/taskController.php";   
        include 'header.admin.php';
        echo"<br>";
        echo"<br>";
        echo"<br>";
        if (isset($_GET["success"])) {
            if ($_GET["success"] == 'valueupdated') {
                echo "<center><p style='color:green;'>Value Updated</p></center>";
            } elseif ($_GET["success"] == 'userisadded') {
              echo "<center><p>Vendor added successfully</p></center>";
            } elseif ($_GET["success"] == 'taskadded') {
                echo "<center><p style='color:green;'>Task added successfully</p></center>";
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
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        </head>
        <body style="padding: 3vw;">
                <a  class="btn btn-dark" href="insertuser.php">Back</a> 
                <h2><hr> Project Progress</h2>
                <?php
                        if(isset($_POST['viewproject']))
                            {   
                                $_SESSION['email']=$_POST['user_email'];
                                $project_id=$_POST['viewproject'];
                                $full_name =$_POST['full_name'];
                                $_SESSION['projectmanager']=$full_name; 
                            }else{
                                    $project_id=$_GET['id'];
                                }
                        $_SESSION['projectidadmin']=$project_id;                       
                        $project = new taskContr;    
                        $index = 0;            
                        $result = $project->viewProject($project_id);
                        $trailid= $result[0]["project_id"];
                        if($result)
                            {
                                foreach($result as $row)
                                    {
                                     
                                        $_SESSION['projectname']=$row["project_name"];
                                                                   
                ?>
                <div style="border: 1px solid black;margin: 30px;padding: 30px;">
                        <dl class="row">
                            <dt class="col-sm-3">Vendor</dt>
                            <dd class="col-sm-9"><?= $row["vendor_name"] ?></dd>
                            <dt class="col-sm-3">Project</dt>
                            <dd class="col-sm-9"><?= $row["project_name"] ?></dd>
                            <dt class="col-sm-3">Project Manager</dt>
                            <dd class="col-sm-9"><?= $_SESSION['projectmanager'] ?></dd>
                            <dt class="col-sm-3">E-mail</dt>
                            <dd class="col-sm-9"><?= $_SESSION['email']?></dd>
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
                    }else
                        {
                            echo "No record found";
                        }     
                ?>
                <h2><center>Task List</center><hr></h2>
                <form style="float:right;padding:5px" action="newtaskview.php" method="POST">
                                    <button type="submit" name="Newtask" class="btn btn-primary" value="<?= $row["user_id"] ?>">+New Task</button>
                </form>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th> Task id </th>
                            <th>Task title</th>
                            <th>Due date</th>
                            <th>Status</th>
                            <th>Priority</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                            <tbody>
                                <?php           
                                    $user = new taskContr;
                                    $result = $user->index($trailid);
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
                                                $status = new taskContr;
                                                $resultstatus =$status->taskStatusUser($row['t_status']);
                                            ?>
                                            <td><?=  $resultstatus ?></td>
                                            <?php 
                                                $status = new taskContr;
                                                $resultprioprity =$status->taskPriorityUser($row["priority"]);
                                            ?>
                                            <td><?= $resultprioprity ?></td>
                                            <td>
                                                <a href="admintaskview.php?id=<?=$row["task_id"] ?>" class="btn btn-success">View More</a>
                                            </td>
                                            <td>
                                                <a href="taskeditview.php?id=<?=$row["task_id"] ?>" class="btn btn-primary">Edit</a>
                                            </td>
                                            <td>
                                                <form action="taskmodel.php" method="POST">
                                                    <button type="submit" name="deletetask" class="btn btn-danger" value="<?= $row["task_id"] ?>">Delete</button>
                                                </form>
                                            </td>
                                            </tr>

                                            <?php
                                        }
                                        }else{
                                        
                                            echo "No Task Added";
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