
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