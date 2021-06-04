<?php
require_once('data.php');

$db = dbVerbindungErzeugen(); // DB-Verbindung herstellen (s. login())
$sql = "SELECT * FROM user";
$resultat = $db->query($sql);
$resultatUserArray = $resultat->fetchAll();

// Inhalt des Arrays als JSON ausgeben
// echo json_encode($resultatUserArray);





for($i=0; $i<count($resultatUserArray); $i++){

      //  $rollen = rollenVonUser($resultatUserArray[$i]['user_id']);
      //  echo ($rollen);
        $db = dbVerbindungErzeugen();
        $user_id = $resultatUserArray[$i]['user_id'];
        $sql = "SELECT role_name_id FROM user_has_roles WHERE user_id = :userId";
        $stmt = $db->prepare($sql);
        $result = $stmt->execute(array('userId' => $user_id));
        $user = $stmt->fetchAll();
        $roleArray = array();
        foreach($user AS $role){
          foreach($role AS $roleName){
            array_push($roleArray, $roleName);
          }
        }
        $rollen = '';

        foreach($roleArray AS $role){
          $rollen.=$role;
          $rollen.=', ';
        }

        echo "<tr>";
        echo "<td>".$resultatUserArray[$i]['firstname']."</td>";
        echo "<td>".$resultatUserArray[$i]['lastname']."</td>";
        echo "<td>".$resultatUserArray[$i]['email']."</td>";
        echo "<td>".$resultatUserArray[$i]['password']."</td>";
        echo "<td>".$rollen."</td>";
        echo "</tr>";
      }

 ?>
