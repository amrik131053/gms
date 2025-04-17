<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

/* Exception class. */
$mailpath='PHPMailer/src/';
require $mailpath . 'Exception.php';

/* The main PHPMailer class. */
require $mailpath . 'PHPMailer.php';
/* SMTP class, needed if you want to use SMTP. */
require $mailpath . 'SMTP.php';
$mail = new PHPMailer(true);

			try {
				$mail->SMTPDebug = 0;
				$mail->isSMTP();
				$mail->Host       = 'smtp.gmail.com';
				$mail->SMTPAuth   = true;

				 $mail->Username   = 'spocgku@gmail.com';                 
				$mail->Password   = 'ysnssrugbnzoeiht';     
				//  $mail->Username   = 'noreplygkuni@gmail.com';  
				// $mail->Password   = 'gmrwqljyjjnjkgsz';                        
				// $mail->Password   = 'ysnssrugbnzoeiht';                        
				//  $mail->Username   = 'noreplygkuniitdepartment@gmail.com';                 
				// $mail->Password   = 'evvpchesvgsppzny';                        
				$mail->SMTPSecure = 'TLS';                              
				$mail->Port       = 587;    

				$senderemail = 'noreplygkuni@gmail.com';
				$sendername = 'Guru Kashi University';
				//From email address and name
				$mail->From = $senderemail;
				$mail->FromName = $sendername;

				//To address and name
				$mail->addAddress($recevieremail, $receviername);
				$mail->addAddress($recevieremail); //Recipient name is optional

				//Address to which recipient will reply
				$mail->addReplyTo($senderemail, "Reply");


				$mail->isHTML(true);
				$mail->Subject = $subject;
				$mail->Body    = $body;
				$mail->AltBody = 'Body in plain text for non-HTML mail clients';
				if ($mail->send()) {
					// $_SESSION['message'] = "Your Password has been sent to your email id!";
                    echo  '1';
				} else {
					// $_SESSION['error'] = "Failed to Recover your password, try again";
					echo '2';
				}
			} catch (Exception $e) {
				// $_SESSION['error'] = "But Mail could not be sent. Mailer Error: {$mail->ErrorInfo}";
				echo '3';
			}



?>