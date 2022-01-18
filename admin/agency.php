<?php
$title = "Asnaf Commitee";
include('./partials/checkAdmin.php');
include_once('../php/autoload.php');
include('partials/header.php');
if (!isset($_GET['member'])) {
    header("location:members.php");
}
if (isset($_POST['make_asnaf'])) {
    $response['status'] = 0;
    $response['message'] = "Wrong Request Sent!";
    $response['type'] = "warning";
    $response = $user->makeAsnaf($_POST);
    if ($response['status'] == 1) {
        unset($_POST['make_asnaf']);
    }
?>
    <script>
        var response = <?= json_encode($response); ?>;
        toastr[response.type](response.message);
        setTimeout(() => {
            window.location.href = 'members.php';
        }, 3000);
    </script>
<?php
}
$member_id = $_GET['member'];
$select = $db->runquery("SELECT * FROM `asnaf` WHERE `Identification_id` = '$member_id'");
$count = $select->num_rows;
$mosque_ids = [];
if ($count > 0) {
    while ($mosque_member = $select->fetch_assoc()) {
        $mosque_ids[] = $mosque_member['mosque_id'];
    }
}
$mosque_ids = implode("','", $mosque_ids);
$sql = "SELECT * FROM `mosques` WHERE `mosque_id` NOT IN ('$mosque_ids')";
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-5 col-md-6 col-sm-8 col-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Select agency</h4>
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="mosque_id">Select Mosque</label>
                            <select name="mosque_id" class="form-control" id="mosque_id">
                                <option value="">Select Mosque</option>
                                <?php

                                $select = $db->runquery($sql);
                                if ($select->num_rows > 0) {
                                    while ($row = $select->fetch_assoc()) {
                                ?>
                                        <option value="<?= $row['mosque_id'] ?>"><?= $row['mosque_name'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="agency_name">Agency name</label>
                            <input type="text" class="form-control" name="agency_name" id="agency_name" placeholder="Agency name">
                        </div>
                        <div class="form-group">
                            <label for="agency_id">Agency Id</label>
                            <input type="text" class="form-control" name="agency_id" id="agency_id" placeholder="Agency name">
                        </div>
                        <input type="hidden" name="Identification_id" value="<?= $member_id ?>">
                        <input type="hidden" name="make_asnaf" value="1">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content-wrapper ends -->
<?php
include('partials/_footer.php');
?>