<?php 
if(isset($_SESSION['userNameQBIC'])&&isset($_SESSION['userIdQBIC'])&&isset($_SESSION['userRankQBIC']))
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
        <title>Reservation</title>
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
                               <a href="index.php"><img width="75px" class="rounded-circle" src="../assets/img/logo/logo.jpg" alt=""></a>
                            </div>
                        </div>
                    <div class="col-xl-8 col-lg-8">
                            <!-- main-menu -->
                            <div class="main-menu f-right d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">                                                                                                                                     
                                        <li><a href="">Home</a></li>
										 <li><a href="#Footer">Contact</a></li>
                                        <li><a href="#Products">Products</a></li>
                                        <li><a href="blog.html">Inbox &nbsp <span class="badge badge-danger">5</span></a> 
                                            <ul class="submenu">
                                                <li><a href="blog.html">Blog</a></li>
                                                <li><a href="single-blog.html">Blog Details</a></li>
                                            </ul>
                                        </li>
                                        <li><a >My Account</a>
                                            <ul class="submenu">
                                                <li><a href="rooms.html">Change Settings</a>
												<li><a href="elements.html">User Cart &nbsp <span class="badge badge-danger">5</span></a></li>
                                                <li><a href="elements.html">Account History</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>             
                        <div class="col-xl-2 col-lg-2">
                            <!-- header-btn -->
                            <div class="header-btn">
                                <a  class="btn btn1 d-none d-lg-block " style="color:white;">Reserve Online</a>
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

        
   

  
	<div class="container container-fluid">
	  <div class="row" id='slideshareTB'>
		  
	  
	  
		
		
	  </div>
	</div>
	<script>
		
	</script>


   
   
	<!-- ADD PRODUCT MODAL -->
	<div class="modal fade" id="addProductModal">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Product</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
					<input type="text" id="pnameADD" name="pname"  placeholder="Product Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Product Name'" required="" class="single-input-accent">

					<textarea name="pdesc" id="pdescADD" class="single-textarea"  placeholder="Product Description" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Product Description'" required></textarea>
					
					<input type="number" id="ppriceADD"  name="pprice"  onkeypress='return event.charCode >= 48 && event.charCode <= 57'  placeholder="Product Price" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Product Price'" required="" class="single-input-accent">
					
					<input type="number" id="pquantityADD"  name="pquantity"  onkeypress='return event.charCode >= 48 && event.charCode <= 57'  placeholder="Product Quantity" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Product Quantity'" required="" class="single-input-accent">
					

					Photo
					<input type="file" id="pimageADD" name="pimage"  required="" class="single-input-accent">
			
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
		  <button type="button" class="btn btn-secondary" onclick="addProduct();" >Add</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
        
      </div>
    </div>
  </div>

	<!-- EDIT PRODUCT MODAL -->
	<div class="modal fade" id="editProductModal">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div id="modalContentEdit" class="modal-content">
      
        
        
      </div>
    </div>
  </div>
  
	<!-- PRODUCTS TABLE START -->
	<div class="adjustRow" style="	margin:5% 5% 0 5%;">
				<!-- DROP OFF PANEL-->
					 <div class="card">
					  <div class="card-header">
						<div class="table ">
							<div class="row">
								<div class="col">
									<span class="badge">
										<p class="text-left tableTitle">Product List</p>
									</span>
								</div>
								
								<div class="col">
									<button type="button" class="btn btn-primary float-right" onclick="" data-toggle="modal" data-target="#addProductModal">
										Add Product
									</button>
								</div>
							</div>
						</div>
					  </div>

					  <div class="card-block " >
						<table class="table table-striped">
						  <thead>
							<tr>
							  <th scope="col">ID</th>
							  <th scope="col">Image</th>
							  <th scope="col">Name</th>
							  <th scope="col">Description</th>
							  <th scope="col">Quantity</th>
							  <th scope="col">Price</th>
							  <th scope="col">Action</th>
							</tr>
						  </thead>
						  <tbody id="productListTB">
						  
						  </tbody>
						</table>
						
						
					  </div>
						  <div class="card-footer" style="height: 65px;">
						  </div>
					</div>
	</div>
	<!-- PRODUCTS TABLE END -->

	<!-- BARBERS TABLE START -->
	<div class="adjustRow" style="	margin:2% 5% 0 5%;">
				<!-- DROP OFF PANEL-->
					 <div class="card">
					  <div class="card-header">
						<div class="table ">
							<div class="row">
								<div class="col">
									<span class="badge">
										<p class="text-left tableTitle">Barber List</p>
									</span>
								</div>
								
								<div class="col">
									<button type="button" class="btn btn-primary float-right" onclick="" data-toggle="modal" data-target="#addBarberModal">
										Add Barber
									</button>
								</div>
							</div>
						</div>
					  </div>

					  <div class="card-block " >
						<table class="table table-striped">
						  <thead>
							<tr>
							  <th scope="col">ID</th>
							  <th scope="col">Image</th>
							  <th scope="col">Name</th>
							  <th scope="col">Schedule Count</th>
							  <th scope="col">Action</th>
							</tr>
						  </thead>
						  <tbody id="barberListTB">
						  
						  </tbody>
						</table>
						
						
					  </div>
						  <div class="card-footer" style="height: 65px;">
						  </div>
					</div>
	</div>
	<!-- BARBERS TABLE END -->
	
	<!-- ADD BARBER MODAL -->
	<div class="modal fade" id="addBarberModal">
		<div class="modal-dialog modal-xl modal-dialog-centered">
		  <div class="modal-content">
		  
			<!-- Modal Header -->
			<div class="modal-header">
			  <h4 class="modal-title">Add Barber</h4>
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			
			<!-- Modal body -->
			<div class="modal-body">
						<input type="text" id="bnameADD" name="bname"  placeholder="Barber Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Barber Name'" required="" class="single-input-accent">
						Photo
						<input type="file" id="bimageADD" name="bimage"  required="" class="single-input-accent">
				
			</div>
			<!-- Modal footer -->
			<div class="modal-footer">
			  <button type="button" class="btn btn-secondary" onclick="addBarber();" >Add</button>
			  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
			</div>
			
		  </div>
		</div>
	  </div>
   
   <script>
					function removeSlide(sID){
						if(confirm("Do you want to delete this Slide?")){
							$.ajax({
								url:'functions.php',
								data: {func:'14',sID:sID},
								type:'POST',
								success:function(data){
									refresh();
									alert("Successfully removed Slide!");
								}
							});
						}
					}
					
					function editSlide(sID){
						var stitleEDIT = document.getElementById("stitleEDIT"+sID).value;
						var sdescEDIT = document.getElementById("sdescEDIT"+sID).value;
						var simageEDIT = document.getElementById("simageEDIT"+sID).value;
						var fd = new FormData();
						if(simageEDIT!=""){
							var files = $('#simageEDIT'+sID)[0].files[0];
							fd.append('simage',files);
						}
						fd.append('sID',sID);
						fd.append('stitle',stitleEDIT);
						fd.append('sdesc',sdescEDIT);
						fd.append('func',"13");
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
									refresh();
									alert("Edited Barber!");
								}
							}
						});	
					}
					
					function getSlideList(){
						$.ajax({
							url:'functions.php',
							data: {func:'12'},
							type:'POST',
							success:function(data){
								document.getElementById("slideshareTB").innerHTML = data;
							}
						});
					}
					
					function addSlideshare(){
						
						var simageADD = document.getElementById("simageADD").value;
						
						if(simageADD!=""){
							var fd = new FormData();
							var files = $('#simageADD')[0].files[0];
							fd.append('stitle',document.getElementById("stitleADD").value);
							fd.append('sdesc',document.getElementById("sdescADD").value);
							fd.append('simage',files);
							fd.append('func',"11");
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
									refresh();
									alert("Added SlideShow!");
								}
							}
							});
						}
						else
							alert('Select a Photo to Add');	
					}
					
   
					function refresh(){
						getSlideList();
						getProductTable();
						getBarberTable();
					}
					
					function disableBarber(bID){
						if(confirm("Do you want to disable this barber?")){
							$.ajax({
								url:'functions.php',
								data: {func:'10',bID:bID},
								type:'POST',
								success:function(data){
									refresh();
									alert("Successfully disabled barber!");
								}
							});
						}
					}
					
					function getEditBarberDetails(bID){
						$.ajax({
							url:'functions.php',
							data: {func:'8',bID:bID},
							type:'POST',
							success:function(data){
								document.getElementById("modalContentEdit").innerHTML = data;
							}
						});
					}
					
					function editBarber(bID){
						
						var bnameEDIT = document.getElementById("bnameEDIT").value;
						var bimageEDIT = document.getElementById("bimageEDIT").value;
					
						if(bnameEDIT!=""){
							var fd = new FormData();
							if(bimageEDIT!=""){
								var files = $('#bimageEDIT')[0].files[0];
								fd.append('bimage',files);
							}
							fd.append('bID',bID);
							fd.append('bname',bnameEDIT);
							fd.append('func',"9");
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
									alert("Edited Barber!");
									refresh();
								}
							}
							});
						}
						else
							alert('One or Two fields are empty. Please fill up all fields');	
					}
					
					function addBarber(){
						
						var bnameADD = document.getElementById("bnameADD").value;
						var bimageADD = document.getElementById("bimageADD").value;
					
						if(bnameADD!=""&&bimageADD!=""){
							var fd = new FormData();
							var files = $('#bimageADD')[0].files[0];
							fd.append('bname',bnameADD);
							fd.append('bimage',files);
							fd.append('func',"6");
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
									refresh();
									alert("Added Barber!");
								}
							}
							});
						}
						else
							alert('One or Two fields are empty. Please fill up all fields');	
					}
					
					function getBarberTable(){
						$.ajax({
							url:'functions.php',
							data: {func:'7'},
							type:'POST',
							success:function(data){
								document.getElementById("barberListTB").innerHTML = data;
							}
						});
					}
					
					
					function deleteProduct(pID){
						if(confirm("Do you want to delete this product?")){
							$.ajax({
								url:'functions.php',
								data: {func:'3',pID:pID},
								type:'POST',
								success:function(data){
									refresh();
									alert("Successfully deleted product!");
								}
							});
						}
					}
					
					function getEditProductDetails(pID){
						$.ajax({
							url:'functions.php',
							data: {func:'4',pID:pID},
							type:'POST',
							success:function(data){
								document.getElementById("modalContentEdit").innerHTML = data;
							}
						});
					}
					
					function addProduct(){
						
						var pnameADD = document.getElementById("pnameADD").value;
						var pdescADD = document.getElementById("pdescADD").value;
						var pquantityADD = document.getElementById("pquantityADD").value;
						var pimageADD = document.getElementById("pimageADD").value;
						var ppriceADD = document.getElementById("ppriceADD").value;
						
					
						if(pnameADD!=""&&pdescADD!=""&&pquantityADD!=""&&pimageADD!=""&&ppriceADD!=""){
							var fd = new FormData();
							var files = $('#pimageADD')[0].files[0];
							fd.append('pname',pnameADD);
							fd.append('pdesc',pdescADD);
							fd.append('pquantity',pquantityADD);
							fd.append('pimage',files);
							fd.append('pprice',ppriceADD);
							fd.append('func',"1");
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
									refresh();
									alert("Added Product!");
								}
							}
							});
						}
						else
							alert('One or Two fields are empty. Please fill up all fields');	
					}
					
					function getProductTable(){
						$.ajax({
							url:'functions.php',
							data: {func:'2'},
							type:'POST',
							success:function(data){
								document.getElementById("productListTB").innerHTML = data;
							}
						});
					}
					
					
					
					
					
					

					function editProduct(pID){
						
						var pnameEDIT = document.getElementById("pnameEDIT").value;
						var pdescEDIT = document.getElementById("pdescEDIT").value;
						var pquantityEDIT = document.getElementById("pquantityEDIT").value;
						var pimageEDIT = document.getElementById("pimageEDIT").value;
						var ppriceEDIT = document.getElementById("ppriceEDIT").value;
					
						if(pnameEDIT!=""&&pdescEDIT!=""&&pquantityEDIT!=""&&ppriceEDIT!=""){
							var fd = new FormData();
							if(pimageEDIT!=""){
								var files = $('#pimageEDIT')[0].files[0];
								fd.append('pimage',files);
							}
							fd.append('pID',pID);
							fd.append('pname',pnameEDIT);
							fd.append('pdesc',pdescEDIT);
							fd.append('pprice',ppriceEDIT);
							fd.append('pquantity',pquantityEDIT);
							fd.append('func',"5");
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
									refresh();
									alert("Edited Product!");
								}
							}
							});
						}
						else
							alert('One or Two fields are empty. Please fill up all fields');	
					}
					
					
					
					function editVan(vanID){
						var vName = document.getElementById("vanName"+vanID).value;
						var vDName = document.getElementById("vanDName"+vanID).value;
						var vDPhone = document.getElementById("vanDPhone"+vanID).value;
						var vDEmail = document.getElementById("vanDEmail"+vanID).value;
						var vPNum = document.getElementById("vanPNum"+vanID).value;
						
						if(vName!=""&&vDName!=""&&vDPhone!=""&&vDEmail!=""){
							$.ajax({
							url:'functions.php',
							data:{vName:vName,vDName:vDName,vDEmail:vDEmail,vDPhone:vDPhone,func:"4",vanID:vanID,vPNum:vPNum},
							type:'POST',
							success:function(data){
								if(data!=""){
									alert("Something Went Wrong Please Refresh!");
								}
								else{
									refreshData();
									document.getElementById("passengerAddEdit").innerHTML = null;
									alert("Successfully Edited Van!");
								}
							}
							});
						}
						else{
							alert("Please fill-in the neccessary details!");
						}
					}
   </script>
   
    </main>
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
