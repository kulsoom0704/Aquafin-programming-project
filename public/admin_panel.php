<?php 
$sessie_map = __DIR__ . '/sessies';
if (!is_dir($sessie_map)) {
    mkdir($sessie_map, 0777, true);
}
session_save_path($sessie_map);
session_start();

// Database verbinding
try {
    $db = new PDO("sqlite:" . __DIR__ . "/aquafin.db");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database fout: " . $e->getMessage());
}

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
        $foutmelding = "Alle velden zijn verplicht!";
    } else {
        // Check of email al bestaat
        $check = $db->prepare("SELECT * FROM Gebruikers WHERE Email = ?");
        $check->execute([$email]);
        
        if ($check->fetch()) {
            $foutmelding = "Dit emailadres bestaat al!";
        } else {
            // Hash het wachtwoord
            $gehasht_wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);
            
            // Nieuwe gebruiker toevoegen
            $stmt = $db->prepare("INSERT INTO Gebruikers (Naam, Email, Wachtwoord, Rol) VALUES (?, ?, ?, ?)");
            if ($stmt->execute([$naam, $email, $gehasht_wachtwoord, $rol])) {
                $succesmelding = "Gebruiker '$naam' is succesvol aangemaakt!";
            } else {
                $foutmelding = "Fout bij het aanmaken van de gebruiker.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - Gebruiker toevoegen</title>
    <link rel="stylesheet" href="style.css">
</head>
<>

    <h2> Admin Panel - Aquafin Portaal</h2>
    <p>Ingelogd als: <strong><?php echo $_SESSION['naam']; ?></strong> (Admin)</p>

    <hr>

    <h3> Nieuwe gebruiker toevoegen</h3>

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

    <p><a href="logout.php"> Uitloggen</a></p>

<body>
<div class="container">

    <h2> Admin Panel - Aquafin Portaal</h2>
    
    <div class="info">
        Ingelogd als: <strong><?php echo $_SESSION['naam']; ?></strong> (Admin)
    </div>

    <hr>

    <h3> Nieuwe gebruiker toevoegen</h3>

    <?php if ($succesmelding != ""): ?>
        <div class="succes"><?php echo $succesmelding; ?></div>
    <?php endif; ?>

    <?php if ($foutmelding != ""): ?>
        <div class="fout"><?php echo $foutmelding; ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <label>Naam:</label>
        <input type="text" name="naam" required>

        <label>Emailadres:</label>
        <input type="email" name="email" required>

        <label>Wachtwoord:</label>
        <input type="password" name="wachtwoord" required>

        <label>Rol:</label>
        <select name="rol" required>
            <option value="Admin">Admin</option>
            <option value="Technieker">Technieker</option>
            <option value="Magazijnier">Magazijnier</option>
        </select>

        <button type="submit">Gebruiker toevoegen</button>
    </form>

    <div class="logout">
        <a href="logout.php"> Uitloggen</a>
    </div>

</div>
</body>
</html>