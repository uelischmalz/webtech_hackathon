<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles.css">
    <title>Admin</title>
  </head>
  <body>
    <header>
      <a href="index.php"><img src="img/logo_schrift_hell.png" alt="Logo" id="logo"></a>
      <h1>Hackathon Minor Webtech 2021</h1>
    </header>
    <div id="container">

      <nav>
        <?php require_once('blocks/navigation.php'); ?>
      </nav>
    <div id="content">
      <h1>Passwort zurücksetzen (E-Mail)</h1>

      <p>Hallo! Mit dem folgenden Link kannst du dein Passwort zurücksetzen:</p>


      <a href="reset.php?token=<?php echo $_GET['token'];?>&userid=<?php echo $_GET['userid'];?>"><p>Passwort zurücksetzen</p></a>

    </div>
  </body>
</html>
