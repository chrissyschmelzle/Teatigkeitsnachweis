
'use strict'

        const user_form = document.querySelector('.user-form')
        const page_wrapper = document.querySelector('#page-wrapper')
        const login_button = document.querySelector('#login')
        const logout_button = document.querySelector('#logout')


        login_button.addEventListener('click', (ev) => {
            ev.preventDefault()
            console.log(ev.target.id);
            toggleBoxes()
            const form_data = new FormData(user_form);
                fetch('https://fi35.mshome.net/taetigkeitsnachweis/php/users.php', {
                    method: 'POST',
                    /*headers: {
                        'Content-Type': 'application/json',
                    },*/
                    body: form_data 
                })
                .then(response => {
                    if (response.ok) {
                        // Erfolgreiche Antwort verarbeiten (z. B. JSON-Daten parsen)
                        return response.json();
                    } else {
                        // Fehlerantwort verarbeiten (z. B. Fehlermeldung anzeigen)
                        throw new Error(`Fehler beim Abrufen der Daten: ${response.status} ${response.statusText}`);
                    }
                })
                .then(data => {
                    console.log('Antwortdaten:', data);
                })
                .catch(error => {
                    // Fehler behandeln (z. B. Netzwerkfehler)
                    console.error('Fetch-Fehler:', error.message);
                });
    })
    logout_button.addEventListener('click', (ev) => {
         ev.preventDefault()
        toggleBoxes()
            fetch('https://fi35.mshome.net/taetigkeitsnachweis/php/logout.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    // Add any other headers you need (e.g., authorization token)
                },
                // Optional: Include a request body if data needs to be sent
                // body: JSON.stringify({ key1: 'value1', key2: 'value2' }),
            })
            .then(response => {
                if (response.ok) {
                    // Handle successful response (e.g., redirect to login page)
                    window.location.href = 'login.html'; // Replace with your desired URL
                } else {
                    // Handle error response (e.g., show an error message)
                    console.error('Error logging out:', response.status, response.statusText);
                }
            })
            .catch(error => {
                // Handle any exceptions (e.g., network errors)
                console.error('Fetch error:', error.message);
            });
        })
        
        function toggleBoxes() {
            user_form.classList.toggle('box-invisible')
            page_wrapper.classList.toggle('box-invisible')
        }

    


    const speichernButton = document.getElementById('speichern');
    const bearbeitenButton = document.getElementById('bearbeiten');

    // Event-Handler für den Speichern-Button
speichernButton.addEventListener('click', async function() {
    const selectedDatum = datumSelect.value;
    const selectedStunden = stundenSelect.value;
    const taetigkeiten = taetigkeitenTextarea.value;

    // Validierung (z. B. prüfen, ob das Datum gültig ist)

    try {
        // Sende die Daten an den Server (ersetze die URL mit der tatsächlichen API-URL)
        const response = await fetch('/api/saveData', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ datum: selectedDatum, stunden: selectedStunden, taetigkeiten })
        });

        if (response.ok) {
            // Erfolgsmeldung anzeigen
            console.log('Daten erfolgreich gespeichert.');
        } else {
            // Fehlermeldung anzeigen
            console.error('Fehler beim Speichern der Daten.');
        }
    } catch (error) {
        console.error('Fehler beim Kommunizieren mit dem Server:', error);
    }
});

const startDatumInput = document.getElementById('startDatum');
        const endDatumInput = document.getElementById('endDatum');
        const calenderWeekSelect = document.getElementById('calenderWeek');

        // Event-Handler für Änderungen der Datumsfelder
        startDatumInput.addEventListener('change', updateCalenderWeek);
        endDatumInput.addEventListener('change', updateCalenderWeek);

        // Funktion zur Berechnung der Kalenderwoche
        function updateCalenderWeek() {
            const startDate = new Date(startDatumInput.value);
            const endDate = new Date(endDatumInput.value);

            // Berechne die Kalenderwoche für das Startdatum
            const startCalenderWeek = getCalenderWeek(startDate);
            // Berechne die Kalenderwoche für das Enddatum
            const endCalenderWeek = getCalenderWeek(endDate);

            // Fülle das Dropdown-Menü mit den Kalenderwochen
            calenderWeekSelect.innerHTML = '';
            for (let week = startCalenderWeek; week <= endCalenderWeek; week++) {
                const option = document.createElement('option');
                option.value = week;
                option.textContent = `KW ${week}`;
                calenderWeekSelect.appendChild(option);
            }
        }

        // Funktion zur Berechnung der Kalenderwoche
        function getCalenderWeek(date) {
            
        }

        const now = new Date();
        const fridayDeadline = new Date(now);
        fridayDeadline.setHours(15, 30, 0, 0); // Setzen Sie die Uhrzeit auf Freitag um 15:30 Uhr

        if (now < fridayDeadline) {
            // Benutzer können ihre Eingaben bearbeiten
            console.log("Bearbeitung erlaubt!");
        } else {
            // Bearbeitungszeit abgelaufen
            console.log("Bearbeitungszeit abgelaufen!");
        }
    // Setzen Sie den Endzeitpunkt (Freitag um 15:30 Uhr)
    const endzeitpunkt = new Date('2024-06-01T15:30:00');

    function aktualisiereCountdown() {
        const jetzt = new Date();
        const differenz = endzeitpunkt - jetzt;

        const tage = Math.floor(differenz / (1000 * 60 * 60 * 24));
        const stunden = Math.floor((differenz % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minuten = Math.floor((differenz % (1000 * 60 * 60)) / (1000 * 60));
        const sekunden = Math.floor((differenz % (1000 * 60)) / 1000);

        document.getElementById('countdown').innerHTML = `Noch ${tage} Tage, ${stunden} Stunden, ${minuten} Minuten und ${sekunden} Sekunden.`;
    }

    // Aktualisieren alle Sekunde
    setInterval(aktualisiereCountdown, 1000);