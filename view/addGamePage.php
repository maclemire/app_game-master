<?php
$title = "Add Game";
ob_start();
require("partials/_add.php");
$content = ob_get_clean();
require("layout.php");
