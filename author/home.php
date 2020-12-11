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
    else if(isset($_POST['login']))
    {
        echo $twig->render('author/login.html.twig', ['title' => 'login']);
    }
    else if(isset($_POST['forget_password']))
    {
        echo $twig->render('author/forgetpassword.html.twig', ['title' => 'Forget Password']);
    }
    else if(isset($_POST['register']))
    {
        echo $twig->render('author/register.html.twig', ['title' => 'Registration']);
    }
?>