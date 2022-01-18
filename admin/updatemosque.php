<?php
include_once("../php/autoload.php");
include_once("./partials/checkAdmin.php");
$title = "Asnaf Commitee - Add Mosque";
include('./partials/header.php');
if (!isset($_GET['mosque'])) {
    header("location:mosque.php");
}
$mosque_id = $_GET['mosque'];
$sql = "SELECT * FROM `mosques` WHERE `mosque_id`='$mosque_id'";
$select = $db->runquery($sql);
$row = $select->fetch_assoc();
$mosque_id = $row['mosque_id'];
$mosque_name = $row['mosque_name'];
$address1 = !empty($row['address1']) ? $row['address1'] . ', ' : '';
$address2 = !empty($row['address2']) ? $row['address2'] . ', ' : '';
$area = !empty($row['area']) ? $row['area'] : '';
$city = $row['city'];
$state = $row['state'];
$postcode = $row['postcode'];
$country = $row['country'];
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-6 col-sm-8 col-lg-5 col-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update Mosque</h4>
                    <form class="forms-sample" action="formsubmit.php" method="POST" id="add_mosque">
                        <div class="form-group">
                            <label for="name">Mosque Name</label>
                            <input type="text" class="form-control" name="mosque_name" value="<?= $mosque_name ?>"
                                id="name" placeholder="Mosque Name">
                        </div>
                        <div class="form-group">
                            <label for="address1">Address 1</label>
                            <input type="text" class="form-control" id="address1" name="address1"
                                value="<?= $address1 ?>" placeholder="Address 1">
                        </div>
                        <div class="form-group">
                            <label for="address2">Address 2</label>
                            <input type="text" class="form-control" id="address2" name="address2"
                                value="<?= $address2 ?>" placeholder="Address 2">
                        </div>
                        <div class="form-group">
                            <label for="area">Area</label>
                            <input type="text" id="area" name="area" class="form-control" value="<?= $area ?>"
                                placeholder="Area">

                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" class="form-control" value="<?= $city ?>"
                                placeholder="City">
                        </div>
                        <div class="form-group">
                            <label for="postcode">Post Code</label>
                            <input type="text" id="postcode" name="postcode" class="form-control"
                                value="<?= $postcode ?>" placeholder="Post Code">
                        </div>
                        <div class="form-group">
                            <label for="state">State</label>
                            <input type="text" id="state" name="state" class="form-control" value="<?= $state ?>"
                                placeholder="State">
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" id="country" name="country" class="form-control" value="<?= $country ?>"
                                placeholder="Country">
                        </div>
                        <input type="hidden" name="mosque_id" value="<?= $mosque_id ?>">
                        <input type="hidden" name="update_mosque" value="1">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$('form#add_mosque').submit(function(e) {
    e.preventDefault();
    var formid = $(this);
    submitForm(e, formid, isAdded);
});

function isAdded(response) {
    if (response.status == 1) {
        setTimeout(() => {
            window.location.href = "mosques.php";
        }, 3000);
    }
};
</script>
<!-- content-wrapper ends -->
<?php
include('./partials/_footer.php');
?>