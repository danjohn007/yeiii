<?php
/**
 * Base Controller Class
 */

class Controller {
    protected $db;
    
    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }
    
    /**
     * Load a view file
     */
    protected function view($view, $data = []) {
        // Extract data to variables
        extract($data);
        
        // Check if view file exists
        $viewFile = APP_PATH . 'views/' . $view . '.php';
        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            throw new Exception("View file '{$view}' not found");
        }
    }
    
    /**
     * Load a model
     */
    protected function model($model) {
        $modelFile = APP_PATH . 'models/' . $model . '.php';
        if (file_exists($modelFile)) {
            require_once $modelFile;
            return new $model($this->db);
        } else {
            throw new Exception("Model '{$model}' not found");
        }
    }
    
    /**
     * Redirect to a URL
     */
    protected function redirect($url) {
        if (strpos($url, 'http') === false) {
            $url = SITE_URL . ltrim($url, '/');
        }
        header("Location: {$url}");
        exit();
    }
    
    /**
     * Get POST data safely
     */
    protected function getPost($key, $default = null) {
        return isset($_POST[$key]) ? trim($_POST[$key]) : $default;
    }
    
    /**
     * Get GET data safely
     */
    protected function getGet($key, $default = null) {
        return isset($_GET[$key]) ? trim($_GET[$key]) : $default;
    }
    
    /**
     * Check if user is logged in
     */
    protected function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }
    
    /**
     * Get current user data
     */
    protected function getCurrentUser() {
        if ($this->isLoggedIn()) {
            $userModel = $this->model('User');
            return $userModel->getById($_SESSION['user_id']);
        }
        return null;
    }
    
    /**
     * Require authentication
     */
    protected function requireAuth() {
        if (!$this->isLoggedIn()) {
            $this->redirect('auth/login');
        }
    }
    
    /**
     * Check user role
     */
    protected function hasRole($role) {
        $user = $this->getCurrentUser();
        return $user && $user['role'] === $role;
    }
    
    /**
     * Require specific role
     */
    protected function requireRole($role) {
        $this->requireAuth();
        if (!$this->hasRole($role)) {
            $this->redirect('dashboard');
        }
    }
    
    /**
     * Send JSON response
     */
    protected function json($data, $status = 200) {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }
    
    /**
     * Generate CSRF token
     */
    protected function generateCSRFToken() {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
    
    /**
     * Validate CSRF token
     */
    protected function validateCSRFToken($token) {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
}
?>