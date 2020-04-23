<?php  
include('../connect.php');


$StaffID=$_GET['StaffID'];

$Delete="DELETE FROM staff WHERE staff_Id='$StaffID' ";
$ret=mysqli_query($connection,$Delete);

if($ret) //True
{
	echo "<script>window.alert('SUCCESS : Staff Account Deleted')</script>";
	echo "<script>window.location='Staff_List.php'</script>";
}
else
{
	echo "<p>Error : Something went wrong in Staff Delete " . mysqli_error($connection) . "</p>";
}

?>