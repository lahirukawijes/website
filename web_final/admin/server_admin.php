<?php 
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'multi_login');

// initialize variables
	$username = "";
	$address = "";
	$email = "";
	$tel = "";
	$gender = "";
	$user_type = "";
	$id = 0;
	$update = false;
	
//save function
	if (isset($_POST['save'])) {
		$username = $_POST['username'];
		$address = $_POST['address'];
		$email = $_POST['email'];
		$tel = $_POST['tel'];
		$gender = $_POST['gender'];
		$user_type = $_POST['user_type'];
		
		mysqli_query($db, "INSERT INTO users (username, address,email,tel,gender,user_type) VALUES ('$username', '$address','$email','$tel','$gender','$user_type')"); 
		$_SESSION['message'] = "Record saved"; 
		header('location: profile_admin.php');
	}
//update function
if (isset($_POST['update'])) {
		$id = $_POST['id'];
		$username = $_POST['username'];
		$address = $_POST['address'];
		$email = $_POST['email'];
		$tel = $_POST['tel'];
		$gender = $_POST['gender'];
		$user_type = $_POST['user_type'];
	
		mysqli_query($db, "UPDATE users SET username='$username', address='$address',email='$email',tel='$tel',gender='$gender',user_type='$user_type' WHERE id=$id");
		$_SESSION['message'] = "Record updated!"; 
		header('location: profile_admin.php');
	}
	
//delete function
	if (isset($_GET['del'])) {
		$id = $_GET['del'];
		mysqli_query($db, "DELETE FROM users WHERE id=$id");
		$_SESSION['message'] = "Record deleted!"; 
		header('location: profile_admin.php');
	}