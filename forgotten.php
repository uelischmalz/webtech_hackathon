<?php
//============= CONTROLLER ============
require_once("system/data.php");

if(isset($_GET['reset'])){
  $resetSchalter = true;
  $error = "";

  if(!empty($_POST['email'])){
    $email = $_POST['email'];
  } else {
    $error .= "Bitte E-Mail Adresse eingeben. <br>";
    $resetSchalter = false;
  }

  if($resetSchalter){

    $user_id_array = getUserId($_POST['email']);

    if($user_id_array['user_id']){
      $token = addToken($user_id_array['user_id']);

      if($token) {
          $error .= "Token gespeichert. <br>";
      } else {
        $error .= "Passwortzurücksetzung fehlgeschlagen. <br>";
      }








    } else {
      $error .= "Benutzer nicht vorhanden. <br>";
    }


  }
} else {

}

 ?>

<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

    <!DOCTYPE html>
    <html lang="de" dir="ltr">
      <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="styles.css">
        <title>Passwort zurücksetzen</title>
      </head>
      <body>
        <header>
          <a href="index.html"><img src="img/logo_schrift_hell.png" alt="Logo" id="logo"></a>
          <h1>Hackathon Minor Webtech 2021</h1>
        </header>
        <div id="container">
        <nav>
          <a href="benutzer.php">Alle Benutzer</a><br><br><br><br>
          <a href="neuer-benutzer.php">Neuer Benutzer</a>
        </nav>
        <div id="content">

          <h1>Passwort zurücksetzen</h1>

          <div id="resetFormular">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>?reset=1" method="post">

              <input class="textfeld" type="email" name="email" placeholder="E-Mail">

              <button class="submitButton" type="submit" name="resetSender" value="zurücksetzen">Passwort zurücksetzen</button>

            </form>
            <a href="index.php"><p>zurück</p></a>
            <?php
            if(isset($error)){
              echo "<h3>" . $error . "</h3>";
            }

             ?>

          </div>
        </div>

      </body>
    </html>


  </body>
</html>
