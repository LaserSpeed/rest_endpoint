<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once "../config/Database.php";
include_once "../controller/UserController.php";

$database = new Database();
$db = $database->connect();

$user = new UserController($db);
if($_SERVER['REQUEST_METHOD'] === "GET" && $_SERVER['REQUEST_URI'] === "/php_rest_endpoint/routes/users") {
    include "operations/all_user.php";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && preg_match('/^\/php_rest_endpoint\/routes\/users\?id=([0-9]+)/', $_SERVER['REQUEST_URI'], $matches)) {
    $user->id = $matches[1];
    $result = $user->getSingleUser();
    $num_of_user = $result->rowCount();
    if($num_of_user == 0) {
        echo json_encode(
            array("Message" => "No user found")
        );
    }
    else {
        $user = array(
            "id" => $user->id,
            "name" => $user->name,
            "email" => $user->email
        );

        echo json_encode($user);
    }
}