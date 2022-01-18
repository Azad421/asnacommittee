<?php
require_once('../php/autoload.php');
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['admin_loggedin'])) {
    header('location:index.php');
} else {
    $admin_id = $_SESSION['admin_loggedin']['logged_in_id'];
    $sql = "SELECT * FROM `admin` WHERE `admin_id`='$admin_id'";
    $query = $db->runquery($sql);
    $userData = $query->fetch_assoc();
    $user_name = $userData['admin_name'];
    $admin_id = $userData['admin_id'];
}
