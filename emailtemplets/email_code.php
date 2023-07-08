<?php
	//
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
 $mailpath="D:/xampp/htdocs/ums/PHPMailer/src/";
/* Exception class. */
require $mailpath.'Exception.php';

/* The main PHPMailer class. */
require $mailpath.'PHPMailer.php';

/* SMTP class, needed if you want to use SMTP. */
require $mailpath.'SMTP.php';
$mail = new PHPMailer(true);
try 
				{
					$mail->SMTPDebug = 3;                                       
					$mail->isSMTP();                                            
					$mail->Host ='smtp.gmail.com';                    
					$mail->SMTPAuth   = true;    
	
					 $mail->Username   = 'noreplygkuuniversity@gmail.com';                 
					$mail->Password   = 'vwzdxyfabjqnasbr';                        
					$mail->SMTPSecure = 'TLS';                              
					$mail->Port       = 587;   



					 $senderemail='noreplygkuuniversity@gmail.com'; 

$sendername='Guru Kashi University';
$subject='Test';

					$recevieremail='ratandeep2@gmail.com';
					$receviername='Amrik Singh';
		         include "new-admissin-confirmation.php";  
   	
					//From email address and name

					$mail->From = $senderemail;
					$mail->FromName =$sendername;

					//To address and name
					$mail->addAddress($recevieremail,$receviername);
					$mail->addAddress($recevieremail); //Recipient name is optional

					//Address to which recipient will reply
					$mail->addReplyTo($senderemail,"Reply");

	       
					$mail->isHTML(true);                                  
					$mail->Subject = $subject;
					$mail->Body= $body;
					//$mail->AltBody = 'Body in plain text for non-HTML mail clients';
					if($mail->send())
					{
						$_SESSION['message'] = "Please verify your account using link sent on your offical email";
						
						//echo '<script>window.location="login.php"</script>';
					}
					else
					{
						$_SESSION['error'] = "Mail could not be sent...";
						echo '<script>window.location="login.php"</script>';
					}
	
				} 
				catch (Exception $e) 
				{
					//ECHO "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
					//$_SESSION['error'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; 
				}
				
				
				

?>