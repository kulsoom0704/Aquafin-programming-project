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

$succesmelding = "";
$foutmelding = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $naam = $_POST['naam'];
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];
    $wachtwoord_bevestigen = $_POST['wachtwoord_bevestigen'];
    
    // Validatie
    if (empty($naam) || empty($email) || empty($wachtwoord)) {
        $foutmelding = " Alle velden zijn verplicht!";
    } elseif ($wachtwoord != $wachtwoord_bevestigen) {
        $foutmelding = " Wachtwoorden komen niet overeen!";
    } elseif (strlen($wachtwoord) < 4) {
        $foutmelding = " Wachtwoord moet minimaal 4 tekens zijn!";
    } else {
        // Check of email al bestaat
        $check = $db->prepare("SELECT * FROM Gebruikers WHERE Email = ?");
        $check->execute([$email]);
        
        if ($check->fetch()) {
            $foutmelding = " Dit emailadres bestaat al!";
        } else {
            // Nieuwe gebruiker toevoegen (standaard rol = Technieker)
            $gehasht_wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);
            $stmt = $db->prepare("INSERT INTO Gebruikers (Naam, Email, Wachtwoord, Rol) VALUES (?, ?, ?, ?)");
            
            if ($stmt->execute([$naam, $email, $gehasht_wachtwoord, 'Technieker'])) {
                $succesmelding = " Account succesvol aangemaakt! Je kunt nu inloggen.";
                // Optioneel: na 2 seconden doorsturen naar login
                header("refresh:2; url=login.php");
            } else {
                $foutmelding = " Fout bij het aanmaken van account.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Account aanmaken - Aquafin</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #005b96 0%, #003d66 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .register-container {
            background-color: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            width: 450px;
            max-width: 90%;
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, #005b96 0%, #003d66 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .header h1 {
            font-size: 28px;
            margin-bottom: 10px;
        }
        
        .register-body {
            padding: 30px;
        }
        
        .input-group {
            margin-bottom: 20px;
        }
        
        .input-group label {
            display: block;
            font-weight: bold;
            color: #005b96;
            margin-bottom: 8px;
        }
        
        .input-group input {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 14px;
        }
        
        .input-group input:focus {
            outline: none;
            border-color: #005b96;
        }
        
        .btn-register {
            width: 100%;
            background: linear-gradient(135deg, #005b96 0%, #003d66 100%);
            color: white;
            padding: 12px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }
        
        .succes {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .fout {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .login-link {
            text-align: center;
            margin-top: 20px;
        }
        
        .login-link a {
            color: #005b96;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="header">
            <h1> Account aanmaken</h1>
            <p>Word lid van Aquafin</p>
        </div>
        
        <div class="register-body">
            <?php if ($succesmelding != ""): ?>
                <div class="succes"><?php echo $succesmelding; ?></div>
            <?php endif; ?>
            
            <?php if ($foutmelding != ""): ?>
                <div class="fout"><?php echo $foutmelding; ?></div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="input-group">
                    <label> Volledige naam</label>
                    <input type="text" name="naam" placeholder="bv. Jan Janssens" required>
                </div>
                
                <div class="input-group">
                    <label> Emailadres</label>
                    <input type="email" name="email" placeholder="bv. jan@aquafin.be" required>
                </div>
                
                <div class="input-group">
                    <label> Wachtwoord</label>
                    <input type="password" name="wachtwoord" placeholder="minimaal 4 tekens" required>
                </div>
                
                <div class="input-group">
                    <label> Bevestig wachtwoord</label>
                    <input type="password" name="wachtwoord_bevestigen" placeholder="typ hetzelfde wachtwoord" required>
                </div>
                
                <button type="submit" class="btn-register"> Account aanmaken</button>
            </form>
            
            <div class="login-link">
                <a href="login.php">← Terug naar inloggen</a>
            </div>
        </div>
    </div>
</body>
</html>