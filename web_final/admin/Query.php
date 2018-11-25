<?php
session_start();

//set jobcode
if(isset($_POST['job'])) {
    echo 'hello';
    header('location:Applied_users.php');
}