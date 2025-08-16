<?php
/**
 * Main Configuration File
 */

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Define base URL
define('BASE_URL', rtrim(dirname($_SERVER['SCRIPT_NAME']), '/') . '/');
define('SITE_URL', 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . BASE_URL);

// Define paths
define('ROOT_PATH', dirname(__DIR__) . '/');
define('APP_PATH', ROOT_PATH . 'app/');
define('PUBLIC_PATH', ROOT_PATH . 'public/');
define('CONFIG_PATH', ROOT_PATH . 'config/');

// Site settings
define('SITE_NAME', 'YEIII - Plataforma de Comercios');
define('SITE_DESCRIPTION', 'Sistema digital Freemium que conecta usuarios con comercios locales');

// Email settings
define('SMTP_HOST', 'localhost');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', '');
define('SMTP_PASSWORD', '');
define('FROM_EMAIL', 'noreply@yeiii.com');
define('FROM_NAME', 'YEIII Platform');

// Google Maps API Key
define('GOOGLE_MAPS_API_KEY', 'your_google_maps_api_key_here');

// Timezone
date_default_timezone_set('America/Mexico_City');

// Error reporting (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database configuration
require_once CONFIG_PATH . 'database.php';

// Autoloader for classes
spl_autoload_register(function ($class) {
    $directories = [
        APP_PATH . 'controllers/',
        APP_PATH . 'models/',
        APP_PATH . 'core/',
    ];
    
    foreach ($directories as $directory) {
        $file = $directory . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});
?>