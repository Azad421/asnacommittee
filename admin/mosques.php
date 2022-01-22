<?php
include_once("../php/autoload.php");
include_once("./partials/checkAdmin.php");
$title = "Asnaf Commitee - Mosque";
include('partials/header.php');
$sql = "SELECT * FROM `mosques` ";
if (isset($_GET['search'])) {
    $key = $_GET['search'];
    $sql .= "WHERE CONCAT_WS( `mosque_name`, `address1`, `address2`, `area`, `city`, `state`) LIKE '%$key%'";
}
$sql .= " ORDER BY `mosque_name` ASC";
$select = $db->runquery($sql);
$count = $select->num_rows;
?>
<div class="content-wrapper">
    <div class="card">
        <div class="card-body">
            <?php include_once("./partials/searchform.php") ?>
            <div id="printContent" data-title="Mosque List">
                <div class="d-flex justify-content-end mb-3">
                    <a class="btn btn-success mr-3 addbtn" href="addmosque.php">
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
                    <div class="col-2 col-sm-1 p-1 text-right">No</div>
                    <div class="col-10 col-sm-11 p-1">
                        <div class="row mb-3">
                            <div class="col-md-3">Name</div>
                            <div class="col-md-7">
                                Address
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                if ($count > 0) {
                    $i = 1;
                    while ($row = $select->fetch_assoc()) {
                        $mosque_id = $row['mosque_id'];
                        $mosque_name = $row['mosque_name'];
                        $address1 = !empty($row['address1']) ? $row['address1'] . ', ' : '';
                        $address2 = !empty($row['address2']) ? $row['address2'] . ', ' : '';
                        // $area = !empty($row['area_name']) ? $row['area_name'] : '';
                        $city = $row['city'];
                        $state = $row['state'];
                        $postcode = $row['postcode'];
                        $country = $row['country'];
                ?>
                <div class="row">
                    <div class="col-2 col-sm-1 p-1 text-right">
                        <?= $i . '.' ?>
                    </div>
                    <div class="col-10 col-sm-11 p-1">
                        <div class="row mb-3" id="row<?= $mosque_id ?>">
                            <div class="col-md-3">
                                <?= $mosque_name ?>
                            </div>
                            <div class="col-md-7">
                                <?= $address1 . $address2 . ", " . $city . ", " . $postcode . ", " . $state . ", " . $country ?>
                            </div>
                            <div class="col-md-2 save_as">
                                <a href="javascript:" data-toggle="dropdown" id="asnafdropdown"
                                    class="btn btn-success">Action</a>
                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                                    aria-labelledby="asnafdropdown">
                                    <a href="mosque_details.php?mosque=<?= $mosque_id ?>"
                                        class="dropdown-item">Details</a>
                                    <a href="updatemosque.php?mosque=<?= $mosque_id ?>" class="dropdown-item">Update</a>
                                    <form action="formsubmit.php" method="post" id="delete_Mosque">
                                        <input type="hidden" name="mosque_id" value="<?= $mosque_id ?>">
                                        <input type="hidden" name="delete_Mosque" value="1">
                                        <button type="submit" class="dropdown-item">Delete</button>
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
$('form#delete_Mosque').submit(function(e) {
    e.preventDefault();
    var formid = $(this);
    submitForm(e, formid, isDeleted);
});

function isDeleted(response) {
    if (response.status == 1) {
        setTimeout(() => {
            window.location.href = response.url;
        }, 3000);
    }
};
</script>
<!-- content-wrapper ends -->
<?php
include('partials/_footer.php');
?>