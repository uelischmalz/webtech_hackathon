<?php
require_once("data.php");

$roles = listAllRoles($_SESSION['user_id']);

$dateiname = basename($_SERVER['PHP_SELF']);

$datei = substr($dateiname, 0, -4);

$allowed = array_search($datei, $roles);

echo $allowed;

 ?>
