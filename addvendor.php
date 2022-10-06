<?php
session_start();
    include('dbh.classes.php');
    include('controller/vendorController.php');
    if(isset( $_SESSION['useruid'])){
    include ('header.admin.php');
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
        <?php
             $value = 'user_role';
             $select ='user_name';
             $uid =2;
             $getusername = new vendorController;
             $username = $getusername->getuser($uid,$value,$select);
                  
        ?>
    <a  class="btn btn-primary" href="insertuser.php">Back</a>  
    
                   
                   
                    <?php
                
                    if($username){
                    $num=sizeof($username);
                   ?>
                    <div class="mb-3">  
                     
                   <h2><center>Add Vendor</center><hr></h2>
       
                    <form name="chngpwd" action="projectupdate.php" method="POST" onSubmit="return valid();" style="width: 400px;margin: auto;border: 1px solid black;border-radius: 5px;padding: 56px 40px;">                      
                   <label for="inputState" class="form-label">Username</label>
                    <select name="uname" id="inputState" class="form-select">  
                   <?php
                    
                    for ($h=0;$h<$num;$h++){
                    ?>
                         
                            <option value="<?=$username[$h]['user_name']?>"><?=$username[$h]['user_name']?></option>
                          
               
                      <?php
                    }
                    ?>
                       </select> 
                      <br>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Vendor :</label>
                        <input type="text" class="form-control" name="vname" id="vname" placeholder="vendorname">
                </div>
               
                <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Project :</label>
                        <input type="text" class="form-control" name="pname"  id="pname" placeholder="projectname" >    
                </div>
                <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Due Date :</label>
                        <input  class="form-control"type="date"  min="<?php echo $date; ?>"  name="duedate" >
                </div>
                <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Description :</label>
                        <input type="text" class="form-control" name="description" placeholder="description" >
                
                </div>
                <input class="btn btn-success" type="submit" name="addvendor" value="Add Vendor" >
                </form>
                </div>
                    <?php
                }else{
                  ?>
                 <br>
                  
                  <form style="width: 400px;margin: auto;border-radius: 5px;padding: 56px 40px;" action="addUserview.php" method="POST">
                  <!-- <h2><center>Add Vendor</center></h2> -->
                  <center><label style="color:red ;">No user found, Create one!</label></center><br>
                  <?php
                  $_SESSION['page']=1;
                  ?>
                  <center><button type="submit"  class="btn btn-primary" >+Add User</button></center>
                    </form>
                  <?php
            }
                      ?> 
                       
                         
                    
    
     
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
<?php
    }else{
        header("location:index.php");
    }

?>  