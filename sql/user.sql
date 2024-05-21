/*der Befehl für die Benutzertabelle*/

CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vorname VARCHAR(50),
    nachname VARCHAR(50),
    benutzername VARCHAR(50),
    passwort_hash VARCHAR(255),
    email VARCHAR(100) UNIQUE,
    klasse VARCHAR(20)
);
 SHA2('password', 256);

 /* INSERT INTO user (vorname, nachname, benutzername, password_hash, email, klasse)  = neuen User anlegen */
 /* für den ersten User: VALUES ('Max', 'Mustermann', 'muster', SHA2('test123', 256), 'maxm@o365.comhard.de', 'US-FI35.1');*/
 /* der 2. VALUES ('Henry', 'Hase', 'hase', SHA2('test123', 256), 'henryh@o365.comhard.de', 'US-FI35.1'); */
 
 