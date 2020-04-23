<?php  
include('../connect.php');


$ID=$_GET['RawID'];

$Delete="DELETE FROM raw WHERE raw_Id='$ID' ";
$ret=mysqli_query($connection,$Delete);

if($ret) //True
{
	echo "<script>window.alert('SUCCESS : Raw Deleted')</script>";
	echo "<script>window.location='Raw_List.php'</script>";
}
else
{
	echo "<p>Error : Something went wrong in Supplier account Delete " . mysqli_error($connection) . "</p>";
}

?>