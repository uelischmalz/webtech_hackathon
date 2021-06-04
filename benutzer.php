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
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles.css">
    <title>Alle Benutzer</title>
  </head>
  <body>
    <header>
      <a href="index.html"><img src="img/logo_schrift_hell.png" alt="Logo" id="logo"></a>
      <h1>Hackathon Minor Webtech 2021</h1>
    </header>
    <div id="container">
    <nav>
      <?php require_once('blocks/navigation.php'); ?>
    </nav>
    <div id="content">
      <h1>Alle Benutzer</h1>
      <p>Hier werden alle Benutzer aus der Datenbank dargestellt.</p>
      <br>

      <table style="width:100%">
        <tr>
          <th>Vorname</th>
          <th>Nachname</th>
          <th>E-Mail</th>
          <th>Passwort</th>
          <th>Rolle(n)</th>
        </tr>
        <?php
        require_once('system/holeAlleUser.php')
        ?>
      </table>



  <!--  <script type="text/javascript" src="script/script.js"></script> -->

    </div>
    </div>
  </body>
</html>
