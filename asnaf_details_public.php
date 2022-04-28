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
                <div id="printContent" data-title="<?= $nick_name ?>">
                    <?php if ($count > 0) { ?>
                        <div class="d-flex justify-content-end">
                            <?php include_once('./partials/printdate.php') ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="row">
                        <div class="col-0 col-sm-1 p-1"></div>
                        <div class="col-12 col-sm-11 px-1 py-0"><p><b><?= $nick_name ?></b></p></div>
                    </div>
                    <div class="row">
                        <div class="col-0 col-sm-1 p-1"></div>
                        <div class="col-12 col-sm-11 px-1 py-0">
                            <p><b><?= is_numeric($area) ? $db->runquery("SELECT * FROM `mosque_areas` WHERE `area_id`='$area'")->fetch_assoc()['area_name'] : $area ?></b></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-0 col-sm-1 p-1"></div>
                        <div class="col-12 col-sm-11 px-1 py-0">
                            <p><b><?= is_numeric($city) ? $db->runquery("SELECT * FROM `cities` WHERE `id`='$city'")->fetch_assoc()['name'] : $city ?></b></p>
                        </div>
                    </div>
                    <div class="row pt-3 pb-3">
                        <div class="col-0 col-sm-1 p-1"></div>
                        <div class="col-12 col-sm-11 px-1"><p><?= $life_condition ?></p></div>
                    </div>
                    <?php
                    $sql = "SELECT * FROM `images` WHERE `user_id`='$Identification_id'";
                    $select = $db->runquery($sql);
                    $count = $select->num_rows;
                    if ($count > 0) {
                        while ($image = $select->fetch_assoc()) {
                            if (!empty($image['image_name'])) {
                                ?>
                                <div class="row">
                                    <div class="col-0 col-sm-1 p-1"></div>
                                    <div class="col-12 col-sm-10 p-1">
                                        <img class="img-fluid" src="./images/<?= $image['image_name'] ?>" alt="">
                                    </div>
                                </div>
                                <?php
                            }
                        }
                    }
                    ?>
                    <!--                    <div class="row">-->
                    <!--                        <div class="col-0 col-sm-1 p-1"></div>-->
                    <!--                        <div class="col-12 col-sm-3 p-1"><p>Donations So far:</p></div>-->
                    <!--                        <div class="col-12 col-sm-11 p-1">-->
                    <!--                        </div>-->
                    <!--                    </div>-->
                    <div class="row mb-3">
                        <div class="col-0 col-sm-1 p-1"></div>
                        <div class="col-12 col-sm-11 col-md-10 p-1">
                            <!--                            <div class="row m-0">-->
                            <!--                                <div class="col-4 border border-right-0 p-2"><p>Donors</p></div>-->
                            <!--                                <div class="col-4 border border-left-0 p-2 border-right-0"><p>Amount</p></div>-->
                            <!--                                <div class="col-4 border border-left-0 p-2"><p>Date</p></div>-->
                            <!--                            </div>-->
                            <?php
                            $sql = "SELECT * FROM `donors` INNER JOIN `project_doners` ON `donors`.`id`=`project_doners`.`donor_id` WHERE `user_id`='$Identification_id'";
                            $selectDn = $db->runquery($sql);
                            $count = $selectDn->num_rows;
                            if ($count > 0) {
                                while ($donor = $selectDn->fetch_assoc()) {
                                    ?>
                                    <div class="row m-0">
                                        <div class="col-4 border border-right-0 p-2"></p><?= $donor['donor_name'] ?></p></div>
                                        <div class="col-4 border border-left-0 p-2 border-right-0"></p><?= $donor['amount'] ?></p></div>
                                        <div class="col-4 border border-left-0 p-2"></p><?= $donor['date'] ?></p></div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="col-0 col-sm-1 p-1"></div>
                    </div>
                    <?php
                    $references = $db->runquery("SELECT * FROM `asnaf_references` WHERE `asnaf_id`='$asnaf_id' AND `source`<>'Registered'");
                    $count = $references->num_rows;
                    if ($count > 0) {
                        ?>
                        <div class="row">
                            <div class="col-0 col-sm-1 p-1"></div>
                            <div class="col-12 col-sm-3 p-1"><p>Media Coverage:</p></div>
                            <div class="col-12 col-sm-11 p-1">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-0 col-sm-1 p-1"></div>
                            <div class="col-12 col-sm-11 col-md-10 p-1">

                                <?php
                                $i = 1;
                                while ($reference = $references->fetch_assoc()) {
                                    ?><p><?= $i ?>
                                    . <?= $reference['source'] . ' ' . date('d M Y', strtotime($reference['source_date'])) . ' ' . $reference['title'] ?> </p>
                                    <?php
                                    $i++;
                                }

                                ?>

                            </div>
                        </div>
                    <?php } ?>
                    <div class="row">
                        <div class="col-0 col-sm-1 p-1"></div>
                        <div class="col-12 col-sm-11 p-1">
                            <p><?= $member['income_explain'] ?></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-0 col-sm-1 p-1 pt-3"></div>
                        <div class="col-12 col-sm-3 col-md-10 p-1 pt-3"><p><?= $member['planned_action'] ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-0 col-sm-1 p-1"></div>
                        <div class="col-12 col-sm-11 px-1 pb-0 pt-1"><p>Donation Start:</p></div>
                        <div class="col-0 col-sm-1 p-1"></div>
                        <div class="col-12 col-sm-11 px-1 pb-1 pt-0">
                            <p><?= date('d M Y', strtotime($member['start_collect'])) ?></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-0 col-sm-1 p-1"></div>
                        <div class="col-12 col-sm-11 px-1 pb-0 pt-1"><p>Donation Closed:</p></div>
                        <div class="col-0 col-sm-1 p-1"></div>
                        <div class="col-12 col-sm-11 px-1 pb-1 pt-0">
                            <p> <?= date('d M Y', strtotime($member['end_collect'])) ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-0 col-sm-1 p-1"></div>
                        <div class="col-12 col-sm-3 p-1"><p>Help Needed:</p></div>
                        <div class="col-12 col-sm-11 p-1">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-0 col-sm-1 p-1"></div>
                        <div class="col-12 col-sm-11 col-md-10 p-1 pb-3">
                            <?php
                            $helps = $db->runquery("SELECT * FROM `members_help_category` INNER JOIN `help_categories` ON `members_help_category`.`help_category_id`=`help_categories`.`id` WHERE `members_help_category`.`member_id` = '$Identification_id'");
                            if ($helps->num_rows > 0) {
                                $i = 1;
                                while ($help = $helps->fetch_assoc()) {
                                    ?>
                                    <div><p><?= $i . ". " . $help['name'] ?></p></div>
                                    <?php
                                    $i++;
                                }
                            }
                            ?>
                            <div class="mt-4"></p><?= $member['help_needed'] ?></p></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-11 p-1">
                    <a class="btn btn-success" href="donation-payment.php?asnaf=<?= $asnaf_id ?>">Donate</a>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
<?php
include('./partials/_footer.php');
?>