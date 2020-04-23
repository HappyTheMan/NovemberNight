<?php
include('../Template/Adminhead.php');
include('../AdminTemplate/head.php');
include('../connect.php');
if (isset($_POST['btnUpdate'])) {
	$StaffID = $_POST['txtStaffID'];
	$txtStaffName = $_POST['txtStaffName'];
	$txtPhone = $_POST['txtPhone'];
	$txtEmail = $_POST['txtEmail'];
	$txtPassword = $_POST['txtPassword'];
	$cboStaffTypeID = $_POST['cboStaffTypeID'];
	$txtAddress = $_POST['txtAddress'];

	$age = $_POST['numAge'];
	$exp = $_POST['numExp'];
	$cboBranchID = $_POST['cboBranch'];

	//Staff Image Upload Start-------------------------------
	$filStaffImage = $_FILES['filStaffImage']['name']; // abc.jpg
	$Folder = "../StaffImages/";
	$filename = $Folder . '_' . $filStaffImage; // StaffImages/_abc.jpg
	if ($filename != "../StaffImages/_") {

		$copied = copy($_FILES['filStaffImage']['tmp_name'], $filename);
		$Update = "UPDATE staff
                   SET
                   staff_Image = '$filename'
                   WHERE staff_Id = '$StaffID'";
		$ret = mysqli_query($connection, $Update);
	}
	/*  else{

        $Update = "UPDATE staff
                   SET
                   staff_Image = assdfsf
                   WHERE staff_Id = '$StaffID'";
        $ret = mysqli_query($connection,$Update);
    }*/
	$Update = "UPDATE staff
			 SET
             staff_TypeId='$cboStaffTypeID',
             branch_Id = '$cboBranchID',
			 staff_Name='$txtStaffName',
             staff_Email='$txtEmail',
             staff_Password='$txtPassword',
             staff_Address='$txtAddress',
			 staff_Phone='$txtPhone',
             staff_Age = '$age',
             staff_Exp = '$exp'
			 WHERE
			 staff_Id='$StaffID'
			 ";
	$ret = mysqli_query($connection, $Update);

	if ($ret) //True
	{
		echo "<script>window.alert('SUCCESS : Staff Account Updated')</script>";
		echo "<script>window.location='Staff_List.php'</script>";
	} else {
		echo "<p>Error : Something went wrong in Update" . mysqli_error($connection) . "</p>";
	}
}
if (isset($_GET['StaffID'])) {
	$StaffID = $_GET['StaffID'];

	$Staff_List = "SELECT s.*, st.*, b.*
                     FROM staff s, staff_type st, branch b
                     WHERE s.staff_Id='$StaffID'
                     AND s.staff_TypeId = st.staff_TypeId
                     AND s.branch_Id = b.branch_Id
                     ";
	$Staff_ret = mysqli_query($connection, $Staff_List);
	$Staff_count = mysqli_num_rows($Staff_ret);
	$rows = mysqli_fetch_array($Staff_ret);

	if ($Staff_count < 1) {
		echo "<script>window.alert('ERROR : Staff Profile Not Found')</script>";
		echo "<script>window.location='Staff_List.php'</script>";
	}
}

?>
<!DOCTYPE html>
<html>

<head>
	<title>Staff Update</title>
	<link rel="stylesheet" href="../entry.css">
</head>

