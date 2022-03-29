<?php
session_start();
include_once("./php/autoload.php");

include_once('./partials/checckloggedout.php');

if (!isset($_GET['donor'])) {
    ?>
    <script>
        window.location.href = "index.php";
    </script>
    <?php
}
$donorId = $_GET['donor'];
$sql = "SELECT * FROM `donors` WHERE `donor_id`='$donorId'";
$select = $db->runquery($sql);
$count = $select->num_rows;


if ($count > 0) {
    $member = $select->fetch_assoc();
} else {
    ?>
    <script>
        window.location.href = "index.php";
    </script>
    <?php
}
$donor_id = $member['donor_id'];
$telephone = $member['telephone'];
$name = $member['donor_name'];
$address1 = $member['address1'];
$address2 = $member['address2'];
$area = $member['area'];
$state = $member['state'];
$city = $member['city'];
$postcode = $member['postcode'];
$country = $member['country'];
$nick_name = $member['nick_name'];
$life_condition = $member['life_condition'];

$mosque = $db->runquery("SELECT * FROM `mosques` WHERE `mosque_id`='$mosque_id'")->fetch_assoc();


$title = $name;
include('partials/header.php');
?>
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <?php if ($count > 0) { ?>
                    <div id="printContent" data-title="Asnaf list">
                        <div class="d-flex justify-content-end">
                            <a class="btn btn-success printbtn" onclick="printDiv('printContent')">
                                <span class="text-white">Print</span>
                            </a>
                            <?php include_once('./partials/printdate.php') ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div class="row">
                    <div class="col-0 col-sm-1 p-1"></div>
                    <div class="col-12 col-sm-3 col-md-2 p-1">Name:</div>
                    <div class="col-12 col-sm-7 col-md-8 p-1"><?= $name ?></div>
                </div>
                <div class="row">
                    <div class="col-0 col-sm-1 p-1"></div>
                    <div class="col-12 col-sm-3 col-md-2 p-1">Telephone:</div>
                    <div class="col-12 col-sm-7 col-md-8 p-1"><?= $telephone ?></div>
                </div>

                <div class="row">
                    <div class="col-0 col-sm-1 p-1"></div>
                    <div class="col-12 col-sm-3 col-md-2 p-1">Government Registration No:</div>
                    <div class="col-12 col-sm-7 col-md-8 p-1"><?= $member['gov_reg_no'] ?></div>
                </div>
                <div class="row">
                    <div class="col-0 col-sm-1 p-1"></div>
                    <div class="col-12 col-sm-3 col-md-2 p-1">Logo:</div>
                    <div class="col-12 col-sm-6 col-md-6 p-1">
                        <img class="img-fluid" src="./images/<?= $member['logo'] ?>" alt="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-0 col-sm-1 p-1"></div>
                    <div class="col-12 col-sm-3 col-md-2 p-1">Images:</div>
                    <div class="col-12 col-sm-6 col-md-8 p-1">
                        <div class="row">
                            <?php
                            $selectImage = $db->runquery("SELECT * FROM `donor_images` WHERE `donor_id`='$donorId'");
                            while ($image = $selectImage->fetch_assoc()) {
                                ?>
                                <div class="col-md-4">
                                    <img class="img-fluid" src="<?= './images/' . $member['image'] ?>" alt="">
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-0 col-sm-1 p-1"></div>
                    <div class="col-12 col-sm-3 col-md-2 p-1">Servicing Areas:</div>
                    <div class="col-12 col-sm-7 col-md-8 p-1">
                        <div class="row">
                            <?php
                            $c = 1;
                            for ($i = 0; $i < 4; $i++) {
                                ?>
                                <div class="col-sm-6 col-12 mb-3 d-flex align-items-center">
                                    <span class="pr-2"><?= $c ?></span>
                                    <select name="area[]" class="form-control area" id="area<?= $i ?>">
                                        <option value="">Area</option>
                                        <?php
                                        $selectA = $db->runquery("SELECT * FROM `donor_area` WHERE `donor_id`='$donor_id'");
                                        if ($selectA->num_rows > 0) {
                                            $areas = $selectA->fetch_all(MYSQLI_ASSOC);
                                            print_r($areas);
                                        }
                                        $sql = "SELECT * FROM `mosque_areas`";
                                        $select = $db->runquery($sql);
                                        if ($select->num_rows > 0) {
                                            while ($mArea = $select->fetch_assoc()) {
                                                ?>
                                                <option value="<?= $mArea['area_id'] ?>" <?= $core->itemSelected($mArea['area_id'], $areas[$i]['area_id']) ?>><?= $mArea['area_name'] ?></option>
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
                </div>
                <div class="row">
                    <div class="col-0 col-sm-1 p-1"></div>
                    <div class="col-12 col-sm-3 col-md-2 p-1">Category Of Donation:</div>
                    <div class="col-12 col-sm-7 col-md-8 p-1">
                        <?php
                        $selectCat = $db->runquery("SELECT * FROM `donor_help_categories` INNER JOIN `help_categories` ON `help_categories`.`id`=`donor_help_categories`.`help_category_id` WHERE `donor_help_categories`.`donor_id`='$donorId'");
                        while ($cat = $selectCat->fetch_assoc()) {
                            ?>
                            <div class="col-md-6">
                                <p><?= $cat['name'] ?></p>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="col-0 col-sm-1 p-1"></div>
                </div>

                <div class="row">
                    <div class="col-0 col-sm-1 p-1"></div>
                    <div class="col-12 col-sm-3 col-md-2 p-1">Bank Name:</div>
                    <div class="col-12 col-sm-7 col-md-8 p-1">
                        <?= $member['bank_name'] ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-0 col-sm-1 p-1"></div>
                    <div class="col-12 col-sm-3 col-md-2 p-1">Bank Holder Name:</div>
                    <div class="col-12 col-sm-7 col-md-8 p-1">
                        <?= $member['account_holder'] ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-0 col-sm-1 p-1"></div>
                    <div class="col-12 col-sm-3 col-md-2 p-1">Bank Account Number:</div>
                    <div class="col-12 col-sm-7 col-md-8 p-1">
                        <?= $member['start_collect'] ?>
                    </div>
                </div>

                <div class="col-0 col-sm-1 p-1"></div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
<?php
include('./partials/_footer.php');
?>