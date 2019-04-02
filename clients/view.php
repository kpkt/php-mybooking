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

$Clients = new Clients($connection);

$error = false;
$errorMsg = '';

/**
 * GET PARAM
 */
if (isset($_GET) && $_GET) {
    $get = $_GET;
    $client = $Clients->read($get['id']);
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
                                <h4 class="card-title">Update Client</h4>
                                <form class="forms-sample" method="post">

                                    <div class="form-group">
                                        <label for="inputName">Name</label>
                                        <input type="text" name="name" class="form-control" id="inputName" disabled
                                               value="<?= $client['name'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail">Email</label>
                                        <input type="text" name="email" class="form-control" id="inputEmail" disabled
                                               value="<?= $client['email'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPhone">Phone</label>
                                        <input type="text" name="phone" class="form-control" id="inputPhone" disabled
                                               value="<?= $client['phone'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputCompany">Company</label>
                                        <input type="text" name="company" class="form-control" id="inputCompany" disabled
                                               value="<?= $client['company'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress">Address</label>
                                        <textarea name="address" class="form-control" id="inputAddress" disabled
                                                  rows="5"><?= $client['address'] ?></textarea>
                                    </div>

                                    <div class="custom-control custom-checkbox p-0">
                                        <input type="hidden" id="inputActive_" name="status" disabled value="0">
                                        <input disabled <?= $client['status'] ? 'checked' : '' ?> class="custom-control-input" type="checkbox" id="inputActive" name="status" value="1" />
                                        <label class="custom-control-label pl-4" for="inputActive">Is Active</label>
                                    </div>
                                    <div class="mt-4">
                                        <a href="edit.php?id=<?= $client['id'] ?>" class="btn btn-success mr-2">Edit</a>
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

