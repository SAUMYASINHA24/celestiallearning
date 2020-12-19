<?php
session_start();
require '/var/www/celestiallearning/vendor/autoload.php';
include "/var/www/celestiallearning/utilities/dbconnect.php";  // Include Database Connection file
include "/var/www/celestiallearning/utilities/SMTPMail.php";

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
$loader = new FilesystemLoader( '/var/www/celestiallearning/templates/subscriber');
$twig = new Environment($loader);

$db = Database::getInstance();
$mysql = $db->getConnection();
$query = $mysql->prepare("SELECT Username FROM Subscriber WHERE Email = ?");   //Username already taken verification
$query->bind_param('s',$_SESSION['email']);
$query->execute();
$result = $query->get_result();

foreach($result as $row)
{

}

$username = $row['Username'];
$email = $_POST['Email'];

sendUpdateEmailVerifyLink($email,$username)

?>

