<?php  
function AddProduct($ProductID,$PurchasePrice,$PurchaseQuantity,$type)
{
	include('../connect.php');

	$query="SELECT * FROM raw WHERE raw_Id='$ProductID'";
	$ret=mysqli_query($connection,$query);
	$count=mysqli_num_rows($ret);

	if($count < 1) 
	{
		echo "<script>window.alert('No Product Found')</script>";
		echo "<script>window.location='Purchase_Order.php'</script>";
	}
	

	$rows=mysqli_fetch_array($ret);

	$ProductImage1=$rows['raw_Image'];
	$ProductName=$rows['raw_Name'];
	


	if(isset($_SESSION['POFunctions'])) 
	{
		$index=IndexOf($ProductID);

		if ($index == -1) 
		{
			$size=count($_SESSION['POFunctions']);
			
			$_SESSION['POFunctions'][$size]['ProductID']=$ProductID;
			$_SESSION['POFunctions'][$size]['ProductImage1']=$ProductImage1;
			$_SESSION['POFunctions'][$size]['ProductName']=$ProductName;
			$_SESSION['POFunctions'][$size]['PurchasePrice']=$PurchasePrice;
			$_SESSION['POFunctions'][$size]['PurchaseQuantity']=$PurchaseQuantity;
			$_SESSION['POFunctions'][$size]['Type']= $type;
		}
		else
		{
			$_SESSION['POFunctions'][$index]['PurchaseQuantity']+=$PurchaseQuantity;
		}
	}
	else
	{
		$_SESSION['POFunctions']=array();

		$_SESSION['POFunctions'][0]['ProductID']=$ProductID;
		$_SESSION['POFunctions'][0]['ProductImage1']=$ProductImage1;
		$_SESSION['POFunctions'][0]['ProductName']=$ProductName;
		$_SESSION['POFunctions'][0]['PurchasePrice']=$PurchasePrice;
		$_SESSION['POFunctions'][0]['PurchaseQuantity']=$PurchaseQuantity;
		$_SESSION['POFunctions'][0]['Type']= $type;
	}

	echo "<script>window.location='Purchase_Order.php'</script>";
}

function RemoveProduct($ProductID)
{
	$index=IndexOf($ProductID);
	unset($_SESSION['POFunctions'][$index]);
	$_SESSION['POFunctions']=array_values($_SESSION['POFunctions']);

	echo "<script>window.location='Purchase_Order.php'</script>";
}

function ClearAll()
{
	unset($_SESSION['POFunctions']);
	echo "<script>window.location='Purchase_Order.php'</script>";
}

function CalculateTotalAmount()
{
	$TotalAmount=0;

	$size=count($_SESSION['POFunctions']);

	for ($i=0; $i < $size; $i++) 
	{ 
		$POPrice=$_SESSION['POFunctions'][$i]['PurchasePrice'];
		$POQuantity=$_SESSION['POFunctions'][$i]['PurchaseQuantity'];
		$TotalAmount+=($POPrice * $POQuantity);
	}

	return $TotalAmount;
}

function CalculateTotalQuantity()
{
	$TotalQuantity=0;

	$size=count($_SESSION['POFunctions']);

	for ($i=0; $i < $size; $i++) 
	{ 
		$POQuantity=$_SESSION['POFunctions'][$i]['PurchaseQuantity'];
		$TotalQuantity+=$POQuantity;
	}

	return $TotalQuantity;
}

function CalculateVAT()
{
	$VAT=0;

	$VAT=CalculateTotalAmount() * 0.05;

	return $VAT;
}

function IndexOf($ProductID)
{
	if(!isset($_SESSION['POFunctions'])) 
	{
		return -1;
	}

	$size=count($_SESSION['POFunctions']);

	if ($size < 1) 
	{
		return -1;
	}

	for($i=0;$i<$size;$i++) 
	{ 
		if($ProductID === $_SESSION['POFunctions'][$i]['ProductID']) 
		{
			return $i;	
		}		
	}
	return -1;
}

?>