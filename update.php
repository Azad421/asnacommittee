<?php
ob_start();
include('partials/checkloggedin.php');
?>
<?php
$title = "Jalaria Update";
include_once("./php/autoload.php");
include('partials/header.php');

?>
<div class="content-wrapper">
    <div class="row mb-5">
        <div class="col-lg-5 col-md-6 col-sm-8 col-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update Login Id</h4>
                    <form class="forms-sample" action="formsubmit.php" method="POST" id="update">
                        <div class="form-group">
                            <label for="asnaf_name">Login Id</label>
                            <input type="text" class="form-control" name="login_id" id="asnaf_name" value="<?= $login_id ?>" placeholder="User Name">
                        </div>
                        <input type="hidden" name="changeloginId" value="1">
                        <input type="hidden" name="committee_id" value="<?= $committee_id ?>">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-5 col-md-6 col-sm-8 col-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Change Password</h4>
                    <form class="forms-sample" action="formsubmit.php" method="POST" id="change">
                        <div class="form-group">
                            <label for="old_passowrd">Old Password</label>
                            <input type="password" class="form-control" name="old_password" id="old_passowrd" placeholder="Old Password">
                        </div>
                        <div class="form-group">
                            <label for="asnaf_name">New Password</label>
                            <input type="password" class="form-control" name="new_password" id="asnaf_name" placeholder="New Password">
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
                        </div>
                        <input type="hidden" name="changecommitteepass" value="1">
                        <input type="hidden" name="committee_id" value="<?= $committee_id ?>">
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
        submitForm(e, formid, ischanged);
    });

    function ischanged(response) {
        if (response.status == 1) {
            setTimeout(() => {
                window.location.href = response.url;
            }, 3000);
        }
    };

    $('form#change').submit(function(e) {
        e.preventDefault();
        var formid = $(this);
        submitForm(e, formid, isAdded);
    });

    function isAdded(response) {
        if (response.status == 1) {
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