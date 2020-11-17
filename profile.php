<?php session_start(); ?>
<html>
<head>
<title>Profile Page</title>
</head>
<body>

<h1> Profile Page</h1>

<?php
include('dbconnect.php');
$db = Database::getInstance();
$mysql = $db->getConnection();
$email = $_SESSION['email'];
$query = $mysql->prepare("SELECT * FROM SubscriberProfile where ID in(SELECT ID FROM Subscriber WHERE Email=?)");
$query->bind_param('s',$email);
$query->execute();
$result1 = $query->get_result();
$row_count1 = mysqli_num_rows($result1);


$query2 = $mysql->prepare("SELECT * FROM Subscriber WHERE Email=?");
$query2->bind_param('s',$email);
$query2->execute();
$result2 = $query2->get_result();
$rowcnt = mysqli_num_rows($result2);

foreach($result2 as $row)
{
    
}

foreach($result1 as $row1)
{

}


if($row_count1>0)
{
?>
<form action=update.php method=post>
<label for="ID">ID:</label>
<input type="text" id="ID" name="ID" readonly value="<?php echo $row['ID'];?>"><br><br>

<label for="First Name">First Name:</label>
<input type="text" id="FirstNmae" name="FirstName" value="<?php echo $row1['FirstName'];?>"><br><br>

<label for="MiddleName">Middle Name:</label>
<input type="text" id="MiddleName" name="MiddleName" value="<?php echo $row1['MiddleName'];?>"><br><br>

<label for="LastName">Last Name:</label>
<input type="text" id="LastName" name="LastName" value="<?php echo $row1['LastName'];?>"><br><br>

<label for="PhNum">Phone Num:</label>
<input type="text" id="PhNum" name="PhNum" value="<?php echo $row1['PhNum'];?>"><br><br>

<label for="LinkedInURL">LinkedIn URL:</label>
<input type="text" id="LinkedInURL" name="LinkedInURL" value="<?php echo $row1['LinkedInURL'];?>"><br><br>

<label for="TwitterURL">Twitter URL:</label>
<input type="text" id="TwitterURL" name="TwitterURL" value="<?php echo $row1['TwitterURL'];?>"><br><br>

<label for="HigherEducation">Higher Education:</label>
<input type="text" id="HigherEducation" name="HigherEducation" value="<?php echo $row1['HigherEducation'];?>"><br><br>

<label for="AreaOfInterest">Area Of Interest:</label>
<input type="text" id="AreaOfInterest" name="AreaOfInterest" value="<?php echo $row1['AreaOfInterest'];?>"><br><br>
<input type="submit" value="Update">
</form>
<?php 
}
else
{
?>
<form action=update.php method=post>
<label for="ID">ID:</label>
<input type="text" id="ID" name="ID" readonly value="<?php echo $row['ID'];?>"><br><br>

<label for="First Name">First Name:</label>
<input type="text" id="FirstNmae" name="FirstName" ><br><br>

<label for="MiddleName">Middle Name:</label>
<input type="text" id="MiddleName" name="MiddleName" ><br><br>

<label for="LastName">Last Name:</label>
<input type="text" id="LastName" name="LastName" ><br><br>

<label for="PhNum">Phone Num:</label>
<input type="text" id="PhNum" name="PhNum" ><br><br>

<label for="LinkedInURL">LinkedIn URL:</label>
<input type="text" id="LinkedInURL" name="LinkedInURL" ><br><br>

<label for="TwitterURL">Twitter URL:</label>
<input type="text" id="TwitterURL" name="TwitterURL" ><br><br>

<label for="HigherEducation">Higher Education:</label>
<input type="text" id="HigherEducation" name="HigherEducation"><br><br>

<label for="AreaOfInterest">Area Of Interest:</label>
<input type="text" id="AreaOfInterest" name="AreaOfInterest" ><br><br>
<input type="submit" value="Update">
</form>
<?php
}
?>
</body>
</html>
