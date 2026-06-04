<?php
$sessie_map = __DIR__ . '/sessies';
if (!is_dir($sessie_map)) {
    mkdir($sessie_map, 0777, true);
}
session_save_path($sessie_map);
session_start();

// Alleen Technieker mag hier komen
if (!isset($_SESSION['gebruiker_id']) || $_SESSION['rol'] != 'Technieker') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Technieker Panel - Aquafin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>🔧 Technieker Panel</h2>
    <p>Welkom <strong><?php echo $_SESSION['naam']; ?></strong></p>
    <hr>
    <p>Hier komen later de interventies, plannen en rapporten.</p>
    <br>
    <a href="logout.php" class="btn" style="background-color: #dc3545;"> Uitloggen</a>
</div>
</body>
</html>