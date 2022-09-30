<?php

class login extends dbh{
    protected function getUser($uid,$pwd){    
        $stmt= $this->connect()->prepare('SELECT pwd FROM tbuser WHERE user_name= ? OR email = ?;');
        if(!$stmt->execute(array($uid,$pwd))){
            $stmt = null;
            header("location: index.php?error=stmtfailed");
            exit();
        }
        if($stmt->rowCount() == 0){
            $stmt = null;   
            header("location: index.php?error=usernotfound");
            exit();
        }
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($data[0]["pwd"] !== $pwd){
            $stmt = null;
            header("location: index.php?error=wrongpassword");
            exit();
        }elseif($data[0]["pwd"] == $pwd){
            $stmt= $this->connect()->prepare('SELECT * FROM tbuser WHERE user_name= ? OR email = ? AND pwd = ?;');
            if(!$stmt->execute(array($uid,$uid,$pwd))){
                $stmt=null;
                header("location: index.php?error=stmtfailed");
                exit();
            }
        if($stmt->rowCount()==0){
            $stmt = null;
            header("location: index.php?error=usernotfound");
            exit();
           }
        $user= $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(isset($_POST["remember"])) {
            //COOKIES for username
            setcookie ("user_login",$uid,time()+ (10 * 365 * 24 * 60 * 60));    
            //COOKIES for password
            setcookie ("userpassword",$pwd,time()+ (10 * 365 * 24 * 60 * 60));    
        } else {
            if(isset($_COOKIE["user_login"])) {
                setcookie ("user_login","");
                if(isset($_COOKIE["userpassword"])) {
                    setcookie ("userpassword","");
                }
            }
        }    
        session_start();
        $_SESSION['userid']=$user[0]["user_id"];
        $_SESSION['useruid']=$user[0]["user_name"];
        if($user[0]["user_role"] == 1){
            header("location: admin.php?error=none");
            exit();
           }
        elseif($user[0]["user_role"] == 2){
            header("location: user.php?error=none");
            exit();
           }
        }
        $stmt= null;
      }
}