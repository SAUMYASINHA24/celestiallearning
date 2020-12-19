<?php
    require '/var/www/celestiallearning/vendor/autoload.php';
    use Twig\Environment;
    use Twig\Loader\FilesystemLoader;
    $loader = new FilesystemLoader('/var/www/celestiallearning/templates');
    $twig = new Environment($loader);
    
   
    if(isset($_POST['register']))
    {
        
        header("Location: subscriber/register.php");
    }
    else if(isset($_POST['login']))
    {
       
        header("Location: subscriber/login.php");
    }
    else if(isset($_POST['forget_password']))
    {
        
        header("Location: subscriber/forgetpassword.php");
    }
    else
    {
        echo $twig->render('index.html.twig');
    }
?>