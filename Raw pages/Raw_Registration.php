<?php
include('../Template/Adminhead.php');
include('../AdminTemplate/head.php');
include('../connect.php');

if (isset($_POST['btnReg'])) {
	$txtName = $_POST['txtRawName'];
	$type = $_POST['cboRaw'];
	$pack = $_POST['cboPack'];
	$quantity = $_POST['txtRawQuantity'];
	//Staff Image Upload Start-------------------------------
	$filImage = $_FILES['filImage']['name']; // abc.jpg
	$Folder = "../Raw Images/";

	$filename = $Folder . '_' . $filImage; // StaffImages/_abc.jpg
	$copied = copy($_FILES['filImage']['tmp_name'], $filename);

	if (!$copied) {
		echo "<p>Error in Raw Image Upload.</p>";
		exit();
	}
	//Staff Image Upload End-------------------------------

	$CheckName = "SELECT * FROM raw WHERE raw_Name ='$txtName'";
	$ret = mysqli_query($connection, $CheckName);
	$count = mysqli_num_rows($ret);

	if ($count != 0) {
		echo "<script>window.alert('The raw is already exists!')</script>";
		echo "<script>window.location='Raw_Registration.php'</script>";
	} else {
		$Insert = "INSERT INTO `raw` (`raw_Id`, `raw_Name`, `raw_TypeId`, `raw_Image` , `quantity`, `pricing_Type`)
                 VALUES (NULL, '$txtName', '$type', '$filename', '$quantity', '$pack')
				";
		$ret = mysqli_query($connection, $Insert);

		if ($ret) //True
		{
			echo "<script>window.alert('SUCCESS : New Raw Material Created')</script>";
			echo "<script>window.location='Raw_Registration.php'</script>";
		} else {
			echo "<p>Error : Something went wrong " . mysqli_error($connection) . "</p>";
		}
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Raw Registration</title>
	<link rel="stylesheet" href="../entry.css">
</head>

<body>
	<!-- <div id="nav">
		<a href="../home.php" id="home">November</a>
		<div id="menu">
			<a href="#">menu</a>
			<a href="#">order</a>
			<a href="#">contact</a>
			<div id="log">
				<a href="Supplier_Registration.php" class="Reg">Register</a>
				<a href="Supplier_Login.php" class="Reg">Login</a>
			</div>
		</div>
	</div>
	<form action="Raw_Registration.php" method="post" enctype="multipart/form-data" class="form">

		<fieldset>
			<legend>Raw Registration</legend>

			<table>
				<tr>
					<td> Name</td>
					<td>
						<input type="text" name="txtRawName" placeholder="Eg. Milk,sugar" required />
					</td>
				</tr>

				<tr>
					<td>Raw Image</td>
					<td>
						<input type="file" name="filImage" required />
					</td>
				</tr>

				<tr>
					<td>Raw Type</td>
					<td>
						<select name="cboRaw">
							<option>Choose Raw Type</option>
							<?php
							$query = "SELECT * FROM raw_type";
							$ret = mysqli_query($connection, $query);
							$count = mysqli_num_rows($ret);

							for ($i = 0; $i < $count; $i++) {
								$row = mysqli_fetch_array($ret);
								$RawTypeID = $row['raw_TypeId'];
								$RawType = $row['Type'];

								echo "<option value='$RawTypeID'>$RawType</option>";
							}
							?>
						</select>
					</td>
				</tr>

				<tr>
					<td> Quantity </td>
					<td>
						<input type="number" name="txtRawQuantity" placeholder="100" required />
					</td>
				</tr>

				<tr>
					<td> Pricing Type </td>
					<td>
						<select name="cboPack">
							<option value="Box">per box </option>
							<option value="Litre">per litre</option>
							<option value="Kilogram">per kilogram</option>
							<option value="Gram">per gram</option>
						</select>
					</td>
				</tr>

				<tr>
					<td></td>
					<td>
						<input type="submit" name="btnReg" class="btn" value="Register" />
						<input type="reset" name="btnClear" class="btn" value="Clear" />
					</td>
				</tr>
			</table>
		</fieldset>

	</form> -->
	<form id="test-form" class="white-popup-block mfp-hide" action="Raw_Registration.php" method="post" style="padding-top:12%;margin-top:25%;" enctype = "multipart/form-data">
		<div class="popup_box">
			<div class="popup_inner">
				<div class="logo text-center">
					<div class="logo-img">
						<a href="displays.php">
							<h1 style="color:black;" class="hi"><i class="fas fa-cocktail" style="color:turquoise;"></i> November</h1>
						</a>
					</div>
				</div>
				<h3 style="text-align:center;">Raw Registration</h3>
				<div class="row">

					<div class="form-row col-xl-12">
						<div class="form-group col-xl-6 col-md-6">
							<input type="text" placeholder="Enter material name" name="txtRawName" class="form-control" required>
						</div>
						<div class="form-group col-xl-6 col-md-6">
							<input type="number" placeholder="Quantity" name="txtRawQuantity" class="form-control" required>
						</div>
					</div>
					<div class="col-xl-12 col-md-12">
						<select name="cboPack" class="custom-select" style="margin-bottom: 40px;">
							<option value="Box">per box </option>
							<option value="Litre">per litre</option>
							<option value="Kilogram">per kilogram</option>
							<option value="Gram">per gram</option>
						</select>
					</div>
					<div class="col-xl-12 col-md-12">
						<select name="cboRaw" class="custom-select" style="margin-bottom: 40px;">
							<option>Choose Raw Type</option>
							<?php
							$query = "SELECT * FROM raw_type";
							$ret = mysqli_query($connection, $query);
							$count = mysqli_num_rows($ret);

							for ($i = 0; $i < $count; $i++) {
								$row = mysqli_fetch_array($ret);
								$RawTypeID = $row['raw_TypeId'];
								$RawType = $row['Type'];

								echo "<option value='$RawTypeID'>$RawType</option>";
							}
							?>
						</select>
					</div>
					<div class="col-xl-12" style="margin-bottom: 8%;">
						<div class="input-group">
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" name="filImage">
								<label class="custom-file-label" for="inputGroupFile04">Choose an image</label>
							</div>
						</div>
					</div>
					<div class="col-xl-12">
						<input type="submit" value="Register" class="boxed_btn_green" name="btnReg" style="color:white">
					</div>
				</div>

			</div>
		</div>
	</form>
</body>

</html>
