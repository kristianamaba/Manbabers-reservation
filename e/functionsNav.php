<?php
include('./database_connection.php');
session_start();


	

function CheckIfAccountExist(){
	if(isset($_SESSION['userNameECOM'])&&isset($_SESSION['userIDECOM'])&&isset($_SESSION['userRankECOM']))
		return true;
	else
		return false;
}

function checkCartNumber(){ include('./database_connection.php');
	$aID = $_SESSION['userIDECOM'];
	$query = "SELECT count(*) FROM orderstb A,prodtb B WHERE A.ac_id='$aID' AND A.prod_id=B.prod_id AND A.order_stat='0' AND B.prod_on='1'";
	return mysqli_fetch_array(mysqli_query($dbCon, $query))['0'];
}

function checkUnreadInbox(){ include('./database_connection.php');
	$aID = $_SESSION['userIDECOM'];
	$query = "SELECT * FROM inboxtb WHERE ac_id='$aID' AND inbox_stat='0' ORDER BY inbox_date DESC";
	$result = mysqli_query($dbCon, $query);
	$data = array();
	$i = 0;
	while($row = mysqli_fetch_array($result)){
		$data[$i][0] = $row['inbox_id'];
		$data[$i][1] = $row['inbox_sender'];
		$data[$i][2] = $row['inbox_desc'];
		$i++;
	}
	return $data;
}

function checkAllInbox(){ include('./database_connection.php');
	$aID = $_SESSION['userIDECOM'];
	$query = "SELECT * FROM inboxtb WHERE ac_id='$aID' ORDER BY inbox_date DESC";
	$result = mysqli_query($dbCon, $query);
	$data = array();
	$i = 0;
	while($row = mysqli_fetch_array($result)){
		$data[$i][0] = $row['inbox_id'];
		$data[$i][1] = $row['inbox_sender'];
		$data[$i][2] = $row['inbox_desc'];
		$data[$i][3] = $row['inbox_stat'];
		$data[$i][4] = $row['inbox_date'];
		$i++;
	}
	return $data;
}

function getInboxDetails($iID){ include('./database_connection.php');
	$aID = $_SESSION['userIDECOM'];
	$query = "SELECT * FROM inboxtb WHERE ac_id='$aID' AND inbox_id='$iID'";
	$result = mysqli_query($dbCon, $query);
	$data = array();
	while($row = mysqli_fetch_array($result)){
		$data[0] = $row['inbox_id'];
		$data[1] = $row['inbox_sender'];
		$data[2] = $row['inbox_desc'];
		$data[3] = $row['inbox_date'];
	}
	readInbox($aID,$iID);
	return $data;
}

function readInbox($aID,$iID){ include('./database_connection.php');
	$query = "UPDATE inboxtb SET `inbox_stat` = '1' WHERE ac_id='$aID' AND inbox_id='$iID'";
	mysqli_query($dbCon, $query);
}

function ifMessLong($text){
	if( strlen($text)>40)
		return substr($text, 0, -(strlen($text)-40))."...";
	else
		return $text;
}

