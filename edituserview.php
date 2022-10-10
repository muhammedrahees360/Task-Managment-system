<?php
 include('dbh.classes.php');
 include "controller/userController.php";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="padding:2vw ;">
<a class="btn btn-dark" href="displayuser.php">Back</a>  
<br><br>
<div class="container">
  <h3>Edit User Details</h3>
  <?php
    if(isset($_GET['id'])){
        $user_id = $_GET['id'];
        $user = new userContr;
        $result = $user->edit($user_id);
        if($result){
          ?> 
              <form class="form-horizontal" action="adduser.model.php" method="POST">
              <input type="hidden" name="user_id" value="<?= $result[0]['user_id']?>">
                <div class="form-group">
                  <label class="control-label col-sm-2" for="username">Username</label>
                  <div class="col-sm-10">
                    <input type="text" value="<?=$result[0]['user_name']?>" class="form-control" name="username">
                  </div>
                  <br>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="email">Email</label>
                  <div class="col-sm-10">          
                    <input type="email" class="form-control" id="email" value="<?=$result[0]['email']?>" name="email">
                  </div>
                </div><br>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="email">Full Name</label>
                  <div class="col-sm-10">          
                    <input type="text" class="form-control" id="email" value="<?=$result[0]['full_name']?>" name="full_name">
                  </div>
                </div><br>
                <div class="form-group">        
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" name="editUser" class="btn btn-primary">Update</button>
                  </div>
                </div>
              </form>
          <?php
        }else{
          echo "<h4>No Record Found</h4>";
        }
    }else{
      echo "<h4>Something Went Wrong!</h4>";
    }
  ?>
</div>
</body>
</html>
