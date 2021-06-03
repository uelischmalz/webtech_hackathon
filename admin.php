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
    <link rel="stylesheet" href="styles.css">
    <title>Admin</title>
  </head>
  <body>
    <header>
      <a href="index.html"><img src="img/logo_schrift_hell.png" alt="Logo" id="logo"></a>
      <h1>Hackathon Minor Webtech 2021</h1>
    </header>
    <div id="container">
      <nav>
        <a href="admin.php">Admin</a><br><br><br><br>
        <a href="service.php">Service</a><br><br><br><br>
        <a href="laeufer.php">Läufer</a><br><br><br><br>
        <a href="kueche.php">Küche</a><br><br><br><br>
        <a href="logout.php">Logout</a>
      </nav>
    <div id="content">
      <h1>Admin-Bereich</h1>

    </div>
  </body>
</html>
