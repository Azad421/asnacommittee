<?php
require_once("./php/autoload.php");
include('partials/checkloggedin.php');;
$title = "Asnaf Commitee - Members";
include('partials/header.php');
$selectarea = $db->runquery("SELECT * FROM `mosque_area` INNER JOIN `mosque_areas` ON `mosque_area`.`area_id`=`mosque_areas`.`area_id` WHERE `mosque_id`= '$mosque_id'");
$areac = $selectarea->num_rows;
?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <?php include_once("./partials/searchform.php") ?>
            <div id="printContent" data-title="Donors List">
                <div class="d-flex justify-content-end">
                    <a class="btn btn-success printbtn" onclick="printDiv('printContent')">
                        <span class="text-white">Print</span>
                    </a>
                    <?php include_once('./partials/printdate.php') ?>
                </div>
                <div class="row">
                    <div class="col-2 col-sm-1 text-right p-1">No</div>
                    <div class="col-10 col-sm-11 p-1">
                        <div class="row mb-3">
                            <div class="col-md-3">Donor Name</div>
                            <div class="col-md-2">Telephone</div>
                            <div class="col-md-2">Area</div>
                            <div class="col-md-3">Area State</div>
                        </div>
                    </div>
                </div>
                <?php
                    while($area = $selectarea->fetch_assoc()){
                        $area_id = '';
                        $area_id = $area['area_id'];
                       

                        $sql = "SELECT * FROM `donor_area`  INNER JOIN `donors` ON `donor_area`.`donor_id`=`donors`.`donor_id` WHERE `donor_area`. `area_id`= '$area_id'  ";
                        if (isset($_GET['search'])) {
                            $key = $_GET['search'];
                            $sql .= "AND CONCAT_WS( `donor_name`, `area_city`, `area_state`) LIKE '%$key%'";
                        }
                        $sql .= " ORDER BY `donor_name` ASC";
                        $select = $db->runquery($sql);
                        $count = $select->num_rows;
                    
                ?>
                <div class="row">
                    <div class="col-2 col-sm-1 p-1 text-right">
                    </div>
                    <p class="area text-primary"><?= $area['area_name'] ?></p>
                </div>
                <?php
                    if ($count > 0) {
                        $i = 1;
                        while ($row = $select->fetch_assoc()) {
                            $donor_id = $row['donor_id'];
                            $donor_name = $row['donor_name'];
                            $area_city = $row['area_city'];
                            $area_state = $row['area_state'];
                            $donate_asnaf = $row['donate_asnaf'];
                            $items_to_donate = $row['items_to_donate'];
                            $telephone = $row['telephone'];
                            $donate_to_jalaria = $row['donate_to_jalaria'];
                    ?>
                <div class="row" id="row<?= $donor_id ?>">
                    <div class="col-2 col-sm-1 p-1 text-right">
                        <?= $i . '.' ?>
                    </div>
                    <div class="col-10 col-sm-11 p-1">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <?= $donor_name ?>
                            </div>
                            <div class="col-md-2"><?= $telephone ?></div>
                            <div class="col-md-2">
                                <?php
                            $selectdarea = $db->runquery("SELECT * FROM `donor_area` INNER JOIN `mosque_areas` ON `donor_area`.`area_id`=`mosque_areas`.`area_id` WHERE `donor_area`.`donor_id`='$donor_id'");
                            while($darea = $selectdarea->fetch_assoc()){
                                ?>
                                <p><?= $darea['area_name'] ?></p>
                                <?php
                            }
                            ?>
                            </div>
                            <div class="col-md-3">
                                <?= $area_state ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                            $i++;
                        }
                    } 
                };
                if($areac== 0){
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