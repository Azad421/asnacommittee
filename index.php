<?php
session_start();
include_once("./php/autoload.php");
$title = "Jalaria Individuals";
include_once('./partials/checckloggedout.php');
include('partials/header.php');
$date = date('Y-m-d', time());
$sql = "SELECT * FROM `asnaf` INNER JOIN `all_members` ON `asnaf`.`Identification_id`=`all_members`.`Identification_id` INNER JOIN `donation_project` ON `member_id`=`all_members`.`Identification_id` INNER JOIN `mosque_areas` ON `mosque_areas`.`area_id`=`all_members`.`area` WHERE '$date'>=`start_collect` AND '$date'<=`end_collect`";
if (isset($_GET['search'])) {
    $key = $_GET['search'];
    $sql .= " AND CONCAT_WS( `life_condition`, `name`, `nick_name`, `mosque_areas`.`area_name` ) LIKE '%$key%'";
}
$sql .= " ORDER BY `nick_name` ASC";
$select = $db->runquery($sql);
//echo $sql;
//echo $db->con->error;
$count = $select->num_rows;
?>
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <?php if ($count > 0) { ?>
                <div id="printContent" data-title="Asnaf list">
                    <div class="d-flex justify-content-end">
                        <?php include_once('./partials/printdate.php') ?>
                    </div>
                    <?php
                    }
                    ?>
                    <?php

                    if ($count > 0) {
                        $i = 1;
                        while ($member = $select->fetch_assoc()) {
                            $asnaf_id = $member['asnaf_id'];
                            $Identification_id = $member['Identification_id'];
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

                            $references = $db->runquery("SELECT * FROM `asnaf_references` WHERE `asnaf_id`='$asnaf_id' AND `source`='Registered' AND `expiry_date`>='$date'");
                            $rCount = $references->num_rows;
                            if ($rCount > 0) {
                                ?>
                                <a href="asnaf_details_public.php?asnaf=<?= $asnaf_id ?>" class="text-dark">
                                    <div class="row mb-3">
                                        <div class="col-md-2"><p class="mb-0"><b><?= strip_tags($nick_name) ?></b></p></div>
                                        <div class="col-md-6">
                                            <p class="mb-0"><?= substr(strip_tags($life_condition), 0, 200) ?>...</p>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="mb-0">
                                                <?= is_numeric($area) ? $db->runquery("SELECT * FROM `mosque_areas` WHERE `area_id`='$area'")->fetch_assoc()['area_name'] : $area; ?>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                                <?php
                            }
                            $i++;
                        }
                    } else {
                        include_once('./partials/empty.php');
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
<?php
include('./partials/_footer.php');
?>