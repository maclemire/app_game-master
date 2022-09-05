<?php
/**
 * This file shows a single game
 */
// session_start();
include("models/database.php");
$game = getGame();
$title = $game['name'];
require("view/showPage.php")
?>

