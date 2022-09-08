<?php
/**
 * This file shows a single game
 */
session_start();
require_once("models/Game.php");
$model = new Game();
$game = $model->getGame();
$title = $game['name'];
require("view/showPage.php")
?>

