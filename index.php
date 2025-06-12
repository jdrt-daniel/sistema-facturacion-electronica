
<?php
require_once __DIR__ . '/vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Define base path
define('BASE_PATH', __DIR__);

// Start session
session_start();

// Initialize Router
require_once BASE_PATH . '/app/core/Router.php';
require_once BASE_PATH . '/app/core/Controller.php';
require_once BASE_PATH . '/app/core/Database.php';

// Initialize Router
$router = new Router();

// Cargar las rutas desde routes/web.php
require_once BASE_PATH . '/routes/web.php';

// Run the application
$router->dispatch();
