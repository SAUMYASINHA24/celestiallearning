<?php
	include "/var/www/celestiallearning/utilities/dbconnect.php";
    $db = Database::getInstance();      // Creating instance of Database
    $conn = $db->getConnection();
   
   if(isset($_POST['otp'], $_POST['hash']))
   {
        $stmt = $conn->prepare("SELECT Email FROM Verify WHERE VerifyHash = ? AND Pin = ?");
        $stmt->bind_param("ss", $hash, $pin);
        $pin = $_POST['otp'];
        $hash = $_POST['hash'];
        $stmt->execute();
        $result = $stmt->get_result();
        $t = $result->fetch_assoc();
        if($t)
        {    
            $stmt = $conn->prepare("UPDATE Subscriber SET AccountStatus = ? WHERE Email = ?");
            $stmt->bind_param("ss", $status, $email);
            $status = "Active";
            $email = $t['Email'];
            $stmt->execute();    
            header('Location: login.html'); 
        }
        else
        {
?>
            <html>
                <head>
                    <script>
                        alert("Wrong OTP");
                    </script>
                </head>
                <body>
                    <form action = "" method = "POST">
                        Enter OTP: <input type = "text" name = "otp">
                        <input type="hidden" name="hash" value="<?php echo $hash ?>">
                        <button type="submit">Click here to activate</button>
                    </form>
                </body>
            </html>
<?php
             
            
        }
        
   }
   else if(isset($_GET['t']))
   {
       if(empty($_GET['t']))
       {
           echo "Invalid Link.";
       }
       else
       {
            
            $stmt = $conn->prepare("SELECT ExpiryTime FROM Verify WHERE VerifyHash = ? ");
            $stmt->bind_param("s", $hash);
            $hash = $_GET['t'];
            $stmt->execute();
            $result = $stmt->get_result();
            $t = $result->fetch_assoc();
            if($t)
            {            
                $old_time = date("Y-m-d H:i:s", strtotime($t['ExpiryTime'])); 
                if($old_time > date("Y-m-d H:i:s"))
                {
?>
                    <html>
                        <body>
                            <form action = "" method = "POST">
                                Enter OTP: <input type = "text" name = "otp">
                                <input type="hidden" name="hash" value="<?php echo $hash ?>">
                                <button type="submit">Click here to activate</button>
                            </form>
                        </body>
                    </html>
<?php
                }
                else
                {
                    echo "Link Expired. Please register again.";
                }
            }     
            else
            {
                echo "Invalid Link";
            }
        }
    }
   
   else
   {
        echo "Invalid Link...";
   }
?>