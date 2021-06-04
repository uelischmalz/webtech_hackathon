<?php
//============= CONTROLLER ============
require_once("system/data.php");
$token;
$userId;

if(!isset($_GET['token']) && !isset($_GET['userid'])){
  header('Location: index.php');
} else {
  $token = $_GET['token'];
  $userId = $_GET['userid'];

  if(isset($_GET['reset'])){
    $resetSchalter = true;
    $error = "";

    if(!empty($_POST['password'])){
      $password = $_POST['password'];
    } else {
      $error .= "Bitte beide Felder ausfüllen. <br>";
      $resetSchalter = false;
    }

    if(strlen($password) <= 4){
      $error .= "Das Passwort muss mindestens 5 Zeichen lang sein. <br>";
      $resetSchalter = false;;
    }

    $keineGrossbuchstaben = (strtolower($password) === $password);

    if($keineGrossbuchstaben){
      $error .= "Das Passwort muss mindestens einen Grossbuchstaben enthalten. <br>";
      $resetSchalter = false;
    }

    $keineKleinbuchstaben = (strtoupper($password) === $password);

    if($keineKleinbuchstaben){
      $error .= "Das Passwort muss mindestens einen Kleinbuchstaben enthalten. <br>";
      $resetSchalter = false;
    }


    if(!empty($_POST['passwordRepeat'])){
      $passwordRepeat = $_POST['passwordRepeat'];
    } else {
      $error .= "Bitte beide Felder ausfüllen. <br>";
      $resetSchalterr = false;
    }

    if($password !== $passwordRepeat){
      $error .= "Passwörter stimmen nicht überein. <br>";
      $resetSchalter = false;
    }

    if($resetSchalter){
      $resultat = resetPassword($userId, $token, $password);

      if($resultat){
        $error .= "Passwort erfolgreich geändert. <br>";
      } else {
        $error .= "Passwort ändern fehlgeschlagen. <br>";
      }
    }
  }
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
      <a href="index.php"><img src="img/logo_schrift_hell.png" alt="Logo" id="logo"></a>
      <h1>Hackathon Minor Webtech 2021</h1>
    </header>
    <div id="container">

      <nav>
        <?php require_once('blocks/navigation.php'); ?>
      </nav>
      <div id="content">

        <h1>Passwort zurücksetzen</h1>

        <div id="resetFormular">
          <form action="<?php echo $_SERVER['PHP_SELF'] ?>?reset=1&token=<?php echo $_GET['token'];?>&userid=<?php echo $_GET['userid'];?>" method="post">

            <input class="textfeld" type="password" name="password" placeholder="Neues Passwort">

            <input class="textfeld" type="password" name="passwordRepeat" placeholder="Neues Passwort wiederholen">

            <button class="submitButton" type="submit" name="resetSender" value="zurücksetzen">Passwort ändern</button>

          </form>
          <a href="index.php"><p>zurück</p></a>
          <?php
          if(isset($error)){
            echo "<h3>" . $error . "</h3>";
          }

           ?>

        </div>
  </body>
</html>
