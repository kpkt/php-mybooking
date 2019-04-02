<?php

function url($path)
{
    $url = 'http://localhost/meeting_room';
    //$url = 'http://10.213.53.116/meeting_room';
    return $url .'/'. $path;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Meeting Room Booking System</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= url('assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css'); ?>">
    <link rel="stylesheet" href="<?= url('assets/vendors/iconfonts/font-awesome/css/font-awesome.css'); ?>">
    <link rel="stylesheet" href="<?= url('assets/vendors/bootstrap/css/bootstrap.css'); ?>">
    <link rel="stylesheet" href="<?= url('assets/vendors/select2/select2.min.css'); ?>">
    <link rel="stylesheet" href="<?= url('assets/vendors/css/vendor.bundle.base.css'); ?>">
    <link rel="stylesheet" href="<?= url('assets/vendors/css/vendor.bundle.addons.css'); ?>">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= url('assets/css/style.css'); ?>">
    <!-- endinject -->
    <link rel="stylesheet" href="<?= url('assets/images/favicon.png'); ?>">
</head>

<body>