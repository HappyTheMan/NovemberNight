<?php include('../Template/Adminhead.php');?>
<?php

if (isset($_POST['btnLogin'])) {
    $txtEmail = $_POST['txtEmail'];
    $txtPassword = $_POST['txtPassword'];


    $CheckEmail = "SELECT * FROM staff WHERE staff_Email='$txtEmail'";
    $ret = mysqli_query($connection, $CheckEmail);
    $count = mysqli_num_rows($ret);

    if ($count < 1) {
        echo "<script>window.alert('Your email is wrong!')</script>";
        echo "<script>window.location='Staff_Login.php'</script>";
    } else {
        $CheckPass = "SELECT * FROM staff WHERE staff_Password='$txtPassword'";
        $rets = mysqli_query($connection, $CheckPass);
        $rows = mysqli_fetch_array($ret);
        $counts = mysqli_num_rows($rets);

        if ($counts < 1) {
            echo "<script>window.alert('You typed wrong password!')</script>";
            echo "<script>window.location='Staff_Login.php'</script>";
        } else {
            $id = $rows['staff_Id'];
            $_SESSION['StaffID'] = $rows['staff_Id'];
            $_SESSION['StaffName'] = $rows['staff_Name'];
            $_SESSION['StaffImage'] = $rows['staff_Image'];
            $branch ="SELECT * FROM staff s,branch b,staff_type st where s.branch_Id = b.branch_Id and s.staff_Id = '$id' and s.staff_TypeId = st.staff_TypeId";
            $res = mysqli_query($connection,$branch);
            $rowb = mysqli_fetch_array($res);
            $_SESSION['StaffBranch'] = $rowb['Branch'];
            $_SESSION['StaffType'] = $rowb['Type'];
            $Stype = $rowb['Type'];
            echo "<script>window.alert('Congratulation! Your login succeeded')</script>";

            if($Stype == 'Delivery')
            {
            echo "<script>window.location='../Delivery pages/Delivery_List.php'</script>";
            }
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

    <?php include('../AdminTemplate/head.php');?>
    <div class="container">
        <form id="test-form" class="white-popup-block mfp-hide" action="Staff_Login.php" method="post" style="margin-top:25%;margin-left:10%;">
            <div class="popup_box ">
                <div class="popup_inner">
                    <div class="logo text-center">
                        <div class="logo-img">
                            <a href="displays.php">
                                <h1 style="color:black;" class="hi"><i class="fas fa-cocktail" style="color:turquoise;"></i> November</h1>
                            </a>
                        </div>
                    </div>
                    <h3 style="text-align:center;">Staff Log in</h3>
                    <div class="row">
                        <div class="col-xl-12 col-md-12">
                            <input type="email" placeholder="Enter email address" name="txtEmail" class = "form-control" required>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <input type="password" placeholder="Password" name="txtPassword" class = "form-control"required>
                        </div>
                        <div class="col-xl-12">
                            <button type="submit" class="boxed_btn_green" name="btnLogin" style="color:white">Log-in <i class="fas fa-sign-in-alt"></i></button>
                        </div>
                    </div>

                    <p class="doen_have_acc">If you want to be our supplier? <a class="dont-hav-acc" href="../Supplier pages/Supplier_Registration.php">Register here!</a>
                    </p>
                </div>
            </div>
        </form>


        </form>
    </div>
</body>

</html>
