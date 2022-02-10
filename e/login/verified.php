<?php
include('../database_connection.php');
session_start();
date_default_timezone_set("Asia/Manila");
function checkAccountValid($loginData,$text){ include('../database_connection.php');
	$query = "SELECT ac_id FROM accountstb WHERE ac_password ='$text' AND (ac_email='$loginData' OR ac_username='$loginData') AND ac_status='1'";
	return mysqli_fetch_array(mysqli_query($dbCon, $query))['0'];
}

function getValidAccountDetails($id){ include('../database_connection.php');
	$query = "SELECT * FROM accountstb WHERE  ac_id ='$id' AND ac_status='1'";
	$result = mysqli_query($dbCon, $query);
	$data = array();
	while($row = mysqli_fetch_array($result)){
		$data[0] = $row['ac_name'];
		$data[1] = $row['ac_id'];
		$data[2] = $row['act_rank'];
	}
	return $data;
}

function checkAccountAvailability($name,$phone,$email){ include('../database_connection.php');
	$query = "SELECT count(*) FROM accountstb WHERE ac_name='$name' OR ac_username ='$phone' OR ac_email='$email'";
	return mysqli_fetch_array(mysqli_query($dbCon, $query))['0'];
}

if(isset($_POST['submitSI'])){
	$dataLogin = $_POST['user-EmailMobile'];
	$pass = crypt($_POST['user-pass'], $salt);
	$check= checkAccountValid($dataLogin,$pass);
	if($check>=1){
		$data = getValidAccountDetails($check);
		$_SESSION['userNameECOM'] = $data[0];
		$_SESSION['userIDECOM'] = $data[1];
		$_SESSION['userRankECOM'] = $data[2];
		header("location: ../");
	}
	else{
		header("location: ./");
	}
	
}
else if(isset($_POST['submitSU'])){
	$name = $_POST['user-name'];
	$phone = $_POST['user-phone'];
	$email = $_POST['user-email'];
	$pass = $_POST['user-pass'];
	$check = checkAccountAvailability($name,$phone,$email);
	if($check<1&&$pass==$_POST['user-repass']){
		  $cDate = date("Y-m-d");
		  $pass = crypt($pass, $salt);
		  $query = "INSERT INTO accountstb (ac_name,ac_username,ac_email,ac_password,ac_status,act_rank) VALUES ('$name','$phone','$email','$pass','1','2')";
	      mysqli_query($dbCon, $query);
		  $query = "INSERT INTO `inboxtb` (`inbox_id`, `ac_id`, `inbox_sender`, `inbox_desc`, `inbox_date`, `inbox_stat`) VALUES (NULL, '".($dbCon->insert_id)."', 'System:', 'Welcome new user!', '$cDate', '0');";
	      mysqli_query($dbCon, $query);
		  
	}
	header("location: ./");
}
?>