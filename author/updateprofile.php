<?php
    session_start();
    $id = $_SESSION['ID'];
    $FirstName = $_POST['FirstName'];
    $MiddleName = $_POST['MiddleName'];
    $LastName = $_POST['LastName'];
    $phn = $_POST['PhNum'];
    $LinkedInURL = $_POST['LinkedInURL'];
    $TwitterURL = $_POST['TwitterURL'];
    $Qaulification = $_POST['Qualification'];
    $Biography = $_POST['Biography'];

    include('/var/www/celestiallearning/utilities/dbconnect.php');
    $db = Database::getInstance();
    $mysql = $db->getConnection();

    $query = $mysql->prepare("SELECT * FROM AuthorProfile WHERE ID = ?");   //Username already taken verification
    $query->bind_param('s',$id);
    $query->execute();
    $result = $query->get_result();
    $rowcnt = mysqli_num_rows($result);

    if($rowcnt > 0)
    {
        $query = $mysql->prepare("UPDATE AuthorProfile SET FirstName=?,MiddleName=?,LastName=?,PhNum=?,LinkedInURL=?,TwitterURL=?,Qualification=?,Biography=?  WHERE ID=?");
        $query->bind_param("sssssssss",$FirstName,$MiddleName,$LastName,$phn,$LinkedInURL,$TwitterURL,$Qualification,$Biography,$id);
        $query->execute();
    }
    else
    {
        $query = $mysql->prepare("INSERT INTO AuthorProfile VALUES(?,?,?,?,?,?,?,?,?)");
        $query->bind_param("sssssssss",$id,$FirstName,$MiddleName,$LastName,$phn,$LinkedInURL,$TwitterURL,$Qualification,$Biography);
        $query->execute();
    }

    echo "Update Successful"


?>