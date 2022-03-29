<?php
session_start();
ob_start();
include_once("./php/autoload.php");
include_once('./partials/checckloggedout.php');
$title = "Become A donor";
$areas = [];
$member_id = '';
if (isset($_GET['asnaf'])) {
    $member_id = $_GET['asnaf'];
}
include('partials/header.php');
# please fill in the required info as below
$merchant_id = '';
$secretkey = '';


# this part is to process data from the form that user key in, make sure that all of the info is passed so that we can process the payment
if(isset($_POST['detail']) && isset($_POST['amount']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']))
{
    # assuming all of the data passed is correct and no validation required. Preferably you will need to validate the data passed
    $hashed_string = md5($secretkey.urldecode($_POST['detail']).urldecode($_POST['amount']).urldecode($_POST['order_id']));

    # now we send the data to senangPay by using post method
    ?>
    <section onload="document.order.submit()">
    <form name="order" method="post" action="https://app.senangpay.my/payment/<?php echo $merchant_id; ?>">
        <input type="hidden" name="detail" value="<?php echo $_POST['detail']; ?>">
        <input type="hidden" name="amount" value="<?php echo $_POST['amount']; ?>">
        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
        <input type="hidden" name="name" value="<?php echo $_POST['name']; ?>">
        <input type="hidden" name="email" value="<?php echo $_POST['email']; ?>">
        <input type="hidden" name="phone" value="<?php echo $_POST['phone']; ?>">
        <input type="hidden" name="hash" value="<?php echo $hashed_string; ?>">
    </form>
    </section>
    <?php
}
# this part is to process the response received from senangPay, make sure we receive all required info
else if(isset($_GET['status_id']) && isset($_GET['order_id']) && isset($_GET['msg']) && isset($_GET['transaction_id']) && isset($_GET['hash']))
{
    # verify that the data was not tempered, verify the hash
    $hashed_string = md5($secretkey.urldecode($_GET['status_id']).urldecode($_GET['order_id']).urldecode($_GET['transaction_id']).urldecode($_GET['msg']));

    # if hash is the same then we know the data is valid
    if($hashed_string == urldecode($_GET['hash']))
    {
        # this is a simple result page showing either the payment was successful or failed. In real life you will need to process the order made by the customer
        if(urldecode($_GET['status_id']) == '1')
            echo 'Payment was successful with message: '.urldecode($_GET['msg']);
        else
            echo 'Payment failed with message: '.urldecode($_GET['msg']);
    }
    else
        echo 'Hashed value is not correct';
}
?>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-6 col-sm-8 col-lg-5 col-10 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Donation Payment</h4>
                        <h1 class="text-primary">Coming Soon</h1>
<!--                        <form class="forms-sample" action="" method="POST">-->
<!--                            <div class="form-group">-->
<!--                                <label for="name">Name</label>-->
<!--                                <input type="text" class="form-control" name="name" id="name" placeholder="Name">-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="name">Email</label>-->
<!--                                <input type="email" class="form-control" name="email" id="name" placeholder="Email">-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="phone">Telephone</label>-->
<!--                                <input type="text" class="form-control mb-3" id="phone" name="phone"-->
<!--                                       placeholder="Telephone">-->
<!--                                <input type="text" class="form-control" id="telephone2" name="telephone2"-->
<!--                                       placeholder="Telephone">-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="address">Address</label>-->
<!--                                <input type="text" class="form-control mb-3" id="address1" name="address1"-->
<!--                                       placeholder="Address 1">-->
<!--                                <input type="text" class="form-control" id="address2" name="address2"-->
<!--                                       placeholder="Address 2">-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="city">City</label>-->
<!--                                <input type="text" class="form-control" name="city" id="city" placeholder="City">-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="state">State</label>-->
<!--                                <input type="text" class="form-control" name="state" id="state" placeholder="State">-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="donation_to_asnaf">Donation to asnaf RM</label>-->
<!--                                <input type="text" class="form-control" name="donation_to_asnaf" id="donation_to_asnaf"-->
<!--                                       placeholder="Donation to asnaf RM">-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="donation_to_mosque">Donation to the witnessing mosque RM</label>-->
<!--                                <input type="text" class="form-control" name="donation_to_mosque" id="state"-->
<!--                                       placeholder="Donation to the witnessing mosque RM">-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="amount">Total Donation</label>-->
<!--                                <input type="text" class="form-control" name="amount" id="amount"-->
<!--                                       placeholder="Donation to the witnessing mosque RM">-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="details">Payment Details</label>-->
<!--                                <input type="text" class="form-control" name="details" id="details"-->
<!--                                       placeholder="details" value="Donation To Jalaria" readonly>-->
<!--                            </div>-->
<!--                            <button type="submit" class="btn btn-primary">Submit</button>-->
<!--                            <input type="hidden" name="add_donor" value="1">-->
<!--                            <input type="hidden" name="user_id" value="--><?//= $member_id ?><!--">-->
<!---->
<!--                            <p>Thank you for your donation</p>-->
<!--                                                     <button type="submit" class="btn btn-primary mr-2">Submit</button>-->
<!--                        </form>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>



        $('form#add_onor').submit(function (e) {
            e.preventDefault();
            var formid = $(this);
            submitForm(e, formid, isAdded);
        });

        function isAdded(response) {
            if (response.status == 1) {
                $('#add_donor').each(function () {
                    this.reset();
                });
                setTimeout(() => {
                    window.location.href = 'becomedoner.php';
                }, 3000);
            }
        };
        for (let i = 0; i < 4; i++) {
            $('select#area' + i).select2();
        }
    </script>
    <!-- content-wrapper ends -->
<?php
include('./partials/_footer.php');
?>