<?php
include_once("../php/autoload.php");
include_once("./partials/checkAdmin.php");
$title = "Asnaf Commitee";
include('./partials/header.php');
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-6 col-sm-8 col-lg-5 col-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add User</h4>
                    <form class="forms-sample" action="formsubmit.php" method="POST" id="add_user">
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Name">
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
                                <option value="<?= $row['mosque_id'] ?>"><?= $row['mosque_name'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="address1" name="address1"
                                placeholder="Address 1">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="address2" name="address2"
                                placeholder="Address 2">
                        </div>
                        <div class="form-group">
                            <input type="text" id="area" name="area" class="form-control" placeholder="Area">

                        </div>
                        <div class="form-group">
                            <input type="text" id="city" name="city" class="form-control" placeholder="City">
                        </div>
                        <div class="form-group">
                            <input type="text" id="postcode" name="postcode" class="form-control"
                                placeholder="Post Code">
                        </div>
                        <div class="form-group">
                            <input type="text" id="state" name="state" class="form-control" placeholder="State">
                        </div>
                        <div class="form-group">
                            <input type="text" id="country" name="country" class="form-control" placeholder="Country">
                        </div>
                        <div class="form-group">
                            <input type="text" id="telephone" name="telephone" class="form-control"
                                placeholder="Telephone">
                        </div>
                        <div class="form-group">
                            <select name="id_type" class="form-control" id="id_type">
                                <option value="">ID Type</option>
                                <?php 
                                foreach ($idtypes as $key => $idtype) {
                                    ?>
                                <option value="<?= $idtype ?>"><?= $idtype ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" id="id_no" name="id_no" class="form-control" placeholder="ID No">
                        </div>
                        <div class="form-group">
                            <input type="text" id="id_international" name="id_international" class="form-control"
                                placeholder="ID International">
                        </div>
                        <div class="form-group">
                            <label for="birth_date">Birth Date</label>
                            <input type="date" id="birth_date" name="birth_date" class="form-control"
                                placeholder="Birth Date">
                        </div>
                        <div class="form-group">
                            <input type="text" id="birth_state" name="birth_state" class="form-control"
                                placeholder="Birth State">
                        </div>
                        <div class="form-group">
                            <input type="text" id="birth_country" name="birth_country" class="form-control"
                                placeholder="Birth Country">
                        </div>
                        <div class="form-group">
                            <select name="married_status" class="form-control" id="married_status">
                                <option value="">Married Status</option>
                                <?php 
                                foreach ($marriedstatus as $key => $status) {
                                    ?>
                                <option value="<?= $status ?>"><?= $status ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="convert_date">Convert Date</label>
                            <input type="date" id="convert_date" name="convert_date" class="form-control"
                                placeholder="Convert Date">
                        </div>
                        <div class="form-group">
                            <input type="text" id="citizenship" name="citizenship" class="form-control"
                                placeholder="Citizenship">
                        </div>
                        <div class="form-group">
                            <label for="state_since">State Since</label>
                            <input type="date" id="state_since" name="state_since" class="form-control"
                                placeholder="State Since">
                        </div>
                        <div class="form-group">
                            <select name="race" class="form-control" id="race">
                                <option value="">Race</option>
                                <?php 
                                foreach ($races as $key => $race) {
                                    ?>
                                <option value="<?= $race ?>"><?= $race ?></option>
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
                                <option value="<?= $edu ?>"><?= $edu ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" id="edu_others" name="edu_others" class="form-control"
                                placeholder="Edu Other">
                        </div>
                        <div class="form-group">
                            <select name="health_good" class="form-control" id="health_good">
                                <option value="">Health Good</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="health_cri_iii" class="form-control" id="health_cri_iii">
                                <option value="">Helath Cri III</option>
                                <?php 
                                foreach ($health_cri_iiis as $key => $health_cri_iii) {
                                    ?>
                                <option value="<?= $health_cri_iii ?>"><?= $health_cri_iii ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="number" id="health_cri_iii_cost" name="health_cri_iii_cost"
                                class="form-control" placeholder="Health Cri III Cost">
                        </div>
                        <div class="form-group">
                            <select name="health_dis" class="form-control" id="health_dis">
                                <option value="">Health Dis</option>
                                <?php 
                                foreach ($health_dises as $key => $health_dise) {
                                    ?>
                                <option value="<?= $health_dise ?>"><?= $health_dise ?></option>
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
                                <option value="<?= $health_dis_reason ?>"><?= $health_dis_reason ?></option>
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
                                <option value="<?= $health_cri_iii ?>"><?= $health_cri_iii ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="number" id="health_dis_cost" name="health_dis_cost" class="form-control"
                                placeholder="Health Dis Cost">
                        </div>
                        <div class="form-group">
                            <select name="health_old" class="form-control" id="health_old">
                                <option value="">Health Old</option>
                                <?php 
                                foreach ($health_cri_iiis as $key => $health_cri_iii) {
                                    ?>
                                <option value="<?= $health_cri_iii ?>"><?= $health_cri_iii ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="number" id="health_old_cost" name="health_old_cost" class="form-control"
                                placeholder="Health Old Cost">
                        </div>
                        <div class="form-group">
                            <select name="house_acc" class="form-control" id="house_acc">
                                <option value="">House Acc</option>
                                <?php 
                                foreach ($house_accs as $key => $house_acc) {
                                    ?>
                                <option value="<?= $house_acc ?>"><?= $house_acc ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" id="house_prov" name="house_prov" class="form-control"
                                placeholder="House Prov">
                        </div>
                        <div class="form-group">
                            <select name="house_land" class="form-control" id="house_land">
                                <option value="">House Land</option>
                                <?php 
                                foreach ($house_lands as $key => $house_land) {
                                    ?>
                                <option value="<?= $house_land ?>"><?= $house_land ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" id="house_land_others" name="house_land_others" class="form-control"
                                placeholder="House land others">
                        </div>
                        <div class="form-group">
                            <select name="house_type" class="form-control" id="house_type">
                                <option value="">House Type</option>
                                <?php 
                                foreach ($house_types as $key => $house_type) {
                                    ?>
                                <option value="<?= $house_type ?>"><?= $house_type ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" id="house_type_others" name="house_type_others" class="form-control"
                                placeholder="House type others">
                        </div>
                        <div class="form-group">
                            <select name="house_made_of" class="form-control" id="house_made_of">
                                <option value="">House Made Of</option>
                                <?php 
                                foreach ($house_made_ofs as $key => $house_made_of) {
                                    ?>
                                <option value="<?= $house_made_of ?>"><?= $house_made_of ?></option>
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
                                <option value="<?= $house_condition ?>"><?= $house_condition ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="house_water" class="form-control" id="house_water">
                                <option value="">House Water</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="number" id="house_water_bill" name="house_water_bill" class="form-control"
                                placeholder="House Water Bill">
                        </div>
                        <div class="form-group">
                            <select name="house_electric" class="form-control" id="house_electric">
                                <option value="">House Electric</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="number" id="house_electric_bill" name="house_electric_bill"
                                class="form-control" placeholder="House Electric Bill">
                        </div>
                        <div class="form-group">
                            <select name="house_maint" class="form-control" id="house_maint">
                                <option value="">House Maint</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="number" id="house_maint_bill" name="house_maint_bill" class="form-control"
                                placeholder="House Maint Bill">
                        </div>
                        <div class="form-group">
                            <select name="basic_skills" class="form-control" id="basic_skills">
                                <option value="">Basic Skills</option>
                                <?php 
                                foreach ($basic_skilles as $key => $basic_skill) {
                                    ?>
                                <option value="<?= $basic_skill ?>"><?= $basic_skill ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" id="basic_skills_others" name="basic_skills_others" class="form-control"
                                placeholder="Basic Skills Others">
                        </div>
                        <div class="form-group">
                            <input type="number" id="liquid_assets" name="liquid_assets" class="form-control"
                                placeholder="Liquid Assets">
                        </div>
                        <div class="form-group">
                            <input type="number" id="total_fixed_assets" name="total_fixed_assets" class="form-control"
                                placeholder="Total Fixed Assets">
                        </div>
                        <div class="form-group">
                            <input type="text" id="family_head_name" name="family_head_name" class="form-control"
                                placeholder="Family Head Name">
                        </div>
                        <div class="form-group">
                            <select name="head_id_type" class="form-control" id="head_id_type">
                                <option value="">Head ID Type</option>
                                <?php 
                                foreach ($idtypes as $key => $idtype) {
                                    ?>
                                <option value="<?= $idtype ?>"><?= $idtype ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" id="head_id_no" name="head_id_no" class="form-control"
                                placeholder="Head ID No">
                        </div>
                        <div class="form-group">
                            <select name="family_head_relation" class="form-control" id="family_head_relation">
                                <option value="">Family Head Realtion</option>
                                <?php 
                                foreach ($family_head_relations as $key => $family_head_relation) {
                                    ?>
                                <option value="<?= $family_head_relation ?>"><?= $family_head_relation ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" id="family_head_relation_other" name="family_head_relation_other"
                                class="form-control" placeholder="Family Head Relation Other">
                        </div>
                        <div class="form-group">
                            <select name="pay_method" class="form-control" id="pay_method">
                                <option value="">Pay Method</option>
                                <?php 
                                foreach ($pay_methods as $key => $pay_method) {
                                    ?>
                                <option value="<?= $pay_method ?>"><?= $pay_method ?></option>
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
                                <option value="<?= $pay_method_reason ?>"><?= $pay_method_reason ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" id="bank_name" name="bank_name" class="form-control"
                                placeholder="Bank Name">
                        </div>
                        <div class="form-group">
                            <input type="text" id="bank_account_no" name="bank_account_no" class="form-control"
                                placeholder="Bank Accound No">
                        </div>
                        <div class="form-group">
                            <input type="text" id="bank_account_holder_name" name="bank_account_holder_name"
                                class="form-control" placeholder="Bank Account Holder Name">
                        </div>
                        <div class="form-group">
                            <textarea name="notes" class="form-control" id rows="3" placeholder="Notes"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="text" id="life_condition" name="life_condition" class="form-control"
                                placeholder="life condition">
                        </div>
                        <div class="form-group">
                            <input type="text" id="nick_name" name="nick_name" class="form-control"
                                placeholder="Nick Name">
                        </div>

                        <input type="hidden" name="add_user" value="1">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$('form#add_user').submit(function(e) {
    e.preventDefault();
    var formid = $(this);
    submitForm(e, formid, isAdded);
});

function isAdded(response) {
    if (response.status == 1) {
        $('#add_user').each(function() {
            this.reset();
        });
        setTimeout(() => {
            window.location.href = "members.php";
        }, 3000);
    }
};
</script>
<!-- content-wrapper ends -->
<?php
include('./partials/_footer.php');
?>