<?php
session_start();
include_once("./php/autoload.php");

include_once('./partials/checckloggedout.php');

if (!isset($_GET['asnaf'])) {
    ?>
    <script>
        window.location.href = "index.php";
    </script>
    <?php
}
$asnaf = $_GET['asnaf'];
$sql = "SELECT * FROM `asnaf` INNER JOIN `all_members` ON `asnaf`.`Identification_id`=`all_members`.`Identification_id` INNER JOIN `donation_project` ON `member_id`=`all_members`.`Identification_id` WHERE `asnaf`.`asnaf_id`='$asnaf'";
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
$asnaf_id = $member['asnaf_id'];
$Identification_id = $member['Identification_id'];
$mosque_id = $member['mosque_id'];
$name = $member['name'];
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
                    <div class="col-12 col-sm-8 col-md-8 p-1"><?= $name ?></div>
                </div>
                <div class="row">
                    <div class="col-0 col-sm-1 p-1"></div>
                    <div class="col-12 col-sm-3 col-md-2 p-1">Area:</div>
                    <div class="col-12 col-sm-8 col-md-8 p-1"><?= $area ?></div>
                </div>

                <div class="row">
                    <div class="col-0 col-sm-1 p-1"></div>
                    <div class="col-12 col-sm-3 col-md-2 p-1">Condition:</div>
                    <div class="col-12 col-sm-7 col-md-8 p-1"><?= $life_condition ?></div>
                </div>
                <div class="row">
                    <div class="col-0 col-sm-1 p-1"></div>
                    <div class="col-12 col-sm-3 col-md-2 p-1">City:</div>
                    <div class="col-12 col-sm-7 col-md-8 p-1"><?= $city ?></div>
                </div>
                <div class="row">
                    <div class="col-0 col-sm-1 p-1"></div>
                    <div class="col-12 col-sm-3 col-md-2 p-1">Mosque:</div>
                    <div class="col-12 col-sm-7 col-md-8 p-1"><?= $mosque['mosque_name'] ?></div>
                </div>
                <div class="row">
                    <div class="col-0 col-sm-1 p-1"></div>
                    <div class="col-12 col-sm-3 col-md-2 p-1">Mosque City:</div>
                    <div class="col-12 col-sm-7 col-md-8 p-1"><?= $mosque['city'] ?></div>
                </div>
                <?php
                $sql = "SELECT * FROM `images` WHERE `user_id`='$Identification_id'";
                $select = $db->runquery($sql);
                $count = $select->num_rows;
                if ($count > 0) {
                    while ($image = $select->fetch_assoc()) {
                        ?>
                        <div class="row">
                            <div class="col-0 col-sm-1 p-1"></div>
                            <div class="col-12 col-sm-6 col-md-8 p-1">
                                <img class="img-fluid" src="./images/<?= $image['image_name'] ?>" alt="">
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
                <div class="row">
                    <div class="col-0 col-sm-1 p-1"></div>
                    <div class="col-12 col-sm-3 col-md-2 p-1">Donations So far:</div>
                    <div class="col-12 col-sm-7 col-md-8 p-1">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-0 col-sm-1 p-1"></div>
                    <div class="col-12 col-sm-7 col-md-10 p-1">
                        <div class="row">
                            <div class="col-4 border border-right-0 p-2">Donors</div>
                            <div class="col-4 border border-left-0 p-2 border-right-0">Amount</div>
                            <div class="col-4 border border-left-0 p-2">Date</div>
                        </div>
                        <?php
                        $sql = "SELECT * FROM `donors` INNER JOIN `project_doners` ON `donors`.`id`=`project_doners`.`donor_id` WHERE `user_id`='$Identification_id'";
                        $selectDn = $db->runquery($sql);
                        $count = $selectDn->num_rows;
                        if ($count > 0) {
                            while ($donor = $selectDn->fetch_assoc()) {
                                ?>
                                <div class="row">
                                    <div class="col-4 border border-right-0 p-2"><?= $donor['donor_name'] ?></div>
                                    <div class="col-4 border border-left-0 p-2 border-right-0"><?= $donor['amount'] ?></div>
                                    <div class="col-4 border border-left-0 p-2"><?= $donor['date'] ?></div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <div class="col-0 col-sm-1 p-1"></div>
                </div>
                <div class="row">
                    <div class="col-0 col-sm-1 p-1"></div>
                    <div class="col-12 col-sm-3 col-md-2 p-1">Media Coverage:</div>
                    <div class="col-12 col-sm-7 col-md-8 p-1">
                    </div>
                </div>
                <div class="row">
                    <div class="col-0 col-sm-1 p-1"></div>
                    <div class="col-12 col-sm-7 col-md-10 p-1">
                        <div class="row">
                            <?php
                            $i = 1;
                            $references = $db->runquery("SELECT * FROM `asnaf_references` WHERE `asnaf_id`='$asnaf_id'");
                            $count = $references->num_rows;
                            if ($count > 0) {
                                while ($reference = $references->fetch_assoc()) {
                                    ?>
                                    <div class="col-0 col-sm-1 p-1 text-right"><?= $i ?></div>
                                    <div class="col-12 col-sm-11 p-1"><?= $reference['source'] . ' ' . $reference['source_date'] . ' ' . $reference['title'] ?></div>
                                    <?php
                                    $i++;
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-0 col-sm-1 p-1"></div>
                    <div class="col-12 col-sm-3 col-md-2 p-1">Source Of Income:</div>
                    <div class="col-12 col-sm-7 col-md-8 p-1"><?= $member['income_explain'] ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-0 col-sm-1 p-1"></div>
                    <div class="col-12 col-sm-3 col-md-10 p-1">Planed Work if other helps are offered:</div>
                </div>
                <div class="row">
                    <div class="col-0 col-sm-1 p-1"></div>
                    <div class="col-12 col-sm-3 col-md-10 p-1"><?= $member['planned_action'] ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-0 col-sm-1 p-1"></div>
                    <div class="col-12 col-sm-3 col-md-2 p-1">Donation Start:</div>
                    <div class="col-12 col-sm-7 col-md-8 p-1">
                        <?= $member['start_collect'] ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-0 col-sm-1 p-1"></div>
                    <div class="col-12 col-sm-3 col-md-2 p-1">Donation Closed:</div>
                    <div class="col-12 col-sm-7 col-md-8 p-1">
                        <?= $member['end_collect'] ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-0 col-sm-1 p-1"></div>
                    <div class="col-12 col-sm-3 col-md-2 p-1">Help Needed:</div>
                    <div class="col-12 col-sm-7 col-md-8 p-1">
                    </div>
                </div>
                <div class="row">
                    <div class="col-0 col-sm-1 p-1"></div>
                    <div class="col-12 col-sm-7 col-md-10 p-1">
                        <?php
                        $helps = $db->runquery("SELECT * FROM `members_help_category` INNER JOIN `help_categories` ON `members_help_category`.`help_category_id`=`help_categories`.`id` WHERE `members_help_category`.`member_id` = '$Identification_id'");
                        if ($helps->num_rows > 0) {
                            $i = 1;
                            while ($help = $helps->fetch_assoc()) {
                                ?>
                                <div class="pl-5"><?= $i . ". " . $help['name'] ?></div>
                                <?php
                                $i++;
                            }
                        }
                        ?>
                        <div><?= $member['help_needed'] ?></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-0 col-sm-1 p-1"></div>
                    <div class="col-12 col-sm-3 col-md-2 p-1"
                </div>
                <div class="col-12 col-sm-7 col-md-8 p-1">
                    <a class="btn btn-success" href="donation-payment.php?asnaf=<?= $asnaf_id ?>">Donate</a>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- content-wrapper ends -->
<?php
include('./partials/_footer.php');
?>