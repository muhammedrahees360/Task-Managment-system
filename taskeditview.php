<?php
 session_start();
 include('dbh.classes.php');
 include "controller/taskController.php";
 if(isset( $_SESSION['useruid'])){
 $date = date('Y-m-d');
 if(isset($_GET["error"])){  
  if($_GET["error"] == 'stmtfailed'){
    echo "<p>Something went wrong,try again</p>";
  }
  elseif($_GET["error"] == 'sorryyourfileistoolarge!'){
    echo "<p>Sorry Your file is too large</p>";
  }elseif($_GET["error"] == "youcantuploadthefileofthistype"){
      echo "<p>you can't upload the file of this type</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="padding:4vw ;">
<a  class="btn btn-primary" href="taskdisp.php?id=<?=$_SESSION['projectidadmin']?>">Back</a>
<div class="container">
  <h3>Edit Task details</h3>
  <?php
    if(isset($_GET['id'])){
        $user_id = $_GET['id'];
        $user = new taskContr;
        $result = $user->edit($user_id);
        if($result){
          ?> 
              <form class="form-horizontal" action="taskmodel.php" method="POST">
              <input type="hidden" name="task_id" value="<?= $result[0]['task_id']?>">
                <div class="form-group">
                  <label class="control-label col-sm-2" for="">Title</label>
                  <div class="col-sm-10">
                    <input type="text" value="<?=$result[0]['task_title']?>" class="form-control" name="task_title">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="">Description</label>
                  <div class="col-sm-10">
                    <input type="text" value="<?=$result[0]['description']?>" class="form-control" name="description">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2"  for="">End date</label>
                  <div class="col-sm-10">          
                    <input type="date" class="form-control"  min="<?php echo $date; ?>"  value="<?=$result[0]['enddate']?>" name="enddate">
                  </div>
                </div>
                <div class="col-md-4">
                        <label for="inputState" class="form-label">Priority</label>
                        <select name="priority" id="inputState" class="form-select">                            
                            <option value="1">Critical</option>
                            <option value="2">Important</option>
                            <option value="3">Normal</option>
                            <option value="4">Low</option>
                        </select>
                </div>
                <br>
                <div class="form-group">        
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" name="editTask" class="btn btn-primary">Update</button>
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
