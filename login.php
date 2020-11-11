<?php
    include "dbconnect.php";

    require __DIR__ . '/vendor/autoload.php';
    use Twig\Environment;
    use Twig\Loader\FilesystemLoader;
    $loader = new FilesystemLoader(__DIR__ . '/templates');
    $twig = new Environment($loader);
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
            //echo $row_count;
            if ($row_count == 1)
            {
                $row = $result->fetch_assoc();
                $hash = $row['Password'];
                $password = $_POST['password'];
                if(password_verify($password, $hash))
                {
                    //echo "i am in part";
                    $stmt = $conn->prepare("SELECT AccountStatus FROM Subscriber WHERE Email = ?");
                    $stmt->bind_param("s", $email);
                    $email = $_POST['email'];
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if($result)
                    {
                        //echo " i am in another if";
                        $row_count2 = mysqli_num_rows($result);
                        //echo $row_count2;
                        $status = $result->fetch_assoc();
                        $status1 = $status['AccountStatus'];
                        //echo $status1;
                        if($status1=="Active")
                        {
                            header('Location: dashboard.php');
                        }
                        else
                        {
                            echo "Please activate your account! An activation link has been sent to your registered email address.";
                        }
                    }
                    
                    
                }
                else
                {
                    echo $twig->render('login.html.twig', ['invalid_login' => "Incorrect username or password."]);
                }
            }
            else
            {
                echo $twig->render('login.html.twig', ['invalid_login' => "Incorrect username or password."]);
            }
        }

    }
?>