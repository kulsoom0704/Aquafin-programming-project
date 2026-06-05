
<?php
try {
    $db = new PDO("sqlite:" . __DIR__ . "/aquafin.db");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Eerst alle gebruikers tonen
    $result = $db->query("SELECT * FROM Gebruikers");
    echo "<h2>Bestaande gebruikers:</h2>";
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "ID: " . $row['GebruikersID'] . " - Naam: " . $row['Naam'] . " - Email: " . $row['Email'] . " - Rol: " . $row['Rol'] . "<br>";
    }
    
    // Admin opnieuw aanmaken (of overschrijven)
    $wachtwoord = password_hash("admin123", PASSWORD_DEFAULT);
    
    // Eerst verwijderen we de oude admin als die bestaat
    $db->exec("DELETE FROM Gebruikers WHERE Email = 'admin@aquafin.be'");
    
    // Dan nieuwe admin toevoegen
    $stmt = $db->prepare("INSERT INTO Gebruikers (Naam, Email, Wachtwoord, Rol) VALUES (?, ?, ?, ?)");
    $stmt->execute(['Admin Test', 'admin@aquafin.be', $wachtwoord, 'Admin']);
    
    echo "<br><br> Admin is opnieuw aangemaakt!<br>";
    echo "Email: admin@aquafin.be<br>";
    echo "Wachtwoord: admin123<br>";
    
} catch (PDOException $e) {
    echo "Fout: " . $e->getMessage();
}
?>