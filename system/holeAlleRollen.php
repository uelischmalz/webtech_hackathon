<?php
require_once('data.php');

$db = dbVerbindungErzeugen(); // DB-Verbindung herstellen (s. login())
$sql = "SELECT role_name_id FROM roles";
$resultat = $db->query($sql);
$resultatRoleArray = $resultat->fetchAll();

// Inhalt des Arrays als JSON ausgeben
// echo json_encode($resultatRoleArray);


for($i=0; $i<count($resultatRoleArray); $i++){

      //  $rollen = rollenVonUser($resultatUserArray[$i]['user_id']);
      //  echo ($rollen);
        $db = dbVerbindungErzeugen();
        $rollen_id = $resultatRoleArray[$i]['role_name_id'];

        echo '<input type="checkbox" id='.$rollen_id.' name=" '.$rollen_id.'"><label for="'.$rollen_id.'">'.$rollen_id.'</label>  <br><br>';

      //  <input type="checkbox" id="admin" name="admin"><label for="admin">Admin</label>  <br><br>


      }


 ?>
