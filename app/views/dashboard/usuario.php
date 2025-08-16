<?php 
ob_start(); 
?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 px-0">
            <div class="dashboard-sidebar p-3">
                <div class="text-center mb-4">
                    <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        <i class="bi bi-person-circle text-primary" style="font-size: 2rem;"></i>
                    </div>
                    <h6 class="text-white mt-2 mb-0"><?= htmlspecialchars($user['full_name']) ?></h6>
                    <small class="text-white-50"><?= ucfirst($user['role']) ?></small>
                </div>
                
                <nav class="nav flex-column">
                    <a class="nav-link active" href="<?= SITE_URL ?>dashboard">
                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                    </a>
                    <a class="nav-link" href="<?= SITE_URL ?>dashboard/profile">
                        <i class="bi bi-person me-2"></i>Mi Perfil
                    </a>
                    <a class="nav-link" href="<?= SITE_URL ?>dashboard/card">
                        <i class="bi bi-credit-card me-2"></i>Mi Tarjeta
                    </a>
                    <a class="nav-link" href="<?= SITE_URL ?>dashboard/promotions">
                        <i class="bi bi-tags me-2"></i>Promociones
                    </a>
                    <a class="nav-link" href="<?= SITE_URL ?>dashboard/businesses">
                        <i class="bi bi-shop me-2"></i>Comercios
                    </a>
                    <a class="nav-link" href="<?= SITE_URL ?>dashboard/transactions">
                        <i class="bi bi-receipt me-2"></i>Transacciones
                    </a>
                    <a class="nav-link" href="<?= SITE_URL ?>dashboard/favorites">
                        <i class="bi bi-heart me-2"></i>Favoritos
                    </a>
                </nav>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="col-md-9 col-lg-10">
            <div class="p-4">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h1 class="h3 mb-0">Bienvenido, <?= htmlspecialchars($user['full_name']) ?></h1>
                        <p class="text-muted">Gestiona tu cuenta y descubre nuevas promociones</p>
                    </div>
                    <div>
                        <span class="badge bg-success fs-6">Cuenta Activa</span>
                    </div>
                </div>
                
                <!-- Digital Card Preview -->
                <?php if ($card): ?>
                <div class="row mb-4">
                    <div class="col-lg-8">
                        <div class="card border-0 shadow">
                            <div class="card-body">
                                <h5 class="card-title">Mi Tarjeta Digital</h5>
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <div class="digital-card">
                                            <div class="d-flex justify-content-between align-items-start mb-3">
                                                <div>
                                                    <h6 class="mb-1">YEIII Platform</h6>
                                                    <small class="opacity-75">Tarjeta de Beneficios</small>
                                                </div>
                                                <span class="badge bg-light text-dark"><?= strtoupper($card['membership_level']) ?></span>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <h5 class="mb-0"><?= htmlspecialchars($user['full_name']) ?></h5>
                                                <small class="opacity-75"><?= htmlspecialchars($card['card_number']) ?></small>
                                            </div>
                                            
                                            <div class="d-flex justify-content-between align-items-end">
                                                <div>
                                                    <small class="opacity-75">Desde</small>
                                                    <div><?= date('m/Y', strtotime($card['created_at'])) ?></div>
                                                </div>
                                                <i class="bi bi-credit-card" style="font-size: 2rem; opacity: 0.3;"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <div class="qr-code">
                                            <i class="bi bi-qr-code text-dark" style="font-size: 4rem;"></i>
                                            <div class="mt-2">
                                                <small class="text-muted"><?= htmlspecialchars($card['qr_code']) ?></small>
                                            </div>
                                        </div>
                                        <a href="<?= SITE_URL ?>dashboard/card" class="btn btn-outline-primary btn-sm mt-2">
                                            Ver Detalles
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card border-0 shadow h-100">
                            <div class="card-body text-center">
                                <i class="bi bi-gift text-primary mb-3" style="font-size: 3rem;"></i>
                                <h5>Beneficios Disponibles</h5>
                                <p class="text-muted">Tienes acceso a promociones exclusivas</p>
                                <a href="<?= SITE_URL ?>dashboard/promotions" class="btn btn-primary">
                                    Ver Promociones
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                
                <!-- Quick Stats -->
                <div class="row mb-4">
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-tags text-success mb-2" style="font-size: 2rem;"></i>
                                <h5 class="mb-0"><?= count($availablePromotions) ?></h5>
                                <small class="text-muted">Promociones Disponibles</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-shop text-primary mb-2" style="font-size: 2rem;"></i>
                                <h5 class="mb-0"><?= count($featuredBusinesses) ?></h5>
                                <small class="text-muted">Comercios Destacados</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-receipt text-info mb-2" style="font-size: 2rem;"></i>
                                <h5 class="mb-0">0</h5>
                                <small class="text-muted">Transacciones</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-heart text-danger mb-2" style="font-size: 2rem;"></i>
                                <h5 class="mb-0">0</h5>
                                <small class="text-muted">Favoritos</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Available Promotions -->
                <?php if (!empty($availablePromotions)): ?>
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-0 shadow">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">Promociones Disponibles para Ti</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <?php foreach (array_slice($availablePromotions, 0, 6) as $promotion): ?>
                                    <div class="col-lg-4 col-md-6 mb-3">
                                        <div class="card border promotion-card h-100">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <h6 class="card-title"><?= htmlspecialchars($promotion['title']) ?></h6>
                                                    <?php if ($promotion['discount_type'] === 'percentage'): ?>
                                                        <span class="badge bg-success"><?= $promotion['discount_value'] ?>% OFF</span>
                                                    <?php endif; ?>
                                                </div>
                                                <p class="card-text">
                                                    <small class="text-primary">
                                                        <i class="bi bi-shop me-1"></i><?= htmlspecialchars($promotion['business_name']) ?>
                                                    </small>
                                                </p>
                                                <p class="card-text text-muted small">
                                                    <?= htmlspecialchars(substr($promotion['description'], 0, 80)) ?>...
                                                </p>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <small class="text-muted">
                                                        Hasta: <?= date('d/m/Y', strtotime($promotion['end_date'])) ?>
                                                    </small>
                                                    <a href="<?= SITE_URL ?>home/promotion/<?= $promotion['id'] ?>" class="btn btn-outline-success btn-sm">
                                                        Ver
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="text-center">
                                    <a href="<?= SITE_URL ?>dashboard/promotions" class="btn btn-primary">
                                        Ver Todas las Promociones
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                
                <!-- Featured Businesses -->
                <?php if (!empty($featuredBusinesses)): ?>
                <div class="row">
                    <div class="col-12">
                        <div class="card border-0 shadow">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">Comercios Destacados</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <?php foreach ($featuredBusinesses as $business): ?>
                                    <div class="col-lg-3 col-md-6 mb-3">
                                        <div class="card border business-card h-100">
                                            <div class="card-body text-center">
                                                <?php if ($business['logo']): ?>
                                                    <img src="<?= SITE_URL ?>public/uploads/<?= htmlspecialchars($business['logo']) ?>" 
                                                         class="mb-3" style="width: 60px; height: 60px; object-fit: cover; border-radius: 50%;" 
                                                         alt="<?= htmlspecialchars($business['business_name']) ?>">
                                                <?php else: ?>
                                                    <i class="bi bi-shop text-primary mb-3" style="font-size: 3rem;"></i>
                                                <?php endif; ?>
                                                <h6 class="card-title"><?= htmlspecialchars($business['business_name']) ?></h6>
                                                <p class="card-text">
                                                    <span class="badge bg-secondary"><?= htmlspecialchars($business['business_type']) ?></span>
                                                </p>
                                                <a href="<?= SITE_URL ?>home/business/<?= $business['id'] ?>" class="btn btn-outline-primary btn-sm">
                                                    Ver Detalles
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean();
include APP_PATH . 'views/layouts/main.php';
?>