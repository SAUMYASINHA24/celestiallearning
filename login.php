<?php
    include "dbconnect.php";
    if(isset($_POST['submit']))
    {
        $db = Database::getInstance();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("SELECT Password FROM Subscriber WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $email = $_POST['email'];
        $stmt->execute();
        $result = $stmt->get_result();

        if($result)
        {
            $row_count = mysqli_num_rows($result);
            if ($row_count == 1)
            {
                $row = mysqli_fetch_row($result);
                $hash = $row[0];
                $password = $_POST['password'];
                if(password_verify($password, $hash))
                {
                    echo "Login successfully.";
                }
                else
                {
                    echo "Incorrect username or password.";
                }
            }
            else
            {
                echo "Incorrect username or password.";
            }
        }

    }
?>