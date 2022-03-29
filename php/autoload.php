<?php
include_once("config.php");
include_once("Database.php");
include_once("User.php");
include_once("Auth.php");
include_once("Mosque.php");
include_once("Core.php");
include_once("Committee.php");
include_once("Admin.php");
include_once("array.php");
include_once("Donor.php");
include_once("Report.php");
include_once("Reference.php");


// Classes object
$db = new classes\Database;
$user = new classes\User($db);
$auth = new classes\Auth($db);
$mosque = new classes\Mosque($db);
$core = new classes\Core($db);
$committee = new classes\Committee($db);
$admin = new classes\Admin($db);
$donor = new classes\Donor($db);
$report = new classes\Report($db);
$reference = new classes\Reference($db);