<body>
	<!-- <div id="nav">
		<h1>November</h1>
		<div id="menu">
			<a href="#">menu</a>
			<a href="#">order</a>
			<a href="#">contact</a>
			<div id="log">
				<a href="Staff_Registration.php" class="Reg">Register</a>
				<a href="Staff_Login.php" class="Reg">Login</a>
			</div>
		</div>
	</div>
	<form action="Staff_Update.php" method="post" enctype="multipart/form-data" class="form">

		<fieldset>
			<legend>Staff Registration</legend>
			<img src="<?php echo $rows['staff_Image'] ?>" alt="" class="pp">
			<table>
				<tr>
					<td>Staff ID</td>
					<td>
						<input type="text" name="txtStaffID" value="<?php echo $rows['staff_Id'] ?>" readonly />
					</td>
				</tr>
				<tr>
					<td> Name</td>
					<td>
						<input type="text" name="txtStaffName" placeholder="Eg. Alan" value="<?php echo $rows['staff_Name'] ?>" />
					</td>
				</tr>
				<tr>
					<td>Phone</td>
					<td>
						<input type="text" name="txtPhone" placeholder="+95-----------" value="<?php echo $rows['staff_Phone'] ?>" />
					</td>
				</tr>
				<tr>
					<td>Email</td>
					<td>
						<input type="email" name="txtEmail" placeholder="example@email.com" value="<?php echo $rows['staff_Email'] ?>" />
					</td>
				</tr>
				<tr>
					<td>Password</td>
					<td>
						<input type="password" name="txtPassword" placeholder="XXXXXXXXXXXXXX" value="<?php echo $rows['staff_Password'] ?>" readonly />
					</td>
				</tr>
				<tr>
					<td>Staff Image</td>
					<td>
						<input type="file" name="filStaffImage" value="<?php echo $rows['staff_Image'] ?>" />
					</td>
				</tr>
				<tr>
					<td>Staff Type</td>
					<td>
						<select name="cboStaffTypeID">
							<option value="<?php echo $rows['staff_TypeId'] ?>"><?php echo $rows['Type'] ?></option>
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
						<textarea name="txtAddress" value=""><?php echo $rows['staff_Address'] ?></textarea>
					</td>
				</tr>
				<tr>
					<td>Gender</td>
					<td>
						<input type="text" value="<?php echo $rows['staff_Gender'] ?>" name="gender">
					</td>
				</tr>
				<tr>
					<td>Age</td>
					<td><input type="number" name="numAge" id="" min="1" max="100" value="<?php echo $rows['staff_Age'] ?>"></td>
				</tr>
				<tr>
					<td>Year of Experience</td>
					<td><input type="number" name="numExp" id="" min="0" max="100" value="<?php echo $rows['staff_Exp'] ?>"></td>
				</tr>
				<tr>
					<td>Currently working branch</td>
					<td>
						<select name="cboBranch">
							<option value="<?php echo $rows['branch_Id'] ?>"><?php echo $rows['Branch'] ?></option>
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
						<input type="submit" name="btnUpdate" class="btn" value="Update" />
						<input type="reset" name="btnClear" class="btn" value="Clear" />
					</td>
				</tr>
			</table>
		</fieldset>
	</form> -->
	<form id="test-form" class="white-popup-block mfp-hide" action="Staff_Update.php" method="post" style="padding-top:12%;margin-top:45%;" enctype="multipart/form-data" >
		<div class="popup_box">
			<div class="popup_inner">
				<div class="logo text-center">
					<div class="logo-img">
						<a href="displays.php">
							<h1 style="color:black;" class="hi"><i class="fas fa-cocktail" style="color:turquoise;"></i> November</h1>
						</a>
					</div>
				</div>
				<img src="<?php echo $rows['staff_Image'] ?>" alt="" class="pp" style="border-radius:100%;width:23%;height:100px;margin-bottom:10%;border:3px solid grey;">



				<div class="row">

					<div class="form-row col-xl-12">
						<div class="form-group col-xl-6 col-md-6">
							<input type="email" placeholder="Enter email address" name="txtEmail" class="form-control" value="<?php echo $rows['staff_Email']; ?>" required>
						</div>
						<div class="form-group col-xl-6 col-md-6">
							<input type="password" placeholder="Password" name="txtPassword" class="form-control" value="<?php echo $rows['staff_Password']; ?>" required>
						</div>
					</div>
					<div class="form-row col-xl-12">
						<div class="form-group col-xl-6 col-md-6">
							<input type="text" class="form-control" placeholder="Name" name="txtStaffName" value="<?php echo $rows['staff_Name'] ?>" required>
						</div>
						<div class="form-group col-xl-6 col-md-6">
							<input type="text" class="form-control" placeholder="Phone number" name="txtPhone" value="<?php echo $rows['staff_Phone']; ?>" required>
						</div>
					</div>
					<div class="col-xl-12 col-md-12">
						<textarea name="txtAddress" id="" cols="30" rows="10" placeholder="Address" class="form-control" style="margin-bottom: 40px;"><?php echo $rows['staff_Address']; ?></textarea>
					</div>
					<div class="col-xl-12 col-md-12">
						<select name="cboStaffTypeID" class="custom-select" style="margin-bottom: 40px;">
							<option value="<?php echo $rows['staff_TypeId'] ?>"><?php echo $rows['Type'] ?></option>
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
							<option value="<?php echo $rows['branch_Id'] ?>"><?php echo $rows['Branch'] ?></option>
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
					</div>
					<div class="form-row col-xl-12">
						<div class="col-xl-6 col-md-6">
							<input type="number" placeholder="Age" name="numAge" max="70" value="<?php echo $rows['staff_Age']; ?>" required>
						</div>
						<div class="col-xl-6 col-md-6">
							<input type="number" placeholder="Year of Experience" name="numExp" max="70" value="<?php echo $rows['staff_Exp']; ?>" required>
						</div>
					</div>
					<div class="form-row col-xl-12">
						<input type="text" class="form-control" name="gender" value="<?php echo $rows['staff_Gender']; ?>" required disabled>
					</div>
					<div class="col-xl-12" style="margin-bottom: 8%;">
						<div class="input-group">
							<div class="custom-file">
								<input type="file" class="custom-file-input" name = "filStaffImage" id="inputGroupFile04" value="<?php echo $rows['staff_Image']; ?>" >
								<label class="custom-file-label" for="inputGroupFile04"><?php echo $rows['staff_Image']; ?></label>
							</div>
						</div>
					</div>
					<div class="col-xl-12">

						<input type="hidden" name="txtStaffID" value="<?php echo $rows['staff_Id'] ?>" />
						<button type="submit" class="boxed_btn_green" name="btnUpdate" style="color:white">Update <i class="fas fa-user-edit"></i></button>
					</div>
				</div>

			</div>
		</div>
	</form>
</body>

</html>
