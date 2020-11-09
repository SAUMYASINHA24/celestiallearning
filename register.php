<?php 
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
?>