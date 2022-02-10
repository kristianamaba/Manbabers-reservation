<?php
include('../database_connection.php');
session_start();
function checkAccountValid($text){ include('../database_connection.php');
	$query = "SELECT count(*) FROM accountstb WHERE ac_username ='$text' OR ac_email='$text'  AND ac_status ='1'";
	return mysqli_fetch_array(mysqli_query($dbCon, $query))['0'];
}

function checkAccountValidPass($text,$loginData){ include('../database_connection.php');
	$query = "SELECT count(*) FROM accountstb WHERE ac_password ='$text' AND (ac_email='$loginData' OR ac_username='$loginData')  AND ac_status ='1'";
	return mysqli_fetch_array(mysqli_query($dbCon, $query))['0'];
}

function checkUserName($text){ include('../database_connection.php');
	$query = "SELECT count(*) FROM accountstb WHERE ac_username='$text'";
	return mysqli_fetch_array(mysqli_query($dbCon, $query))['0'];
}

function checkEmail($text){ include('../database_connection.php');
	$query = "SELECT count(*) FROM accountstb WHERE ac_email='$text'";
	return mysqli_fetch_array(mysqli_query($dbCon, $query))['0'];
}
function checkMobile($text){ include('../database_connection.php');
	$query = "SELECT count(*) FROM accountstb WHERE ac_username='$text'";
	return mysqli_fetch_array(mysqli_query($dbCon, $query))['0'];
}

if(isset($_POST['loginData'])&&isset($_POST['pass'])){
	
	$loginData = $_POST['loginData'];
	$pass = crypt($_POST['pass'], $salt);
	$check = checkAccountValidPass($pass,$loginData);
	if($check==0){
			echo '<div class="alert alert-danger">
			  <strong>Warning!</strong> Invalid Account Password/Username.
			</div>';
	}
}

else if(isset($_POST['num'])&&isset($_POST['text'])){
	$text = $_POST['text'];
	$numFunction = $_POST['num'];
	if($numFunction==1){
		$checkUserName = checkUserName($text);
		if($checkUserName>=1){
			echo '<div class="alert alert-danger">
			  <strong>Warning!</strong> Username is already exist.
			</div>';
		}
	}

	else if($numFunction==2){
		$checkMobile = checkMobile($text);
		if($checkMobile>=1){
			echo '<div class="alert alert-danger">
			  <strong>Warning!</strong> Phone Number is already exist.
			</div>';
		}
	}
		else if($numFunction==3){
		$checkEmail = checkEmail($text);
		if($checkEmail>=1){
			echo '<div class="alert alert-danger">
			  <strong>Warning!</strong> Email is already exist.
			</div>';
		}
	}
	else if($numFunction==4){
		$checkAccountValid = checkAccountValid($text);
		if($checkAccountValid==0){
			echo '<div class="alert alert-danger">
			  <strong>Warning!</strong> No account associated with the entered input.
			</div>';
		}
	}
	
}

?>