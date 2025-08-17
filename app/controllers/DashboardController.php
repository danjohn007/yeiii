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
        
        // Get statistics with error handling
        try {
            $stats = [
                'totalUsers' => $userModel->count(),
                'totalBusinesses' => $businessModel->count(['status' => 'approved']),
                'totalPromotions' => $promotionModel->count(['is_active' => 1]),
                'totalCards' => $cardModel->count(['is_active' => 1]),
                'pendingBusinesses' => $businessModel->count(['status' => 'pending'])
            ];
        } catch (Exception $e) {
            // Fallback values to prevent chart errors
            $stats = [
                'totalUsers' => 0,
                'totalBusinesses' => 0,
                'totalPromotions' => 0,
                'totalCards' => 0,
                'pendingBusinesses' => 0
            ];
        }
        
        // Get user statistics for chart with error handling
        try {
            $userStats = $userModel->getStats();
        } catch (Exception $e) {
            $userStats = [];
        }
        
        $data = [
            'pageTitle' => 'Dashboard - Super Administrador',
            'user' => $this->getCurrentUser(),
            'stats' => $stats,
            'userStats' => $userStats
        ];
        
        $this->view('dashboard/superadmin', $data);
    }
    
    private function gestorDashboard() {
        $user = $this->getCurrentUser();
        $city = $user['city'] ?? null;
        
        $data = [
            'pageTitle' => 'Dashboard - Gestor',
            'user' => $user
        ];
        
        // Add city-specific data if city is assigned
        if ($city) {
            $businessModel = $this->model('Business');
            $userModel = $this->model('User');
            
            $data['cityStats'] = [
                'totalBusinesses' => $businessModel->countByCity($city),
                'approvedBusinesses' => $businessModel->countByCity($city, 'approved'),
                'pendingBusinesses' => $businessModel->countByCity($city, 'pending'),
                'cityUsers' => $userModel->count(['city' => $city])
            ];
            
            $data['recentBusinesses'] = $businessModel->getByCity($city);
        }
        
        $this->view('dashboard/gestor', $data);
    }
    
    private function capturistaDashboard() {
        $user = $this->getCurrentUser();
        $city = $user['city'] ?? null;
        
        $data = [
            'pageTitle' => 'Dashboard - Capturista',
            'user' => $user
        ];
        
        // Add city-specific data if city is assigned
        if ($city) {
            $businessModel = $this->model('Business');
            
            $data['cityStats'] = [
                'totalBusinesses' => $businessModel->countByCity($city),
                'todayRegistered' => 0, // This would need transaction log to track
                'pendingApproval' => $businessModel->countByCity($city, 'pending')
            ];
        }
        
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
    
    // Admin functionality methods
    public function user_management() {
        $this->requireAuth();
        $this->requireRole('superadmin');
        
        $userModel = $this->model('User');
        
        // Get search parameters
        $search = $this->getGet('search', '');
        $role = $this->getGet('role', '');
        $page = max(1, (int)$this->getGet('page', 1));
        $perPage = 20;
        $offset = ($page - 1) * $perPage;
        
        // Get users
        $users = $userModel->searchUsers($search, $role, $perPage, $offset);
        $totalUsers = $userModel->countSearch($search, $role);
        $totalPages = ceil($totalUsers / $perPage);
        
        // Get user statistics by role
        $userStats = $userModel->getStats();
        
        $data = [
            'pageTitle' => 'Gestión de Usuarios',
            'user' => $this->getCurrentUser(),
            'users' => $users,
            'userStats' => $userStats,
            'search' => $search,
            'selectedRole' => $role,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'totalUsers' => $totalUsers,
            'csrf_token' => $this->generateCSRFToken()
        ];
        
        $this->view('dashboard/user-management', $data);
    }
    
    public function business_approval() {
        $this->requireAuth();
        $this->requireRole('superadmin');
        
        $businessModel = $this->model('Business');
        
        // Get pending businesses
        $pendingBusinesses = $businessModel->getPendingApproval();
        
        // Get recent approved/rejected businesses using a better approach
        $businessModel = $this->model('Business'); 
        $allBusinesses = $businessModel->getAll('updated_at', 'DESC');
        $recentBusinesses = array_filter($allBusinesses, function($business) {
            return in_array($business['status'], ['approved', 'rejected']);
        });
        $recentBusinesses = array_slice($recentBusinesses, 0, 10);
        
        $data = [
            'pageTitle' => 'Autorización de Comercios',
            'user' => $this->getCurrentUser(),
            'pendingBusinesses' => $pendingBusinesses,
            'recentBusinesses' => $recentBusinesses
        ];
        
        $this->view('dashboard/business-approval', $data);
    }
    
    public function metrics() {
        $this->requireAuth();
        $this->requireRole('superadmin');
        
        $userModel = $this->model('User');
        $businessModel = $this->model('Business');
        $promotionModel = $this->model('Promotion');
        $cardModel = $this->model('DigitalCard');
        
        // Get detailed statistics
        $userStats = $userModel->getStats();
        $businessStats = [
            'total' => $businessModel->count(),
            'approved' => $businessModel->count(['status' => 'approved']),
            'pending' => $businessModel->count(['status' => 'pending']),
            'rejected' => $businessModel->count(['status' => 'rejected'])
        ];
        
        $promotionStats = [
            'total' => $promotionModel->count(),
            'active' => $promotionModel->count(['is_active' => 1]),
            'featured' => $promotionModel->count(['is_featured' => 1])
        ];
        
        $cardStats = [
            'total' => $cardModel->count(),
            'active' => $cardModel->count(['is_active' => 1]),
            'free' => $cardModel->count(['membership_level' => 'free']),
            'premium' => $cardModel->count(['membership_level' => 'premium']),
            'vip' => $cardModel->count(['membership_level' => 'vip'])
        ];
        
        $data = [
            'pageTitle' => 'Métricas Detalladas',
            'user' => $this->getCurrentUser(),
            'userStats' => $userStats,
            'businessStats' => $businessStats,
            'promotionStats' => $promotionStats,
            'cardStats' => $cardStats
        ];
        
        $this->view('dashboard/metrics', $data);
    }
    
    public function reports() {
        $this->requireAuth();
        $this->requireRole('superadmin');
        
        $data = [
            'pageTitle' => 'Informes y Reportes',
            'user' => $this->getCurrentUser()
        ];
        
        $this->view('dashboard/reports', $data);
    }
    
    public function charts() {
        $this->requireAuth();
        $this->requireRole('superadmin');
        
        $userModel = $this->model('User');
        $businessModel = $this->model('Business');
        $promotionModel = $this->model('Promotion');
        
        // Get data for charts
        $userStats = $userModel->getStats();
        $businessTypes = $businessModel->getCategories();
        
        $data = [
            'pageTitle' => 'Gráficas y Visualizaciones',
            'user' => $this->getCurrentUser(),
            'userStats' => $userStats,
            'businessTypes' => $businessTypes
        ];
        
        $this->view('dashboard/charts', $data);
    }
    
    // User management actions
    public function user_details($userId) {
        $this->requireAuth();
        $this->requireRole('superadmin');
        
        if (!$userId) {
            http_response_code(400);
            echo '<div class="alert alert-danger">ID de usuario inválido</div>';
            return;
        }
        
        $userModel = $this->model('User');
        $targetUser = $userModel->getById($userId);
        
        if (!$targetUser) {
            http_response_code(404);
            echo '<div class="alert alert-danger">Usuario no encontrado</div>';
            return;
        }
        
        // Return user details HTML
        echo $this->renderUserDetails($targetUser);
    }
    
    private function renderUserDetails($user) {
        ob_start();
        ?>
        <div class="row">
            <div class="col-md-6">
                <h6>Información Personal</h6>
                <table class="table table-sm">
                    <tr><td><strong>Nombre:</strong></td><td><?= htmlspecialchars($user['full_name']) ?></td></tr>
                    <tr><td><strong>Email:</strong></td><td><?= htmlspecialchars($user['email']) ?></td></tr>
                    <tr><td><strong>WhatsApp:</strong></td><td><?= htmlspecialchars($user['whatsapp']) ?></td></tr>
                    <tr><td><strong>Fecha de Nacimiento:</strong></td><td><?= date('d/m/Y', strtotime($user['birth_date'])) ?></td></tr>
                </table>
            </div>
            <div class="col-md-6">
                <h6>Información de Cuenta</h6>
                <table class="table table-sm">
                    <tr><td><strong>Rol:</strong></td><td><?= ucfirst($user['role']) ?></td></tr>
                    <?php if (in_array($user['role'], ['gestor', 'capturista'])): ?>
                    <tr><td><strong>Ciudad Asignada:</strong></td><td><?= htmlspecialchars($user['city'] ?? 'Sin asignar') ?></td></tr>
                    <?php endif; ?>
                    <tr><td><strong>Estado:</strong></td><td>
                        <span class="badge bg-<?= $user['status'] === 'active' ? 'success' : ($user['status'] === 'pending' ? 'warning' : 'danger') ?>">
                            <?= ucfirst($user['status']) ?>
                        </span>
                    </td></tr>
                    <tr><td><strong>Email Verificado:</strong></td><td>
                        <?php if ($user['email_verified']): ?>
                            <i class="bi bi-check-circle text-success"></i> Sí
                        <?php else: ?>
                            <i class="bi bi-x-circle text-warning"></i> No
                        <?php endif; ?>
                    </td></tr>
                    <tr><td><strong>Registro:</strong></td><td><?= date('d/m/Y H:i', strtotime($user['created_at'])) ?></td></tr>
                    <?php if (isset($user['last_login']) && $user['last_login']): ?>
                    <tr><td><strong>Último Acceso:</strong></td><td><?= date('d/m/Y H:i', strtotime($user['last_login'])) ?></td></tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
    
    public function user_edit($userId) {
        $this->requireAuth();
        $this->requireRole('superadmin');
        
        if (!$userId) {
            http_response_code(400);
            echo '<div class="alert alert-danger">ID de usuario inválido</div>';
            return;
        }
        
        $userModel = $this->model('User');
        $targetUser = $userModel->getById($userId);
        
        if (!$targetUser) {
            http_response_code(404);
            echo '<div class="alert alert-danger">Usuario no encontrado</div>';
            return;
        }
        
        // Return user edit form HTML
        echo $this->renderUserEditForm($targetUser);
    }
    
    private function renderUserEditForm($user) {
        ob_start();
        ?>
        <form id="userEditForm" data-user-id="<?= $user['id'] ?>">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="edit_full_name" class="form-label">Nombre Completo</label>
                    <input type="text" class="form-control" id="edit_full_name" name="full_name" 
                           value="<?= htmlspecialchars($user['full_name']) ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="edit_email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="edit_email" 
                           value="<?= htmlspecialchars($user['email']) ?>" disabled>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="edit_whatsapp" class="form-label">WhatsApp</label>
                    <input type="text" class="form-control" id="edit_whatsapp" name="whatsapp" 
                           value="<?= htmlspecialchars($user['whatsapp']) ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="edit_role" class="form-label">Rol</label>
                    <select class="form-control" id="edit_role" name="role" required>
                        <option value="usuario" <?= $user['role'] === 'usuario' ? 'selected' : '' ?>>Usuario</option>
                        <option value="comercio" <?= $user['role'] === 'comercio' ? 'selected' : '' ?>>Comercio</option>
                        <option value="capturista" <?= $user['role'] === 'capturista' ? 'selected' : '' ?>>Capturista</option>
                        <option value="gestor" <?= $user['role'] === 'gestor' ? 'selected' : '' ?>>Gestor</option>
                        <option value="superadmin" <?= $user['role'] === 'superadmin' ? 'selected' : '' ?>>Super Admin</option>
                    </select>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="edit_status" class="form-label">Estado</label>
                    <select class="form-control" id="edit_status" name="status" required>
                        <option value="active" <?= $user['status'] === 'active' ? 'selected' : '' ?>>Activo</option>
                        <option value="inactive" <?= $user['status'] === 'inactive' ? 'selected' : '' ?>>Inactivo</option>
                        <option value="pending" <?= $user['status'] === 'pending' ? 'selected' : '' ?>>Pendiente</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="edit_email_verified" class="form-label">Email Verificado</label>
                    <select class="form-control" id="edit_email_verified" name="email_verified">
                        <option value="1" <?= $user['email_verified'] ? 'selected' : '' ?>>Sí</option>
                        <option value="0" <?= !$user['email_verified'] ? 'selected' : '' ?>>No</option>
                    </select>
                </div>
            </div>
            
            <!-- City field for gestor and capturista roles -->
            <div class="row" id="cityFieldRow" style="display: <?= in_array($user['role'], ['gestor', 'capturista']) ? 'block' : 'none' ?>;">
                <div class="col-md-6 mb-3">
                    <label for="edit_city" class="form-label">Ciudad Asignada</label>
                    <select class="form-control" id="edit_city" name="city">
                        <option value="">Seleccionar ciudad...</option>
                        <option value="Ciudad de México" <?= ($user['city'] ?? '') === 'Ciudad de México' ? 'selected' : '' ?>>Ciudad de México</option>
                        <option value="Guadalajara" <?= ($user['city'] ?? '') === 'Guadalajara' ? 'selected' : '' ?>>Guadalajara</option>
                        <option value="Monterrey" <?= ($user['city'] ?? '') === 'Monterrey' ? 'selected' : '' ?>>Monterrey</option>
                        <option value="Puebla" <?= ($user['city'] ?? '') === 'Puebla' ? 'selected' : '' ?>>Puebla</option>
                        <option value="Tijuana" <?= ($user['city'] ?? '') === 'Tijuana' ? 'selected' : '' ?>>Tijuana</option>
                        <option value="León" <?= ($user['city'] ?? '') === 'León' ? 'selected' : '' ?>>León</option>
                        <option value="Juárez" <?= ($user['city'] ?? '') === 'Juárez' ? 'selected' : '' ?>>Juárez</option>
                        <option value="Torreón" <?= ($user['city'] ?? '') === 'Torreón' ? 'selected' : '' ?>>Torreón</option>
                        <option value="Querétaro" <?= ($user['city'] ?? '') === 'Querétaro' ? 'selected' : '' ?>>Querétaro</option>
                        <option value="Mérida" <?= ($user['city'] ?? '') === 'Mérida' ? 'selected' : '' ?>>Mérida</option>
                    </select>
                    <div class="form-text">Solo aplica para gestores y capturistas</div>
                </div>
            </div>
            
            <div class="d-flex justify-content-end gap-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </form>
        
        <script>
        // Show/hide city field based on role
        function toggleCityField() {
            const roleSelect = document.getElementById('edit_role');
            const cityFieldRow = document.getElementById('cityFieldRow');
            const citySelect = document.getElementById('edit_city');
            
            if (roleSelect.value === 'gestor' || roleSelect.value === 'capturista') {
                cityFieldRow.style.display = 'block';
                citySelect.required = true;
            } else {
                cityFieldRow.style.display = 'none';
                citySelect.required = false;
                citySelect.value = '';
            }
        }
        
        document.getElementById('edit_role').addEventListener('change', toggleCityField);
        
        document.getElementById('userEditForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const userId = this.dataset.userId;
            
            fetch(`<?= SITE_URL ?>dashboard/user-update/${userId}`, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Error al actualizar el usuario: ' + (data.message || 'Error desconocido'));
                }
            })
            .catch(error => {
                alert('Error al actualizar el usuario');
            });
        });
        </script>
        <?php
        return ob_get_clean();
    }
    
    public function user_update($userId) {
        $this->requireAuth();
        $this->requireRole('superadmin');
        
        header('Content-Type: application/json');
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Método no permitido']);
            return;
        }
        
        if (!$userId) {
            echo json_encode(['success' => false, 'message' => 'ID de usuario inválido']);
            return;
        }
        
        $userModel = $this->model('User');
        $targetUser = $userModel->getById($userId);
        
        if (!$targetUser) {
            echo json_encode(['success' => false, 'message' => 'Usuario no encontrado']);
            return;
        }
        
        $updateData = [
            'full_name' => trim($this->getPost('full_name')),
            'whatsapp' => trim($this->getPost('whatsapp')),
            'role' => $this->getPost('role'),
            'status' => $this->getPost('status'),
            'email_verified' => (int)$this->getPost('email_verified')
        ];
        
        // Handle city field for gestor and capturista roles
        $role = $this->getPost('role');
        if (in_array($role, ['gestor', 'capturista'])) {
            $city = trim($this->getPost('city'));
            if (empty($city)) {
                echo json_encode(['success' => false, 'message' => 'La ciudad es requerida para gestores y capturistas']);
                return;
            }
            $updateData['city'] = $city;
        } else {
            $updateData['city'] = null; // Clear city for other roles
        }
        
        // Validate data
        if (empty($updateData['full_name']) || str_word_count($updateData['full_name']) < 2) {
            echo json_encode(['success' => false, 'message' => 'El nombre completo debe contener al menos 2 palabras']);
            return;
        }
        
        if (!preg_match('/^\+52\d{10}$/', $updateData['whatsapp'])) {
            echo json_encode(['success' => false, 'message' => 'WhatsApp debe tener formato internacional (+52XXXXXXXXXX)']);
            return;
        }
        
        if (!in_array($updateData['role'], ['usuario', 'comercio', 'capturista', 'gestor', 'superadmin'])) {
            echo json_encode(['success' => false, 'message' => 'Rol inválido']);
            return;
        }
        
        if (!in_array($updateData['status'], ['active', 'inactive', 'pending'])) {
            echo json_encode(['success' => false, 'message' => 'Estado inválido']);
            return;
        }
        
        if ($userModel->update($userId, $updateData)) {
            echo json_encode(['success' => true, 'message' => 'Usuario actualizado correctamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar el usuario']);
        }
    }
    
    public function user_create() {
        $this->requireAuth();
        $this->requireRole('superadmin');
        
        header('Content-Type: application/json');
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Método no permitido']);
            return;
        }
        
        $userModel = $this->model('User');
        
        // Get form data
        $userData = [
            'full_name' => trim($this->getPost('full_name')),
            'email' => trim($this->getPost('email')),
            'whatsapp' => trim($this->getPost('whatsapp')),
            'birth_date' => $this->getPost('birth_date'),
            'role' => $this->getPost('role'),
            'status' => $this->getPost('status'),
            'email_verified' => $this->getPost('email_verified') ? 1 : 0,
            'password' => $this->getPost('password')
        ];
        
        // Handle city field for gestor and capturista roles
        if (in_array($userData['role'], ['gestor', 'capturista'])) {
            $city = trim($this->getPost('city'));
            if (empty($city)) {
                echo json_encode(['success' => false, 'message' => 'La ciudad es requerida para gestores y capturistas']);
                return;
            }
            $userData['city'] = $city;
        }
        
        // Validation
        $errors = [];
        
        if (empty($userData['full_name']) || str_word_count($userData['full_name']) < 2) {
            $errors[] = 'El nombre completo debe contener al menos 2 palabras';
        }
        
        if (empty($userData['email']) || !filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email inválido';
        }
        
        if (!preg_match('/^\+52\d{10}$/', $userData['whatsapp'])) {
            $errors[] = 'WhatsApp debe tener formato internacional (+52XXXXXXXXXX)';
        }
        
        if (empty($userData['birth_date'])) {
            $errors[] = 'Fecha de nacimiento es requerida';
        } else {
            $birthDate = new DateTime($userData['birth_date']);
            $now = new DateTime();
            $age = $now->diff($birthDate)->y;
            if ($age < 18) {
                $errors[] = 'El usuario debe ser mayor de 18 años';
            }
        }
        
        if (empty($userData['password']) || strlen($userData['password']) < 8) {
            $errors[] = 'La contraseña debe tener al menos 8 caracteres';
        }
        
        if (!in_array($userData['role'], ['usuario', 'comercio', 'capturista', 'gestor', 'superadmin'])) {
            $errors[] = 'Rol inválido';
        }
        
        if (!in_array($userData['status'], ['active', 'inactive', 'pending'])) {
            $errors[] = 'Estado inválido';
        }
        
        // Check if email already exists
        if ($userModel->emailExists($userData['email'])) {
            $errors[] = 'Este email ya está registrado';
        }
        
        if (!empty($errors)) {
            echo json_encode(['success' => false, 'message' => implode('. ', $errors)]);
            return;
        }
        
        // Hash password
        $userData['password'] = password_hash($userData['password'], PASSWORD_DEFAULT);
        
        // Create user
        $userId = $userModel->create($userData);
        
        if ($userId) {
            echo json_encode(['success' => true, 'message' => 'Usuario creado correctamente', 'user_id' => $userId]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al crear el usuario']);
        }
    }
    
    public function user_status($userId) {
        $this->requireAuth();
        $this->requireRole('superadmin');
        
        header('Content-Type: application/json');
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Método no permitido']);
            return;
        }
        
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (!$userId || !isset($input['status'])) {
            echo json_encode(['success' => false, 'message' => 'Datos inválidos']);
            return;
        }
        
        $userModel = $this->model('User');
        $targetUser = $userModel->getById($userId);
        
        if (!$targetUser) {
            echo json_encode(['success' => false, 'message' => 'Usuario no encontrado']);
            return;
        }
        
        // Prevent self-modification of superadmin
        $currentUser = $this->getCurrentUser();
        if ($targetUser['id'] == $currentUser['id']) {
            echo json_encode(['success' => false, 'message' => 'No puedes modificar tu propia cuenta']);
            return;
        }
        
        $newStatus = $input['status'];
        if (!in_array($newStatus, ['active', 'inactive'])) {
            echo json_encode(['success' => false, 'message' => 'Estado inválido']);
            return;
        }
        
        if ($userModel->update($userId, ['status' => $newStatus])) {
            echo json_encode(['success' => true, 'message' => 'Estado del usuario actualizado correctamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar el estado del usuario']);
        }
    }
}
?>