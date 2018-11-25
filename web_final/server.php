<?php 
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'multi_login');

// initialize variables
	$username = "";
	$address = "";
	$email = "";
	$tel = "";
	$gender = "";
	$id = 0;
	$update = false;
	
//save function
	if (isset($_POST['save'])) {
		$username = $_POST['username'];
		$address = $_POST['address'];
		$email = $_POST['email'];
		$tel = $_POST['tel'];
		$gender = $_POST['gender'];

		mysqli_query($db, "INSERT INTO users (username, address,email,tel,gender) VALUES ('$username', '$address','$email','$tel','$gender')"); 
		$_SESSION['message'] = "Record saved"; 
		header('location: profile.php');
	}
	
//update function	
	if (isset($_POST['update'])) {
		$id = $_POST['id'];
		$username = $_POST['username'];
		$address = $_POST['address'];
		$email = $_POST['email'];
		$tel = $_POST['tel'];
		$gender = $_POST['gender'];
	
		mysqli_query($db, "UPDATE users SET username='$username', address='$address',email='$email',tel='$tel',gender='$gender' WHERE id=$id");
		$_SESSION['message'] = "Record updated!"; 
		header('location: profile.php');
	}
	
//delete function
	if (isset($_GET['del'])) {
		$id = $_GET['del'];
		mysqli_query($db, "DELETE FROM users WHERE id=$id");
		$_SESSION['message'] = "Record deleted!"; 
		header('location: profile.php');
	}

//Apply function
    if (isset($_GET['apply'])) {
	    $id = $_SESSION['user_id'];
        $jobCode = $_GET['apply'];
        mysqli_query($db, "INSERT INTO apply_details(id, JobCode) VALUES ('$id','$jobCode')");
        $_SESSION['message'] = "Insert Successful!";
        header('location: user_vaca.php');
    }
//Remove function
if (isset($_GET['remv'])) {
    $apply_id = $_GET['remv'];
    mysqli_query($db, "DELETE FROM apply_details where apply_id = '$apply_id'");
    $_SESSION['message'] = "Application Removed.";
    header('location: user_vaca.php');
}