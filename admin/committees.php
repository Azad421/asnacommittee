<?php
include_once("../php/autoload.php");
include_once("./partials/checkAdmin.php");
$title = "Asnaf Commitee - Members";
include('partials/header.php');
$sql = "SELECT * FROM `commitee` INNER JOIN `all_members` ON `commitee`.`Identification_id`=`all_members`.`Identification_id`";
if (isset($_GET['search'])) {
    $key = $_GET['search'];
    $sql .= "WHERE CONCAT_WS( `name`, `address1`, `address2`, `area`, `city`, `state`, `position`) LIKE '%$key%'";
}
$sql .= " ORDER BY `name` ASC";
$select = $db->runquery($sql);
$count = $select->num_rows;

?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <?php include_once("./partials/searchform.php") ?>
            <div id="printContent" data-title="Committee List">
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
                <div class="row columnTitle">
                    <div class="col-2 col-sm-1 p-1 text-right">No</div>
                    <div class="col-10 col-sm-11 p-1">
                        <div class="row mb-3">
                            <div class="col-md-2">Name</div>
                            <div class="col-md-4">
                                Address
                            </div>
                            <div class="col-md-2">Telephone</div>
                            <div class="col-md-2">Position</div>
                        </div>
                    </div>
                </div>
                <?php
                if ($count > 0) {
                    $i = 1;
                    while ($row = $select->fetch_assoc()) {
                        $committee_id = $row['committee_id'];
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
                        $position = $row['position'];
                ?>
                <div class="row">
                    <div class="col-2 col-sm-1 p-1 text-right">
                        <?= $i . '.' ?>
                    </div>
                    <div class="col-10 col-sm-11 p-1">
                        <div class="row mb-3" id="row<?= $committee_id ?>">
                            <div class="col-md-2"><?= $name ?></div>
                            <div class="col-md-4">
                                <?= $address1 . ", " . $address2 . ", " . $area . ", " . $city . ", " . $postcode . ", " . $state . ", " . $country ?>
                            </div>
                            <div class="col-md-2"><?= $telephone ?></div>
                            <div class="col-md-2"><?= $position ?></div>
                            <div class="col-md-2 save_as">
                                <a href="javascript:" data-toggle="dropdown" id="asnafdropdown"
                                    class="btn btn-success">Action</a>
                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                                    aria-labelledby="asnafdropdown">
                                    <a href="committeedetails.php?committee=<?= $committee_id ?>"
                                        class="dropdown-item">Details</a>
                                    <a href="updatecommittee.php?committee=<?= $committee_id ?>"
                                        class="dropdown-item">Edit</a>
                                    <a href="comitteechangepassword.php?committee=<?= $committee_id ?>"
                                        class="dropdown-item">Change Passwrod</a>
                                    <form action="formsubmit.php" method="post" id="delete">
                                        <input type="hidden" name="committee_id" value="<?= $committee_id ?>">
                                        <input type="hidden" name="remove_committee" value="1">
                                        <button type="submit" class="dropdown-item">Remove Committee</button>
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