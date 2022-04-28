<?php
session_start();
include_once("./php/autoload.php");
include_once('./partials/checckloggedout.php');
$title = "Jalaria - Report Asnaf";
$areas = [];
$countries = [];
include('./partials/header.php');
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-6 col-sm-8 col-lg-5 col-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Report An Asnaf</h4>
                    <form class="forms-sample" action="formsubmit.php" method="POST" id="add_mosque">
                        <div class="form-group">
                            <label for="name">Reporter Name</label>
                            <input type="text" class="form-control" name="reporter_name" id="name"
                                placeholder="Reporter Name">
                        </div>
                        <div class="form-group">
                            <label for="reporter_telephone">Reporter Telephone</label>
                            <input type="text" class="form-control" id="reporter_telephone" name="reporter_telephone"
                                placeholder="Reporter Telephone">
                        </div>
                        <div class="form-group">
                            <label for="reportasnaf_name">Report Asnaf Name</label>
                            <input type="text" class="form-control" id="reportasnaf_name" name="reportasnaf_name"
                                placeholder="Report Asnaf Name">
                        </div>
                        <div class="form-group">
                            <label for="report_asnaf_telephone">Report Asnaf Telephone</label>
                            <input type="text" id="report_asnaf_telephone" name="report_asnaf_telephone"
                                class="form-control" placeholder="Report Asnaf Telephone">

                        </div>
                        <div class="form-group">
                            <label for="report_asnaf_address">Report Asnaf Address</label>
                            <input type="text" id="report_asnaf_address" name="report_asnaf_address"
                                class="form-control" placeholder="Report Asnaf Address">
                        </div>
                        <div class="form-group">
                            <label for="report_asnaf_area">Report Asnaf Area</label>
                            <select name="report_asnaf_area" class="form-control area" id="report_asnaf_area">
                                <option value="">Report Asnaf Area</option>
                                <?php
                                        $sql = "SELECT * FROM `mosque_areas`";
                                        $select = $db->runquery($sql);
                                        if ($select->num_rows > 0) {
                                            while ($row = $select->fetch_assoc()) {
                                        ?>
                                <option value="<?= $row['area_id'] ?>"><?= $row['area_name'] ?></option>
                                <?php
                                            }
                                        }
                                        ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="report_asnaf_city">Report Asnaf City</label>
                            <input type="text" id="report_asnaf_city" name="report_asnaf_city" class="form-control"
                                placeholder="Report Asnaf City">
                        </div>
                        <div class="form-group">
                            <label for="report_asnaf_state">Report Asnaf State</label>
                            <input type="text" id="report_asnaf_state" name="report_asnaf_state" class="form-control"
                                placeholder="Report Asnaf State">
                        </div>
                        <div class="form-group">
                            <label for="report_asnaf_condition">Report Asnaf Condition</label>
                            <textarea id="report_asnaf_condition" name="report_asnaf_condition" rows="9" class="form-control"
                                placeholder="Report Asnaf Condition"></textarea>
                        </div>
                        <div class="mb-3">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat, saepe sapiente. Assumenda cum esse harum itaque minima officia reiciendis reprehenderit similique voluptate? Aliquid, eius, quo.</p>
                        </div>
                        <input type="hidden" name="add_report" value="1">
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
    }
};
$('select#report_asnaf_area').select2();
</script>
<!-- content-wrapper ends -->
<?php
include('./partials/_footer.php');
?>