<?php 
include "dbconnect.php";

$db = Database::getInstance();
$conn = $db->getConnection();

$stmt = $conn->prepare("INSERT INTO Subscriber values(?,?,?,?)");
$stmt->bind_param("ssss",$ID,$username,$email,$password);
$ID = $_POST["username"];
$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
//echo $ID . " ".$username . " ". $email." ".$password;
$stmt->execute();
$stmt = $conn->prepare("SELECT * FROM Subscriber where Email = ?");
$stmt->bind_param("s",$email);
$email = $_POST["email"];
$stmt->execute();
$result = $stmt->get_result();
while($row = $result->fetch_assoc())
{
    echo $row["ID"]. $row["Username"]."<br>";
}

?>