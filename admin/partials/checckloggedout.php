<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['admin_loggedin'])) {
    header('location:members.php');
}