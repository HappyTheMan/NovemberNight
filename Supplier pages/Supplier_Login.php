<?php
include('../Template/Theader.php');
include('../connect.php');

if(isset($_POST['btnLogin']))
{
	$txtEmail=$_POST['txtEmail'];
	$txtPassword=$_POST['txtPassword'];


	$CheckEmail="SELECT * FROM supplier WHERE supplier_Email='$txtEmail'";
	$ret=mysqli_query($connection,$CheckEmail);
	$count=mysqli_num_rows($ret);

	if($count < 1)
	{
        echo "<script>window.alert('Your email is wrong!')</script>";
        echo "<script>window.location='Supplier_Login.php'</script>";
	}
	else
	{
        $CheckPass = "SELECT * FROM supplier WHERE supplier_Password='$txtPassword'";
        $rets=mysqli_query($connection,$CheckPass);
	    $counts=mysqli_num_rows($rets);

	        if($counts < 1)
	        {
                echo "<script>window.alert('You typed wrong password!')</script>";
                echo "<script>window.location='Supplier_Login.php'</script>";
            }
            else
            {
							$data = mysqli_fetch_array($rets);
							$_SESSION['SupplierID'] = $data['supplier_Id'];
							$_SESSION['SupplierName'] = $data['supplier_Name'];
	            $_SESSION['SupplierImage'] = $data['supplier_Image'];
                echo "<script>window.alert('Congratulation! Your login succeeded')</script>";
		        echo "<script>window.location='../Home page/homie.php'</script>";
            }
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Staff Login</title>
	<link rel="stylesheet" href="../entry.css">
</head>
<body>

<!-- <form action="Supplier_Login.php" method="post" enctype="multipart/form-data" class = "form">

<fieldset>
<legend>Staff Login</legend>

<table>

<tr>
	<td>Your Email</td>
	<td>
		<input type="email" name="txtEmail" placeholder="example@email.com" required />
	</td>
</tr>
<tr>
	<td>Your Password</td>
	<td>
		<input type="password" name="txtPassword" placeholder="XXXXXXXXXXXXXX" required />
	</td>
</tr>


<tr>
	<td></td>
	<td>
		<input type="submit" name="btnLog" class = "btn" value="Login" />
		<input type="reset" name="btnClear" class =  "btn"value="Clear" />
	</td>
</tr>
</table>
</fieldset>

</form> -->
<form id="test-form" class="white-popup-block mfp-hide" action="Supplier_Login.php" method="post" style="padding-top:12%;">
            <div class="popup_box ">
                <div class="popup_inner">
                    <div class="logo text-center">
                        <div class="logo-img">
                            <a href="displays.php">
                                <h1 style="color:black;" class="hi"><i class="fas fa-cocktail" style="color:turquoise;"></i> November</h1>
                            </a>
                        </div>
                    </div>
                    <h3 style="text-align:center;">Supplier Log in</h3>




                    <div class="row">
                        <div class="col-xl-12 col-md-12">
                            <input type="email" placeholder="Enter email address" name="txtEmail" required>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <input type="password" placeholder="Password" name="txtPassword" required>
                        </div>
                        <div class="col-xl-12">
                            <input type="submit" value="Log In" class="boxed_btn_green" name="btnLogin" style="color:white">
                        </div>
                    </div>

                    <p class="doen_have_acc">Don’t have an account? <a class="dont-hav-acc" href="Supplier_Registration.php">Sign Up</a>
                    </p>
                </div>
            </div>
        </form>
</body>
</html>
