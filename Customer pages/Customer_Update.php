<?php
include('../Template/Theader.php');
include('../connect.php');
if (isset($_POST['btnUpdate'])) {
	$StaffID = $_POST['txtStaffID'];
	$txtStaffName = $_POST['txtStaffName'];
	$txtPhone = $_POST['txtPhone'];
	$txtEmail = $_POST['txtEmail'];
	$txtPassword = $_POST['txtPassword'];


	//Staff Image Upload Start-------------------------------
	$filStaffImage = $_FILES['filStaffImage']['name']; // abc.jpg
	$Folder = "../Customer images/";
	$filename = $Folder . '_' . $filStaffImage; // StaffImages/_abc.jpg
	if ($filename != "../Customer images/_") {

		$copied = copy($_FILES['filStaffImage']['tmp_name'], $filename);
		$Update = "UPDATE customer
                   SET
                   customer_Image = '$filename'
                   WHERE customer_Id = '$StaffID'";
		$ret = mysqli_query($connection, $Update);
	}
	/*  else{

        $Update = "UPDATE customer
                   SET
                   staff_Image = assdfsf
                   WHERE staff_Id = '$StaffID'";
        $ret = mysqli_query($connection,$Update);
    }*/
	$Update = "UPDATE customer
			 SET
			 customer_Name='$txtStaffName',
             customer_Email='$txtEmail',
			 customer_Phone='$txtPhone'
			 WHERE
			 customer_Id='$StaffID'
			 ";
	$ret = mysqli_query($connection, $Update);

	if ($ret) //True
	{
		echo "<script>window.alert('SUCCESS : Customer Account Updated')</script>";
		echo "<script>window.location='Customer_List.php'</script>";
	} else {
		echo "<p>Error : Something went wrong in Update" . mysqli_error($connection) . "</p>";
	}
}
if (isset($_SESSION['CustomerID'])) {
	$StaffID = $_SESSION['CustomerID'];


	$Staff_List = "SELECT s.*
                     FROM customer s
                     WHERE s.customer_Id='$StaffID'
                     ";
	$Staff_ret = mysqli_query($connection, $Staff_List);
	$Staff_count = mysqli_num_rows($Staff_ret);
	$rows = mysqli_fetch_array($Staff_ret);

	if ($Staff_count < 1) {
		echo "<script>window.alert('ERROR : Customer Profile Not Found')</script>";
		echo "<script>window.location='Staff_List.php'</script>";
	}
}
else
{
		$StaffID = $_GET['StaffID'];
		$Staff_List = "SELECT s.*
											 FROM customer s
											 WHERE s.customer_Id='$StaffID'
											 ";
		$Staff_ret = mysqli_query($connection, $Staff_List);
		$Staff_count = mysqli_num_rows($Staff_ret);
		$rows = mysqli_fetch_array($Staff_ret);

}

?>
<!DOCTYPE html>
<html>

<head>
	<title>Customer Update</title>
	<link rel="stylesheet" href="../entry.css">
</head>

<body>

	<div class="container">


	<form  class="white-popup-block mfp-hide" action="Customer_Update.php" method="post" style="margin-left:25%;" enctype="multipart/form-data" >
		<div class="popup_box">
			<div class="popup_inner">
				<div class="logo text-center">
					<div class="logo-img">
						<a href="../Home page/homie.php">
							<h1 style="color:black;" class="hi"><i class="fas fa-cocktail" style="color:turquoise;"></i> November</h1>
						</a>
					</div>
				</div>
				<img src="<?php echo $rows['customer_Image'] ?>" alt="" class="pp" style="border-radius:100%;width:23%;height:100px;margin-bottom:10%;border:3px solid grey;margin-left:40%;">



				<div class="row">

					<div class="form-row col-xl-12">
						<div class="form-group col-xl-6 col-md-6">
							<input type="email" placeholder="Enter email address" name="txtEmail" class="form-control" value="<?php echo $rows['customer_Email']; ?>" required>
						</div>
						<div class="form-group col-xl-6 col-md-6">
							<input type="password" placeholder="Password" name="txtPassword" class="form-control" value="<?php echo $rows['customer_Password']; ?>" disabled>
						</div>
					</div>
					<div class="form-row col-xl-12">
						<div class="form-group col-xl-6 col-md-6">
							<input type="text" class="form-control" placeholder="Name" name="txtStaffName" value="<?php echo $rows['customer_Name'] ?>" required>
						</div>
						<div class="form-group col-xl-6 col-md-6">
							<input type="text" class="form-control" placeholder="Phone number" name="txtPhone" value="<?php echo $rows['customer_Phone']; ?>" required>
						</div>
					</div>



					<div class="col-xl-12" style="margin-bottom: 8%;">
						<div class="input-group">
							<div class="custom-file">
								<input type="file" class="custom-file-input" name = "filStaffImage" id="inputGroupFile04" value="<?php echo $rows['customer_Image']; ?>" >
								<label class="custom-file-label" for="inputGroupFile04"><?php echo $rows['customer_Image']; ?></label>
							</div>
						</div>
					</div>
					<div class="col-xl-12">

						<input type="hidden" name="txtStaffID" value="<?php echo $rows['customer_Id'] ?>" />
						<button type="submit" class="boxed_btn_green" name="btnUpdate" style="color:white">Update <i class="fas fa-user-edit"></i></button>
					</div>
				</div>

			</div>
		</div>
	</form>
		</div>
		<?php include('../Template/Tfooter.php'); ?>
</body>

</html>
