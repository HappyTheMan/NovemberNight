<?php
include('../Template/Adminhead.php');
include('../AdminTemplate/head.php');
include('../connect.php');
if (isset($_POST['btnUpdate'])) {
	$IDr = $_POST['txtID'];
	$txtName = $_POST['txtRawName'];
	$type = $_POST['cboRaw'];
	$price = $_POST['txtRawPrice'];
	$price_Type = $_POST['cboPack'];
	//Staff Image Upload Start-------------------------------
	$filImage = $_FILES['filImage']['name']; // abc.jpg
	$Folder = "../Raw Images/";

	$filename = $Folder . '_' . $filImage; // StaffImages/_abc.jpg
	if ($filename != "../Raw Images/_") {

		$copied = copy($_FILES['filImage']['tmp_name'], $filename);
		$Update = "UPDATE raw
                   SET
                   raw_Image = '$filename'
                   WHERE raw_Id = '$IDr'";
		$ret = mysqli_query($connection, $Update);
	}
	/*  else{

        $Update = "UPDATE staff
                   SET
                   staff_Image = assdfsf
                   WHERE staff_Id = '$StaffID'";
        $ret = mysqli_query($connection,$Update);
    }*/
	$Update = "UPDATE raw
			 SET
			 raw_Name='$txtName',
             raw_TypeId = '$type',
             quantity = '$price',
			 pricing_Type = '$price_Type'
			 WHERE
			 raw_Id ='$IDr'
			 ";
	$ret = mysqli_query($connection, $Update);

	if ($ret) //True
	{
		echo "<script>window.alert('SUCCESS : Raw Updated')</script>";
		echo "<script>window.location='Raw_List.php'</script>";
	} else {
		echo "<p>Error : Something went wrong in Update" . mysqli_error($connection) . "</p>";
	}
}
if (isset($_GET['RawID'])) {
	$ID = $_GET['RawID'];

	$List = "SELECT r.* , rt.*
               FROM raw r, raw_type rt
               WHERE raw_Id = '$ID'
               AND r.raw_TypeId = rt.raw_TypeId
               ";
	$ret = mysqli_query($connection, $List);
	$count = mysqli_num_rows($ret);
	$rows = mysqli_fetch_array($ret);

	if ($count < 1) {
		echo "<script>window.alert('ERROR : Raw Not Found')</script>";
		echo "<script>window.location='Raw_List.php'</script>";
	}
}

?>
<!DOCTYPE html>
<html>

<head>
	<title>Raw Update</title>
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
<form action="Raw_Update.php" method="post" enctype="multipart/form-data" class = "form">

<fieldset>
<legend>Raw Update</legend>
<img src="<?php echo $rows['raw_Image'] ?>" alt="" class = "pp" >
<table>
<tr>
	<td>Raw ID</td>
	<td>
		<input type="text" name="txtID" value="<?php echo $rows['raw_Id'] ?>" readonly/>
	</td>
</tr>
<tr>
	<td> Name</td>
	<td>
		<input type="text" name="txtName" placeholder="Eg. Alan"  value = "<?php echo $rows['raw_Name'] ?>" />
	</td>
</tr>

<tr>
	<td>raw Image</td>
	<td>
		<input type="file" name="filImage"  value = "<?php echo $rows['raw_Image'] ?>"/>
	</td>
</tr>
<tr>
	<td> Price Per Unit</td>
	<td>
		<input type="number" name="txtRawPrice" placeholder="100" required value = "<?php echo $rows['quantity'] ?>"/>
	</td>
</tr>
<tr>
	<td>Raw Type</td>
	<td>
		<select name="cboRaw">
			<option value = "<?php echo $rows['raw_TypeId'] ?>"><?php echo $rows['Type'] ?></option>
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
	<td> Pricing Type </td>
	<td>
		<select name="cboPack" >
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
		<input type="submit" name="btnUpdate" class = "btn" value="Update" />
		<input type="reset" name="btnClear" class =  "btn"value="Clear" />
	</td>
</tr>
</table>
</fieldset>

</form> -->
	<form id="test-form" class="white-popup-block mfp-hide" action="Raw_Update.php" method="post" style="padding-top:12%;margin-top:25%;" enctype="multipart/form-data">
		<div class="popup_box">
			<div class="popup_inner">
				<div class="logo text-center">
					<div class="logo-img">
						<a href="displays.php">
							<h1 style="color:black;" class="hi"><i class="fas fa-cocktail" style="color:turquoise;"></i> November</h1>
						</a>
					</div>
				</div>



				<img src="<?php echo $rows['raw_Image'] ?>" alt="" class="pp" style="border-radius:100%;width:23%;height:100px;margin-bottom:10%;border:3px solid grey;">
				<div class="row">

					<div class="form-row col-xl-12">
						<div class="form-group col-xl-6 col-md-6">
							<input type="text" placeholder="Enter material name" name="txtRawName" class="form-control" value="<?php echo $rows['raw_Name']; ?>" required>
						</div>
						<div class="form-group col-xl-6 col-md-6">
							<input type="number" placeholder="Quantity" name="txtRawPrice" class="form-control" value="<?php echo $rows['quantity']; ?>" required>
						</div>
					</div>
					<div class="col-xl-12 col-md-12">
						<select name="cboPack" class="custom-select" style="margin-bottom: 40px;">
							<option value="<?php echo $rows['pricing_Type']; ?>"><?php echo $rows['pricing_Type']; ?></option>
							<option value="Box">per box </option>
							<option value="Litre">per litre</option>
							<option value="Kilogram">per kilogram</option>
							<option value="Gram">per gram</option>
						</select>
					</div>
					<div class="col-xl-12 col-md-12">
						<select name="cboRaw" class="custom-select" style="margin-bottom: 40px;">
							<option value="<?php echo $rows['raw_TypeId'] ?>"><?php echo $rows['Type'] ?></option>
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
								<label class="custom-file-label" for="inputGroupFile04"><?php echo $rows['raw_Image']; ?></label>
							</div>
						</div>
					</div>
					<div class="col-xl-12">
						<input type="hidden" name="txtID" value="<?php echo $rows['raw_Id'] ?>" readonly />
						<input type="submit" value="Update" class="boxed_btn_green" name="btnUpdate" style="color:white">
					</div>
				</div>

			</div>
		</div>
	</form>
</body>

</html>
