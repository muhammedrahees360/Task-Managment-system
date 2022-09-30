<?php
 include "dbconn.php";
 include "userController.php";
 include 'header.admin.php';
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
<body>
<a href="insertuser.php">BACK</a>  

    <h2><center>Users List</center><hr></h2>
    <form style="float:right;padding:5px" action="addUserview.php" method="POST">
                            <button type="submit" name="deleteUser" class="btn btn-primary" value="<?= $row["user_id"] ?>">+Add User</button>
                        </form>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th> User id </th>
            <th>User Name</th>
            <th>Email</th>
            <th>User role</th>
            <th>Last Login</th>
            <th></th>
            <th></th>

        </tr>
    </thead>
    <tbody>
        <?php   
            $student = new userContr;
          
            $result = $student->index();
         
            if($result)
            {
                foreach($result as $row)
                  {
                    ?>
                    <tr>
                    <td><?= $row["user_id"] ?></td>
                    <td><?= $row["user_name"] ?></td>
                    <td><?= $row["email"] ?></td>
                    <td><?=($row["user_role"]== 1?'Admin':'projectmanager');?> </td>
                    <td><?= $row["updated_at"] ?></td>
                    <td>
                        <a href="edituserview.php?id=<?=$row["user_id"] ?>" class="btn btn-success">Edit</a>
                    </td>
                    <td>
                        <form action="deleteuser.php" method="POST">
                            <button type="submit" name="deleteUser" class="btn btn-danger" value="<?= $row["user_id"] ?>">Delete</button>
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