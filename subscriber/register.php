<?php
    include "/var/www/celestiallearning/utilities/dbconnect.php";  // Include Database Connection file
    include "/var/www/celestiallearning/utilities/SMTPMail.php";

    /* Twig implementation*/
    require '/var/www/celestiallearning/vendor/autoload.php';
    use Twig\Environment;
    use Twig\Loader\FilesystemLoader;
    $loader = new FilesystemLoader('/var/www/celestiallearning/templates');
    $twig = new Environment($loader);

    $errors = array();
    $password = $_POST['password'];

    // Fields are empty.
    if(!isset($_POST['username'],$_POST['email'],$_POST['password'],$_POST['confirm_password']))
    {
        $errors['not_set_error'] = 'Please complete the registration.';
        $twig->render('register.html.twig', array('errors'=> $errors));
    }

    else if(empty($_POST['username'])||empty($_POST['email'])||empty($_POST['password'])||empty($_POST['confirm_password']))
    {    
        $errors['empty_error'] = 'Please complete the registration.';
        $twig->render('register.html.twig', array('errors'=> $errors));   
    }

    else if(strlen($password)>72)
    {
        $errors['password_length'] = 'Password is too lengthy.';
        $twig->render('register.html.twig', array('errors'=> $errors));   
    }
    else
    {
        $db = Database::getInstance();     // Creating instance of Database
        $conn = $db->getConnection();     // Create Connection 
        
        $query = $conn->prepare("SELECT ID FROM Subscriber WHERE Email = ?");     // Email already registered verification
        $query->bind_param('s',$emailid);
        $emailid = $_POST["email"];
        $query->execute();
        $result1 = $query->get_result();
        
        $query = $conn->prepare("SELECT ID FROM Subscriber WHERE Username = ?");   //Username already taken verification
        $query->bind_param('s',$username);
        $username = $_POST["username"];
        $query->execute();
        $result2 = $query->get_result();

        if($result1 || $result2)
        {
            $row_count1 = mysqli_num_rows($result1);
            $row_count2 = mysqli_num_rows($result2);
            
            if($row_count1>0)
            {
                $errors['email_error']  = '* You are already registered with this email address.';
                echo $twig->render('register.html.twig', array('errors' => $errors));    
            }
            else if($row_count2>0)
            {
                $errors['username_error']  = '* Username is already taken.';
                echo $twig->render('register.html.twig', array('errors' => $errors));
            }
            else
            {      
                $stmt = $conn->prepare("INSERT INTO Subscriber values(?,?,?,?,?)");      // Inserting values into database after every verification
                $stmt->bind_param("sssss",$ID,$username,$email,$password, $status);
                $username = $_POST["username"];
                $ID = password_hash($username,1);
                $email = $_POST["email"];
                $password = password_hash($_POST["password"], 1);
                $status = "Inactive";
                sendActivationMail($email, $username);
                $stmt->execute();
                //header('Location: dashboard.php');
                echo $twig->render('register.html.twig', ['activation_link' => "You have registered and the activation mail is sent to your email. Click the activation link to activate you account."]);                                      
            }
        }
    }
?>
