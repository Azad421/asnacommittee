<?php
include_once("../php/autoload.php");
include_once("./partials/checkAdmin.php");
$title = "Asnaf Commitee - Members";
include('partials/header.php');
if (isset($_GET['committee'])) {
    $committee_id = $_GET['committee'];
} else {
    header('location:./committee.php');
}
$sql = "SELECT * FROM `commitee` INNER JOIN `mosques` ON `commitee`.`mosque_Id`=`mosques`.`mosque_id` INNER JOIN `all_members` ON `commitee`.`Identification_id`=`all_members`.`Identification_id` WHERE `committee_id`='$committee_id'";
$select = $db->runquery($sql);
$count = $select->num_rows;
$row = $select->fetch_assoc();
$Identification_id = $row['Identification_id'];
$name = $row['name'];
$telephone = $row['telephone'];
$position = $row['position'];
$asnaf_name = $row['asnaf_name'];
$mosque_name = $row['mosque_name'];
?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body px-5">
            <div class="col-12 mx-auto" id="printContent" data-title="<?= $name ?>">
                <?php if ($count > 0) { ?>
                <div class="d-flex justify-content-end">
                    <a class="btn btn-success printbtn" onclick="printDiv('printContent')">
                        <span class="text-white">Print</span>
                    </a>
                    <?php include_once('./partials/printdate.php') ?>
                </div>
                <?php
                }
                if ($count > 0) {
                    

                        $id_type = $row['id_type'];
                        $id_no = $row['id_no'];
                        $id_international = $row['id_international'];
                        $birth_date = $row['birth_date'];
                        $birth_state = $row['birth_state'];
                        $birth_country = $row['birth_country'];
                        $married_status = $row['married_status'];
                        $convert_date = $row['convert_date'];
                        $citizenship = $row['citizenship'];
                        $state_since = $row['state_since'];
                        $race = $row['race'];
                        $edu = $row['edu'];
                        $edu_others = $row['edu_others'];
                        $health_good = $row['health_good'];
                        $health_cri_iii = $row['health_cri_iii'];
                        $health_cri_iii_cost = $row['health_cri_iii_cost'];
                        $health_dis = $row['health_dis'];
                        $health_dis_rea = $row['health_dis_rea'];
                        $health_dis_severe = $row['health_dis_severe'];
                        $health_dis_cost = $row['health_dis_cost'];
                        $health_old = $row['health_old'];
                        $health_old_cost = $row['health_old_cost'];
                        $house_acc = $row['house_acc'];
                        $house_prov = $row['house_prov'];
                        $house_land = $row['house_land'];
                        $house_land_others = $row['house_land_others'];
                        $house_type = $row['house_type'];
                        $house_type_others = $row['house_type_others'];
                        $house_made_of = $row['house_made_of'];
                        $house_condition = $row['house_condition'];
                        $house_water = $row['house_water'];
                        $house_water_bill = $row['house_water_bill'];
                        $house_electric = $row['house_electric'];
                        $house_electric_bill = $row['house_electric_bill'];
                        $house_maint = $row['house_maint'];
                        $house_maint_bill = $row['house_maint_bill'];
                        $basic_skills = $row['basic_skills'];
                        $basic_skills_others = $row['basic_skills_others'];
                        $liquid_assets = $row['liquid_assets'];
                        $total_fixed_assets = $row['total_fixed_assets'];
                        $family_head_name = $row['family_head_name'];
                        $head_id_type = $row['head_id_type'];
                        $head_id_no = $row['head_id_no'];
                        $family_head_relation = $row['family_head_relation'];
                        $family_head_relation_other = $row['family_head_relation_other'];
                        $pay_method = $row['pay_method'];
                        $pay_method_reason = $row['pay_method_reason'];
                        $bank_name = $row['bank_name'];
                        $pay_method_reason = $row['pay_method_reason'];
                        $bank_account_no = $row['bank_account_no'];
                        $bank_account_holder_name = $row['bank_account_holder_name'];
                        $notes = $row['notes'];
                        
                    ?>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="col-sm-3">Login Id :</div>
                    <div class="col-sm-7"> <?= $asnaf_name ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="col-sm-3">Mosque Name :</div>
                    <div class="col-sm-7"> <?= $mosque_name ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="col-sm-3">Telephone :</div>
                    <div class="col-sm-7"> <?= $telephone ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="col-sm-3">Position :</div>
                    <div class="col-sm-7"> <?= $position ?></div>
                </div>
                <div class="row">
                    <div class="col-1 mb-3"></div>
                </div>
                <?php
                } else {
                    ?>
                <h4 class="text-center mb-0">No members found</h4>
                <?php
                }

                ?>
            </div>
        </div>
    </div>
</div>
<!-- content-wrapper ends -->
<?php
include('partials/_footer.php');
?>