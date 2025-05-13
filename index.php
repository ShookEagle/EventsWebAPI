<?php
declare(strict_types=1);

require_once __DIR__ . '/lib/SteamOpenID.php'; // Adjust the path if using Composer

use xPaw\Steam\SteamOpenID;

// Define the return URL for Steam to redirect back to
$ReturnToUrl = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];

$SteamOpenID = new SteamOpenID($ReturnToUrl);

if ($SteamOpenID->ShouldValidate()) {
    try {
        $CommunityID = $SteamOpenID->Validate();
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
