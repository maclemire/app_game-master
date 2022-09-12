<?php
session_start();
/**
 * This file shows a form to add a user
 */

/**
 */
require_once('controllers/User.php');

$controller = new \Controllers\User();
$controller->create();

