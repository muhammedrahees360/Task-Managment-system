<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<button name="submit1"><li><a href='includes/logout.inc.php'>Login out</a></li></button>
    <?php
echo "helo user";

if(isset($_POST["submit1"])){
    session_start();
    session_unset();
    session_destroy();
   
    header("location: index.php?error=none");
}
    ?>
</body>
</html>