<?php

    include "/var/www/celestiallearning/utilities/dbconnect.php";
    if(!isset($_POST['new_pass'],$_POST['confirm_pass']))
    {
        $errors['not_set_error'] = 'Please enter password.';
        //$twig->render('register.html.twig', array('errors'=> $errors));
    }

    else if(empty($_POST['new_pass'])||empty($_POST['confirm_pass']))
    {    
        $errors['empty_error'] = 'Please complete the registration.';
        //$twig->render('register.html.twig', array('errors'=> $errors));   
    }
    else
    {
        //echo "i am in else part";
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $email = $_POST["email"];
        //echo $email;
        $stmt = $conn->prepare("UPDATE Subscriber SET LoginPassword = ? WHERE Email = ?");
        $stmt->bind_param("ss",$hash,$email);
        $email = $_POST["email"];
        //echo $email;
        $new_pass = $_POST["new_pass"];
        $hash = password_hash($new_pass,2);
        //echo $hash;
        $stmt->execute();
        header('Location: login.html');
        
    }