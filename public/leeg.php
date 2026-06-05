<?php
$sessie_map = __DIR__ . '/sessies';
if (!is_dir($sessie_map)) {
    mkdir($sessie_map, 0777, true);
}
session_save_path($sessie_map);
session_start();

// Als niet ingelogd, terug naar login
if (!isset($_SESSION['gebruiker_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Welkom</title>
</head>
<body>
    <p>Ingelogd als: <?php echo $_SESSION['naam']; ?> (<?php echo $_SESSION['rol']; ?>)</p>
    <a href="logout.php">Uitloggen</a>
</body>
</html>