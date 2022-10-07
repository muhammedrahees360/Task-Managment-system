<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>
    

<?php
require 'email.php';
class loginContr extends dbh
{
    public function loginUser($uid,$pwd)
        {  
            $stmt= $this->connect()->prepare('SELECT pwd FROM tbuser WHERE user_name= ? ;');
            if(!$stmt->execute(array($uid)))
            {
                $stmt = null;
                header("location: index.php?error=stmtfailed");
                exit();
            }
            if($stmt->rowCount() == 0)
            {
                $stmt = null;
                header("location: index.php?error=invalidusername");
                exit();
                
                
           
            }
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if(!password_verify($pwd,$data[0]['pwd'])){
                $stmt = null;
                header("location: index.php?error=wrongpassword");
                exit();
              
                
               
            }elseif(password_verify($pwd,$data[0]['pwd']))
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
                   $_SESSION['user_role']=$user[0]["user_role"] ;
                  
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
                   
                    header("location: index.php?error=invaliemailentered");
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
                header("location: index.php?success=linksendtoemail");
                exit();
              
               
    }
    public function resetpass($token,$date,$email)
    {
        $stmt= $this->connect()->prepare("SELECT * FROM tbuser WHERE resettoken = ? AND resettokenexpire=?;");
                if($stmt->execute(array($token,$date)))
                {
                        if($stmt->rowCount() == 1)
                        {
                            echo "
                            
                            <section class='vh-100 gradient-custom'>
                            <div class='container py-5 h-100'>
                                <div class='row d-flex justify-content-center align-items-center h-100'>
                                <div class='col-12 col-md-8 col-lg-6 col-xl-5'>
                                    <div class='card bg-dark text-white' style='border-radius: 1rem;'>
                                    <div class='card-body p-5 text-center'>
                                        <div class='mb-md-5 mt-md-4 pb-5'>
                                            <form action='updatepass.php' method='POST'>
                                                <h2 class='fw-bold mb-2 text-uppercase'>Create new password</h2>
                                                    <div class='form-outline form-white mb-4'>
                                                        <input type='password' id='typeEmailX' placeholder='New password' name='password' class='form-control form-control-lg'/>
                                                       
                                                    </div>
                                                    </div>
                                                <button class='btn btn-outline-light btn-lg px-5' name='updatepassword'  type='submit'>Update</button>
                                                <input type='hidden' name='email' value=$email>
                                            </form>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                    </section>
                            ";
                            exit();
                                
                        }else{
                            
                            header("location: index.php?error=linkexpired");
                            exit();
                        }      
                }else{
                    header("location: index.php?error=stmtfailed");
                    exit();
                            }                           
    }
    public function setpass($password,$email){
        $null="NULL";
        $resetpassword=password_hash($password,PASSWORD_DEFAULT);
        $stmt= $this->connect()->prepare("UPDATE tbuser SET pwd=? ,resettoken=?,resettokenexpire=NULL WHERE email=? ;");
                if($stmt->execute(array($resetpassword,$null,$email)))
                {
                    header("location: index.php?success=passwordupdated");
                    exit();
                         
                }else{
                    header("location: index.php?error=stmtfailed");
                    exit();
                     }
    }
}
?>
</body>
</html>



