<?php
if(isset($_SESSION['user_id'])){
  //Dynamische Navigationspunkte
  $roles = checkPermission($_SESSION['user_id']);
  //echo var_dump($roles);
  if($roles){
    foreach($roles AS $role){
      $roleName = "";
      if($role === "admin"){
        $roleName = "Admin";
      } elseif ($role === "laeufer"){
        $roleName = "Läufer";
      } elseif ($role === "service"){
        $roleName = "Service";
      } elseif ($role === "kueche"){
        $roleName = "Küche";
      } elseif ($role === "benutzer"){
        $roleName = "Benutzer";
      } elseif ($role === "neuer-benutzer"){
        $roleName = "Neuer Benutzer";
      }
      echo '<a href="' . $role . '.php">' . $roleName . '</a>';
      echo "<br><br><br><br>";
    }

    echo '<a href="logout.php">Logout</a>';

  } else {
    echo "";
  }
} else {
  echo "";
}

?>
