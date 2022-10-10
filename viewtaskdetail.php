    <?php
        session_start();
        include "dbh.classes.php";
        include "controller/userfunction.php";
        if(isset( $_SESSION['useruid'])){
        include 'header.user.php';      
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
    <style>
            body{
        margin-top:20px;
        
        }
        .card {
            margin-bottom: 1.5rem;
            box-shadow: 0 1px 15px 1px rgba(52,40,104,.08);
        }
        .card {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid #e5e9f2;
            border-radius: .2rem;
        }
        .card-header:first-child {
            border-radius: calc(.2rem - 1px) calc(.2rem - 1px) 0 0;
        }

        .card-header {
            border-bottom-width: 1px;
        }
        .card-header {
            padding: .75rem 1.25rem;
            margin-bottom: 0;
            color: inherit;
            background-color: #fff;
            border-bottom: 1px solid #e5e9f2;
        }
        </style>

</head>
<body style="padding: 3vw;">
    <a  class="btn btn-dark" href="user.php">Back</a> 
  
        <div class="container">
    <h1 class="h3 mb-3">Activities</h1>
    <div class="row">
        <div class="col-md-8 col-xl-9">
            <div class="card">
                <div class="card-header">
                    Project : <?=$_SESSION['projectname']?>
                </div>
                <div class="card-body h-100">    
                    <div class="media">                      
                        <div class="media-body">
                            Project Manger :  <?= $_SESSION['projectmanager']?>  
                        </div>
                    </div>    
                    <br>
                    <?php
  $index = 0;
  if(isset($_GET['id']))
  {       
         
      $id=$_GET['id'];
      $gettask = new userfunction;
      
      $taskresult =$gettask->gettask($id);
      $_SESSION['taskid']=$_GET['id'];             
?>

                    <div class="media">
                        
                        <div class="media-body">
          
                           Title :   <?=$taskresult[0]['task_title'] ?>
                            <br>
    
                         
                        </div>
                    </div>
                    <br>
                    <div class="media">
                        
                        <div class="media-body">
                            
                            Description
                            <br>
                            <div class="media-body">
                                <div class="border text-sm text-muted p-2 mt-1">
                                <?php 
                                if (strlen($taskresult[0]['description']) > 50) {
                                $str = '<span id="dots' . $index . '" style="overflow-wrap:break-word;max-width:300px">' . substr($taskresult[0]['description'], 0, 20) . '...</span><span id="more' . $index . '"><span>';
                                echo '<td><div style="overflow-wrap:break-word;max-width:500px">' . $str . '</span></div>
                                        <a  onclick="myFunction(' . $index . ',\'' . $taskresult[0]['description'] . '\')" id="myBtn' . $index . '" style="vertical-align-top;cursor:alias;color:blue;">more...</a></td>
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
                                echo '<td><div style="overflow-wrap:break-word;">' .$taskresult[0]['description'] . '</div></td>';
                                } ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <?php                                              
                            $getimage = new userfunction;  
                            $variabe='image_url'; 
                            $table='image';
                            $value='task_id';                                                            
                            $resultimage = $getimage->getimage($id,$variabe,$table,$value);                                                                                                      
                            if($resultimage)
                                {
                                $num = sizeof($resultimage);
                                for($i =0;$i<$num;$i++)
                                {
                        ?>  
                    <div class="media">                       
                        <div class="media-body">
                            <strong>Image</strong> 
                            <br>
                            <div class="row no-gutters mt-1">
                                <div class="col-6 col-md-4 col-lg-4 col-xl-3" >
                                    <img src="Uploads/<?= $resultimage[$i]['image_url']?>" class="img-fluid pr-2" alt="Unsplash">
                                </div>
                                
                            </div>
    
                          
                        </div>
                    </div>
                    <?php
                            }
                        }
                        ?>
                    <?php
        }
        else{
            header("location:user.php?error=gotnotaskid");
         
            }
    ?>
                    
                </div>
            </div>
        </div>
    </div>
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
                                            <?php
                                        $variabe1='full_name'; 
                                        $table1='tbuser';
                                        $value1='user_id';  
                                        $task_id1=$resultofcomment[$j]['user_id'];
                                                                                           
                                        $user_role = $getcomment->getimage($task_id1,$variabe1,$table1,$value1); 
                                        ?>  
                                            <p class="small mb-0 ms-2"><?=$user_role[0]['full_name']?></p>
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
                    <input type="hidden" value="<?=$taskresult[0]['task_title'] ?>" name="taskttitle">
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
