<?php
// require "./config.php";
include_once "./error_handling.php";

class User {

    private $connection;
    private $stmt;
    private $dbHost;
    private $dbUser;
    private $dbPass;
    private $dbName;

    public function __construct($dbUser, $dbPass, $dbName, $dbHost="localhost") {
        try {
            $this->$dbHost = $dbHost;
            $this->$dbUser = $dbUser;
            $this->$dbPass = $dbPass;
            $this->$dbName = $dbName;
            $this->connection = new PDO (
                "mysql:host=". $this->$dbHost . ";dbname=". $this->$dbName,
                $this->$dbUser,
                $this->$dbPass
            );
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    private function prepareExecuteStatement($sql, $params = []) {
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getUser($userId) {

        $sql = "select vorname, nachname, benutzername, passwort_hash, email, klasse from taetigkeitsnachweis where ID=$userId";
        $result;
        //var_dump($sql);
        try {
            $this->stmt = $this->connection->prepare($sql);
            $this->stmt->execute();
            // Get the user data from database with fetch.
            $result = $this->stmt->fetch(PDO::FETCH_ASSOC);
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }

        return $result;
    }
    public function loginUser($email, $password) {

        $sql = "SELECT id, email, password_hash FROM user WHERE email=:email";
        $userData;

        try {
            $this->stmt = $this->connection->prepare($sql);
            $this->stmt->execute([':email' => $email]);
            // Get the user data from database with fetch.
            $userData = $this->stmt->fetch(PDO::FETCH_ASSOC);
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }

        $loggedIn = false;
        if ($userData) {
            $verify = password_verify($password, $userData['password_hash']);
            if ($verify) {
                $loggedIn = true;
            }
        }

        $result = "Passwort ist nicht richtig.";
        if ($loggedIn) {
            $result = $userData;
        }

        return array(
            'success' => $loggedIn,
            'result' => $result
        );
    }
    public function __destruct() {
        $this->connection = null;
        $this->stmt = null;
    }
}

$userDb = new User('chrissy', 'cida0424', 'fi35_schmelzle_fpadw');
//$userDb = new User('tm', 'test123', 'fi35_meyer_fpadw');
echo json_encode($userDb->loginUser($_POST["username"], $_POST["password"]));


die();


// Starte die Sitzung
session_start();
if (!isset($_SESSION['validUser'])) {
    header("Location: home.php");
    $_SESSION["success"] = "Sie sind jetzt angemeldet";
}elseif (isset($_POST['user']) AND isset($_POST['passwort'])) {
    $user = $POST['user'];
    $password_hash = $POST['password_hash'];
} else {
    echo "falscher Benutzername oder Passwort";
    require_once("login.html");
}
session_destroy();
exit;

// Query to retrieve the name of the logged-in user from the database
$sql = "SELECT vorname FROM benutzer WHERE benutzername='$benutzername'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Ergebniszeile abrufen
    $row = $result->fetch_assoc();
    $vorname = $row["vorname"];

    // Create H1 heading with the user's first name
    echo "<h1>Hallo, $vorname!</h1>";
} else {
    echo "Benutzer nicht gefunden.";
}
?>