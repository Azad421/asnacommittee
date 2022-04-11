<?php
include_once("../php/autoload.php");
include_once("./partials/checkAdmin.php");
$title = "Asnaf Commitee - Members";
include('partials/header.php');
if (isset($_GET['member'])) {
    $member_id = $_GET['member'];
} else {
    header('location:./members.php');
}
$sql = "SELECT * FROM `all_members` WHERE `Identification_id`='$member_id'";
$select = $db->runquery($sql);
$count = $select->num_rows;
$row = $select->fetch_assoc();
$Identification_id = $row['Identification_id'];
$name = $row['name'];
?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body px-5">
            <div class="col-12" id="printContent" data-title="<?= $name ?>">
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
                    
                    $address1 = $row['address1'];
                    $address2 = $row['address2'];
                    $area = $row['area'];
                    $city = $row['city'];
                    $state = $row['state'];
                    $postcode = $row['postcode'];
                    $country = $row['country'];
                    $telephone = $row['telephone'];
                    $mosque_id = $row['mosque_id'];
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
                    $nick_name = $row['nick_name'];
                    $life_condition = $row['life_condition'];

                    $sqlO = "SELECT * FROM `mosques` WHERE `mosque_id`='$mosque_id'";
                    $selectO = $db->runquery($sqlO);
                    $mosque = $selectO->fetch_assoc();
                    $mosque_name = $mosque['mosque_name'];
                ?>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class=" col-sm-3">Name:</div>
                    <div class=" col-sm-7"> <?= $name ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Address 1:</div>
                    <div class="  col-sm-7"> <?= $address1 ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Address 2 :</div>
                    <div class="  col-sm-7"><?= $address2 ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Area :</div>
                    <div class="  col-sm-7"><?= is_numeric($area)?$db->runquery("SELECT * FROM `mosque_areas` WHERE `area_id`='$area'")->fetch_assoc()['area_name']:$area ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">City :</div>
                    <div class="  col-sm-7"><?= is_numeric($city)?$db->runquery("SELECT * FROM `cities` WHERE `id`='$city'")->fetch_assoc()['name']:$city ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">State :</div>
                    <div class="  col-sm-7"><?= is_numeric($state)?$db->runquery("SELECT * FROM `states` WHERE `id`='$state'")->fetch_assoc()['name']:$state ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Post Code :</div>
                    <div class="  col-sm-7"><?= $postcode ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Country :</div>
                    <div class="  col-sm-7"><?= $country ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Telephone :</div>
                    <div class="  col-sm-7"><?= $telephone ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Mosque :</div>
                    <div class="  col-sm-7"><?= $mosque_name ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">ID Type :</div>
                    <div class="  col-sm-7"><?= $id_type ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">ID No :</div>
                    <div class="  col-sm-7"><?= $id_no ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">ID International :</div>
                    <div class="  col-sm-7"><?= $id_international ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Birth Date :</div>
                    <div class="  col-sm-7"><?= $birth_date ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Birth State :</div>
                    <div class="  col-sm-7"><?= $birth_state ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Birth Country :</div>
                    <div class="  col-sm-7"><?= $birth_country ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Married Status :</div>
                    <div class="  col-sm-7"><?= $married_status ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Convert Date :</div>
                    <div class="  col-sm-7"><?= $convert_date ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Citizenship :</div>
                    <div class="  col-sm-7"><?= $citizenship ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">State Since :</div>
                    <div class="  col-sm-7"><?= $state_since ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Race :</div>
                    <div class="  col-sm-7"><?= $race ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Education :</div>
                    <div class="  col-sm-7"><?= $edu ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Education Others :</div>
                    <div class="  col-sm-7"><?= $edu_others ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Health Condition Good :</div>
                    <div class="  col-sm-7"><?= $health_good ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Health Condition Critical III:</div>
                    <div class="  col-sm-7"><?= $health_cri_iii ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Health Condition Critical III Cost Per Month :</div>
                    <div class="  col-sm-7"><?= $health_cri_iii_cost ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Health Condition-Disabled :</div>
                    <div class="  col-sm-7"><?= $health_dis ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Health Condition-Disabled Reasons :</div>
                    <div class="  col-sm-7"><?= $health_dis_rea ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Health Condition-Disabled Severity :</div>
                    <div class="  col-sm-7"><?= $health_dis_severe ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Health Condition-Disabled Xost Per Month :</div>
                    <div class="  col-sm-7"><?= $health_dis_cost ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Health Condition-Very Old :</div>
                    <div class="  col-sm-7"><?= $health_old ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Health Condition-Very Old Cost Per month :</div>
                    <div class="  col-sm-7"><?= $health_old_cost ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">House Accomodation :</div>
                    <div class="  col-sm-7"><?= $house_acc ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">House Accomodation Provided By :</div>
                    <div class="  col-sm-7"><?= $house_prov ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Land For The House :</div>
                    <div class="  col-sm-7"><?= $house_land ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Other Ownership Of The Land Of the House :</div>
                    <div class="  col-sm-7"><?= $house_land_others ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">House Type :</div>
                    <div class="  col-sm-7"><?= $house_type ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">House Type Other :</div>
                    <div class="  col-sm-7"><?= $house_type_others ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">House Made Of material :</div>
                    <div class="  col-sm-7"><?= $house_made_of ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">House Condition :</div>
                    <div class="  col-sm-7"><?= $house_condition ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">House Water :</div>
                    <div class="  col-sm-7"><?= $house_water ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">House Water Bill :</div>
                    <div class="  col-sm-7"><?= $house_water_bill ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">House Electric :</div>
                    <div class="  col-sm-7"><?= $house_electric ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">House Electric Bill :</div>
                    <div class="  col-sm-7"><?= $house_electric_bill ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">House Maintenance :</div>
                    <div class="  col-sm-7"><?= $house_maint ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">House Maintenance Bill :</div>
                    <div class="  col-sm-7"><?= $house_maint_bill ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Basic Skills :</div>
                    <div class="  col-sm-7"><?= $basic_skills ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Other Basic Skills :</div>
                    <div class="  col-sm-7"><?= $basic_skills_others ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Total Liquid Asset :</div>
                    <div class="  col-sm-7"><?= $liquid_assets ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Total Fixed Asset :</div>
                    <div class="  col-sm-7"><?= $total_fixed_assets ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Family Head Name :</div>
                    <div class="  col-sm-7"><?= $family_head_name ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Head Id Type :</div>
                    <div class="  col-sm-7"><?= $head_id_type ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Head Id No :</div>
                    <div class="  col-sm-7"><?= $head_id_no ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Family Head Realtion :</div>
                    <div class="  col-sm-7"><?= $family_head_relation ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Family Head Realtion Other :</div>
                    <div class="  col-sm-7"><?= $family_head_relation_other ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Payment Method :</div>
                    <div class="  col-sm-7"><?= $pay_method ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Payment Method Reason :</div>
                    <div class="  col-sm-7"><?= $pay_method_reason ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Bank Name :</div>
                    <div class="  col-sm-7"><?= $bank_name ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Bank Account No :</div>
                    <div class="  col-sm-7"><?= $bank_account_no ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Bank Account Holder Name :</div>
                    <div class="  col-sm-7"><?= $bank_account_holder_name ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Notes :</div>
                    <div class="  col-sm-7"><?= $notes ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">life Condition :</div>
                    <div class="  col-sm-7"><?= $life_condition ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="  col-sm-3">Nick name :</div>
                    <div class="  col-sm-7"><?= $nick_name ?></div>
                </div>
                <?php

                } else {
                ?>
                <h4>No members found</h4>
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