<?php
include('../connect.php');


$ID=$_GET['MenuID'];

$Delete="DELETE FROM menu WHERE menu_Id='$ID' ";
$ret=mysqli_query($connection,$Delete);

if($ret) //True
{
	echo "<script>window.alert('SUCCESS : Menu Deleted')</script>";
	echo "<script>window.location='Menu_List.php'</script>";
}
else
{
	echo "<p>Error : Something went wrong in Supplier account Delete " . mysqli_error($connection) . "</p>";
}

?>
