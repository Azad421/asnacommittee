<?php
session_start();
ob_start();
include_once("./php/autoload.php");
include_once('./partials/checckloggedout.php');
$title = "Become A donor";
$areas = [];
include('partials/header.php');
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-6 col-sm-8 col-lg-5 col-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Donors Registration</h4>
                    <form class="forms-sample" action="formsubmit.php" method="POST" id="add_donor">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="donor_name" id="name" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="telephone">Telephone</label>
                            <input type="text" class="form-control" id="telephone" name="telephone"
                                placeholder="Telephone">
                        </div>
                        <div class="form-group">
                            <label for="area">Area</label>
                            <div class="row">
                                <?php 
                                $c = 1;
                                    for ($i=0; $i < 4; $i++) { 
                                ?>
                                <div class="col-sm-6 col-12 mb-3 d-flex align-items-center">
                                    <span class="pr-2"><?= $c ?></span>
                                    <select name="area[]" class="form-control area" id="area<?=  $i ?>">
                                        <option value="">Area</option>
                                        <?php
                                        $sql = "SELECT * FROM `mosque_areas`";
                                        $select = $db->runquery($sql);
                                        if ($select->num_rows > 0) {
                                            while ($row = $select->fetch_assoc()) {
                                        ?>
                                        <option value="<?= $row['area_id'] ?>"><?= $row['area_name'] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <?php
                                $c++;
                                    }
                                 ?>
                            </div>
                            <!-- <?php
                                $sql = "SELECT * FROM `mosque_areas`";
                                $select = $db->runquery($sql);
                                if ($select->num_rows > 0) {
                                    while ($row = $select->fetch_assoc()) {
                                ?>
                            <label for="<?= $row['area_name'] ?>" class="form-label">
                                <input type="checkbox" class="mr-2" name="area[]" id="<?= $row['area_name'] ?>"
                                    value="<?= $row['area_id'] ?>">
                                <span><?= $row['area_name'] ?></span>
                            </label>
                            <?php
                                    }
                                }
                                ?> -->
                        </div>
                        <div class="form-group">
                            <label for="area_city">Area City</label>
                            <input type="text" id="area_city" name="area_city" class="form-control"
                                placeholder="Area City">
                        </div>
                        <div class="form-group">
                            <label for="state">Area State</label>
                            <select name="area_state" class="form-control" id="area_state">
                                <option value="">Area State</option>
                                <?php
                                        foreach ($area_states as $areakey => $area_state) {
                                    ?>
                                <option value="<?= $area_state ?>"><?= $area_state ?></option>
                                <?php
                                        }
                                ?>
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="donate_asnaf">Donate Asnaf (RM)</label>
                            <input type="text" class="form-control" id="donate_asnaf" name="donate_asnaf"
                                placeholder="Donate Asnaf">
                        </div>
                        <div class="form-group">
                            <label for="items_to_donate">Items To Donate non cash</label>
                            <?php
                                foreach ($items as $key => $item) {
                            ?>
                            <label for="<?= $item ?>" class="form-label">
                                <input type="checkbox" class="mr-2" name="items_to_donate[]" id="<?= $item ?>"
                                    value="<?= $item ?>">
                                <span><?= $item ?></span>
                            </label>
                            <?php
                                }
                            ?>
                        </div>

                        <div class="form-group">
                            <label for="donate_to_jalaria">Donate to jalaria (RM)</label>
                            <input type="text" id="donate_to_jalaria" name="donate_to_jalaria" class="form-control"
                                placeholder="Donate to jalaria">
                            <small class="text-muted"><b>Note:</b>Donation to Asnaf will be sent to the mosque and NGO
                                in the are chosen by Donors. Donation to Jalaria will be use for the maintenance and
                                expension of this Jalaria.com Application.
                            </small>
                        </div>
                        <input type="hidden" name="add_donor" value="1">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$('form#add_donor').submit(function(e) {
    e.preventDefault();
    var formid = $(this);
    submitForm(e, formid, isAdded);
});

function isAdded(response) {
    if (response.status == 1) {
        $('#add_donor').each(function() {
            this.reset();
        });
        setTimeout(() => {
            window.location.href = 'becomedoner.php';
        }, 3000);
    }
};
for (let i = 0; i < 4; i++) {
    $('select#area' + i).select2();
}
</script>
<!-- content-wrapper ends -->
<?php
include('./partials/_footer.php');
?>