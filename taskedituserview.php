<?php
        session_start();
        include('dbh.classes.php');
        include "controller/taskController.php";
        include 'header.admin.php';
        echo"<br>";
        echo"<br>";
        echo"<br>";
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
        <body>
                <a  class="btn btn-dark" href="insertuser.php">Back</a> 
                <h2><hr> Project Progress</h2>
                <?php            
                        if(isset($_POST['viewproject']))
                            {
                                $project_id=$_POST['viewproject'];
                            }else{
                                    $project_id=$_GET['id'];
                                }
                        $_SESSION['projectidadmin']=$project_id;                       
                        $project = new taskContr;                
                        $result = $project->viewProject($project_id);
                        $trailid= $result[0]["project_id"];
                        if($result)
                            {
                                foreach($result as $row)
                                    {
                                        $_SESSION['projectname']=$row["project_name"];
                                        $_SESSION['projectmanager']=$row["project_manager"]; 
                ?>
                <div style="border: 1px solid black;margin: 30px;padding: 30px;">
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
                                            <td><?= $row["t_status"] ?></td>
                                            <td><?= $row["priority"] ?></td>
                                            <td>
                                                <a href="admintaskview.php?id=<?=$row["task_id"] ?>" class="btn btn-success">View More</a>
                                            </td>
                                            <td>
                                                <a href="taskeditview.php?id=<?=$row["task_id"] ?>" class="btn btn-primary">Edit</a>
                                            </td>
                                            <td>
                                                <form action="deletetask.php" method="POST">
                                                    <button type="submit" name="deletetask" class="btn btn-danger" value="<?= $row["task_id"] ?>">Delete</button>
                                                </form>
                                            </td>
                                            </tr>

                                            <?php
                                        }
                                        }else{
                                        
                                            echo "No record found";
                                        }
                                ?>  
                            </tbody> 
                        </table>
        </body>
    </html>
