<?php
/**
 * This file shows the HomePage
 */
// session_start()

/**
 * Getting all games from models then stocking them in an array $games
 */
require_once("models/database.php");
$games = getAllGames();
require("view/homePage.php");
?>