<?php 
ob_start(); 
?>

<div class="container">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-1">Comercios Afiliados</h1>
                    <p class="text-muted">Descubre los <?= $totalBusinesses ?> comercios que forman parte de nuestra red</p>
                </div>
                <div>
                    <span class="badge bg-primary fs-6"><?= $totalBusinesses ?> Comercios</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form method="GET" action="<?= SITE_URL ?>home/businesses" class="row g-3">
                        <div class="col-md-4">
                            <label for="search" class="form-label">Buscar</label>
                            <input type="text" class="form-control" id="search" name="search" 
                                   value="<?= htmlspecialchars($search) ?>" placeholder="Nombre o descripción">
                        </div>
                        <div class="col-md-4">
                            <label for="category" class="form-label">Categoría</label>
                            <select class="form-select" id="category" name="category">
                                <option value="">Todas las categorías</option>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= htmlspecialchars($cat) ?>" <?= $category === $cat ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($cat) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">&nbsp;</label>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-search me-2"></i>Buscar
                                </button>
                                <a href="<?= SITE_URL ?>home/businesses" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-clockwise me-2"></i>Limpiar
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Business Grid -->
    <div class="row">
        <?php if (!empty($businesses)): ?>
            <?php foreach ($businesses as $business): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm business-card">
                    <?php if ($business['logo']): ?>
                        <img src="<?= SITE_URL ?>public/uploads/<?= htmlspecialchars($business['logo']) ?>" 
                             class="card-img-top" style="height: 200px; object-fit: cover;" 
                             alt="<?= htmlspecialchars($business['business_name']) ?>">
                    <?php else: ?>
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i class="bi bi-shop text-muted" style="font-size: 4rem;"></i>
                        </div>
                    <?php endif; ?>
                    
                    <div class="card-body d-flex flex-column">
                        <div class="mb-auto">
                            <h5 class="card-title fw-bold"><?= htmlspecialchars($business['business_name']) ?></h5>
                            <span class="badge bg-primary mb-2"><?= htmlspecialchars($business['business_type']) ?></span>
                            <p class="card-text text-muted">
                                <?= htmlspecialchars(substr($business['description'] ?? 'Sin descripción disponible', 0, 100)) ?>...
                            </p>
                        </div>
                        
                        <div class="mt-3">
                            <?php if ($business['phone']): ?>
                                <div class="mb-2">
                                    <small class="text-muted">
                                        <i class="bi bi-telephone me-1"></i><?= htmlspecialchars($business['phone']) ?>
                                    </small>
                                </div>
                            <?php endif; ?>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    <i class="bi bi-geo-alt me-1"></i>Ver ubicación
                                </small>
                                <a href="<?= SITE_URL ?>home/business/<?= $business['id'] ?>" class="btn btn-outline-primary btn-sm">
                                    Ver Detalles
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
                    <i class="bi bi-search text-muted mb-3" style="font-size: 4rem;"></i>
                    <h4 class="text-muted">No se encontraron comercios</h4>
                    <p class="text-muted">Intenta ajustar los filtros de búsqueda</p>
                    <a href="<?= SITE_URL ?>home/businesses" class="btn btn-primary">
                        Ver Todos los Comercios
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php if ($totalPages > 1): ?>
    <div class="row">
        <div class="col-12">
            <nav aria-label="Navegación de comercios">
                <ul class="pagination justify-content-center">
                    <!-- Previous Page -->
                    <?php if ($currentPage > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $currentPage - 1 ?>&search=<?= urlencode($search) ?>&category=<?= urlencode($category) ?>">
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
                            <a class="page-link" href="?page=1&search=<?= urlencode($search) ?>&category=<?= urlencode($category) ?>">1</a>
                        </li>
                        <?php if ($startPage > 2): ?>
                            <li class="page-item disabled">
                                <span class="page-link">...</span>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                    <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                        <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>&search=<?= urlencode($search) ?>&category=<?= urlencode($category) ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                    
                    <?php if ($endPage < $totalPages): ?>
                        <?php if ($endPage < $totalPages - 1): ?>
                            <li class="page-item disabled">
                                <span class="page-link">...</span>
                            </li>
                        <?php endif; ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $totalPages ?>&search=<?= urlencode($search) ?>&category=<?= urlencode($category) ?>"><?= $totalPages ?></a>
                        </li>
                    <?php endif; ?>
                    
                    <!-- Next Page -->
                    <?php if ($currentPage < $totalPages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $currentPage + 1 ?>&search=<?= urlencode($search) ?>&category=<?= urlencode($category) ?>">
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php 
$content = ob_get_clean();
include APP_PATH . 'views/layouts/main.php';
?>