<?php
ob_start();
$title = "Jalaria Update Password";
include_once("../php/autoload.php");
include('partials/checkloggedin.php');
include('partials/header.php');
if (!isset($_GET['committee'])) {
    header("location:committee.php");
}

?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-5 col-md-6 col-sm-8 col-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update Password</h4>
                    <form class="forms-sample" action="formsubmit.php" method="POST" id="update">
                        <div class="form-group">
                            <label for="asnaf_name">New Passowrd</label>
                            <input type="password" class="form-control" name="new_passowrd" id="asnaf_name"
                                placeholder="New Password">
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                                placeholder="Confirm Password">
                        </div>
                        <input type="hidden" name="committee_id" value="<?= $_GET['committee'] ?>">
                        <input type="hidden" name="changecommitteepass" value="1">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$('form#update').submit(function(e) {
    e.preventDefault();
    var formid = $(this);
    submitForm(e, formid, isAdded);
});

function isAdded(response) {
    if (response.status == 1) {
        $('#update').each(function() {
            this.reset();
        });
        setTimeout(() => {
            window.location.href = response.url;
        }, 3000);
    }
};
</script>
</script>
<!-- content-wrapper ends -->
<?php
include('partials/_footer.php');
?>