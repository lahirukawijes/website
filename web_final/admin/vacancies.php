<!--connect the vacancies.php file to database-->
<?php  include('vaca_server.php'); ?>
<!--end of connecting the vacancies.php file to database-->

<!--editing command-->
<?php 
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM vacancies WHERE JobCode = '$id'");

		if (mysqli_num_rows($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$JobCode = $n['JobCode'];
			$position = $n['position'];
			$ClosingDate = $n['ClosingDate'];
			$description = $n['description'];
		}
	}

//<!--end of editing command-->
//<!--deleting command-->

    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        $delete = true;
        $record = mysqli_query($db, "SELECT * FROM vacancies WHERE JobCode ='$id'");
        if (mysqli_num_rows($record) == 1 ) {
            $n = mysqli_fetch_array($record);
            $JobCode = $n['JobCode'];
            $position = $n['position'];
            $ClosingDate = $n['ClosingDate'];
            $description = $n['description'];
        }
}
?>
<!--end of deleting command-->

<!DOCTYPE html>
<html>
<head>
	<title>Admin-Vacancies</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
	<style>
		.header {
			background: #003366;
		}
	</style>
</head>
<body>
    <!--header-->
    <div class="header">
            <h2>Admin - Home Page</h2>
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
    <!--end of header-->
    
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
    <?php $results = mysqli_query($db, "SELECT * FROM vacancies"); ?>
    <table>
        <thead>
            <tr>
                <th>Job Code</th>
                <th>Position</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        
        <?php while ($row = mysqli_fetch_array($results)) { ?>
            <tr>
                <td><?php echo $row['JobCode']; ?></td>
                <td><?php echo $row['position']; ?></td>
                <td>
                    <a href="vacancies.php?edit=<?php echo $row['JobCode']; ?>" class="edit_btn" >Edit</a>
                </td>
                <td>
                    <a href="vacancies.php?del=<?php echo $row['JobCode']; ?>" class="del_btn">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
    <!--end retrieve data-->
    
    <form method="post" action="vaca_server.php" >
            <!--hidden field to uniquely identify the rows-->
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <!--end hidden field to uniquely identify the rows-->                  
            <div class="input-group">
                <label>Job Code</label>
                <input type="text" name="JobCode" value="<?php echo $JobCode; ?>">
            </div>
            <div class="input-group">
                <label>Position</label>
                <input type="text" name="position" value="<?php echo $position; ?>">
            </div>
            <div class="input-group">
                <label>Closing Date</label>
                <input type="date" name="ClosingDate" value="<?php echo $ClosingDate; ?>">
            </div>
            <div class="input-group">
                <label>Description</label>
                <textarea name="description" rows="7" cols="50" ><?php echo $description; ?></textarea>
            </div>
            <div class="input-group">
                <!--change the button appropriately-->
                <?php if ($update == true): ?>
                    <button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
                <?php elseif ($delete == true): ?>
                    <button class="btn" type="submit" name="del" style="background: #880000;" >delete</button>
                <?php else: ?>
                    <button class="btn" type="submit" name="save" >Save</button>
                <?php endif ?>
                <!--end change the button appropriately-->
            </div>
    </form>
</body>
</html>