<?php
include_once("../php/autoload.php");
include_once("./partials/checkAdmin.php");
$title = "Asnaf Commitee";
include('./partials/header.php');
if (isset($_GET['user'])) {
    $Identification_id = $_GET['user'];
} else {
    header('./members.php');
}
$sql = "SELECT * FROM `all_members` WHERE `all_members`.`Identification_id`='$Identification_id'";
$select = $db->runquery($sql);
$user = $select->fetch_assoc();
$Identification_id = $user['Identification_id'];
$name = $user['name'] ?? '';
$address1 = $user['address1'] ?? '';
$address2 = $user['address2'] ?? '';
$area = $user['area'] ?? '';
$city = $user['city'] ?? '';
$state = $user['state'] ?? '';
$postcode = $user['postcode'] ?? '';
$country = $user['country'] ?? '';
$country = $user['country'] ?? "";
$telephone = $user['telephone'] ?? "";
$mosque_id = $user['mosque_id'] ?? "";

$id_type = $user['id_type']??"";
$id_no = $user['id_no']??"";
$id_international = $user['id_international']??"";
$birth_date = $user['birth_date']??"";
$birth_state = $user['birth_state']??"";
$birth_country = $user['birth_country']??"";
$married_status = $user['married_status']??"";
$convert_date = $user['convert_date']??"";
$citizenship = $user['citizenship']??"";
$state_since = $user['state_since']??"";
$race = $user['race']??"";
$edu = $user['edu']??"";
$edu_others = $user['edu_others']??"";
$health_good = $user['health_good']??"";
$health_cri_iii = $user['health_cri_iii']??"";
$health_cri_iii_cost = $user['health_cri_iii_cost']??"";
$health_dis = $user['health_dis']??"";
$health_dis_rea = $user['health_dis_rea']??"";
$health_dis_severe = $user['health_dis_severe']??"";
$health_dis_cost = $user['health_dis_cost']??"";
$health_old = $user['health_old']??"";
$health_old_cost = $user['health_old_cost']??"";
$house_acc = $user['house_acc']??"";
$house_prov = $user['house_prov']??"";
$house_land = $user['house_land']??"";
$house_land_others = $user['house_land_others']??"";
$house_type = $user['house_type']??"";
$house_type_others = $user['house_type_others']??"";
$house_made_of = $user['house_made_of']??"";
$house_condition = $user['house_condition']??"";
$house_water = $user['house_water']??"";
$house_water_bill = $user['house_water_bill']??"";
$house_electric = $user['house_electric']??"";
$house_electric_bill = $user['house_electric_bill']??"";
$house_maint = $user['house_maint']??"";
$house_maint_bill = $user['house_maint_bill']??"";
$basic_skills = $user['basic_skills']??"";
$basic_skills_others = $user['basic_skills_others']??"";
$liquid_assets = $user['liquid_assets']??"";
$total_fixed_assets = $user['total_fixed_assets']??"";
$family_head_name = $user['family_head_name']??"";
$head_id_type = $user['head_id_type']??"";
$head_id_no = $user['head_id_no']??"";
$family_head_relation = $user['family_head_relation']??"";
$family_head_relation_other = $user['family_head_relation_other']??"";
$pay_method = $user['pay_method']??"";
$pay_method_reason = $user['pay_method_reason']??"";
$bank_name = $user['bank_name']??"";
$pay_method_reason = $user['pay_method_reason']??"";
$bank_account_no = $user['bank_account_no']??"";
$bank_account_holder_name = $user['bank_account_holder_name']??"";
$nick_name = $user['nick_name']??"";
$life_condition = $user['life_condition']??"";
$notes = $user['notes']??"";
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-6 col-sm-8 col-lg-5 col-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update User</h4>
                    <form class="forms-sample" action="formsubmit.php" method="POST" id="update_user">
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" id="name" value="<?= $name ?>"
                                placeholder="Name">
                        </div>
                        <div class="form-group">
                            <select name="mosque_id" class="form-control" id="mosque_id">
                                <option value="">Select Mosque</option>
                                <?php
                                $sql = "SELECT * FROM `mosques`";
                                $select = $db->runquery($sql);
                                if ($select->num_rows > 0) {
                                    while ($row = $select->fetch_assoc()) {
                                ?>
                                <option value="<?= $row['mosque_id'] ?>"
                                    <?= $core->itemSelected($row['mosque_id'], $mosque_id) ?>><?= $row['mosque_name'] ?>
                                </option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="address1" name="address1"
                                value="<?= $address1 ?>" placeholder="Address 1">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="address2" name="address2"
                                value="<?= $address2 ?>" placeholder="Address 2">
                        </div>
                        <div class="form-group">
                            <input type="text" id="area" name="area" class="form-control" value="<?= $area ?>"
                                placeholder="Area">

                        </div>
                        <div class="form-group">
                            <input type="text" id="city" name="city" class="form-control" value="<?= $city ?>"
                                placeholder="City">
                        </div>
                        <div class="form-group">
                            <input type="text" id="postcode" name="postcode" value="<?= $postcode ?>"
                                class="form-control" placeholder="Post Code">
                        </div>
                        <div class="form-group">
                            <input type="text" id="state" name="state" value="<?= $state ?>" class="form-control"
                                placeholder="State">
                        </div>
                        <div class="form-group">
                            <input type="text" id="country" name="country" value="<?= $country ?>" class="form-control"
                                placeholder="Country">
                        </div>
                        <div class="form-group">
                            <input type="text" id="telephone" name="telephone" value="<?= $telephone ?>"
                                class="form-control" placeholder="Telephone">
                        </div>

                        <div class="form-group">
                            <select name="id_type" class="form-control" id="id_type">
                                <option value="">ID Type</option>
                                <?php 
                                foreach ($idtypes as $key => $idtype) {
                                    ?>
                                <option value="<?= $idtype ?>" <?= $core->itemSelected($id_type, $idtype) ?>>
                                    <?= $idtype ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" id="id_no" name="id_no" class="form-control" placeholder="ID No"
                                value="<?= $id_no ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" id="id_international" name="id_international" class="form-control"
                                placeholder="ID International" value="<?= $id_international ?>">
                        </div>
                        <div class="form-group">
                            <label for="birth_date">Birth Date</label>
                            <input type="date" id="birth_date" name="birth_date" class="form-control"
                                placeholder="Birth Date" value="<?= $birth_date ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" id="birth_state" name="birth_state" class="form-control"
                                placeholder="Birth State" value="<?= $birth_state ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" id="birth_country" name="birth_country" class="form-control"
                                value="<?= $birth_country ?>" placeholder="Birth Country">
                        </div>
                        <div class="form-group">
                            <select name="married_status" class="form-control" id="married_status">
                                <option value="">Married Status</option>
                                <?php 
                                foreach ($marriedstatus as $key => $status) {
                                    ?>
                                <option value="<?= $status ?>" <?= $core->itemSelected($married_status, $status) ?>>
                                    <?= $status ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="convert_date">Convert Date</label>
                            <input type="date" id="convert_date" name="convert_date" class="form-control"
                                value="<?= $convert_date ?>" placeholder="Convert Date">
                        </div>
                        <div class="form-group">
                            <input type="text" id="citizenship" name="citizenship" class="form-control"
                                value="<?= $citizenship ?>" placeholder="Citizenship">
                        </div>
                        <div class="form-group">
                            <label for="state_since">State Since</label>
                            <input type="date" id="state_since" name="state_since" class="form-control"
                                value="<?= $state_since ?>" placeholder="State Since">
                        </div>
                        <div class="form-group">
                            <select name="race" class="form-control" id="race">
                                <option value="">Race</option>
                                <?php 
                                foreach ($races as $key => $race) {
                                    ?>
                                <option value="<?= $race ?>" <?= $core->itemSelected($user['race'], $race) ?>>
                                    <?= $race ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="edu" class="form-control" id="edu">
                                <option value="">Edu</option>
                                <?php 
                                foreach ($educations as $key => $edu) {
                                    ?>
                                <option value="<?= $edu ?>" <?= $core->itemSelected($user['edu'], $edu) ?>>
                                    <?= $edu ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" id="edu_others" name="edu_others" class="form-control"
                                value="<?= $edu_others ?>" placeholder="Edu Others">
                        </div>
                        <div class="form-group">
                            <select name="health_good" class="form-control" id="health_good">
                                <option value="">Health Good</option>
                                <option value="Yes" <?= $core->itemSelected("Yes", $health_good) ?>>Yes</option>
                                <option value="No" <?= $core->itemSelected("No", $health_good) ?>>No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="health_cri_iii" class="form-control" id="health_cri_iii">
                                <option value="">Helath Cri III</option>
                                <?php 
                                foreach ($health_cri_iiis as $key => $health_cri_iii) {
                                    ?>
                                <option value="<?= $health_cri_iii ?>"
                                    <?= $core->itemSelected($user['health_cri_iii'], $health_cri_iii) ?>>
                                    <?= $health_cri_iii ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="number" id="health_cri_iii_cost" name="health_cri_iii_cost"
                                value="<?= $health_cri_iii_cost ?>" class="form-control"
                                placeholder="Health Cri III Cost">
                        </div>
                        <div class="form-group">
                            <select name="health_dis" class="form-control" id="health_dis">
                                <option value="">Health Dis</option>
                                <?php 
                                foreach ($health_dises as $key => $health_dise) {
                                    ?>
                                <option value="<?= $health_dise ?>"
                                    <?= $core->itemSelected($user['health_dis'], $health_dise) ?>>
                                    <?= $health_dise ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="health_dis_rea" class="form-control" id="health_dis_rea">
                                <option value="">Health Dis Rea</option>
                                <?php 
                                foreach ($health_dis_reasons as $key => $health_dis_reason) {
                                    ?>
                                <option value="<?= $health_dis_reason ?>"
                                    <?= $core->itemSelected($user['health_dis_rea'], $health_dis_reason) ?>>
                                    <?= $health_dis_reason ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="health_dis_severe" class="form-control" id="health_dis_severe">
                                <option value="">Health Dis Severe</option>
                                <?php 
                                foreach ($health_cri_iiis as $key => $health_cri_iii) {
                                    ?>
                                <option value="<?= $health_cri_iii ?>"
                                    <?= $core->itemSelected($user['health_cri_iii'], $health_cri_iii) ?>>
                                    <?= $health_cri_iii ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="number" id="health_dis_cost" name="health_dis_cost" class="form-control"
                                value="<?= $health_dis_cost ?>" placeholder="Health Dis Cost">
                        </div>
                        <div class="form-group">
                            <select name="health_old" class="form-control" id="health_old">
                                <option value="">Health Old</option>
                                <?php 
                                foreach ($health_cri_iiis as $key => $health_cri_iii) {
                                    ?> <option value="<?= $health_cri_iii ?>"
                                    <?= $core->itemSelected($user['health_cri_iii'], $health_cri_iii) ?>>
                                    <?= $health_cri_iii ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="number" id="health_old_cost" name="health_old_cost" class="form-control"
                                value="<?= $health_old_cost ?>" placeholder="Health Old Cost">
                        </div>
                        <div class="form-group">
                            <select name="house_acc" class="form-control" id="house_acc">
                                <option value="">House Acc</option>
                                <?php 
                                foreach ($house_accs as $key => $house_acc) {
                                    ?>
                                <option value="<?= $house_acc ?>"
                                    <?= $core->itemSelected($user['house_acc'], $house_acc) ?>>
                                    <?= $house_acc ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" id="house_prov" name="house_prov" class="form-control"
                                value="<?= $house_prov ?>" placeholder="House Prov">
                        </div>
                        <div class="form-group">
                            <select name="house_land" class="form-control" id="house_land">
                                <option value="">House Land</option>
                                <?php 
                                foreach ($house_lands as $key => $house_land) {
                                    ?>
                                <option value="<?= $house_land ?>"
                                    <?= $core->itemSelected($user['house_land'], $house_land) ?>>
                                    <?= $house_land ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" id="house_land_others" name="house_land_others" class="form-control"
                                value="<?= $house_land_others ?>" placeholder="House land others">
                        </div>
                        <div class="form-group">
                            <select name="house_type" class="form-control" id="house_type">
                                <option value="">House Type</option>
                                <?php 
                                foreach ($house_types as $key => $house_type) {
                                    ?>
                                <option value="<?= $house_type ?>"
                                    <?= $core->itemSelected($user['house_type'], $house_type) ?>>
                                    <?= $house_type ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" id="house_type_others" name="house_type_others" class="form-control"
                                value="<?= $house_type_others ?>" placeholder="House type others">
                        </div>
                        <div class="form-group">
                            <select name="house_made_of" class="form-control" id="house_made_of">
                                <option value="">House Made Of</option>
                                <?php 
                                foreach ($house_made_ofs as $key => $house_made_of) {
                                    ?>
                                <option value="<?= $house_made_of ?>"
                                    <?= $core->itemSelected($user['house_made_of'], $house_made_of) ?>>
                                    <?= $house_made_of ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="house_condition" class="form-control" id="house_condition">
                                <option value="">House Condition</option>
                                <?php 
                                foreach ($house_conditions as $key => $house_condition) {
                                    ?>
                                <option value="<?= $house_condition ?>"
                                    <?= $core->itemSelected($user['house_condition'], $house_condition) ?>>
                                    <?= $house_condition ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="house_water" class="form-control" id="house_water">
                                <option value="">House Water</option>
                                <option value="Yes" <?= $core->itemSelected("Yes", $house_water) ?>>Yes</option>
                                <option value="No" <?= $core->itemSelected("No", $house_water) ?>>No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="number" id="house_water_bill" name="house_water_bill" class="form-control"
                                value="<?= $house_water_bill ?>" placeholder="House Water Bill">
                        </div>
                        <div class="form-group">
                            <select name="house_electric" class="form-control" id="house_electric">
                                <option value="">House Electric</option>
                                <option value="Yes" <?= $core->itemSelected("Yes", $house_electric) ?>>Yes</option>
                                <option value="No" <?= $core->itemSelected("No", $house_electric) ?>>No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="number" id="house_electric_bill" name="house_electric_bill"
                                value="<?= $house_electric_bill ?>" class="form-control"
                                placeholder="House Electric Bill">
                        </div>
                        <div class="form-group">
                            <select name="house_maint" class="form-control" id="house_maint">
                                <option value="">House Maint</option>
                                <option value="Yes" <?= $core->itemSelected("Yes", $house_maint) ?>>Yes</option>
                                <option value="No" <?= $core->itemSelected("No", $house_maint) ?>>No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="number" id="house_maint_bill" name="house_maint_bill" class="form-control"
                                value="<?= $house_maint_bill ?>" placeholder="House Maint Bill">
                        </div>
                        <div class="form-group">
                            <select name="basic_skills" class="form-control" id="basic_skills">
                                <option value="">Basic Skills</option>
                                <<?php 
                                foreach ($basic_skilles as $key => $basic_skill) {
                                    ?> <option value="<?= $basic_skill ?>"
                                    <?= $core->itemSelected($user['basic_skills'], $basic_skill) ?>><?= $basic_skill ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" id="basic_skills_others" name="basic_skills_others"
                                value="<?= $basic_skills_others ?>" class="form-control"
                                placeholder="Basic Skills Others">
                        </div>
                        <div class="form-group">
                            <input type="number" id="liquid_assets" name="liquid_assets" class="form-control"
                                value="<?= $liquid_assets ?>" placeholder="Liquid Assets">
                        </div>
                        <div class="form-group">
                            <input type="number" id="total_fixed_assets" name="total_fixed_assets" class="form-control"
                                value="<?= $total_fixed_assets ?>" placeholder="Total Fixed Assets">
                        </div>
                        <div class="form-group">
                            <input type="text" id="family_head_name" name="family_head_name" class="form-control"
                                value="<?= $family_head_name ?>" placeholder="Family Head Name">
                        </div>
                        <div class="form-group">
                            <select name="head_id_type" class="form-control" id="head_id_type">
                                <option value="">Head ID Type</option>
                                <option value="MyKad">MyKad</option>
                                <?php 
                                foreach ($idtypes as $key => $idtype) {
                                    ?>
                                <option value="<?= $idtype ?>" <?= $core->itemSelected($user['id_type'], $idtype) ?>>
                                    <?= $idtype ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" id="head_id_no" name="head_id_no" class="form-control"
                                value="<?= $head_id_no ?>" placeholder="Head ID No">
                        </div>
                        <div class="form-group">
                            <select name="family_head_relation" class="form-control" id="family_head_relation">
                                <option value="">Family Head Realtion</option>
                                <?php 
                                foreach ($family_head_relations as $key => $family_head_relation) {
                                    ?>
                                <option value="<?= $family_head_relation ?>"
                                    <?= $core->itemSelected($user['family_head_relation'], $family_head_relation) ?>>
                                    <?= $family_head_relation ?>
                                </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" id="family_head_relation_other" name="family_head_relation_other"
                                value="<?= $family_head_relation_other ?>" class="form-control"
                                placeholder="Family Head Relation Other">
                        </div>
                        <div class="form-group">
                            <select name="pay_method" class="form-control" id="pay_method">
                                <option value="">Pay Method</option>
                                <?php 
                                foreach ($pay_methods as $key => $pay_method) {
                                    ?>
                                <option value="<?= $pay_method ?>"
                                    <?= $core->itemSelected($user['pay_method'], $pay_method) ?>>
                                    <?= $pay_method ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="pay_method_reason" class="form-control" id="pay_method_reason">
                                <option value="">Pay Method Reason</option>
                                <?php 
                                foreach ($pay_method_reasons as $key => $pay_method_reason) {
                                    ?>
                                <option value="<?= $pay_method_reason ?>"
                                    <?= $core->itemSelected($user['pay_method_reason'], $pay_method_reason) ?>>
                                    <?= $pay_method_reason ?>
                                </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" id="bank_name" name="bank_name" class="form-control"
                                value="<?= $bank_name ?>" placeholder="Bank Name">
                        </div>
                        <div class="form-group">
                            <input type="text" id="bank_account_no" name="bank_account_no" class="form-control"
                                value="<?= $bank_account_no ?>" placeholder="Bank Accound No">
                        </div>
                        <div class="form-group">
                            <input type="text" id="bank_account_holder_name" name="bank_account_holder_name"
                                value="<?= $bank_account_holder_name ?>" class="form-control"
                                placeholder="Bank Account Holder Name">
                        </div>
                        <div class="form-group">
                            <textarea name="notes" class="form-control" id rows="3"
                                placeholder="Notes"><?= $notes ?></textarea>
                        </div>
                        <div class="form-group">
                            <input type="text" id="life_condition" name="life_condition" value="<?= $life_condition ?>"
                                class="form-control" placeholder="life condition">
                        </div>
                        <div class="form-group">
                            <input type="text" id="nick_name" name="nick_name" value="<?= $nick_name ?>"
                                class="form-control" placeholder="Nick Name">
                        </div>
                        <input type="hidden" name="Identification_id" value="<?= $Identification_id ?>">
                        <input type="hidden" name="update_user" value="1">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$('form#update_user').submit(function(e) {
    e.preventDefault();
    var formid = $(this);
    submitForm(e, formid, isAdded);
});

function isAdded(response) {
    if (response.status == 1) {
        setTimeout(() => {
            window.location.href = response.url;
        }, 3000);
    }
};
</script>
<!-- content-wrapper ends -->
<?php
include('./partials/_footer.php');
?>