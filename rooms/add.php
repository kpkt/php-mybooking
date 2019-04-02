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

$error = false;
$errorMsg = '';

/**
 * FORM SUBMIT
 * Rooms::add()
 */
if (isset($_POST) && $_POST) {

    $post = $_POST;

    //Assign value Rooms properties (members variables)
    $Rooms->name = $post['name'];
    $Rooms->description = $post['description'];
    $Rooms->capacity = $post['capacity'];
    $Rooms->status = $post['status'];

    if ($Rooms->add()) {
        $error = false;
        redirect('index.php','Save success');
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
                                <h4 class="card-title">New Room</h4>
                                <form class="forms-sample" method="post">
                                    <div class="form-group">
                                        <label for="inputName">Title</label>
                                        <input type="text" name="name" class="form-control" id="inputName"
                                               placeholder="Title">
                                    </div>

                                    <div class="form-group">
                                        <label for="inputDescription">Description</label>
                                        <textarea name="description" class="form-control" id="inputDescription"
                                                  rows="5"></textarea>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-2">
                                            <label for="inputCapacity">Capacity</label>
                                            <input type="number" name="capacity" class="form-control" id="inputCapacity"
                                                   placeholder="Capacity people">
                                        </div>
                                    </div>

                                    <div class="custom-control custom-checkbox p-0">
                                        <input type="hidden" name="status" value="0">
                                        <input type="checkbox" name="status" value="1" class="custom-control-input" id="inputActive">
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

