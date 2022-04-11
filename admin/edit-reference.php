<?php
$title = "Create Reference";
include('./partials/checkAdmin.php');
include_once('../php/autoload.php');
include('partials/header.php');
if (!isset($_GET['reference'])) {
    header("location:members.php");
}

$reference = $_GET['reference'];
$sql = "SELECT * FROM `asnaf_references` WHERE `asnaf_references`.`id`='$reference'";

$select = $db->runquery($sql);
$count = $select->num_rows;
$row = $select->fetch_assoc()
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-5 col-md-6 col-sm-8 col-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">New Reference</h4>
                    <form action="formsubmit.php" id="save_record" method="POST">
                        <div class="form-group">
                            <label for="source">Source</label>
                            <input type="text" class="form-control" name="source" id="source" value="<?= $row['source'] ?>" placeholder="Enter Source">
                        </div>
                        <div class="form-group">
                            <label for="source_date">Source Date</label>
                            <input type="date" class="form-control" name="source_date" value="<?= $row['source_date'] ?>" id="source_date"
                                   placeholder="Source Date">
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" class="form-control" name="country" value="<?= $row['country'] ?>" id="country"
                                   placeholder="Country">
                        </div>
                        <div class="form-group">
                            <label for="material">Material</label>
                            <select name="material_type" class="form-control" id="material_type">
                                <option value="">Select Material Type</option>
                                <?php
                                $sql = "SELECT * FROM `references_material`";
                                $select_m = $db->runquery($sql);
                                if ($select_m->num_rows > 0) {
                                    while ($material = $select_m->fetch_assoc()) {
                                        ?>
                                        <option value="<?= $material['id'] ?>" <?= $core->itemSelected($material['id'], $row['material_type']) ?>><?= $material['name'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="document_page">Document Page</label>
                            <input type="text" class="form-control" name="document_page"  value="<?= $row['doc_page'] ?>" id="document_page"
                                   placeholder="Document Page">
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" value="<?= $row['title'] ?>" id="title"
                                   placeholder="Title">
                        </div>
                        <div class="form-group">
                            <label for="expiry_date">Expiry Date</label>
                            <input type="date" class="form-control" name="expiry_date" value="<?= $row['expiry_date'] ?>" id="expiry_date"
                                   placeholder="expiry_date">
                        </div>
                        <div class="form-group">
                            <label for="status_record">Note: Date and Status</label>
                            <input type="text" class="form-control" name="status_record" value="<?= $row['status_record'] ?>" id="status_record"
                                   placeholder="Note: Date and Status">
                        </div>
                        <input type="hidden" name="reference" value="<?= $reference ?>">
                        <input type="hidden" name="update_reference" value="1">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('form#save_record').submit(function(e) {
        e.preventDefault();
        var formid = $(this);
        submitForm(e, formid, isSaved);
    });

    function isSaved(response) {
        if (response.status == 1) {
            setTimeout(() => {
                window.location.href = response.url;
            }, 3000);
        }
    };
</script>
<!-- content-wrapper ends -->
<?php
include('partials/_footer.php');
?>
