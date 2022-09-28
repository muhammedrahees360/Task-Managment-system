<?php
   include "dbh.classes.php";
    
   include "userController.php";
if(isset($_POST["submit"])){
 
    
    
   $id= 1;
  
    $user = new userController();
    // Running error handlers and user signup
   
    $user->insertuser($id);
    //Going to back to front page
               
   

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
     
        
            $student = new userController;
          
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
                            <a href="" class="btn btn-success">VIEW</a>
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
                
                $studentgetuser = new userController;
               
                $getuser = $studentgetuser->getuser($uid);
                if($getuser){
                  
        ?>
          <h1 style="
    border: 2px solid black;
    width: max-content;
    padding: 10px;
    margin: 10px;
"> welcome <?=$getuser[0]['user_name']  ?></h1>
          
        <?php
                }else{
                    echo "No record found";
                  }
        ?>
       
       <form action="adduser.php" method="POST">
                    <button type="submit" class="btn btn-lg btn-primary" style="float: right;margin-right: 10px;padding: 5px;" >+Add Vendor</button>
        </form>
        <button type="button" class="btn btn-lg btn-primary" style="float: right;margin-right: 10px;padding: 5px;" >+Add User</button>
        
       
    </tbody>
  
</table>

</body>
</html>
