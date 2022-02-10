<!doctype html>
<?php
include('./database_connection.php');
session_start();

if(isset($_GET['logout'])){
	session_destroy();
    unset($_SESSION);
    session_regenerate_id(true);
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
        <title>My Account</title>
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
.scrollableDIV {
  height:400px;
  overflow-y: scroll;
  margin:0px;
}

/* Vertical Tabs */
 .vertical-tabs{
    font-size:15px;
    padding:10px;
    color:#000
}
 .vertical-tabs .nav-tabs .nav-link{
    border-radius: 0;
    background:#e9f0ec;
    text-align:center;
    font-size: 16px;
    color:#000000;
    height:40px;
    width: 200px;
}
 .vertical-tabs .nav-tabs .nav-link.active{
    background-color:#d4cfcf!important;
    color:#000000;
}
 .vertical-tabs .tab-content>.active{
    background:#000000;
    display:block;
}
 .vertical-tabs .nav.nav-tabs{
    border-bottom:0;
    border-right:3px solid #000;
    display:block;
    float:left;
    margin-right:20px;
    padding-right:15px;
}
 .vertical-tabs .sv-tab-panel{
    background:#fff;
    height:274px;
    padding-top:10px;
}
@media only screen and (max-width: 420px){
  .titulo{font-size: 22px}
}
@media only screen and (max-width: 325px){
  .vertical-tabs{ padding:8px;}
}








    .panel-order .row {
	border-bottom: 1px solid #ccc;
}
.panel-order .row:last-child {
	border: 0px;
}
.panel-order .row .col-md-1  {
	text-align: center;
	padding-top: 15px;
}
.panel-order .row .col-md-1 img {
	width: 50px;
	max-height: 50px;
}
.panel-order .row .row {
	border-bottom: 0;
}
.panel-order .row .col-md-11 {
	border-left: 1px solid #ccc;
}
.panel-order .row .row .col-md-12 {
	padding-top: 7px;
	padding-bottom: 7px; 
}
.panel-order .row .row .col-md-12:last-child {
	font-size: 11px; 
	color: #555;  
	background: #efefef;
}
.panel-order .btn-group {
	margin: 0px;
	padding: 0px;
}
.panel-order .panel-body {
	padding-top: 0px;
	padding-bottom: 0px;
}
.panel-order .panel-deading {
	margin-bottom: 0;
}    



 hr { 
  margin: .3em;
  border-width: 2px;
} 


.customBadge{
	padding:5px 15px 5px 15px;
	font-size:15px;
}
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

        
  <div class="container-fluid" style="margin:3% 10% 10% 10%">
    <div class="vertical-tabs">
      <ul class="nav nav-tabs" role="tablist">
		<li class="nav-item">
          <a class="nav-link" style="background:#000000;color:#ffffff;">My Account</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo (!(isset($_GET['Settings'])||isset($_GET['History'])) ? "active" : "")?>" data-toggle="tab" href="#pag1" role="tab" aria-controls="home">User Cart</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo (isset($_GET['History']) ? "active" : "")?>" data-toggle="tab" href="#pag2" role="tab" aria-controls="profile">Account History</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo (isset($_GET['Settings']) ? "active" : "")?>" data-toggle="tab" href="#pag3" role="tab" aria-controls="messages">Options</a>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane <?php echo (!(isset($_GET['Settings'])||isset($_GET['History'])) ? "active" : "")?>" id="pag1" role="tabpanel">
          <div class="sv-tab-panel">
            <div class="container scrollableDIV">
				<table id="cart" class="table table-hover table-condensed">
				</table>
			</div>
          </div>
        </div>
        <div class="tab-pane <?php echo (isset($_GET['History']) ? "active" : "")?>" id="pag2" role="tabpanel">
          <div class="sv-tab-panel">
            <div class="panel panel-default panel-order">

			<div class="container scrollableDIV">
				
					<span id="accountHistorytb" class="row">
					  
					</span>
			</div>
			</div>
			
          </div>
        </div>
        <div class="tab-pane <?php echo (isset($_GET['Settings']) ? "active" : "")?>" id="pag3" role="tabpanel">
          <div class="sv-tab-panel">
		  
		  
		  <div class="container">
				<p>Please be Advised, to Change Settings Respectively.</p>
			  
			  <table class="table table-striped">
				
				<tbody>
				  <tr>
					<td>Change Email</td>
					<td><form id="cemail" style="display: none;" action="accountSet.php" method="POST">
					
					
					
					<div class="row">
						<div class="col-sm-2" style="text-align:right;">
						</div>
						<div class="col-sm">
						<input type="email" id="email" name="email" required=""><br>
						<input type="button" onclick="changeSettings('email','1')" name="emailc" value="Change">
						</div>
					</div></form>
					
					
					</td>
					<td class="text-right" style="padding-right:50px;"><a id="edit1"  href="#" onclick="showStuff('cemail',  this.id); return false;">Edit</a></td>
				  </tr>
				  <tr>
					<td>Change Username</td>
					<td><form id="cuser" style="display: none;" action="accountSet.php" method="POST">
					<div class="row">
						<div class="col-sm-3" style="text-align:right;">
						</div>
						<div class="col-sm">
						<input type="text" id="username" name="username" value="" required=""><br>
						<input type="button" onclick="changeSettings('username','2')" name="userc" value="Change">
						</div>
					</div></form>
					</td>
					<td class="text-right" style="width:10%;padding-right:50px;"><a  href="#" id="edit2" onclick="showStuff('cuser',  this.id); return false;">Edit</a></td>
				  </tr>
				  <tr>
					<td>Change Password</td>
					<td>
					
					<form id="cpass" style="display: none;" action="accountSet.php" method="POST">
			<div>
			<div class="row">
				<div class="col-sm-5" style="text-align:right;">
				  Password:<br>Re-Type Password:
				</div>
				<div class="col-sm">
				  <input type="text" id="pass1" name="pass1" min="8" required="">
				  <br><input type="text" id="pass2" name="pass2" min="8" required=""><br>
				  <input type="button" onclick="changeSettings('pass1','3')" id="passc" name="passc" value="Change" disabled="">
				</div>
			  </div>
					

				</div></form></td>
					<td class="text-right" style="width:10%;padding-right:50px;"><a href="#" id="edit3" onclick="showStuff('cpass',  this.id); return false;">Edit</a></td>
				  </tr>
				  <tr>
					<td></td>
					<td></td>
					<td></td>
				  </tr>
				</tbody>
			  </table>
		  
		</div>
		  	 <script>


		function showStuff(id, editT) {
			document.getElementById("cpass").style.display = "none";
			document.getElementById("cuser").style.display = "none";
			document.getElementById("cemail").style.display = "none";
			document.getElementById("edit1").style.display = "block";
			document.getElementById("edit2").style.display = "block";
			document.getElementById("edit3").style.display = "block";
			document.getElementById(id).style.display = "block";
			document.getElementById(editT).style.display = "none";
		}
		
		function changeSettings(toChange,type){
			var textC = document.getElementById(toChange).value;
			$.ajax({
				url:'functions.php',
				data: {func:'14',toChange:textC,type:type},
				type:'POST',
				success:function(data){
					refresh();
					alert(data);
					document.getElementById(toChange).value = "";
				}
			});
		}
	</script>
          </div>
        </div>
        

      </div>
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
					
					function setCancelTransac(tID,tType){
						$.ajax({
							url:'functions.php',
							data: {func:'13',tID:tID,tType:tType},
							type:'POST',
							success:function(data){
								refresh();
							}
						});
					}
					
					function getProductInCart(){
						$.ajax({
							url:'functions.php',
							data: {func:'3'},
							type:'POST',
							success:function(data){
								document.getElementById("cart").innerHTML = data;
							}
						});
					}
					
					function setProductQuantity(oID,pNum){
						$.ajax({
							url:'functions.php',
							data: {func:'4',oID:oID,pNum:pNum},
							type:'POST',
							success:function(data){
							}
						});
					}
					
					function deleteProductOnCart(oID){
						$.ajax({
							url:'functions.php',
							data: {func:'5',oID:oID},
							type:'POST',
							success:function(data){
								refresh();
							}
						});
					}
					
					function proccessTransactionOnCart(){
						$.ajax({
							url:'functions.php',
							data: {func:'6'},
							type:'POST',
							success:function(data){
								refresh();
							}
						});
					}
					
					function myAccountHistoryTBL(){
						$.ajax({
							url:'functions.php',
							data: {func:'7'},
							type:'POST',
							success:function(data){
								document.getElementById("accountHistorytb").innerHTML = data;
							}
						});
					}
					
					function refresh(){
						myAccountHistoryTBL();
						getMobileNavChange();
						getNavChange();
						getProductInCart();
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