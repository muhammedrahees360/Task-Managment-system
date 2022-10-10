<?php
session_start();
if(isset( $_SESSION['useruid'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="padding:4vw;">
<?php
    include 'header.admin.php';
    echo "<br>";
    echo "<br>";
    echo "<br>";
    include('dbh.classes.php');
    include_once('controller/taskController.php');
    $task_id = $_GET['id']; 
    $_SESSION['taskid']=$task_id;
    $getview = new taskContr;
    $result = $getview->gettask($task_id);
    $status = $getview->taskStatusUser($result[0]['t_status']);
    $priority = $getview->taskPriorityUser($result[0]['priority']);
    $idgiveback=$_SESSION['projectidadmin'];
    $index = 0;
?>  
<a  class="btn btn-dark" href="taskdisp.php?id=<?=$idgiveback?>">Back</a>  
    <div style="margin: 10px;padding: 10px;">
        <dl class="row">
            <dd class="col-sm-3">Task Name :<?=$result[0]['task_title']?></dd>
            <dd class="col-sm-9">Task Due Date : <?= $result[0]['enddate']?></dd>                    
        </dl>
        <dl class="row">
            <dd class="col-sm-3">Status :<?=$status?></dd>
            <dd class="col-sm-9">Priority : <?=$priority?></dd>                    
        </dl>
    </div>
    <div style="margin: 10px;padding: 10px;">
        <dl class="row">
            <dd class="col-sm-3">Description:</dd>
            <dd class="col-sm-9">
                        <?php 
                        if (strlen($result[0]['description']) > 50) {
                        $str = '<span id="dots' . $index . '" style="overflow-wrap:break-word;max-width:300px">' . substr($result[0]['description'], 0, 20) . '...</span><span id="more' . $index . '"><span>';
                        echo '<td><div style="overflow-wrap:break-word;max-width:500px">' . $str . '</span></div>
                                <a  onclick="myFunction(' . $index . ',\'' . $result[0]['description'] . '\')" id="myBtn' . $index . '" style="vertical-align-top;cursor:alias;color:blue;">more...</a></td>
                                <script>
                                function myFunction(id,description) {
                                var dots = document.getElementById("dots"+id);
                                var moreText = document.getElementById("more"+id);
                                var btnText = document.getElementById("myBtn"+id);
                                if (dots.style.display === "none") {
                                    dots.style.display = "inline";
                                    btnText.innerHTML = "more.."; 
                                    moreText.style.display = "none";
                                } else {
                                    dots.style.display = "none";
                                    btnText.innerHTML = "..less"; 
                                    moreText.style.display = "inline";
                                    moreText.innerText = description.toString() ;
                                }
                                }
                                </script>';
                        } else {
                        echo '<td><div style="overflow-wrap:break-word;">' . $result[0]['description'] . '</div></td>';
                         } ?></dd>
            <dd class="col-sm-3">Images:
                    <?php                                              
                        $getimage = new taskContr;  
                        $variabe='image_url'; 
                        $table='image';
                        $value='task_id';                                                          
                        $resultimage = $getimage->getimage($task_id,$variabe,$table,$value);                                                                                                                                                           
                        if($resultimage)
                        {
                            $num = sizeof($resultimage);
                            for($i =0;$i<$num;$i++)
                                {
                    ?>   
                        <div class="row" ">
                            <div class="column" style="display: table;clear: both;">
                                <img  style="width:20vw" src="Uploads/<?= $resultimage[$i]['image_url']?>"  alt="...">                        
                            </div>
                        </div>
                    <?php
                                }
                        }
                    ?>
                    </dd>                                     
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
                                        for($i=0;$i<$num;$i++)
                                    {                                                                      
                            ?>
                    <div class="card mb-4">
                        <div class="card-body">
                        <p><?=$resultget[$i]['comments']?></p>
                            <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-row align-items-center">   
                                        <?php
                                        $variabe1='full_name'; 
                                        $table1='tbuser';
                                        $value1='user_id';  
                                        $task_id1=$resultget[$i]['user_id'];
                                                                                           
                                        $user_role = $getcomment->getimage($task_id1,$variabe1,$table1,$value1); 
                                        
                                        ?>             
                                        <p class="small mb-0 ms-2"><?=$user_role[0]['full_name']?></p>                                   
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
                                        echo " ";
                                    }                                                                                             
                            ?>                                               
                    <div class="form-outline mb-4">
                    <form action="taskmodel.php" method="POST">
                            <input type="text" id="addANote" name="taskcomment" class="form-control" placeholder="Type comment..." /><br>
                            <center><button type="submit" name="comment" class="btn btn-danger">Comment</button></center>
                        </form> 
                        
                    </div>
                </div>
            </div>
        </div>
    </div> 
    </body>
</html>
<?php
    }else{
        header("location:index.php");
    }

?>  
    
