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

/**
 * GET PARAM
 */
if (isset($_GET) && $_GET) {
    $get = $_GET;
    $equipment = $Equipments->read($get['id']);
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
                                <h4 class="card-title">Detail Equipment</h4>
                                <form class="forms-sample" method="post">

                                    <div class="form-group">
                                        <label for="inputName">Title</label>
                                        <input disabled type="text" name="name" class="form-control" id="inputName"
                                               value="<?= $equipment['name'] ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="inputDescription">Description</label>
                                        <textarea disabled name="description" class="form-control" id="inputDescription"
                                                  rows="4"><?= $equipment['description'] ?></textarea>
                                    </div>

                                    <div class="custom-control custom-checkbox p-0">
                                        <input <?= $equipment['status'] ? 'checked' : '' ?>
                                                value="<?= $equipment['status'] ?>" type="checkbox" name="status"
                                                class="custom-control-input" id="inputActive">
                                        <label class="custom-control-label pl-4" for="inputActive">Is Active</label>
                                    </div>

                                    <div class="mt-4">
                                        <a href="edit.php?id=<?= $equipment['id'] ?>" class="btn btn-success mr-2">Edit</a>
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

