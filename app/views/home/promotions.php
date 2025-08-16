<?php 
ob_start(); 
?>

<div class="container">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-1">Promociones Activas</h1>
                    <p class="text-muted">Descubre las <?= $totalPromotions ?> promociones disponibles</p>
                </div>
                <div>
                    <span class="badge bg-success fs-6"><?= $totalPromotions ?> Ofertas</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form method="GET" action="<?= SITE_URL ?>home/promotions" class="row g-3">
                        <div class="col-md-5">
                            <label for="search" class="form-label">Buscar</label>
                            <input type="text" class="form-control" id="search" name="search" 
                                   value="<?= htmlspecialchars($search) ?>" placeholder="Título o descripción">
                        </div>
                        <div class="col-md-4">
                            <label for="business" class="form-label">Comercio</label>
                            <select class="form-select" id="business" name="business">
                                <option value="">Todos los comercios</option>
                                <?php foreach ($businesses as $biz): ?>
                                    <option value="<?= $biz['id'] ?>" <?= $business == $biz['id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($biz['business_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">&nbsp;</label>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-search me-2"></i>Buscar
                                </button>
                                <a href="<?= SITE_URL ?>home/promotions" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-clockwise me-2"></i>Limpiar
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Promotions Grid -->
    <div class="row">
        <?php if (!empty($promotions)): ?>
            <?php foreach ($promotions as $promotion): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm promotion-card <?= $promotion['is_featured'] ? 'featured' : '' ?>">
                    <?php if ($promotion['image']): ?>
                        <img src="<?= SITE_URL ?>public/uploads/<?= htmlspecialchars($promotion['image']) ?>" 
                             class="card-img-top" style="height: 200px; object-fit: cover;" 
                             alt="<?= htmlspecialchars($promotion['title']) ?>">
                    <?php else: ?>
                        <div class="card-img-top bg-gradient bg-success d-flex align-items-center justify-content-center text-white" style="height: 200px;">
                            <div class="text-center">
                                <i class="bi bi-percent display-4 mb-2"></i>
                                <h3 class="fw-bold">
                                    <?php if ($promotion['discount_type'] === 'percentage'): ?>
                                        <?= $promotion['discount_value'] ?>% OFF
                                    <?php elseif ($promotion['discount_type'] === 'fixed_amount'): ?>
                                        $<?= number_format($promotion['discount_value'], 2) ?> OFF
                                    <?php else: ?>
                                        OFERTA ESPECIAL
                                    <?php endif; ?>
                                </h3>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <div class="card-body d-flex flex-column">
                        <div class="mb-auto">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title fw-bold"><?= htmlspecialchars($promotion['title']) ?></h5>
                                <?php if ($promotion['is_featured']): ?>
                                    <span class="badge bg-warning">Destacada</span>
                                <?php endif; ?>
                            </div>
                            
                            <p class="card-text">
                                <small class="text-primary fw-bold">
                                    <i class="bi bi-shop me-1"></i><?= htmlspecialchars($promotion['business_name']) ?>
                                </small>
                            </p>
                            
                            <p class="card-text text-muted">
                                <?= htmlspecialchars(substr($promotion['description'], 0, 100)) ?>...
                            </p>
                            
                            <!-- Discount Info -->
                            <div class="mb-2">
                                <?php if ($promotion['discount_type'] === 'percentage'): ?>
                                    <span class="badge bg-success fs-6"><?= $promotion['discount_value'] ?>% de descuento</span>
                                <?php elseif ($promotion['discount_type'] === 'fixed_amount'): ?>
                                    <span class="badge bg-success fs-6">$<?= number_format($promotion['discount_value'], 2) ?> de descuento</span>
                                <?php elseif ($promotion['discount_type'] === 'buy_one_get_one'): ?>
                                    <span class="badge bg-info fs-6">2x1</span>
                                <?php else: ?>
                                    <span class="badge bg-warning fs-6">Oferta especial</span>
                                <?php endif; ?>
                                
                                <?php if ($promotion['membership_required'] !== 'free'): ?>
                                    <span class="badge bg-warning text-dark">
                                        <?= strtoupper($promotion['membership_required']) ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Minimum Purchase -->
                            <?php if ($promotion['minimum_purchase'] > 0): ?>
                                <small class="text-muted">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Compra mínima: $<?= number_format($promotion['minimum_purchase'], 2) ?>
                                </small>
                            <?php endif; ?>
                        </div>
                        
                        <div class="mt-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <small class="text-muted">
                                    <i class="bi bi-calendar me-1"></i>
                                    Válida hasta: <?= date('d/m/Y', strtotime($promotion['end_date'])) ?>
                                </small>
                            </div>
                            
                            <!-- Usage Info -->
                            <div class="progress mb-2" style="height: 5px;">
                                <?php 
                                $usagePercent = $promotion['total_max_uses'] > 0 
                                    ? ($promotion['current_uses'] / $promotion['total_max_uses']) * 100 
                                    : 0;
                                ?>
                                <div class="progress-bar bg-warning" style="width: <?= $usagePercent ?>%"></div>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <?= $promotion['current_uses'] ?> usos
                                    <?php if ($promotion['total_max_uses']): ?>
                                        / <?= $promotion['total_max_uses'] ?>
                                    <?php endif; ?>
                                </small>
                                <a href="<?= SITE_URL ?>home/promotion/<?= $promotion['id'] ?>" class="btn btn-outline-success btn-sm">
                                    Ver Detalle
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="bi bi-tags text-muted mb-3" style="font-size: 4rem;"></i>
                    <h4 class="text-muted">No se encontraron promociones</h4>
                    <p class="text-muted">Intenta ajustar los filtros de búsqueda</p>
                    <a href="<?= SITE_URL ?>home/promotions" class="btn btn-success">
                        Ver Todas las Promociones
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php if ($totalPages > 1): ?>
    <div class="row">
        <div class="col-12">
            <nav aria-label="Navegación de promociones">
                <ul class="pagination justify-content-center">
                    <!-- Previous Page -->
                    <?php if ($currentPage > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $currentPage - 1 ?>&search=<?= urlencode($search) ?>&business=<?= urlencode($business) ?>">
                                <i class="bi bi-chevron-left"></i>
                            </a>
                        </li>
                    <?php endif; ?>
                    
                    <!-- Page Numbers -->
                    <?php 
                    $startPage = max(1, $currentPage - 2);
                    $endPage = min($totalPages, $currentPage + 2);
                    ?>
                    
                    <?php if ($startPage > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=1&search=<?= urlencode($search) ?>&business=<?= urlencode($business) ?>">1</a>
                        </li>
                        <?php if ($startPage > 2): ?>
                            <li class="page-item disabled">
                                <span class="page-link">...</span>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                    <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                        <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>&search=<?= urlencode($search) ?>&business=<?= urlencode($business) ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                    
                    <?php if ($endPage < $totalPages): ?>
                        <?php if ($endPage < $totalPages - 1): ?>
                            <li class="page-item disabled">
                                <span class="page-link">...</span>
                            </li>
                        <?php endif; ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $totalPages ?>&search=<?= urlencode($search) ?>&business=<?= urlencode($business) ?>"><?= $totalPages ?></a>
                        </li>
                    <?php endif; ?>
                    
                    <!-- Next Page -->
                    <?php if ($currentPage < $totalPages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $currentPage + 1 ?>&search=<?= urlencode($search) ?>&business=<?= urlencode($business) ?>">
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
    <?php endif; ?>

    <!-- Call to Action -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card bg-primary text-white text-center">
                <div class="card-body py-4">
                    <h4 class="fw-bold mb-3">¿Listo para empezar a ahorrar?</h4>
                    <p class="mb-3">Regístrate gratis y accede a todas estas promociones exclusivas</p>
                    <?php if (!isset($_SESSION['user_id'])): ?>
                        <a href="<?= SITE_URL ?>auth/register" class="btn btn-light btn-lg">
                            <i class="bi bi-person-plus me-2"></i>Registrarse Gratis
                        </a>
                    <?php else: ?>
                        <a href="<?= SITE_URL ?>dashboard" class="btn btn-light btn-lg">
                            <i class="bi bi-speedometer2 me-2"></i>Ir al Dashboard
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean();
include APP_PATH . 'views/layouts/main.php';
?>