<?php
include('../database_connection.php');
session_start();


function resizeImage($resourceType,$image_width,$image_height,$resizeWidth,$resizeHeight) {
    $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
    imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
    return $imageLayer;
}

function resizeImageMul($photo, $IMGsizes){
	    $fileName = $photo['tmp_name'];
        $sourceProperties = getimagesize($fileName);
        $resizeFileName = time();
        $uploadPath = "../uploads/";
        $fileExt = pathinfo($photo['name'], PATHINFO_EXTENSION);
        $uploadImageType = $sourceProperties[2];
        $sourceImageWidth = $sourceProperties[0];
        $sourceImageHeight = $sourceProperties[1];
		
		
		for($i = 0; $i < count($IMGsizes); $i++){
			switch ($uploadImageType) {
				case IMAGETYPE_JPEG:
					$resourceType = imagecreatefromjpeg($fileName); 
					$imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,$IMGsizes[$i][0],$IMGsizes[$i][1]);
					imagejpeg($imageLayer,$uploadPath."thump_".$resizeFileName.'.'.$fileExt);
					break;

				case IMAGETYPE_GIF:
					$resourceType = imagecreatefromgif($fileName); 
					$imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,$IMGsizes[$i][0],$IMGsizes[$i][1]);
					imagegif($imageLayer,$uploadPath."thump_".$resizeFileName.'.'. $fileExt);
					break;

				case IMAGETYPE_PNG:
					$resourceType = imagecreatefrompng($fileName); 
					$imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,$IMGsizes[$i][0],$IMGsizes[$i][1]);
					imagepng($imageLayer,$uploadPath."thump_".$resizeFileName.'.'. $fileExt);
					break;

				default:
					$imageProcess = 0;
					break;
			}
		}
        //move_uploaded_file($fileName, $uploadPath. $resizeFileName. ".". $fileExt); STORE ORIGINAL IMAGE
        $imageProcess = 1;
		return  array($imageProcess,"thump_".$resizeFileName.".".$fileExt );
}

function getAllProductDetails(){ include('../database_connection.php');
	$query = "SELECT * FROM prodtb WHERE prod_on='1'";
	$result = mysqli_query($dbCon, $query);
	$data = array();
	$i = 0;
	while($row = mysqli_fetch_array($result)){
		$data[$i][0] = $row['prod_id'];
		$data[$i][1] = $row['ph_loc'];
		$data[$i][2] = $row['prod_name'];
		$data[$i][3] = $row['prod_desc'];
		$data[$i][4] = $row['prod_num'];
		$data[$i][5] = $row['prod_price'];
		$i++;
	}
	return $data;
}

function getAllBarbDetails(){ include('../database_connection.php');
	$query = "SELECT * FROM barbtb WHERE barb_ON='1'";
	$result = mysqli_query($dbCon, $query);
	$data = array();
	$i = 0;
	while($row = mysqli_fetch_array($result)){
		$data[$i][0] = $row['barb_id'];
		$data[$i][1] = $row['ph_loc'];
		$data[$i][2] = $row['barb_name'];
		$i++;
	}
	return $data;
}

