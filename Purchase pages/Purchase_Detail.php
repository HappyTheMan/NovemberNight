<?php
include('../Template/Adminhead.php');
include('../AdminTemplate/head.php');
include('../connect.php');
include('../Functions/Auto_IdFunction.php');
include('../Functions/Purchase_OrderFunction.php');

if (isset($_GET['PurchaseOrderID'])) {
	$PurchaseOrderID = $_GET['PurchaseOrderID'];

	$query1 = "SELECT po.*, sup.supplier_Id, sup.supplier_Name, st.staff_Id,st.staff_Name
			FROM purchase po, supplier sup, staff st
			WHERE po.purchase_Id='$PurchaseOrderID'
			AND po.supplier_Id=sup.supplier_Id
			AND po.staff_Id=st.staff_Id
			";
	$result1 = mysqli_query($connection, $query1);
	$arr1 = mysqli_fetch_array($result1);

	$query2 = "SELECT po.*, pod.*, pro.raw_Id,pro.raw_Name
			FROM purchase po, purchase_Detail pod, raw pro
			WHERE po.purchase_Id='$PurchaseOrderID'
			AND po.purchase_Id=pod.purchase_Id
			AND pod.raw_Id=pro.raw_Id
		";
	$result2 = mysqli_query($connection, $query2);
	$count = mysqli_num_rows($result2);
} else {
	$PurchaseOrderID = "";
}
if (isset($_POST['btnConfirm'])) {
	$txtPurchaseOrderID = $_POST['txtPurchaseOrderID'];

	$query = mysqli_query($connection, "SELECT * FROM purchase_Detail
									WHERE purchase_Id='$txtPurchaseOrderID'");

	while ($row = mysqli_fetch_array($query)) {
		$ProductID = $row['raw_Id'];
		$Quantity = $row['quantity'];

		$UpdateQty = "UPDATE raw
					SET quantity= quantity + '$Quantity'
					WHERE raw_Id='$ProductID'
					";
		$ret = mysqli_query($connection, $UpdateQty);
	}

	$UpdateStatus = "UPDATE purchase
				   SET status='Confirmed'
				   WHERE purchase_Id='$txtPurchaseOrderID'";
	$ret = mysqli_query($connection, $UpdateStatus);

	if ($ret) //True
	{
		echo "<script>window.alert('SUCCESS : Purchase Order Successfully Confirmed')</script>";
		echo "<script>window.location='Purchase_List.php'</script>";
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
	<div class="popup_box" style = "margin-left:30%;margin-top:8%;">
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
					<input type="text" placeholder="Enter material name" name="txtRawName" id="a" class="form-control" value="<?php echo $arr1['purchase_Id']; ?>" disabled>
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
					<label for="d">Report Date</label>
					<input type="date" placeholder="Quantity" name="txtRawQuantity" id="d" class="form-control" value="<?php echo date('Y-m-d'); ?>" disabled>
				</div>
			</div>
			<div class="form-row col-xl-12">
				<div class="form-group col-xl-6 col-md-6">
					<label for="e">Staff Name</label>
					<input type="text" placeholder="Enter material name" name="txtRawName" id="e" class="form-control" value="<?php echo $arr1['staff_Name']; ?>" disabled>
				</div>
				<div class="form-group col-xl-6 col-md-6">
					<label for="f">Supplier</label>
					<input type="text" placeholder="Quantity" name="txtRawQuantity" id="f" class="form-control" value="<?php echo $arr1['supplier_Name']; ?>" disabled>
				</div>
			</div>
			<div class="line"></div>
			<table class="table table-hover" style="color:black;">
				<tr class="table-dark">
					<th>PID</th>
					<th>ProductName</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Sub-Total</th>
				</tr>
				<?php
				for ($i = 0; $i < $count; $i++) {
					$arr2 = mysqli_fetch_array($result2);
					$type = $arr2['pricing_Type'];
					echo "<tr class='table-info'>";
					echo "<td>" . $arr2['raw_Id'] . "</td>";
					echo "<td>" . $arr2['raw_Name'] . "</td>";
					echo "<td>" . $arr2['price'] . "$ per " . $type . "</td>";
					echo "<td>" . $arr2['quantity'] . " " . $type . "</td>";
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
						Tax (VAT) : <?php echo $arr1['tax'] ?> USD</b>
						<br />
						GrandTotal : <?php echo $arr1['total_Cost'] ?> USD</b>
						<br />
						Total Quantity : <?php echo $arr1['total_Quantity'] ?> pcs</b>
					</td>
				</tr>
			</table>
			<div class="line"></div>
			<form class="form" method="post" action="Purchase_Detail.php">
			<div class="col-xl-12">
				<input type="hidden" name="txtPurchaseOrderID" value="<?php echo $PurchaseOrderID ?>">

			</div>
			</form>
		</div>
	</div>

</body>

</html>