if(isset($_POST['func'])){
	$func = $_POST['func'];
	
		if($func == "1"){ //NAV BAR CHANGE
		$tempString = "<li><a href=\"Home\">Home</a></li>
							<li><a href=\"Home#Contacts\">Contact</a></li>
                                <li><a href=\"Home#Products\">Products</a></li>";
			if(CheckIfAccountExist()){
				$unreadInbox = checkUnreadInbox();
				$tempString .= "<li><a href=\"Inbox\">Inbox &nbsp <span class=\"badge badge-danger\">".count($unreadInbox)."</span></a> 
                                            <ul class=\"submenu\">";
				
				for($i = 0; $i < count($unreadInbox); $i++){
					$tempString .= "<li><a href=\"#\" onClick=\"viewInboxMessage('".$unreadInbox[$i][0]."')\" data-toggle=\"modal\" data-target=\"#modalDialog\"><h4>"
					.$unreadInbox[$i][1].":</h4>".ifMessLong($unreadInbox[$i][2])."</a></li>";
				}
				
				
				$tempString .= "<li><a href=\"Inbox\">View All Messages</a></li>
                                            </ul>
                                        </li>
										
                                        <li><a href=\"MyAccount\">My Account</a>
                                            <ul class=\"submenu\">
											<li><a href=\"MyAccount?Cart\">User Cart &nbsp <span class=\"badge badge-danger\">".checkCartNumber()."</span></a></li>
												<li><a href=\"MyAccount?History\">Account History</a></li>
                                                <li><a href=\"MyAccount?Settings\">Change Settings</a></li>
												<li><a href=\"logout\">Logout</a></li>
                                            </ul>
                                        </li>";
				echo $tempString;
				
                                                
			}
			else{
				echo $tempString."<li><a href=\"#\" onclick=\"location.href='login/';return false;\">Login</a></li>";
			}
		}
		
		else if($func == "2"){ //MODAL VIEW MESSAGE
			$iID = $_POST['iID'];
			$inboxDetails = getInboxDetails($iID);
			echo "<!-- Modal Header -->
        <div class=\"modal-header\">
          <h4 class=\"modal-title\">From: ".$inboxDetails[1]." &nbsp &nbsp (".date("F j, Y", strtotime($inboxDetails[3])).")</h4> 
          <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class=\"modal-body\">
			".$inboxDetails[2]."
        </div>
        <!-- Modal footer -->
        <div class=\"modal-footer\">
          <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>
        </div>";
		}
		
		else if($func == "3"){ //NAV BAR CHANGE
		
		$tempString = "<div class=\"slicknav_menu\">
		<a href=\"#\" aria-haspopup=\"true\" role=\"button\" tabindex=\"0\" onClick=\"hideUnhide();\" class=\"slicknav_btn slicknav_collapsed\" style=\"outline: currentcolor none medium;\">
		<span class=\"slicknav_menutxt\">MENU</span>
		<span class=\"slicknav_icon\">
		<span class=\"slicknav_icon-bar\"></span>
		<span class=\"slicknav_icon-bar\"></span>
		<span class=\"slicknav_icon-bar\"></span></span>
		
		</a><ul class=\"slicknav_nav slicknav_hidden\" id=\"mobileNavHide\" style=\"display:none;\" aria-hidden=\"true\" role=\"menu\">
		
							<li><a href=\"Home\" role=\"menuitem\" tabindex=\"0\">Home</a></li>
							<li><a href=\"Home#Contacts\" role=\"menuitem\" tabindex=\"0\">Contact</a></li>
                            <li><a href=\"Home#Products\" role=\"menuitem\" tabindex=\"0\">Products</a></li>";
			if(CheckIfAccountExist()){
				$unreadInbox = checkUnreadInbox();
				$tempString .= "<li><a href=\"Inbox\" role=\"menuitem\" tabindex=\"0\">Inbox &nbsp; <span class=\"badge badge-danger\">".count($unreadInbox)."</span></a> </li>";
				
				$tempString .= "<li><a href=\"MyAccount\" role=\"menuitem\" tabindex=\"0\">My Account</a></li>

										<li><a href=\"logout\" role=\"menuitem\" tabindex=\"0\">Logout</a></li>
										
										</ul></div>";
				echo $tempString;
				
                                                
			}
			else{
				echo $tempString."<li><a href=\"login/\" role=\"menuitem\" tabindex=\"0\">Login</a></li>
										</ul></div>";
			}
		}
	
		else if($func == "4"){
			if(CheckIfAccountExist())
				echo "1";
			else
				echo "0";
		}
	
		else if($func == "5"){
			
			$allInbox = checkAllInbox();
				
				for($i = 0; $i < count($allInbox); $i++){
					echo "<tr ".($allInbox[$i][3]=="0" ? "style=\"background-color: #D3D3D3 !important;\"":"").">
                          <td class=\"mailbox-star\"></td>
                          <td class=\"mailbox-name\"><a onClick=\"viewInboxMessage('".$allInbox[$i][0]."')\" data-toggle=\"modal\" data-target=\"#modalDialog\">
							".$allInbox[$i][1]."
						  </a></td>
                          <td class=\"mailbox-subject\"><a  href=\"#\" onClick=\"viewInboxMessage('".$allInbox[$i][0]."')\" data-toggle=\"modal\" data-target=\"#modalDialog\">
							 ".ifMessLong($allInbox[$i][2])."
						  </a></td>
                          <td class=\"mailbox-attachment\"></td>
                          <td class=\"mailbox-date\">".date("F j, Y", strtotime($allInbox[$i][4]))."</td>
                        </tr>";
					
					
				}
				

		}
	}
	

?>