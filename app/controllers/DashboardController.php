<?php

class DashboardController extends Controller {
    
    public function index() {
        $this->requireAuth();
        
        $user = $this->getCurrentUser();
        $role = $user['role'];
        
        // Redirect to appropriate dashboard based on role
        switch ($role) {
            case 'superadmin':
                $this->superAdminDashboard();
                break;
            case 'gestor':
                $this->gestorDashboard();
                break;
            case 'capturista':
                $this->capturistaDashboard();
                break;
            case 'comercio':
                $this->comercioDashboard();
                break;
            case 'usuario':
                $this->usuarioDashboard();
                break;
            default:
                $this->redirect('auth/logout');
        }
    }
    
    private function superAdminDashboard() {
        $userModel = $this->model('User');
        $businessModel = $this->model('Business');
        $promotionModel = $this->model('Promotion');
        $cardModel = $this->model('DigitalCard');
        
        // Get statistics
        $stats = [
            'totalUsers' => $userModel->count(),
            'totalBusinesses' => $businessModel->count(['status' => 'approved']),
            'totalPromotions' => $promotionModel->count(['is_active' => 1]),
            'totalCards' => $cardModel->count(['is_active' => 1]),
            'pendingBusinesses' => $businessModel->count(['status' => 'pending'])
        ];
        
        $data = [
            'pageTitle' => 'Dashboard - Super Administrador',
            'user' => $this->getCurrentUser(),
            'stats' => $stats
        ];
        
        $this->view('dashboard/superadmin', $data);
    }
    
    private function gestorDashboard() {
        $data = [
            'pageTitle' => 'Dashboard - Gestor',
            'user' => $this->getCurrentUser()
        ];
        
        $this->view('dashboard/gestor', $data);
    }
    
    private function capturistaDashboard() {
        $data = [
            'pageTitle' => 'Dashboard - Capturista',
            'user' => $this->getCurrentUser()
        ];
        
        $this->view('dashboard/capturista', $data);
    }
    
    private function comercioDashboard() {
        $businessModel = $this->model('Business');
        $promotionModel = $this->model('Promotion');
        
        $user = $this->getCurrentUser();
        $business = $businessModel->getByUser($user['id']);
        
        if (!$business) {
            $this->redirect('auth/register-business');
        }
        
        $promotions = $promotionModel->getByBusiness($business['id']);
        
        $data = [
            'pageTitle' => 'Dashboard - Comercio',
            'user' => $user,
            'business' => $business,
            'promotions' => $promotions
        ];
        
        $this->view('dashboard/comercio', $data);
    }
    
    private function usuarioDashboard() {
        $cardModel = $this->model('DigitalCard');
        $promotionModel = $this->model('Promotion');
        $businessModel = $this->model('Business');
        
        $user = $this->getCurrentUser();
        $card = $cardModel->getByUser($user['id']);
        
        // Get available promotions based on membership level
        $availablePromotions = $promotionModel->getByUserMembership($card['membership_level'] ?? 'free');
        $featuredBusinesses = $businessModel->getFeatured(4);
        
        $data = [
            'pageTitle' => 'Mi Dashboard',
            'user' => $user,
            'card' => $card,
            'availablePromotions' => $availablePromotions,
            'featuredBusinesses' => $featuredBusinesses
        ];
        
        $this->view('dashboard/usuario', $data);
    }
    
    public function profile() {
        $this->requireAuth();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->updateProfile();
        }
        
        $data = [
            'pageTitle' => 'Mi Perfil',
            'user' => $this->getCurrentUser(),
            'csrf_token' => $this->generateCSRFToken()
        ];
        
        $this->view('dashboard/profile', $data);
    }
    
    private function updateProfile() {
        if (!$this->validateCSRFToken($this->getPost('csrf_token'))) {
            $_SESSION['flash_message'] = 'Token de seguridad inválido';
            $_SESSION['flash_type'] = 'danger';
            return;
        }
        
        $userModel = $this->model('User');
        $user = $this->getCurrentUser();
        
        $updateData = [
            'full_name' => trim($this->getPost('full_name')),
            'whatsapp' => trim($this->getPost('whatsapp'))
        ];
        
        // Validate data
        if (empty($updateData['full_name']) || str_word_count($updateData['full_name']) < 2) {
            $_SESSION['flash_message'] = 'El nombre completo debe contener al menos 2 palabras';
            $_SESSION['flash_type'] = 'danger';
            return;
        }
        
        if (!preg_match('/^\+52\d{10}$/', $updateData['whatsapp'])) {
            $_SESSION['flash_message'] = 'WhatsApp debe tener formato internacional (+52XXXXXXXXXX)';
            $_SESSION['flash_type'] = 'danger';
            return;
        }
        
        if ($userModel->update($user['id'], $updateData)) {
            $_SESSION['user_name'] = $updateData['full_name'];
            $_SESSION['flash_message'] = 'Perfil actualizado correctamente';
            $_SESSION['flash_type'] = 'success';
        } else {
            $_SESSION['flash_message'] = 'Error al actualizar el perfil';
            $_SESSION['flash_type'] = 'danger';
        }
    }
    
    public function card() {
        $this->requireAuth();
        $this->requireRole('usuario');
        
        $cardModel = $this->model('DigitalCard');
        $user = $this->getCurrentUser();
        $card = $cardModel->getByUser($user['id']);
        
        if (!$card) {
            // Create card if it doesn't exist
            $cardModel->createForUser($user['id']);
            $card = $cardModel->getByUser($user['id']);
        }
        
        $data = [
            'pageTitle' => 'Mi Tarjeta Digital',
            'user' => $user,
            'card' => $card
        ];
        
        $this->view('dashboard/card', $data);
    }
    
    public function transactions() {
        $this->requireAuth();
        $this->requireRole('usuario');
        
        // This would show user's transaction history
        $data = [
            'pageTitle' => 'Mis Transacciones',
            'user' => $this->getCurrentUser()
        ];
        
        $this->view('dashboard/transactions', $data);
    }
    
    public function favorites() {
        $this->requireAuth();
        $this->requireRole('usuario');
        
        // This would show user's favorite businesses
        $data = [
            'pageTitle' => 'Mis Favoritos',
            'user' => $this->getCurrentUser()
        ];
        
        $this->view('dashboard/favorites', $data);
    }
}
?>