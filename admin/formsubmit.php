<?php
session_start();
include_once('../php/autoload.php');
$response['status'] = 0;
$response['message'] = "Wrong Request Sent!";
$response['type'] = "warning";
if (isset($_POST['add_user'])) {
    $response = $user->saveNewUser($_POST);
} elseif (isset($_POST['loginform'])) {
    $response = $auth->userLogin($_POST);
} elseif (isset($_POST['amdinlogin'])) {
    $response = $auth->adminLogin($_POST);
} elseif (isset($_POST['add_mosque'])) {
    $response = $mosque->saveNew($_POST);
} elseif (isset($_POST['update_user'])) {
    $response = $user->updateData($_POST);
} elseif (isset($_POST['delete_Mosque'])) {
    $response = $mosque->deleteData($_POST);
} elseif (isset($_POST['delete_member'])) {
    $response = $user->deleteData($_POST);
} elseif (isset($_POST['remove_committee'])) {
    $response = $committee->removeCommitte($_POST);
} elseif (isset($_POST['updatecommittee'])) {
    $response = $committee->updateData($_POST);
} elseif (isset($_POST['changecommitteepass'])) {
    $response = $committee->adminCnagepassword($_POST);
} elseif (isset($_POST['changeusername'])) {
    $response = $admin->changeUsername($_POST);
} elseif (isset($_POST['changeadminpass'])) {
    $response = $admin->adminCnagepassword($_POST);
} elseif (isset($_POST['update_mosque'])) {
    $response = $mosque->updateOld($_POST);
} elseif (isset($_POST['remove_asnaf'])) {
    $response = $user->deleteAsnaf($_POST);
} elseif (isset($_POST['delete_donor'])) {
    $response = $donor->deleteData($_POST);
} elseif (isset($_POST['update_donor'])) {
    $response = $donor->updateOld($_POST);
}

echo json_encode($response);