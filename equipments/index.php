<?php
/**
 * Created by PhpStorm.
 * User: mohamadzaki
 * Date: 23/03/2019
 * Time: 8:22 PM
 */

include_once '../config/database.php';
include_once '../objects/equipments.php';

$database = new Database();
$connection = $database->getConnection();

$Equipments = new Equipments($connection);
$equipments = $Equipments->browse();

$error = false;
$errorMsg = '';
/**
 * GET PARAM
 */
if (isset($_GET) && $_GET) {
    $get = $_GET;
    if ($Equipments->delete($get['del'])) {
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
                                <h4 class="card-title">List of equipment</h4>
                                <?= redirect_flash(); ?>
                                <?= $errorMsg; ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped table-sm">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Type of equipment</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $index = 1; ?>
                                        <?php foreach ($equipments as $equipment): ?>
                                            <tr>
                                                <td style="width: 10px"><?= $index++ ?></td>
                                                <td><?= $equipment['name'] ?></td>
                                                <td style="width: 10px"><i class="fa <?= $equipment['status'] ? 'fa-check-circle text-success' : 'fa-times-circle text-danger' ?> icon-md"></i> </td>
                                                <td style="width: 150px">
                                                    <a href="view.php?id=<?= $equipment['id'] ?>"
                                                       class="btn btn-icons btn-primary btn-sm text-white">
                                                        <i class="fa fa-info"></i>
                                                    </a>
                                                    <a href="edit.php?id=<?= $equipment['id'] ?>"
                                                       class="btn btn-icons btn-warning btn-sm text-white">
                                                        <i class="fa fa-pencil"></i></a>
                                                    <a href="index.php?del=<?= $equipment['id'] ?>"
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

