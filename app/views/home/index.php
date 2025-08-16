<?php 
ob_start(); 
?>

<!-- Hero Section -->
<section class="hero-section bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center min-vh-50">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">
                    Descubre Beneficios Exclusivos
                </h1>
                <p class="lead mb-4">
                    Únete a UFF! Platform y accede a descuentos únicos en comercios locales. 
                    Registra tu tarjeta digital gratuita y comienza a ahorrar hoy mismo.
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="<?= SITE_URL ?>auth/register" class="btn btn-light btn-lg">
                        <i class="bi bi-person-plus me-2"></i>Registrarse Gratis
                    </a>
                    <a href="<?= SITE_URL ?>home/businesses" class="btn btn-outline-light btn-lg">
                        <i class="bi bi-shop me-2"></i>Ver Comercios
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="hero-card bg-white text-dark p-4 rounded-3 shadow-lg">
                    <i class="bi bi-credit-card-2-front display-1 text-primary mb-3"></i>
                    <h3 class="fw-bold">Tarjeta Digital</h3>
                    <p class="mb-3">Accede a todos los beneficios con tu tarjeta digital gratuita</p>
                    <div class="d-flex justify-content-center gap-2">
                        <span class="badge bg-success">Gratuita</span>
                        <span class="badge bg-info">Digital</span>
                        <span class="badge bg-warning">Instantánea</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="fw-bold">¿Por qué elegir UFF!?</h2>
                <p class="text-muted">Beneficios únicos que hacen la diferencia</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm text-center">
                    <div class="card-body p-4">
                        <i class="bi bi-gift display-3 text-primary mb-3"></i>
                        <h5 class="fw-bold">Descuentos Exclusivos</h5>
                        <p class="text-muted">Accede a promociones especiales que no encontrarás en ningún otro lugar.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm text-center">
                    <div class="card-body p-4">
                        <i class="bi bi-qr-code display-3 text-success mb-3"></i>
                        <h5 class="fw-bold">Fácil de Usar</h5>
                        <p class="text-muted">Solo muestra tu QR code o proporciona tu teléfono para validar beneficios.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm text-center">
                    <div class="card-body p-4">
                        <i class="bi bi-geo-alt display-3 text-info mb-3"></i>
                        <h5 class="fw-bold">Comercios Locales</h5>
                        <p class="text-muted">Apoya a negocios de tu comunidad mientras ahorras dinero.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Businesses Section -->
<?php if (!empty($featuredBusinesses)): ?>
<section class="py-5 bg-light">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="fw-bold">Comercios Destacados</h2>
                <p class="text-muted">Descubre algunos de nuestros comercios afiliados</p>
            </div>
        </div>
        
        <div class="row g-4">
            <?php foreach (array_slice($featuredBusinesses, 0, 6) as $business): ?>
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <?php if ($business['logo']): ?>
                        <img src="<?= SITE_URL ?>public/uploads/<?= htmlspecialchars($business['logo']) ?>" 
                             class="card-img-top" style="height: 200px; object-fit: cover;" 
                             alt="<?= htmlspecialchars($business['business_name']) ?>">
                    <?php else: ?>
                        <div class="card-img-top bg-primary d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i class="bi bi-shop text-white display-4"></i>
                        </div>
                    <?php endif; ?>
                    
                    <div class="card-body">
                        <h5 class="card-title fw-bold"><?= htmlspecialchars($business['business_name']) ?></h5>
                        <span class="badge bg-secondary mb-2"><?= htmlspecialchars($business['business_type']) ?></span>
                        <p class="card-text text-muted">
                            <?= htmlspecialchars(substr($business['description'] ?? '', 0, 100)) ?>...
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                <i class="bi bi-geo-alt me-1"></i>Ver ubicación
                            </small>
                            <a href="<?= SITE_URL ?>home/business/<?= $business['id'] ?>" class="btn btn-outline-primary btn-sm">
                                Ver más
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-4">
            <a href="<?= SITE_URL ?>home/businesses" class="btn btn-primary btn-lg">
                Ver Todos los Comercios <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Featured Promotions Section -->
