<?php
session_start();
include 'db_connect.php';

$foutmelding = "";

// Als het formulier is verzonden
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];
    
    // Zoek gebruiker met dit emailadres
    $stmt = $conn->prepare("SELECT * FROM Gebruikers WHERE Email = ?");
    $stmt->execute([$email]);
    $gebruiker = $stmt->fetch();
    
    if ($gebruiker && password_verify($wachtwoord, $gebruiker['Wachtwoord'])) {
        // Inloggen succesvol
        $_SESSION['gebruiker_id'] = $gebruiker['GebruikersID'];
        $_SESSION['naam'] = $gebruiker['Naam'];
        $_SESSION['rol'] = $gebruiker['Rol'];
        
        // Doorsturen naar juiste pagina op basis van rol
        if ($gebruiker['Rol'] == 'Admin') {
            header("Location: admin_panel.php");
        } elseif ($gebruiker['Rol'] == 'Technieker') {
            header("Location: technieker_panel.php");
        } elseif ($gebruiker['Rol'] == 'Magazijnier') {
            header("Location: magazijnier_panel.php");
        }
        exit();
    } else {
        $foutmelding = "❌ Foutief emailadres of wachtwoord.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Aquafin Portaal</title>
</head>
<body>

    <h2>🔐 Login - Aquafin Portaal</h2>

    <?php if ($foutmelding != ""): ?>
        <p style="color: red;"><?php echo $foutmelding; ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label>Emailadres:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Wachtwoord:</label><br>
        <input type="password" name="wachtwoord" required><br><br>

        <button type="submit">Inloggen</button>
    </form>

    <br>
    <p><strong>Test Admin:</strong><br>
    Email: admin@aquafin.be<br>
    Wachtwoord: admin123</p>

</body>
</html>