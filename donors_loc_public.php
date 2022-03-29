<?php
require_once("./php/autoload.php");
$title = "Asnaf Committee - Donors";
include('partials/header.php');

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
                    <div class="row columnTitle">
                        <div class="col-2 col-sm-1 text-right p-1">No</div>
                        <div class="col-10 col-sm-11 p-1">
                            <div class="row mb-3">
                                <div class="col-md-2">Donor Name</div>
                                <div class="col-md-2">Telephone</div>
                                <div class="col-md-2">Area</div>
                                <div class="col-md-2">City</div>
                                <div class="col-md-2">Area State</div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $key = '';
                    if (isset($_GET['search'])) {
                        $key = $_GET['search'];
                    }
                    $areaSql = "SELECT * FROM `donor_area` INNER JOIN `mosque_areas` ON `donor_area`.`area_id`=`mosque_areas`.`area_id` WHERE `area_name` LIKE '%$key%' ORDER BY `area_name` ASC";
                    $areaSelect = $db->runquery($areaSql);

                    if ($areaSelect->num_rows > 0) {
                        while ($dArea = $areaSelect->fetch_assoc()) {
                            $donor_id = $dArea['donor_id'];
                            $sql = "SELECT * FROM `donors` Where `donor_id`='$donor_id'";
                            $sql .= " ORDER BY `donor_name` ASC";
                            $select = $db->runquery($sql);
                            $count = $select->num_rows;
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
                                                <div class="col-md-2">
                                                    <?= $donor_name ?>
                                                </div>
                                                <div class="col-md-2"><?= $telephone ?></div>
                                                <div class="col-md-2">
                                                    <?php
                                                    $selectdarea = $db->runquery("SELECT * FROM `donor_area` INNER JOIN `mosque_areas` ON `donor_area`.`area_id`=`mosque_areas`.`area_id` WHERE `donor_area`.`donor_id`='$donor_id'");
                                                    while ($darea = $selectdarea->fetch_assoc()) {
                                                        ?>
                                                        <?= $darea['area_name'] ?></br>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-md-2">
                                                    <?= $area_state ?>
                                                </div>
                                                <div class="col-md-2">
                                                    <?= $area_city ?>
                                                </div>
                                                <div class="col-md-2">
                                                    <a href="donors_help.php?donor=<?= $donor_id ?>"
                                                       class="btn btn-primary"><i class="mdi mdi-eye"></i> Details </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $i++;
                                }
                            }
                        }
                    }
                    if ($areaSelect->num_rows == 0) {
                        include_once('./partials/empty.php');
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('form#delete').submit(function (e) {
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