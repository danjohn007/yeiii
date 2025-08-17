<?php

class MockController extends Controller {
    
    public function __construct() {
        // Don't initialize database connection for demo purposes
    }
    
    protected function model($model) {
        // Return mock model for demo
        return new MockModel();
    }
}

class MockModel {
    public function getFeatured($limit = 6) {
        return [
            [
                'id' => 1,
                'business_name' => 'Restaurante El Buen Sabor',
                'business_type' => 'Restaurante',
                'description' => 'Restaurante familiar con comida mexicana tradicional y ambiente acogedor.',
                'logo' => null,
                'owner_name' => 'Roberto Sánchez'
            ],
            [
                'id' => 2,
                'business_name' => 'Farmacia San Juan',
                'business_type' => 'Farmacia',
                'description' => 'Farmacia con servicio las 24 horas, medicamentos genéricos y de patente.',
                'logo' => null,
                'owner_name' => 'Ana Patricia Morales'
            ]
        ];
    }
    
    public function getByUserMembership($level) {
        return [
            [
                'id' => 1,
                'title' => '20% de descuento en platillos principales',
                'description' => 'Obtén 20% de descuento en todos nuestros platillos principales de lunes a viernes',
                'business_name' => 'Restaurante El Buen Sabor',
                'discount_type' => 'percentage',
                'discount_value' => 20,
                'end_date' => '2024-12-31',
                'is_featured' => 1,
                'image' => null
            ]
        ];
    }
}

class DemoController extends MockController {
    
    public function index() {
        $featuredBusinesses = [
            [
                'id' => 1,
                'business_name' => 'Restaurante El Buen Sabor',
                'business_type' => 'Restaurante',
                'description' => 'Restaurante familiar con comida mexicana tradicional y ambiente acogedor.',
                'logo' => null,
                'owner_name' => 'Roberto Sánchez'
            ],
            [
                'id' => 2,
                'business_name' => 'Farmacia San Juan',
                'business_type' => 'Farmacia',
                'description' => 'Farmacia con servicio las 24 horas, medicamentos genéricos y de patente.',
                'logo' => null,
                'owner_name' => 'Ana Patricia Morales'
            ]
        ];
        
        $featuredPromotions = [
            [
                'id' => 1,
                'title' => '20% de descuento en platillos principales',
                'description' => 'Obtén 20% de descuento en todos nuestros platillos principales de lunes a viernes',
                'business_name' => 'Restaurante El Buen Sabor',
                'discount_type' => 'percentage',
                'discount_value' => 20,
                'end_date' => '2024-12-31',
                'is_featured' => 1,
                'image' => null
            ],
            [
                'id' => 2,
                'title' => '15% de descuento en medicamentos',
                'description' => 'Descuento del 15% en medicamentos genéricos y vitaminas',
                'business_name' => 'Farmacia San Juan',
                'discount_type' => 'percentage',
                'discount_value' => 15,
                'end_date' => '2024-12-31',
                'is_featured' => 1,
                'image' => null
            ]
        ];
        
        $data = [
            'pageTitle' => 'DEMO - Inicio',
            'pageDescription' => 'Plataforma digital que conecta usuarios con comercios locales - VERSIÓN DEMO',
            'featuredBusinesses' => $featuredBusinesses,
            'featuredPromotions' => $featuredPromotions
        ];
        
        $this->view('home/index', $data);
    }
    
    public function dashboard() {
        // Mock user data for demo
        $user = [
            'id' => 1,
            'email' => 'admin@uff.com',
            'full_name' => 'Administrador Demo',
            'role' => 'superadmin',
            'status' => 'active',
            'created_at' => '2024-01-01 00:00:00',
            'last_login' => '2024-08-16 20:00:00',
            'email_verified' => 1,
            'whatsapp' => '+5215555555555',
            'birth_date' => '1990-01-01'
        ];
        
        // Mock stats
        $stats = [
            'totalUsers' => 1250,
            'totalBusinesses' => 85,
            'totalPromotions' => 156,
            'totalCards' => 1100,
            'pendingBusinesses' => 3
        ];
        
        // Mock user stats for charts
        $userStats = [
            ['role' => 'usuario', 'count' => 1000, 'active_count' => 980],
            ['role' => 'comercio', 'count' => 85, 'active_count' => 82],
            ['role' => 'capturista', 'count' => 10, 'active_count' => 10],
            ['role' => 'gestor', 'count' => 5, 'active_count' => 5],
            ['role' => 'superadmin', 'count' => 2, 'active_count' => 2]
        ];
        
        $data = [
            'pageTitle' => 'Dashboard - Super Administrador',
            'user' => $user,
            'stats' => $stats,
            'userStats' => $userStats
        ];
        
        $this->view('dashboard/superadmin', $data);
    }
    