<?php if (!empty($featuredPromotions)): ?>
<section class="py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="fw-bold">Promociones Destacadas</h2>
                <p class="text-muted">No te pierdas estas ofertas especiales</p>
            </div>
        </div>
        
        <div class="row g-4">
            <?php foreach (array_slice($featuredPromotions, 0, 6) as $promotion): ?>
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <?php if ($promotion['image']): ?>
                        <img src="<?= SITE_URL ?>public/uploads/<?= htmlspecialchars($promotion['image']) ?>" 
                             class="card-img-top" style="height: 200px; object-fit: cover;" 
                             alt="<?= htmlspecialchars($promotion['title']) ?>">
                    <?php else: ?>
                        <div class="card-img-top bg-gradient bg-success d-flex align-items-center justify-content-center" style="height: 200px;">
                            <div class="text-white text-center">
                                <i class="bi bi-percent display-4"></i>
                                <h3 class="fw-bold mt-2">
                                    <?php if ($promotion['discount_type'] === 'percentage'): ?>
                                        <?= $promotion['discount_value'] ?>% OFF
                                    <?php elseif ($promotion['discount_type'] === 'fixed_amount'): ?>
                                        $<?= $promotion['discount_value'] ?> OFF
                                    <?php else: ?>
                                        OFERTA
                                    <?php endif; ?>
                                </h3>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title fw-bold"><?= htmlspecialchars($promotion['title']) ?></h5>
                            <span class="badge bg-primary">Destacada</span>
                        </div>
                        <p class="card-text">
                            <small class="text-primary fw-bold">
                                <i class="bi bi-shop me-1"></i><?= htmlspecialchars($promotion['business_name']) ?>
                            </small>
                        </p>
                        <p class="card-text text-muted">
                            <?= htmlspecialchars(substr($promotion['description'], 0, 100)) ?>...
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                Válida hasta: <?= date('d/m/Y', strtotime($promotion['end_date'])) ?>
                            </small>
                            <a href="<?= SITE_URL ?>home/promotion/<?= $promotion['id'] ?>" class="btn btn-outline-success btn-sm">
                                Ver detalle
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-4">
            <a href="<?= SITE_URL ?>home/promotions" class="btn btn-success btn-lg">
                Ver Todas las Promociones <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- How it Works Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 class="fw-bold">¿Cómo funciona?</h2>
                <p class="text-muted">En 3 simples pasos</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4 text-center">
                <div class="position-relative">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <span class="fs-3 fw-bold">1</span>
                    </div>
                    <h5 class="fw-bold">Regístrate</h5>
                    <p class="text-muted">Crea tu cuenta gratuita y obtén tu tarjeta digital al instante</p>
                </div>
            </div>
            
            <div class="col-md-4 text-center">
                <div class="position-relative">
                    <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <span class="fs-3 fw-bold">2</span>
                    </div>
                    <h5 class="fw-bold">Encuentra Ofertas</h5>
                    <p class="text-muted">Explora promociones exclusivas en comercios cercanos a ti</p>
                </div>
            </div>
            
            <div class="col-md-4 text-center">
                <div class="position-relative">
                    <div class="bg-info text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                        <span class="fs-3 fw-bold">3</span>
                    </div>
                    <h5 class="fw-bold">Ahorra</h5>
                    <p class="text-muted">Muestra tu QR code o teléfono para validar tu descuento</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <h2 class="fw-bold mb-3">¡No te pierdas ninguna promoción!</h2>
                <p class="lead mb-4">Suscríbete a nuestro boletín semanal y recibe las mejores ofertas directamente en tu email</p>
                
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <form class="d-flex gap-2" method="post" action="<?= SITE_URL ?>newsletter/subscribe">
                            <input type="email" class="form-control form-control-lg" placeholder="Tu email" name="email" required>
                            <button class="btn btn-light btn-lg" type="submit">
                                <i class="bi bi-envelope me-2"></i>Suscribir
                            </button>
                        </form>
                        <small class="text-light opacity-75 mt-2 d-block">
                            <i class="bi bi-shield-check me-1"></i>No enviamos spam. Puedes darte de baja cuando quieras.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php 
$content = ob_get_clean();
$pageScripts = '';
include APP_PATH . 'views/layouts/main.php';
?>