<?php
$title = "Add User";
ob_start();
require("partials/_userCreate.php");
$content = ob_get_clean();
require("layout.php");
