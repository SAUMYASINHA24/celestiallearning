<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    function sendActivationMail($email, $username, $role="subscriber"){
        require "/var/www/celestiallearning/vendor/autoload.php";
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = 0;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = "";                     // SMTP username
            $mail->Password   = "";                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            // goes in database
            
            $db = Database::getInstance();
            $conn = $db->getConnection();
            
            $stmt = $conn->prepare("INSERT INTO Verify VALUES(?,?,?,?)");
            
            $stmt->bind_param("ssss",$hash, $pin, $timestamp, $e);
            $timestamp = $email.$timestamp;
            $hash = md5($timestamp);
            $pin = rand(1000,9000);
            $timestamp = date("Y-m-d H:i:s", strtotime('1 hour'));  
            $e = $email;
            $stmt->execute();
            
            $actual_link = "http://www.celestiallearning.com/". $role ."/verify.php?t=" . $hash;
            //Recipients
            $mail->setFrom('noreply@celestiallearning.com', 'Celestial Learning');
            $mail->addAddress($email, $username);     // Add a recipient
            $body  = "<h2>Hello " . $username . "</h2>";
            $body .= "This is your One time password to activate your account. <b>". $pin ."</b><br>";
            $body .= "Click this link to activate your account. <a href='" . $actual_link . "'>" . $actual_link . "</a>";
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Account Activation Link';
            $mail->Body    = $body;
            //$content = "";
			//$mailHeaders = "From: Admin\r\n";
            $mail->AltBody = 'PHP mailer';
        
            $mail->send();
            return(true);
            
        } catch (Exception $e) {
            
            return(false);
            
        }
    }

    function sendForgetPasswordLink($email,$role="subscriber"){
        require '/var/www/celestiallearning/vendor/autoload.php';

        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = "";                     // SMTP username
            $mail->Password   = "";                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            // goes in database
            
            $db = Database::getInstance();
            $conn = $db->getConnection();

            $stmt = $conn->prepare("INSERT INTO Verify VALUES(?,?,?,?)");
            
            $stmt->bind_param("ssss",$hash, $pin, $timestamp, $e);
            $timestamp = $email.$timestamp;
            $hash = md5($timestamp);
            $pin = rand(1000,9000);
            $timestamp = date("Y-m-d H:i:s", strtotime('1 hour'));  
            $e = $email;
            $stmt->execute();
            //-------------------------
            $actual_link = "http://www.celestiallearning.com/". $role ."/forgetpasswordverify.php?t=" . $hash;
            //Recipients
            $mail->setFrom('noreply@celestiallearning.com', 'Celestial Learning');
            $mail->addAddress($email);     // Add a recipient
            $body  = "<h2>Hello " . "</h2>";
            $body .= "This is your One time password to reset your password. <b>". $pin ."</b><br>";
            $body .= "Click this link to reset password. <a href='" . $actual_link . "'>" . $actual_link . "</a>";
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Password Reset Link';
            $mail->Body    = $body;
            //$content = "";
			//$mailHeaders = "From: Admin\r\n";
            $mail->AltBody = 'PHP mailer';
        
            $mail->send();
            return(true);
            
        } 
        catch (Exception $e)
        {
            
            return(false);
        }
    }


    function sendUpdateEmailVerifyLink($email, $username,$role="subscriber")
    {
        $mail = new PHPMailer(true);

        try 
        {
            //Server settings
            $mail->SMTPDebug = 0;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = "";                     // SMTP username
            $mail->Password   = "";                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            // goes in database
            
            $db = Database::getInstance();
            $conn = $db->getConnection();

            $stmt = $conn->prepare("INSERT INTO Verify VALUES(?,?,?,?)");
            
            $stmt->bind_param("ssss",$hash, $pin, $timestamp, $e);
            $timestamp = $email.$timestamp;
            $hash = md5($timestamp);
            $pin = rand(1000,9000);
            $timestamp = date("Y-m-d H:i:s", strtotime('1 hour'));  
            $e = $email;
            $stmt->execute();
            //-------------------------
            $actual_link = "http://www.celestiallearning.com/". $role ."/emailupdateverify.php?t=" . $hash . "&email=" .$_SESSION['email']; 
            //Recipients
            $mail->setFrom('noreply@celestiallearning.com', 'Celestial Learning');
            $mail->addAddress($email, $username);     // Add a recipient
            $body  = "<h2>Hello " . $username . "</h2>";
            $body .= "This is your One time password to update your email. <b>". $pin ."</b><br>";
            $body .= "Click this link to update your email. <a href='" . $actual_link . "'>" . $actual_link . "</a>";
            $body .= "If you did not made any request to update email on Celestial Learning, kindly ignore this mail or contact our support team.";
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Please verify your email';
            $mail->Body    = $body;
            //$content = "";
            //$mailHeaders = "From: Admin\r\n";
            $mail->AltBody = 'PHP mailer';

            $mail->send();
            echo "Verification Link sent!";
        } 
        catch (Exception $e) 
        {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    }
    
?>
