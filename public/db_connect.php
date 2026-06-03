<?php
// db_connect.php - Database verbinding voor Aquafin portaal

$servername = "localhost";
$gebruikersnaam = "root";
$wachtwoord = "root123";
$database_naam = "aquafin";

// Verbinding maken
$conn = mysqli_connect($servername, $gebruikersnaam, $wachtwoord, $database_naam);

// Controleren of verbinding gelukt is
if (!$conn) {
    die("Verbinding mislukt: " . mysqli_connect_error());
}

// Zorg dat Nederlands goed wordt weergegeven
mysqli_set_charset($conn, "utf8");
?>