<?php include_once('./partials/checckloggedout.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Asnaf Committe - Login</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="./vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="./vendors/base/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/custome.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="./images/Ba_logo4.png" />
    <link rel="stylesheet" href="./vendors/toastr/toastr.css">
</head>

<body>
    <?php include_once('./partials/loader.php'); ?>
    <div class="container-scroller content-wrapper">
        <div class="container page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0 align-items-center">
                    <div class="col-md-6 col-lg-7 d-none d-md-block">
                        <img class="w-100" src="./images/Ba_logo5.png" alt="">
                    </div>
                    <div class="col-lg-5 col-md-6 col-12 mx-auto ">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo text-center">
                                <img src="./images/Ba_logo4.png" alt="Asnaf committee">
                            </div>
                            <form class="pt-3" method="POST" action="formsubmit.php" id="loginform">
                                <div class="form-group">
                                    <input type="text" name="user_name" class="form-control form-control-lg"
                                        placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="user_password" class="form-control form-control-lg"
                                        placeholder="Password">
                                </div>
                                <div class="mt-3">
                                    <input type="hidden" name="loginform" value="1">
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                        type="submit">SIGN IN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="./vendors/base/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="./js/off-canvas.js"></script>
    <script src="./js/hoverable-collapse.js"></script>
    <script src="./js/template.js"></script>
    <script src="./vendors/toastr/toastr.js"></script>
    <script src="./js/formSubmit.js"></script>
    <script src="./js/loader.js"></script>
    <!-- endinject -->
    <script>
    $('form#loginform').submit(function(e) {
        e.preventDefault();
        var formid = $(this);
        submitForm(e, formid, isLoggedin);
    });

    function isLoggedin(response) {
        if (response.status == 1) {
            setTimeout(() => {
                window.location.href = 'allmembers.php';
            }, 3000);
        }
    };
    </script>
</body>

</html>