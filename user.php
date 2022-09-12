<?php

/**
 * This file shows the userPage
 */
session_start();

/**
 * Getting all users from models then stocking them in an array $users
 */
require_once('controllers/User.php');

$controller = new \Controllers\User();
$controller->index();
