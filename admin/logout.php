<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['admin_loggedin'])) {
    unset($_SESSION['admin_loggedin']);
}
header('location:./index.php');