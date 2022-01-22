<?php
include_once("../php/autoload.php");
include_once("./partials/checkAdmin.php");
$title = "Asnaf Commitee - Members";
include('partials/header.php');
if (isset($_GET['mosque'])) {
    $mosque_id = $_GET['mosque'];
} else {
    header('location:./mosque.php');
}
// INNER JOIN `mosque_areas` ON `mosques`.`area`=`mosque_areas`.`area_id` 
$sql = "SELECT * FROM `mosques` WHERE `mosque_id`='$mosque_id'";
$select = $db->runquery($sql);
$count = $select->num_rows;
$row = $select->fetch_assoc();
$name = $row['mosque_name'];
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
                        $mosque_id = $row['mosque_id'];
                        $address1 = $row['address1'];
                        $address2 = $row['address2'];
                        $city = $row['city'];
                        $state = $row['state'];
                        $postcode = $row['postcode'];
                        $country = $row['country'];
                    ?>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="col-sm-3">Name :</div>
                    <div class="col-sm-7"> <?= $name ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="col-sm-3">Address 1 :</div>
                    <div class="col-sm-7"> <?= $address1 ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="col-sm-3">Address 2 :</div>
                    <div class="col-sm-7"> <?= $address2 ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="col-sm-3">Area :</div>
                    <div class="col-sm-7">
                        <?php
                            $selectarea = $db->runquery("SELECT * FROM `mosque_area` INNER JOIN `mosque_areas` ON `mosque_area`.`area_id`=`mosque_areas`.`area_id` WHERE `mosque_area`.`mosque_id`='$mosque_id'");

                            while($area = $selectarea->fetch_assoc()){
                        ?>
                        <p><?= $area['area_name'] ?></p>
                        <?php
                            }
                        ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="col-sm-3">City :</div>
                    <div class="col-sm-7"> <?= $city ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="col-sm-3">State :</div>
                    <div class="col-sm-7"> <?= $state ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="col-sm-3">Post Code :</div>
                    <div class="col-sm-7"> <?= $postcode ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="col-sm-3">Country :</div>
                    <div class="col-sm-7"> <?= $country ?></div>
                </div>
                <div class="row">
                    <div class="col-1 mb-3"></div>
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