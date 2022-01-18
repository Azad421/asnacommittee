<?php
include_once("../php/autoload.php");
include_once("./partials/checkAdmin.php");
$title = "Asnaf Commitee - Donor";
include('partials/header.php');
if (isset($_GET['donor'])) {
    $donor_id = $_GET['donor'];
} else {
    header('location:./donor.php');
}
$sql = "SELECT * FROM `donors`  WHERE `donor_id`='$donor_id'";
$select = $db->runquery($sql);
$count = $select->num_rows;
$row = $select->fetch_assoc();
$donor_id = $row['donor_id'];
$donor_name = $row['donor_name'];
$area_city = $row['area_city'];
$area_state = $row['area_state'];
$area = $row['area'];
$donate_asnaf = $row['donate_asnaf'];
$items_to_donate = $row['items_to_donate'];
$telephone = $row['telephone'];
$donate_to_jalaria = $row['donate_to_jalaria'];
?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body px-5">
            <div class="col-12 mx-auto" id="printContent" data-title="<?= $donor_name ?>">
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
                    ?>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="col-sm-3">Donar Name :</div>
                    <div class="col-sm-7"> <?= $donor_name ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="col-sm-3">Telephone :</div>
                    <div class="col-sm-7"> <?= $telephone ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="col-sm-3">Area :</div>
                    <div class="col-sm-7"> <?= $area ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="col-sm-3">Area State :</div>
                    <div class="col-sm-7"> <?= $area_state ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="col-sm-3">Area City :</div>
                    <div class="col-sm-7"> <?= $area_city ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="col-sm-3">Donate Asnaf :</div>
                    <div class="col-sm-7"> <?= $donate_asnaf ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="col-sm-3">Donate To Asnaf :</div>
                    <div class="col-sm-7"> <?= $items_to_donate ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="col-sm-3">Donate To Jalaria :</div>
                    <div class="col-sm-7"> <?= $donate_to_jalaria ?></div>
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