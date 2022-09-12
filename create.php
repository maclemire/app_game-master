<?php
session_start();
/**
 * This file shows a form to add a game
 */
require_once('controllers/Game.php');

$controller = new \Controllers\Game();
$controller->create();