    public function user_management() {
        // Mock user data for demo
        $currentUser = [
            'id' => 1,
            'email' => 'admin@uff.com',
            'full_name' => 'Administrador Demo',
            'role' => 'superadmin',
            'status' => 'active',
            'created_at' => '2024-01-01 00:00:00',
            'last_login' => '2024-08-16 20:00:00',
            'email_verified' => 1,
            'whatsapp' => '+5215555555555',
            'birth_date' => '1990-01-01'
        ];
        
        // Mock users list
        $users = [
            [
                'id' => 2,
                'email' => 'usuario1@example.com',
                'full_name' => 'Juan Pérez López',
                'role' => 'usuario',
                'status' => 'active',
                'created_at' => '2024-03-15 10:30:00',
                'email_verified' => 1,
                'whatsapp' => '+5215512345678'
            ],
            [
                'id' => 3,
                'email' => 'comercio1@example.com',
                'full_name' => 'María González Hernández',
                'role' => 'comercio',
                'status' => 'active',
                'created_at' => '2024-04-20 14:15:00',
                'email_verified' => 1,
                'whatsapp' => '+5215587654321'
            ],
            [
                'id' => 4,
                'email' => 'gestor1@example.com',
                'full_name' => 'Carlos Rodríguez Martínez',
                'role' => 'gestor',
                'status' => 'active',
                'created_at' => '2024-02-10 09:45:00',
                'email_verified' => 1,
                'whatsapp' => '+5215511111111'
            ]
        ];
        
        // Mock user stats
        $userStats = [
            ['role' => 'usuario', 'count' => 1000, 'active_count' => 980],
            ['role' => 'comercio', 'count' => 85, 'active_count' => 82],
            ['role' => 'capturista', 'count' => 10, 'active_count' => 10],
            ['role' => 'gestor', 'count' => 5, 'active_count' => 5],
            ['role' => 'superadmin', 'count' => 2, 'active_count' => 2]
        ];
        
        $data = [
            'pageTitle' => 'Gestión de Usuarios',
            'user' => $currentUser,
            'users' => $users,
            'userStats' => $userStats,
            'search' => '',
            'selectedRole' => '',
            'currentPage' => 1,
            'totalPages' => 1,
            'totalUsers' => 3,
            'csrf_token' => 'demo-csrf-token'
        ];
        
        $this->view('dashboard/user-management', $data);
    }
    
    public function charts() {
        // Mock user data for demo
        $user = [
            'id' => 1,
            'email' => 'admin@uff.com',
            'full_name' => 'Administrador Demo',
            'role' => 'superadmin',
            'status' => 'active',
            'created_at' => '2024-01-01 00:00:00',
            'last_login' => '2024-08-16 20:00:00',
            'email_verified' => 1,
            'whatsapp' => '+5215555555555',
            'birth_date' => '1990-01-01'
        ];
        
        // Mock user stats for charts
        $userStats = [
            ['role' => 'usuario', 'count' => 1000, 'active_count' => 980],
            ['role' => 'comercio', 'count' => 85, 'active_count' => 82],
            ['role' => 'capturista', 'count' => 10, 'active_count' => 10],
            ['role' => 'gestor', 'count' => 5, 'active_count' => 5],
            ['role' => 'superadmin', 'count' => 2, 'active_count' => 2]
        ];
        
        $businessTypes = ['Restaurante', 'Farmacia', 'Supermercado', 'Ropa y Calzado'];
        
        $data = [
            'pageTitle' => 'Gráficas y Visualizaciones',
            'user' => $user,
            'userStats' => $userStats,
            'businessTypes' => $businessTypes
        ];
        
        $this->view('dashboard/charts', $data);
    }
    
    public function profile() {
        // Mock user data for demo
        $user = [
            'id' => 1,
            'email' => 'admin@uff.com',
            'full_name' => 'Administrador Demo',
            'role' => 'superadmin',
            'status' => 'active',
            'created_at' => '2024-01-01 00:00:00',
            'last_login' => '2024-08-16 20:00:00',
            'email_verified' => 1,
            'whatsapp' => '+5215555555555',
            'birth_date' => '1990-01-01'
        ];
        
        $data = [
            'pageTitle' => 'Mi Perfil',
            'user' => $user,
            'csrf_token' => 'demo-csrf-token'
        ];
        
        $this->view('dashboard/profile', $data);
    }
}
?>