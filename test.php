<?php
// Start the session
session_start();

// Get the session lifetime
$sessionLifetime = ini_get('session.gc_maxlifetime');

// Display the session lifetime
echo "Session Lifetime: $sessionLifetime seconds";
?>