function getAllSlideDetails(){ include('../database_connection.php');
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

function getBarberDetails($bID){ include('../database_connection.php');
	$query = "SELECT * FROM barbtb WHERE barb_id='$bID'";
	$result = mysqli_query($dbCon, $query);
	$data = array();
	while($row = mysqli_fetch_array($result)){
		$data[0] = $row['barb_id'];
		$data[1] = $row['ph_loc'];
		$data[2] = $row['barb_name'];
	}
	return $data;
}

function getProductDetails($pID){ include('../database_connection.php');
	$query = "SELECT * FROM prodtb where prod_id='$pID' ";
	$result = mysqli_query($dbCon, $query);
	$data = array();
	while($row = mysqli_fetch_array($result)){
		$data[0] = $row['prod_id'];
		$data[1] = $row['ph_loc'];
		$data[2] = $row['prod_name'];
		$data[3] = $row['prod_desc'];
		$data[4] = $row['prod_num'];
		$data[5] = $row['prod_price'];
	}
	return $data;
}

function getBarbPendingScheduleCount($bID){ include('../database_connection.php');
	$query = "SELECT count(*) FROM barbschedtb WHERE barb_id='$bID' AND barbs_confirm='0'";
	return mysqli_fetch_array(mysqli_query($dbCon, $query))['0'];
}

if(isset($_POST['func'])){
	$func = $_POST['func'];
	
		if($func == "1"){ //ADD PRODUCT
			$pname = $_POST['pname'];
			$pdesc = $_POST['pdesc'];
			$pquantity = $_POST['pquantity'];
			$Photo = $_FILES['pimage'];
			$imageRet = resizeImageMul($Photo, array(array(360,206)));
			$pprice = $_POST['pprice'];
			$query = "INSERT INTO `prodtb` (`prod_id`,`ph_loc`,`prod_name`,`prod_desc`,`prod_num`,prod_price,prod_on) VALUES (NULL, '".$imageRet[1]."', '$pname', '$pdesc', '$pquantity','$pprice','1')"; 
			mysqli_query($dbCon, $query);
		}
		else if($func == "2"){ //TABLE PRODUCTS
			$prodList = getAllProductDetails();
			
			for($i = 0; $i < count($prodList); $i++){
				echo "<tr>
						<th scope=\"row\">".$prodList[$i][0]."</th>
						 <td><img width=\"50px\" src=\"../uploads/".$prodList[$i][1]."\" </td>
						 <td>".$prodList[$i][2]."</td>
						 <td>".$prodList[$i][3]."</td>
						 <td>".$prodList[$i][4]."</td>
						 <td>₱ ".$prodList[$i][5]."</td>
						 <td>
							<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" onClick=\"getEditProductDetails('".$prodList[$i][0]."')\" data-target=\"#editProductModal\">
								Edit
							</button>
							<button type=\"button\" onclick=\"deleteProduct('".$prodList[$i][0]."')\" class=\"btn btn-primary\">
								Delete
							</button>
						</td>
					  </tr>";
			}
			
		}
		else if($func == "3"){ //DELETE PRODUCTS
			$pID = $_POST['pID'];
			$query = "UPDATE prodtb SET prod_on='0' WHERE prod_id='$pID';";
			mysqli_query($dbCon, $query);
		}
		else if($func == "4"){ //GET PRODUCT MODAL EDIT DETAILS
			$pID = $_POST['pID'];
			$productDetails = getProductDetails($pID);
			echo "<!-- Modal Header -->
        <div class=\"modal-header\">
          <h4 class=\"modal-title\">EDIT: ".$productDetails[2]."</h4>
          <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class=\"modal-body\">
					<input type=\"text\" id=\"pnameEDIT\" name=\"pname\" value='".$productDetails[2]."' placeholder=\"Product Name\" onfocus=\"this.placeholder = ''\" onblur=\"this.placeholder = 'Product Name'\" required=\"\" class=\"single-input-accent\">

					<textarea name=\"pdesc\" id=\"pdescEDIT\"  class=\"single-textarea\"  placeholder=\"Product Description\" onfocus=\"this.placeholder = ''\" onblur=\"this.placeholder = 'Product Description'\" required> ".$productDetails[3]."</textarea>
					
					<input type=\"number\" id=\"ppriceEDIT\"  value='".$productDetails[5]."' name=\"pprice\"  onkeypress='return event.charCode >= 48 && event.charCode <= 57'  placeholder=\"Product Price\" onfocus=\"this.placeholder = ''\" onblur=\"this.placeholder = 'Product Price'\" required=\"\" class=\"single-input-accent\">
					
					<input type=\"number\" id=\"pquantityEDIT\" value='".$productDetails[4]."' name=\"pquantity\"  onkeypress='return event.charCode >= 48 && event.charCode <= 57'  placeholder=\"Product Quantity\" onfocus=\"this.placeholder = ''\" onblur=\"this.placeholder = 'Product Quantity'\" required=\"\" class=\"single-input-accent\">
					Photo
					<input type=\"file\" id=\"pimageEDIT\" name=\"pimage\"  required=\"\" class=\"single-input-accent\">
			
        </div>
        <!-- Modal footer -->
        <div class=\"modal-footer\">
		  <button type=\"button\" class=\"btn btn-secondary\" onclick=\"editProduct('".$productDetails[0]."');\" >Edit</button>
          <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Cancel</button>
        </div>";
			
		}
		else if($func == "5"){ //EDIT PRODUCT
			$pID = $_POST['pID'];
			$pname = $_POST['pname'];
			$pdesc = $_POST['pdesc'];
			$pquantity = $_POST['pquantity'];
			$pprice = $_POST['pprice'];
			if(isset($_FILES['pimage'])){
				$Photo = $_FILES['pimage'];
				$imageRet = resizeImageMul($Photo, array(array(360,206)));
				$query = "UPDATE `prodtb` SET ph_loc='".$imageRet[1]."' , prod_name='$pname' , prod_desc='$pdesc' , prod_num='$pquantity' ,prod_price='$pprice' WHERE prod_id='$pID'"; 
			}
			else{
				$query = "UPDATE `prodtb` SET prod_name='$pname' , prod_desc='$pdesc' , prod_num='$pquantity' ,prod_price='$pprice' WHERE prod_id='$pID'"; 
			}
			mysqli_query($dbCon, $query);
		}
		else if($func == "6"){ //ADD BARBER
			$bname = $_POST['bname'];
			$Photo = $_FILES['bimage'];
			$imageRet = resizeImageMul($Photo, array(array(360,371)));
			$query = "INSERT INTO `barbtb` (`barb_id`,`ph_loc`,`barb_name`,barb_ON) VALUES (NULL, '".$imageRet[1]."', '$bname','1')"; 
			mysqli_query($dbCon, $query);
		}
		else if($func == "7"){ //TABLE BARBER
			$barbList = getAllBarbDetails();
			
			for($i = 0; $i < count($barbList); $i++){
				echo "<tr>
						<th scope=\"row\">".$barbList[$i][0]."</th>
						 <td><img width=\"50px\" src=\"../uploads/".$barbList[$i][1]."\" </td>
						 <td>".$barbList[$i][2]."</td>
						 <td>".getBarbPendingScheduleCount($barbList[$i][0])."</td>
						 <td>
							<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" onClick=\"getEditBarberDetails('".$barbList[$i][0]."')\" data-target=\"#editProductModal\">
								Schedules
							</button>
							<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" onClick=\"getEditBarberDetails('".$barbList[$i][0]."')\" data-target=\"#editProductModal\">
								Edit
							</button>
							<button type=\"button\" onclick=\"disableBarber('".$barbList[$i][0]."')\" class=\"btn btn-primary\">
								Disable
							</button>
						</td>
					  </tr>";
			}
		}
		else if($func == "8"){ //GET BARBER MODAL EDIT DETAILS
			$bID = $_POST['bID'];
			$barberDetails = getBarberDetails($bID);
			echo "<!-- Modal Header -->
        <div class=\"modal-header\">
          <h4 class=\"modal-title\">EDIT: ".$barberDetails[2]."</h4>
          <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class=\"modal-body\">
					<input type=\"text\" id=\"bnameEDIT\" name=\"bname\" value='".$barberDetails[2]."' placeholder=\"Barber Name\" onfocus=\"this.placeholder = ''\" onblur=\"this.placeholder = 'Barber Name'\" required=\"\" class=\"single-input-accent\">
					
					Photo
					<input type=\"file\" id=\"bimageEDIT\" name=\"bimage\"  required=\"\" class=\"single-input-accent\">
			
        </div>
        <!-- Modal footer -->
        <div class=\"modal-footer\">
		  <button type=\"button\" class=\"btn btn-secondary\" onclick=\"editBarber('".$barberDetails[0]."');\" >Edit</button>
          <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Cancel</button>
        </div>";
			
		}
		else if($func == "9"){ //EDIT BARBER
			$bID = $_POST['bID'];
			$bname = $_POST['bname'];
			if(isset($_FILES['bimage'])){
				$Photo = $_FILES['bimage'];
				$imageRet = resizeImageMul($Photo, array(array(360,371)));
				$query = "UPDATE `barbtb` SET ph_loc='".$imageRet[1]."' , barb_name='$bname' WHERE barb_id='$bID'"; 
			}
			else{
				$query = "UPDATE `barbtb` SET barb_name='$bname' WHERE barb_id='$bID'"; 
			}
			mysqli_query($dbCon, $query);
		}
		else if($func == "10"){ //DISABLE BARBER
			$bID = $_POST['bID'];
			$query = "UPDATE barbtb SET barb_on='0' WHERE barb_id='$bID';";
			mysqli_query($dbCon, $query);
		}
		else if($func == "11"){ //ADD SLIDESHOW
			$stitle = $_POST['stitle'];
			$sdesc = $_POST['sdesc'];
			$Photo = $_FILES['simage'];
			$image_info = getimagesize($Photo["tmp_name"]);
			$imageRet = resizeImageMul($Photo, array(array($image_info[0],$image_info[1])));
			$query = "INSERT INTO `slidestb` (`slide_id`, `ph_loc`, `slides_sup`, `slides_sub`) VALUES (NULL, '".$imageRet[1]."', '$stitle', '$sdesc');";
			mysqli_query($dbCon, $query);
		}
		else if($func == "12"){ //SLIDESHARE TABLE
			$slideList = getAllSlideDetails();
			
			for($i = 0; $i < count($slideList); $i++){
				echo "<div class=\"col-sm-4 border\" style='text-align:center;min-width:378px;' >
						  <img src=\"../uploads/".$slideList[$i][1]."\" class=\"rounded\" alt=\"SlideShare Photo\" width=\"350\"  height=\"350\" > 
						  <input type=\"text\" class=\"form-control\" value=\"".$slideList[$i][2]."\"placeholder=\"Slide Title (Optional)\" id=\"stitleEDIT".$slideList[$i][0]."\">
						  <textarea class=\"form-control\" placeholder=\"Slide Description (Optional)\" id=\"sdescEDIT".$slideList[$i][0]."\">".$slideList[$i][3]."</textarea>
						  <input type=\"file\" class=\"form-control\" id=\"simageEDIT".$slideList[$i][0]."\">
							<button type=\"button\" onclick=\"editSlide(".$slideList[$i][0].")\" style=\"color:white;\" class=\"btn btn-warning\">EDIT</button>
							<button type=\"button\" onclick=\"removeSlide(".$slideList[$i][0].")\" style=\"color:white;\" class=\"btn btn-warning\">REMOVE</button>
					  </div>";
			}
			echo "<div class=\"col-sm-4 border\" style='text-align:center;min-width:378px;' >
					  <h1 style=\"font-weight: bold;\">ADD A SLIDESHOW<h1>
					  <input type=\"text\" class=\"form-control\" placeholder=\"Slide Title (Optional)\" id=\"stitleADD\">
					  <textarea class=\"form-control\" placeholder=\"Slide Description (Optional)\" id=\"sdescADD\"></textarea>
					  <input type=\"file\" class=\"form-control\" id=\"simageADD\">
						<button onclick=\"addSlideshare();\" type=\"button\" style=\"color:white;\" class=\"btn btn-warning\">ADD</button>
					</div>";
		}
		else if($func == "13"){ //EDIT SLIDESHOW
			$sID = $_POST['sID'];
			$stitle = $_POST['stitle'];
			$sdesc = $_POST['sdesc'];
			
			if(isset($_FILES['simage'])){
				$Photo = $_FILES['simage'];
				$image_info = getimagesize($Photo["tmp_name"]);
				$imageRet = resizeImageMul($Photo, array(array($image_info[0],$image_info[1])));
				$query = "UPDATE `slidestb` SET ph_loc='".$imageRet[1]."',slides_sup='$stitle',slides_sub='$sdesc' WHERE slide_id='$sID'"; 
			}
			else{
				$query = "UPDATE `slidestb` SET slides_sup='$stitle',slides_sub='$sdesc' WHERE slide_id='$sID'"; 
			}
			mysqli_query($dbCon, $query);
		}
		else if($func == "14"){ //REMOVE SLIDESHOW
			$sID = $_POST['sID'];
			$query = "DELETE FROM slidestb WHERE slide_id='$sID';";
			mysqli_query($dbCon, $query);
		}
	}
	

?>