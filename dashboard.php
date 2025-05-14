<?php
session_start();

if (!isset($_SESSION['steamid'])) {
    header('Location: index.php');
    exit;
}

$steamID = $_SESSION['steamid'];
?>

<h1>Welcome!</h1>
<p>Your SteamID is: <?= htmlspecialchars($steamID) ?></p>
<p><a href="logout.php">Logout</a></p>
