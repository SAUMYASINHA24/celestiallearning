<?php
session_start();
require '/var/www/celestiallearning/vendor/autoload.php';
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
$loader = new FilesystemLoader( '/var/www/celestiallearning/templates/author');
$twig = new Environment($loader);

include "/var/www/celestiallearning/utilities/dbconnect.php";  // Include Database Connection file

if($_SERVER['REQUEST_METHOD']==='GET')
{
    echo $twig->render('updatepassword.html.twig');
}
else
{
    $db = Database::getInstance();
    $mysql = $db->getConnection();
    $email = $_SESSION['email'];
    $query = $mysql->prepare("SELECT LoginPassword FROM Author where Email=?");
    $query->bind_param('s',$email);
    $query->execute();
    $result1 = $query->get_result();
    $row_count1 = mysqli_num_rows($result1);
    
    
    foreach($result1 as $row)
    {
        
    }
    
    $currpassword = $row['LoginPassword']; //current password from db
    
    $oldpasswordcheck = $_POST["OldPassword"]; //current password from form
    
    
    
    
    if(password_verify($oldpasswordcheck,$currpassword))
    {
        $newpassword = password_hash($_POST["NewPassword"], 1); //new password from form
        $query = $mysql->prepare("UPDATE Authoe SET LoginPassword=?  WHERE Email=?");
        $query->bind_param('ss',$newpassword,$email);   
        $query->execute(); 
        echo $twig->render('updatepassword.html.twig', ['password_changed' => "Password Succesfully Updated!"]);
    }
    else
    {
        echo "incorerct";
    }
    
}

?>