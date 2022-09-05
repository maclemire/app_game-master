<?php
/**
 * This file shows the addGame Page
 */
// session_start()

/**
 */
require_once("models/database.php");
require("view/addGamePage.php");

$error = [];
$errorMessage = "<span class=text-red-500>*Ce champs est obligatoire</span>";

if (!empty($_POST["submited"]) && isset($_FILES["url_img"]) && $_FILES["url_img"]["error"] == 0) {
    create($error);
} ?>




