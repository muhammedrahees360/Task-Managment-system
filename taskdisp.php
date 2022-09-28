<?php
 include "dbconn.php";
 include "taskController.php";
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
            $result = $user->index();
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
                        <a href="edituserview.php?id=<?=$row["task_id"] ?>" class="btn btn-success">View More</a>
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