<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    function sendMail($email, $username){
        
        require 'vendor/autoload.php';
        
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'celestial.learning2020@gmail.com';                     // SMTP username
            $mail->Password   = 'Celestial@2020';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            $actual_link = "http://$_SERVER[HTTP_HOST]/"."activate.php?id=" . $email;
            //Recipients
            $mail->setFrom('noreply@celestiallearning.com', 'Celestial Learning');
            $mail->addAddress($email, $username);     // Add a recipient
        
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Account Activation Link';
            $mail->Body    = "Click this link to activate your account. <a href='" . $actual_link . "'>" . $actual_link . "</a>";
            //$content = "";
			//$mailHeaders = "From: Admin\r\n";
            $mail->AltBody = 'PHP mailer';
        
            $mail->send();
            
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
?>