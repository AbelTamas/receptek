<?php
session_start();

$db_host = 'localhost';
$db_user = 'root';
$db_pass = ''; // Ha az ismerősöd WAMP-ján sincs jelszó, akkor üres string
$db_name = 'receptek_db'; // Itt pontosan ezt a nevet kell látnod!

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Adatbázis csatlakozási hiba: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>