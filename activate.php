<?php
	include "dbconnect.php";
    $db = Database::getInstance();      // Creating instance of Database
    $mysql = $db->getConnection();
    
    if(!empty($_GET["id"]))
    {
        $query = $mysql->prepare("UPDATE Subscriber SET Status = 'Active' WHERE Email= ?");   //Username already taken verification
        $query->bind_param('s',$email);
        $email = $_GET["id"];
        $query->execute();
	    $result = $query->get_result();
	    
        if(!$result)
        {
			echo $message = "Your account is activated.";
        } 
        else 
        {
			echo $message = "Problem in account activation.";
		}
	}
?>