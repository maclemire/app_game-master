<?php
/**
 * This file shows a single game
 */
session_start();
require_once('controllers/Game.php');

$controller = new \Controllers\Game();
$controller->show();
?>

