<?php
session_start();

if(!isset($_SESSION['user_id'])){
  header('Location: index.php?nologin=1');
}
 ?>
<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login erfolgreich</title>
  </head>
  <body>
    <h1>Login erfolgreich</h1>

    <h3>Kontoinformationen:</h3>

    <p><b>Vorname:</b><?php echo $_SESSION['firstname']; ?></p>
    <p><b>Nachname:</b><?php echo $_SESSION['lastname']; ?></p>
    <p><b>ID:</b><?php echo $_SESSION['user_id']; ?></p>

    <a href="logout.php"><p>Logout</p></a>
  </body>
</html>
