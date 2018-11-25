<!--connect the user_vaca.php file to database-->
<?php  include('admin/vaca_server.php'); ?>
<!--end of connecting the user_vaca.php file to database-->
<!DOCTYPE html>
<html>
<head>
	<title>Vacancies</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <!--header-->
        <div class="header">
                <h2>Vacancies</h2>
                <!-- logged in user information -->
                <div class="profile_info">			
                    <div>
                    <img src="images/user_profile.png"  >
                        <?php  if (isset($_SESSION['user'])) : ?>
                            <strong><?php echo $_SESSION['user']['username']; ?></strong>
        
                            <small>
                                <i  style="color: #1B1445;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
                                <br>
                                <a href="index.php?logout='1'" style="color: #2D1353;">Logout</a>
                                &nbsp;<a href="profile.php" style="color: #2D1353;">Edit your Profile</a>
                                &nbsp;<a href="user_vaca.php" style="color: #2D1353;">Vacancies</a>
                            </small>
                        <?php endif ?>
                    </div>       
                </div>
           </div>
       <!--end of header-->
       <!--retrieve data-->
    <?php $results = mysqli_query($db, "SELECT * FROM vacancies"); ?>
    <table>
        <thead>
            <tr>
                <th>Job Code</th>
                <th>Position</th>
                <th>Closing Date</th>
                <th >Action</th>
            </tr>
        </thead>
        
        <?php while ($row = mysqli_fetch_array($results)) { ?>
            <?php $jobcode = $row['JobCode']; $id = $_SESSION['user_id']?>
            <?php $Applyresult = mysqli_query($db, "SELECT apply_id FROM apply_details where JobCode ='$jobcode' and  id = '$id'");
            $rw = mysqli_fetch_array($Applyresult);
            $num = mysqli_num_rows($Applyresult);
            if($num == 1) :
                $Apply = true;
            else :
                $Apply = false;
            endif

            ?>

            <tr>
                <td><?php echo $row['JobCode']; ?></td>
                <td><?php echo $row['position']; ?></td>
                <td><?php echo $row['ClosingDate']; ?></td>
                <!--change these two buttons and add a apply button. so it generates emails.
                or create a save command and then user name is saved to a new table.-->
                <td>

                    <?php if(!$Apply): ?>
                        <a href="server.php?apply=<?php echo $row['JobCode']; ?>" class="apply_btn" >Apply</a>
                    <?php else: ?>
                        <a href="server.php?remv=<?php echo $rw['apply_id']; ?>" class="remove_btn" >Remove</a>
                    <?php endif ?>
                </td>
            </tr>
        <?php } ?>
    </table>
    <!--end retrieve data-->