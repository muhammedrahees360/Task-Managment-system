<?php
include 'dbh.classes.php';
include "vendorController.php";

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

<?php


$getimage = new vendorController ;
               
$result = $getimage->getimage();
$num = sizeof($result);

if($result){
    for($i =0;$i<$num;$i++)
    {

?>   
<div class="row" style="float: left;
        width: 33.33%;
        padding: 5px;">
<div class="column" style="display: table;
        clear: both;">
<img src="Uploads/<?= $result[$i]['image_url']?>"  alt="...">

</div>
    </div>
<?php
}
}
?>
</body>
</html>
