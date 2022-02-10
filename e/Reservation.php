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

date_default_timezone_set("Asia/Manila");
//$dateTime = date("Y-m-d H:i:s");
$sdate = date('Y-m-d', strtotime('+ 1 days'));
$edate = date('Y-m-d', strtotime('+ 1 years'));
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
			.customDrop{
				padding:15px 15px 15px 15px;
				max-height:60px;
				min-width:155px;
			}
				.greyC{
				  color: #f7bc5e;
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
                               <a href="Home"><img width="50px" class="rounded-circle" src="assets/img/logo/logo.jpg" alt=""></a>
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

		<!-- Room Start -->
        <section class="room-area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <!--font-back-tittle  -->
                        <div class="font-back-tittle mb-45">
                            <div class="archivment-front">
                                <h3>Our Barbers</h3>
                            </div>
                            <h3 class="archivment-back">Our Barbers</h3>
                        </div>
                    </div>
                </div>
                <div class="row" id="barbersLIST">
				
                </div>
            </div>

        </section>
        <!-- Room End -->
		
		

        <!-- Booking Room Start-->
            <div class="container fixed-bottom bg-light rounded" style="padding:10px 50px 0px 50px;">
               <div class="row ">
               <div class="col-12">
                <form action="">
                <div class="booking-wrap d-flex justify-content-between align-items-center">
					<div class="single-select-box mb-30">
                        <div class="boking-tittle">
                            <span>Barber:</span>
                        </div>
						
							<!-- Default barber pick button -->
							<div class="btn-group dropup">
							  <button id="barbTSelect" type="button" style="background-color: transparent;border-width: thin;" class="btn-outline-warning dropdown-toggle rounded customDrop " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<?php
								if(isset($_SESSION['sBType']))
									echo ($_SESSION['sBType']=="0" ? "Random":"Custom");
								else
									echo "Random";
								?>
							  </button>
							  <div class="dropdown-menu ">
								<a class="dropdown-item" href="#" onClick="selectBarbTForm('0','Random')">Random</a>
								<a class="dropdown-item" href="#" onClick="selectBarbTForm('1','Custom')">Custom</a>
							  </div>
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
								<input onchange="setDateSched(this.value);" class="greyC" id="selectBDate" style="border:none;background-color: transparent; " value="<?php echo(isset($_SESSION['sBDate']) ? $_SESSION['sBDate']: "0"); ?>" type="date" min="<?php echo $sdate;?>" max="<?php echo $edate;?>">
							</div>
                        </div>
                   </div>
                    <!-- Single Select Box -->
                    <div class="single-select-box mb-30">
                        <div class="boking-tittle">
                            <span>Hour of the day:</span>
                        </div>
						
						<!-- Default barber pick button -->
							<div class="btn-group dropup">
							  <button id="timeSelect" type="button" style="background-color: transparent;border-width: thin;"  class="btn-outline-warning dropdown-toggle rounded customDrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<?php echo(isset($_SESSION['sBTime']) ? ($_SESSION['sBTime']>12 ? ($_SESSION['sBTime']-12)." pm": $_SESSION['sBTime']." am"): "9 am"); ?>
							  </button>
							  <div class="dropdown-menu" id="HourChoices">
								<a class="dropdown-item" href="#" onClick="selectTime('9','9 am');">9 am</a>
                                <a class="dropdown-item" href="#" onClick="selectTime('10','10 am');">10 am</a>
                                <a class="dropdown-item" href="#" onClick="selectTime('11','11 am');">11 am</a>
                                <a class="dropdown-item" href="#" onClick="selectTime('12','12 pm');">12 pm</a>
								<a class="dropdown-item" href="#" onClick="selectTime('13','1 pm');">1 pm</a>
                                <a class="dropdown-item" href="#" onClick="selectTime('14','2 pm');">2 pm</a>
                                <a class="dropdown-item" href="#" onClick="selectTime('15','3 pm');">3 pm</a>
                                <a class="dropdown-item" href="#" onClick="selectTime('16','4 pm');">4 pm</a>
								<a class="dropdown-item" href="#" onClick="selectTime('17','5 pm');">5 pm</a>
                                <a class="dropdown-item" href="#" onClick="selectTime('18','6 pm');">6 pm</a>
                                <a class="dropdown-item" href="#" onClick="selectTime('19','7 pm');">7 pm</a>
                                <a class="dropdown-item" href="#" onClick="selectTime('20','8 pm');">8 pm</a>
								<a class="dropdown-item" href="#" onClick="selectTime('21','9 pm');">9 pm</a>
                                <a class="dropdown-item" href="#" onClick="selectTime('22','10 pm');">10 pm</a>
                                <a class="dropdown-item" href="#" onClick="selectTime('23','11 pm');">11 pm</a>
							  </div>
							</div>
							
							<input type="hidden" value="<?php echo(isset($_SESSION['sBType']) ? $_SESSION['sBType']: "0"); ?>" id="BarbT">
							<input type="hidden" value="0" id="BarbID">
							<input type="hidden" value="<?php echo(isset($_SESSION['sBTime']) ? $_SESSION['sBTime']: "9"); ?>" id="SchedHour">
							<script>
							
							
							
							function reserveDate(){
								var BarbID = document.getElementById("BarbID").value;
								var BarbT = document.getElementById("BarbT").value;
								var sBDate = document.getElementById("selectBDate").value;
								var SchedHour = document.getElementById("SchedHour").value;
								if(sBDate!=""&&SchedHour!='0'&&BarbID!='0'){
									var fd = new FormData();
									fd.append('sBDate',sBDate);
									fd.append('bID',BarbID);
									fd.append('sType',BarbT);
									fd.append('sTime',SchedHour);
									fd.append('func',"12");
									$.ajax({
										url:'functions.php',
										data: fd,
										type:'POST',
										contentType: false,
										processData: false,
										success:function(data){
											alert(data);
										}
									});
								}
								else
									alert((BarbID=='0' ? "Pick a Barber":"Please Fill the necessary details"));
								
							}
							
							function selectBarb(SelectedBarb, BarbName){
								var BarbID = document.getElementById("BarbID");
								$('#barb'+BarbID.value).removeClass('border');
								$('#barb'+BarbID.value).addClass('border-0');
								BarbID.value = SelectedBarb;
								
								$('#barb'+SelectedBarb).removeClass('border-0');
								$('#barb'+SelectedBarb).addClass('border');
								var sBDate = document.getElementById("selectBDate").value;
								
								if(sBDate == ""){
									alert('Select a Date in order to Continue');
									document.getElementById("HourChoices").innerHTML = null;
									selectTime('0','Select Date First');									
								}
								if(SelectedBarb=='0'){
									selectBarbT("0","Random");
									if(sBDate != "")
									getAvailableHour("0",SelectedBarb,sBDate);
								}
								else{
									selectBarbT("1",BarbName);
									if(sBDate != "")
									getAvailableHour("1",SelectedBarb,sBDate);
								}
									
								
							}
							
							function setDateSched(sBDate){
								var BarbID = document.getElementById("BarbID").value;
								var BarbT = document.getElementById("BarbT").value;
								getAvailableHour(BarbT,BarbID,sBDate);
								
								
							}
							
							
							function getAvailableHour(sType,bID,sBDate){
								var fd = new FormData();
								fd.append('sBDate',sBDate);
								fd.append('bID',bID);
								fd.append('sType',sType);
								fd.append('func',"10");
								$.ajax({
									url:'functions.php',
									data: fd,
									type:'POST',
									contentType: false,
									processData: false,
									success:function(data){
										document.getElementById("HourChoices").innerHTML = data;
									}
								});
								
								var fd2 = new FormData();
								fd2.append('sBDate',sBDate);
								fd2.append('bID',bID);
								fd2.append('sType',sType);
								fd2.append('func',"11");
								$.ajax({
									url:'functions.php',
									data: fd2,
									type:'POST',
									contentType: false,
									processData: false,
									success:function(data){
										var dataAr = JSON.parse(data);
										document.getElementById("SchedHour").value = dataAr[1];
										document.getElementById("timeSelect").innerHTML = dataAr[0];
									}
								});
							}
							
							function selectTime(time,text){
								document.getElementById("timeSelect").innerHTML = text;
								document.getElementById("SchedHour").value = time;
							}
							
							function selectBarbTForm(type,text){
								if(type=='0')
									selectBarb('0', '');
								else if (document.getElementById("BarbID").value == '0')
									selectBarbT('1',"Custom");
							}
							
							function selectBarbT(type,text){
								document.getElementById("barbTSelect").innerHTML = text;
								document.getElementById("BarbT").value = type;
								
							}
							</script>
                   </div>
                    <!-- Single Select Box -->
					<button type="button" onClick="reserveDate();" style="min-height:57px;max-height:57px;min-width:160px;" class="btn btn-warning">Reserve</button>

               

                </div>
            </form>
               </div>
               </div>
            </div>
        <!-- Reservation Room End-->
		

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
   
   
					function getBarberList(){
						$.ajax({
							url:'functions.php',
							data: {func:'9'},
							type:'POST',
							success:function(data){
								document.getElementById("barbersLIST").innerHTML = data;
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
						getBarberList();
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