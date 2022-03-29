<?php
$pages = explode('/',$_SERVER['PHP_SELF']);
$page = end($pages);

?>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <?php
        if (isset($_SESSION['loggedin'])) {
            ?>
            <li class="nav-item">
                <a class="nav-link" href="allmembers.php">
                    <i class="mdi mdi-home menu-icon"></i>
                    <span class="menu-title">All</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="area.php">
                    <i class="mdi mdi-account menu-icon"></i>
                    <span class="menu-title">Area</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="commitees.php">
                    <i class="mdi mdi-account menu-icon"></i>
                    <span class="menu-title">Committee</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="reportedasnaf.php">
                    <i class="mdi mdi-account menu-icon"></i>
                    <span class="menu-title">Reported Asnaf</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $page=='donor_help.php'?'active':'' ?>" href="donors.php">
                    <i class="mdi mdi-account menu-icon"></i>
                    <span class="menu-title">Donors</span>
                </a>
            </li>
            <?php
        } else {
            ?>
            <li class="nav-item <?= $page=='asnaf_details_public.php'?'active':'' ?>">
                <a class="nav-link" href="index.php">
                    <i class="mdi mdi-home menu-icon"></i>
                    <span class="menu-title">Individuals</span>
                </a>
            </li>
            <li class="nav-item <?= $page=='donors_help.php'?'active':'' ?>">
                <a class="nav-link" href="donors_public.php">
                    <i class="mdi mdi-account menu-icon"></i>
                    <span class="menu-title">Donors</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="donors_loc_public.php">
                    <i class="mdi mdi-account menu-icon"></i>
                    <span class="menu-title">Donor By Location</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="becomedoner.php">
                    <i class="mdi mdi-account menu-icon"></i>
                    <span class="menu-title">Become a doner</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="reportasnaf.php">
                    <i class="mdi mdi-account menu-icon"></i>
                    <span class="menu-title">Report an asnaf</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="noticeboard.php">
                    <i class="mdi mdi-note-multiple-outline menu-icon"></i>
                    <span class="menu-title">Notice Board</span>
                </a>
            </li>
            <?php
        }
        ?>
    </ul>
    <div class="mb-3">
        <img class="img-fluid" src="./images/Sidebar_I1.png" alt="">
    </div>
    <div class="mb-3">
        <img class="img-fluid" src="./images/Sidebar_I2.png" alt="">
    </div>
    <div class="mb-3">
        <img class="img-fluid" src="./images/Sidebar_I3.png" alt="">
    </div>
</nav>
