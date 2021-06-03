<?php
session_start();
//============= CONTROLLER ============
require_once("system/data.php");

if(isset($_GET['nologin'])){
  echo "<h3>Bitte zuerst einloggen!</h3>";
  unset($_GET['nologin']);
}

if(isset($_GET['permission'])){
  echo "<h3>Keine Berechtigung!</h3>";
  unset($_GET['permission']);
}

if(isset($_GET['login'])){
  $loginSchalter = true;
  $error = "";

  if(!empty($_POST['email'])){
    $email = $_POST['email'];
  } else {
    $error .= "Bitte E-Mail Adresse eingeben. <br>";
    $loginSchalter = false;
  }

  if(!empty($_POST['password'])){
    $password = $_POST['password'];
  } else {
    $error .= "Bitte Passwort eingeben. <br>";
    $loginSchalter = false;
  }

  if($loginSchalter){
    $user = login($email, $password);

    if($user){
      $_SESSION['user_id'] = $user['user_id'];
      $_SESSION['firstname'] = $user['firstname'];
      $_SESSION['lastname'] = $user['lastname'];

      $roles = checkRole($user['user_id']);

      if(count($roles) === 1){

        header('Location: ' . $roles[0]['role_name_id'] . '.php');

      } else {
        /* Je nachdem könnte man hier auf eine Seite weiterleiten,
          wo man entscheiden kann, mit welcher Rolle man sich einloggen
          möchte. Aktuell macht er das selbe wie oben */
        header('Location: ' . $roles[0]['role_name_id'] . '.php');
      }


    } else {
      $error .= "Login fehlgeschlagen!";
    }
  }

} else {

}

 ?>

 <!DOCTYPE html>
 <html lang="de" dir="ltr">
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" href="styles.css">
     <title>Login</title>
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

      <h1>Login</h1>

      <div id="loginFormular">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>?login=1" method="post">

          <input class="textfeld" type="email" name="email" placeholder="E-Mail">

          <input class="textfeld" type="password" name="password" placeholder="Passwort">

          <button class="submitButton" type="submit" name="loginSender" value="einloggen">Anmelden</button>

        </form>
        <a href="forgotten.php"><p>Passwort vergessen</p></a>
        <?php
        if(isset($error)){
          echo "<h3>" . $error . "</h3>";
        }

         ?>

      </div>
    </div>

  </body>
</html>
