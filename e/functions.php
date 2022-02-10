<?php
include('./database_connection.php');
session_start();
date_default_timezone_set("Asia/Manila");


function getAllProductDetails(){ include('./database_connection.php');
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

function checkIfProductExistToCart($pID){ include('./database_connection.php');
	$aID = $_SESSION['userIDECOM'];
	$query = "SELECT count(*) FROM orderstb WHERE ac_id='$aID' AND prod_id='$pID' AND order_stat='0'";
	return mysqli_fetch_array(mysqli_query($dbCon, $query))['0'];
}

function getAllInCart(){ include('./database_connection.php');
	$aID = $_SESSION['userIDECOM'];
	$query = "SELECT * FROM `orderstb` A,`prodtb` B WHERE A.prod_id=B.prod_id AND A.ac_id='$aID' AND A.order_stat='0' AND B.prod_on='1'";
	$result = mysqli_query($dbCon, $query);
	$data = array();
	$i = 0;
	while($row = mysqli_fetch_array($result)){
		$data[$i][0] = $row['order_id'];
		$data[$i][1] = $row['prod_quantity'];
		$data[$i][2] = $row['prod_name'];
		$data[$i][3] = $row['prod_num'];
		$data[$i][4] = $row['prod_price'];
		$data[$i][5] = $row['ph_loc'];
		$i++;
	}
	return $data;
}

function getAllTransaction(){ include('./database_connection.php');
	$aID = $_SESSION['userIDECOM'];
	$query = "SELECT * FROM `transactb` WHERE ac_id='$aID' ORDER BY trans_date DESC;";
	$result = mysqli_query($dbCon, $query);
	$data = array();
	$i = 0;
	while($row = mysqli_fetch_array($result)){
		$data[$i][0] = $row['trans_id'];
		$data[$i][1] = $row['trans_type'];
		$data[$i][2] = $row['trans_date'];
		$data[$i][3] = $row['trans_code'];
		$i++;
	}
	return $data;
}

function getOrderDetails($tID){ include('./database_connection.php');
	$aID = $_SESSION['userIDECOM'];
	$query = "SELECT * FROM `orderstb` A,`prodtb` B WHERE A.prod_id=B.prod_id AND A.ac_id='$aID' AND A.trans_id='$tID' AND A.ac_id='$aID'";
	$result = mysqli_query($dbCon, $query);
	$data = array();
	$i = 0;
	while($row = mysqli_fetch_array($result)){
		$data[$i][0] = $row['order_id'];
		$data[$i][1] = $row['prod_quantity'];
		$data[$i][2] = $row['prod_name'];
		$data[$i][3] = $row['prod_num'];
		$data[$i][4] = $row['prod_price'];
		$data[$i][5] = $row['order_stat'];
		
		$i++;
	}
	return $data;
}

function getReservationDetails($tID){ include('./database_connection.php');
	$aID = $_SESSION['userIDECOM'];
	$query = "SELECT * FROM barbschedtb A,barbtb B WHERE A.ac_id='$aID' AND A.trans_id='$tID' AND A.barb_id=B.barb_id";
	$result = mysqli_query($dbCon, $query);
	$data = array();
	while($row = mysqli_fetch_array($result)){
		$data[0] = $row['barbs_id'];
		$data[1] = $row['barbs_hour'];
		$data[2] = $row['barbs_date'];
		$data[3] = $row['barbs_confirm'];
		$data[4] = $row['barb_name'];
	}
	return $data;
}

function createTransaction($tranType){ include('./database_connection.php');
	$dateTime = date("Y-m-d H:i:s");
	$aID = $_SESSION['userIDECOM'];
	$query = "INSERT INTO `transactb` (`trans_id`, `ac_id`, `trans_type`, `trans_date`, `trans_code`) VALUES (NULL, '$aID', '$tranType', '$dateTime', NULL);";
	mysqli_query($dbCon, $query);
	
	$lastID = ($dbCon->insert_id);
	$transCode = "ET".(2000000 + $lastID);
	$query = "UPDATE `transactb` SET `trans_code` = '$transCode' WHERE `transactb`.`trans_id` = '$lastID';";
	mysqli_query($dbCon, $query);
	
	return $lastID;
}

function getAllBarbDetails(){ include('./database_connection.php');
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

function getBarbSchedOnDay($bID,$sbDate){ include('./database_connection.php');
	$query = "SELECT barbs_hour FROM `barbschedtb` A,barbtb B WHERE A.barb_id=B.barb_id AND barbs_date ='$sbDate' AND A.barb_id='$bID' ";
	$result = mysqli_query($dbCon, $query);
	$data = array();
	$i = 0;
	while($row = mysqli_fetch_array($result)){
		$data[$i] = $row['barbs_hour'];
		$i++;
	}
	return $data;
}

function checkIfUserHasSchedule(){ include('./database_connection.php');
	$aID = $_SESSION['userIDECOM'];
	$query = "SELECT count(*) FROM `barbschedtb` WHERE ac_id='$aID' AND barbs_confirm='0'";
	return mysqli_fetch_array(mysqli_query($dbCon, $query))['0'];
}

if(isset($_POST['func'])){
	$func = $_POST['func'];
	
		if($func == "1"){ //PRODUCT TABLES
			$prodList = getAllProductDetails();
			
			for($i = 0; $i < count($prodList); $i++){
				echo "<div class=\"col-xl-4 col-lg-4 col-md-6\">
                        <!-- Single Blog -->
                        <div class=\"single-blog mb-30\">
                            <div class=\"blog-img\">
                                <a href=\"#\"><img src=\"uploads/".$prodList[$i][1]."\" alt=\"\"></a>
                            </div>
                            <div class=\"blog-caption\">
								<div class=\"blog-cap-top d-flex justify-content-between mb-40\" >
                                    <span>".$prodList[$i][2]."</span>
                                </div>
                                <div class=\"blog-cap-top d-flex justify-content-between mb-40\">
                                    <ul><li style='color:red;'>₱ ".$prodList[$i][5].".00 </li></ul>
									
                                    <ul><li style='color:orange;'>Stocks: ".$prodList[$i][4]."</li></ul>
                                </div>
                                <div class=\"blog-cap-mid\">
                                    <p>".$prodList[$i][3]."
									</p>
                                </div>
                                <!-- Comments -->
                                <div class=\"text-center\">
                                    
										<a style=\"color:white;\" onClick=\"".($prodList[$i][2]<=0?"addProductUser('".$prodList[$i][0]."')":"alert('No Stocks Left!');")."\" class=\"btn select-btn \">Add to Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>";
			}
		}
		else if($func == "2"){ // ADD PRODUCT USER
			$pID = $_POST['pID'];
			if(checkIfProductExistToCart($pID)==0){
				$aID = $_SESSION['userIDECOM'];
				$query = "INSERT INTO `orderstb` (`order_id`, `prod_id`, `ac_id`, `trans_id`, `order_stat`, `prod_quantity`, `order_date`) VALUES (NULL, '$pID', '$aID', NULL, '0', '1', NULL);";
				$result = mysqli_query($dbCon, $query);
				echo "Successfully added to Cart!";
			}
			else{
				echo "Product Already Exist in the Cart!";
			}
			
		}
		else if($func == "3"){ //GET CART TABLE
			$cartT = "<thead>
									<tr>
										<th style=\"width:40%\">Product</th>
										<th style=\"width:10%\">Price</th>
										<th style=\"width:8%\">Quantity</th>
										<th style=\"width:20%\" class=\"text-center\">Subtotal</th>
										<th style=\"width:10%\">Action</th>
									</tr>
								</thead>
								<tbody>";
			$cartData = getAllInCart();
			$total = 0;
				for($i = 0; $i < count($cartData); $i++){
					$pNum = (($cartData[$i][1]<$cartData[$i][3])? $cartData[$i][1] : $cartData[$i][3]);
							$cartT .= "<tr>
										<td data-th=\"Product\">
											<div class=\"row\">
												<div class=\"col-sm-2 hidden-xs\"><img src=\"uploads/".$cartData[$i][5]."\" alt=\"...\" class=\"img\"/></div>
												<div class=\"col-sm-10\">
													<h4 class=\"nomargin\">".$cartData[$i][2]."</h4>
													<p>Stocks: ".$cartData[$i][3]."</p>
												</div>
											</div>
										</td>
										<td data-th=\"Price\"><b>₱ <strong id=\"orderPrice".$i."\"> ".$cartData[$i][4]."</strong>.00</b></td>
										<td data-th=\"Quantity\">
											<input type=\"number\" class=\"form-control text-center\" id=\"ordernum".$i."\"  name=\"data[quantity][".$i."]\" value=\"".$pNum."\"
											onkeyup=\"
											var textID = document.getElementById('ordernum".$i."'); 
											var orderTotID = document.getElementById('orderTot".$i."'); 
											var max = ".$cartData[$i][3].";
											var num = textID.value.replace(/\\D/g,''); 
											var price = document.getElementById('orderPrice".$i."').innerHTML;
											if (num>max)
												 textID.value = max; 
											else if (num <= 0)
												textID.value = 1;
											else
												textID.value = num; 
											var orderTotalID = document.getElementById('orderTotal'); 
											var orderTotD = orderTotID.innerHTML;
											
											var subtotal = Number(orderTotalID.innerHTML) - Number(orderTotD) ;
											
											orderTotID.innerHTML = num*price;
											orderTotalID.innerHTML = subtotal+(num*price)  ;
											
											setProductQuantity(".$cartData[$i][0].",textID.value)\">
										</td>
										<td data-th=\"Subtotal\" class=\"text-center\"><b>₱ <strong id=\"orderTot".$i."\"> ".($pNum*$cartData[$i][4])."</strong>.00</b></td>
										<td class=\"actions\" data-th=\"\">
											<button onclick=\"deleteProductOnCart('".$cartData[$i][0]."')\" class=\"btn btn-info btn-sm\">Remove</button>							
										</td>
									</tr>";
									$total += ($pNum*$cartData[$i][4]);
				}
				if(count($cartData)==0)
					echo "<tr><td colspan='6'><h4 style='text-align:center;margin:20px;'><b>NO CURRENT ORDERS</b></h4></td></tr>";

			$cartT .= "</tbody>
								<tfoot>
									<tr>
										<td><a href=\"Home#Products\" class=\"btn btn-warning\"><i class=\"fa fa-angle-left\"></i> Continue Ordering</a></td>
										<td colspan=\"2\" class=\"hidden-xs\"></td>
										<td class=\"hidden-xs text-center\"><b>Total ₱ <strong id=\"orderTotal\"> ".$total."</strong>.00</b></td>
										<td><a style=\"color:white;\" onclick=\"proccessTransactionOnCart();\" class=\"btn btn-success btn-block\">Checkout <i class=\"fa fa-angle-right\"></i></a></td>
									</tr>
								</tfoot>";
			
			echo $cartT;
		}		
		else if($func == "4"){ // CHANGE PRODUCT QUANTITY
			$oID = $_POST['oID'];
			$pNum = $_POST['pNum'];
			$aID = $_SESSION['userIDECOM'];
			$query = "UPDATE `orderstb` SET `prod_quantity`='$pNum' WHERE `order_id`='$oID' AND ac_id='$aID'";
			$result = mysqli_query($dbCon, $query);
		}
		else if($func == "5"){ // REMOVE PRODUCT FROM CART
			$oID = $_POST['oID'];
			$aID = $_SESSION['userIDECOM'];
			$query = "DELETE FROM `orderstb` WHERE `order_id`='$oID' AND ac_id='$aID'";
			$result = mysqli_query($dbCon, $query);
		}
		else if($func == "6"){ // PROCCESS FROM CART, TRANSACTION
			$tID = createTransaction('1');
			$aID = $_SESSION['userIDECOM'];
			$query = "UPDATE orderstb A,prodtb B SET A.order_stat='1',A.trans_id='$tID',B.prod_num=B.prod_num-A.prod_quantity WHERE A.order_stat='0' AND A.prod_id=B.prod_id AND A.ac_id='$aID' AND B.prod_on='1'";
			$result = mysqli_query($dbCon, $query);
			echo "Transaction Complete! Check your Order History";
		}
		else if($func == "7"){//GET TRANSACTION TABLE
			$transactionData = getAllTransaction();
			$textTemp = "";
				$statusText = array("","Pending","Recieved","Canceled");
				$statusTextR = array("","Pending","Done","Canceled");
				for($i = 0; $i < count($transactionData); $i++){
					
					if($transactionData[$i][1] == "1"){
						$cDate = date("Y-m-d H:i:s");
						$totalPrice = 0;
						$prodsInfo = getOrderDetails($transactionData[$i][0]);
						for($u = 0; $u < count($prodsInfo); $u++){
							$textTemp .= "<strong>".$prodsInfo[$u][2]."</strong> 
							<span class=\"badge badge-info customBadge\"> ₱ ".$prodsInfo[$u][4]." </span><br>
										Quantity : ".$prodsInfo[$u][1].", total cost: ₱ ".($prodsInfo[$u][4]*$prodsInfo[$u][1]).".00 
										<hr>";
										$totalPrice += ($prodsInfo[$u][4]*$prodsInfo[$u][1]);
										
						}

						  echo "<div class=\"col-md-12\">
							<div class=\"row\">
							  <div class=\"col-md-12\">".($prodsInfo[0][5]==1&&date('Y-m-d H:i:s', strtotime($transactionData[$i][2]. ' + 5 hours'))>$cDate ? 
							  "<a onclick=\"setCancelTransac('".$transactionData[$i][0]."','1');\"><div style=\"margin-left:5px;\" class=\"float-right\"><label class=\"badge badge-warning customBadge\" style=\"color:white;\">Cancel</label> </div></a>":"")."
							  <div class=\"float-right\"><label class=\"badge badge-info customBadge\">".$statusText[$prodsInfo[0][5]]."</label> </div>
								
								
								<span><strong>Transaction #: ".$transactionData[$i][3]."</strong></span><br>
								Please get your reserved product/s before ".date("F j, Y (g:i a)", strtotime($transactionData[$i][2].' + 5 days'))."<br>
								Total Cost: ₱ $totalPrice.00 <br>
									<div class=\"container\" >
										<hr>".$textTemp."</div>
							  </div>
							  <div class=\"col-md-12\">
								Order made on: ".date("F j, Y (g:i a)", strtotime($transactionData[$i][2]))." by ".$_SESSION['userNameECOM']."
							  </div>
							</div>
						  </div>";
						  
						  $textTemp = "";
					}
					else if($transactionData[$i][1] == "2"){
						$revDetails = getReservationDetails($transactionData[$i][0]);

						  echo "<div class=\"col-md-12\">
							<div class=\"row\">
							  <div class=\"col-md-12\">".($revDetails[3]==0&&date('Y-m-d', strtotime($transactionData[$i][2]. ' + 5 hours'))>$cDate ? 
							  "<a onclick=\"setCancelTransac('".$transactionData[$i][0]."','2');\"><div style=\"margin-left:5px;\" class=\"float-right\"><label class=\"badge badge-warning customBadge\" style=\"color:white;\">Cancel</label> </div></a>":"")."
							  <div class=\"float-right\"><label class=\"badge badge-info customBadge\">".$statusTextR[$revDetails[3]+1]."</label> </div>
								
								
									<span><strong>Transaction #: ".$transactionData[$i][3]."</strong></span><br>
									
									Haircut Reservation on ".date("F j, Y", strtotime($revDetails[2]))." (".($revDetails[1]>12 ? ($revDetails[1]-12)." pm": $revDetails[1]." am").")<br>
									Barber: ".$revDetails[4]."<br>
									Total Cost: ₱ 130.00 <br>
									<hr>
							  </div>
							  <div class=\"col-md-12\">
								Reservation made on: ".date("F j, Y (g:i a)", strtotime($transactionData[$i][2]))." by ".$_SESSION['userNameECOM']."
							  </div>
							</div>
						  </div>";
						  
						  $textTemp = "";
					}
				}
			echo $textTemp;
			
		}
		else if($func == "8"){ // SAVE DATA TO SESSION (RESERVATION)
			$_SESSION['sBDate'] = $_POST['sBDate'];
			$_SESSION['sBTime'] = $_POST['sBTime'];
			$_SESSION['sBType'] = $_POST['sBType'];
		}
		else if($func == "9"){ //GET BARBER LIST TO SHOW
			$barbData = getAllBarbDetails();
			echo "<div class=\"col-xl-4 col-lg-6 col-md-6\">
                        <!-- Single Room -->
						<a onClick=\"selectBarb('0','')\">
                        <div id=\"barb0\" class=\"single-room mb-50 border-0\">
                            <div class=\"room-img\">
                               <img src=\"uploads/randomBarb.jpg\" alt=\"\">
                            </div>
                            <div class=\"room-caption\" style=\"text-align:center;\">
                                <h3>Random</h3>
                            </div>
                        </div>
						</a>
                    </div>";
			
			for($i = 0; $i < count($barbData); $i++){
				echo "<div class=\"col-xl-4 col-lg-6 col-md-6\">
                        <!-- Single Room -->
						<a onClick=\"selectBarb('".$barbData[$i][0]."','".$barbData[$i][2]."')\">
                        <div id=\"barb".$barbData[$i][0]."\" class=\"single-room mb-50 border-0\">
                            <div class=\"room-img\">
                               <img src=\"uploads/".$barbData[$i][1]."\" alt=\"\">
                            </div>
                            <div class=\"room-caption\" style=\"text-align:center;\">
                                <h3>".$barbData[$i][2]."</h3>
                            </div>
                        </div>
						</a>
                    </div>";
			}
		}
		else if($func == "10"){ //HOUR AVAILABLE
			$sBDate = $_POST['sBDate'];
			$bID = $_POST['bID'];
			$sType = $_POST['sType'];
			if($sType == "0"){
				echo "<a class=\"dropdown-item\" href=\"#\" onClick=\"selectTime('9','9 am');\">9 am</a>
                                <a class=\"dropdown-item\" href=\"#\" onClick=\"selectTime('10','10 am');\">10 am</a>
                                <a class=\"dropdown-item\" href=\"#\" onClick=\"selectTime('11','11 am');\">11 am</a>
                                <a class=\"dropdown-item\" href=\"#\" onClick=\"selectTime('12','12 pm');\">12 pm</a>
								<a class=\"dropdown-item\" href=\"#\" onClick=\"selectTime('13','1 pm');\">1 pm</a>
                                <a class=\"dropdown-item\" href=\"#\" onClick=\"selectTime('14','2 pm');\">2 pm</a>
                                <a class=\"dropdown-item\" href=\"#\" onClick=\"selectTime('15','3 pm');\">3 pm</a>
                                <a class=\"dropdown-item\" href=\"#\" onClick=\"selectTime('16','4 pm');\">4 pm</a>
								<a class=\"dropdown-item\" href=\"#\" onClick=\"selectTime('17','5 pm');\">5 pm</a>
                                <a class=\"dropdown-item\" href=\"#\" onClick=\"selectTime('18','6 pm');\">6 pm</a>
                                <a class=\"dropdown-item\" href=\"#\" onClick=\"selectTime('19','7 pm');\">7 pm</a>
                                <a class=\"dropdown-item\" href=\"#\" onClick=\"selectTime('20','8 pm');\">8 pm</a>
								<a class=\"dropdown-item\" href=\"#\" onClick=\"selectTime('21','9 pm');\">9 pm</a>
                                <a class=\"dropdown-item\" href=\"#\" onClick=\"selectTime('22','10 pm');\">10 pm</a>
                                <a class=\"dropdown-item\" href=\"#\" onClick=\"selectTime('23','11 pm');\">11 pm</a>";
			}
			else if($sType == "1"){
				$BookedTime = getBarbSchedOnDay($bID,$sBDate);
				for($i = 9; $i < 24; $i++){
					if(checkIfAvailable($BookedTime,$i)){
						echo "<a class=\"dropdown-item\" href=\"#\" onClick=\"selectTime('".$i."','".($i>12 ? ($i-12). " pm" : $i. " am")."');\">".($i>12 ? ($i-12). " pm" : $i. " am")."</a>";
					}
				}
			}
		}
		else if($func == "11"){ //HOUR AVAILABLE TEXT AND VALUE
			$sBDate = $_POST['sBDate'];
			$bID = $_POST['bID'];
			$sType = $_POST['sType'];
			if($sType == "0"){
				echo json_encode(array("9 am","9"));
			}
			else if($sType == "1"){
				$BookedTime = getBarbSchedOnDay($bID,$sBDate);
				if(count($BookedTime)<15){
					$time = getFirst($BookedTime);
					echo json_encode(array(($time>12 ? ($time-12). " pm" : $time. " am"),$time));
				}
				else{
					echo json_encode(array("Fullybooked!","0"));
				}
			}
		}
		else if($func == "12"){ //RESERVE BUTTON
			if(checkIfUserHasSchedule()<1){
				$aID = $_SESSION['userIDECOM'];
				$sBDate = $_POST['sBDate'];
				$bID = $_POST['bID'];
				$sTime = $_POST['sTime'];
				$tID = createTransaction('2');
				$query = "INSERT INTO `barbschedtb` (`barbs_id`, `barb_id`, `ac_id`, `barbs_hour`, `barbs_date`, `barbs_confirm`,trans_id) VALUES (NULL, '$bID', '$aID', '$sTime', '$sBDate', '0','$tID');";
				$result = mysqli_query($dbCon, $query);
				echo "Reservation Done";
			}
			else{
				echo "You have an active reservation, cancel it in order to reserve again at your account.";
			}
		}
		else if($func == "13"){ //CANCEL TRANSACTION
			$aID = $_SESSION['userIDECOM'];
			$tID = $_POST['tID'];
			$tType = $_POST['tType'];
			if($tType=="1")
				$query = "UPDATE orderstb A,prodtb B SET A.order_stat='3',B.prod_num=B.prod_num-A.prod_quantity WHERE A.trans_id='$tID' AND A.ac_id='$aID';";
			else if($tType=="2")
				$query = "UPDATE `barbschedtb` SET barbs_confirm='2' WHERE trans_id='$tID' AND ac_id='$aID';";
			
			$result = mysqli_query($dbCon, $query);
		}
		else if($func == "14"){ //CHANGE SETTINGS
			$aID = $_SESSION['userIDECOM'];
			$toChange = $_POST['toChange'];
			$type = $_POST['type'];
			$tCol = array("ac_email","ac_username","ac_password");
			if($type>0&&$type<4){
				$toChange = ($type==3 ? crypt($toChange, $salt):$toChange);
				$query = "UPDATE `accountstb` SET ".$tCol[$type-1]."='".$toChange."' WHERE ac_id='$aID';";
				$result = mysqli_query($dbCon, $query);
				echo "Successfully change Settings";
			}
		}
		
	}
	
	function getFirst($BookedTime){
		for($i = 9; $i < 24; $i++){
			if(checkIfAvailable($BookedTime,$i)){
				return $i;
			}
		}
		return "0";
	}
	
	function checkIfAvailable($BookedTime,$hour){
		for($i = 0; $i < count($BookedTime); $i++)
			if($BookedTime[$i]==$hour)
				return false;
		return true;
	}
	

?>