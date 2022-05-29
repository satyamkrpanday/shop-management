<?php
include_once 'connection.php';
session_start();
if(isset($_POST['save']))
{	 
	 $firstName = $_POST['firstName'];
	 $lastName = $_POST['lastName'];
     $username = $_SESSION['sess_user'];
	 $country = $_POST['country'];
	 $subject = $_POST['subject'];
	 $sql = "INSERT INTO contact (firstName,lastName,userName,country,subject)
	 VALUES ('$firstName','$lastName','$username', '$country','$subject')";
	 if (mysqli_query($conn, $sql)) {
		echo "Details saved. Thanks for feedback and we will connect soon!";
	 } else {
		echo "Error: " . $sql . "
" . mysqli_error($conn);
	 }
	 mysqli_close($conn);
}
?>