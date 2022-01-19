<?php
require_once('./php/autoload.php');
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['loggedin'])) {
    header('location:login.php');
} else {
    $committee_id = $_SESSION['loggedin']['logged_in_id'];
    $sql = "SELECT * FROM `commitee` WHERE `committee_id`='$committee_id'";
    $query = $db->runquery($sql);
    $userData = $query->fetch_assoc();
    $member_id = $userData['Identification_id'];
    $mosque_id = $userData['mosque_Id'];
    $login_id = $userData['asnaf_name'];
    $committee_id = $userData['committee_id'];
    $sql3 = "SELECT * FROM `mosques` WHERE `mosque_Id`='$mosque_id'";
    $selectMosque = $db->runquery($sql3);
    $mosque = $selectMosque->fetch_assoc();
    $mosque_name = $mosque['mosque_name'];
    $mosque_area = $mosque['area'];
    $sql = "SELECT * FROM `all_members` WHERE `Identification_id`='$member_id'";
    $query2 = $db->runquery($sql);
    $member = $query2->fetch_assoc();
    $user_name = $member['name'];
    $committeearea = $member['area'];
}