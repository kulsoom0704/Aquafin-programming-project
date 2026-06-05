<?php
// db_connect.php - SQLite database verbinding voor Aquafin portaal

// SQLite database bestand (wordt automatisch aangemaakt)
$database_bestand = __DIR__ . '/aquafin.db';

try {
    // Verbinding maken met SQLite database
    $conn = new PDO("sqlite:$database_bestand");
    
    // Zet foutmeldingen aan
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Tabel Gebruikers aanmaken als die nog niet bestaat
    $sql = "CREATE TABLE IF NOT EXISTS Gebruikers (
        GebruikersID INTEGER PRIMARY KEY AUTOINCREMENT,
        Naam TEXT NOT NULL,
        Email TEXT UNIQUE NOT NULL,
        Wachtwoord TEXT NOT NULL,
        Rol TEXT CHECK(Rol IN ('Admin','Technieker','Magazijnier')) NOT NULL,
        Actief INTEGER DEFAULT 1
    )";
    
    $conn->exec($sql);
    
    // Test Admin account aanmaken als die nog niet bestaat
    $check = $conn->prepare("SELECT * FROM Gebruikers WHERE Email = ?");
    $check->execute(['admin@aquafin.be']);
    
    if ($check->fetch() == false) {
        $test_wachtwoord = password_hash("admin123", PASSWORD_DEFAULT);
        $insert = $conn->prepare("INSERT INTO Gebruikers (Naam, Email, Wachtwoord, Rol) VALUES (?, ?, ?, ?)");
        $insert->execute(['Admin Test', 'admin@aquafin.be', $test_wachtwoord, 'Admin']);
        echo " Test Admin account aangemaakt!<br>";
        echo " Email: admin@aquafin.be<br>";
        echo " Wachtwoord: admin123<br>";
    }
    
} catch (PDOException $e) {
    die(" Database fout: " . $e->getMessage());
}
?>