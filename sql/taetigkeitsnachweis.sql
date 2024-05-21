CREATE TABLE taetigkeitsnachweis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    benutzername VARCHAR(50),
    datum DATE,
    taetigkeiten TEXT,
    probleme_herausforderungen TEXT,
    loesungen_vorschlaege TEXT,
    stundenanzahl DECIMAL(5,2)
);