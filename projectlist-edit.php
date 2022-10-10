<?php
    session_start();
    include 'dbh.classes.php';
    include 'controller/vendorController.php';
    if(isset( $_SESSION['useruid'])){
    include 'header.admin.php';
    echo "<br>";
    echo "<br>";
    echo "<br>";
    $date = date('Y-m-d');
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
<body style="padding:4vw">
<a class="btn btn-dark" href="insertuser.php" >Back</a>
<div style="margin-top:20px">
        <h2><center>EDIT </center></h2>
<?php
    if(isset($_GET['id']))
    {
        $id=$_GET['id'];
        $project = new vendorController;  
        $result =$project->insertuser($id);   
        if($result)       {
?>
    <form action="projectupdate.php"  method="POST">
        <input type="hidden" name="project_id" value="<?= $result[0]['project_id']?>">
        <!-- <input type="hidden" name="users_id" value=" $result['users_id']"> -->
            <div class="form-row" >
                <div class="form-group col-md-6" style="margin: auto;">
                <label for="inputname">Vendor</label>
                <input type="text" class="form-control"  value="<?= $result[0]['vendor_name']?>" name="vendorname" >
            </div>
            <br>
            <div class="form-group col-md-6" style="margin: auto;">
            <label for="inputname">Project</label>
            <input type="text" class="form-control" value="<?= $result[0]['project_name']?>" name="projectname" >
            </div>
            <br>  
        <br>
        <div class="form-group col-md-6" style="margin: auto;">
        <label for="inputname">Due Date</label>
        <input type="date"  min="<?php echo $date; ?>" class="form-control" value="<?= $result[0]['end_date']?>"  name="duedate" >
        </div>
        <br>
        <div class="form-group col-md-6" style="margin: auto;">
        <label for="inputname">Description</label>
        <textarea type="text" class="form-control"  value="<?= $result[0]['description']?>" name="description" ></textarea>
        </div>
        <br>
        <div class="col-md-6" style="display:flex;margin:auto;">
        <button type="submit" name="update" class="btn btn-primary" style="margin: 0 0 0 auto;">Update</button>
            </div>
    </form>
        <?php 
                    }
                    else{
                        echo "<h4>no result</h4>";
                    }
            }
            else{
                echo "<h4>no id </h4>";
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
