<?php
require_once "./config.php";

$userDb = new User();

class User {

    private $connection;
    private $dbhost = 'localhost';
    private $stmt;

    public function __construct($dbname="taetigkeitsnachweis") {
        global $dbUser, $dbPass;
        try {
            $this->connection = new PDO(
                "mysql:host=$this->dbhost;dbname=$dbname;",
                $dbUser,
                $dbPass
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

        $sql = "SELECT * FROM taetigkeitsnachweis WHERE email='$email'";
        $userData;

        try {
            $this->stmt = $this->connection->prepare($sql);
            $this->stmt->execute(['email' => $email]);
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

// Starte die Sitzung
session_start();
if (!isset($_SESSION['validUser'])) {
    require_once(" login.html"); 
} elseif (isset($_POST['user'] AND isset($_POST['passwort']) {
    // überprüfe Passwort
    // Wenn passwort stimmt,
    // setze $_SESSION['validUser'] = $_POST['user']
    // gib das Formular für die
    // Arbeitszeiterfassung aus
} else {
    // gib das Formular für die
    // Arbeitszeiterfassung aus
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