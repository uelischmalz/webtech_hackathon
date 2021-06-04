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
    <title>Neuer Benutzer</title>
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
      <h1>Neuer Benutzer</h1>
      <form class="formular-neuer-user" action="benutzer.php" method="post">
        <label for="firstname">Vorname:</label><br>
        <input type="text" id="firstname" name="firstname"><br>
        <label for="lastname">Nachname:</label><br>
        <input type="text" id="lastname" name="lastname"><br>
        <label for="email">E-Mail:</label><br>
        <input type="text" id="email" name="email"><br>
        <label for="role">Rolle:</label><br>
        <div class="checkbox-div">
          <input type="checkbox" id="admin" name="admin"><label for="admin">Admin</label>  <br><br>
          <input type="checkbox" id="service" name="service"><label for="service">Service</label> <br><br>
          <input type="checkbox" id="laeufer" name="laeufer"><label for="laeufer">Läufer</label> <br><br>
          <input type="checkbox" id="kueche" name="kueche"><label for="kueche">Küche</label> <br><br>
        </div>
        <label for="password">Passwort:</label><br>
        <input type="text" id="password" name="password"><br><br>
        <input type="submit" value="Speichern" id="userSpeichern">
      </form>
    </div>
    </div>
    <script type="text/javascript" src="script/script.js"></script>
  </body>
</html>
