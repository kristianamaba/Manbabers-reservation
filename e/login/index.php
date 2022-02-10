<?php 
session_start();
if(isset($_SESSION['userNameECOM'])&&isset($_SESSION['userIDECOM'])&&isset($_SESSION['userRankECOM']))
header("Location: ../");
?>

<!doctype html>
<html class="no-js" lang="zxx">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Login</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="manifest" href="site.webmanifest">
		<link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">

		<!-- CSS here -->
            <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
            <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
            <link rel="stylesheet" href="../assets/css/gijgo.css">
            <link rel="stylesheet" href="../assets/css/slicknav.css">
            <link rel="stylesheet" href="../assets/css/animate.min.css">
            <link rel="stylesheet" href="../assets/css/magnific-popup.css">
            <link rel="stylesheet" href="../assets/css/fontawesome-all.min.css">
            <link rel="stylesheet" href="../assets/css/themify-icons.css">
            <link rel="stylesheet" href="../assets/css/slick.css">
            <link rel="stylesheet" href="../assets/css/nice-select.css">
            <link rel="stylesheet" href="../assets/css/style.css">
            <link rel="stylesheet" href="../assets/css/responsive.css">
			<style>
/* sign in FORM */
#logreg-forms{
    width:412px;
    margin:10vh auto;
    background-color:#f3f3f3;
    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
  transition: all 0.3s cubic-bezier(.25,.8,.25,1);
}
#logreg-forms form {
    width: 100%;
    max-width: 410px;
    padding: 15px;
    margin: auto;
}
#logreg-forms .form-control {
    position: relative;
    box-sizing: border-box;
    height: auto;
    padding: 10px;
    font-size: 16px;
}
#logreg-forms .form-control:focus { z-index: 2; }
#logreg-forms .form-signin input[type="email"] {
    margin-bottom: -1px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
}
#logreg-forms .form-signin input[type="password"] {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}

#logreg-forms .social-login{
    width:390px;
    margin:0 auto;
    margin-bottom: 14px;
}
#logreg-forms .social-btn{
    font-weight: 100;
    color:white;
    width:190px;
    font-size: 0.9rem;
}

#logreg-forms a{
    display: block;
    padding-top:10px;
    color:lightseagreen;
}

#logreg-form .lines{
    width:200px;
    border:1px solid red;
}


#logreg-forms button[type="submit"]{ margin-top:10px; }

#logreg-forms .facebook-btn{  background-color:#3C589C; }

#logreg-forms .google-btn{ background-color: #DF4B3B; }

#logreg-forms .form-reset, #logreg-forms .form-signup{ display: none; }

#logreg-forms .form-signup .social-btn{ width:210px; }

#logreg-forms .form-signup input { margin-bottom: 2px;}

.form-signup .social-login{
    width:210px !important;
    margin: 0 auto;
}

/* Mobile */

