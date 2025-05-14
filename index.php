<?php
session_start();
require_once __DIR__ . '/lib/SteamOpenID.php'; // Adjust if in a different path

use xPaw\Steam\SteamOpenID;

$ReturnToUrl = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

$SteamOpenID = new SteamOpenID($ReturnToUrl);

if ($SteamOpenID->ShouldValidate()) {
    try {
        $CommunityID = $SteamOpenID->Validate();
        $_SESSION['steamid'] = $CommunityID;
        echo '✅ Logged in as SteamID: ' . $CommunityID;
        // You can now proceed to fetch user details or start a session
    } catch (Exception $e) {
        echo '❌ Login failed: ' . $e->getMessage();
    }
} else {
    // Redirect the user to Steam for authentication
    header('Location: ' . $SteamOpenID->GetAuthUrl());
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
<p><a href="<?= $SteamOpenID->GetAuthUrl(); ?>">
        <img src="https://steamcommunity-a.akamaihd.net/public/images/signinthroughsteam/sits_01.png" alt="Login with Steam">
    </a></p>
</body>
</html>
