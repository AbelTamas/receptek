<?php
$conn = new mysqli('localhost', 'root', '');
if ($conn->connect_error) {
    die("Hiba a csatlakozáskor: " . $conn->connect_error);
}

$sql = "
CREATE DATABASE IF NOT EXISTS receptek_db CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci;
USE receptek_db;

CREATE TABLE IF NOT EXISTS felhasznalok (
    id INT AUTO_INCREMENT PRIMARY KEY,
    felhasznalonev VARCHAR(50) NOT NULL UNIQUE,
    jelszo VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO felhasznalok (felhasznalonev, jelszo)
VALUES ('admin', '\$2y\$10\$44.H4gM/7e8PBRN3rlyh4010B.6G4S5Nl2hH.LgYpEaN/M4R1A542')
ON DUPLICATE KEY UPDATE jelszo = VALUES(jelszo);

CREATE TABLE IF NOT EXISTS receptek (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nev VARCHAR(100) NOT NULL,
    hozzavalok TEXT NOT NULL,
    leiras TEXT NOT NULL,
    kategoria VARCHAR(50) DEFAULT 'Egyéb',
    letrehozva TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
";

if ($conn->multi_query($sql)) {
    echo "<h1 style='color: green;'>Siker! Az adatbázis és a táblák létrejöttek!</h1>";
    echo "<p><a href='login.php'>Kattints ide a HűtőMágnes megnyitásához!</a></p>";
} else {
    echo "Hiba: " . $conn->error;
}
?>