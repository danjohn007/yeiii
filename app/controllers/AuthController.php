<?php

class AuthController extends Controller {
    
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleRegister();
        }
        
        $data = [
            'pageTitle' => 'Registro de Usuario',
            'pageDescription' => 'Crea tu cuenta gratuita en YEIII Platform',
            'csrf_token' => $this->generateCSRFToken()
        ];
        
        $this->view('auth/register', $data);
    }
    
    private function handleRegister() {
        // Validate CSRF token
        if (!$this->validateCSRFToken($this->getPost('csrf_token'))) {
            $_SESSION['flash_message'] = 'Token de seguridad inválido';
            $_SESSION['flash_type'] = 'danger';
            return;
        }
        
        // Get form data
        $fullName = trim($this->getPost('full_name'));
        $email = trim($this->getPost('email'));
        $whatsapp = trim($this->getPost('whatsapp'));
        $birthDate = $this->getPost('birth_date');
        $password = $this->getPost('password');
        $confirmPassword = $this->getPost('confirm_password');
        $userType = $this->getPost('user_type', 'usuario');
        
        // Validation
        $errors = [];
        
        // Validate full name (minimum 2 words)
        if (empty($fullName) || str_word_count($fullName) < 2) {
            $errors[] = 'El nombre completo debe contener al menos 2 palabras';
        }
        
        // Validate email
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email inválido';
        }
        
        // Validate WhatsApp (international format)
        if (empty($whatsapp) || !preg_match('/^\+52\d{10}$/', $whatsapp)) {
            $errors[] = 'WhatsApp debe tener formato internacional (+52XXXXXXXXXX)';
        }
        
        // Validate birth date (must be 18+ years old)
        if (empty($birthDate)) {
            $errors[] = 'La fecha de nacimiento es requerida';
        } else {
            $birthDateTime = new DateTime($birthDate);
            $now = new DateTime();
            $age = $now->diff($birthDateTime)->y;
            if ($age < 18) {
                $errors[] = 'Debes ser mayor de 18 años';
            }
        }
        
        // Validate password
        if (empty($password) || strlen($password) < 8) {
            $errors[] = 'La contraseña debe tener al menos 8 caracteres';
        }
        
        if ($password !== $confirmPassword) {
            $errors[] = 'Las contraseñas no coinciden';
        }
        
        // Check if email already exists
        $userModel = $this->model('User');
        if ($userModel->emailExists($email)) {
            $errors[] = 'Este email ya está registrado';
        }
        
        if (!empty($errors)) {
            $_SESSION['flash_message'] = implode('<br>', $errors);
            $_SESSION['flash_type'] = 'danger';
            return;
        }
        
        // Create user
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $verificationToken = bin2hex(random_bytes(32));
        
        // Auto-activate standard users, require manual activation for other roles
        $initialStatus = ($userType === 'usuario') ? 'active' : 'pending';
        $emailVerified = ($userType === 'usuario') ? 1 : 0;
        
        $userData = [
            'email' => $email,
            'password' => $hashedPassword,
            'full_name' => $fullName,
            'whatsapp' => $whatsapp,
            'birth_date' => $birthDate,
            'role' => $userType,
            'status' => $initialStatus,
            'email_verified' => $emailVerified,
            'email_verification_token' => $emailVerified ? null : $verificationToken
        ];
        
        $userId = $userModel->create($userData);
        
        if ($userId) {
            // Create digital card for regular users
            if ($userType === 'usuario') {
                $cardModel = $this->model('DigitalCard');
                $cardModel->createForUser($userId);
            }
            
            // Send verification email only for non-standard users
            if ($userType !== 'usuario') {
                $this->sendVerificationEmail($email, $verificationToken);
                $_SESSION['flash_message'] = 'Registro exitoso. Tu cuenta será revisada por nuestro equipo.';
            } else {
                $_SESSION['flash_message'] = 'Registro exitoso. Tu cuenta ya está activa y puedes iniciar sesión.';
            }
            
            $_SESSION['flash_type'] = 'success';
            $this->redirect('auth/login');
        } else {
            $_SESSION['flash_message'] = 'Error al crear la cuenta. Intenta nuevamente.';
            $_SESSION['flash_type'] = 'danger';
        }
    }
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleLogin();
        }
        
        $data = [
            'pageTitle' => 'Iniciar Sesión',
            'pageDescription' => 'Accede a tu cuenta en YEIII Platform',
            'csrf_token' => $this->generateCSRFToken()
        ];
        
        $this->view('auth/login', $data);
    }
    
    private function handleLogin() {
        // Validate CSRF token
        if (!$this->validateCSRFToken($this->getPost('csrf_token'))) {
            $_SESSION['flash_message'] = 'Token de seguridad inválido';
            $_SESSION['flash_type'] = 'danger';
            return;
        }
        
        $email = trim($this->getPost('email'));
        $password = $this->getPost('password');
        
        if (empty($email) || empty($password)) {
            $_SESSION['flash_message'] = 'Email y contraseña son requeridos';
            $_SESSION['flash_type'] = 'danger';
            return;
        }
        
        $userModel = $this->model('User');
        $user = $userModel->getByEmail($email);
        
        if (!$user || !password_verify($password, $user['password'])) {
            $_SESSION['flash_message'] = 'Email o contraseña incorrectos';
            $_SESSION['flash_type'] = 'danger';
            return;
        }
        
        if ($user['status'] !== 'active') {
            $_SESSION['flash_message'] = 'Tu cuenta no está activa. Contacta al administrador.';
            $_SESSION['flash_type'] = 'warning';
            return;
        }
        
        // Set session data
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_name'] = $user['full_name'];
        $_SESSION['user_role'] = $user['role'];
        
        $_SESSION['flash_message'] = 'Bienvenido, ' . $user['full_name'];
        $_SESSION['flash_type'] = 'success';
        
        $this->redirect('dashboard');
    }
    
    public function logout() {
        session_destroy();
        $this->redirect('home');
    }
    
    public function verify($token) {
        if (empty($token)) {
            $_SESSION['flash_message'] = 'Token de verificación inválido';
            $_SESSION['flash_type'] = 'danger';
            $this->redirect('home');
        }
        
        $userModel = $this->model('User');
        $user = $userModel->getByVerificationToken($token);
        
        if (!$user) {
            $_SESSION['flash_message'] = 'Token de verificación inválido o expirado';
            $_SESSION['flash_type'] = 'danger';
            $this->redirect('home');
        }
        
        // Verify email
        $userModel->verifyEmail($user['id']);
        
        $_SESSION['flash_message'] = 'Email verificado correctamente. Ya puedes iniciar sesión.';
        $_SESSION['flash_type'] = 'success';
        $this->redirect('auth/login');
    }
    
    public function registerBusiness() {
        $this->requireAuth();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleBusinessRegister();
        }
        
        $data = [
            'pageTitle' => 'Registro de Negocio',
            'pageDescription' => 'Registra tu negocio en YEIII Platform',
            'csrf_token' => $this->generateCSRFToken()
        ];
        
        $this->view('auth/register_business', $data);
    }
    
    private function handleBusinessRegister() {
        // This method would handle business registration
        // Implementation details would go here
        $_SESSION['flash_message'] = 'Solicitud de registro de negocio enviada. Será revisada por nuestro equipo.';
        $_SESSION['flash_type'] = 'success';
        $this->redirect('dashboard');
    }
    
    private function sendVerificationEmail($email, $token) {
        // In a real implementation, this would send an actual email
        // For now, we'll just log it or simulate it
        $verificationLink = SITE_URL . 'auth/verify/' . $token;
        
        // Log email (in production, use proper email service)
        error_log("Verification email would be sent to: {$email}");
        error_log("Verification link: {$verificationLink}");
    }
}
?>