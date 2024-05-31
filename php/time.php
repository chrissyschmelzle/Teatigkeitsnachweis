<?php
$servername = "localhost";
$username = "chrissy";
$password = "cida0424";
$dbname = "taetigkeitsnachweis";


// Überprüfe die Verbindung
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}
class weektime {

    public function week($startDatum, $endDatum, $kalenderwoche) {
        global $conn; // Stellen Sie sicher, dass $conn global verfügbar ist

        // Verwenden Sie vorbereitete Anweisungen, um SQL-Injection zu vermeiden
        $stmt = $conn->prepare("INSERT INTO worktime (StartDatum, EndDatum, Kalenderwoche) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $startDatum, $endDatum, $kalenderwoche);

        if ($stmt->execute()) {
            echo "Neuer Datensatz erfolgreich eingefügt.";
        } else {
            echo "Fehler beim Einfügen der Daten: " . $stmt->error;
        }
    }

    public function hours($taeglAZ, $gesamtAZ) {
        // Berechnung der Gesamtzeit für einen bestimmten Eintrag
        $taeglAZ = 8.5; // Beispiel für tägliche Arbeitszeit
        $gesamtAZ = $taeglAZ * 5;

        // Fügen Sie die Gesamtzeit in die Tabelle ein (ersetzen Sie Eintrag_ID durch die tatsächliche ID)
        $sql = "UPDATE worktime SET totalHours = $gesamtAZ WHERE ID = Eintrag_ID";
        $conn->query($sql);
    }

    public function time($arbeitsbeginn, $arbeitsende) {
        // Überprüfen, ob das Formular abgeschickt wurde
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $arbeitsbeginn = $_POST['arbeitsbeginn'];
            $arbeitsende = $_POST['arbeitsende'];
        } else {
            echo "Fehler beim Einfügen der Arbeitszeit: Formular nicht abgeschickt.";
        }
    }
}
function stundenAuswahl($ausgewaehlteStunden) {
    try {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $ausgewaehlteStunden = $_POST["stunden"];
    
            // Verbindung zur Datenbank herstellen (PDO verwenden)
            // ...
    
            // SQL-Abfrage erstellen
            $sql = "INSERT INTO worktime (hours) VALUES (:hours)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':hours', $ausgewaehlteStunden, PDO::PARAM_INT);
            $stmt->execute();
    
            echo "Arbeitsstunden erfolgreich gespeichert!";
        }
    } catch (PDOException $e) {
        echo "Fehler bei der Verbindung zur Datenbank: " . $e->getMessage();
    }
}
?>