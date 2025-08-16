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
                        <i class="bi bi-person-badge text-primary" style="font-size: 2rem;"></i>
                    </div>
                    <h6 class="text-white mt-2 mb-0"><?= htmlspecialchars($user['full_name']) ?></h6>
                    <small class="text-white-50"><?= ucfirst($user['role']) ?></small>
                </div>
                
                <nav class="nav flex-column">
                    <a class="nav-link" href="<?= SITE_URL ?>dashboard">
                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                    </a>
                    <a class="nav-link" href="<?= SITE_URL ?>dashboard/user-management">
                        <i class="bi bi-people me-2"></i>Gestión de Usuarios
                    </a>
                    <a class="nav-link" href="<?= SITE_URL ?>dashboard/business-approval">
                        <i class="bi bi-building me-2"></i>Autorización Comercios
                    </a>
                    <a class="nav-link" href="<?= SITE_URL ?>dashboard/metrics">
                        <i class="bi bi-graph-up me-2"></i>Métricas
                    </a>
                    <a class="nav-link" href="<?= SITE_URL ?>dashboard/reports">
                        <i class="bi bi-file-earmark-text me-2"></i>Informes
                    </a>
                    <a class="nav-link active" href="<?= SITE_URL ?>dashboard/charts">
                        <i class="bi bi-bar-chart me-2"></i>Gráficas
                    </a>
                    <a class="nav-link" href="<?= SITE_URL ?>dashboard/profile">
                        <i class="bi bi-person me-2"></i>Mi Perfil
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
                        <h1 class="h3 mb-0">Gráficas y Visualizaciones</h1>
                        <p class="text-muted">Visualización de datos y tendencias de la plataforma</p>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-primary" disabled>
                            <i class="bi bi-download me-1"></i>Exportar Gráficas
                        </button>
                    </div>
                </div>

                <!-- Charts Row 1 -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card border-0 shadow">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">Distribución de Usuarios por Rol</h5>
                            </div>
                            <div class="card-body">
                                <div class="text-center py-4">
                                    <div class="row">
                                        <?php foreach ($userStats as $stat): ?>
                                        <div class="col-6 mb-3">
                                            <div class="p-3 border rounded">
                                                <h4 class="text-primary"><?= $stat['count'] ?></h4>
                                                <small class="text-muted"><?= ucfirst($stat['role']) ?></small>
                                                <div class="progress mt-2" style="height: 6px;">
                                                    <div class="progress-bar bg-primary" style="width: <?= ($stat['count'] / array_sum(array_column($userStats, 'count'))) * 100 ?>%"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card border-0 shadow">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">Crecimiento de Usuarios</h5>
                            </div>
                            <div class="card-body">
                                <div class="text-center py-5">
                                    <i class="bi bi-graph-up text-muted" style="font-size: 4rem;"></i>
                                    <p class="text-muted mt-3">Gráfica de tendencias</p>
                                    <small class="text-muted">Funcionalidad disponible próximamente</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Row 2 -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="card border-0 shadow">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">Tipos de Comercios Registrados</h5>
                            </div>
                            <div class="card-body">
                                <?php if (!empty($businessTypes)): ?>
                                <div class="row">
                                    <?php foreach ($businessTypes as $type): ?>
                                    <div class="col-md-3 mb-3">
                                        <div class="text-center p-3 border rounded">
                                            <i class="bi bi-shop text-primary" style="font-size: 2rem;"></i>
                                            <h6 class="mt-2"><?= htmlspecialchars($type) ?></h6>
                                            <small class="text-muted">Categoría activa</small>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                <?php else: ?>
                                <div class="text-center py-4">
                                    <i class="bi bi-shop text-muted" style="font-size: 3rem;"></i>
                                    <p class="text-muted mt-2">No hay tipos de comercio disponibles</p>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Row 3 -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="card border-0 shadow">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">Actividad Mensual</h5>
                            </div>
                            <div class="card-body text-center py-4">
                                <i class="bi bi-calendar3 text-muted" style="font-size: 3rem;"></i>
                                <p class="text-muted mt-2">Próximamente</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card border-0 shadow">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">Promociones Populares</h5>
                            </div>
                            <div class="card-body text-center py-4">
                                <i class="bi bi-tags text-muted" style="font-size: 3rem;"></i>
                                <p class="text-muted mt-2">Próximamente</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card border-0 shadow">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">Rendimiento General</h5>
                            </div>
                            <div class="card-body text-center py-4">
                                <i class="bi bi-speedometer2 text-muted" style="font-size: 3rem;"></i>
                                <p class="text-muted mt-2">Próximamente</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean();
include APP_PATH . 'views/layouts/main.php';
?>