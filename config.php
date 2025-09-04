<?php
// Database config (Hostinger credentials)
define('DB_HOST', 'localhost');
define('DB_NAME', 'u449955968_jkssb');
define('DB_USER', 'u449955968_jkssb1');
define('DB_PASS', 'Grand@7006');

// Site settings
define('SITE_URL', 'https://yourdomain.com'); // apna domain likhna
define('GA_MEASUREMENT_ID', 'G-XXXXXXXXXX'); // apna GA4 ID

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (Exception $e) {
    die('Database connection failed: ' . $e->getMessage());
}

session_start();
?>
