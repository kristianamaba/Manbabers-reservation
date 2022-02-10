<?php
include('../database_connection.php');
session_start();

function checkAccountValid($loginData,$text){ include('../database_connection.php');
	$query = "SELECT user_id FROM usertbl WHERE user_pass ='$text' AND (user_email='$loginData' OR user_mobile='$loginData') AND status='1'";
	return mysqli_fetch_array(mysqli_query($dbCon, $query))['0'];
}

function getValidAccountDetails($id){ include('../database_connection.php');
	$query = "SELECT user_id,user_name,rank_id,building_id FROM usertbl WHERE  user_id ='$id' AND status='1'";
	$result = mysqli_query($dbCon, $query);
	$data = array();
	while($row = mysqli_fetch_array($result)){
		$data[0] = $row['user_name'];
		$data[1] = $row['user_id'];
		$data[2] = $row['rank_id'];
		$data[3] = $row['building_id'];
	}
	return $data;
}

function checkAccountAvailability($name,$phone,$email){ include('../database_connection.php');
	$query = "SELECT count(*) FROM usertbl WHERE user_name='$name' OR user_mobile ='$phone' OR user_email='$email'";
	return mysqli_fetch_array(mysqli_query($dbCon, $query))['0'];
}

if(isset($_POST['submitSI'])){
	$dataLogin = $_POST['user-EmailMobile'];
	$pass = crypt($_POST['user-pass'], $salt);
	$check= checkAccountValid($dataLogin,$pass);
	if($check>=1){
		$data = getValidAccountDetails($check);
		$_SESSION['userNameQBIC'] = $data[0];
		$_SESSION['userIdQBIC'] = $data[1];
		$_SESSION['userRankQBIC'] = $data[2];
		$_SESSION['userBuildingQBIC'] = $data[3];
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
		  $pass = crypt($pass, $salt);
		  $query = "INSERT INTO usertbl (user_name,user_mobile,user_email,user_pass) VALUES ('$name','$phone','$email','$pass')";
	      mysqli_query($dbCon, $query);
	}
	header("location: ./");
}
?>