@media screen and (max-width:500px){
    #logreg-forms{
        width:300px;
    }
    
    #logreg-forms  .social-login{
        width:200px;
        margin:0 auto;
        margin-bottom: 10px;
    }
    #logreg-forms  .social-btn{
        font-size: 1.3rem;
        font-weight: 100;
        color:white;
        width:200px;
        height: 56px;
        
    }
    #logreg-forms .social-btn:nth-child(1){
        margin-bottom: 5px;
    }
    #logreg-forms .social-btn span{
        display: none;
    }
    #logreg-forms  .facebook-btn:after{
        content:'Facebook';
    }
  
    #logreg-forms  .google-btn:after{
        content:'Google+';
    }
    
}
			</style>
			
   </head>

   <body>
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
                               <a href="index.php"><img width="75px" class="rounded-circle" src="../assets/img/logo/logo.jpg" alt=""></a>
                            </div>
                        </div>
                    <div class="col-xl-8 col-lg-8">
                            <!-- main-menu -->
                            <div class="main-menu f-right d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">                                                                                                                                     
                                        <li><a href="../">Home</a></li>
										 <li><a href="../Home#Footer">Contact</a></li>
                                        <li><a href="../Home#Products">Products</a></li>
                                        <li><a href="#">Login</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>             
                        <div class="col-xl-2 col-lg-2">
                            <!-- header-btn -->
                            <div class="header-btn">
                                <a  class="btn btn1 d-none d-lg-block" onclick="alert('Login First!');" style="color:white;">Reserve Online</a>
                            </div>
                        </div>
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
       </div>
        <!-- Header End -->
    </header>
	
	
    <main>

        
   
   <div id="logreg-forms">
        <form action="verified.php"  method="POST" class="form-signin">
            <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"> Sign in</h1>
			<br>
            <input type="text" id="usernameSI" maxlength="50" onkeyup="showWarning('4',this.value,'showErrorLoginUserSI');checkAccountInvalid(this.value,'2');" id="inputEmailMobile" name="user-EmailMobile" class="form-control" placeholder="Email address/Mobile Number" required="" autofocus="">
            <div id="showErrorLoginUserSI"></div>
			<br>
			<input type="password" id="passwordSI" maxlength="30" onkeyup="checkAccountInvalid(this.value,'1');" id="inputPassword" name="user-pass" class="form-control" placeholder="Password" required="">
             <div id="showErrorLoginPassSI"></div>
			 <br>
            <button class="btn btn-success btn-block"  name="submitSI" type="submit"><i class="fas fa-sign-in-alt"></i> Sign in</button>

            <hr>
            <!-- <p>Don't have an account!</p>  -->
            <button class="btn btn-primary btn-block" type="button" id="btn-signup"><i class="fas fa-user-plus"></i> Sign up New Account</button>
            </form>

            <form action="/reset/password/" class="form-reset">
                <input type="email" id="resetEmail" class="form-control" placeholder="Email address/Phone number" required="" autofocus="">
                <button class="btn btn-primary btn-block" type="submit">Reset Password</button>
                <a href="#" id="cancel_reset"><i class="fas fa-angle-left"></i> Back</a>
            </form>
            
            <form action="verified.php"  method="POST" class="form-signup">
			    <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"> Sign up</h1>
                <input type="text" maxlength="50" onkeyup="showWarning('1',this.value,'showErrorNameSU')" id="user-name" name="user-name" class="form-control" placeholder="Full name" required="" autofocus="">
				<div id="showErrorNameSU"></div>
                <input type="text" maxlength="11" onkeyup="showWarning('2',this.value,'showErrorPhoneSU')" id="user-phone" name="user-phone" class="form-control" placeholder="Username" required autofocus="">
                <div id="showErrorPhoneSU"></div>
				<input type="email" onkeyup="showWarning('3',this.value,'showErrorEmailSU')" maxlength="50" id="user-email" name="user-email" class="form-control" placeholder="Email address" required autofocus="">
				 <div id="showErrorEmailSU"></div>
				<input id="passSU" type="password" onkeyup="checkPassSU(this.value)" id="user-pass" maxlength="30" name="user-pass" class="form-control" placeholder="Password" required autofocus="">
				 <div id="showErrorPassSU"></div>
				<input type="password" onkeyup="checkPassMatchSU(this.value)" id="user-repass" maxlength="30" name="user-repass" class="form-control" placeholder="Retype Password" required autofocus="">
                 <div id="showErrorRePassSU"></div>
                <button class="btn btn-primary btn-block" name="submitSU" type="submit"><i class="fas fa-user-plus"></i> Sign Up</button>
                <a href="#" id="cancel_signup"><i class="fas fa-angle-left"></i> Back</a>
            </form>
            <br>
            
    </div>

	<script>
	function checkPassSU(text){
		if(text.length<=8){
			document.getElementById('showErrorPassSU').innerHTML = '<div class="alert alert-danger"><strong>Warning!</strong> Password must be atleast 8 characters!</div>';
		}
		else{
			document.getElementById('showErrorPassSU').innerHTML = null;
		}
	}
	function checkPassMatchSU(text){
		var pass = document.getElementById('passSU').value;
		if(text != pass){
			document.getElementById('showErrorRePassSU').innerHTML = '<div class="alert alert-danger"><strong>Warning!</strong> Password does not match!</div>';
		}
		else{
			document.getElementById('showErrorRePassSU').innerHTML = null;
		}
	}
	function checkAccountInvalid(text,num){
		if(num==1){
			var loginData = document.getElementById('usernameSI').value;
		}else{
			var loginData = text;
			text = document.getElementById('passwordSI').value;
			
		}
		if(text!=""){
			$.ajax({
			url:'check.php',
			data:{pass:text,loginData:loginData},
			type:'POST',
			success:function(data){
			document.getElementById('showErrorLoginPassSI').innerHTML = data;
			}
			});
		}

	}
	
	
	function showWarning(num,text,id){
		$.ajax({
		url:'check.php',
		data:{text:text,num:num},
		type:'POST',
		success:function(data){
		document.getElementById(id).innerHTML = data;
		}
		});
	}
	function toggleResetPswd(e){
    e.preventDefault();
    $('#logreg-forms .form-signin').toggle() // display:block or none
    $('#logreg-forms .form-reset').toggle() // display:block or none
}

