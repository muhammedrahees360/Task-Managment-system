<?php
include 'dbh.classes.php';
include "vendorController.php";


if(isset($_POST['submit']) && isset($_FILES['my_image'])){
    echo "<pre>";
    print_r($_FILES['my_image']);
    echo "<pre>";

    $img_name = $_FILES['my_image']['name'];
    $img_size = $_FILES['my_image']['size'];
    $tmp_name = $_FILES['my_image']['tmp_name'];
    $error = $_FILES['my_image']['error'];
    if($error ===0){
        if($img_size> 125000){
            $em = "sorry your file is too large!";
            header("Location: addfile.php?error=$em") ;
        }else{
            $img_ex = pathinfo($img_name,PATHINFO_EXTENSION);
            $img_ex_lc =strtolower($img_ex);

            $allowed_exs = array('jpg','jpeg','png');
            if(in_array($img_ex_lc,$allowed_exs)){
                $new_img_name = uniqid("IMG-" , true).'.'.$img_ex_lc;
                $img_upload_path = 'Uploads/'.$new_img_name;
                print_r($new_img_name);
                move_uploaded_file($tmp_name,$img_upload_path);
                
                $uploadimage = new vendorController ;
               
                $result = $uploadimage->uploadimage($new_img_name );

                 echo "added";


            }else{
                $em = "you can't upload the file of this type";
                header("Location: addfile.php?error=$em") ;
            }

        }

    }else{
        $em = "unknown error occured!";
        header("Location: addfile.php?error=$em") ;
    }

}else{
   header("Location: addfile.php") ;
}