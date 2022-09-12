<?php
ob_start();
require("partials/_UserUpdate.php");
$content = ob_get_clean();
require("layout.php");
