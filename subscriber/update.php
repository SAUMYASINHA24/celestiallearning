<?php

    include('/var/www/celestiallearning/utilities/dbconnect.php');

    $id = $_POST['ID'];
    $FirstName = $_POST['FirstName'];
    $MiddleName = $_POST['MiddleName'];
    $LastName = $_POST['LastName'];
    $phn = $_POST['PhNum'];
    $LinkedInURL = $_POST['LinkedInURL'];
    $TwitterURL = $_POST['TwitterURL'];
    $HigherEducation = $_POST['HigherEducation'];
    $AreaOfInterest = $_POST['AreaOfInterest'];
    
    $db = Database::getInstance();
    $mysql = $db->getConnection();

    $query = $mysql->prepare("SELECT * FROM SubscriberProfile WHERE ID = ?");   //Username already taken verification
    $query->bind_param('s',$id);
    $query->execute();
    $result = $query->get_result();
    $rowcnt = mysqli_num_rows($result);

    if($rowcnt > 0)
    {
        $query = $mysql->prepare("UPDATE SubscriberProfile SET FirstName=?,MiddleName=?,LastName=?,PhNum=?,LinkedInURL=?,TwitterURL=?,HigherEducation=?,AreaOfInterest=?  WHERE ID=?");
        $query->bind_param("sssssssss",$FirstName,$MiddleName,$LastName,$phn,$LinkedInURL,$TwitterURL,$HigherEducation,$AreaOfInterest,$id);
        $query->execute();
    }
    else
    {
        $query = $mysql->prepare("INSERT INTO SubscriberProfile VALUES(?,?,?,?,?,?,?,?,?)");
        $query->bind_param("sssssssss",$id,$FirstName,$MiddleName,$LastName,$phn,$LinkedInURL,$TwitterURL,$HigherEducation,$AreaOfInterest);
        $query->execute();
    }

    echo "Update Successful"


?>