<?php
require_once("./php/autoload.php");
include('partials/checkloggedin.php');
$title = "Asnaf Commitee - Reported Asnaf";
include('partials/header.php');

$selectarea = $db->runquery("SELECT * FROM `mosque_area` INNER JOIN `mosque_areas` ON `mosque_area`.`area_id`=`mosque_areas`.`area_id` WHERE `mosque_id`= '$mosque_id' ORDER BY `area_name` ASC");
$areac = $selectarea->num_rows;
?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <?php include_once("./partials/searchform.php") ?>
            <div id="printContent" data-title="Reported Asnaf List">
                <div class="d-flex justify-content-end">
                    <?php if ($areac > 0) { ?>
                    <a class="btn btn-success printbtn" onclick="printDiv('printContent')">
                        <span class="text-white">Print</span>
                    </a>
                    <?php include_once('./partials/printdate.php') ?>
                    <?php
                    }
                    ?>
                </div>
                <div class="row columnTitle">
                    <div class="col-2 col-sm-1 text-right p-1">No</div>
                    <div class="col-10 col-sm-11 p-1">
                        <div class="row mb-3">
                            <div class="col-md-2">Report Asnaf Name</div>
                            <div class="col-md-2">Report Asnaf Telephone</div>
                            <div class="col-md-2">Report Asnaf Area</div>
                            <div class="col-md-2">Report Asnaf City</div>
                            <div class="col-md-2">Report Asnaf State</div>
                        </div>
                    </div>
                </div>
                <?php
                    while($area = $selectarea->fetch_assoc()){
                        $area_id = '';
                        $area_id = $area['area_id'];

                        $sql = "SELECT * FROM `reports` WHERE `report_asnaf_area` = '$area_id' AND `report_asnaf_mosque_id`='$mosque_id'";
                        if (isset($_GET['search'])) {
                            $key = $_GET['search'];
                            $sql .= " AND  `reporter_name` LIKE '%$key%'";
                        }
                        $sql .= " ORDER BY `reporter_name` ASC";
                        $select = $db->runquery($sql);
                        $count = $select->num_rows;
                        if($count >0){
                    
                        ?>
                <div class="row">
                    <div class="col-2 col-sm-1 p-1 text-right">
                    </div>
                    <p class="area"><?= $area['area_name'] ?></p>
                </div>
                <?php
                        }
                    $i = 1;
                    while ($row = $select->fetch_assoc()) {
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
                ?>
                <div class="row" id="row<?= $donor_id ?>">
                    <div class="col-2 col-sm-1 p-1 text-right">
                        <?= $i . '.' ?>
                    </div>
                    <div class="col-10 col-sm-11 p-1">
                        <div class="row mb-3">
                            <div class="col-md-2"><?= $reportasnaf_name ?></div>
                            <div class="col-md-2"><?= $report_asnaf_telephone ?> </div>
                            <div class="col-md-2">
                                <?php
                            $selectdarea = $db->runquery("SELECT * FROM `mosque_areas` WHERE `mosque_areas`.`area_id`='$report_asnaf_area'");
                            while($darea = $selectdarea->fetch_assoc()){
                                ?>
                                <?= $darea['area_name'] ?>
                                <?php
                            }
                            ?>
                            </div>
                            <div class="col-md-2"><?= $report_asnaf_city ?> </div>
                            <div class="col-md-2"><?= $report_asnaf_state ?> </div>
                            <div class="col-md-2 save_as">
                                <a href="reportdeatils.php?report=<?= $report_id ?>" class="btn btn-success">Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                        $i++;
                    }
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