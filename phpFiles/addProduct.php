<?php
include_once 'connection.php';
if(isset($_POST['save']))
{	 
	 $name = $_POST['name'];
	 $price = $_POST['price'];
	 $code = $_POST['code'];
	 $quantity = $_POST['quantity'];
	 $sql = "INSERT INTO product (name,price,code,quantity)
	 VALUES ('$name','$price','$code','$quantity')";
	 if (mysqli_query($conn, $sql)) {
		echo "New product added successfully !";
	 } else {
		echo "Error: " . $sql . "
" . mysqli_error($conn);
	 }
	 mysqli_close($conn);
}
?>