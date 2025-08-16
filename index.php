<?php
/**
 * Front Controller - Entry point for all requests
 */

require_once 'config/config.php';

// Get the request URI and clean it
$request = $_SERVER['REQUEST_URI'];
$path = parse_url($request, PHP_URL_PATH);

// Remove base URL from path (only from beginning)
if (BASE_URL !== '/' && strpos($path, BASE_URL) === 0) {
    $path = substr($path, strlen(BASE_URL));
}
$path = trim($path, '/');

// Default route
if (empty($path)) {
    $path = 'demo/index';
}

// Parse the route
$segments = explode('/', $path);
$controller = ucfirst($segments[0] ?? 'Home') . 'Controller';
$method = str_replace('-', '_', $segments[1] ?? 'index'); // Convert dashes to underscores
$params = array_slice($segments, 2);

try {
    // Check if controller exists
    if (class_exists($controller)) {
        $controllerInstance = new $controller();
        
        // Check if method exists
        if (method_exists($controllerInstance, $method)) {
            call_user_func_array([$controllerInstance, $method], $params);
        } else {
            // Method not found, try to call index with all segments as params
            if (method_exists($controllerInstance, 'index')) {
                $params = array_slice($segments, 1);
                call_user_func_array([$controllerInstance, 'index'], $params);
            } else {
                throw new Exception("Method '{$method}' not found in controller '{$controller}'");
            }
        }
    } else {
        throw new Exception("Controller '{$controller}' not found");
    }
} catch (Exception $e) {
    // Handle 404 errors
    http_response_code(404);
    require_once 'app/views/errors/404.php';
}
?>