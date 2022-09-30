<?php
    include 'header.admin.php';
    echo "<br>";
    echo "<br>";
    echo "<br>";
    include "dbh.classes.php";
    include "vendorController.php";
        if(isset($_POST["submit"]))
        { 
            $id= 1;
            $user = new vendorController();
            $user->insertuser($id);
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
<body>
   
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th> ID </th>
            <th>Vendor Name</th>
            <th>Project Name</th>
            <th>Project Manager</th>
            <th>Email</th>
            <th>Edit</th>
            <th>Delete</th>
            <th>View<th>

        </tr>
    </thead>
    <tbody>
        <?php
     
        
            $student = new vendorController;
          
            $result = $student->index();
            
            if($result)
            {
                foreach($result as $row)
                  {
        ?>
                    <tr>
                        <td>
                            <?= $row["project_id"] ?>
                        </td>
                        <td>
                            <?= $row["vendor_name"] ?>
                        </td>
                        <td>
                            <?= $row["project_name"] ?>
                        </td>
                        <td>
                            <?= $row["project_manager"] ?>
                        </td>
                        <td>
                            <?= $row["pm_email"] ?>
                        </td>
                        <td>
                            <a href="projectlist-edit.php?id=<?= $row["project_id"] ?>" class="btn btn-success">EDIT</a>
                        </td>
                        <td>
                    
                            <form action="projectupdate.php" method="POST">
                                    <button type="submit" name="deleteUser" class="btn btn-danger" value="<?= $row["project_id"] ?>">Delete</button>
                            </form>
                        <td>
                        <form action="taskdisp.php" method="POST">
                                    <button type="submit" name="viewproject" class="btn btn-success" value="<?= $row["project_id"] ?>">View</button>
                            </form>
                            
                        </td>
                    </tr>

        <?php
                  }
            }else{
                    echo "No record found";
                  }
              
        ?>
        <?php
                $uid=$row["users_id"];
                
                $studentgetuser = new vendorController;
               
                $getuser = $studentgetuser->getuser($uid);
                if($getuser){
                  
        ?>
          <a href="index.php">BACK</a>  
          <h1 style="border: 2px solid black;width: max-content;padding: 10px;margin: 10px;"> welcome <?= $_SESSION['useruid'] ?></h1>
       
        <?php
                }else{
                    echo "No record found";
                  }
        ?>
       
       <form action="addvendor.php" method="POST">
                    <button type="submit" class="btn btn-lg btn-primary" style="float: right;margin-right: 10px;padding: 5px;" >+Add Vendor</button>
        </form>
        <form action="addUserview.php" method="POST">
        <button type="submit" name="deleteUser" class="btn btn-lg btn-primary" style="float: right;margin-right: 10px;padding: 5px;" value="<?= $row["user_id"] ?>" >+Add User</button>
        </form>
      
       
    </tbody>
  
</table>

</body>
</html>
