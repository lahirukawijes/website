<?php 
	session_start();
	
	$db = mysqli_connect('localhost', 'root', '', 'multi_login');

// initialize variables
	$JobCode = "";
	$position = "";
	$ClosingDate = "";
	$description = "";
	$update = false;
	$delete = false;
	$JobCode = "";
	
//save function
	if (isset($_POST['save'])) {
		$JobCode = $_POST['JobCode'];
		$position = $_POST['position'];
		$ClosingDate = $_POST['ClosingDate'];
		$description = $_POST['description'];

		$result = mysqli_query($db, "INSERT INTO vacancies (JobCode, position,ClosingDate,description) VALUES ('$JobCode', '$position','$ClosingDate','$description')");
		$_SESSION['message'] = "Vacancy saved";

		header('location: vacancies.php');
	}
	
//update function
	if (isset($_POST['update'])) {
		$JobCode = $_POST['JobCode'];
		$position = $_POST['position'];
		$ClosingDate = $_POST['ClosingDate'];
		$description = $_POST['description'];
        $update = false;
	
		mysqli_query($db, "UPDATE vacancies SET position='$position',ClosingDate='$ClosingDate',description='$description' WHERE JobCode='$JobCode'");
		$_SESSION['message'] = "Vacancy updated!"; 
		header('location: vacancies.php');
	}
	
//delete function
	if (isset($_POST['del'])) {
        $JobCode = $_POST['JobCode'];
        $delete = false;

		mysqli_query($db, "DELETE FROM vacancies WHERE JobCode='$JobCode'");
		$_SESSION['message'] = "Vacancy deleted!"; 
		header('location: vacancies.php');
	}

