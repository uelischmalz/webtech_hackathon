<?php
session_start();
require_once("system/data.php");

if(!isset($_SESSION['user_id'])){
  header('Location: index.php?nologin=1');
}

if(!(checkPermission($_SESSION['user_id']))){
  header('Location: index.php?permission=0');
}

?>
<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Serviceboy</title>
  </head>
  <body>
    <h1>Küchenbereich</h1>
  </body>
</html>
