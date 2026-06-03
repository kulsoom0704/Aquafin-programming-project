<?php
session_start();
include 'db_connect.php';

// Alleen Admin mag hier komen
if (!isset($_SESSION['gebruiker_id']) || $_SESSION['rol'] != 'Admin') {
    header("Location: login.php");
    exit();
}

$succesmelding = "";
$foutmelding = "";

// Als het formulier is verzonden (nieuwe gebruiker toevoegen)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $naam = $_POST['naam'];
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];
    $rol = $_POST['rol'];
    
    // Controleer of alle velden zijn ingevuld
    if (empty($naam) || empty($email) || empty($wachtwoord) || empty($rol)) {
        $foutmelding = "❌ Alle velden zijn verplicht!";
    } else {
        // Check of email al bestaat
        $check = $conn->prepare("SELECT * FROM Gebruikers WHERE Email = ?");
        $check->execute([$email]);
        
        if ($check->fetch()) {
            $foutmelding = "❌ Dit emailadres bestaat al!";
        } else {
            // Hash het wachtwoord
            $gehasht_wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);
            
            // Nieuwe gebruiker toevoegen
            $stmt = $conn->prepare("INSERT INTO Gebruikers (Naam, Email, Wachtwoord, Rol) VALUES (?, ?, ?, ?)");
            if ($stmt->execute([$naam, $email, $gehasht_wachtwoord, $rol])) {
                $succesmelding = "✅ Gebruiker '$naam' is succesvol aangemaakt!";
            } else {
                $foutmelding = "❌ Fout bij het aanmaken van de gebruiker.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - Gebruiker toevoegen</title>
</head>
<body>

    <h2>👑 Admin Panel - Aquafin Portaal</h2>
    <p>Ingelogd als: <strong><?php echo $_SESSION['naam']; ?></strong> (Admin)</p>

    <hr>

    <h3>➕ Nieuwe gebruiker toevoegen</h3>

    <?php if ($succesmelding != ""): ?>
        <p style="color: green;"><?php echo $succesmelding; ?></p>
    <?php endif; ?>

    <?php if ($foutmelding != ""): ?>
        <p style="color: red;"><?php echo $foutmelding; ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label>Naam:</label><br>
        <input type="text" name="naam" required><br><br>

        <label>Emailadres:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Wachtwoord:</label><br>
        <input type="password" name="wachtwoord" required><br><br>

        <label>Rol:</label><br>
        <select name="rol" required>
            <option value="Admin">Admin</option>
            <option value="Technieker">Technieker</option>
            <option value="Magazijnier">Magazijnier</option>
        </select><br><br>

        <button type="submit">Gebruiker toevoegen</button>
    </form>

    <hr>

    <p><a href="logout.php">🚪 Uitloggen</a></p>

</body>
</html>