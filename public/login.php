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

$foutmelding = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];
    
    $stmt = $db->prepare("SELECT * FROM Gebruikers WHERE Email = ?");
    $stmt->execute([$email]);
    $gebruiker = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($gebruiker && password_verify($wachtwoord, $gebruiker['Wachtwoord'])) {
        $_SESSION['gebruiker_id'] = $gebruiker['GebruikersID'];
        $_SESSION['naam'] = $gebruiker['Naam'];
        $_SESSION['rol'] = $gebruiker['Rol'];
        
        // Iedereen gaat eerst naar portaal.php
    header("Location: leeg.php");
        exit();
    } else {
        $foutmelding = " Foutief emailadres of wachtwoord.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Aquafin Portaal</title>
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
        
        .login-container {
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
        
        .header p {
            font-size: 14px;
            opacity: 0.9;
        }
        
        .login-body {
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
            transition: border-color 0.3s;
        }
        
        .input-group input:focus {
            outline: none;
            border-color: #005b96;
        }
        
        .btn-login {
            width: 100%;
            background: linear-gradient(135deg, #005b96 0%, #003d66 100%);
            color: white;
            padding: 12px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.2s;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
        }
        
        .foutmelding {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .test-info {
            background-color: #e2f0fa;
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
            text-align: center;
            font-size: 13px;
        }
        
        .test-info strong {
            color: #005b96;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="header">
            <h1> AQUAFIN</h1>
            <p>Portaal voor medewerkers</p>
        </div>
        
        <div class="login-body">
            <?php if ($foutmelding != ""): ?>
                <div class="foutmelding"><?php echo $foutmelding; ?></div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="input-group">
                    <label> Emailadres</label>
                    <input type="email" name="email" placeholder="vul je email in" required>
                </div>
                
                <div class="input-group">
                    <label> Wachtwoord</label>
                    <input type="password" name="wachtwoord" placeholder="vul je wachtwoord in" required>
                </div>
                
                <button type="submit" class="btn-login"> Inloggen</button>
                            
                <div style="text-align: center; margin-top: 20px;">
                    <a href="register.php" style="color: #005b96; text-decoration: none;"> Geen account? Maak hier een account aan</a>
                </div>
            </form>
            
            <div class="test-info">
                <strong> Test Admin</strong><br>
                Email: admin@aquafin.be<br>
                Wachtwoord: admin123
            </div>
        </div>
    </div>
</body>
</html>