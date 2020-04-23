<?php
include('../Template/Adminhead.php');
include('../AdminTemplate/head.php');
//unset($_SESSION['POFunctions']);
include('../connect.php');
include('../Functions/Auto_IdFunction.php');
include('../Functions/Purchase_OrderFunction.php');
$quantity = 0;
$price = 0;
$raw = 0;
$ptype = 0;
if (isset($_GET['btnSave'])) {
	$txtPurchaseOrderID = $_GET['txtPurchaseOrderID'];
	$txtPurchaseOrderDate = $_GET['txtPurchaseOrderDate'];
	$txtTotalAmount = $_GET['txtTotalAmount'];
	$cboSupplierID = 0;
	$txtVAT = $_GET['txtVAT'];
	$txtGrandTotal = $_GET['txtGrandTotal'];
	$txtTotalQuantity = $_GET['txtTotalQuantity'];
	$cboPricing = $_GET['cboPricing'];

	$StaffID = $_SESSION['StaffID'];

		$Status = "Pending";

		$query1 = "INSERT INTO `purchase`
			 (`purchase_Id`, `supplier_Id`, `staff_Id`, `tax`, `total_Quantity`, `total_Cost`, `status`, `order_Date`, `total_Amount`)
			 VALUES
			 ('$txtPurchaseOrderID','$cboSupplierID','$StaffID','$txtVAT','$txtTotalQuantity','$txtGrandTotal','$Status','$txtPurchaseOrderDate','$txtTotalAmount')
			 ";
		$ret = mysqli_query($connection, $query1);

		$size = count($_SESSION['POFunctions']);

		for ($i = 0; $i < $size; $i++) {
			$ProductID = $_SESSION['POFunctions'][$i]['ProductID'];
			$PurchaseQuantity = $_SESSION['POFunctions'][$i]['PurchaseQuantity'];
			$PurchasePrice = $_SESSION['POFunctions'][$i]['PurchasePrice'];
			$type = $_SESSION['POFunctions'][$i]['Type'];

			$query2 = "INSERT INTO `purchase_detail`
				(`purchase_Id`, `raw_Id`, `quantity`, `price` , `pricing_Type`)
				VALUES
				('$txtPurchaseOrderID','$ProductID','$PurchaseQuantity','$PurchasePrice' , '$type')
				";
			$ret = mysqli_query($connection, $query2);
		}

		if ($ret) {
			unset($_SESSION['POFunctions']);

			echo "<script>window.alert('SUCCESS : Purchase Order Successfully Created.')</script>";
			echo "<script>window.location='Purchase_Order.php'</script>";
		} else {
			echo "<p>Error : Something went wrong " . mysqli_error($connection) . "</p>";
		}

}

if (isset($_GET['btnAdd'])) {
	$RawID = $_GET['cboProductID'];
	$txtPurchasePrice = $_GET['txtPurchasePrice'];
	$txtPurchaseQuantity = $_GET['txtPurchaseQuantity'];
	$pricing_Type = $_GET['cboPricing'];
	$flag = false;
	if (isset($_SESSION['POFunctions'])) {


		$size = count($_SESSION['POFunctions']);

		for ($i = 0; $i < $size; $i++) {
			if ($RawID === $_SESSION['POFunctions'][$i]['ProductID'])
				$flag = true;
		}
	}
	if ($flag == false) {
		if ($RawID == "None") {
			echo "<script>window.alert('Please choose the raw material.')</script>";
			$price = $txtPurchasePrice;
			$quantity = $txtPurchaseQuantity;
			$ptype = $pricing_Type;
		} else if ($txtPurchasePrice == 0) {
			echo "<script>window.alert('Please enter correct price')</script>";
			$ptype = $pricing_Type;
			$quantity = $txtPurchaseQuantity;
			$raw = $RawID;
		} else if ($txtPurchaseQuantity == 0) {
			echo "<script>window.alert('Please enter correct quantity')</script>";
			$price = $txtPurchasePrice;
			$ptype = $pricing_Type;
			$raw = $RawID;
		} else if ($pricing_Type == "None") {
			echo "<script>window.alert('Please choose the pricing type.')</script>";
			$price = $txtPurchasePrice;
			$quantity = $txtPurchaseQuantity;
			$raw = $RawID;
		} else {
			AddProduct($RawID, $txtPurchasePrice, $txtPurchaseQuantity, $pricing_Type);
		}
	} else {
		if ($txtPurchaseQuantity == 0) {
			echo "<script>window.alert('Please enter correct quantity')</script>";
			$raw = $RawID;
		} else {
			echo "<script>window.alert('The product already exist there will be no change in price and pricing type. Only quantity will increase!.')</script>";
			AddProduct($RawID, $txtPurchasePrice, $txtPurchaseQuantity, $pricing_Type);
		}
	}
}


