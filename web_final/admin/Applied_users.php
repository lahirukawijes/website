<!--connect the vacancies.php file to database-->
<?php
    include('vaca_server.php');
    include ('../connection.php');
    include ('datafetching.php');
?>
<!--end of connecting the vacancies.php file to database-->

<!DOCTYPE html>
<html>
<head>
	<title>Admin-Applications</title>
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
    <div class="content">
        <div style="margin-left: 35%;margin-bottom: 1%">
            <button class="search_btn" onclick="myFunction('JobDIV','PersonDIV','PersonDIV')">JOB</button>
            <button class="search_btn" onclick="myFunction('PersonDIV','JobDIV','JobCodesDIV')">PERSON</button>
            <button class="find_btn" onclick="myFunction('JobCodesDIV','PersonDIV','PersonDIV')">JobCodes</button>
        </div>
        <div id="JobDIV" style="display: none">
            <form method="post" action="Applied_users.php">

                <label>JobCode :</label>
                <input type="text" name="JobCode" class="text">

                <button class="search_btn" type="submit" name="job">Search</button>
            </form>
        </div>
        <div id="PersonDIV" style="display: none">
            <form method="post" action="Applied_users.php">

                <label for="id">PersonID :</label>
                <input type="text" name="id" class="text">

                <button class="search_btn" type="submit" name="person">Search</button>
            </form>
        </div>
    </div>
    <div>
        <?php
            if(isset($_POST['JobCode']))
            { $jobcode = $_POST['JobCode'];
                if($jobcode != null){

                    $result0 = mysqli_query($db,"SELECT position FROM vacancies where JobCode = '$jobcode'");
                    $row0 = mysqli_fetch_array($result0);

            ?>
        <div id="JobDetails" class="content" style="display: block;" >
            <form method="post" style="border: none;margin-left: 80%;padding: unset" action="print.php">
                <input type="text" name="JobCode" hidden value="<?php echo $jobcode?>">
                <input type="submit" name="pdf_Job" class="print_btn" value="Generate PDF" />
            </form>
            <table>
                <thead>
                <tr><a href="#" style="font-family: 'Arial Black',  Gadget, sans-serif;text-decoration: none !important;color: #1B1445">Job Id :</a> <?php echo $jobcode;?> <a href="#" style="font-family: 'Arial Black',  Gadget, sans-serif;text-decoration: none !important;color: #1B1445;margin-left: 20px">Position :</a><?php echo $row0['position']?></tr>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>E-Mail</th>
                        <th>Gender</th>
                        <th>Contact</th>
                        <th>Address</th>
                    </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>E-Mail</th>
                    <th>Gender</th>
                    <th>Contact</th>
                    <th>Address</th>
                </tr>
                </tfoot>
                <tbody>
                    <?php
                       echo data_fetch($db,$jobcode);
                    ?>
                </tbody>
            </table>
        </div>
                <?php }
            }?>
        <?php
        if(isset($_POST['person']))
        { $id = $_POST['id'];
            if($id != null){

                $result0 = mysqli_query($db,"SELECT username FROM users where id = '$id'");
                $row0 = mysqli_fetch_array($result0);

                ?>
                <div id="PersonDetails" class="content" style="display: block;">
                    <form method="post" style="border: none;margin-left: 80%;padding: unset" action="print.php">
                        <input type="text" name="id" hidden value="<?php echo $id?>">
                        <input type="submit" name="pdf_Person" class="print_btn" value="Generate PDF" />
                    </form>
                    <table>
                        <thead>
                        <tr><a href="#" style="font-family: 'Arial Black',  Gadget, sans-serif;text-decoration: none !important;color: #1B1445">Id :</a> <?php echo $id;?> <a href="#" style="font-family: 'Arial Black',  Gadget, sans-serif;text-decoration: none !important;color: #1B1445;margin-left: 20px">Name :</a><?php echo $row0['username']?></tr>
                        <tr>
                            <th>JobCode</th>
                            <th>Position</th>
                            <th>ClosingDate</th>
                            <th>Description</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>JobCode</th>
                            <th>Position</th>
                            <th>ClosingDate</th>
                            <th>Description</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <?php

                        echo data_fetch2($db,$id);
                        ?>
                        </tbody>
                    </table>
                </div>
            <?php }
        }?>
        <div id="JobCodesDIV" class="content" style="display: none" >
            <table>
                <thead>
                <tr>
                    <th>JobCode</th>
                    <th>Position</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>JobCode</th>
                    <th>Position</th>
                </tr>
                </tfoot>
                <tbody>
                <?php
                    $result = mysqli_query($db, "SELECT * FROM vacancies");
                    while($row2 = mysqli_fetch_array($result)) {?>
                        <tr>
                            <td><?php echo $row2['JobCode']?></td>
                            <td><?php echo $row2['position']; ?></td>
                        </tr>
                    <?php }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function myFunction(div,backdiv,thirddiv) {
            var x = document.getElementById(div);
            var y = document.getElementById(backdiv);
            var z = document.getElementById(thirddiv);

            if (y.style.display === "block") {
                y.style.display = "none";
            }
            if (z.style.display === "block") {
                z.style.display = "none";
            }
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

    </script>
</body>
</html>