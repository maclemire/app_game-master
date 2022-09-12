<?php
/**
 * This file shows a single user
 */
session_start();
require_once('controllers/User.php');

$controller = new \Controllers\User();
$controller->show();

