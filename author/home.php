<?php
    require '/var/www/celestiallearning/vendor/autoload.php';
    use Twig\Environment;
    use Twig\Loader\FilesystemLoader;
    $loader = new FilesystemLoader('/var/www/celestiallearning/templates');
    $twig = new Environment($loader);
    
    if(isset($_POST['author']))
    {
        echo $twig->render('author/home.html.twig', ['title' => 'Author']);
    }
    else if(isset($_POST['register']))
    {
        
        header("Location: register.php");
    }
    else if(isset($_POST['login']))
    {
        
        header("Location: login.php");

    }
    else if(isset($_POST['forget_password']))
    {
        
        header("Location: forgetpassword.php");
    }   
?>