<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2018-11-24
 * Time: 02:07 PM
 */
$db = mysqli_connect('localhost', 'root', '', 'multi_login');
if(!$db) :
    echo "<script>alert('ERROR')</script>>";
endif;
