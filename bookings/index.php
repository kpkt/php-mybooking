<?php
/**
 * Created by PhpStorm.
 * User: mohamadzaki
 * Date: 23/03/2019
 * Time: 8:22 PM
 */

include_once '../config/database.php';
include_once '../objects/bookings.php';

$database = new Database();
$connection = $database->getConnection();

$Bookings = new Bookings($connection);
$bookings = $Bookings->browse();



$error = false;
$errorMsg = '';
/**
 * GET PARAM
 */
if (isset($_GET) && $_GET) {
    $get = $_GET;
    if ($Clients->delete($get['del'])) {
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
                                <div class="cardheader d-flex">
                                    <div class="flex-grow-1"><h3 class="card-title">List of Booking</h3></div>
                                    <div class="p-0">
                                        <a href="<?= url('bookings/add.php') ?>" class="btn btn-primary btn-sm">New Booking</a>
                                    </div>
                                </div>
                                <?= redirect_flash(); ?>
                                <?= $errorMsg; ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped table-sm">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Client Name</th>
                                            <th>Email</th>
                                            <th>Room</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $index = 1;?>
                                        <?php foreach ($bookings as $booking): ?>
                                            <tr>
                                                <td style="width: 10px"><?= $index++ ?></td>
                                                <td><?= $booking['ClientName'] ?></td>
                                                <td><?= $booking['ClientEmail'] ?></td>
                                                <td><?= $booking['RoomName'] ?></td>
                                                <td><?= date('d-m-Y', strtotime($booking['date_start'])) ?></td>
                                                <td><?= date('d-m-Y', strtotime($booking['date_end'])) ?></td>
                                                <td style="width: 10px"><i class="fa <?= $booking['status'] ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' ?> icon-md"></i> </td>
                                                <td style="width: 150px">
                                                    <a href="view.php?id=<?= $booking['id'] ?>"
                                                       class="btn btn-icons btn-primary btn-sm text-white">
                                                        <i class="fa fa-info"></i>
                                                    </a>
                                                    <a href="edit.php?id=<?= $booking['id'] ?>"
                                                       class="btn btn-icons btn-warning btn-sm text-white">
                                                        <i class="fa fa-pencil"></i></a>
                                                    <a href="index.php?del=<?= $booking['id'] ?>"
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

