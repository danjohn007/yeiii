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
}
?>