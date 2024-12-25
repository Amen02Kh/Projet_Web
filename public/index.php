<?php
// Start session
session_start();

// Load configuration and dependencies
require_once '../config/config.php';

// Autoloader for controllers, models, etc.
spl_autoload_register(function ($class) {
    $path = "../app/";
    if (file_exists($path . "controllers/$class.php")) {
        require_once $path . "controllers/$class.php";
    } elseif (file_exists($path . "models/$class.php")) {
        require_once $path . "models/$class.php";
    }
});

// Parse URL for routing
$requestUri = $_SERVER['REQUEST_URI'];
$scriptName = dirname($_SERVER['SCRIPT_NAME']);
$basePath = str_replace($scriptName, '', $requestUri);
$route = trim($basePath, '/');
$routeParts = $route !== '' ? explode('/', $route) : [];
// Extract only the path, ignoring the query string
$path = parse_url($route, PHP_URL_PATH);
$routeParts = $path !== '' ? explode('/', $path) : [];
// Determine controller and action
$controllerName = !empty($routeParts[0]) ? ucfirst($routeParts[0]) . 'Controller' : 'HomeController';
$actionName = !empty($routeParts[1]) ? $routeParts[1] : 'index';


// Route the request
try {
    if (class_exists($controllerName)) {
        $controller = new $controllerName($pdo); // Pass $pdo to the controller
        if (method_exists($controller, $actionName)) {
            $controller->$actionName();
        } else {
            throw new Exception("Action '$actionName' not found in $controllerName.");
        }
    } else {
        throw new Exception("Controller '$controllerName' not found.");
    }
} catch (Exception $e) {
    http_response_code(404);
    echo $e->getMessage();
}
