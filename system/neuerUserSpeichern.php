<?php
// data.php laden (für DB-Verbindung)
require_once('data.php');
$firstname ='';
$lastname='';
$email='';
$password='';
$passwordgehasht='';
$role=''; //mit service gehts nicht...
// Kontrollieren, ob alle benötigten Werte im $_POST-Array vorhanden sind
// und Werte in Variablen speichern
if(isset($_POST['firstname'])){
  $firstname = $_POST['firstname'];
}
if(isset($_POST['lastname'])){
  $lastname = $_POST['lastname'];
}
if(isset($_POST['email'])){
  $email = $_POST['email'];
}
if(isset($_POST['password'])){
  $password = $_POST['password'];
  $passwordgehasht = password_hash($password, PASSWORD_BCRYPT);
}

if(isset($_POST['role'])){
  $role = $_POST['role'];
}



$db = dbVerbindungErzeugen(); // in data.php

// SQL-Variable für Prepared Statement (PDO) zum speichern eines neuen Beitrags als String zusammenstellen
// Fragezeichen werden später durch Werte ersetzt
$sql = "INSERT INTO user (firstname, lastname, email, password) VALUES (?,?,?,?);";
//  Prepared Statement mit SQL-Variable vorbereiten und in Variable $stmt speichern
$stmt = $db->prepare($sql);
// Prepared Statement mit array aus Variablenwerten ausführen.
// (Werte müssen als Array übergeben werden und ersetzt Fragezeichen in $sql-Variable)
// Reihenfolge der Variablenwerte muss der Reihenfolge der Fragezeichen in SQL-Variablen entsprechen.
$stmt->execute(array($firstname, $lastname, $email, $passwordgehasht));

// mit lastInsertId() die DB-id des neuen Beitrags ermitteln und ausgeben
echo $db->lastInsertId();



//$dbrolle = dbVerbindungErzeugen();

$user_id = getUserId($email);
echo $user_id;

//$role_name_id = "SELECT role_name_id FROM roles WHERE role_name_id = '$role'";
$role_name_id = $role;
echo $role_name_id;


$sql = "INSERT INTO user_has_roles (user_id, role_name_id) VALUES (?,?);";
//  Prepared Statement mit SQL-Variable vorbereiten und in Variable $stmt speichern
$stmt = $db->prepare($sql);
// Prepared Statement mit array aus Variablenwerten ausführen.
// (Werte müssen als Array übergeben werden und ersetzt Fragezeichen in $sql-Variable)
// Reihenfolge der Variablenwerte muss der Reihenfolge der Fragezeichen in SQL-Variablen entsprechen.
$stmt->execute(array($user_id, $role));

echo $role;


?>
