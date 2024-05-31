<?php
class weektime{

    public function week ($startDatum, $endDatum, $kalenderwoche) {
        global $conn;

        // SQL-Query zum Einfügen der Daten in die Tabelle worktime
        $sql = "INSERT INTO worktime (StartDatum, EndDatum, Kalenderwoche) VALUES ('$startDatum', '$endDatum', '$kalenderwoche')";
        if ($conn->query($sql) === TRUE) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $startDatum = $_POST['startDatum'];
                $endDatum = $_POST['endDatum'];;
        } else {
            echo "Fehler beim Einfügen der Daten: " . $conn->error;
        }
    }

    public function hours ($taeglAZ, $gesamtAZ){
        // Berechne Gesamtzeit für einen bestimmten Eintrag
        $taeglAZ = 8.5; // Beispiel für tägliche Arbeitszeit
        $gesamtAZ = $taeglAZ * 5;

        // Füge Gesamtzeit in die Tabelle ein
        $sql = "UPDATE worktime SET totalHours = $gesamtAZ WHERE ID = Eintrag_ID";
        $conn->query($sql);
    }
    public function time ($arbeitsbeginn, $arbeitsende) {

    }
        // Überprüfen, ob das Formular abgeschickt wurde
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $arbeitsbeginn = $_POST['arbeitsbeginn'];
        $arbeitsende = $_POST['arbeitsende'];

    } else {
        echo "Fehler beim Einfügen der Arbeitszeit: " . $conn->error;
    }

}
?>