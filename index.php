<?php
session_start();
require_once __DIR__ . '/lib/SteamOpenID.php'; // Adjust if in a different path

use xPaw\Steam\SteamOpenID;

$openid = new SteamOpenID('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);

try {
    // If Steam has redirected back and we should validate
    if ($openid->ShouldValidate()) {
        $steamID64 = $openid->Validate(); // This will throw an exception if it fails
        $_SESSION['steamid'] = $steamID64;
        header('Location: dashboard.php');
        exit;
    }
} catch (Exception $e) {
    echo '❌ Steam login failed: ' . $e->getMessage();
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CS2 Events - Login</title>
</head>
<body>
<h1>Welcome to the CS2 Events Panel</h1>
<p><a href="<?= $openid->GetAuthUrl(); ?>">
        <img src="https://steamcommunity-a.akamaihd.net/public/images/signinthroughsteam/sits_01.png" alt="Login with Steam">
    </a></p>
</body>
</html>
