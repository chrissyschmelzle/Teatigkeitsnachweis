
'use strict'

        const user_form = document.querySelector('.user-form')
        const page_wrapper = document.querySelector('#page-wrapper')
        const login_button = document.querySelector('#login')
        const logout_button = document.querySelector('#logout')


        login_button.addEventListener('click', (ev) => {
            ev.preventDefault()
            toggleBoxes()
            /* fetch() ... */
        })
        logout_button.addEventListener('click', (ev) => {
            ev.preventDefault()
            toggleBoxes()
            /* fetch() ... */
        })
        
        function toggleBoxes() {
            user_form.classList.toggle('box-invisible')
            page_wrapper.classList.toggle('box-invisible')
        }


document.addEventListener("DOMContentLoaded", function() {
    var button = document.getElementById("button");
    if (button) {
        button.addEventListener("click", function(e) {
            e.preventDefault();
            var formData = new FormData(document.getElementById('dataForm')); // Formulardaten holen

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'php/database.php', true); // POST-Anfrage an insert.php senden

            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    alert('Daten erfolgreich in die Datenbank eingefügt!');
                } 
            };
            xhr.send(formData); // Formulardaten senden
        });
    }

    var btn = document.getElementById("myBtn");
    var modal = document.getElementById("modal");
    var span = document.getElementsByClassName("close")[0];

    btn.addEventListener = function() {
        modal.style.display = "block";
    }

    span.addEventListener = function() {
        modal.style.display = "none";
    }

    function openLoginPopup() {
        document.getElementById("loginPopup").style.display = "block";
    }

    function closeLoginPopup() {
        document.getElementById("loginPopup").style.display = "none";
    }

    function logout() {
        // Hier kannst du den Logout-Prozess implementieren, z.B. Session löschen oder Cookie entfernen
        document.getElementById("loggedInMessage").style.display = "none";
    }

    function updateDateTime() {
        var now = new Date();

        var day = now.getDate().toString().padStart(2, '0');
        var month = (now.getMonth() + 1).toString().padStart(2, '0');
        var year = now.getFullYear();

        var hours = now.getHours().toString().padStart(2, '0');
        var minutes = now.getMinutes().toString().padStart(2, '0');

        var dateStr = "Datum: " + day + "." + month + "." + year;
        var timeStr = "Zeit: " + hours + ":" + minutes;

        document.getElementById("datetime").innerHTML = dateStr + "<br>" + timeStr;
    }

    setInterval(updateDateTime, 1000);
});