<?php
    include 'dbh.classes.php';
    include 'vendorController.php';
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
        <h2>EDIT </h2>
<?php
    if(isset($_GET['id']))
    {
        $id=$_GET['id'];
        $project = new vendorController;
        
        $result =$project->insertuser($id);
    
        
        if($result)
            {
?>
    <form action="projectupdate.php"  method="POST">
        <input type="hidden" name="project_id" value="<?= $result[0]['project_id']?>">
        <!-- <input type="hidden" name="users_id" value=" $result['users_id']"> -->
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputname">Vendor Name</label>
                <input type="text" class="form-control"  value="<?= $result[0]['vendor_name']?>" name="vendorname" >
            </div>
            <div class="form-group col-md-6">
            <label for="inputname">Project Name</label>
            <input type="text" class="form-control" value="<?= $result[0]['project_name']?>" name="projectname" >
            </div>
        <div class="form-group col-md-6">
        <label for="inputname">Project Manager</label>
        <input type="text" class="form-control"   value="<?= $result[0]['project_manager']?>" name="projectmanager" >
        </div>
        <div class="form-group col-md-6">
        <label for="inputname">Email</label>
        <input type="email" class="form-control"  value="<?= $result[0]['pm_email']?>"  name="email" >
        </div>
        <div class="form-group col-md-6">
        <label for="inputname">Due Date</label>
        <input type="date" class="form-control" value="<?= $result[0]['end_date']?>"  name="duedate" >
        </div>
        <div class="form-group col-md-6">
        <label for="inputname">Description</label>
        <input type="text" class="form-control"  value="<?= $result[0]['description']?>" name="description" >
        </div>
        <button type="submit" name="update" class="btn btn-primary">Update</button>
    </form>
        <?php 
                    }
                    else{
                        echo "<h4>Record not found</h4>";
                    }
            }
            else{
                echo "<h4>Something went wrong</h4>";
            }

        ?>

</body>
</html>