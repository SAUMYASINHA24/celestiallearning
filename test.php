<?php
include 'dbconnect.php';

    $timestamp = date("Y-m-d h:i:s", strtotime('1 hour'));
    $hash = md5($timestamp);
    $pin = rand(1000,9000);
    $db = Database::getInstance();
    $conn = $db->getConnection();

    $stmt = $conn->prepare("INSERT INTO Verify VALUES(?,?,?.?)");
    $stmt->bind_param("ssss",$hash, $pin, $timestamp, $e);
    $e = $email;
    $stmt->execute();

?>