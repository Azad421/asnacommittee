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
include('./partials/header.php');
if(isset($_POST['update_donor'])){
    $response = $donor->updateOld($_POST);
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
$sql = "SELECT * FROM `donors`  WHERE `donor_id`='$donor_id'";
$select = $db->runquery($sql);
$count = $select->num_rows;
$row = $select->fetch_assoc();
$title = "Update donor";
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


?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-6 col-sm-8 col-lg-5 col-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update Donor</h4>
                    <form class="forms-sample" action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="donor_name" id="name"
                                value="<?= $donor_name ?>" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="name">Nick Name</label>
                            <input type="text" class="form-control" name="nick_name" id="nick_name" value="<?= $row['nick_name'] ?>" placeholder="Nick Name">
                        </div>
                        <div class="form-group">
                            <label for="telephone">Telephone</label>
                            <input type="text" class="form-control" id="telephone" name="telephone"
                                value="<?= $telephone ?>" placeholder="Telephone">
                        </div>
                        <div class="form-group">
                            <label for="gov_reg_no">Government Registration No</label>
                            <input type="text" class="form-control" id="gov_reg_no" name="gov_reg_no" value="<?= $row['gov_reg_no'] ?>"
                                   placeholder="Government Registration No">
                        </div>
                        <div class="form-group">
                            <label for="donor_logo">Donor Logo</label>
                            <input type="file" class="dropify" id="donor_logo" data-default-file="<?= empty($row['logo'])?'': URL.'images/'.$row['logo'] ?>" name="donor_logo">
                            <input type="hidden" name="oldLogo" value="<?= $row['logo'] ?>">
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
                                            $selectA = $db->runquery("SELECT * FROM `donor_area` WHERE `donor_id`='$donor_id'");
                                            if ($selectA->num_rows > 0) {
                                                $areas = $selectA->fetch_all(MYSQLI_ASSOC);
                                                $areaId = $areas[$i]['area_id']??'';
                                                print_r($areas);
                                            }
                                            $sql = "SELECT * FROM `mosque_areas`";
                                            $select = $db->runquery($sql);
                                            if ($select->num_rows > 0) {
                                                while ($mArea = $select->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?= $mArea['area_id'] ?>" <?= $core->itemSelected($mArea['area_id'], $areaId ) ?>><?= $mArea['area_name'] ?></option>
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
                            <label>Please insert 5 images below</label>
                            <div class="row">
                                <?php
                                $images = [];
                                $selectC = $db->runquery("SELECT * FROM `donor_images` WHERE `donor_id`='$donor_id'");
                                if ($selectC->num_rows > 0) {
                                    $images = $selectC->fetch_all(MYSQLI_ASSOC);
                                }
                                ?>
                                <div class="col-12 col-sm-6 col-lg-4 mb-3">
                                    <input type="file" name="image[]" data-default-file="<?= empty($images[0]['image_name'])?'':URL.'images/'.$images[0]['image_name'] ?>" class="dropify">
                                    <input type="hidden" name="oldImage[]" value="<?= $images[0]['image_name']??'' ?>">
                                </div>
                                <div class="col-12 col-sm-6 col-lg-4 mb-3">
                                    <input type="file" name="image[]" data-default-file="<?= empty($images[1]['image_name'])?'':URL.'images/'.$images[1]['image_name'] ?>" class="dropify">
                                    <input type="hidden" name="oldImage[]" value="<?= $images[1]['image_name']??'' ?>">
                                </div>
                                <div class="col-12 col-sm-6 col-lg-4 mb-3">
                                    <input type="file" name="image[]" data-default-file="<?= empty($images[2]['image_name'])?'':URL.'images/'.$images[2]['image_name'] ?>" class="dropify">
                                    <input type="hidden" name="oldImage[]" value="<?= $images[2]['image_name']??'' ?>">
                                </div>
                                <div class="col-12 col-sm-6 col-lg-4 mb-3">
                                    <input type="file" name="image[]" data-default-file="<?= empty($images[3]['image_name'])?'':URL.'images/'.$images[3]['image_name'] ?>" class="dropify">
                                    <input type="hidden" name="oldImage[]" value="<?= $images[3]['image_name']??'' ?>">
                                </div>
                                <div class="col-12 col-sm-6 col-lg-4 mb-3">
                                    <input type="file" name="image[]" data-default-file="<?= empty($images[4]['image_name'])?'':URL.'images/'.$images[4]['image_name'] ?>" class="dropify">
                                    <input type="hidden" name="oldImage[]" value="<?= $images[4]['image_name']??'' ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="help_category">Help Category</label>
                            <div class="row">
                                <?php
                                $help_categories_ids = [];
                                $selected_categories_ids = [];
                                $selectC = $db->runquery("SELECT * FROM `donor_help_categories` WHERE `donor_id`='$donor_id'");
                                if ($selectC->num_rows > 0) {
                                    $categories = $selectC->fetch_all(MYSQLI_ASSOC);
                                    foreach ($categories as $category) {
                                        $selected_categories_ids[] = $category['help_category_id'];
                                    }
                                }
                                $sql = "SELECT * FROM `help_categories`";
                                $select = $db->runquery($sql);

                                if ($select->num_rows > 0) {
                                    $rows = $select->fetch_all(MYSQLI_ASSOC);
                                    foreach ($rows as $hCategory) {
                                        $help_categories_ids[] = $hCategory['id'];
                                        ?>
                                        <div class="col-6">
                                            <label for="<?= $hCategory['name'] ?>" class="form-label">
                                                <input type="checkbox" class="mr-2" name="help_category[]"
                                                       id="<?= $hCategory['name'] ?>"
                                                       value="<?= $hCategory['id'] ?>"
                                                    <?= $core->itemChecked($selected_categories_ids, $help_categories_ids, $hCategory['id']) ?>>
                                                <span><?= $hCategory['name'] ?></span>
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
                            <input type="text" class="form-control" name="bank_name" id="bank_name" placeholder="Bank Name" value="<?= $row['bank_name'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="account_holder">Bank Holder Name</label>
                            <input type="text" class="form-control" name="account_holder" id="account_holder" placeholder="Bank Holder Name" value="<?= $row['account_holder'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="bank_account_no">Bank Account No</label>
                            <input type="text" class="form-control" name="bank_account_no" id="bank_account_no" placeholder="Bank Account No" value="<?= $row['bank_account_no'] ?>">
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
$('.dropify').dropify();
</script>
<!-- content-wrapper ends -->
<?php
include('./partials/_footer.php');
?>