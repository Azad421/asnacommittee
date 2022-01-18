<?php
session_start();
include_once('./php/autoload.php');
$response['status'] = 0;
$response['message'] = "Wrong Request Sent!";
$response['type'] = "warning";
if (isset($_POST['add_user'])) {
    $response = $user->saveNewUser($_POST);
} elseif (isset($_POST['loginform'])) {
    $response = $auth->userLogin($_POST);
} elseif (isset($_POST['amdinlogin'])) {
    $response = $auth->adminLogin($_POST);
} elseif (isset($_POST['changeloginId'])) {
    $response = $committee->updateLoginId($_POST);
} elseif (isset($_POST['changecommitteepass'])) {
    $response = $committee->cnagepassword($_POST);
} elseif (isset($_POST['add_donor'])) {
    $response = $donor->saveNew($_POST);
} elseif (isset($_POST['add_report'])) {
    $response = $report->saveNew($_POST);
}

echo json_encode($response);