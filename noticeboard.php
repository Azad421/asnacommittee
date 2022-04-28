<?php
session_start();
include_once("./php/autoload.php");
$title = "Jalaria - Notice board";
include_once('./partials/checckloggedout.php');
include('partials/header.php');

$sql = "SELECT * FROM `asnaf` INNER JOIN `all_members` ON `asnaf`.`Identification_id`=`all_members`.`Identification_id`  ";
if (isset($_GET['search'])) {
    $key = $_GET['search'];
    $sql .= "WHERE CONCAT_WS( `name`, `address1`, `address2`, `area`, `city`, `state`) LIKE '%$key%'";
}
$sql .= " ORDER BY `area` ASC";
$select = $db->runquery($sql);
$count = $select->num_rows;

?>
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <div id="printContent" data-title="<?= $nick_name ?>">
                    <?php if ($count > 0) { ?>
                        <div class="d-flex justify-content-end">
                            <?php include_once('./partials/printdate.php') ?>
                        </div>
                        <?php
                    }
                    ?>
                    <h4 class="text-center nTitle">Notice board</h4>
                    <div class="text-center">
                        <img src="./images/Ba_logo4.png" class="img-fluid" alt="Notice Board">
                    </div>
                    <div class="text-center">
                        <img src="./images/Ba_logo4a.png" class="img-fluid" alt="Notice Board">
                    </div>
                    <div class="text-center">
                        <img src="./images/Ba_logo4b.png" class="img-fluid" alt="Notice Board">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
<?php
include('./partials/_footer.php');
?>