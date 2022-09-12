<?php
//2-je fais les failles xss
$name = clear_xss($_POST["name"]);
$email = clear_xss($_POST["email"]);
$password = clear_xss($_POST["password"]);
