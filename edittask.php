<?php
 session_start();
 include('dbh.classes.php');
 include "controller/taskController.php";
 if(isset( $_SESSION['useruid'])){
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="padding: 3vw;">
<a class="btn btn-primary" href="user.php">Back</a><br>
<div class="container" style="padding: 1vw;">
  <h3>Edit Task details</h3><hr>
  <?php
    if(isset($_GET['id'])){
        $user_id = $_GET['id'];
        $user = new taskContr;
        $result = $user->edit($user_id);
        if($result){
          ?> 
              <form class="form-horizontal" action="usermodel.php" method="POST">
              <input type="hidden" name="task_id" value="<?= $result[0]['task_id']?>">
              <input type="hidden" name="task_title" value="<?= $result[0]['task_title']?>">
              <input type="hidden" name="task_enddate" value="<?= $result[0]['enddate']?>">
                <div class="form-group">
                  <label class="control-label col-sm-2" for=""><b>Title  : </b><?=$result[0]['task_title']?></label>
                </div><br>
                <div class="form-group">
                  <label class="control-label col-sm-2" for=""><b>End date :  </b><?=$result[0]['enddate']?></label>                
                </div><br>
                <div class="col-md-4">
                        <label for="inputState" class="form-label"><b>Status </b></label>
                        <select name="status" id="inputState" class="form-select">                            
                            <option value="1">Started</option>
                            <option value="2">On-progress</option>
                            <option value="3">Done</option>
                           
                        </select>
                </div>
                <br>
                <div class="form-group">        
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" name="edittask" class="btn btn-primary">Update</button>
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
<?php
    }else{
        header("location:index.php");
    }

?>  
