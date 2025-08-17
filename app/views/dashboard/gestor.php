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
                        <i class="bi bi-person-gear text-warning" style="font-size: 2rem;"></i>
                    </div>
                    <h6 class="text-white mt-2 mb-0"><?= htmlspecialchars($user['full_name']) ?></h6>
                    <small class="text-white-50">Gestor - <?= htmlspecialchars($user['city'] ?? 'Sin asignar') ?></small>
                </div>
                
                <nav class="nav flex-column">
                    <a class="nav-link active" href="<?= SITE_URL ?>dashboard">
                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                    </a>
                    <a class="nav-link" href="<?= SITE_URL ?>dashboard/city-businesses">
                        <i class="bi bi-building me-2"></i>Comercios de mi Ciudad
                    </a>
                    <a class="nav-link" href="<?= SITE_URL ?>dashboard/city-users">
                        <i class="bi bi-people me-2"></i>Usuarios de mi Ciudad
                    </a>
                    <a class="nav-link" href="<?= SITE_URL ?>dashboard/city-metrics">
                        <i class="bi bi-graph-up me-2"></i>Métricas Regionales
                    </a>
                    <a class="nav-link" href="<?= SITE_URL ?>dashboard/city-reports">
                        <i class="bi bi-file-earmark-text me-2"></i>Reportes
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
                        <h1 class="h3 mb-0">Bienvenido, Gestor</h1>
                        <p class="text-muted">Panel de control regional para <?= htmlspecialchars($user['city'] ?? 'tu ciudad asignada') ?></p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="<?= SITE_URL ?>dashboard/city-reports" class="btn btn-outline-primary">
                            <i class="bi bi-download me-1"></i>Exportar Datos
                        </a>
                        <a href="<?= SITE_URL ?>dashboard/city-metrics" class="btn btn-primary">
                            <i class="bi bi-graph-up me-1"></i>Ver Métricas
                        </a>
                    </div>
                </div>
                
                <!-- City Assignment Alert -->
                <?php if (empty($user['city'])): ?>
                <div class="alert alert-warning" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <strong>Atención:</strong> No tienes una ciudad asignada. Contacta al administrador para configurar tu región.
                </div>
                <?php endif; ?>
                
                <!-- Quick Stats -->
                <div class="row mb-4">
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-building text-primary mb-2" style="font-size: 2rem;"></i>
                                <h5 class="card-title">0</h5>
                                <p class="card-text text-muted">Comercios en mi Ciudad</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-clock text-warning mb-2" style="font-size: 2rem;"></i>
                                <h5 class="card-title">0</h5>
                                <p class="card-text text-muted">Comercios Pendientes</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-people text-success mb-2" style="font-size: 2rem;"></i>
                                <h5 class="card-title">0</h5>
                                <p class="card-text text-muted">Usuarios Activos</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-receipt text-info mb-2" style="font-size: 2rem;"></i>
                                <h5 class="card-title">0</h5>
                                <p class="card-text text-muted">Transacciones del Mes</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Management Grid -->
                <div class="row mb-4">
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="card border h-100 hover-card">
                            <div class="card-body text-center">
                                <i class="bi bi-building text-primary mb-3" style="font-size: 3rem;"></i>
                                <h6>Gestión de Comercios</h6>
                                <p class="text-muted small">Aprobar y gestionar comercios de tu ciudad</p>
                                <a href="<?= SITE_URL ?>dashboard/city-businesses" class="btn btn-outline-primary btn-sm">
                                    Acceder
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="card border h-100 hover-card">
                            <div class="card-body text-center">
                                <i class="bi bi-people text-success mb-3" style="font-size: 3rem;"></i>
                                <h6>Usuarios de la Ciudad</h6>
                                <p class="text-muted small">Administrar usuarios de tu región</p>
                                <a href="<?= SITE_URL ?>dashboard/city-users" class="btn btn-outline-success btn-sm">
                                    Ver Usuarios
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="card border h-100 hover-card">
                            <div class="card-body text-center">
                                <i class="bi bi-graph-up text-info mb-3" style="font-size: 3rem;"></i>
                                <h6>Métricas Regionales</h6>
                                <p class="text-muted small">Análisis de tu región</p>
                                <a href="<?= SITE_URL ?>dashboard/city-metrics" class="btn btn-outline-info btn-sm">
                                    Ver Métricas
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="card border h-100 hover-card">
                            <div class="card-body text-center">
                                <i class="bi bi-file-earmark-text text-warning mb-3" style="font-size: 3rem;"></i>
                                <h6>Reportes Regionales</h6>
                                <p class="text-muted small">Informes de tu ciudad</p>
                                <a href="<?= SITE_URL ?>dashboard/city-reports" class="btn btn-outline-warning btn-sm">
                                    Ver Reportes
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity Summary -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card border-0 shadow">
                            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Actividad Reciente en mi Ciudad</h5>
                                <a href="<?= SITE_URL ?>dashboard/city-reports" class="btn btn-sm btn-outline-primary">Ver Todo</a>
                            </div>
                            <div class="card-body">
                                <div class="text-center py-4">
                                    <i class="bi bi-clock-history text-muted mb-3" style="font-size: 3rem;"></i>
                                    <h6>Sin actividad reciente</h6>
                                    <p class="text-muted">La actividad reciente de tu ciudad aparecerá aquí</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card border-0 shadow">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">Mi Región</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span>Ciudad Asignada</span>
                                    <span class="badge bg-primary"><?= htmlspecialchars($user['city'] ?? 'Sin asignar') ?></span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span>Estado de Cuenta</span>
                                    <span class="badge bg-success">Activa</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span>Permisos</span>
                                    <span class="text-muted small">Regional</span>
                                </div>
                                <hr>
                                <div class="text-center">
                                    <p class="text-muted small mb-2">¿Necesitas cambiar tu ciudad?</p>
                                    <a href="mailto:soporte@yeiii.com" class="btn btn-outline-secondary btn-sm">
                                        <i class="bi bi-envelope me-1"></i>Contactar Admin
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Quick Actions -->
                        <div class="card border-0 shadow mt-3">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">Acciones Rápidas</h5>
                            </div>
                            <div class="card-body">
                                <a href="<?= SITE_URL ?>dashboard/city-businesses" class="btn btn-primary btn-sm w-100 mb-2">
                                    <i class="bi bi-building me-1"></i>Gestionar Comercios
                                </a>
                                <a href="<?= SITE_URL ?>dashboard/city-users" class="btn btn-outline-success btn-sm w-100 mb-2">
                                    <i class="bi bi-people me-1"></i>Ver Usuarios
                                </a>
                                <a href="<?= SITE_URL ?>dashboard/city-metrics" class="btn btn-outline-info btn-sm w-100">
                                    <i class="bi bi-graph-up me-1"></i>Análisis Regional
                                </a>
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