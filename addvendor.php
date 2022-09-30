<?php
    include('dbh.classes.php');
    include('vendorController.php');
    include ('header.admin.php');
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
    <a  class="btn btn-primary" href="insertuser.php">Back</a>  
    <h2><center>Add Vendor</center><hr></h2>
        <form name="chngpwd" action="projectupdate.php" method="POST" onSubmit="return valid();" style="width: 400px;margin: auto;border: 1px solid black;border-radius: 5px;padding: 56px 40px;">                      
                    <div class="mb-3">    
                        <label for="exampleInputEmail1" class="form-label">Username :</label>
                        <input type="text" class="form-control" name="uname" id="uname" placeholder="username">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Vendor Name :</label>
                        <input type="text" class="form-control" name="vname" id="vname" placeholder="vendorname">
                </div>
                <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Project Manager :</label>
                        <input type="text" class="form-control" name="pmanager"  id="pmanager" placeholder="project Manager" >
                </div>
                <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Project Manager Email :</label>
                        <input class="form-control" type="email" name="pemail" id="pemail" placeholder="project manger email" >
                </div>
                <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Project Name :</label>
                        <input type="text" class="form-control" name="pname"  id="pname" placeholder="projectname" >    
                </div>
                <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Due Date :</label>
                        <input  class="form-control"type="date" name="duedate" >
                </div>
                <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Description :</label>
                        <input type="text" class="form-control" name="description" placeholder="description" >
                
                </div>
                <input type="submit" name="addvendor" value="Add Vendor" />
    
        </form>
        <script type="text/javascript">
                    function valid()
                    {
                        if(document.chngpwd.opwd.value=="")
                        {
                            alert("Old Password Filed is Empty !!");
                            document.chngpwd.opwd.focus();
                            return false;
                        }
                        else if(document.chngpwd.npwd.value=="")
                        {
                            alert("New Password Filed is Empty !!");
                            document.chngpwd.npwd.focus();
                            return false;
                        }
                        else if(document.chngpwd.cpwd.value=="")
                        {
                            alert("Confirm Password Filed is Empty !!");
                            document.chngpwd.cpwd.focus();
                            return false;
                        }
                        else if(document.chngpwd.npwd.value!= document.chngpwd.cpwd.value)
                        {
                            alert("Password and Confirm Password Field do not match  !!");
                            document.chngpwd.cpwd.focus();
                            return false;
                        }
                        return true;
                    }
        </script>

    </body>
</html>
