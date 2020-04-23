<?php  
include('../connect.php');


$ID=$_GET['SupplierID'];

$Delete="DELETE FROM supplier WHERE supplier_Id='$ID' ";
$ret=mysqli_query($connection,$Delete);

if($ret) //True
{
	echo "<script>window.alert('SUCCESS : Supplier Account Deleted')</script>";
	echo "<script>window.location='Supplier_List.php'</script>";
}
else
{
	echo "<p>Error : Something went wrong in Supplier account Delete " . mysqli_error($connection) . "</p>";
}

?>