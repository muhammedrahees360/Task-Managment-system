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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body style="padding:4vw"> 

<a class="btn btn-primary" href="taskdisp.php?id=<?=$_SESSION['projectidadmin']?>">Back</a> 

    <h2><center>New Task</center></h2><hr>
<form class="row g-3" method="POST" action="addfile.php" enctype="multipart/form-data">
  <div class="col-md-6">
      <label for="inputEmail4" class="form-label">Task Tile</label>
      <input type="text" class="form-control" required id="inputEmail4" name="task_title">
  </div>
  <div class="col-md-6">
      <label for="inputEmail4" class="form-label">Description</label>
      <input type="text" class="form-control" required id="inputEmail4" name="description">
  </div>
  <div class="col-md-6">
      <label for="inputPassword4" class="form-label">Due Date</label>
      <input type="date" class="form-control" required id="inputPassword4" name="enddate">
  </div>
    <div class="col-md-4">
         <label for="inputState" class="form-label">Choose you Priority</label>
            <select name="priority" id="inputState" class="form-select">
             

                <option value="1">Critical</option>
                <option value="2">Important</option>
                <option value="3">Normal</option>
                <option value="4">Low</option>
            </select>
    </div>
    <div class="col-md-4">
         <label for="inputState" class="form-label">Task Status</label>
            <select name="t_status" id="inputState" class="form-select">               
                <option value="1">Started</option>
                <option value="2">On-progress</option>
                <option value="3">Done</option>
            </select>
    </div>
    <div class="mb-3">
                <label for="formFileMultiple" class="form-label">Upload file</label>
                <input style="max-width:25%" class="form-control" type="file" id="formFileMultiple"  name="my_image">
   </div>
   <div class="col-12"><center>
      <button style="margin-right: 10px;" type="submit" name="savetask" class="btn btn-success">Save</button>
      <button style="margin-left: 10px;" type="reset" class="btn btn-danger">Cancel</button></center>
  </div>
</form>
</body>
</html>