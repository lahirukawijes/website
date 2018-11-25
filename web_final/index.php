<?php 
	include('functions.php');
	if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<!--header-->
	<div class="header">
		<h2>Home Page</h2>
        <!-- logged in user information -->
		<div class="profile_info">
			<div>
            	<img src="images/user_profile.png"  >
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>
					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
						<a href="index.php?logout='1'" style="color: #2D1353;">Logout</a>
                        <a href="profile.php" style="color: #2D1353;">Edit your Profile</a>
                         &nbsp;<a href="user_vaca.php" style="color: #2D1353;">Vacancies</a>
					</small>
				<?php endif ?>
			</div>          
		</div>
	</div>
    <!--end of header-->
    
	<div class="content">
		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>
	</div>
</body>
</html>