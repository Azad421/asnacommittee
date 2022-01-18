<?php
ob_start();
include_once('./partials/checkAdmin.php')
?>
<?php
$title = "Asnaf Commitee";
include_once("../php/autoload.php");
include('partials/header.php');

?>
<div class="content-wrapper">
    <div class="row mb-5">
        <div class="col-lg-5 col-md-6 col-sm-8 col-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update User name</h4>
                    <form class="forms-sample" action="formsubmit.php" method="POST" id="update">
                        <div class="form-group">
                            <label for="asnaf_name">User Name</label>
                            <input type="text" class="form-control" name="user_name" id="asnaf_name" value="<?= $user_name ?>" placeholder="User Name">
                        </div>
                        <input type="hidden" name="changeusername" value="1">
                        <input type="hidden" name="admin_id" value="<?= $admin_id ?>">
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
                            <label for="old_passowrd">Old Passowrd</label>
                            <input type="password" class="form-control" name="old_password" id="old_passowrd" placeholder="Old Password">
                        </div>
                        <div class="form-group">
                            <label for="asnaf_name">New Passowrd</label>
                            <input type="password" class="form-control" name="new_password" id="asnaf_name" placeholder="New Password">
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
                        </div>
                        <input type="hidden" name="changeadminpass" value="1">
                        <input type="hidden" name="admin_id" value="<?= $admin_id ?>">
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
            $('#update').each(function() {
                this.reset();
            });
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