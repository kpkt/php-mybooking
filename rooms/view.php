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

/**
 * GET PARAM
 */
if (isset($_GET) && $_GET) {
    $get = $_GET;
    $room = $Rooms->read($get['id']);
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
                                <h4 class="card-title">Detail Room</h4>
                                <form class="forms-sample" method="post">

                                    <div class="form-group">
                                        <label for="inputName">Title</label>
                                        <input disabled type="text" name="name" class="form-control" id="inputName"
                                               value="<?= $room['name'] ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="inputDescription">Description</label>
                                        <textarea disabled name="description" class="form-control" id="inputDescription"
                                                  rows="10"><?= $room['description'] ?></textarea>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-2">
                                            <label for="inputCapacity">Capacity</label>
                                            <input disabled type="number" name="capacity" class="form-control"
                                                   id="inputCapacity"
                                                   value="<?= $room['capacity'] ?>">
                                        </div>
                                    </div>
                                    <div class="custom-control custom-checkbox p-0">
                                        <input <?= $room['status'] ? 'checked' : '' ?>
                                                value="<?= $room['status'] ?>" type="checkbox" name="status"
                                                class="custom-control-input" id="inputActive">
                                        <label class="custom-control-label pl-4" for="inputActive">Is Active</label>
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

