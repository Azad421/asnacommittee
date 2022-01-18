<?php include_once('./partials/checkAdmin.php') ?>
<?php
$title = "Asnaf Commitee";
include_once("../php/autoload.php");
include('partials/header.php');
if (!isset($_GET['member'])) {
    header("location:members.php");
}
if (isset($_POST['makecommittee'])) {
    $response['status'] = 0;
    $response['message'] = "Wrong Request Sent!";
    $response['type'] = "warning";
    $response = $user->makeCommittee($_POST);
    if ($response['status'] == 1) {
        unset($_POST['makecommittee']);
    }
?>
    <script>
        var response = <?= json_encode($response); ?>;
        toastr[response.type](response.message);
        setTimeout(() => {
            if (response.status == 1) {
                window.location.href = 'members.php';
            }
        }, 3000);
    </script>
<?php
}

?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-5 col-md-6 col-sm-8 col-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Committee</h4>
                    <form class="forms-sample" action="" method="POST" id="makeasnaf">
                        <div class="form-group">
                            <label for="mosque_id">Select Mosque</label>
                            <select name="mosque_id" class="form-control" id="mosque_id">
                                <option value="">Select Mosque</option>
                                <?php
                                $sql = "SELECT * FROM `mosques`";
                                $select = $db->runquery($sql);
                                if ($select->num_rows > 0) {
                                    while ($row = $select->fetch_assoc()) {
                                ?>
                                        <option value="<?= $row['mosque_id'] ?>"><?= $row['mosque_name'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="asnaf_name">Login Id</label>
                            <input type="text" class="form-control" name="asnaf_name" id="asnaf_name" placeholder="Login Id">
                        </div>
                        <div class="form-group">
                            <label for="position">Position</label>
                            <input type="text" class="form-control" id="position" name="position" placeholder="Position">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                        <input type="hidden" name="Identification_id" value="<?= $_GET['member'] ?>">
                        <input type="hidden" name="makecommittee" value="1">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <a onclick="window.location.href='./members.php'" class="btn btn-primary mr-2 text-white">cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</script>
<!-- content-wrapper ends -->
<?php
include('partials/_footer.php');
?>