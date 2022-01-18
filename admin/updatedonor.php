<?php
session_start();
ob_start();
include_once("../php/autoload.php");
include_once("./partials/checkAdmin.php");
if (isset($_GET['donor'])) {
    $donor_id = $_GET['donor'];
} else {
    header('location:./donors.php');
}
$sql = "SELECT * FROM `donors`  WHERE `donor_id`='$donor_id'";
$select = $db->runquery($sql);
$count = $select->num_rows;
$row = $select->fetch_assoc();
$title = "Update doner";
$donor_id = $row['donor_id'];
$donor_name = $row['donor_name'];
$area_city = $row['area_city'];
$area_state_db = $row['area_state'];
$area = $row['area'];
$donate_asnaf = $row['donate_asnaf'];
$items_to_donate = $row['items_to_donate'];
$telephone = $row['telephone'];
$donate_to_jalaria = $row['donate_to_jalaria'];
//Include header file
include('./partials/header.php');

?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-6 col-sm-8 col-lg-5 col-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update Donor</h4>
                    <form class="forms-sample" action="formsubmit.php" method="POST" id="update">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="donor_name" id="name"
                                value="<?= $donor_name ?>" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="telephone">Telephone</label>
                            <input type="text" class="form-control" id="telephone" name="telephone"
                                value="<?= $telephone ?>" placeholder="Telephone">
                        </div>
                        <div class="form-group">
                            <label for="area">Area</label>
                            <input type="text" id="area" name="area" value="<?= $area ?>" class="form-control"
                                placeholder="Area">
                        </div>
                        <div class="form-group">
                            <label for="area_city">Area City</label>
                            <input type="text" id="area_city" name="area_city" value="<?= $area_city ?>"
                                class="form-control" placeholder="Area City">
                        </div>
                        <div class="form-group">
                            <label for="state">Area State</label>
                            <select name="area_state" class="form-control" id="area_state">
                                <option value="">Area State</option>
                                <?php
                                        foreach ($area_states as $areakey => $area_state) {
                                    ?>
                                <option value="<?= $area_state ?>"
                                    <?= $core->itemSelected($area_state_db, $area_state) ?>><?= $area_state ?></option>
                                <?php
                                        }
                                    ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="donate_asnaf">Donate Asnaf (RM)</label>
                            <input type="text" class="form-control" id="donate_asnaf" name="donate_asnaf"
                                value="<?= $donate_asnaf ?>" placeholder="Donate Asnaf">
                        </div>
                        <div class="form-group">
                            <label for="items_to_donate">Items To Donate non cash</label>
                            <!-- <select name="items_to_donate" class="form-control" id="">
                                <option value="">Items To Donate</option>
                                <?php
                                        foreach ($items as $key => $item) {
                                            ?>
                                <option value="<?= $item ?>" <?= $core->itemSelected($items_to_donate, $item) ?>>
                                    <?= $item ?></option>
                                <?php
                                        }
                                    ?>
                            </select> -->
                            <?php
                                foreach ($items as $key => $item) {
                            ?>
                            <label for="<?= $item ?>" class="form-label">
                                <input type="checkbox" class="mr-2" name="items_to_donate[]" id="<?= $item ?>"
                                    value="<?= $item ?>"
                                    <?= $core->itemChecked(explode(',',$items_to_donate),$items,$item) ?>>
                                <span><?= $item ?></span>
                            </label>
                            <?php
                                }
                            ?>

                        </div>

                        <div class="form-group">
                            <label for="donate_to_jalaria">Donate to jalaria (RM)</label>
                            <input type="text" id="donate_to_jalaria" name="donate_to_jalaria" class="form-control"
                                value="<?= $donate_to_jalaria ?>" placeholder="Donate to jalaria">
                            <small class="text-muted"><b>Note:</b>Donation to Asnaf will be sent to the mosque and NGO
                                in the are chosen by Donors. Donation to Jalaria will be use for the maintenance and
                                expension of this Jalaria.com Application.
                            </small>
                        </div>
                        <input type="hidden" name="donor_id" value="<?= $donor_id ?>">
                        <input type="hidden" name="update_donor" value="1">
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
            window.location.href = "donors.php";
        }, 3000);
    }
};
</script>
<!-- content-wrapper ends -->
<?php
include('./partials/_footer.php');
?>