<?php
session_start();
// start session

require_once('controllers/Game.php');

$controller = new \Controllers\Game();
$controller->update();


