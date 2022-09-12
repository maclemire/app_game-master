<?php
session_start();
// start session


require_once('controllers/User.php');

$controller = new \Controllers\User();
$controller->update();
