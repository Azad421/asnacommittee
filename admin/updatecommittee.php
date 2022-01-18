<?php
ob_start();
include_once('./partials/checkAdmin.php')
?>
<?php
$title = "Asnaf Commitee";
include_once("../php/autoload.php");
include('partials/header.php');
if (!isset($_GET['committee'])) {
    header("location:committee.php");
}
$commitee_id = $_GET['committee'];
$sql = "SELECT * FROM `commitee` INNER JOIN `all_members` ON `commitee`.`Identification_id`=`all_members`.`Identification_id` WHERE `committee_id`='$commitee_id'";
$select = $db->runquery($sql);
$row = $select->fetch_assoc();

$Identification_id = $row['Identification_id'];
$name = $row['name'];
$position = $row['position'];
$asnaf_name = $row['asnaf_name'];
$mosque_Id = $row['mosque_Id'];
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-5 col-md-6 col-sm-8 col-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update Committee</h4>
                    <form class="forms-sample" action="formsubmit.php" method="POST" id="update">
                        <div class="form-group">
                            <label for="mosque_id">Select Mosque</label>
                            <select name="mosque_id" class="form-control" id="mosque_id">
                                <option value="">Select Mosque</option>
                                <?php
                                $sql = "SELECT * FROM `mosques`";
                                $select = $db->runquery($sql);
                                if ($select->num_rows > 0) {
                                    while ($row = $select->fetch_assoc()) {
                                ?>
                                        <option value="<?= $row['mosque_id'] ?>" <?= $core->itemSelected($row['mosque_id'], $mosque_Id) ?>><?= $row['mosque_name'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="asnaf_name">Login Id</label>
                            <input type="text" class="form-control" name="asnaf_name" value="<?= $asnaf_name ?>" id="asnaf_name" placeholder="Login Id">
                        </div>
                        <div class="form-group">
                            <label for="position">Position</label>
                            <input type="text" class="form-control" id="position" value="<?= $position ?>" name="position" placeholder="Position">
                        </div>
                        <input type="hidden" name="committee_id" value="<?= $_GET['committee'] ?>">
                        <input type="hidden" name="Identification_id" value="<?= $Identification_id ?>">
                        <input type="hidden" name="updatecommittee" value="1">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('form#update').submit(function(e) {
        e.preventDefault();
        var formid = $(this);
        submitForm(e, formid, isAdded);
    });

    function isAdded(response) {
        if (response.status == 1) {
            setTimeout(() => {
                window.location.href = response.url;
            }, 3000);
        }
    };
</script>
</script>
<!-- content-wrapper ends -->
<?php
include('partials/_footer.php');
?>