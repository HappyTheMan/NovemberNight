<?php
include('../Template/Theader.php');
include('../connect.php');

if (isset($_POST['btnReg'])) {
	$txtName = $_POST['txtStaffName'];
	$txtPhone = $_POST['txtPhone'];
	$txtEmail = $_POST['txtEmail'];
	$txtPassword = $_POST['txtPassword'];
	$txtAddress = $_POST['txtAddress'];
	//Staff Image Upload Start-------------------------------
	$filImage = $_FILES['filImage']['name']; // abc.jpg
	$Folder = "../Supplier Images/";

	$filename = $Folder . '_' . $filImage; // StaffImages/_abc.jpg
	$copied = copy($_FILES['filImage']['tmp_name'], $filename);

	if (!$copied) {
		echo "<p>Error in Supplier Image Upload.</p>";
		exit();
	}
	//Staff Image Upload End-------------------------------

	$CheckEmail = "SELECT * FROM supplier WHERE supplier_Email='$txtEmail'";
	$ret = mysqli_query($connection, $CheckEmail);
	$count = mysqli_num_rows($ret);

	if ($count != 0) {
		echo "<script>window.alert('Your email is the same with others!')</script>";
		echo "<script>window.location='Supplier_Registration.php'</script>";
	} else {
		$Insert = "INSERT INTO `supplier` (`supplier_Id`, `supplier_Name`, `supplier_Email`, `supplier_Password`, `supplier_Address`, `supplier_Phone`, `supplier_Image`) 
                 VALUES (NULL, '$txtName', '$txtEmail', '$txtPassword', '$txtAddress', '$txtPhone', '$filename')
				";
		$ret = mysqli_query($connection, $Insert);

		if ($ret) //True
		{
			echo "<script>window.alert('SUCCESS : Supplier Account Created')</script>";
			echo "<script>window.location='Supplier_Registration.php'</script>";
		} else {
			echo "<p>Error : Something went wrong " . mysqli_error($connection) . "</p>";
		}
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Supplier Registration</title>
	<link rel="stylesheet" href="../entry.css">
</head>

<body>
	<!-- <div id = "nav">
	<h1>November</h1>
	<div id = "menu">
		<a href = "#">menu</a>
		<a href = "#">order</a>
		<a href = "#">contact</a>
		<div id = "log">
			<a href="Supplier_Registration.php" class = "Reg">Register</a>
			<a href="Supplier_Login.php"class = "Reg">Login</a>
		</div>
	</div>
</div>
<form action="Supplier_Registration.php" method="post" enctype="multipart/form-data" class = "form">

<fieldset>
<legend>Supplier Registration</legend>

<table>
<tr>
	<td> Name</td>
	<td>
		<input type="text" name="txtStaffName" placeholder="Eg. Academy company" required />
	</td>
</tr>
<tr>
	<td>Phone</td>
	<td>
		<input type="text" name="txtPhone" placeholder="+95-----------" required />
	</td>
</tr>
<tr>
	<td>Email</td>
	<td>
		<input type="email" name="txtEmail" placeholder="example@email.com" required />
	</td>
</tr>
<tr>
	<td>Password</td>
	<td>
		<input type="password" name="txtPassword" placeholder="XXXXXXXXXXXXXX" required />
	</td>
</tr>
<tr>
	<td>Supplier Image</td>
	<td>
		<input type="file" name="filImage" required />
	</td>
</tr>

<tr>
	<td>Address</td>
	<td>
		<textarea name="txtAddress"></textarea>
	</td>
</tr>


<tr>
	<td></td>
	<td>
		<input type="submit" name="btnReg" class = "btn" value="Register" />
		<input type="reset" name="btnClear" class =  "btn"value="Clear" />
	</td>
</tr>
</table>
</fieldset>

</form> -->
	<form id="test-form" class="white-popup-block mfp-hide" action="Supplier_Registration.php" method="post" style="padding-top:12%;margin-top:10%;" enctype="multipart/form-data">
		<div class="popup_box">
			<div class="popup_inner">
				<div class="logo text-center">
					<div class="logo-img">
						<a href="displays.php">
							<h1 style="color:black;" class="hi"><i class="fas fa-cocktail" style="color:turquoise;"></i> November</h1>
						</a>
					</div>
				</div>
				<h3 style="text-align:center;">Supplier Registration</h3>




				<div class="row">

					<div class="form-row col-xl-12">
						<div class="form-group col-xl-6 col-md-6">
							<input type="email" placeholder="Enter email address" name="txtEmail" class="form-control" required>
						</div>
						<div class="form-group col-xl-6 col-md-6">
							<input type="password" placeholder="Password" name="txtPassword" class="form-control" required>
						</div>
					</div>
					<div class="form-row col-xl-12">
						<div class="form-group col-xl-6 col-md-6">
							<input type="text" class="form-control" placeholder="Name" name="txtStaffName" required>
						</div>
						<div class="form-group col-xl-6 col-md-6">
							<input type="text" class="form-control" placeholder="Phone number" name="txtPhone" required>
						</div>
					</div>
					<div class="col-xl-12 col-md-12">
						<textarea name="txtAddress" id="" cols="30" rows="10" placeholder="Address" class="form-control" style="margin-bottom: 40px;"></textarea>
					</div>
					
					<div class="col-xl-12" style="margin-bottom: 8%;">
						<div class="input-group">
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" name ="filImage">
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