<?php
include('../Template/Theader.php');
include('../connect.php');

if (isset($_POST['btnReg'])) {
	$txtStaffName = $_POST['txtStaffName'];
	$txtPhone = $_POST['txtPhone'];
	$txtEmail = $_POST['txtEmail'];
	$txtPassword = $_POST['txtPassword'];

	//Staff Image Upload Start-------------------------------
	$filStaffImage = $_FILES['filStaffImage']['name']; // abc.jpg
	$Folder = "../Customer images/";

	$filename = $Folder . '_' . $filStaffImage; // StaffImages/_abc.jpg
	if ($filename == "../Customer images/_")
		$filename = "../Customer images/user1.png";

	if ($_FILES['filStaffImage']['tmp_name']) {
		$copied = copy($_FILES['filStaffImage']['tmp_name'], $filename);
		if (!$copied) {
			echo "<p>Error in Staff Image Upload.</p>";
			exit();
		}
	}


	//Staff Image Upload End-------------------------------

	$CheckEmail = "SELECT * FROM customer WHERE customer_Email='$txtEmail'";
	$ret = mysqli_query($connection, $CheckEmail);
	$count = mysqli_num_rows($ret);

	if ($count != 0) {
		echo "<script>window.alert('Your email is the same with others!')</script>";
		echo "<script>window.location='Customer_Registration.php'</script>";
	} else {
		$Insert = "INSERT INTO `customer` (`customer_Id`, `customer_Name`, `customer_Email`, `customer_Password`, `customer_Phone`, `customer_Image`)
		VALUES (NULL, '$txtStaffName', '$txtEmail', '$txtPassword', '$txtPhone', '$filename')";
		$ret = mysqli_query($connection, $Insert);

		if ($ret) //True
		{
			echo "<script>window.alert('SUCCESS : customer Account Created')</script>";
			echo "<script>window.location='Customer_Registration.php'</script>";
		} else {
			echo "<p>Error : Something went wrong " . mysqli_error($connection) . "</p>";
		}
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Customer Registration</title>
	<link rel="stylesheet" href="../entry.css">
	<style>
		.radios {
			width: 10px;
			height: 10px;
		}
	</style>
</head>

<body>
	<!-- <form action="Staff_Registration.php" method="post" enctype="multipart/form-data" class = "form">
 -->
	<!-- <fieldset>
<legend>Staff Registration</legend>

<table>
<tr>
	<td> Name</td>
	<td>
		<input type="text" name="txtStaffName" placeholder="Eg. Alan" required />
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
	<td>Staff Image</td>
	<td>
		<input type="file" name="filStaffImage" required />
	</td>
</tr>
<tr>
	<td>Staff Type</td>
	<td>
		<select name="cboStaffTypeID">
			<option>Choose Staff Type</option>
			<?php
			$Staff_query = "SELECT * FROM staff_type";
			$Staff_ret = mysqli_query($connection, $Staff_query);
			$Staff_count = mysqli_num_rows($Staff_ret);

			for ($i = 0; $i < $Staff_count; $i++) {
				$row = mysqli_fetch_array($Staff_ret);
				$StaffTypeID = $row['staff_TypeId'];
				$StaffType = $row['Type'];

				echo "<option value='$StaffTypeID'>$StaffType</option>";
			}
			?>
		</select>
	</td>
</tr>
<tr>
	<td>Address</td>
	<td>
		<textarea name="txtAddress"></textarea>
	</td>
</tr>
<tr>
	<td>Gender</td>
	<td>

	</td>
</tr>
<tr>
	<td>Age</td>
	<td><input type="number" name="numAge" id="" min = "1" max = "100" ></td>
</tr>
<tr>
	<td>Year of Experience</td>
	<td><input type="number" name="numExp" id="" min = "0" max = "100"></td>
</tr>
<tr>
	<td>Currently working branch</td>
	<td>
		<select name="cboBranch">
			<option>Choose your current branch</option>
			<?php
			$Staff_query = "SELECT * FROM branch";
			$Staff_ret = mysqli_query($connection, $Staff_query);
			$Staff_count = mysqli_num_rows($Staff_ret);

			for ($i = 0; $i < $Staff_count; $i++) {
				$row = mysqli_fetch_array($Staff_ret);
				$BranchID = $row['Branch_Id'];
				$Branch = $row['Branch'];

				echo "<option value='$BranchID'>$Branch</option>";
			}
			?>
		</select>
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
	<form id="test-form" class="white-popup-block mfp-hide" action="Customer_Registration.php" method="post" style="padding-top:12%;margin-top:0;" enctype="multipart/form-data">
		<div class="popup_box">
			<div class="popup_inner">
				<div class="logo text-center">
					<div class="logo-img">
						<a href="displays.php">
							<h1 style="color:black;" class="hi"><i class="fas fa-cocktail" style="color:turquoise;"></i> November</h1>
						</a>
					</div>
				</div>
				<h3 style="text-align:center;">Customer Registration</h3>

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
					<div class="col-xl-12" style="margin-bottom: 8%;">
						<div class="input-group">
							<div class="custom-file">
								<input type="file" class="custom-file-input" name="filStaffImage" id="inputGroupFile04">
								<label class="custom-file-label" for="inputGroupFile04">Choose an image</label>
							</div>
						</div>
					</div>
					<div class="col-xl-12">
						<button type="submit" class="boxed_btn_green" name="btnReg" style="color:white">Register <i class="fas fa-save"></i></button>
					</div>
				</div>

			</div>
		</div>
	</form>


	</form>
</body>

</html>
