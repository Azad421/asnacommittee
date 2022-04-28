<?php
require_once("../php/autoload.php");
include_once("./partials/checkAdmin.php");
$title = "Jalaria Admin - Members";
$sql = "SELECT * FROM `all_members`";
if (isset($_GET['search'])) {
    $key = $_GET['search'];
    $sql .= "WHERE CONCAT_WS( `name`, `address1`, `address2`, `area`, `city`, `state`) LIKE '%$key%'";
}
$sql .= " ORDER BY `name` ASC";
$select = $db->runquery($sql);
$count = $select->num_rows;
include_once('./partials/header.php');
?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <?php include_once("./partials/searchform.php") ?>
            <div id="printContent" data-title="Asnaf Members List">
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
                <div class="row columnTitle">
                    <div class="col-2 col-sm-1 text-right p-1">No</div>
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
                        $Identification_id = $row['Identification_id'];
                        $name = $row['name'];
                        $address1 = $row['address1'];
                        $address2 = $row['address2'];
                        $area = $row['area'];
                        $area = is_numeric($area) ? $db->runquery("SELECT * FROM `mosque_areas` WHERE `area_id`='$area'")->fetch_assoc()['area_name'] : $area;
                        $city = $row['city'];
                        $city = is_numeric($city) ? $db->runquery("SELECT * FROM `cities` WHERE `id`='$city'")->fetch_assoc()['name'] : $city ;
                        $state = $row['state'];
                        $state = is_numeric($state) ? $db->runquery("SELECT * FROM `states` WHERE `id`='$state'")->fetch_assoc()['name'] : $state;
                        $postcode = $row['postcode'];
                        $country = $row['country'];
                        $telephone = $row['telephone'];
                        ?>
                <div class="row" id="row<?= $Identification_id ?>">
                    <div class="col-2 col-sm-1 p-1 text-right">
                        <?= $i . '.' ?>
                    </div>
                    <div class="col-10 col-sm-11 p-1">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <a class="text-dark text-decoration-none"
                                    href="member_details.php?member=<?= $Identification_id ?>">
                                    <?= $name ?>
                                </a>
                            </div>
                            <div class="col-md-5">
                                <?= $address1 . ", " . $address2 . ", " . $area . ", " . $city . ", " . $postcode . ", " . $state . ", " . $country ?>
                            </div>
                            <div class="col-md-2"><?= $telephone ?></div>
                            <div class="col-md-2 save_as">
                                <a href="javascript:" data-toggle="dropdown" id="asnafdropdown"
                                    class="btn btn-success">Action</a>
                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                                    aria-labelledby="asnafdropdown">
                                    <a href="agency.php?member=<?= $Identification_id ?>" class="dropdown-item">Select
                                        as Asnaf
                                    </a>
                                    <a href="ascommittee.php?member=<?= $Identification_id ?>" class="dropdown-item">As
                                        asnaf
                                        Committee</a>
                                    <a href="member_details.php?member=<?= $Identification_id ?>"
                                        class="dropdown-item">Details</a>
                                    <a href="updateuser.php?user=<?= $Identification_id ?>"
                                        class="dropdown-item">Edit</a>
                                    <form action="formsubmit.php" method="post" id="delete">
                                        <input type="hidden" name="Identification_id" value="<?= $Identification_id ?>">
                                        <input type="hidden" name="delete_member" value="1">
                                        <button type="submit" class="dropdown-item">Delete</button>
                                    </form>
                                    <!--<a href="agency.php?member=<?= $Identification_id ?>" class="dropdown-item">Mosque Memeber</a>-->
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