<?php
 session_start();
/**
 * This file shows a form to add a game
 */

/**
 */
require_once("models/database.php");

$error = [];
$errorMessage = "<span class=text-red-500>*Ce champs est obligatoire</span>";

if (!empty($_POST["submited"])) {
    require_once("utils/form-security/include.php");
    if (count($error) == 0){
        create($name, $price, $note, $description, $genre_clear, $plateforms_clear, $PEGI, $url_img);  
    }
} 

require("view/createPage.php");
?>


