<?php
include_once 'connection.php';
session_start();

if(isset($_POST['productName']))
{	 
	 $productName = $_POST['productName'];
    $result=mysqli_query($conn, "SELECT * FROM product WHERE name='".$productName."' OR code='".$productName."'");  
    $numrows=mysqli_num_rows($result); 
    if($numrows!=0)  
    {  
        $emparray = array();
        while($row =mysqli_fetch_assoc($result))
        {
            $emparray[] = $row;
        }
        echo json_encode($emparray);
	 } else {
	    echo "Product not found";
	 }
	 mysqli_close($conn);
}
?>