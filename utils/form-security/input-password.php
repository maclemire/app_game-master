<?php
// password
if (!empty($password)) {
    if (strlen($password) <= 2) {
        $error["password"] = "<span class=text-red-500>*3 Caractères minimum</span>";
    } elseif (strlen($password) > 100) {
        $error["password"] = "<span class=text-red-500>*100 Caractères maximum</span>";
    }
} else {
    $error["password"] = $errorMessage;
}
