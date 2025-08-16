<?php

class HomeController extends Controller {
    
    public function index() {
        $businessModel = $this->model('Business');
        $promotionModel = $this->model('Promotion');
        
        // Get featured businesses and promotions
        $featuredBusinesses = $businessModel->getFeatured(6);
        $featuredPromotions = $promotionModel->getFeatured(6);
        
        $data = [
            'pageTitle' => 'Inicio',
            'pageDescription' => 'Plataforma digital que conecta usuarios con comercios locales',
            'featuredBusinesses' => $featuredBusinesses,
            'featuredPromotions' => $featuredPromotions
        ];
        
        $this->view('home/index', $data);
    }
    
    public function businesses() {
        $businessModel = $this->model('Business');
        
        // Get search and filter parameters
        $search = $this->getGet('search', '');
        $category = $this->getGet('category', '');
        $page = max(1, (int)$this->getGet('page', 1));
        $limit = 12;
        $offset = ($page - 1) * $limit;
        
        $businesses = $businessModel->search($search, $category, $limit, $offset);
        $totalBusinesses = $businessModel->countSearch($search, $category);
        $totalPages = ceil($totalBusinesses / $limit);
        $categories = $businessModel->getCategories();
        
        $data = [
            'pageTitle' => 'Comercios Afiliados',
            'pageDescription' => 'Descubre todos los comercios afiliados a nuestra plataforma',
            'businesses' => $businesses,
            'categories' => $categories,
            'search' => $search,
            'category' => $category,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'totalBusinesses' => $totalBusinesses
        ];
        
        $this->view('home/businesses', $data);
    }
    
    public function promotions() {
        $promotionModel = $this->model('Promotion');
        
        // Get search and filter parameters
        $search = $this->getGet('search', '');
        $business = $this->getGet('business', '');
        $page = max(1, (int)$this->getGet('page', 1));
        $limit = 12;
        $offset = ($page - 1) * $limit;
        
        $promotions = $promotionModel->search($search, $business, $limit, $offset);
        $totalPromotions = $promotionModel->countSearch($search, $business);
        $totalPages = ceil($totalPromotions / $limit);
        
        $businessModel = $this->model('Business');
        $businesses = $businessModel->getForSelect();
        
        $data = [
            'pageTitle' => 'Promociones Activas',
            'pageDescription' => 'Descubre todas las promociones y descuentos disponibles',
            'promotions' => $promotions,
            'businesses' => $businesses,
            'search' => $search,
            'business' => $business,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'totalPromotions' => $totalPromotions
        ];
        
        $this->view('home/promotions', $data);
    }
    
    public function business($id) {
        $businessModel = $this->model('Business');
        $promotionModel = $this->model('Promotion');
        
        $business = $businessModel->getById($id);
        if (!$business) {
            $this->redirect('home/businesses');
        }
        
        $promotions = $promotionModel->getByBusiness($id);
        
        $data = [
            'pageTitle' => $business['business_name'],
            'pageDescription' => $business['description'],
            'business' => $business,
            'promotions' => $promotions
        ];
        
        $this->view('home/business_detail', $data);
    }
    
    public function promotion($id) {
        $promotionModel = $this->model('Promotion');
        $businessModel = $this->model('Business');
        
        $promotion = $promotionModel->getById($id);
        if (!$promotion) {
            $this->redirect('home/promotions');
        }
        
        $business = $businessModel->getById($promotion['business_id']);
        
        $data = [
            'pageTitle' => $promotion['title'],
            'pageDescription' => $promotion['description'],
            'promotion' => $promotion,
            'business' => $business
        ];
        
        $this->view('home/promotion_detail', $data);
    }
    
    public function about() {
        $data = [
            'pageTitle' => 'Acerca de YEIII',
            'pageDescription' => 'Conoce más sobre nuestra plataforma y misión'
        ];
        
        $this->view('home/about', $data);
    }
    
    public function contact() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $this->getPost('name');
            $email = $this->getPost('email');
            $message = $this->getPost('message');
            
            // Here you would normally send an email or save to database
            $_SESSION['flash_message'] = 'Mensaje enviado correctamente. Te contactaremos pronto.';
            $_SESSION['flash_type'] = 'success';
            $this->redirect('home/contact');
        }
        
        $data = [
            'pageTitle' => 'Contacto',
            'pageDescription' => 'Ponte en contacto con nosotros'
        ];
        
        $this->view('home/contact', $data);
    }
    
    public function terms() {
        $data = [
            'pageTitle' => 'Términos y Condiciones',
            'pageDescription' => 'Términos y condiciones de uso de la plataforma'
        ];
        
        $this->view('home/terms', $data);
    }
    
    public function privacy() {
        $data = [
            'pageTitle' => 'Política de Privacidad',
            'pageDescription' => 'Política de privacidad y manejo de datos'
        ];
        
        $this->view('home/privacy', $data);
    }
}
?>