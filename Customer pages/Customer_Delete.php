<?php
include('../connect.php');


$StaffID=$_GET['CustomerID'];

$Delete="DELETE FROM customer WHERE customer_Id='$StaffID' ";
$ret=mysqli_query($connection,$Delete);

if($ret) //True
{
	echo "<script>window.alert('SUCCESS : Customer Account Deleted')</script>";
	echo "<script>window.location='Customer_List.php'</script>";
}
else
{
	echo "<p>Error : Something went wrong in customer Delete " . mysqli_error($connection) . "</p>";
}

?>
