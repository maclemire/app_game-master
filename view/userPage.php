<?php
$title = "Users";
ob_start();
require("partials/_user.php");
$content = ob_get_clean();
require("layout.php");
