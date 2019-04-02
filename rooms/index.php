<?php
/**
 * Created by PhpStorm.
 * User: mohamadzaki
 * Date: 23/03/2019
 * Time: 8:22 PM
 */

include_once '../config/database.php';
include_once '../objects/rooms.php';

$database = new Database();
$connection = $database->getConnection();

$Rooms = new Rooms($connection);
$rooms = $Rooms->browse();

$error = false;
$errorMsg = '';
/**
 * GET PARAM
 */
if (isset($_GET) && $_GET) {
    $get = $_GET;
    if ($Rooms->delete($get['del'])) {
        $error = false;
        redirect('index.php', 'Save success');
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
                                <h4 class="card-title">List of room</h4>
                                <?= redirect_flash(); ?>
                                <?= $errorMsg; ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped table-sm">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Type of room</th>
                                            <th>Capacity</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $index = 1; ?>
                                        <?php foreach ($rooms as $room): ?>
                                            <tr>
                                                <td style="width: 10px"><?= $index++ ?></td>
                                                <td><?= $room['name'] ?></td>
                                                <td><?= $room['capacity'] ?></td>
                                                <td style="width: 10px"><i class="fa <?= $room['status'] ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' ?> icon-md"></i> </td>
                                                <td style="width: 150px">
                                                    <a href="view.php?id=<?= $room['id'] ?>"
                                                       class="btn btn-icons btn-primary btn-sm text-white">
                                                        <i class="fa fa-info"></i>
                                                    </a>
                                                    <a href="edit.php?id=<?= $room['id'] ?>"
                                                       class="btn btn-icons btn-warning btn-sm text-white">
                                                        <i class="fa fa-pencil"></i></a>
                                                    <a href="index.php?del=<?= $room['id'] ?>"
                                                       onclick="return confirm('Are you sure?')"
                                                       class="btn btn-icons btn-dark btn-sm text-white">
                                                        <i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
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

