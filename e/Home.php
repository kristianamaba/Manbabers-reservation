<!doctype html>
<?php
include('./database_connection.php');
session_start();

if(isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION);
    session_regenerate_id(true);
}

date_default_timezone_set("Asia/Manila");
//$dateTime = date("Y-m-d H:i:s");
$sdate = date('Y-m-d', strtotime('+ 1 days'));
$edate = date('Y-m-d', strtotime('+ 1 years'));

function getAllSlideDetails(){ include('./database_connection.php');
	$query = "SELECT * FROM slidestb";
	$result = mysqli_query($dbCon, $query);
	$data = array();
	$i = 0;
	while($row = mysqli_fetch_array($result)){
		$data[$i][0] = $row['slide_id'];
		$data[$i][1] = $row['ph_loc'];
		$data[$i][2] = $row['slides_sup'];
		$data[$i][3] = $row['slides_sub'];
		$i++;
	}
	return $data;
}

function getSlideCode(){ include('./database_connection.php');
	$tempS = "";
	$slideList = getAllSlideDetails();
	for($i = 0; $i < count($slideList); $i++){
		$tempS .= "<div class=\"single-slider  hero-overly slider-height d-flex align-items-center\" data-background=\"uploads/".$slideList[$i][1]."\" >
                    <div class=\"container\">
                        <div class=\"row justify-content-center text-center\">
                            <div class=\"col-xl-9\">
                                <div class=\"h1-slider-caption\">
                                    <h1 data-animation=\"fadeInUp\" data-delay=\".4s\">".$slideList[$i][2]."</h1>
									".(empty($slideList[$i][3]) ? "":"<h3 data-animation=\"fadeInDown\" data-delay=\".4s\">".$slideList[$i][3]."</h3>")."
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>";
	}
	
	return $tempS;
}
?>
<html class="no-js" lang="zxx">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Home</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="manifest" href="site.webmanifest">
		<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

		<!-- CSS here -->
            <link rel="stylesheet" href="assets/css/bootstrap.min.css">
            <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
            <link rel="stylesheet" href="assets/css/gijgo.css">
            <link rel="stylesheet" href="assets/css/slicknav.css">
            <link rel="stylesheet" href="assets/css/animate.min.css">
            <link rel="stylesheet" href="assets/css/magnific-popup.css">
            <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
            <link rel="stylesheet" href="assets/css/themify-icons.css">
            <link rel="stylesheet" href="assets/css/slick.css">
            <link rel="stylesheet" href="assets/css/nice-select.css">
            <link rel="stylesheet" href="assets/css/style.css">
            <link rel="stylesheet" href="assets/css/responsive.css">
			<style>
				inputREM:focus {
					outline: none;
				}

				.greyC{
				  color: gray;
				}

				.input-group{
					

				  border: 1px gray solid;
				  padding: 15px 0px 15px 10px;
				  max-height:60px;
				  min-width:150px;
				  max-width:260px;
				}
				
				
			</style>
   </head>

   <body onload="refresh();">
       
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <strong>Man Barbers</b>
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->

    <header>
        <!-- Header Start -->
       <div class="header-area header-sticky">
            <div class="main-header ">
                <div class="container">
                    <div class="row align-items-center">
                        <!-- logo -->
                        <div class="col-xl-2 col-lg-2">
                            <div class="logo">
                               <a href="index.php"><img width="50px" class="rounded-circle" src="assets/img/logo/logo.jpg" alt=""></a>
                            </div>
                        </div>
                    <div class="col-xl-8 col-lg-8">
                            <!-- main-menu -->
                            <div class="main-menu f-right d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                    </ul>
                                </nav>
                            </div>
                        </div>             
                        <div class="col-xl-2 col-lg-2">
                            <!-- header-btn -->
                            <div class="header-btn">
                                <a href="#" onclick="ReserveButton();" class="btn btn1 d-none d-lg-block ">Reserve Online</a>
                            </div>
                        </div>
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div id="mobileNav" class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
       </div>
        <!-- Header End -->
    </header>
    <main>

        <!-- slider Area Start-->
        <div class="slider-area ">
            <!-- Mobile Menu -->
            <div class="slider-active dot-style">
				<?php
				echo getSlideCode();
				?>
				
            </div>
        </div>
        <!-- slider Area End-->


        <!-- Reservation Room Start-->
        <div class="booking-area">
            <div class="container">
               <div class="row ">
               <div class="col-12">
                <form action="">
                <div class="booking-wrap d-flex justify-content-between align-items-center">
					<div class="single-select-box mb-30">
                        <div class="boking-tittle">
                            <span>Barber</span>
                        </div>
                        <div class="select-this">
                            <form action="#">
                                <div class="select-itms">
                                    <select name="select" id="selectBType">
                                        <option value="0">Random</option>
                                        <option value="1">Custom</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                   </div>
                    <!-- select in date -->
                    <div class="single-select-box mb-30">
                        <!-- select out date -->
                        <div class="boking-tittle">
                            <span> Check In Date:</span>
                        </div>
                        <div class="boking-datepicker">
						
							<div class="input-group rounded" style=" background-color: transparent;border-color: #ffc569;">
								<i class="gj-icon greyC" role="right-icon">event</i> &nbsp
								<input  class="greyC" id="selectBDate" style="border:none;background-color: transparent; " type="date" value="<?php echo $sdate;?>" min="<?php echo $sdate;?>" max="<?php echo $edate;?>">
							</div>
                            
                        </div>
                   </div>
                    <!-- Single Select Box -->
                    <div class="single-select-box mb-30">
                        <div class="boking-tittle">
                            <span>Hour of the day:</span>
                        </div>
                        <div class="select-this">
                            <form action="#">
                                <div class="select-itms">
                                    <select name="select" id="selectBTime">
                                        <option value="9">9 am</option>
                                        <option value="10">10 am</option>
                                        <option value="11">11 am</option>
                                        <option value="12">12 pm</option>
										<option value="13">1 pm</option>
                                        <option value="14">2 pm</option>
                                        <option value="15">3 pm</option>
                                        <option value="16">4 pm</option>
										<option value="17">5 pm</option>
                                        <option value="18">6 pm</option>
                                        <option value="19">7 pm</option>
                                        <option value="20">8 pm</option>
										<option value="21">9 pm</option>
                                        <option value="22">10 pm</option>
                                        <option value="23">11 pm</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                   </div>
                    <!-- Single Select Box -->
                    <div class="single-select-box pt-45 mb-30">
                        <a onClick="reserveSave();" class="btn select-btn" style="color:white;">Reserve Now</a>
                   </div>
               

                </div>
            </form>
               </div>
               </div>
            </div>
        </div>
        <!-- Reservation Room End-->
		
        <!-- Make customer Start-->
        <section class="make-customer-area customar-padding fix">
            <div class="container-fluid p-0">
                <div class="row">
                   <div class="col-xl-5 col-lg-6">
                        <div class="customer-img mb-120">
                            <img src="assets/img/customer/customer.jpg" class="customar-img1" alt="">
                            <img src="assets/img/customer/customar2.png" class="customar-img2" alt="">
                            <div class="service-experience heartbeat">
                                <h3>25 Years of Service<br>Experience</h3>
                            </div>
                        </div>
                   </div>
                    <div class=" col-xl-4 col-lg-4">
                        <div class="customer-caption">
                            <span>About our company</span>
                            <h2>Man Barbers Greatness</h2>
                            <div class="caption-details">
                                <p>Experience having precise cuts with our skillful barbers and feel the manly ambiance here at #ManBarbers! #WhereGentlemenBelong</p>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Make customer End-->

        <!-- Product Start -->
		<a name="Products">
       <div class="blog-area blog-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <!-- Seciton Tittle  -->
                        <div class="font-back-tittle mb-50">
                            <div class="archivment-front">
                                <h3>Our Products</h3>
                            </div>
                            <h3 class="archivment-back">Our Products</h3>
                        </div>
                    </div>
                </div>
                <div class="row" id="productList">
                    
					
					
					
					
                </div>
            </div>
       </div>
	   
	   </a>
        <!-- Product End -->
		
		<!--  MODAL -->
		  <div class="modal fade" id="modalDialog">
			<div class="modal-dialog modal-xl modal-dialog-centered">
			  <div id="modalContent" class="modal-content">
			  
				
				
			  </div>
			</div>
		  </div>
		
		<script>
		

					function reserveSave(){
						
						var sBDate = document.getElementById("selectBDate").value;
						var sBTime = document.getElementById("selectBTime").value;
						var sBType = document.getElementById("selectBType").value;
						
					
						if(sBDate!=""&&sBTime!=""&&sBType!=""){
							$.ajax({
								url:'functionsNav.php',
								data: {func:'4'},
								type:'POST',
								success:function(data){
									if(data=="1"){
										var fd = new FormData();
										fd.append('sBDate',sBDate);
										fd.append('sBTime',sBTime);
										fd.append('sBType',sBType);
										fd.append('func',"8");
										$.ajax({
										url:'functions.php',
										data: fd,
										type:'POST',
										contentType: false,
										processData: false,
										success:function(data){
											if(data!=""){
												alert("Something Went Wrong Please Refresh!");
											}
											else{
												location.href='Reservation';return false;
											}
										}
										});
									}
									else if(data=="0"){
										location.href='login/';return false;
									}
								}
							});
							
						}
						else
							alert('One or Two fields are empty. Please fill up all fields');	
					}
					
					function addProductUser(pID){
						$.ajax({
							url:'functionsNav.php',
							data: {func:'4'},
							type:'POST',
							success:function(data){
								if(data=="1"){
									$.ajax({
										url:'functions.php',
										data: {func:'2',pID:pID},
										type:'POST',
										success:function(data){
											if(data!="")
												alert(data);
											else
												alert("Successfully Added Product to Cart!");
											
											refresh();
										}
									});
								}
								else if(data=="0"){
									location.href='login/';return false;
								}
							}
						});
						
						
					}
					
					function getProductList(){
						$.ajax({
							url:'functions.php',
							data: {func:'1'},
							type:'POST',
							success:function(data){
								document.getElementById("productList").innerHTML = data;
							}
						});
					}
					
					
					<!-- Nav Bar Scripts START -->
					
					function viewInboxMessage(iID){
						$.ajax({
							url:'functionsNav.php',
							data: {func:'2',iID:iID},
							type:'POST',
							success:function(data){
								document.getElementById("modalContent").innerHTML = data;
								refresh();
							}
						});
					}
					
					function hideUnhide() {
					  var x = document.getElementById("mobileNavHide");
					  if (x.style.display === "none") {
						x.style.display = "block";
					  } else {
						x.style.display = "none";
					  }
					}
					
					function getNavChange(){
							$.ajax({
								
							url:'functionsNav.php',
							data: {func:'1'},
							type:'POST',
							success:function(data){
								document.getElementById("navigation").innerHTML = data;
							}
						});
					}
					function getMobileNavChange(){
						$.ajax({
							url:'functionsNav.php',
							data: {func:'3'},
							type:'POST',
							success:function(data){
								document.getElementById("mobileNav").innerHTML = data;
							}
						});
					}
					
					function ReserveButton(){
						$.ajax({
							url:'functionsNav.php',
							data: {func:'4'},
							type:'POST',
							success:function(data){
								if(data=="1"){
									location.href='Reservation';return false;
								}
								else if(data=="0"){
									location.href='login/';return false;
								}
							}
						});
					}
					
					<!-- Nav Bar Scripts END -->
					
					function refresh(){
						getMobileNavChange();
						getProductList();
						getNavChange();
					}
					
   </script>

        <!-- Gallery img Start-->
        <div class="gallery-area fix">
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-md-12">
                        <div class="gallery-active owl-carousel">
                            <div class="gallery-img">
                                <a href="#"><img src="uploads/gal1.jpg" alt=""></a>
                            </div>
                            <div class="gallery-img">
                                <a href="#"><img src="uploads/gal2.jpg" alt=""></a>
                            </div>
                            <div class="gallery-img">
                                <a href="#"><img src="uploads/gal3.jpg" alt=""></a>
                            </div>
							<div class="gallery-img">
                                <a href="#"><img src="uploads/gal4.jpg" alt=""></a>
                            </div>
							<div class="gallery-img">
                                <a href="#"><img src="uploads/gal5.jpg" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Gallery img End-->
    </main>
   <footer>
       <!-- Footer Start-->
	   <a name="Contacts">
       <div class="footer-area black-bg footer-padding">
           <div class="container">
               <div class="row d-flex justify-content-between">
                   <div class="col-xl-3">
                      <div class="single-footer-caption mb-30">
                         <!-- logo -->
                         <div class="footer-logo">
                           <a href="index.php"><img width="200px" class="rounded-circle" src="assets/img/logo/logo.jpg" alt=""></a>
                         </div>
                      </div>
                   </div>
                   <div class="col-xl-3">
                       <div class="single-footer-caption mb-30">
                           <div class="footer-tittle">
                               <h4>Reservations</h4>
                               <ul>
                                   <li><a href="#">Tel: (0945) 728 1541 / (02) 567 1696</a></li>
                                   <li><a href="#">Facebook: @ManBarbersPH</a></li>
                                   <li><a href="#">manpomadeofficial@gmail.com</a></li>
                               </ul>
                           </div>
                       </div>
                   </div>
                   <div class="col-xl-3">
                       <div class="single-footer-caption mb-30">
                           <div class="footer-tittle">
                               <h4>Our Location</h4>
                               <ul>
                                   <li><a href="#">Unit 3, Ground floor, Burgundy Transpacific Taft Ave. Manila</a></li>
                               </ul>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
	   </a>
       <!-- Footer End-->
   </footer>
   
   
	<!-- JS here -->
	
		<!-- All JS Custom Plugins Link Here here -->
        <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
		
		<!-- Jquery, Popper, Bootstrap -->
		<script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
        <script src="./assets/js/popper.min.js"></script>
        <script src="./assets/js/bootstrap.min.js"></script>
	    <!-- Jquery Mobile Menu -->
        <script src="./assets/js/jquery.slicknav.min.js"></script>

		<!-- Jquery Slick , Owl-Carousel Plugins -->
        <script src="./assets/js/owl.carousel.min.js"></script>
        <script src="./assets/js/slick.min.js"></script>
        <!-- Date Picker -->
        <script src="./assets/js/gijgo.min.js"></script>
		<!-- One Page, Animated-HeadLin -->
        <script src="./assets/js/wow.min.js"></script>
		<script src="./assets/js/animated.headline.js"></script>
        <script src="./assets/js/jquery.magnific-popup.js"></script>

		<!-- Scrollup, nice-select, sticky -->
        <script src="./assets/js/jquery.scrollUp.min.js"></script>
        <script src="./assets/js/jquery.nice-select.min.js"></script>
		<script src="./assets/js/jquery.sticky.js"></script>
        
        <!-- contact js -->
        <script src="./assets/js/contact.js"></script>
        <script src="./assets/js/jquery.form.js"></script>
        <script src="./assets/js/jquery.validate.min.js"></script>
        <script src="./assets/js/mail-script.js"></script>
        <script src="./assets/js/jquery.ajaxchimp.min.js"></script>
        
		<!-- Jquery Plugins, main Jquery -->	
        <script src="./assets/js/plugins.js"></script>
        <script src="./assets/js/main.js"></script>
        
    </body>
</html>