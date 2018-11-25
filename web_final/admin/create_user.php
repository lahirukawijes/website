<?php include('../functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Create user</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
	<style>
		.header {
			background: #003366;
		}
		button[name=register_btn] {
			background: #003366;
		}
	</style>
</head>
<body>
	<div class="header">
		<h2>Admin - Create User</h2>
    <!-- logged in user information -->
		<div class="profile_info">
			<div>
            	<img src="../images/admin_profile.png"  >
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>
					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
						<a href="home.php?logout='1'" style="color: #00C1F3;">Logout</a>
                        &nbsp;<a href="profile_admin.php" style="color: #00C1F3;">Edit Profiles</a>
                        &nbsp; <a href="vacancies.php" style="color: #00C1F3;"> Vacancies</a>
                        &nbsp; <a href="Applied_users.php" style="color: #00C1F3;"> Applications</a>
                       &nbsp; <a href="create_user.php" style="color: #00C1F3;"> +Add User</a>
					</small>
				<?php endif ?>
			</div>
		</div>
    </div>
	
	<form method="post" action="create_user.php">

		<?php echo display_error(); ?>

		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" value="<?php echo $username; ?>">
		</div>
		<div class="input-group">
			<label>Email</label>
			<input type="email" name="email" value="<?php echo $email; ?>">
		</div>
		<div class="input-group">
			<label>User type</label>
			<select name="user_type" id="user_type" >
				<option value=""></option>
				<option value="admin">Admin</option>
				<option value="user">User</option>
			</select>
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password_1">
		</div>
		<div class="input-group">
			<label>Confirm password</label>
			<input type="password" name="password_2">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="register_btn"> + Create user</button>
		</div>
	</form>
</body>
</html>