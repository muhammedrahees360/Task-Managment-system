<?php
    include 'header.admin.php';
    echo "<br>";
    echo "<br>";
    echo "<br>";
    include('dbconn.php');
    include_once('taskController.php');
    $task_id = $_GET['id']; 
    $_SESSION['taskid']=$task_id;
    $getview = new taskContr;
    $result = $getview->gettask($task_id);
    $status = $getview->taskStatusUser($result[0]['t_status']);
    $priority = $getview->taskPriorityUser($result[0]['priority']);
    $idgiveback=$_SESSION['projectidadmin'];
?>  
<a  class="btn btn-primary" href="taskdisp.php?id=<?=$idgiveback?>">Back</a>  
    <div style="margin: 10px;padding: 10px;">
        <dl class="row">
            <dt class="col-sm-3">Task Name:<?=$result[0]['task_title']?></dt>
            <dd class="col-sm-9">Task Due Date: <?= $result[0]['enddate']?></dd>                    
        </dl>
        <dl class="row">
            <dt class="col-sm-3">Status:<?=$status?></dt>
            <dd class="col-sm-9">Priority: <?=$priority?></dd>                    
        </dl>
    </div>
    <div style="border: 1px solid black;margin: 10px;padding: 10px;">
        <dl class="row">
            <dt class="col-sm-3">Description:</dt>
            <dd class="col-sm-9"><?= $result[0]['description']?></dd>
            <dt class="col-sm-3">Images:
                    <?php                                              
                        $getimage = new taskContr;                                                             
                        $resultimage = $getimage->getimage($task_id);                                                                                                                                                           
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
                    </dt>                                     
                </dl>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-0 border" style="background-color: #f0f2f5;">
                    <div class="card-body p-4">                       
                            <?php                        
                                    $getcomment = new taskContr;                     
                                   $resultget = $getcomment->getcomment();
                                    $num= $_SESSION['num'];
                                    if($resultget)
                                    {                                    
                                        for($i=1;$i<$num;$i++)
                                    {                                                                      
                            ?>
                    <div class="card mb-4">
                        <div class="card-body">
                        <p><?=$resultget[$i]['comments']?></p>
                            <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-row align-items-center">                
                                        <p class="small mb-0 ms-2"><?=($resultget[$i]['user_id']== 1?$_SESSION['useruid']:'projectmanager');?></p>                                   
                                    </div>  
                                        <div class="d-flex flex-row align-items-center">
                                            <p class="small text-muted mb-0"><?=$resultget[$i]['created_at']?></p>
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
                    <form action="deletetask.php" method="POST">
                            <input type="text" id="addANote" name="taskcomment" class="form-control" placeholder="Type comment..." />
                            <center><button type="submit" name="comment" class="btn btn-danger">Comment</button></center>
                        </form> 
                        
                    </div>
                </div>
            </div>
        </div>
    </div> 
   
   
    