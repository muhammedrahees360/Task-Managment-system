<?php
session_start();
include 'header.user.php';
include "dbh.classes.php";
include "userfunction.php";

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
</head>
<body>
<a href="user.php">BACK</a>     

<div style="margin: 10px;padding: 10px;">
                <dl class="row">
                    <dt class="col-sm-3">Project Name:<?=$_SESSION['projectname']?></dt>
                    <dd class="col-sm-9">Project Manager:  <?= $_SESSION['projectmanager']?></dd>
                    
                </dl>
        </div>


<?php
  if(isset($_GET['id']))
  {
   
      $id=$_GET['id'];
      $gettask = new userfunction;
    
      $taskresult =$gettask->gettask($id);
      $_SESSION['taskid']=$_GET['id'];
     
        
?>
      <h5 style="margin-left: 50px;"> Task Title:  <?=$taskresult[0]['task_title'] ?></h5>
      <div style="border: 1px solid black;margin: 10px;padding: 10px;">
                <dl class="row">
                    <dt class="col-sm-3">Description:</dt>
                    <dd class="col-sm-9"><?= $taskresult[0]['description']?></dd>

                    <dt class="col-sm-3">Images:</dt>
                 
                    
                </dl>
        </div>
        <?php
            }
            else{
                    echo
                        "
                        <script>
                        alert('got no taskid');
                        document.location.href = 'user.php';
                        </script>
                        ";
                }
        ?>
       
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-0 border" style="background-color: #f0f2f5;">
                    <div class="card-body p-4">                       
                            <?php
                            
                                    $getcomment = new userfunction;
                     
                                    $result = $getcomment->getcomment();
                                  
                                    $num =$_SESSION['num'];
                                  if($result){
                                    
                                    for($i=1;$i<$num;$i++)
                                    {
                                        
                            ?>
                                 <div class="card mb-4">
                                    <div class="card-body">
                                        <p><?=$result[$i]['comments']?></p>
                                            <div class="d-flex justify-content-between">
                                                <div class="d-flex flex-row align-items-center">                
                                                    <p class="small mb-0 ms-2"><?=($result[$i]['user_id']== 1?'Admin':$_SESSION['useruid']);?></p>
                                                </div>  
                                                <div class="d-flex flex-row align-items-center">
                                                        <p class="small text-muted mb-0"><?=$result[$i]['created_at']?></p>
              
                                                    </div>                  
                                            </div>
                                    </div>
                                </div>
                            <?php
                              
                                }   
                            } else{
                                echo "no comments";
                            }                                                                                             
                            ?>   
                                                                     
                    <div class="form-outline mb-4">
                    <form action="usermodel.php" method="POST">
                            <input type="text" id="addANote" name="taskcomment" class="form-control" placeholder="Type comment..." />
                            <center><button type="submit" name="comment" class="btn btn-danger">Comment</button></center>
                        </form> 
                        
                    </div>
                </div>
            </div>
        </div>
    </div> 
   
   
         
    </body>
</html>  