<?php
    require '/var/www/celestiallearning/vendor/autoload.php';
    use Twig\Environment;
    use Twig\Loader\FilesystemLoader;
    $loader = new FilesystemLoader('/var/www/celestiallearning/templates');
    $twig = new Environment($loader);
    
    if(isset($_POST['register']))
    {
        echo $twig->render('subscriber/register.html.twig', ['title' => 'Registration']);
    }
    else if(isset($_POST['login']))
    {
        echo $twig->render('subscriber/login.html.twig', ['title' => 'login']);
    }
    else if(isset($_POST['forget_password']))
    {
        echo $twig->render('subscriber/forgetpassword.html.twig', ['title' => 'Forget Password']);
    }
    else
    {
        echo $twig->render('index.html.twig');
    }
?>