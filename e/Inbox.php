<!doctype html>
<?php
include('./database_connection.php');
session_start();



if(isset($_GET['logout'])){
	session_unset();
	session_destroy();
}

if(!isset($_SESSION['userNameECOM'])&&!isset($_SESSION['userIDECOM'])&&!isset($_SESSION['userRankECOM']))
header("Location: ./");
?>
<html class="no-js" lang="zxx">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Reservation</title>
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

			</style>
			
   </head>

   <body onload="refresh();">
   <script>
   

   </script>
       
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

        
   <div class="container container-fluid border" style="margin-top: 100px;margin-bottom: 100px;">
		<div class="box-body no-padding">
                  <div class="table-responsive mailbox-messages">
                    <table class="table table-hover">
					   <thead>
							<tr>
							  <td></td>
							  <th>Sender</th>
							  <th>Message</th>
							  <th></th>
							  <th>Date</th>
							</tr>
					  </thead>
                      <tbody id="inboxContent">
                        
						
						
                        
                      </tbody>
                    </table><!-- /.table -->
                  </div><!-- /.mail-box-messages -->
                </div><!-- /.box-body -->

            </div><!-- /.col -->
          </div><!-- /.row -->
	</div>
</div>

    </main>
   <footer>
       <!-- Footer Start-->
	   <a name="Footer">
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
                                   <li><a >Tel: (0945) 728 1541 / (02) 567 1696</a></li>
                                   <li><a >Facebook: @ManBarbersPH</a></li>
                                   <li><a >manpomadeofficial@gmail.com</a></li>
                               </ul>
                           </div>
                       </div>
                   </div>
                   <div class="col-xl-3">
                       <div class="single-footer-caption mb-30">
                           <div class="footer-tittle">
                               <h4>Our Location</h4>
                               <ul>
                                   <li><a >Unit 3, Ground floor, Burgundy Transpacific Taft Ave. Manila</a></li>
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
   <!--  MODAL -->
		  <div class="modal fade" id="modalDialog">
			<div class="modal-dialog modal-xl modal-dialog-centered">
			  <div id="modalContent" class="modal-content">
			  
				
				
			  </div>
			</div>
		  </div>
   <script>	
   
					function getInbox(){
						$.ajax({
							url:'functionsNav.php',
							data: {func:'5'},
							type:'POST',
							success:function(data){
								document.getElementById("inboxContent").innerHTML = data;
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
						getNavChange();
						getInbox();
					}
					
   </script>
   
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