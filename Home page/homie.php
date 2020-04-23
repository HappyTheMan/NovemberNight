
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Home</title>
    <?php include('../Template/Theader.php'); ?>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="600" >
    <!-- <link rel="manifest" href="site.webmanifest"> -->

    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->

    <style>
        .a:hover{
            background:transparent;
            color:white;
            transition:0.3s;
        }
        .a{
            font-size:30px;
        }
        .testi{
            width:100px;
            height:100px;
            border:1px solid white;
            border-radius:100%;
        }
        .fa-star, .fa-star-half-alt{
            color:gold;
        }
        .overlay14 {
  position: relative;
  z-index: 0;
}

/* line 161, C:/Users/SPN Graphics/Desktop/cl sep/HTML/scss/_reset.scss */
.overlay14::before {
  position: absolute;
  content: "";
  background-color: #23272A;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: -1;
  opacity: 0.4;
}
    </style>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>


     <!-- slider_area_start -->
     <div class="slider_area">
        <div class="single_slider d-flex align-items-center justify-content-center slider_bg_1 overlay2">

            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-9">
                        <div class="slider_text text-center">
                            <p>Best cofffee and tea in the Country</p>
                            <h3>Get your customized drink! <br> enjoy the starry night of November!</h3>
                            <?php if(!isset($_SESSION['customer_Id'])){
                            echo "
                                    <a href='../Customer pages/Customer_Registration.php'>

                                    <button class='btn btn-dark btn-lg btn-block pop'>New Customer? <br> Sign up here!</button>
                                    </a>";}
                            else{
                                echo "
                                <a href='shop.php'>

                                    <button  class = 'btn btn-success btn-lg btn-block a' > <i class='fas fa-shopping-cart'></i> Shop now!</button>
                                </a>";
                            }
                            ?>
                            <br>
                            <a href='../Staff pages/Staff_Login.php'>
                                <button  class = 'btn btn-info btn-lg btn-block a' > If you are November staff, <br> Login here!</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--slider_area_end -->

     <!-- about_gallery_wrap_start -->
     <div class="about_gallery_wrap">
        <div class="container">
                <div class="row align-items-center mb-80">
                        <div class="col-xl-6">
                            <div class="service_wrap">
                                <div class="thumb-1">
                                    <img src="../images/starry.jpg" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="about_wrap_text_1">
                                <h3>
                                    Don't spend your night alone
                                </h3>
                                <p>Cold drinks have become popular recently. For example, bubble tea, coffee, juice, soda, wine, cocktails, alcohol. Cold beverage stores such as coffee shops, beverage stores and bars are finally open in cities around the world. In November, there is a menu of drinks and desserts available.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-xl-6">
                            <div class="about_wrap_text_1">
                                <h3>
                                    November drinks never let you feel alone
                                </h3>
                                <p>"November" was inaugurated in November 2001. From the beginning, it sold only desserts, coffee, tea and juice. The coffee barista was well trained by the 5-star hotel barista. Since 2015, a new building has been built next to a shopping center. There is a sweet atmosphere without alcoholism on the ground floor, and from the first floor there is a rooftop bar that opens only at night and serves alcoholic beverages, chips, salads and drinks. The bar has a relaxing atmosphere under the stars. Recently, drinks for "November" can be purchased at some shopping centers. They sold bubble tea, coffee, juice and soda without food or alcohol.</p>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="service_wrap">
                                <div class="thumb-1">
                                    <img src="../images/star1.webp" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
    </div>
    <!-- about_gallery_wrap_end -->

    <div class="about_boxes" style = "padding-bottom : 15%;">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-md-4">
                    <div class="single_box">
                        <h3>540</h3>
                        <p>Drinks sold in a month</p>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="single_box">
                        <h3>1418</h3>
                        <p>Customers in just a country</p>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="single_box">
                        <h3>5117</h3>
                        <p>Orders sent all time</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <!-- dedicated_support_start -->

     <div class="dedicated_support support_bg overlay14">

        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-md-8">
                    <div class="support_info" style = "z-index:20;">
                        <h3>Explore the whole new world with November drinks</h3>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nobis, beatae doloremque voluptatum consequatur, aperiam cum magni tenetur, error veritatis fugiat quas sed in nostrum eos eveniet hic debitis facilis iusto!</p>
                        <div class="get_started">
                            <a class="boxed_btn_green" href="shop.php">
                                <span>Get one Now!</span>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- dedicated_support_end -->
        <!-- prising_area_start -->
        <div class="prising_area" id = "testimonial">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section_title text-center mb-100">
                        <h3>
                            Testimonials from satisfied customers
                        </h3>
                        <p>These customers are satisfied with our drinks. <br>

                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-md-6 col-lg-6">
                    <div class="single_prising">
                        <div class="prising_icon blue">
                            <img src="../images/JohnSmith.jpg" alt="" class = "testi">
                        </div>
                        <h3>John Smith</h3>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>

                        <p class="prising_text">These Drinks are so good that my friends also want to buy them.</p>
                        <p class="prise">Rating: <span>8 / 10</span></p>

                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-lg-6">
                    <div class="single_prising">
                        <div class="prising_icon lite_blue">
                        <img src="../images/user_1.jpg" alt="" class = "testi">
                        </div>
                        <h3>Helen Walker</h3>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <p class="prising_text">The drink from November with low price and high quality helps the college students like me to drink to study effeciently.</p>
                        <p class="prise">Rating: <span>10 /10</span></p>

                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-lg-6">
                    <div class="single_prising">
                        <div class="prising_icon pink">
                        <img src="../images/user_2.jpg" alt="" class = "testi">
                        </div>
                        <h3>Noob Master69</h3>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                        <p class="prising_text">I bought one for my son and he love it very much. Thank you!</p>
                        <p class="prise">Rating: <span>9 / 10</span></p>

                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-lg-6">
                    <div class="single_prising">
                        <div class="prising_icon yellow">
                        <img src="../images/_1486456.jpg" alt="" class = "testi">
                        </div>
                        <h3>Dark Lord</h3>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                        <p class="prising_text">I bought it for my crush who love to drink coffee and tea and tell that i love her . Fortunately she accepted me. THANK YOU November!</p>
                        <p class="prise">Rating: <span>9 / 10</span></p>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- prising_area_end -->
    <!-- Data center start -->
    <div class="data_center_area" style = "border-top:1px solid rgba(0,0,0,0.2);padding-bottom:10%;">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section_title text-center mb-100">
                        <h3>
                            Our Future
                        </h3>
                        <p>In future there will be many branches around the world <br>Providing the best drinks to customers.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="location" >
                        <div class="pulse_group" >

                            <span>
                                <div class="address_on_hover d-none d-lg-block "  >
                                    <div class="address_inner" >
                                        <i class="fa fa-map-marker" ></i>
                                        <h3>North America</h3>
                                        <p>November Branches At USA and Canada</p>
                                    </div>
                                </div>
                            </span>
                            <span>
                                <div class="address_on_hover d-none d-lg-block" >
                                    <div class="address_inner" >
                                        <i class="fa fa-map-marker"></i>
                                        <h3>London, The United Kingdom</h3>
                                        <p>November Branches At UK</p>
                                    </div>
                                </div>
                            </span>

                            <span>
                                <div class="address_on_hover d-none d-lg-block" >
                                    <div class="address_inner" >
                                        <i class="fa fa-map-marker"></i>

                                        <h3>Asia</h3>
                                        <p>November Branches At Sout East Asia</p>
                                    </div>
                                </div>
                            </span>
                            <span>
                                <div class="address_on_hover d-none d-lg-block" >
                                    <div class="address_inner" >
                                        <i class="fa fa-map-marker"></i>

                                        <h3>Sydney, Australia</h3>
                                        <p>November Branches At Australia</p>
                                    </div>
                                </div>
                            </span>
                        </div>
                        <img src="img/banner/map.svg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Data center start -->

    <!-- login form itself start-->

    <!-- login form itself end -->

    <!-- sign up form itself start-->

    <!-- sign up form itself end -->

    <?php include('../Template/Tfooter.php'); ?>
            <!-- JS here -->

</body>
</html>
