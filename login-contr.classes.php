<?php
require 'email.php';
class loginContr extends dbh
{
    public function loginUser($uid,$pwd)
        {  
            $stmt= $this->connect()->prepare('SELECT pwd FROM tbuser WHERE user_name= ? OR email = ?;');
            if(!$stmt->execute(array($uid,$pwd)))
            {
                $stmt = null;
                header("location: index.php?error=stmtfailed");
                exit();
            }
            if($stmt->rowCount() == 0)
            {
                $stmt = null;
                header("location: index.php?error=usernotfound");
                exit();
            }
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if($data[0]["pwd"] !== $pwd){
                $stmt = null;
                header("location: index.php?error=wrongpassword");
                exit();
            }elseif($data[0]["pwd"] == $pwd)
                {
                    $stmt= $this->connect()->prepare('SELECT * FROM tbuser WHERE user_name= ? OR email = ? AND pwd = ?;');
                    if(!$stmt->execute(array($uid,$uid,$pwd)))
                    {
                            $stmt=null;
                            header("location: index.php?error=stmtfailed");
                            exit();
                    }
                    if($stmt->rowCount()==0)
                    {
                            $stmt = null;
                            header("location: index.php?error=usernotfound");
                            exit();
                    }
                    $user= $stmt->fetchAll(PDO::FETCH_ASSOC);
                    if(isset($_POST["remember"])) 
                    {
                            //COOKIES for username
                            setcookie ("user_login",$uid,time()+ (10 * 365 * 24 * 60 * 60));
                            
                            //COOKIES for password
                            setcookie ("userpassword",$pwd,time()+ (10 * 365 * 24 * 60 * 60));
                
                    } else {
                                if(isset($_COOKIE["user_login"])) 
                                {
                                    setcookie ("user_login","");
                                    if(isset($_COOKIE["userpassword"])) 
                                    {
                                        setcookie ("userpassword","");
                                    }
                                }
                            } 
            
                    session_start();
                    $_SESSION['userid']=$user[0]["user_id"];
                    $_SESSION['useruid']=$user[0]["user_name"];
                   
                    if($user[0]["user_role"] == 1)
                        {
                            header("location: insertuser.php?error=none");
                            exit();
                        }
                        elseif($user[0]["user_role"] == 2)
                            {
                                header("location: user.php?error=none");
                                exit();
                            }
                }
                $stmt= null;
        }
    public function forgetpass($email)
    {
                date_default_timezone_set('Asia/kolkata');
                $date=date('Y-m-d');    
                $token = md5(rand());     
                $checkemail= $this->connect()->prepare("SELECT * FROM tbuser WHERE  email =?;"); 
                if(! $checkemail->execute(array($email))){                  
                    $checkemail = null;
                    header("location: index.php?error=stmtfailed");
                    exit();
                }               
                if( $checkemail->rowCount() == 0){
                    $checkemail = null;
                    echo
                    "
                    <script>
                    alert('invalid email');
                    document.location.href = 'index.php';
                    </script>
                    ";
                    // header("location: index.php?error=invaliemailentered");
                    exit();
                }                
                $data =  $checkemail->fetchAll(PDO::FETCH_ASSOC);  
                $name=$data[0]['user_name'];
                $email=$data[0]['email'];              
                $update_token =$this->connect()->prepare("UPDATE tbuser SET resettoken= ? ,resettokenexpire= ? WHERE email=?");               
                if(!$update_token->execute(array($token,$date,$email))){
                    $update_token = null;
                    header("location: index.php?error=stmtfailed");
                    exit();
                }else{
                    $sendmail = new email;
                    $subject=  'Reset Password link';
                    $email_template = "
                    <h2>Hello</h2>
                    <h3>You are receiving this email as we received a password reset request for your account</h3>
                    <br/><br/>
                    <a href='http://localhost/tms/updatepass.php?token=$token&email=$email'>Click Me</a>
                    ";
                    $sendmail->sendmail($subject,$email_template,$email);                    
                }
             echo"token updated";
                print_r($data);
                echo
                "
                <script>
                alert('token not entered');
                document.location.href = 'index.php';
                </script>
                ";
    }
    public function resetpass($token,$date,$email)
    {
        $stmt= $this->connect()->prepare("SELECT * FROM tbuser WHERE resettoken = ? AND resettokenexpire=?;");
                if($stmt->execute(array($token,$date)))
                {
                        if($stmt->rowCount() == 1)
                        {
                            echo "
                            <form  action='updatepass.php' method='POST'>
                                <h3>Create new password</h3>
                                <input type='password' placeholder='New password' name='password'>
                                <button type='submit' name='updatepassword'>UPDATE</button>
                                <input type='hidden' name='email' value=$email>
                            </form>
                            ";
                            exit();
                                
                        }else{
                            echo
                            "
                            <script>
                            alert('Expired link');
                            document.location.href = 'index.php';
                            </script>
                            ";
                        }      
                }else{
                            echo
                            "
                            <script>
                            alert('execution not working');
                            document.location.href = 'index.php';
                            </script>
                            ";
                            }                           
    }
    public function setpass($password,$email){
        $null="NULL";
        $stmt= $this->connect()->prepare("UPDATE tbuser SET pwd=? ,resettoken=?,resettokenexpire=NULL WHERE email=? ;");
                if($stmt->execute(array($password,$null,$email)))
                {
                    echo
                    "
                    <script>
                    alert('password updated');
                    document.location.href = 'index.php';
                    </script>
                    ";         
                }else{
                            echo
                            "
                            <script>
                            alert('execution not working');
                            document.location.href = 'index.php';
                            </script>
                            ";
                            }
    }
}




