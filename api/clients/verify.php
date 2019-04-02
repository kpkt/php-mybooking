<?php
include_once '../config/database.php';
include_once '../objects/clients.php';
$database = new Database();
$connection = $database->getConnection();

$Client = new Clients($connection);
/*
 * design the content to be in JSON format
 */
header('Access-Control-Allow-Headers: Content-Type');

/*
 * Access-Control-Allow-Origin for allow request from diffrent domain
 * Exp:
 *      "Access-Control-Allow-Origin: *"
 *      "Access-Control-Allow-Origin: http://www.example.org/"
 */
header("Access-Control-Allow-Origin: *");

/*
 * Access-Control-Allow-Methods for allow request method such as GET, POST, OPTIONS
 */
header('Access-Control-Allow-Methods: POST');

/**
 * Get POST Value from Post
 */
$postdata = file_get_contents("php://input");
$request = json_decode($postdata, true);


$Client->name = $request['name'];
$Client->email = $request['email'];
$Client->company = $request['company'];
$Client->phone = $request['phone'];
$Client->address = $request['address'];
$Client->status = 1;

$status = $Client->add();

if (is_array($status)) {
    $dataTrue = array(
        'status' => 'berjaya',
        'data' => array('name' => $Client->name, 'email' => $Client->email, 'phone' => $Client->phone, 'address' => $Client->address, 'status' => $Client->status)
    );
    return $dataTrue;
} else {
    $dataFalse = array(
        'status' => 'gagal',
        'mesej' => 'data empty',
        'data' => []
    );
    return $dataFalse;
}