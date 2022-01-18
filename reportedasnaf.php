<?php
require_once("./php/autoload.php");
include('partials/checkloggedin.php');
$title = "Asnaf Commitee - Reported Asnaf";
include('partials/header.php');
$sql = "SELECT * FROM `reports`";
if (isset($_GET['search'])) {
    $key = $_GET['search'];
    $sql .= "WHERE `reporter_name` LIKE '%$key%'";
}
$sql .= " ORDER BY `reporter_name` ASC";
$select = $db->runquery($sql);
$count = $select->num_rows;
?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <?php include_once("./partials/searchform.php") ?>
            <div id="printContent" data-title="Reported Asnaf List">
                <div class="d-flex justify-content-end">
                    <a class="btn btn-success mr-3 addbtn" href="adduser.php">
                        <span class="text-white">Add</span>
                    </a>
                    <?php if ($count > 0) { ?>
                    <a class="btn btn-success printbtn" onclick="printDiv('printContent')">
                        <span class="text-white">Print</span>
                    </a>
                    <?php include_once('./partials/printdate.php') ?>
                    <?php
                    }
                    ?>
                </div>
                <div class="row">
                    <div class="col-2 col-sm-1 text-right p-1">No</div>
                    <div class="col-10 col-sm-11 p-1">
                        <div class="row mb-3">
                            <div class="col-md-3">Reporter Name</div>
                            <div class="col-md-2">Reporter Telephone</div>
                            <div class="col-md-2">Report Asnaf Name</div>
                            <div class="col-md-3">Report Asnaf Telephone</div>
                        </div>
                    </div>
                </div>
                <?php
                if ($count > 0) {
                    $i = 1;
                    while ($row = $select->fetch_assoc()) {
                        $report_id = $row['report_id'];
                        $reporter_name = $row['reporter_name'];
                        $reporter_telephone = $row['reporter_telephone'];
                        $reportasnaf_name = $row['reportasnaf_name'];
                        $report_asnaf_telephone = $row['report_asnaf_telephone'];
                        $report_asnaf_address = $row['report_asnaf_address'];
                        $report_asnaf_condition = $row['report_asnaf_condition'];
                ?>
                <div class="row" id="row<?= $donor_id ?>">
                    <div class="col-2 col-sm-1 p-1 text-right">
                        <?= $i . '.' ?>
                    </div>
                    <div class="col-10 col-sm-11 p-1">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <?= $reporter_name ?>
                            </div>
                            <div class="col-md-2"><?= $reporter_telephone ?></div>
                            <div class="col-md-2"><?= $reportasnaf_name ?></div>
                            <div class="col-md-3">
                                <?= $report_asnaf_telephone ?>
                            </div>
                            <div class="col-md-2 save_as">
                                <a href="reportdeatils.php?report=<?= $report_id ?>" class="btn btn-success">Details</a>
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
<script>
$('form#delete').submit(function(e) {
    e.preventDefault();
    var formid = $(this);
    submitForm(e, formid, isDeleted);
});

function isDeleted(response) {
    if (response.status == 1) {
        $(response.row).remove();
    }
};
</script>
<!-- content-wrapper ends -->
<?php
include('partials/_footer.php');
?>