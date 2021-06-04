<?php
$password = "lSHaF";
echo "Passwort:<br>";
echo $password;

echo "<br><br>";

if(strlen($password) <= 4){
  echo "Das Passwort ist 4 Zeichen oder kürzer.<br>";
} else {
  echo "Das Passwort ist mehr als 4 Zeichen lang.<br>";
}

$keineGrossbuchstaben = (strtolower($password) === $password);

if($keineGrossbuchstaben){
  echo "Das Passwort muss mindestens einen Grossbuchstaben enthalten.<br>";
} else {
  echo "Das Passwort enthält mindestens einen Grossbuchstaben.<br>";
}

$keineKleinbuchstaben = (strtoupper($password) === $password);

if($keineKleinbuchstaben){
  echo "Das Passwort muss mindestens einen Kleinbuchstaben enthalten.<br>";
} else {
  echo "Das Passwort enthält mindestens einen Kleinbuchstaben.<br>";
}

$passwordArray = str_split($password);
$enthaeltZahl = false;

foreach ($passwordArray as $char) {
  if(is_numeric($char)){
    $enthaeltZahl = true;
    break;
  };

}

if(!$enthaeltZahl){
  echo "Das Passwort muss mindestens einen Zahl enthalten.<br>";
} else {
  echo "Das Passwort enthält mindestens eine Zahl.<br>";
}




 ?>
