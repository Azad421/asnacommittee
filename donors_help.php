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
                <div id="printContent" data-title="<?= $name ?>">
                    <?php if ($count > 0) { ?>
                        <div class="d-flex justify-content-end">
                            <a class="btn btn-success printbtn" onclick="printDiv('printContent')">
                                <span class="text-white">Print</span>
                            </a>
                            <?php include_once('./partials/printdate.php') ?>
                        </div>

                        <?php
                    }
                    ?>
                    <div class="row">
                        <div class="col-0 col-sm-1 p-1"></div>
                        <div class="col-12 col-sm-11  p-1"><?= $name ?></div>
                    </div>
                    <div class="row">
                        <div class="col-0 col-sm-1 p-1"></div>
                        <div class="col-12 col-sm-11  p-1"><?= $telephone ?></div>
                    </div>

                    <div class="row">
                        <div class="col-0 col-sm-1 p-1"></div>
                        <div class="col-12 col-sm-11  p-1"><?= $member['gov_reg_no'] ?></div>
                    </div>
                    <div class="row">
                        <div class="col-0 col-sm-1 p-1"></div>
                        <div class="col-12 col-sm-12 col-md-6 p-1">
                            <img class="img-fluid" src="./images/<?= $member['logo'] ?>" alt="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-0 col-sm-1 p-1"></div>
                        <div class="col-12 col-md-6   p-1">
                            <?php
                            $selectImage = $db->runquery("SELECT * FROM `donor_images` WHERE `donor_id`='$donorId'");
                            while ($image = $selectImage->fetch_assoc()) {
                                if (!empty($image['image_name'])) {
                                    ?>
                                    <div class="  mb-4">
                                        <img class="img-fluid" src="<?= './images/' . $image['image_name'] ?>" alt="">
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-0 col-sm-1 p-1"></div>
                        <div class="col-12 col-sm-11 p-1">Servicing Areas:</div>
                        <div class="col-0 col-sm-1 p-1"></div>
                        <div class="col-12 col-sm-11 p-1">
                            <div class="row mb-3">
                                <?php
                                $selectA = $db->runquery("SELECT * FROM `donor_area` INNER JOIN `mosque_areas` ON `donor_area`.`area_id`=`mosque_areas`.`area_id` WHERE `donor_area`.`donor_id`='$donor_id'");
                                if ($selectA->num_rows > 0) {
                                    $c = 1;
                                    while ($area = $selectA->fetch_assoc()) {
                                        ?>
                                        <div class="col-12">
                                            <span class="pr-2"><?= $c ?></span>
                                            <span><?= $area['area_name'] ?></span>
                                        </div>
                                        <?php
                                        $c++;
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-0 col-sm-1 p-1"></div>
                        <div class="col-12 col-sm-11 p-1">Category Of Donation:</div>
                        <div class="col-0 col-sm-1 p-1"></div>
                        <div class="col-12 col-sm-11 p-1">
                            <?php
                            $c = 1;
                            $selectCat = $db->runquery("SELECT * FROM `donor_help_categories` INNER JOIN `help_categories` ON `help_categories`.`id`=`donor_help_categories`.`help_category_id` WHERE `donor_help_categories`.`donor_id`='$donorId'");
                            while ($cat = $selectCat->fetch_assoc()) {
                                ?>
                                <div class="col-12 col-md-3 px-0">
                                    <span class="pr-2"><?= $c ?></span>
                                    <?= $cat['name'] ?>
                                </div>
                                <?php
                                $c++;
                            }
                            ?>
                        </div>
                        <div class="col-0 col-sm-1 p-1"></div>
                    </div>

                    <div class="row">
                        <div class="col-0 col-sm-1 p-1"></div>
                        <div class="col-12 col-sm-11  p-1">
                            <?= $member['donate_details'] ?>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-0 col-sm-1 p-1"></div>
                        <div class="col-12 col-sm-10 p-1">
                            We Welcome your Donation Please Donate To
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-0 col-sm-1 p-1"></div>
                        <div class="col-12 col-sm-11  p-1">Bank Name:</div>
                        <div class="col-0 col-sm-1 p-1"></div>
                        <div class="col-12 col-sm-11  p-1">
                            <?= $member['bank_name'] ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-0 col-sm-1 p-1"></div>
                        <div class="col-12 col-sm-11  p-1">Bank Holder Name:</div>
                        <div class="col-0 col-sm-1 p-1"></div>
                        <div class="col-12 col-sm-11  p-1">
                            <?= $member['account_holder'] ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-0 col-sm-1 p-1"></div>
                        <div class="col-12 col-sm-11  p-1">Bank Account Number:</div>
                        <div class="col-0 col-sm-1 p-1"></div>
                        <div class="col-12 col-sm-11  p-1">
                            <?= $member['bank_account_no'] ?>
                        </div>
                    </div>

                    <div class="col-0 col-sm-1 p-1"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
<?php
include('./partials/_footer.php');
?>