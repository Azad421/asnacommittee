<?php
include_once("../php/autoload.php");
include_once("./partials/checkAdmin.php");
$title = "Asnaf Commitee - Add Mosque";
$areas = [];
$countries = [];
include('./partials/header.php');
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-6 col-sm-8 col-lg-5 col-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add Mosque</h4>
                    <form class="forms-sample" action="formsubmit.php" method="POST" id="add_mosque">
                        <div class="form-group">
                            <label for="name">Mosque Name</label>
                            <input type="text" class="form-control" name="mosque_name" id="name" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="address1">Address 1</label>
                            <input type="text" class="form-control" id="address1" name="address1"
                                placeholder="Address 1">
                        </div>
                        <div class="form-group">
                            <label for="address2">Address 2</label>
                            <input type="text" class="form-control" id="address2" name="address2"
                                placeholder="Address 2">
                        </div>
                        <div class="form-group">
                            <label for="area">Area</label>
                            <input type="text" id="area" name="area" class="form-control" placeholder="Area">

                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" id="city" name="city" class="form-control" placeholder="City">
                        </div>
                        <div class="form-group">
                            <label for="postcode">Post Code</label>
                            <input type="text" id="postcode" name="postcode" class="form-control"
                                placeholder="Post Code">
                        </div>
                        <div class="form-group">
                            <label for="state">State</label>
                            <input type="text" id="state" name="state" class="form-control" placeholder="State">
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" id="country" name="country" class="form-control" placeholder="Country">
                        </div>
                        <input type="hidden" name="add_mosque" value="1">
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
        $('#add_mosque').each(function() {
            this.reset();
        });
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