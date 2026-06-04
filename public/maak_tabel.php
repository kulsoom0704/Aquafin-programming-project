<?php
// maak_tabel.php - Dit bestand gebruik je 1 keer om de tabel aan te maken
include 'db_connect.php';

$sql = "CREATE TABLE IF NOT EXISTS Gebruikers (
    GebruikersID INT PRIMARY KEY AUTO_INCREMENT,
    Naam VARCHAR(100) NOT NULL,
    Email VARCHAR(255) UNIQUE NOT NULL,
    Wachtwoord VARCHAR(255) NOT NULL,
    Rol ENUM('Admin','Technieker','Magazijnier') NOT NULL,
    Actief BOOLEAN DEFAULT TRUE
)";

if (mysqli_query($conn, $sql)) {
    echo "✅ Tabel 'Gebruikers' is succesvol aangemaakt!";
    
    // Maak meteen een test Admin account aan
    $test_naam = "Admin Test";
    $test_email = "admin@aquafin.be";
    $test_wachtwoord = password_hash("admin123", PASSWORD_DEFAULT);
    $test_rol = "Admin";
    
    $check = mysqli_query($conn, "SELECT * FROM Gebruikers WHERE Email='$test_email'");
    if (mysqli_num_rows($check) == 0) {
        $insert = "INSERT INTO Gebruikers (Naam, Email, Wachtwoord, Rol) 
                   VALUES ('$test_naam', '$test_email', '$test_wachtwoord', '$test_rol')";
        if (mysqli_query($conn, $insert)) {
            echo "<br>✅ Test Admin account aangemaakt!<br>";
            echo "📧 Email: admin@aquafin.be<br>";
            echo "🔑 Wachtwoord: admin123";
        }
    }
} else {
    echo " Fout bij aanmaken tabel: " . mysqli_error($conn);
}

mysqli_close($conn);
?>