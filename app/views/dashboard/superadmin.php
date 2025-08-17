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
                    <a class="nav-link active" href="<?= SITE_URL ?>dashboard">
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
                        <h1 class="h3 mb-0">Bienvenido, Super Administrador</h1>
                        <p class="text-muted">Panel de control y administración de la plataforma UFF!</p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="<?= SITE_URL ?>dashboard/reports" class="btn btn-outline-primary">
                            <i class="bi bi-download me-1"></i>Exportar Datos
                        </a>
                        <a href="<?= SITE_URL ?>dashboard/metrics" class="btn btn-primary">
                            <i class="bi bi-graph-up me-1"></i>Ver Métricas
                        </a>
                    </div>
                </div>
                
                <!-- Quick Stats -->
                <div class="row mb-4">
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-people text-primary mb-2" style="font-size: 2rem;"></i>
                                <h5 class="mb-0"><?= number_format($stats['totalUsers']) ?></h5>
                                <small class="text-muted">Usuarios Totales</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-shop text-success mb-2" style="font-size: 2rem;"></i>
                                <h5 class="mb-0"><?= number_format($stats['totalBusinesses']) ?></h5>
                                <small class="text-muted">Comercios Aprobados</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-tags text-info mb-2" style="font-size: 2rem;"></i>
                                <h5 class="mb-0"><?= number_format($stats['totalPromotions']) ?></h5>
                                <small class="text-muted">Promociones Activas</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-credit-card text-warning mb-2" style="font-size: 2rem;"></i>
                                <h5 class="mb-0"><?= number_format($stats['totalCards']) ?></h5>
                                <small class="text-muted">Tarjetas Digitales</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Actions -->
                <?php if ($stats['pendingBusinesses'] > 0): ?>
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            <div>
                                <strong>Atención:</strong> Hay <?= $stats['pendingBusinesses'] ?> comercio(s) pendiente(s) de aprobación.
                                <a href="<?= SITE_URL ?>dashboard/business-approval" class="alert-link ms-2">Revisar ahora</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                
                <!-- Quick Actions -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-0 shadow">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">Acciones Rápidas</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 mb-3">
                                        <div class="card border h-100 hover-card">
                                            <div class="card-body text-center">
                                                <i class="bi bi-people text-primary mb-3" style="font-size: 3rem;"></i>
                                                <h6>Gestión de Usuarios</h6>
                                                <p class="text-muted small">Administrar cuentas y roles de usuarios</p>
                                                <a href="<?= SITE_URL ?>dashboard/user-management" class="btn btn-outline-primary btn-sm">
                                                    Acceder
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 mb-3">
                                        <div class="card border h-100 hover-card">
                                            <div class="card-body text-center">
                                                <i class="bi bi-building text-success mb-3" style="font-size: 3rem;"></i>
                                                <h6>Autorización de Comercios</h6>
                                                <p class="text-muted small">Aprobar o rechazar solicitudes</p>
                                                <a href="<?= SITE_URL ?>dashboard/business-approval" class="btn btn-outline-success btn-sm">
                                                    Revisar <?= $stats['pendingBusinesses'] > 0 ? "({$stats['pendingBusinesses']})" : '' ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 mb-3">
                                        <div class="card border h-100 hover-card">
                                            <div class="card-body text-center">
                                                <i class="bi bi-graph-up text-info mb-3" style="font-size: 3rem;"></i>
                                                <h6>Métricas Detalladas</h6>
                                                <p class="text-muted small">Análisis profundo de la plataforma</p>
                                                <a href="<?= SITE_URL ?>dashboard/metrics" class="btn btn-outline-info btn-sm">
                                                    Ver Métricas
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 mb-3">
                                        <div class="card border h-100 hover-card">
                                            <div class="card-body text-center">
                                                <i class="bi bi-bar-chart text-warning mb-3" style="font-size: 3rem;"></i>
                                                <h6>Gráficas y Reportes</h6>
                                                <p class="text-muted small">Visualización de datos y tendencias</p>
                                                <a href="<?= SITE_URL ?>dashboard/charts" class="btn btn-outline-warning btn-sm">
                                                    Ver Gráficas
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity Summary -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card border-0 shadow">
                            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Resumen de Actividad</h5>
                                <a href="<?= SITE_URL ?>dashboard/reports" class="btn btn-sm btn-outline-primary">Ver Todo</a>
                            </div>
                            <div class="card-body">
                                <!-- Simple statistics table instead of chart -->
                                <div class="row text-center">
                                    <div class="col-3">
                                        <div class="p-3">
                                            <div class="h4 text-primary"><?= number_format($stats['totalUsers']) ?></div>
                                            <small class="text-muted">Usuarios</small>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="p-3">
                                            <div class="h4 text-success"><?= number_format($stats['totalBusinesses']) ?></div>
                                            <small class="text-muted">Comercios</small>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="p-3">
                                            <div class="h4 text-info"><?= number_format($stats['totalPromotions']) ?></div>
                                            <small class="text-muted">Promociones</small>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="p-3">
                                            <div class="h4 text-warning"><?= number_format($stats['totalCards']) ?></div>
                                            <small class="text-muted">Tarjetas</small>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="text-center">
                                    <p class="text-muted mb-0">Sistema funcionando correctamente</p>
                                    <small class="text-success">
                                        <i class="bi bi-check-circle me-1"></i>
                                        Todos los servicios operativos
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card border-0 shadow">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">Sistema</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span>Estado del Sistema</span>
                                    <span class="badge bg-success">Operativo</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span>Base de Datos</span>
                                    <span class="badge bg-success">Conectada</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span>Último Backup</span>
                                    <span class="text-muted small">Hoy</span>
                                </div>
                                <hr>
                                <div class="text-center">
                                    <button class="btn btn-outline-secondary btn-sm" disabled>
                                        <i class="bi bi-gear me-1"></i>Configuración
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.hover-card {
    transition: transform 0.2s ease-in-out;
}
.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}
</style>



<?php 
$content = ob_get_clean();
include APP_PATH . 'views/layouts/main.php';
?>