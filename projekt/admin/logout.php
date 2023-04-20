<?php
session_start();

// Törli a session változóit
session_unset();

// Törli a session cookie-t
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Törli a session-t
session_destroy();

// Átirányítás a bejelentkezési oldalra
header("Location: http://$_SERVER[SERVER_NAME]/projekt/"); 
exit;
?>
