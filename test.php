<?php

use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 
  
require 'vendor/autoload.php'; 
  
$mail = new PHPMailer(true); 
  
try { 
    $mail->SMTPDebug = 2;                                        
    $mail->isSMTP();                                             
    $mail->Host       = 'mail.resellerhostee.com';                     
    $mail->SMTPAuth   = true;                              
    $mail->Username   = 'info@hopekelltech.info';                  
    $mail->Password   = 'HPpc47590656';                         
    $mail->SMTPSecure = 'ssl';                               
    $mail->Port       = 465;   
  
    $mail->setFrom('info@hopekelltech.com.ng', 'HopekellDev');            
    $mail->addAddress('hopekell05@gmail.com'); 
       
    $mail->isHTML(true);                                   
    $mail->Subject = 'Subject'; 
    $mail->Body    = 'HTML message body in <b>bold</b> '; 
    $mail->AltBody = 'Body in plain text for non-HTML mail clients'; 
    $mail->send(); 
    echo "Mail has been sent successfully!"; 
} catch (Exception $e) { 
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; 
} 