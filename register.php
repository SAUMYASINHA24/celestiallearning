<?php 
<<<<<<< HEAD
include "dbconnect.php";
include "SMTPMail.php";

if(!isset($_POST['username'],$_POST['email'],$_POST['password'],$_POST['confirm_password']))
{
    exit('Please complete the registration form.');
}
if(empty($_POST['username'])||empty($_POST['email'])||empty($_POST['password'])||empty($_POST['confirm_password']))
{
    exit('Please complete the registration form.');
}

$db = Database::getInstance();

$mysql = $db->getConnection();


$query = $mysql->prepare("SELECT ID,Username FROM Subscriber WHERE Email = ?");
$query->bind_param('s',$emailid);
$emailid = $_POST["email"];
$query->execute();
$result = $query->get_result();


if($result)
{
    $row_count = mysqli_num_rows($result);
    if($row_count>0)
    {
        echo "You are already registered.";
    }
    else
    {
        $stmt = $mysql->prepare("INSERT INTO Subscriber values(?,?,?,?,?)");
        $stmt->bind_param("sssss",$ID,$username,$email,$hash,$status);
        $ID = $_POST["username"];
        $username = $_POST["username"];
        $email = $_POST["email"];
        sendMail($email, $username);
        $password = $_POST["password"];
        $hash = password_hash($password, 2);
        $status = "Inactive";
        $stmt->execute();
    }
}
=======
include "dbconnect.php";  // Include Database Connection file

/* Twig implementation*/
require __DIR__ . '/vendor/autoload.php';
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
$loader = new FilesystemLoader(__DIR__ . '/templates');
$twig = new Environment($loader);

$errors = array();
$password = $_POST["password"];
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
    $db = Database::getInstance();      // Creating instance of Database
    $mysql = $db->getConnection();      // Create Connection 

    $query = $mysql->prepare("SELECT ID FROM Subscriber WHERE Email = ?");      // Email already registered verification
    $query->bind_param('s',$emailid);
    $emailid = $_POST["email"];
    $query->execute();
    $result1 = $query->get_result();

    $query = $mysql->prepare("SELECT ID FROM Subscriber WHERE Username = ?");   //Username already taken verification
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
            $stmt = $mysql->prepare("INSERT INTO Subscriber values(?,?,?,?)");      // Inserting values into database after every verification
            $stmt->bind_param("ssss",$ID,$username,$email,$password);
            $ID = $_POST["username"];
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $stmt->execute();
            header('Location: dashboard.php');                                      
        }
    }
}

>>>>>>> 1884be1a83fb1a7566689ca659b4019c44d25144
?>