<?php
/**
 * Created by PhpStorm.
 * User: mohamadzaki
 * Date: 23/03/2019
 * Time: 8:22 PM
 */

include_once '../config/database.php';
include_once '../objects/bookings.php';
include_once '../objects/rooms.php';
include_once '../objects/equipments.php';
include_once '../objects/clients.php';

$database = new Database();
$connection = $database->getConnection();

$Booking = new Bookings($connection);
$booking = $Booking->browse();

$Rooms = new Rooms($connection);
$rooms = $Rooms->findList();

$Equipments = new Equipments($connection);
$equipments = $Equipments->findList();

$Clients = new Clients($connection);
$clients = $Clients->findList();


$error = false;
$errorMsg = '';

/**
 * FORM SUBMIT
 * Bookings::add()
 */
if (isset($_POST) && $_POST) {

    $post = $_POST;

    //Assign value Bookings properties (members variables)
    $Booking->client_id = $post['client_id'];
    $Booking->attendees = $post['attendees'];
    $Booking->room_id = $post['room_id'];
    $Booking->date_start = $post['date_start'];
    $Booking->date_end = $post['date_end'];
    $Booking->notes = $post['notes'];
    $Booking->equipment = $post['equipment'];
    $Booking->status = $post['status'];

    if ($Booking->add()) {
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
                                    <div class="flex-grow-1"><h3 class="card-title">New Booking</h3></div>
                                </div>
                                <?= redirect_flash(); ?>
                                <?= $errorMsg; ?>
                                <form class="forms-sample" method="post">
                                    <div class="form-group">
                                        <label for="inputCategory">Clients List</label>
                                        <select class="custom-select d-block w-100 basic-single" id="inputCategory"
                                                name="client_id">
                                            <option>Choose...</option>
                                            <?php foreach ($clients as $client): ?>
                                                <option value="<?= $client['id'] ?>"><?= $client['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputRoom">Rooms List</label>
                                        <select class="custom-select d-block w-100 basic-single" id="inputRoom"
                                                name="room_id">
                                            <option>Choose...</option>
                                            <?php foreach ($rooms as $room): ?>
                                                <option value="<?= $room['id'] ?>"><?= $room['name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-2">
                                            <label for="inputAttendees">Attendees</label>
                                            <input type="number" class="form-control" id="inputAttendees" name="attendees"
                                                   placeholder="Attendees number">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-2">
                                            <label for="inputDateStart">Date Start</label>
                                            <input type="text" class="form-control" id="inputDateStart" name="date_start"
                                                   placeholder="dd-mm-yyyy">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="inputDateEnd">Date End</label>
                                            <input type="text" class="form-control" id="inputDateEnd" name="date_end"
                                                   placeholder="dd-mm-yyyy">
                                        </div>
                                    </div>

                                    <label>Equipments</label>

                                    <?php foreach ($equipments as $equipment): ?>
                                        <div class="custom-control custom-checkbox p-0">
                                            <!--<input type="hidden" name="equipment_<?/*= $equipment['id'] */?>" value="0">-->
                                            <input type="checkbox" name="equipment[]"
                                                   value="<?= $equipment['id'] ?>" class="custom-control-input"
                                                   id="input_<?= $equipment['id'] ?>">
                                            <label class="custom-control-label pl-4"
                                                   for="input_<?= $equipment['id'] ?>"><?= $equipment['name'] ?></label>
                                        </div>
                                    <?php endforeach; ?>

                                    <div class="form-group mt-2">
                                        <label for="inputNotes">Notes</label>
                                        <textarea class="form-control" id="inputNotes" name="notes" rows="5"></textarea>
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

