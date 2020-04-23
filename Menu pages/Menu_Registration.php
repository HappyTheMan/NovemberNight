<?php
include('../Template/Adminhead.php');
include('../AdminTemplate/head.php');
include('../connect.php');

if (isset($_POST['btnReg'])) {
	$txtName = $_POST['txtRawName'];
	$type = $_POST['cboMenu'];
	$quantity = $_POST['txtRawQuantity'];
	$price = $_POST['txtPrice'];
	$ingredient = $_POST['txtin'];
	//Staff Image Upload Start-------------------------------
	$filImage = $_FILES['filImage']['name']; // abc.jpg
	$Folder = "../Menu images/";

	$filename = $Folder . '_' . $filImage; // StaffImages/_abc.jpg
	$copied = copy($_FILES['filImage']['tmp_name'], $filename);

	if (!$copied) {
		echo "<p>Error in Menu Image Upload.</p>";
		exit();
	}
	//Staff Image Upload End-------------------------------

	$CheckName = "SELECT * FROM menu WHERE menu_Name ='$txtName'";
	$ret = mysqli_query($connection, $CheckName);
	$count = mysqli_num_rows($ret);

	if ($count != 0) {
		echo "<script>window.alert('The menu is already exists!')</script>";
		echo "<script>window.location='Raw_Registration.php'</script>";
	} else {
		$Insert = "INSERT INTO `menu` (`menu_Id`, `menu_Name`, `menu_Image`, `menu_Price`, `menu_Type`, `menu_Duration`, `Ingredient`,`status`)
		 VALUES (NULL, '$txtName', '$filename', '$price', '$type', '$quantity', '$ingredient','Available')
				";
		$ret = mysqli_query($connection, $Insert);

		if ($ret) //True
		{
			echo "<script>window.alert('SUCCESS : New Menu Created')</script>";
			echo "<script>window.location='Menu_Registration.php'</script>";
		} else {
			echo "<p>Error : Something went wrong " . mysqli_error($connection) . "</p>";
		}
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Menu Registration</title>
	<link rel="stylesheet" href="../entry.css">
</head>

<body>
	<form id="test-form" class="white-popup-block mfp-hide" action="Menu_Registration.php" method="post" style="padding-top:12%;margin-top:35%;" enctype = "multipart/form-data">
		<div class="popup_box">
			<div class="popup_inner">
				<div class="logo text-center">
					<div class="logo-img">
						<a href="displays.php">
							<h1 style="color:black;" class="hi"><i class="fas fa-cocktail" style="color:turquoise;"></i> November</h1>
						</a>
					</div>
				</div>
				<h3 style="text-align:center;">Menu Registration</h3>
				<div class="row">

					<div class="form-row col-xl-12">
						<div class="form-group col-xl-6 col-md-6">
							<input type="text" placeholder="Enter material name" name="txtRawName" class="form-control" required>
						</div>
						<div class="form-group col-xl-6 col-md-6">
							<input type="number" placeholder="Duration" name="txtRawQuantity" class="form-control" required>
						</div>

					</div>
					<div class="form-group col-xl-12 col-md-12">
						<input type="number" placeholder="Price" name="txtPrice" class="form-control" required>
					</div>
					<div class="col-xl-12 col-md-12">
						<select name="cboMenu" class="custom-select" style="margin-bottom: 40px;">
							<option value = "0">Choose Menu Type</option>
							<option value = "coffee">Coffee</option>
							<option value = "tea">Tea</option>
							<option value = "drink">Drinks</option>
							<option value = "food">Foods</option>
						</select>
					</div>
					<div class="col-xl-12 col-md-12">
						<textarea name="txtin" id="" cols="30" rows="10" placeholder="Ingredients" class="form-control" style="margin-bottom: 40px;"></textarea>
					</div>
					<div class="col-xl-12" style="margin-bottom: 8%;">
						<div class="input-group">
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" name="filImage" required>
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
