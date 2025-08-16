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
                    <a class="nav-link active" href="<?= SITE_URL ?>dashboard/metrics">
                        <i class="bi bi-graph-up me-2"></i>Métricas
                    </a>
                    <a class="nav-link" href="<?= SITE_URL ?>dashboard/reports">
                        <i class="bi bi-file-earmark-text me-2"></i>Informes
                    </a>
                    <a class="nav-link" href="<?= SITE_URL ?>dashboard/charts">
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
                        <h1 class="h3 mb-0">Métricas Detalladas</h1>
                        <p class="text-muted">Análisis profundo de la plataforma YEIII</p>
                    </div>
                </div>

                <!-- User Statistics -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-0 shadow">
                            <div class="card-header bg-white">
                                <h5 class="mb-0"><i class="bi bi-people me-2"></i>Estadísticas de Usuarios</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <?php foreach ($userStats as $stat): ?>
                                    <div class="col-md-3 mb-3">
                                        <div class="text-center p-3 border rounded">
                                            <h3 class="text-primary"><?= number_format($stat['count']) ?></h3>
                                            <p class="mb-1"><?= ucfirst($stat['role']) ?></p>
                                            <small class="text-success"><?= $stat['active_count'] ?> activos</small>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Business Statistics -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card border-0 shadow">
                            <div class="card-header bg-white">
                                <h5 class="mb-0"><i class="bi bi-shop me-2"></i>Estadísticas de Comercios</h5>
                            </div>
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-6 mb-3">
                                        <h4 class="text-success"><?= number_format($businessStats['approved']) ?></h4>
                                        <small>Aprobados</small>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h4 class="text-warning"><?= number_format($businessStats['pending']) ?></h4>
                                        <small>Pendientes</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 shadow">
                            <div class="card-header bg-white">
                                <h5 class="mb-0"><i class="bi bi-tags me-2"></i>Estadísticas de Promociones</h5>
                            </div>
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-6 mb-3">
                                        <h4 class="text-info"><?= number_format($promotionStats['active']) ?></h4>
                                        <small>Activas</small>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <h4 class="text-primary"><?= number_format($promotionStats['featured']) ?></h4>
                                        <small>Destacadas</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Statistics -->
                <div class="row">
                    <div class="col-12">
                        <div class="card border-0 shadow">
                            <div class="card-header bg-white">
                                <h5 class="mb-0"><i class="bi bi-credit-card me-2"></i>Estadísticas de Tarjetas Digitales</h5>
                            </div>
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-md-3">
                                        <h4 class="text-primary"><?= number_format($cardStats['total']) ?></h4>
                                        <small>Total</small>
                                    </div>
                                    <div class="col-md-3">
                                        <h4 class="text-secondary"><?= number_format($cardStats['free']) ?></h4>
                                        <small>Gratuitas</small>
                                    </div>
                                    <div class="col-md-3">
                                        <h4 class="text-warning"><?= number_format($cardStats['premium']) ?></h4>
                                        <small>Premium</small>
                                    </div>
                                    <div class="col-md-3">
                                        <h4 class="text-success"><?= number_format($cardStats['vip']) ?></h4>
                                        <small>VIP</small>
                                    </div>
                                </div>
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