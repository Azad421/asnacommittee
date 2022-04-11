<?php
require_once("../php/autoload.php");
include_once("./partials/checkAdmin.php");
$title = "Asnaf Committee - References";
$sql = "SELECT `asnaf_references`.`id`, `m`.`name` AS name, `m`.`nick_name` AS nick_name, `references_material`.`name` AS `material_type`, `source`, `title`,`asnaf_references`.`country`,`status_record` FROM `asnaf_references` INNER JOIN `references_material` ON `asnaf_references`.`material_type`=`references_material`.`id` INNER JOIN `asnaf` ON `asnaf_references`.`asnaf_id`=`asnaf`.`asnaf_id` INNER JOIN `all_members` as m ON `m`.`Identification_id`=`asnaf`.`Identification_id` ";
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $key = $_GET['search'];
    $sql .= "WHERE CONCAT_WS( `m`.`name`, `m`.`nick_name`, `source`, `references_material`.`name`, `title`, `asnaf_references`.`country`) LIKE '%$key%'";
}
$select = $db->runquery($sql);
echo $db->con->error;
$count = $select->num_rows;
include_once('./partials/header.php');
?>
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <?php include_once("./partials/searchform.php") ?>
                <div id="printContent" data-title="Asnaf Members List">
                    <div class="d-flex justify-content-end">
                        <?php if ($count > 0) { ?>
                            <a class="btn btn-success printbtn" onclick="printDiv('printContent')">
                                <span class="text-white">Print</span>
                            </a>
                            <?php include_once('./partials/printdate.php') ?>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="row columnTitle">
                        <div class="col-2 col-sm-1 text-right p-1">No</div>
                        <div class="col-10 col-sm-11 p-1">
                            <div class="row mb-3">
                                <div class="col-md-2">Name</div>
                                <div class="col-md-2">
                                    Source
                                </div>
                                <div class="col-md-2">
                                    Material Type
                                </div>
                                <div class="col-md-2">
                                    Title
                                </div>
                                <div class="col-md-2">
                                    Country
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if ($count > 0) {
                        $i = 1;
                        while ($row = $select->fetch_assoc()) {
                            $id = $row['id'];
                            $name = $row['name'];
                            $source = $row['source'];
                            $source_date = $row['source_date'];
                            $title = $row['title'];
                            $doc_page = $row['doc_page'];
                            $country = $row['country'];
                            $expiry_date = $row['expiry_date'];
                            $status_record = $row['status_record'];
                            ?>
                            <div class="row" id="row<?= $id ?>">
                                <div class="col-2 col-sm-1 p-1 text-right">
                                    <?= $i . '.' ?>
                                </div>
                                <div class="col-10 col-sm-11 p-1">
                                    <div class="row mb-3">
                                        <div class="col-md-2">
                                            <?= $name ?>
                                        </div>
                                        <div class="col-md-2">
                                            <?= $source ?>
                                        </div>
                                        <div class="col-md-2">
                                            <?= $row['material_type'] ?>
                                        </div>
                                        <div class="col-md-2">
                                            <?= $title ?>
                                        </div>
                                        <div class="col-md-2"><?= $country ?></div>
                                        <div class="col-md-2 save_as">
                                            <a href="javascript:" data-toggle="dropdown" id="asnafdropdown"
                                               class="btn btn-success">Action</a>
                                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                                                 aria-labelledby="asnafdropdown">
                                                <a href="edit-reference.php?reference=<?= $id ?>"
                                                   class="dropdown-item">Edit</a>
                                                <form action="formsubmit.php" method="post" id="delete_reference">
                                                    <input type="hidden" name="reference_id"
                                                           value="<?= $id ?>">
                                                    <input type="hidden" name="delete_reference" value="1">
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
                        <h4 class="text-center">No members found</h4>
                        <?php
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('form#delete_reference').submit(function (e) {
            e.preventDefault();
            var formid = $(this);
            submitForm(e, formid, isDeleted);
        });

        function isDeleted(response) {
            if (response.status == 1) {
                $(response.row).remove();
            }
        };
    </script>
    <!-- content-wrapper ends -->
<?php
include('partials/_footer.php');
?>