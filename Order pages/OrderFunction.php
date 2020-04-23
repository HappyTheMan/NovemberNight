<?php
function AddProduct($MenuID, $size, $milk , $sugar,$topping,$price,$duration,$quantity)
{
	include('../connect.php');

	$query="SELECT * FROM menu WHERE menu_Id='$MenuID'";
	$ret=mysqli_query($connection,$query);
	$count=mysqli_num_rows($ret);

	if($count < 1)
	{
		echo "<script>window.alert('No Product Found')</script>";
		echo "<script>window.location='menu.php'</script>";
	}


	$rows=mysqli_fetch_array($ret);

	$MenuImage=$rows['menu_Image'];
	$MenuName=$rows['menu_Name'];
  $type=$rows['menu_Type'];



	if(isset($_SESSION['Cart']))
	{
		$index=IndexOf($MenuID);

		if ($index == -1)
		{
			$size=count($_SESSION['Cart']);

			$_SESSION['Cart'][$size]['MenuID']=$MenuID;
			$_SESSION['Cart'][$size]['MenuImage']=$MenuImage;
			$_SESSION['Cart'][$size]['MenuName']=$MenuName;
			$_SESSION['Cart'][$size]['price']=$price;
			$_SESSION['Cart'][$size]['quantity']=$quantity;
			$_SESSION['Cart'][$size]['type']= $type;
      $_SESSION['Cart'][$size]['size']= $size;
      $_SESSION['Cart'][$size]['milk']= $milk;
      $_SESSION['Cart'][$size]['sugar']= $sugar;
      $_SESSION['Cart'][$size]['topping']= $topping;
      $_SESSION['Cart'][$size]['duration']= $duration;
		}
		else
		{
			$_SESSION['Cart'][$index]['quantity']+=$quantity;
		}
	}
	else
	{
		$_SESSION['Cart']=array();

    $_SESSION['Cart'][0]['MenuID']=$MenuID;
    $_SESSION['Cart'][0]['MenuImage']=$MenuImage;
    $_SESSION['Cart'][0]['MenuName']=$MenuName;
    $_SESSION['Cart'][0]['price']=$price;
    $_SESSION['Cart'][0]['quantity']=$quantity;
    $_SESSION['Cart'][0]['type']= $type;
    $_SESSION['Cart'][0]['milk']= $milk;
    $_SESSION['Cart'][0]['size']= $size;
    $_SESSION['Cart'][0]['sugar']= $sugar;
    $_SESSION['Cart'][0]['topping']= $topping;
    $_SESSION['Cart'][0]['duration']= $duration;
	}

	echo "<script>window.location='Shopping_Cart.php'</script>";
}

function RemoveProduct($MenuID)
{
	$index=IndexOf($MenuID);
	unset($_SESSION['Cart'][$index]);
	$_SESSION['Cart']=array_values($_SESSION['Cart']);

	echo "<script>window.location='Shopping_Cart.php'</script>";
}

function ClearAll()
{
	unset($_SESSION['Cart']);
	echo "<script>window.location='Shopping_Cart.php'</script>";
}

function CalculateTotalAmount()
{
	$TotalAmount=0;

	$size=count($_SESSION['Cart']);

	for ($i=0; $i < $size; $i++)
	{
		$POPrice=$_SESSION['Cart'][$i]['price'];
		$POQuantity=$_SESSION['Cart'][$i]['quantity'];
		$TotalAmount+=($POPrice * $POQuantity);
	}

	return $TotalAmount;
}

function CalculateTotalQuantity()
{
	$TotalQuantity=0;

	$size=count($_SESSION['Cart']);

	for ($i=0; $i < $size; $i++)
	{
		$POQuantity=$_SESSION['Cart'][$i]['quantity'];
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

function IndexOf($MenuID)
{
	if(!isset($_SESSION['Cart']))
	{
		return -1;
	}

	$size=count($_SESSION['Cart']);

	if ($size < 1)
	{
		return -1;
	}

	for($i=0;$i<$size;$i++)
	{
		if($MenuID === $_SESSION['Cart'][$i]['MenuID'])
		{
			return $i;
		}
	}
	return -1;
}
function getTime(){
	$hour = date("h")+5;
  $min = date("i");
  $mins = date("i")+30;

	$zone = date("A");
  if($mins > 60)
  {
    $hour++;
    $min = 30 - (60 - $min);
  }
  else
  {
    $min = $mins;
  }
	if ($min < 10) {
		$min = "0".$min;
	}
  return $hour.":".$min." ". $zone;
}
?>
