
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
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

// Aktualisiere das Datum und die Zeit alle Sekunde
setInterval(updateDateTime, 1000);