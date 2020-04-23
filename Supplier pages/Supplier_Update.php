<?php
	include('../Template/Theader.php');
    include('../connect.php');
    if(isset($_POST['btnUpdate'])) 
{
    $ID = $_POST['txtStaffID'];
    $txtName=$_POST['txtStaffName'];
	$txtPhone=$_POST['txtPhone'];
	$txtEmail=$_POST['txtEmail'];
	$txtPassword=$_POST['txtPassword'];
	$txtAddress=$_POST['txtAddress'];
	//Staff Image Upload Start-------------------------------
	$filImage=$_FILES['filImage']['name']; // abc.jpg
	$Folder="../Supplier Images/"; 

	$filename=$Folder . '_' . $filImage; // StaffImages/_abc.jpg
    if($filename != "../Supplier Images/_")
    {
	    
	    $copied=copy($_FILES['filImage']['tmp_name'], $filename);
        $Update = "UPDATE supplier
                   SET
                   supplier_Image = '$filename'
                   WHERE supplier_Id = '$ID'";
        $ret = mysqli_query($connection,$Update);
    }
  /*  else{
        
        $Update = "UPDATE staff
                   SET
                   staff_Image = assdfsf
                   WHERE staff_Id = '$StaffID'";
        $ret = mysqli_query($connection,$Update);
    }*/
    $Update="UPDATE supplier
			 SET
			 supplier_Name='$txtName',
             supplier_Email='$txtEmail',
             supplier_Password='$txtPassword',
             supplier_Address='$txtAddress',
			 supplier_Phone='$txtPhone'
			 WHERE
			 supplier_Id ='$ID'
			 ";
	$ret=mysqli_query($connection,$Update);

	if($ret) //True
	{
		echo "<script>window.alert('SUCCESS : supplier Account Updated')</script>";
		echo "<script>window.location='Supplier_List.php'</script>";
	}
	else
	{
		echo "<p>Error : Something went wrong in Update" . mysqli_error($connection) . "</p>";
	
}
}
    if (isset($_GET['SupplierID'])) 
    {
        $ID=$_GET['SupplierID'];
    
        $List="SELECT * FROM supplier WHERE supplier_Id = '$ID';
                     ";
        $ret=mysqli_query($connection,$List);
        $count=mysqli_num_rows($ret);
        $rows=mysqli_fetch_array($ret);
    
        if($count < 1) 
        {
            echo "<script>window.alert('ERROR : Supplier Profile Not Found')</script>";
            echo "<script>window.location='Supplier_List.php'</script>";
        }
    }

?>
<!DOCTYPE html>
<html>
<head>
	<title>Supplier Update</title>
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
<form action="Supplier_Update.php" method="post" enctype="multipart/form-data" class = "form">

<fieldset>
<legend>Supplier Registration</legend>
<img src="<?php echo $rows['supplier_Image'] ?>" alt="" class = "pp" >
<table>
<tr>
	<td>Supplier ID</td>
	<td>
		<input type="text" name="txtStaffID" value="<?php echo $rows['supplier_Id'] ?>" readonly/>
	</td>
</tr>
<tr>
	<td> Name</td>
	<td>
		<input type="text" name="txtStaffName" placeholder="Eg. Alan"  value = "<?php echo $rows['supplier_Name'] ?>" />
	</td>
</tr>
<tr>
	<td>Phone</td>
	<td>
		<input type="text" name="txtPhone" placeholder="+95-----------"  value = "<?php echo $rows['supplier_Phone'] ?>"/>
	</td>
</tr>
<tr>
	<td>Email</td>
	<td>
		<input type="email" name="txtEmail" placeholder="example@email.com"  value = "<?php echo $rows['supplier_Email'] ?>"/>
	</td>
</tr>
<tr>
	<td>Password</td>
	<td>
		<input type="password" name="txtPassword" placeholder="XXXXXXXXXXXXXX"  value = "<?php echo $rows['supplier_Password'] ?>"readonly/>
	</td>
</tr>
<tr>
	<td>Staff Image</td>
	<td>
		<input type="file" name="filImage"  value = "<?php echo $rows['supplier_Image'] ?>"/>
	</td>
</tr>

<tr>
	<td>Address</td>
	<td>
		<textarea name="txtAddress" value = ""><?php echo $rows['supplier_Address'] ?></textarea>
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
<form id="test-form" class="white-popup-block mfp-hide" action="Supplier_Update.php" method="post" style="padding-top:12%;margin-top:10%;" enctype="multipart/form-data">
		<div class="popup_box">
			<div class="popup_inner">
				<div class="logo text-center">
					<div class="logo-img">
						<a href="displays.php">
							<h1 style="color:black;" class="hi"><i class="fas fa-cocktail" style="color:turquoise;"></i> November</h1>
						</a>
					</div>
				</div>
				<img src="<?php echo $rows['supplier_Image'] ?>" alt="" class="pp" style="border-radius:100%;width:23%;height:100px;margin-bottom:10%;border:3px solid grey;">



				<div class="row">

					<div class="form-row col-xl-12">
						<div class="form-group col-xl-6 col-md-6">
							<input type="email" placeholder="Enter email address" name="txtEmail" class="form-control" value="<?php echo $rows['supplier_Email']; ?>" required>
						</div>
						<div class="form-group col-xl-6 col-md-6">
							<input type="password" placeholder="Password" name="txtPassword" class="form-control" value="<?php echo $rows['supplier_Password']; ?>" required>
						</div>
					</div>
					<div class="form-row col-xl-12">
						<div class="form-group col-xl-6 col-md-6">
							<input type="text" class="form-control" placeholder="Name" name="txtStaffName" value="<?php echo $rows['supplier_Name']; ?>"required>
						</div>
						<div class="form-group col-xl-6 col-md-6">
							<input type="text" class="form-control" placeholder="Phone number" name="txtPhone" value="<?php echo $rows['supplier_Phone']; ?>"required>
						</div>
					</div>
					<div class="col-xl-12 col-md-12">
						<textarea name="txtAddress" id="" cols="30" rows="10" placeholder="Address" class="form-control" style="margin-bottom: 40px;"><?php echo $rows['supplier_Address']; ?></textarea>
					</div>
					
					<div class="col-xl-12" style="margin-bottom: 8%;">
						<div class="input-group">
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" name="filImage">
								<label class="custom-file-label" for="inputGroupFile04"><?php echo $rows['supplier_Image']; ?></label>
							</div>
						</div>
					</div>
					<div class="col-xl-12">
					<input type="hidden" name="txtStaffID" value="<?php echo $rows['supplier_Id'] ?>" readonly/>
						<input type="submit" value="Update" class="boxed_btn_green" name="btnUpdate" style="color:white">
					</div>
				</div>

			</div>
		</div>
	</form>
</body>
</html>