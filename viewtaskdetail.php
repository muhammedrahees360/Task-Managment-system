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
    <body style="padding: 3vw;">
    <a  class="btn btn-primary" href="user.php">Back</a>     
    <!-- <div style="margin: 10px;"> -->
        <div  style="padding-left:15%;display:flex;width:100%;">
            <h4 style="width:fit-content;padding:0">Project Name   :  <?=$_SESSION['projectname']?></h4>
            <br>
            <h4 style="width:fit-content;padding:0;margin-left:100px;">Project Manager  : <?= $_SESSION['projectmanager']?></h4>     
</div>              
</div>    
        <?php
            if(isset($_GET['id']))
            {           
                $id=$_GET['id'];
                $gettask = new userfunction;
                
                $taskresult =$gettask->gettask($id);
                $_SESSION['taskid']=$_GET['id'];             
        ?>
           <div style="width:fit-content;padding-left:15%">
                    <dd > Task Title  :  <?=$taskresult[0]['task_title'] ?></dd>                   
                    <dd >Description  : <?= $taskresult[0]['description']?></dd>
                   
                    <dd >Images  :
                        <?php                                              
                            $getimage = new userfunction;                                                             
                            $resultimage = $getimage->getimage($id);                                                                                                      
                            if($resultimage)
                                {
                                $num = sizeof($resultimage);
                                for($i =0;$i<$num;$i++)
                                {
                        ?>   
                        <div class="row" ">
                            <div class="column" style="display: table;clear: both;">
                                <img src="Uploads/<?= $resultimage[$i]['image_url']?>"  alt="...">
                            </div>
                        </div>
                        <?php
                            }
                        }
                        ?>
                    </dd>                                    
               
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
       </div>
           
        <div class="row d-flex " style="display:flex;padding-left: 15%;" >
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-0 border" style="background-color: #f0f2f5;margin-top:50px;">
                    <div class="card-body p-4">                       
                            <?php                           
                                    $getcomment = new userfunction;                                   
                                    $resultofcomment = $getcomment->getcomment();                                    
                                    $num =$_SESSION['num'];                                 
                                    if($resultofcomment)
                                        {                                  
                                        for($j=0;$j<$num;$j++)
                                            {                                      
                            ?>                            
                                 <div class="card mb-4">
                                    <div class="card-body">
                                        <p><?=$resultofcomment[$j]['comments']?></p>
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex flex-row align-items-center">                
                                            <p class="small mb-0 ms-2"><?=($resultofcomment[$j]['user_id']== 1?'Admin':$_SESSION['useruid']);?></p>
                                            </div>  
                                             <div class="d-flex flex-row align-items-center">
                                            <p class="small text-muted mb-0"><?=$resultofcomment[$j]['created_at']?></p>
              
                                            </div>                  
                                            </div>
                                    </div>
                                </div>
                            <?php
                              
                                }   
                            } else{
                                echo " ";
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