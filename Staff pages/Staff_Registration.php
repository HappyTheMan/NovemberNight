<?php
include('../Template/Adminhead.php');
include('../AdminTemplate/head.php');
include('../connect.php');

if (isset($_POST['btnReg'])) {
	$txtStaffName = $_POST['txtStaffName'];
	$txtPhone = $_POST['txtPhone'];
	$txtEmail = $_POST['txtEmail'];
	$txtPassword = $_POST['txtPassword'];
	$cboStaffTypeID = $_POST['cboStaffTypeID'];
	$txtAddress = $_POST['txtAddress'];
	$gender = $_POST['gender'];
	$age = $_POST['numAge'];
	$exp = $_POST['numExp'];
	$cboBranchID = $_POST['cboBranch'];

	//Staff Image Upload Start-------------------------------
	$filStaffImage = $_FILES['filStaffImage']['name']; // abc.jpg
	$Folder = "../StaffImages/";

	$filename = $Folder . '_' . $filStaffImage; // StaffImages/_abc.jpg
	$copied = copy($_FILES['filStaffImage']['tmp_name'], $filename);

	if (!$copied) {
		echo "<p>Error in Staff Image Upload.</p>";
		exit();
	}
	//Staff Image Upload End-------------------------------

	$CheckEmail = "SELECT * FROM staff WHERE staff_Email='$txtEmail'";
	$ret = mysqli_query($connection, $CheckEmail);
	$count = mysqli_num_rows($ret);

	if ($count != 0) {
		echo "<script>window.alert('Your email is the same with others!')</script>";
		echo "<script>window.location='Staff_Registration.php'</script>";
	} elseif ($age <= $exp) {
		echo "<script>window.alert('Your years of experience must not equal or exceed than your age')</script>";
		echo "<script>window.location='Staff_Registration.php'</script>";
	} else {
		$Insert = "INSERT INTO `staff` (`staff_Id`, `staff_TypeId`, `branch_Id`, `staff_Name`, `staff_Email`, `staff_Password`, `staff_Address`, `staff_Phone`, `staff_Gender`, `staff_Image`, `staff_Age`, `staff_Exp`)
				 VALUES (NULL, '$cboStaffTypeID', '$cboBranchID', '$txtStaffName', '$txtEmail', '$txtPassword', '$txtAddress', '$txtPhone', '$gender', '$filename', '$age', '$exp')
				";
		$ret = mysqli_query($connection, $Insert);

		if ($ret) //True
		{
			echo "<script>window.alert('SUCCESS : Staff Account Created')</script>";
			echo "<script>window.location='Staff_Registration.php'</script>";
		} else {
			echo "<p>Error : Something went wrong " . mysqli_error($connection) . "</p>";
		}
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Staff Registration</title>
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
<div class="container">


	<form id="test-form" class="white-popup-block mfp-hide" action="Staff_Registration.php" method="post" style="padding-top:12%;margin-top:45%;" enctype="multipart/form-data">
		<div class="popup_box">
			<div class="popup_inner">
				<div class="logo text-center">
					<div class="logo-img">
						<a href="displays.php">
							<h1 style="color:black;" class="hi"><i class="fas fa-cocktail" style="color:turquoise;"></i> November</h1>
						</a>
					</div>
				</div>
				<h3 style="text-align:center;">Staff Registration</h3>

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
					<div class="col-xl-12 col-md-12">
						<select name="cboStaffTypeID" class="custom-select" style="margin-bottom: 40px;">
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
					</div>
					<div class="col-xl-12 col-md-12">
						<select name="cboBranch" class="custom-select" style="margin-bottom: 40px;">
							<option>Choose Branch Type</option>
							<?php
							$Staff_query = "SELECT * FROM branch";
							$Staff_ret = mysqli_query($connection, $Staff_query);
							$Staff_count = mysqli_num_rows($Staff_ret);

							for ($i = 0; $i < $Staff_count; $i++) {
								$row = mysqli_fetch_array($Staff_ret);
								$BranchID = $row['branch_Id'];
								$Branch = $row['Branch'];

								echo "<option value='$BranchID'>$Branch</option>";
							}
							?>
						</select>
					</div>
					<div class="form-row col-xl-12">
						<div class="col-xl-6 col-md-6">
							<input type="number" placeholder="Age" name="numAge" max="70" required>
						</div>
						<div class="col-xl-6 col-md-6">
							<input type="number" placeholder="Year of Experience" name="numExp" max="70" required>
						</div>
					</div>
					<div class="form-row col-xl-12">
						<div class="form-row col-xl-6 col-md-6 col-sm-6">
							<div class="col-xl-6 col-md-6">
								<input type="radio" name="gender" id="rdoMale" value="Male" style="width: 20px;" checked>
							</div>
							<div class="col-xl-6 col-md-6">
								<i class="fas fa-male" style="font-size:50px;color:lightblue;"></i>
							</div>

						</div>
						<div class="form-row col-xl-6 col-md-6 col-sm-6">
							<div class="col-xl-6 col-md-6 ">
								<input type="radio" name="gender" id="rdoFemale" value="Female" style="width: 20px;">
							</div>
							<div class="col-xl-6 col-md-6 ">
								<i class="fas fa-female" style="font-size:50px;color:lightpink;"></i>
							</div>

						</div>
					</div>
					<div class="col-xl-12" style="margin-bottom: 8%;">
						<div class="input-group">
							<div class="custom-file">
							<input type="file" class="custom-file-input" name = "filStaffImage"id="inputGroupFile04" required>
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
	</div>
</body>

</html>