if (isset($_GET['action'])) {
	$action = $_GET['action'];

	if ($action === "remove") {
		$ProductID = $_GET['ProductID'];
		RemoveProduct($ProductID);
	} else {
		ClearAll();
	}
}



?>

<!DOCTYPE html>
<html>

<head>
	<title>Purchase Order</title>

	<link rel="stylesheet" href="../entry.css">
	<link rel="stylesheet" href="../DatePicker/datepicker.css">

	<script src="../DatePicker/datepicker.js"></script>
	<style>
		.popup_box {
			width: 100%;
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
	<form id="test-form" class="white-popup-block" action="Purchase_Order.php" method="get" style="padding-top:12%;margin-top:50%;">
		<div class="popup_box">
			<div class="popup_inner">
				<div class="logo text-center">
					<div class="logo-img">
						<a href="displays.php">
							<h1 style="color:black;" class="hi"><i class="fas fa-cocktail" style="color:turquoise;"></i> November</h1>
						</a>
					</div>
				</div>
				<h3 style="text-align:center;">Purchase Order</h3>




				<div class="row">

					<div class="form-row col-xl-12">
						<div class="form-group col-xl-6 col-md-6">
							<label for="POid">Order ID</label>
							<input type="text" id="POid" placeholder="Enter material name" name="txtPurchaseOrderID" class="form-control" value="<?php echo AutoID('purchase', 'purchase_Id', 'PUR-', 6); ?>" readonly>
						</div>
						<div class="form-group col-xl-6 col-md-6">
							<label for="a">Order Date</label>
							<input type="date" id="a" placeholder="Quantity" name="txtPurchaseOrderDate" class="form-control" value="<?php echo date('Y-m-d') ?>" required>
						</div>
					</div>
					<div class="form-row col-xl-12">
						<div class="form-group col-xl-6 col-md-6">
							<label for="b">Staff Name</label>
							<input type="text" id="b" placeholder="Enter material name" name="txtStaffInfo" class="form-control" value="<?php echo $_SESSION['StaffName']; ?>" readonly>
						</div>
						<div class="form-group col-xl-6 col-md-6">
							<label for="c">Arrival Date</label>
							<input type="date" id="c" placeholder="Quantity" name="txtPurchaseArrivalDate" class="form-control" value="<?php echo date('Y-m-d') ?>" required>
						</div>
					</div>
					<div class="line"></div>
					<div class="form-row col-xl-12">
						<div class="form-group col-xl-6 col-md-6">
							<label for="POid">Total Amount</label>
							<input type="number" id="POid" placeholder="0" name="txtTotalAmount" class="form-control" value="<?php echo CalculateTotalAmount(); ?>" readonly>
						</div>
						<div class="form-group col-xl-6 col-md-6">
							<label for="a">VAT (5%)</label>
							<input type="number" id="a" placeholder="0" name="txtVAT" class="form-control" value="<?php echo CalculateVAT(); ?>" readonly>
						</div>
					</div>
					<div class="form-row col-xl-12">
						<div class="form-group col-xl-6 col-md-6">
							<label for="b">Total Quantity</label>
							<input type="number" id="b" placeholder="0" name="txtTotalQuantity" class="form-control" value="<?php echo CalculateTotalQuantity(); ?>" readonly>
						</div>
						<div class="form-group col-xl-6 col-md-6">
							<label for="c">Grand Total</label>
							<input type="number" id="c" placeholder="0" name="txtGrandTotal" class="form-control" value="<?php echo CalculateTotalAmount() + CalculateVAT(); ?>" readonly>
						</div>
					</div>
					<div class="line"></div>

					<div class="form-row col-xl-12">
						<div class="form-group col-xl-6 col-md-6">
							<label for="POid">Raw Material</label>
							<select name="cboProductID" class="custom-select">

								<?php
								$ProductQuery = "SELECT * FROM raw";
								$Product_ret = mysqli_query($connection, $ProductQuery);
								$Product_count = mysqli_num_rows($Product_ret);

								if ($raw == 0) {
									echo "<option value = 'None'>Choose Raw</option>";
								} else {
									$query = "SELECT * from raw where raw_Id = $raw";
									$res = mysqli_query($connection, $query);
									$raws = mysqli_fetch_array($res);
									echo "<option value = '$raws[raw_Id]'>$raws[raw_Name]</option>";
								}
								for ($i = 0; $i < $Product_count; $i++) {
									$arr = mysqli_fetch_array($Product_ret);
									$ProductID = $arr['raw_Id'];
									$ProductName = $arr['raw_Name'];
									if ($ProductID != $raw)
										echo "<option value='$ProductID'>$ProductName</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group col-xl-6 col-md-6">
							<label for="a">Quantity</label>
							<input type="number" id="a" placeholder="0" name="txtPurchaseQuantity" class="form-control" value="<?php echo $quantity ?>">
						</div>
					</div>
					<div class="form-row col-xl-12">
						<div class="form-group col-xl-6 col-md-6">
							<label for="b">Purchase price</label>
							<input type="number" id="b" placeholder="0" name="txtPurchasePrice" class="form-control" value="<?php echo $price ?>">
						</div>
						<div class="form-group col-xl-6 col-md-6">
							<label for="c">Pricing Type</label>
							<select name="cboPricing" onchange="price_Type()" class="custom-select">
								<?php if ($ptype !== 0)
									echo "<option value = '$ptype'> Per $ptype</option>";
								else
									echo "<option value = 'None' >Per None</option>";
								?>

								<option value="Litre">Per litre</option>
								<option value="Box">Per box</option>
								<option value="Kilogram">Per kilogram</option>
								<option value="Gram">Per gram</option>
							</select>
						</div>
					</div>

					<div class="col-xl-12">
						<input type="submit" value="Add" class="boxed_btn_green" name="btnAdd" style="color:white">
					</div>
					<div class="col-xl-12">
						<fieldset class="form" style="margin-top:20px;color:black">
							<legend>Purchase Details</legend>

							<?php
							if (!isset($_SESSION['POFunctions'])) {
								echo "<p>No Purchase Details Found.</p>";
								exit();
							}
							?>

							<table border="1" class="table table-hover">
								<tr class="table-dark">
									<th>Image</th>
									<th>ProductID</th>
									<th>ProductName</th>
									<th>PurchasePrice (USD)</th>
									<th>PurchaseQty (pcs)</th>
									<th>Sub-Total (USD)</th>
									<th>Action</th>
								</tr>
								<?php
								$size = count($_SESSION['POFunctions']);

								for ($i = 0; $i < $size; $i++) {
									$ProductID = $_SESSION['POFunctions'][$i]['ProductID'];
									$ProductImage1 = $_SESSION['POFunctions'][$i]['ProductImage1'];
									$type = $_SESSION['POFunctions'][$i]['Type'];

									echo "<tr scope ='row' class = 'table-info'>";
									echo "<td><img src='$ProductImage1' width='100px' height='100px'/></td>";
									echo "<td>" . $_SESSION['POFunctions'][$i]['ProductID'] . "</td>";
									echo "<td>" . $_SESSION['POFunctions'][$i]['ProductName'] . "</td>";
									echo "<td>" . $_SESSION['POFunctions'][$i]['PurchasePrice'] . " USD per " . $type . "</td>";
									echo "<td>" . $_SESSION['POFunctions'][$i]['PurchaseQuantity'] . " " . $type . "</td>";
									echo "<td>" . ($_SESSION['POFunctions'][$i]['PurchasePrice'] * $_SESSION['POFunctions'][$i]['PurchaseQuantity']) . "</td>";
									echo "<td>
		  <a href='Purchase_Order.php?action=remove&ProductID=$ProductID'><i class='fas fa-times' style = 'color:red;font-size:30px;'></i></a>
		  </td>";
									echo "</tr>";
								}

								?>
								</table>
								<a href="Purchase_Order.php?action=clearall" style = "color:red;">Clear All</a>
								<br><br>
								<input type="submit" name="btnSave" value="Order" class="boxed_btn_green" style="color:white">

								</td>


						</fieldset>
					</div>
				</div>

			</div>
		</div>

	</form>
	<!-- <div id = "nav">
<img src="../del luna.webp" alt="" width = "50" height = "50" style = "float:left;border-radius:100%;margin:15px;margin-right:25px">
<a href = "home.php" id = "home">November</a>
	<ul id = "menu">
		<li><a href = "#" class = "menulist">Menu</a></li>
		<li><a href = "#" class = "menulist">Order</a></li>
        <li><a href = "#" class = "menulist">Contact</a></li>
		<li><a href="#" class = "menulist">List</a>
		<ul class = "hide">
			<li><a href = "">Staff List</a></li>
			<li><a href = "">Supplier List</a></li>
			<li><a href = "">Raw material List</a></li>
		</ul></li>
		<li ><a href="Supplier_Registration.php" class = "menulist">Register</a></li>
		<li><a href="Supplier_Login.php" class = "menulist">Login</a></li>
</ul>
</div>

<form action="Purchase_Order.php" method="get">
<fieldset class = "form">
<legend>Purchase Order Info :</legend>

<table border="0" cellpadding="4px">
<tr>
	<td>PO ID</td>
	<td>
	<input type="text" name="txtPurchaseOrderID" value="<?php echo AutoID('purchase', 'purchase_Id', 'PUR-', 6) ?>" readonly />
	</td>
	<td>PO Date</td>
	<td>
	<input type="text" name="txtPurchaseOrderDate" value="<?php echo date('Y-m-d') ?>" OnClick="showCalender(calender,this)" readonly />
	</td>
</tr>
<tr>
	<td>Staff Info</td>
	<td>
	<input type="text" name="txtStaffInfo" value="<?php echo $_SESSION['StaffName'] ?>" disabled />
	</td>
	<td>Arrival Date</td>
	<td>
	<input type="text" name="txtPurchaseArrivalDate" value="<?php echo date('Y-m-d') ?>" OnClick="showCalender(calender,this)" readonly />
	</td>
</tr>
<tr>
	<td colspan="4">
		<hr/>
	</td>
</tr>
<tr>
	<td>Total Amount</td>
	<td>
		<input type="number" name="txtTotalAmount" value="<?php echo CalculateTotalAmount() ?>" readonly /> (usd)
	</td>
	<td>VAT (5%)</td>
	<td>
		<input type="number" name="txtVAT" value="<?php echo CalculateVAT() ?>" readonly /> (usd)
	</td>
</tr>
<tr>
	<td>Total Quantity</td>
	<td>
		<input type="number" name="txtTotalQuantity" value="<?php echo CalculateTotalQuantity() ?>" readonly /> (pcs)
	</td>
	<td>Grand Total</td>
	<td>
		<input type="number" name="txtGrandTotal" value="<?php echo CalculateTotalAmount() + CalculateVAT() ?>" readonly /> (usd)
	</td>
</tr>
<tr>
	<td colspan="4">
		<hr/>
	</td>
</tr>
<tr>
	<td>RawID</td>
	<td>
		<select name="cboProductID" >

		<?php
		$ProductQuery = "SELECT * FROM raw";
		$Product_ret = mysqli_query($connection, $ProductQuery);
		$Product_count = mysqli_num_rows($Product_ret);

		if ($raw == 0) {
			echo "<option value = 'None'>Choose Raw</option>";
		} else {
			$query = "SELECT * from raw where raw_Id = $raw";
			$res = mysqli_query($connection, $query);
			$raws = mysqli_fetch_array($res);
			echo "<option value = '$raws[raw_Id]'>$raws[raw_Name]</option>";
		}
		for ($i = 0; $i < $Product_count; $i++) {
			$arr = mysqli_fetch_array($Product_ret);
			$ProductID = $arr['raw_Id'];
			$ProductName = $arr['raw_Name'];
			if ($ProductID != $raw)
				echo "<option value='$ProductID'>$ProductName</option>";
		}
		?>
        </select>

    </td>
    <td>Purchase Quantity</td>
    <td>
		<input type="number" name="txtPurchaseQuantity" value="<?php echo $quantity ?>" min = "0" />
	</td>
</tr>

<tr>
	<td>Purchase Price</td>
	<td>
        <input type="number" name="txtPurchasePrice" value="<?php echo $price ?>" min = "0"/>

	</td>
	<td>Pricing Type</td>
	<td>
        <select name="cboPricing" onchange="price_Type()">
        <?php if ($ptype !== 0)
			echo "<option value = '$ptype'> Per $ptype</option>";
		else
			echo "<option value = 'None' >Per None</option>";
		?>

        <option value="Litre">Per litre</option>
        <option value="Box">Per box</option>
        <option value="Kilogram">Per kilogram</option>
        <option value="Gram">Per gram</option>
        </select>

    </td>

</tr>
<tr>

	<td colspan="4" align="right">
	<input type="submit" name="btnAdd" value="Add" class = "btn" style = "background-color : #7289DA">
	<input type="reset"  value="Clear" class = "btn"/>
	</td>
</tr>
</table>

</fieldset>

<fieldset class = "form" style = "margin-top:20px">
<legend>Purchase Details :</legend>

<?php
if (!isset($_SESSION['POFunctions'])) {
	echo "<p>No Purchase Details Found.</p>";
	exit();
}
?>

<table border="1">
<tr>
	<th>Image</th>
	<th>ProductID</th>
	<th>ProductName</th>
	<th>PurchasePrice (USD)</th>
    <th>PurchaseQty (pcs)</th>
    <th>Sub-Total (USD)</th>
	<th>Action</th>
</tr>
<?php
$size = count($_SESSION['POFunctions']);

for ($i = 0; $i < $size; $i++) {
	$ProductID = $_SESSION['POFunctions'][$i]['ProductID'];
	$ProductImage1 = $_SESSION['POFunctions'][$i]['ProductImage1'];
	$type = $_SESSION['POFunctions'][$i]['Type'];

	echo "<tr>";
	echo "<td><img src='$ProductImage1' width='100px' height='100px'/></td>";
	echo "<td>" . $_SESSION['POFunctions'][$i]['ProductID'] . "</td>";
	echo "<td>" . $_SESSION['POFunctions'][$i]['ProductName'] . "</td>";
	echo "<td>" . $_SESSION['POFunctions'][$i]['PurchasePrice'] . " USD per " . $type . "</td>";
	echo "<td>" . $_SESSION['POFunctions'][$i]['PurchaseQuantity'] . " " . $type . "</td>";
	echo "<td>" . ($_SESSION['POFunctions'][$i]['PurchasePrice'] * $_SESSION['POFunctions'][$i]['PurchaseQuantity']) . "</td>";
	echo "<td>
		  <a href='Purchase_Order.php?action=remove&ProductID=$ProductID'>Remove</a>
		  </td>";
	echo "</tr>";
}

?>
<tr>
	<td colspan="7" align="right">
	Supplier ID :
	<select name="cboSupplierID" >
		<option>Choose Supplier</option>
		<?php
		$ProductQuery = "SELECT * FROM supplier";
		$Product_ret = mysqli_query($connection, $ProductQuery);
		$Product_count = mysqli_num_rows($Product_ret);

		for ($i = 0; $i < $Product_count; $i++) {
			$arr = mysqli_fetch_array($Product_ret);
			$ProductID = $arr['supplier_Id'];
			$ProductName = $arr['supplier_Name'];

			echo "<option value='$ProductID'>$ProductName</option>";
		}
		?>
        </select>
	|
	<input type="submit" name="btnSave" value="Save">
	|
	<a href="Purchase_Order.php?action=clearall">Clear All</a>
	</td>
</tr>
</table>
</fieldset>

</form> -->

</body>

</html>
