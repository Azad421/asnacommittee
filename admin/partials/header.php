<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title ?? "" ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= URL ?>vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?= URL ?>vendors/base/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?= URL ?>vendors/dropify/dist/css/dropify.min.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="<?= URL ?>vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= URL ?>css/style.css">
    <link rel="stylesheet" href="<?= URL ?>css/custome.css">
    <link rel="stylesheet" href="<?= URL ?>vendors/toastr/toastr.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= URL ?>images/Ba_logo4.png" />

    <!-- plugins:js -->
    <script src="<?= URL ?>vendors/base/vendor.bundle.base.js"></script>
    <script src="<?= URL ?>vendors/toastr/toastr.js"></script>
    <script src="<?= URL ?>js/formSubmit.js"></script>
    <script src="<?= URL ?>js/loader.js"></script>
    <script src="<?= URL ?>js/off-canvas.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="<?= URL ?>vendors/dropify/dist/js/dropify.min.js"></script>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex justify-content-center">
                <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
                    <a class="navbar-brand brand-logo" href="javascript:">
                        <img src="<?= URL ?>images/Ba_logo4.png" alt="Asnaf committee">
                    </a>
                    <a class="navbar-brand brand-logo-mini" href="javascript:">
                        <img src="<?= URL ?>images/Ba_logo4.png" alt="Asnaf committee">
                    </a>
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-toggle="minimize">
                        <span class="mdi mdi-sort-variant"></span>
                    </button>
                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                            <span class="nav-profile-name"><?= $user_name ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                            aria-labelledby="profileDropdown">
                            <a href="<?= URL ?>admin/logout.php" class="dropdown-item">
                                <i class="mdi mdi-logout text-primary"></i>
                                Logout
                            </a>
                            <a href="<?= URL ?>admin/update.php" class="dropdown-item">
                                <i class="mdi mdi-update text-primary"></i>
                                Update Profile
                            </a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <?php
            include('_sidebar.php');
            ?>
            <!-- partial -->
            <div class="main-panel">
                <?php include_once('loader.php') ?>
