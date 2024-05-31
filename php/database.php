<?php
require_once "error_handling.php";

$servername = "localhost"; // Hostname der Datenbank
$dbname = "fi35_schmelzle_fpadw"; // Name deiner Datenbank

// Benutzername und Passwort des Benutzers
$user = 'chrissy';
$passwort = 'cida0424';

// Verbindung zur Datenbank herstellen
$conn = new mysqli($username, $password, $dbname);

// Überprüfen, ob die Verbindung erfolgreich war
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

echo "Verbindung zur Datenbank erfolgreich hergestellt";

// SQL-Abfrage, um den Benutzer zu überprüfen
$sql = "SELECT * FROM user WHERE username='$user' AND password_hash='$passwort'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Benutzer gefunden";
} else {
    echo "Benutzer nicht gefunden oder falsches Passwort";
}


class Database {
    
    public function insertData($taetigkeitsnachweis, $anmerkung) {
        // SQL query to insert the data into the main relation
        $sql = "INSERT INTO taetigkeitsnachweis (taetigkeitsnachweis, anmerkung) VALUES ('$taetigkeitsnachweis', '$anmerkung)";

        if ($this->conn->query($sql) === TRUE) {
            return true; // Daten erfolgreich eingefügt
        } else {
            return false; // Fehler beim Einfügen der Daten
        }
    }

    public function updateData($id, $newTaetigkeitsnachweis, $newAnmerkung) {
        // SQL query to update the data in the main relation based on the ID
        $sql = "UPDATE taetigkeitsnachweis SET taetigkeitsnachweis='$newTaetigkeitsnachweis', anmerkung='$newAnmerkung' WHERE id=$id";

        if ($this->conn->query($sql) === TRUE) {
            return true; // Daten erfolgreich aktualisiert
        } else {
            return false; // Fehler beim Aktualisieren der Daten
        }
    }

}

// save
$database = new Database("localhost", "root", "", "deineDatenbank");
if ($database->insertData("Tätigkeitsnachweis 1", "Anmerkung zu Tätigkeitsnachweis 1")) {
    echo "Daten erfolgreich gespeichert";
} else {
    echo "Fehler beim Speichern der Daten";
}

// update taetigkeitsnachweis
$database = new Database("localhost", "root", "", "deineDatenbank");
if ($database->updateData(1, "Neuer Tätigkeitsnachweis")) {
    echo "Daten erfolgreich aktualisiert";
} else {
    echo "Fehler beim Aktualisieren der Daten";
}

$database = new Database("localhost", "root", "", "deineDatenbank");
if ($database->updateData("Neue Anmerkungen")) {
    echo "Daten erfolgreich aktualisiert";
} else {
    echo "Fehler beim Aktualisieren der Daten";
}


/*class DateTime {
    public function getThisWeek() {
        $date = new DateTime('now');
        $date->setTimezone(new DateTimeZone('Europe/Berlin'));

        $thisWeek = clone $date;
        $thisWeek->setISODate($date->format('Y'), $date->format('W'));
        $weekStart = $thisWeek->modify('this week');

        $weekEnd = clone $weekStart;
        $weekEnd->modify('+6 days');

        $previousWeek = clone $weekStart;
        $previousWeek->modify('-1 week');

        $nextWeek = clone $weekStart;
        $nextWeek->modify('+1 week');

        return [
            'start' => $weekStart,
            'end' => $weekEnd,
            'previous' => $previousWeek,
            'next' => $nextWeek,
        ];
    }
}

$myDateTime = new MyDateTime();
$weekInfo = $myDateTime->getThisWeek();
}
*/

?>