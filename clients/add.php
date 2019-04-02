<?php
/**
 * Created by PhpStorm.
 * User: mohamadzaki
 * Date: 23/03/2019
 * Time: 8:22 PM
 */

include_once '../config/database.php';
include_once '../objects/clients.php';

$database = new Database();
$connection = $database->getConnection();

$Client = new Clients($connection);

$error = false;
$errorMsg = '';

//POST ACTION
if (isset($_POST) && $_POST) {

    $post = $_POST;

    $Client->name = $post['name'];
    $Client->email = $post['email'];
    $Client->company = $post['company'];
    $Client->phone = $post['phone'];
    $Client->address = $post['address'];
    $Client->status = $post['status'];

    $status = $Client->add();
    ///dd($status);

    if ($status == 1) {
        $error = false;
        redirect('index.php', 'Save success');
    } elseif ($status == 'exists') {
        $error = true;
        $errorMsg = validation_msg('Client already exists.', 'warning');
    } else {
        $error = true;
        $errorMsg = validation_msg('Please try agian.', 'danger');
    }
}

?>
<!-- partial:_head -->
<?php include '../partials/_head.php' ?>
<!-- partial -->
<div class="container-scroller">
    <!-- partial:_navbar -->
    <?php include '../partials/_navbar.php' ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:_sidebar -->
        <?php include '../partials/_sidebar.php' ?>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">


                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">New Client</h4>
                                <?= redirect_flash(); ?>
                                <?= $errorMsg; ?>
                                <form class="forms-sample" method="post">
                                    <div class="form-group">
                                        <label for="inputName">Name</label>
                                        <input type="text" name="name" class="form-control" id="inputName"
                                               placeholder="Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail">Email</label>
                                        <input type="text" name="email" class="form-control" id="inputEmail"
                                               placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPhone">Phone</label>
                                        <input type="text" name="phone" class="form-control" id="inputPhone"
                                               placeholder="Phone">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputCompany">Company</label>
                                        <input type="text" name="company" class="form-control" id="inputCompany"
                                               placeholder="Company Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress">Address</label>
                                        <textarea name="address" class="form-control" id="inputAddress"
                                                  rows="5"></textarea>
                                    </div>

                                    <div class="custom-control custom-checkbox p-0">
                                        <input type="hidden" name="status" value="0">
                                        <input type="checkbox" name="status" value="1" class="custom-control-input"
                                               id="inputActive">
                                        <label class="custom-control-label pl-4" for="inputActive">Is Active</label>
                                    </div>
                                    <div class="mt-4">
                                        <button type="submit" class="btn btn-success mr-2">Submit</button>
                                        <button type="reset" class="btn btn-light">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:_footer -->
            <?php include '../partials/_footer.php' ?>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

<!-- partial:_bottom -->
<?php include '../partials/_bottom.php' ?>
<!-- partial -->

