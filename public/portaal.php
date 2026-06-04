<?php
session_save_path(__DIR__ . '/sessies');
if (!is_dir(__DIR__ . '/sessies')) {
    mkdir(__DIR__ . '/sessies', 0777, true);
}
session_start();

// Als gebruiker niet is ingelogd, doorsturen naar login
if (!isset($_SESSION['gebruiker_id'])) {
    header("Location: login.php");
    exit();
}

$rol = $_SESSION['rol'];
$naam = $_SESSION['naam'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Portaal - Aquafin</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .werkruimtes {
            display: flex;
            gap: 20px;
            margin-top: 30px;
            flex-wrap: wrap;
            justify-content: center;
        }
        .card {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 25px;
            text-align: center;
            flex: 1;
            min-width: 200px;
            border: 1px solid #ddd;
        }
        .card h3 {
            color: #005b96;
            margin-bottom: 15px;
        }
        .card p {
            margin-bottom: 20px;
            color: #555;
        }
        .btn {
            display: inline-block;
            background-color: #005b96;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: #003d66;
        }
        .welkom {
            text-align: center;
            margin-bottom: 20px;
        }
        .logout-btn {
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>
<body>
<div class="container">

    <div class="welkom">
        <h2> PORTAL AQUAFIN</h2>
        <p>Welkom <strong><?php echo $naam; ?></strong> | Kies je werkruimte</p>
    </div>

    <div class="werkruimtes">
        
        <?php if ($rol == 'Admin'): ?>
        <div class="card">
            <h3> ADMIN</h3>
            <p>Beheer gebruikers, toegang en rapporten.</p>
            <a href="admin_panel.php" class="btn">Ga naar Admin</a>
        </div>
        <?php endif; ?>

        <div class="card">
            <h3> TECHNIEKER</h3>
            <p>Bekijk interventies, plannen en technische rapporten.</p>
            <a href="#" class="btn">Bekijk interventies</a>
        </div>

        <div class="card">
            <h3> MAGAZIJNIER</h3>
            <p>Voorraadbeheer, bestellingen van onderdelen en inventaris.</p>
            <a href="#" class="btn">Beheer voorraad</a>
        </div>

    </div>

    <div class="logout-btn">
        <a href="logout.php" class="btn" style="background-color: #dc3545;"> Uitloggen</a>
    </div>

</div>
</body>
</html>