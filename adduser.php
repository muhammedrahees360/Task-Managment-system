<?php
    include('dbh.classes.php');
    include('userController.php');
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

    <!-- <form name="chngpwd" action="projectupdate.php" method="POST" onSubmit="return valid();">
        <table align="center">
            <tr height="50">
                <td>Username :</td>
                <td><input type="text" name="uid"  id="uid" placeholder="username"></td>
            </tr>
            <tr height="50">   
                <td>Vendor Name :</td>
                <td> <input type="text" name="vname" id="vname" placeholder="vendorname"></td>
            </tr>
            <tr height="50">
                <td>Project Manager :</td>
                <td><input type="text" name="pmanager"  id="pmanager" placeholder="project Manager"></td>
            </tr>
            <tr>
                <td>Project Manager Email :</td>
                <td> <input type="email" name="pemail" id="pemail" placeholder="project manger email"></td>
            </tr>
            <tr>
                <td>Project Name :</td>
                <td> <input type="text" name="pname"  id="pname" placeholder="projectname"></td>
            </tr>
            <tr>
                <td>Due Date :</td>
                <td> <input type="date" name="duedate"></td>
                </tr>
        <td>Description :</td>
        <td> <input type="text" name="description" placeholder="description"></td>
        </tr>
        <tr height="50">
        <td><input type="submit" name="addvendor" value="Add Vendor" /></td>
        </tr>
        </table>
    </form>
    ////////////// -->
    <form name="chngpwd" action="projectupdate.php" method="POST" onSubmit="return valid();" style="
    width: 400px;
    margin: auto;
    border: 1px solid black;
    border-radius: 5px;
    /* padding-top: 56px; */
    padding: 56px 40px;
"> 
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Username :</label>
    <input type="text" class="form-control" name="uid"  id="uid" placeholder="username" 
" >
   
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
    <input type="text" class="form-control" name="pname"  id="pname" placeholder="projectname" 
    
>
   
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Due Date :</label>
    <input  class="form-control"type="date" name="duedate" 
   
>
   
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Description :</label>
    <input type="text" class="form-control" name="description" placeholder="description" 
   
>
   
  </div>
  <input type="submit" name="addvendor" value="Add Vendor" />
  <button type="submit" class="btn btn-primary">Submit</button>
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
