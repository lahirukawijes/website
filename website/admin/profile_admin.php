<?php  include('server_admin.php'); ?>
<?php 
include('../functions.php');

if (!isAdmin()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: ../login.php");
}
?>
<?php 
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM info WHERE id=$id");

		if (count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$name = $n['name'];
			$address = $n['address'];
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title>Profile</title>
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
		<h2>Admin - Profiles Page</h2>
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
                       &nbsp; <a href="create_user.php" style="color: #00C1F3;"> +Add User</a>
					</small>
				<?php endif ?>
			</div>
		</div>
    </div>
    
<?php if (isset($_SESSION['message'])): ?>
	<div class="msg">
		<?php 
			echo $_SESSION['message']; 
			unset($_SESSION['message']);
		?>
	</div>
<?php endif ?>

<?php $results = mysqli_query($db, "SELECT * FROM info"); ?>
<table>
	<thead>
		<tr>
			<th>Name</th>
			<th>Address</th>
			<th colspan="2">Action</th>
		</tr>
	</thead>
	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<td><?php echo $row['name']; ?></td>
			<td><?php echo $row['address']; ?></td>
			<td>
				<a href="profile_admin.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
			</td>
			
		</tr>
	<?php } ?>
</table>

	<form method="post" action="server_admin.php" >
		<div class="input-group">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
			<label>Name</label>
			<input type="text" name="name" value="<?php echo $name; ?>">
		</div>
		<div class="input-group">
			<label>Address</label>
			<input type="text" name="address" value="<?php echo $address; ?>">
		</div>
		<div class="input-group">
			<?php if ($update == true): ?>
				<button class="btn" type="submit" name="update" style="background: #556B2F;" >Update</button>
			<?php else: ?>
				<button class="btn" type="submit" name="save" >Save</button>
			<?php endif ?>
            <button class="btn" type="reset" name="reset" style="background: #556B2F;" >Cancel</button>
		</div>
	</form>
</body>
</html>