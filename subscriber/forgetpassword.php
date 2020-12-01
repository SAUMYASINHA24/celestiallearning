<?php
    include "/var/www/celestiallearning/dbconnect.php";
    include "/var/www/celestiallearning/SMTPMail.php";
    /* Twig implementation*/
    require '/var/www/celestiallearning/vendor/autoload.php';
    use Twig\Environment;
    use Twig\Loader\FilesystemLoader;
    $loader = new FilesystemLoader('/var/www/celestiallearning/templates');
    $twig = new Environment($loader);

    $errors = array();
    if(!isset($_POST["registered_email"]))
    {
        $errors['not_set_error'] = 'Please enter email id to proceed further.';
        $twig->render('forgetpassword.html.twig', array('errors'=> $errors));
    }

    else if(empty($_POST['registered_email']))
    {    
        $errors['empty_error'] = 'Please enter email id to proceed further.';
        $twig->render('forgetpassword.html.twig', array('errors'=> $errors));   
    }
    else
    {
        $db = Database::getInstance();      // Creating instance of Database
        $mysql = $db->getConnection();      // Create Connection 
        $query = $mysql->prepare("SELECT ID FROM Subscriber WHERE Email = ?");      // Email already registered verification
        $query->bind_param('s',$emailid);
        $emailid = $_POST["registered_email"];
        $query->execute();
        $result1 = $query->get_result();
        if($result1)
        {
            $row_count = mysqli_num_rows($result1);
            if($row_count>0)
            {
                sendForgetPasswordLink($emailid);
                echo $twig->render('forgetpassword.html.twig', ['activation_link' => "An OTP has been sent on your registered mail id. Click the link to reset your password."]);                                      
            }
            else
            {
                $errors['not_registered'] = '* You are not registered.';
                echo $twig->render('forgetpassword.html.twig', array('errors'=> $errors)); 
            }
        }
        
            //sendForgetPasswordLink($emailid);
    }
        
    
?>