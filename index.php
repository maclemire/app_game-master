<?php
/**
 * This file shows the HomePage
 */
session_start();

/**
 * Getting all games from models then stocking them in an array $games
 */
require_once("models/Game.php");
$model = new Game();
$games =  $model->getAllGames();
require("view/homePage.php");
?>