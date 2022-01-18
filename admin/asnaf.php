<?php
include_once("../php/autoload.php");
include_once("./partials/checkAdmin.php");
$title = "Asnaf Commitee - Members";
include('partials/header.php');
$sql = "SELECT * FROM `asnaf` INNER JOIN `all_members` ON `asnaf`.`Identification_id`=`all_members`.`Identification_id`";
if (isset($_GET['search'])) {
    $key = $_GET['search'];
    $sql .= "WHERE CONCAT_WS( `name`, `address1`, `address2`, `area`, `city`, `state`) LIKE '%$key%'";
}
$sql .= " ORDER BY `name` ASC";
$select = $db->runquery($sql);
$count = $select->num_rows;

?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <?php include_once("./partials/searchform.php") ?>
            <div id="printContent" data-title="Asnaf List">
                <?php if ($count > 0) { ?>
                <div class="d-flex justify-content-end">
                    <a class="btn btn-success printbtn" onclick="printDiv('printContent')">
                        <span class="text-white">Print</span>
                    </a>
                </div>
                <?php
                }
                ?>
                <div class="row">
                    <div class="col-2 col-sm-1 p-1 text-right">No</div>
                    <div class="col-10 col-sm-11 p-1">
                        <div class="row mb-3">
                            <div class="col-md-3">Name</div>
                            <div class="col-md-5">
                                Address
                            </div>
                            <div class="col-md-2">Telephone</div>
                        </div>
                    </div>
                </div>
                <?php
                if ($count > 0) {
                    $i = 1;
                    while ($row = $select->fetch_assoc()) {
                        $asnaf_id = $row['asnaf_id'];
                        $Identification_id = $row['Identification_id'];
                        $name = $row['name'];
                        $address1 = $row['address1'];
                        $address2 = $row['address2'];
                        $area = $row['area'];
                        $city = $row['city'];
                        $state = $row['state'];
                        $postcode = $row['postcode'];
                        $country = $row['country'];
                        $telephone = $row['telephone'];

                        $selectarea =  $db->runquery("SELECT * FROM `areas` WHERE `area_id`='$area'");
                        $areasc = $selectarea->num_rows;
                        $aread = $selectarea->fetch_assoc();
                        $area_id = '';
                        $area_name = '';
                        if($areasc>0){
                            $area_id = $aread['area_id'];
                            $area_name = $aread['area_name'];
                        }
                ?>
                <div class="row">
                    <div class="col-2 col-sm-1 p-1 text-right">
                        <?= $i . '.' ?>
                    </div>
                    <div class="col-10 col-sm-11 p-1">
                        <div class="row mb-3" id="row<?= $asnaf_id ?>">
                            <div class="col-md-3"><?= $name ?></div>
                            <div class="col-md-5">
                                <?= $address1 . ", " . $address2 . ", " . $area_name . ", " . $city . ", " . $postcode . ", " . $state . ", " . $country ?>
                            </div>
                            <div class="col-md-2"><?= $telephone ?></div>
                            <div class="col-md-2 save_as">
                                <a href="javascript:" data-toggle="dropdown" id="asnafdropdown"
                                    class="btn btn-success">Actions</a>
                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                                    aria-labelledby="asnafdropdown">
                                    <a href="asnafdetails.php?asnaf=<?= $asnaf_id ?>" class="dropdown-item">details
                                    </a>
                                    <form action="formsubmit.php" method="post" id="delete">
                                        <input type="hidden" name="asnaf_id" value="<?= $asnaf_id ?>">
                                        <input type="hidden" name="remove_asnaf" value="1">
                                        <button type="submit" class="dropdown-item">Remove Asnaf</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                        $i++;
                    }
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