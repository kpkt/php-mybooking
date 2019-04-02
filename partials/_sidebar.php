<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <div class="nav-link">
                <div class="user-wrapper">
                    <div class="profile-image">
                        <img src="<?= url('assets/images/faces/face1.jpg'); ?>" alt="profile image">
                    </div>
                    <div class="text-wrapper">
                        <p class="profile-name">Richard V.Welsh</p>
                        <div>
                            <small class="designation text-muted">Manager</small>
                            <span class="status-indicator online"></span>
                        </div>
                    </div>
                </div>
                <a href="<?= url('bookings/new.php') ?>" class="btn btn-success btn-block">New Booking
                    <i class="mdi mdi-plus"></i>
                </a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= url('index.php') ?>">
                <i class="menu-icon fa fa-dashboard"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ul-booking" aria-expanded="false" aria-controls="ul-booking">
                <i class="menu-icon fa fa-address-book"></i>
                <span class="menu-title">Bookings</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ul-booking">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url('bookings/index.php') ?>">Booking list</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url('bookings/add.php') ?>">New Booking</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ul-room" aria-expanded="false" aria-controls="ul-room">
                <i class="menu-icon fa fa-building"></i>
                <span class="menu-title">Rooms</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ul-room">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url('rooms/index.php') ?>">Room list</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url('rooms/add.php') ?>">New Rooms</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ul-equipment" aria-expanded="false" aria-controls="ul-equipment">
                <i class="menu-icon fa fa-suitcase"></i>
                <span class="menu-title">Equipments</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ul-equipment">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url('equipments/index.php') ?>">Equipment list</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url('equipments/add.php') ?>">New Equipment</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ul-client" aria-expanded="false" aria-controls="ul-client">
                <i class="menu-icon fa fa-users"></i>
                <span class="menu-title">Clients</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ul-client">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url('clients/index.php') ?>">Client list</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url('clients/add.php') ?>">New Client</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</nav>