<?php
include_once("./php/autoload.php");
include_once("./partials/checkloggedin.php");
$title = "Asnaf Commitee - Report Details";
include('partials/header.php');
if (isset($_GET['report'])) {
    $report_id = $_GET['report'];
} else {
    header('location:./reportasnaf.php');
}
$sql = "SELECT * FROM `reports`  WHERE `report_id`='$report_id'";
$select = $db->runquery($sql);
$count = $select->num_rows;
$row = $select->fetch_assoc();
$report_id = $row['report_id'];
$reporter_name = $row['reporter_name'];
$reporter_telephone = $row['reporter_telephone'];
$reportasnaf_name = $row['reportasnaf_name'];
$report_asnaf_telephone = $row['report_asnaf_telephone'];
$report_asnaf_address = $row['report_asnaf_address'];
$report_asnaf_condition = $row['report_asnaf_condition'];
$report_asnaf_area = $row['report_asnaf_area'];
$report_asnaf_city = $row['report_asnaf_city'];
$report_asnaf_state = $row['report_asnaf_state'];
$report_at = $row['report_at'];
?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body px-5">
            <div class="col-12 mx-auto" id="printContent" data-title="<?= 'Reporter : '.$reporter_name ?>">
                <?php if ($count > 0) { ?>
                <div class="d-flex justify-content-end">
                    <a class="btn btn-success printbtn" onclick="printDiv('printContent')">
                        <span class="text-white">Print</span>
                    </a>
                    <?php include_once('./partials/printdate.php') ?>
                </div>
                <?php
                }
                    ?>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="col-sm-3">Reporter Name :</div>
                    <div class="col-sm-7"> <?= $reporter_name ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="col-sm-3">Reporter Telephone :</div>
                    <div class="col-sm-7"> <?= $reporter_telephone ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="col-sm-3">Report Asnaf Name :</div>
                    <div class="col-sm-7"> <?= $reportasnaf_name ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="col-sm-3">Report Asnaf Telephone :</div>
                    <div class="col-sm-7"> <?= $report_asnaf_telephone ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="col-sm-3">Report Asnaf Address :</div>
                    <div class="col-sm-7"> <?= $report_asnaf_address ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="col-sm-3">Report Asnaf Condition :</div>
                    <div class="col-sm-7"> <?= $report_asnaf_condition ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="col-sm-3">Report At :</div>
                    <div class="col-sm-7"> <?= date('d-m-Y', strtotime($report_at)) ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content-wrapper ends -->
<?php
include('partials/_footer.php');
?>