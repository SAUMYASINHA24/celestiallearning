<?php 
    $servername = "sql12.freemysqlhosting.net";
    $username = "sql12374857";
    $password = "lNXpUaAXvw";
    
    // Create connection
    $conn = mysqli_connect($servername, $username, $password);

    // Check connection
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }
    echo "Connected successfully";
?>