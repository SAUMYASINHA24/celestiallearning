<?php
	include "dbconnect.php";
    $db = Database::getInstance();      // Creating instance of Database
    $conn = $db->getConnection();
   
   if(isset($_POST['otp'], $_POST['hash']))
   {
        $stmt = $conn->prepare("SELECT ExpiryTime, Email FROM Verify WHERE VerifyHash = ? AND Pin = ?");
        $stmt->bind_param("ss", $hash, $pin);
        $pin = $_POST['otp'];
        $hash = $_POST['hash'];
        $stmt->execute();
        $result = $stmt->get_result();
        $t = $result->fetch_assoc();
        $old_time = date("Y-m-d h:i:s", strtotime($t['ExpiryTime']));
        if($old_time > date("Y-m-d h:i:s"))
        {
            $stmt = $conn->prepare("UPDATE Subscriber SET AccountStatus = ? WHERE Email = ?");
            $stmt->bind_param("ss", $status, $email);
            $status = "Active";
            $email = $t['Email'];
            $stmt->execute();
        }
        else
        {
            echo "Verification Expiered.";
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
            $stmt = $conn->prepare("SELECT * FROM Verify WHERE VerifyHash = ? ");
            $stmt->bind_param("s", $hash);
            $hash = $_GET['t'];
            $stmt->execute();
            $result = $stmt->get_result();
            if($result)
            {
                $row_count = mysqli_num_rows($result);
                if($row_count == 1)
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
                    echo "Invalid Link";
                }
            }
       }
   }
   else
   {
        echo "Invalid Link.";
   }
?>