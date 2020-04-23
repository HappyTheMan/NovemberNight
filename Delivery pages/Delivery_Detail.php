<?php
include('../Template/Adminhead.php');
include('../AdminTemplate/head.php');
include('../connect.php');
include('../Functions/Auto_IdFunction.php');
include('../Functions/Purchase_OrderFunction.php');

if (isset($_GET['OrderID'])) {
	$OrderID = $_GET['OrderID'];

	$query1 = "SELECT *
						FROM orders o,customer c, staff s
						where o.customer_Id = c.customer_Id
						and o.delivery_Id = s.staff_Id
						and o.order_Id = '$OrderID'
			";
	$result1 = mysqli_query($connection, $query1);
	$arr1 = mysqli_fetch_array($result1);

	$query2 = "SELECT * FROM order_detail od, menu m, orders o
						 WHERE od.order_Id = '$OrderID'
						 and o.order_Id = od.order_Id
						 AND m.menu_Id = od.menu_Id
		";
	$result2 = mysqli_query($connection, $query2);
	$count = mysqli_num_rows($result2);
} else {
	$OrderID = "";
}
if (isset($_POST['btnConfirm'])) {
	$txtOrderID = $_POST['txtOrderID'];
  $txtStaffID = $_POST['txtStaffID'];


	$UpdateStatus = "UPDATE orders
				   SET status='Confirmed',
           delivery_Id = $txtStaffID
				   WHERE order_Id='$txtOrderID'";
	$ret = mysqli_query($connection, $UpdateStatus);

	if ($ret) //True
	{
		echo "<script>window.alert('SUCCESS : Purchase Order Successfully Confirmed')</script>";
		echo "<script>window.location='Delivery_List.php'</script>";
	} else {
		echo "<p>Error : Something went wrong " . mysqli_error($connection) . "</p>";
	}
}

?>
<!DOCTYPE html>
<html>

<head>
	<title>Purchase Details</title>

	<link rel="stylesheet" href="../entry.css">
	<link rel="stylesheet" href="../DatePicker/datepicker.css">

	<script src="../DatePicker/datepicker.js"></script>
	<style>
		.btn {
			margin-bottom: 20px;
			background-color: #7289DA;
			border: 1px solid whitesmoke;
			transition: 0.8s;
		}

		.popup_box {
			width: 100%;
		}

		.btn:hover {
			cursor: pointer;
			border-radius: 8px;
		}

		.line {
			width: 100%;
			background: grey;
			height: 1px;
			margin-bottom: 1%;
			margin-top: 1%;
		}
	</style>
</head>

<body>
	<div class="container" style="margin-left: 8%;">
	<div class="popup_box">
		<div class="popup_inner">
			<div class="logo text-center">
				<div class="logo-img">
					<a href="displays.php">
						<h1 style="color:black;" class="hi"><i class="fas fa-cocktail" style="color:turquoise;"></i> November</h1>
					</a>
				</div>
			</div>
			<div class="form-row col-xl-12">
				<div class="form-group col-xl-6 col-md-6">
					<label for="a">Order ID</label>
					<input type="text" placeholder="Enter material name" name="txtRawName" id="a" class="form-control" value="<?php echo $arr1['order_Id']; ?>" disabled>
				</div>
				<div class="form-group col-xl-6 col-md-6">
					<label for="b">Status</label>
					<input type="text" placeholder="Quantity" name="txtRawQuantity" id="b" class="form-control" value="<?php echo $arr1['status']; ?>" disabled>
				</div>
			</div>
			<div class="form-row col-xl-12">
				<div class="form-group col-xl-6 col-md-6">
					<label for="c">Order Date</label>
					<input type="date" placeholder="Enter material name" name="txtRawName" id="c" class="form-control" value="<?php echo $arr1['order_Date']; ?>" disabled>
				</div>
				<div class="form-group col-xl-6 col-md-6">
					<label for="c">Order Time</label>
					<input type="text" placeholder="Enter material name" name="txtRawName" id="c" class="form-control" value="<?php echo $arr1['order_Time']; ?>" disabled>
				</div>
			</div>
			<div class="form-row col-xl-12">
				<div class="form-group col-xl-6 col-md-6">
					<label for="e">Delivery Staff Name</label>
					<input type="text" placeholder="Enter material name" name="txtRawName" id="e" class="form-control" value="<?php echo $arr1['staff_Name']; ?>" disabled>
				</div>
				<div class="form-group col-xl-6 col-md-6">
					<label for="f">Customer Name</label>
					<input type="text" placeholder="Quantity" name="txtRawQuantity" id="f" class="form-control" value="<?php echo $arr1['customer_Name']; ?>" disabled>
				</div>
			</div>
			<div class="line"></div>
			<table class="table table-hover table-responsive" style="color:black;">
				<tr class="table-dark">
					<th>MenuName</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>size</th>
					<th>milk</th>
					<th>sugar</th>
					<th>duration</th>
					<th>topping</th>
					<th>Sub-Total</th>
				</tr>
				<?php
				for ($i = 0; $i < $count; $i++) {
					$arr2 = mysqli_fetch_array($result2);
					$type = $arr2['menu_Type'];
					echo "<tr class='table-info'>";
					echo "<td>" . $arr2['menu_Name'] . "</td>";
					echo "<td>" . $arr2['price'] . "$ per " . $type . "</td>";
					echo "<td>" . $arr2['quantity'] . " " . $type . "</td>";
					echo "<td>" . $arr2['size'] . "</td>";
					echo "<td>" . $arr2['milk'] . "</td>";
					echo "<td>" . $arr2['sugar'] . "</td>";
					echo "<td>" . $arr2['duration'] . "</td>";
					echo "<td>" . $arr2['topping'] . "</td>";
					echo "<td>" . $arr2['price'] * $arr2['quantity'] . "</td>";
					echo "</tr>";
				}
				?>
			</table>
			<div class="line"></div>
			<table class="table " style="color:black">
				<tr class="table-info">
					<td colspan="4" align="right">
						Total Amount : <?php echo $arr1['total_Amount'] ?> USD</b>

						<br />
						Total Quantity : <?php echo $arr1['total_Quantity'] ?> pcs</b>
						<br />
						Address : <?php echo $arr1['address'] ?>
						<br />
						Phone : <?php echo $arr1['phone'] ?>
						<br />
						Branch : <?php echo $arr1['branch'] ?>
						<br />
						Payment : <?php echo $arr1['payment'] ?>
					</td>
				</tr>
			</table>
			<div class="line"></div>
			<form class="form" method="post" action="Delivery_Detail.php">
			<div class="col-xl-12">
				<input type="hidden" name="txtOrderID" value="<?php echo $OrderID ?>">
        <input type="hidden" name="txtStaffID" value="<?php echo $_SESSION['StaffID'] ?>">
				<?php
				if ($arr1['status'] == "pending") {
					echo "<input type='submit' value='Confirm' class='boxed_btn_green' name='btnConfirm' style='color:white'>";
				} else {
					echo "<input type='submit' value='Confirmed' class='' name='btnConfirm' style='color:black;' disabled>";
				}
				?>
			</div>
			</form>
		</div>
	</div>
	</div>
</body>

</html>
