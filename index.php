<?php
session_start();
include_once("./php/autoload.php");
$title = "Asnaf Commitee";
include_once('./partials/checckloggedout.php');
include('partials/header.php');
$date = date('Y-m-d', time());
$sql = "SELECT * FROM `asnaf` INNER JOIN `all_members` ON `asnaf`.`Identification_id`=`all_members`.`Identification_id` INNER JOIN `donation_project` ON `member_id`=`all_members`.`Identification_id` WHERE '$date'>=`start_collect` AND '$date'<=`end_collect`";
if (isset($_GET['search'])) {
    $key = $_GET['search'];
    $sql .= "AND CONCAT_WS( `life_condition`, `name`, `nick_name` ) LIKE '%$key%'";
}
$sql .= " ORDER BY `nick_name` ASC";
$select = $db->runquery($sql);
$count = $select->num_rows;

?>
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <?php include_once('./partials/searchform.php') ?>
                <?php if ($count > 0) { ?>
                <div id="printContent" data-title="Asnaf list">
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-success printbtn" onclick="printDiv('printContent')">
                            <span class="text-white">Print</span>
                        </a>
                        <?php include_once('./partials/printdate.php') ?>
                    </div>
                    <?php
                    }
                    ?>
                    <div class="row columnTitle">
                        <div class="col-2 col-sm-1 p-1 text-right"></div>
                        <div class="col-10 col-sm-11 p-1">
                            <div class="row mb-3">
                                <div class="col-md-2">Nick Name</div>
                                <div class="col-md-6">
                                    Condition
                                </div>
                                <div class="col-md-2">
                                    City
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                        </div>
                    </div>
                    <?php

                    if ($count > 0) {
                        $i = 1;
                        while ($member = $select->fetch_assoc()) {

//                        if($date > $member['start_collect'] AND $member['end_collect'] > $date){
//                            echo 'okay';
//                        }
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
                            ?>
                            <div class="row">
                                <div class="col-2 col-sm-1 p-1 text-right">
                                    <?= $i . '.' ?>
                                </div>
                                <div class="col-10 col-sm-11 p-1">
                                    <div class="row mb-3">
                                        <div class="col-md-2"><?= $nick_name ?></div>
                                        <div class="col-md-6">
                                            <?= substr($life_condition, 0, 200) ?>...
                                        </div>
                                        <div class="col-md-2">
                                            <?= is_numeric($city) ? $db->runquery("SELECT * FROM `cities` WHERE `id`='$city'")->fetch_assoc()['name'] : $city ?>
                                        </div>
                                        <div class="col-md-2 save_as">
                                            <a href="asnaf_details_public.php?asnaf=<?= $asnaf_id ?>"
                                               class="btn btn-primary"><i class="mdi mdi-eye"></i> Details </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
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