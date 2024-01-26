<?php
include_once("App/config.php");
include_once("App/Router.php");
include_once("App/Models/User.php");
include_once("App/Models/Reservation.php");
include_once("App/Models/Table.php");
require_once(__DIR__ . "/App/config.php");
require_once(__DIR__ . "/App/Router.php");
require_once(__DIR__ . "/vendor/autoload.php");

if (!isset($_SESSION)) {
    session_start();
}

$userModel = new User();
$adminUser = $userModel->getByUsername('admin');

if (!$adminUser) {
    $adminUserData = array(
        "username" => "admin",
        "name" => "UserAdmin",
        "mail" => "admin@example.com",
        "pass" => "1234",
        "admin" => true,
        "avisLegalDades" => true,
        "avisEnviamentPropaganda" => false,
        "profile_image" => "admin",
        "verified" => true
    );

    $userModel->create($adminUserData);
}
include_once("App/Core/Controller.php");

$r = new Router();
$r->run();
