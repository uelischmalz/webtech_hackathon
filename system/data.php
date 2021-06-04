<?php
// Die Variablen $db_host, $db_name, $db_user, $db_pass, $db_charset sind in config.php zentral gespeichert.
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');

function dbVerbindungErzeugen(){

	/* Die in config.php festgelegten Variablen gelten innerhalb einer Funktion standardmässig NICHT.
	Um sie innerhalb einer Funktion zugänglich zu machen, müssen sie mit dem Schlüsselwort global innerhalb der Funktion gekennzeichnet werden.
	Siehe: https://www.php.net/manual/de/language.variables.scope.php
	*/
	global $db_host, $db_name, $db_user, $db_pass, $db_charset;

	$dsn = "mysql:host=$db_host;dbname=$db_name;charset=$db_charset"; // siehe https://en.wikipedia.org/wiki/Data_source_name
	$options = [
		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES   => false
	];

	// Einfache Version der DB-Verbindung
	//$db = new PDO($dsn, $user, $pass, $options);

	// Ausführliche Version der DB-Verbindung
	try {
		$db = new PDO($dsn, $db_user, $db_pass, $options);
	} catch (\PDOException $e) {
		throw new \PDOException($e->getMessage(), (int)$e->getCode());
	}

	// Wir geben die in der Variablen $db gespeicherte Datenbankverbindung
	//   als Ergebnis der Funktion zurück.
	return $db;
}

function login($email, $password){
  $pdo = dbVerbindungErzeugen();

  $sql = "SELECT * FROM user WHERE email = :email";

  $stmt = $pdo->prepare($sql);

  $result = $stmt->execute(array('email' => $email));

  $user = $stmt->fetch();

  $passwordCheck = password_verify($password, $user['password']);

  if($user !== false && $passwordCheck === true){
    return $user;
  } else {
    return false;
  }
}

function checkRole($user_id){
  $pdo = dbVerbindungErzeugen();

  $sql = "SELECT role_name_id FROM user_has_roles WHERE user_id = :userId";

  $stmt = $pdo->prepare($sql);

  $result = $stmt->execute(array('userId' => $user_id));

  $user = $stmt->fetchAll();

  if($user !== false){
    return $user;
  } else {
    return false;
  }
}

function checkPermission($user_id){
  $pdo = dbVerbindungErzeugen();

  $sql = "SELECT role_name_id FROM user_has_roles WHERE user_id = :userId";

  $stmt = $pdo->prepare($sql);

  $result = $stmt->execute(array('userId' => $user_id));

  $user = $stmt->fetchAll();

  $roleArray = array();

  foreach($user AS $role){
    foreach($role AS $roleName){
      array_push($roleArray, $roleName);
    }
  }

  $filename = basename($_SERVER['PHP_SELF']);


  $file = substr($filename, 0, -4);

	$zusaetzlicheAdminSeite1 = "benutzer";
	$zusaetzlicheAdminSeite2 = "neuer-benutzer";

	if(array_search("admin", $roleArray) !== false){
		array_push($roleArray, $zusaetzlicheAdminSeite1);
		array_push($roleArray, $zusaetzlicheAdminSeite2);
	}

  $allowed = array_search($file, $roleArray);

  if($allowed === false){
    return false;
  } else {
    return $roleArray;
  }
}

function getUserId($email){
  $pdo = dbVerbindungErzeugen();

  $sql = "SELECT user_id FROM user WHERE email = :email";

  $stmt = $pdo->prepare($sql);

  $result = $stmt->execute(array('email' => $email));

  $userID = $stmt->fetch();

  if($userID !== false){
    return $userID['user_id'];
  } else {
    return false;
  }
}

function addToken($user_id){

  $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
  $var_size = strlen($chars);
  $token = "";

    for( $x = 0; $x < 32; $x++ ) {
        $random_str= $chars[ rand( 0, $var_size - 1 ) ];
        $token .= $random_str;
    }

    $db = dbVerbindungErzeugen();
  	$sql = "INSERT INTO token (user_id, token) VALUES (?, ?);";
  	$stmt = $db->prepare($sql);
  	$resultat = $stmt->execute(array($user_id, $token));
    if($resultat){
      return $token;
    } else {
      return false;
    }
  }

	function resetPassword($user_id, $token, $password){
		//Token abgleichen
		$passwordHash = password_hash($password, PASSWORD_BCRYPT);

		$dbToken = dbVerbindungErzeugen();
		$sqlToken = "SELECT `time` FROM token WHERE user_id = :userId AND token = :token";
		$stmtToken = $dbToken->prepare($sqlToken);

  	$tokenTime = $stmtToken->execute(array('userId' => $user_id, 'token' => $token));
		$tokenTime = $stmtToken->fetch();

		if(strtotime($tokenTime['time']) > (time() - 3600) ) {

				$db = dbVerbindungErzeugen();
				$sql = "UPDATE user SET password = ? WHERE user_id = ?;";
				$stmt = $db->prepare($sql);
				$resultat = $stmt->execute(array($passwordHash, $user_id));

				if($resultat){
					return true;
				} else {
					return false;
				}

			return true;
		} else {
			return false;
		}

}



?>