function toggleSignUp(e){
    e.preventDefault();
    $('#logreg-forms .form-signin').toggle(); // display:block or none
    $('#logreg-forms .form-signup').toggle(); // display:block or none
}

$(()=>{
    // Login Register Form
    $('#logreg-forms #forgot_pswd').click(toggleResetPswd);
    $('#logreg-forms #cancel_reset').click(toggleResetPswd);
    $('#logreg-forms #btn-signup').click(toggleSignUp);
    $('#logreg-forms #cancel_signup').click(toggleSignUp);
})
	</script>
   
   

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
                           <a href="index.php"><img width="200px" class="rounded-circle" src="../assets/img/logo/logo.jpg" alt=""></a>
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
   
   
	<!-- JS here -->
	
		<!-- All JS Custom Plugins Link Here here -->
        <script src="./../assets/js/vendor/modernizr-3.5.0.min.js"></script>
		
		<!-- Jquery, Popper, Bootstrap -->
		<script src="./../assets/js/vendor/jquery-1.12.4.min.js"></script>
        <script src="./../assets/js/popper.min.js"></script>
        <script src="./../assets/js/bootstrap.min.js"></script>
	    <!-- Jquery Mobile Menu -->
        <script src="./../assets/js/jquery.slicknav.min.js"></script>

		<!-- Jquery Slick , Owl-Carousel Plugins -->
        <script src="./../assets/js/owl.carousel.min.js"></script>
        <script src="./../assets/js/slick.min.js"></script>
        <!-- Date Picker -->
        <script src="./../assets/js/gijgo.min.js"></script>
		<!-- One Page, Animated-HeadLin -->
        <script src="./../assets/js/wow.min.js"></script>
		<script src="./../assets/js/animated.headline.js"></script>
        <script src="./../assets/js/jquery.magnific-popup.js"></script>

		<!-- Scrollup, nice-select, sticky -->
        <script src="./../assets/js/jquery.scrollUp.min.js"></script>
        <script src="./../assets/js/jquery.nice-select.min.js"></script>
		<script src="./../assets/js/jquery.sticky.js"></script>
        
        <!-- contact js -->
        <script src="./../assets/js/contact.js"></script>
        <script src="./../assets/js/jquery.form.js"></script>
        <script src="./../assets/js/jquery.validate.min.js"></script>
        <script src="./../assets/js/mail-script.js"></script>
        <script src="./../assets/js/jquery.ajaxchimp.min.js"></script>
        
		<!-- Jquery Plugins, main Jquery -->	
        <script src="./../assets/js/plugins.js"></script>
        <script src="./../assets/js/main.js"></script>
        
    </body>
</html>
