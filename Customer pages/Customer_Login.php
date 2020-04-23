
<?php
include('../Template/Theader.php');
if (isset($_POST['btnLogin'])) {
    $txtEmail = $_POST['txtEmail'];
    $txtPassword = $_POST['txtPassword'];


    $CheckEmail = "SELECT * FROM customer WHERE customer_Email='$txtEmail'";
    $ret = mysqli_query($connection, $CheckEmail);
    $count = mysqli_num_rows($ret);

    if ($count < 1) {
        echo "<script>window.alert('Your email is wrong!')</script>";
        echo "<script>window.location='Customer_Login.php'</script>";
    } else {
        $CheckPass = "SELECT * FROM customer WHERE customer_Password='$txtPassword'";
        $rets = mysqli_query($connection, $CheckPass);
        $rows = mysqli_fetch_array($rets);
        $counts = mysqli_num_rows($rets);

        if ($counts < 1) {
            echo "<script>window.alert('You typed wrong password!')</script>";
            echo "<script>window.location='Customer_Login.php'</script>";
        } else {
          $rows = mysqli_fetch_array($ret);
            $_SESSION['CustomerID'] = $rows['customer_Id'];
            $_SESSION['CustomerName'] = $rows['customer_Name'];
            $_SESSION['CustomerImage'] = $rows['customer_Image'];
            echo "<script>window.alert('Congratulation! Your login succeeded')</script>";
            echo "<script>window.location='../Order pages/menu.php'</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Customer Login</title>
    <link rel="stylesheet" href="../entry.css">
</head>

<body>

    <div class="container">
        <form id="test-form" class="white-popup-block mfp-hide" action="Customer_Login.php" method="post" style="">
            <div class="popup_box ">
                <div class="popup_inner">
                    <div class="logo text-center">
                        <div class="logo-img">
                            <a href="displays.php">
                                <h1 style="color:black;" class="hi"><i class="fas fa-cocktail" style="color:turquoise;"></i> November</h1>
                            </a>
                        </div>
                    </div>
                    <h3 style="text-align:center;">Customer Log in</h3>
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

                    <p class="doen_have_acc">Don’t have an account? <a class="dont-hav-acc" href="Customer_Registration.php">Sign Up</a>
                    </p>
                    <p class="doen_have_acc">If you are our supplier, <a class="dont-hav-acc" href="../Supplier pages/Supplier_Login.php">Login here</a>
                    </p>
                </div>
            </div>
        </form>


        </form>
    </div>
</body>

</html>
