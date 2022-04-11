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

if (isset($_POST['update_user'])) {
    $response = $user->updateData($_POST);
    $response = json_encode($response);
    ?>
    <script>
        var response = JSON.parse('<?= $response; ?>');
        // console.log(response.type);
        toastr[response.type](response.message);
        if (response.status == 1) {
            setTimeout(() => {
                window.location.href = "members.php";
            }, 3000);
        }
    </script>
    <?php
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

$id_type = $user['id_type'] ?? "";
$id_no = $user['id_no'] ?? "";
$id_international = $user['id_international'] ?? "";
$birth_date = $user['birth_date'] ?? "";
$birth_state = $user['birth_state'] ?? "";
$birth_country = $user['birth_country'] ?? "";
$married_status = $user['married_status'] ?? "";
$convert_date = $user['convert_date'] ?? "";
$citizenship = $user['citizenship'] ?? "";
$state_since = $user['state_since'] ?? "";
$race = $user['race'] ?? "";
$edu = $user['edu'] ?? "";
$edu_others = $user['edu_others'] ?? "";
$health_good = $user['health_good'] ?? "";
$health_cri_iii = $user['health_cri_iii'] ?? "";
$health_cri_iii_cost = $user['health_cri_iii_cost'] ?? "";
$health_dis = $user['health_dis'] ?? "";
$health_dis_rea = $user['health_dis_rea'] ?? "";
$health_dis_severe = $user['health_dis_severe'] ?? "";
$health_dis_cost = $user['health_dis_cost'] ?? "";
$health_old = $user['health_old'] ?? "";
$health_old_cost = $user['health_old_cost'] ?? "";
$house_acc = $user['house_acc'] ?? "";
$house_prov = $user['house_prov'] ?? "";
$house_land = $user['house_land'] ?? "";
$house_land_others = $user['house_land_others'] ?? "";
$house_type = $user['house_type'] ?? "";
$house_type_others = $user['house_type_others'] ?? "";
$house_made_of = $user['house_made_of'] ?? "";
$house_condition = $user['house_condition'] ?? "";
$house_water = $user['house_water'] ?? "";
$house_water_bill = $user['house_water_bill'] ?? "";
$house_electric = $user['house_electric'] ?? "";
$house_electric_bill = $user['house_electric_bill'] ?? "";
$house_maint = $user['house_maint'] ?? "";
$house_maint_bill = $user['house_maint_bill'] ?? "";
$basic_skills = $user['basic_skills'] ?? "";
$basic_skills_others = $user['basic_skills_others'] ?? "";
$liquid_assets = $user['liquid_assets'] ?? "";
$total_fixed_assets = $user['total_fixed_assets'] ?? "";
$family_head_name = $user['family_head_name'] ?? "";
$head_id_type = $user['head_id_type'] ?? "";
$head_id_no = $user['head_id_no'] ?? "";
$family_head_relation = $user['family_head_relation'] ?? "";
$family_head_relation_other = $user['family_head_relation_other'] ?? "";
$pay_method = $user['pay_method'] ?? "";
$pay_method_reason = $user['pay_method_reason'] ?? "";
$bank_name = $user['bank_name'] ?? "";
$pay_method_reason = $user['pay_method_reason'] ?? "";
$bank_account_no = $user['bank_account_no'] ?? "";
$bank_account_holder_name = $user['bank_account_holder_name'] ?? "";
$nick_name = $user['nick_name'] ?? "";
$life_condition = $user['life_condition'] ?? "";
$notes = $user['notes'] ?? "";
$selectD = $db->runquery("SELECT * FROM `donation_project` WHERE `member_id`='$Identification_id'");
if ($selectD->num_rows > 0) {
    $donation_project = $selectD->fetch_assoc();
}
?>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-6 col-sm-8 col-lg-5 col-10 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Update User</h4>
                        <form class="forms-sample" action="" method="POST" enctype="multipart/form-data"
                              id="update_user">
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="<?= $name ?>"
                                       placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label for="mosque_id">Mosque</label>
                                <select name="mosque_id" class="form-control select2" id="mosque_id">
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
                                <label for="address1">Address 2</label>
                                <input type="text" class="form-control" id="address1" name="address1"
                                       value="<?= $address1 ?>" placeholder="Address 1">
                            </div>
                            <div class="form-group">
                                <label for="address2">Address 2</label>
                                <input type="text" class="form-control" id="address2" name="address2"
                                       value="<?= $address2 ?>" placeholder="Address 2">
                            </div>
                            <div class="form-group">
                                <label for="area">Select Area</label>
                                <select name="area" class="form-control py-3 select2" id="area">
                                    <option value="">Select Area</option>
                                    <?php
                                    $sql = "SELECT * FROM `mosque_areas`";
                                    $select = $db->runquery($sql);
                                    if ($select->num_rows > 0) {
                                        while ($row = $select->fetch_assoc()) {
                                            ?>
                                            <option value="<?= $row['area_id'] ?>" <?= $core->itemSelected($area, $row['area_id']) ?>><?= $row['area_name'] ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="city">Select City</label>
                                <select name="city" class="form-control py-3 select2" id="city">
                                    <option value="">Select City</option>
                                    <?php
                                    $sql = "SELECT * FROM `cities`";
                                    $select = $db->runquery($sql);
                                    if ($select->num_rows > 0) {
                                        while ($row = $select->fetch_assoc()) {
                                            ?>
                                            <option value="<?= $row['id'] ?>" <?= $core->itemSelected($city, $row['id']) ?>><?= $row['name'] ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="postcode">Post Code</label>
                                <input type="text" id="postcode" name="postcode" value="<?= $postcode ?>"
                                       class="form-control" placeholder="Post Code">
                            </div>
                            <div class="form-group">
                                <label for="state">Select State</label>
                                <select name="state" class="form-control py-3 select2" id="state">
                                    <option value="">Select State</option>
                                    <?php
                                    $sql = "SELECT * FROM `states`";
                                    $select = $db->runquery($sql);
                                    if ($select->num_rows > 0) {
                                        while ($row = $select->fetch_assoc()) {
                                            ?>
                                            <option value="<?= $row['id'] ?>" <?= $core->itemSelected($state, $row['id']) ?>><?= $row['name'] ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" id="country" name="country" value="<?= $country ?>"
                                       class="form-control"
                                       placeholder="Country">
                            </div>
                            <div class="form-group">
                                <label for="telephone">Telephone</label>
                                <input type="text" id="telephone" name="telephone" value="<?= $telephone ?>"
                                       class="form-control" placeholder="Telephone">
                            </div>

                            <div class="form-group">
                                <label for="id_type">ID Type</label>
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
                                <label for="id_no">ID No</label>
                                <input type="text" id="id_no" name="id_no" class="form-control" placeholder="ID No"
                                       value="<?= $id_no ?>">
                            </div>
                            <div class="form-group">
                                <label for="id_international">ID International</label>
                                <input type="text" id="id_international" name="id_international" class="form-control"
                                       placeholder="ID International" value="<?= $id_international ?>">
                            </div>
                            <div class="form-group">
                                <label for="birth_date">Birth Date</label>
                                <input type="date" id="birth_date" name="birth_date" class="form-control"
                                       placeholder="Birth Date" value="<?= $birth_date ?>">
                            </div>
                            <div class="form-group">
                                <label for="birth_state">Birth State</label>
                                <input type="text" id="birth_state" name="birth_state" class="form-control"
                                       placeholder="Birth State" value="<?= $birth_state ?>">
                            </div>
                            <div class="form-group">
                                <label for="birth_country">Birth Country</label>
                                <input type="text" id="birth_country" name="birth_country" class="form-control"
                                       value="<?= $birth_country ?>" placeholder="Birth Country">
                            </div>
                            <div class="form-group">
                                <label for="married_status">Married Status</label>
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
                                <label for="citizenship">Citizenship</label>
                                <input type="text" id="citizenship" name="citizenship" class="form-control"
                                       value="<?= $citizenship ?>" placeholder="Citizenship">
                            </div>
                            <!--                        <div class="form-group">-->
                            <!--                            <label for="state_since">State Since</label>-->
                            <!--                            <input type="date" id="state_since" name="state_since" class="form-control"-->
                            <!--                                value="-->
                            <? //= $state_since ?><!--" placeholder="State Since">-->
                            <!--                        </div>-->
                            <div class="form-group">
                                <label for="race">Race</label>
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
                                <label for="religion">Religion</label>
                                <input type="text" id="religion" name="religion" class="form-control"
                                       placeholder="Religion" value="<?= $user['religion'] ?>">
                            </div>

                            <div class="form-group">
                                <label for="basic_skills">Basic Skills</label>
                                <select name="basic_skills" class="form-control" id="basic_skills">
                                    <option value="">Basic Skills</option>
                                    <<?php
                                    foreach ($basic_skilles as $key => $basic_skill) {
                                        ?>
                                        <option value="<?= $basic_skill ?>"
                                            <?= $core->itemSelected($user['basic_skills'], $basic_skill) ?>><?= $basic_skill ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="basic_skills_others">Basic Skills Others</label>
                                <input type="text" id="basic_skills_others" name="basic_skills_others"
                                       value="<?= $basic_skills_others ?>" class="form-control"
                                       placeholder="Basic Skills Others">
                            </div>
                            <div class="form-group">
                                <label for="family_head_name">Family Head Name</label>
                                <input type="text" id="family_head_name" name="family_head_name" class="form-control"
                                       value="<?= $family_head_name ?>" placeholder="Family Head Name">
                            </div>
                            <div class="form-group">
                                <label for="head_id_type">Head ID Type</label>
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
                                <label for="head_id_no">Head ID No</label>
                                <input type="text" id="head_id_no" name="head_id_no" class="form-control"
                                       value="<?= $head_id_no ?>" placeholder="Head ID No">
                            </div>
                            <div class="form-group">
                                <label for="family_head_relation">Family Head Relation</label>
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
                                <label for="family_head_relation_other">Family Head Relation Other</label>
                                <input type="text" id="family_head_relation_other" name="family_head_relation_other"
                                       value="<?= $family_head_relation_other ?>" class="form-control"
                                       placeholder="Family Head Relation Other">
                            </div>
                            <div class="form-group">
                                <label for="pay_method">Pay Method</label>
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
                                <label for="pay_method_reason">Pay Method Reason</label>
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
                                <label for="bank_name">Bank Name</label>
                                <input type="text" id="bank_name" name="bank_name" class="form-control"
                                       value="<?= $bank_name ?>" placeholder="Bank Name">
                            </div>
                            <div class="form-group">
                                <label for="bank_account_no">Bank Account No</label>
                                <input type="text" id="bank_account_no" name="bank_account_no" class="form-control"
                                       value="<?= $bank_account_no ?>" placeholder="Bank Accound No">
                            </div>
                            <div class="form-group">
                                <label for="bank_account_holder_name">Bank Account Holder Name</label>
                                <input type="text" id="bank_account_holder_name" name="bank_account_holder_name"
                                       value="<?= $bank_account_holder_name ?>" class="form-control"
                                       placeholder="Bank Account Holder Name">
                            </div>
                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <textarea name="notes" class="form-control" id rows="3"
                                          placeholder="Notes"><?= $notes ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="life_condition">life condition</label>
                                <input type="text" id="life_condition" name="life_condition"
                                       value="<?= $life_condition ?>"
                                       class="form-control" placeholder="life condition">
                            </div>
                            <div class="form-group">
                                <label for="nick_name">Nick Name</label>
                                <input type="text" id="nick_name" name="nick_name" value="<?= $nick_name ?>"
                                       class="form-control" placeholder="Nick Name">
                            </div>
                            <div class="form-group">
                                <label for="income_explain">Income Explain</label>
                                <textarea id="income_explain" name="income_explain"class="form-control" rows="3"
                                          placeholder="Income Explain"><?= $user['income_explain']??'' ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="planned_action">Planned Action</label>
                                <input type="text" id="planned_action" name="planned_action"
                                       value="<?= $user['planned_action'] ?>" class="form-control"
                                       placeholder="Planned Action">
                            </div>
                            <div class="form-group">
                                <label for="help_category">Help Category</label>
                                <div class="row">
                                    <?php
                                    $help_categories_ids = [];
                                    $selected_categories_ids = [];
                                    $selectC = $db->runquery("SELECT * FROM `members_help_category` WHERE `member_id`='$Identification_id'");
                                    if ($selectC->num_rows > 0) {
                                        $categories = $selectC->fetch_all(MYSQLI_ASSOC);
                                        foreach ($categories as $category) {
                                            $selected_categories_ids[] = $category['help_category_id'];
                                        }
                                    }
                                    $sql = "SELECT * FROM `help_categories`";
                                    $select = $db->runquery($sql);

                                    if ($select->num_rows > 0) {
                                        $rows = $select->fetch_all(MYSQLI_ASSOC);
                                        foreach ($rows as $row) {
                                            $help_categories_ids[] = $row['id'];
                                            ?>
                                            <div class="col-6">
                                                <label for="<?= $row['name'] ?>" class="form-label">
                                                    <input type="checkbox" class="mr-2" name="help_category[]"
                                                           id="<?= $row['name'] ?>"
                                                           value="<?= $row['id'] ?>"
                                                        <?= $core->itemChecked($selected_categories_ids, $help_categories_ids, $row['id']) ?>>
                                                    <span><?= $row['name'] ?></span>
                                                </label>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="help_needed">Help Needed</label>
                                <input type="text" id="help_needed" name="help_needed"
                                       value="<?= $donation_project['help_needed'] ?>" class="form-control"
                                       placeholder="Help Needed">
                            </div>
                            <div class="form-group">
                                <label>Please insert 5 images below</label>
                                <div class="row">
                                    <?php
                                    $images = [];
                                    $selectC = $db->runquery("SELECT * FROM `images` WHERE `user_id`='$Identification_id'");
                                    if ($selectC->num_rows > 0) {
                                        $images = $selectC->fetch_all(MYSQLI_ASSOC);
                                    }
                                    ?>
                                    <div class="col-12 col-sm-6 col-lg-4 mb-3">
                                        <input type="file" name="image[]"
                                               data-default-file="<?= empty($images[0]['image_name']) ? '' : URL . 'images/' . $images[0]['image_name'] ?>"
                                               class="dropify">
                                        <input type="hidden" name="oldImage[]"
                                               value="<?= $images[0]['image_name'] ?? '' ?>">
                                    </div>
                                    <div class="col-12 col-sm-6 col-lg-4 mb-3">
                                        <input type="file" name="image[]"
                                               data-default-file="<?= empty($images[1]['image_name']) ? '' : URL . 'images/' . $images[1]['image_name'] ?>"
                                               class="dropify">
                                        <input type="hidden" name="oldImage[]"
                                               value="<?= $images[1]['image_name'] ?? '' ?>">
                                    </div>
                                    <div class="col-12 col-sm-6 col-lg-4 mb-3">
                                        <input type="file" name="image[]"
                                               data-default-file="<?= empty($images[2]['image_name']) ? '' : URL . 'images/' . $images[2]['image_name'] ?>"
                                               class="dropify">
                                        <input type="hidden" name="oldImage[]"
                                               value="<?= $images[2]['image_name'] ?? '' ?>">
                                    </div>
                                    <div class="col-12 col-sm-6 col-lg-4 mb-3">
                                        <input type="file" name="image[]"
                                               data-default-file="<?= empty($images[3]['image_name']) ? '' : URL . 'images/' . $images[3]['image_name'] ?>"
                                               class="dropify">
                                        <input type="hidden" name="oldImage[]"
                                               value="<?= $images[3]['image_name'] ?? '' ?>">
                                    </div>
                                    <div class="col-12 col-sm-6 col-lg-4 mb-3">
                                        <input type="file" name="image[]"
                                               data-default-file="<?= empty($images[4]['image_name']) ? '' : URL . 'images/' . $images[4]['image_name'] ?>"
                                               class="dropify">
                                        <input type="hidden" name="oldImage[]"
                                               value="<?= $images[4]['image_name'] ?? '' ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="date_start_donation">Date Start Donation</label>
                                <input type="date" id="date_start_donation" name="date_start_donation"
                                       value="<?= $donation_project['start_collect'] ?>" class="form-control"
                                       placeholder="Date Start Donation">
                            </div>
                            <div class="form-group">
                                <label for="date_end_donation">Date End Donation</label>
                                <input type="date" id="date_end_donation" name="date_end_donation"
                                       value="<?= $donation_project['end_collect'] ?>" class="form-control"
                                       placeholder="Date End Donation">
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
        // $('form#update_user').submit(function (e) {
        //     e.preventDefault();
        //     var formid = $(this);
        //     submitForm(e, formid, isAdded);
        // });
        //
        // function isAdded(response) {
        //     if (response.status == 1) {
        //         setTimeout(() => {
        //             // window.location.href = response.url;
        //         }, 3000);
        //     }
        // };
        $('select.select2').select2();
        $('.dropify').dropify();
    </script>
    <!-- content-wrapper ends -->
<?php
include('./partials/_footer.php');
?>