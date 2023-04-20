<?php
// Adatbázis kapcsolat beállítása
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rovidito";

$conn = new mysqli($servername, $username, $password, $dbname);

// Ellenőrizze az adatbázis kapcsolatot
if ($conn->connect_error) {
    die("Sikertelen kapcsolat az adatbázissal: " . $conn->connect_error);
}

// Az adatbázis táblájának létrehozása, ha nem létezik
$sql1 = "CREATE TABLE IF NOT EXISTS links (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    url VARCHAR(255) NOT NULL,
    code VARCHAR(20) NOT NULL,
    created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
)";

$sql2 = "CREATE TABLE IF NOT EXISTS users (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
)";

$sql3 = "INSERT IGNORE INTO users (username, password) VALUES ('admin', 'jelszo')";

if ($conn->query($sql1) === FALSE || $conn->query($sql2) === FALSE || $conn->query($sql3) == FALSE) {
    echo "Hiba az adatbázis táblájának létrehozásakor: " . $conn->error;
}
?>