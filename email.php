<?php
use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;



require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
class email
{  
    public function sendmail($subject,$email_template,$email)
    {
    $mail = new PHPMailer(true);
             
                    $mail->isSMTP(); 
                    $mail->Host= 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'afnatest18@gmail.com'; 
                    $mail->Password   = 'qdnmtberipkwzamo';  
                 
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port=465;
                
                
                    $mail->setFrom('afnatest18@gmail.com');
                    $mail->addAddress($email);
                    $mail->isHTML(true); 
                    $mail->Subject = $subject;
                    
                    $mail->Body = $email_template;
                   
                    $mail->send();
                    return;
                    // echo
                    //     "
                    //     <script>
                    //     alert('send Successfully');
                    //     document.location.href = 'index.php';
                    //     </script>
                    //     ";
 

}
}


   
    

?>