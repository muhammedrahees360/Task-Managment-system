<?php
    include "dbh.classes.php";
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
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        </head>
        <body style="padding:3vw ;">
        <a class="btn btn-primary" href="displayuser.php">Back</a>  
            <h2><center>Add User</center></h2><hr>
            <form class="row g-3" method="POST" action="addUser.php">
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Username</label>
                    <input type="text" class="form-control" required id="inputEmail4" name="user_name">
                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" class="form-control" required id="inputEmail4" name="email">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Password</label>
                    <input type="password" class="form-control" required id="inputPassword4" name="pwd">
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">Choose you Role</label>
                    <select name="user_role" id="inputState" class="form-select">
                        <option selected>Choose...</option>
                        <option value="1">Admin</option>
                        <option value="2">Project Manager</option>
                    </select>
                </div>
                <div class="col-12"><center>
                    <button style="margin-right: 10px;" type="submit" name="saveUser" class="btn btn-success">Save</button>
                    <button style="margin-left: 10px;" type="reset" class="btn btn-danger">Cancel</button></center>
                </div>
            </form>
        </body>
    </html>