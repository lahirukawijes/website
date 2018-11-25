<!--connect the profile_admin.php file to database-->
<?php  include('server_admin.php'); ?>
<!--end of connecting the profile_admin.php file to database-->

<!--editing command-->
<?php 
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM users WHERE id=$id");

		if (mysqli_num_rows($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$username = $n['username'];
			$address = $n['address'];
			$email = $n['email'];
			$tel = $n['tel'];
			$gender = $n['gender'];
			$user_type = $n['user_type'];
		}
	}
?>
<!--end of editing command-->

<!DOCTYPE html>
<html>
<head>
	<title>admin-profile</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <style>
		.header {
			background: #003366;
		}
	
		#gender {
			height: 40px;
			width: 96%;
			padding: 5px 10px;
			background: white;
			font-size: 16px;
			border-radius: 5px;
			border: 1px solid gray;
		}
	</style>
</head>

<body>
    <!--header-->
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
    <!--header-->
    
    <!--confirmation message to tell the user that a new record has been created in the database-->
    <?php if (isset($_SESSION['message'])): ?>
        <div class="msg">
            <?php 
                echo $_SESSION['message']; 
                unset($_SESSION['message']);
            ?>
        </div>
    <?php endif ?>
    <!--end of confirmation message to tell the user that a new record has been created in the database-->
    
    <!--retrieve data-->
    <?php $results = mysqli_query($db, "SELECT * FROM users"); ?>
    
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        
        <?php while ($row = mysqli_fetch_array($results)) { ?>
            <tr>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td>
                    <a href="profile_admin.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
                </td>
                <td>
                    <a href="server_admin.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
    <!--end retrieve data-->
    
    <form method="post" action="server_admin.php" >
    		<!--hidden field to uniquely identify the rows-->
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <!--end of hidden field to uniquely identify the rows-->
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" value="<?php echo $username; ?>">
            </div>
            <div class="input-group">
                <label>Address</label>
                <input type="text" name="address" value="<?php echo $address; ?>">
            </div>
            <div class="input-group">
                <label>Email</label>
                <input type="text" name="email" value="<?php echo $email; ?>">
            </div>
            <div class="input-group">
                <label>Contact No.</label>
                <input type="text" name="tel" value="<?php echo $tel; ?>">
            </div>
            <div class="input-group">
                <label>Gender</label>
                <select name="gender" id="gender">
                    <option value="" selected disabled hidden><?php echo $gender; ?></option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    </select>
            </div>
            <div class="input-group">
                <label>User type</label>
                <select name="user_type" id="user_type" >
                    <option value="" selected disabled hidden><?php echo $user_type; ?></option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>
            <!--change the button appropriately-->
            <div class="input-group">
                <?php if ($update == true): ?>
                    <button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
                <?php else: ?>
                    <button class="btn" type="submit" name="save" >Save</button>
                <?php endif ?>
            </div>
            <!--end of change the button appropriately-->
    </form>
    
</body>
</html>