<?php
session_start();
ob_start();
include_once("../php/autoload.php");
include_once('./partials/checkAdmin.php.php');
$title = "Become A donor";
$areas = [];
include('./partials/header.php');
if(isset($_POST['add_donor'])){
    $response = $donor->saveNew($_POST);
    $response = json_encode($response);
    ?>
    <script>
        var response = JSON.parse('<?= $response; ?>');
        // console.log(response.type);
        toastr[response.type](response.message);
        if (response.status == 1) {
            setTimeout(() => {
                window.location.href = "donors.php";
            }, 3000);
        }
    </script>
    <?php
}
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-6 col-sm-8 col-lg-5 col-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Donors Registration</h4>
                    <form class="forms-sample" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="donor_name" id="name" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="name">Nick Name</label>
                            <input type="text" class="form-control" name="nick_name" id="nick_name" placeholder="Nick Name">
                        </div>
                        <div class="form-group">
                            <label for="telephone">Telephone</label>
                            <input type="text" class="form-control" id="telephone" name="telephone"
                                placeholder="Telephone">
                        </div>
                        <div class="form-group">
                            <label for="gov_reg_no">Government Registration No</label>
                            <input type="text" class="form-control" id="gov_reg_no" name="gov_reg_no"
                                placeholder="Government Registration No">
                        </div>
                        <div class="form-group">
                            <label for="donor_logo">Donor Logo</label>
                            <input type="file" class="dropify" id="donor_logo" name="logo">
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
                            <label for="donate_details">Details Donation</label>
                            <input type="text" id="donate_details" name="donate_details" class="form-control"
                                   placeholder="Details Donation">
                        </div>
                        <div class="form-group">
                            <label>Please insert 5 images below</label>
                            <div class="row">
                                <div class="col-12 col-sm-6 col-lg-4 mb-3">
                                    <input type="file" name="image[]" class="dropify">
                                    <input type="hidden" name="oldImage[]" value="">
                                </div>
                                <div class="col-12 col-sm-6 col-lg-4 mb-3">
                                    <input type="file" name="image[]" class="dropify">
                                    <input type="hidden" name="oldImage[]" value="">
                                </div>
                                <div class="col-12 col-sm-6 col-lg-4 mb-3">
                                    <input type="file" name="image[]" class="dropify">
                                    <input type="hidden" name="oldImage[]" value="">
                                </div>
                                <div class="col-12 col-sm-6 col-lg-4 mb-3">
                                    <input type="file" name="image[]" class="dropify">
                                    <input type="hidden" name="oldImage[]" value="">
                                </div>
                                <div class="col-12 col-sm-6 col-lg-4 mb-3">
                                    <input type="file" name="image[]" class="dropify">
                                    <input type="hidden" name="oldImage[]" value="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="help_category">Help Category</label>
                            <div class="row">
                                <?php
                                $sql = "SELECT * FROM `help_categories`";
                                $select = $db->runquery($sql);
                                if ($select->num_rows > 0) {
                                    while ($row = $select->fetch_assoc()) {
                                        ?>
                                        <div class="col-6">
                                            <label for="<?= $row['name'] ?>" class="form-label">
                                                <input type="checkbox" class="mr-2" name="help_category[]"
                                                       id="<?= $row['name'] ?>"
                                                       value="<?= $row['id'] ?>">
                                                <span><?= $row['name'] ?></span>
                                            </label>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="bank_name">Bank Name</label>
                            <input type="text" class="form-control" name="bank_name" id="bank_name" placeholder="Bank Name">
                        </div>
                        <div class="form-group">
                            <label for="account_holder">Bank Holder Name</label>
                            <input type="text" class="form-control" name="account_holder" id="account_holder" placeholder="Bank Holder Name">
                        </div>
                        <div class="form-group">
                            <label for="bank_account_no">Bank Account No</label>
                            <input type="text" class="form-control" name="bank_account_no" id="bank_account_no" placeholder="Bank Account No">
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
$('.dropify').dropify();
for (let i = 0; i < 4; i++) {
    $('select#area' + i).select2();
}
</script>
<!-- content-wrapper ends -->
<?php
include('./partials/_footer.php');
?>