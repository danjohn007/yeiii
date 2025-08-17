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
                        <i class="bi bi-keyboard text-info" style="font-size: 2rem;"></i>
                    </div>
                    <h6 class="text-white mt-2 mb-0"><?= htmlspecialchars($user['full_name']) ?></h6>
                    <small class="text-white-50">Capturista</small>
                </div>
                
                <nav class="nav flex-column">
                    <a class="nav-link" href="<?= SITE_URL ?>dashboard">
                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                    </a>
                    <a class="nav-link" href="<?= SITE_URL ?>dashboard/data-entry">
                        <i class="bi bi-keyboard me-2"></i>Captura de Datos
                    </a>
                    <a class="nav-link active" href="<?= SITE_URL ?>dashboard/business-entry">
                        <i class="bi bi-building me-2"></i>Registro de Comercios
                    </a>
                    <a class="nav-link" href="<?= SITE_URL ?>dashboard/transaction-validation">
                        <i class="bi bi-check-circle me-2"></i>Validar Transacciones
                    </a>
                    <a class="nav-link" href="<?= SITE_URL ?>dashboard/my-work">
                        <i class="bi bi-clipboard-data me-2"></i>Mi Trabajo
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
                        <h1 class="h3 mb-0">Registro de Comercios</h1>
                        <p class="text-muted">Dar de alta nuevos comercios en la plataforma</p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="<?= SITE_URL ?>dashboard/business-entry/new" class="btn btn-primary">
                            <i class="bi bi-plus me-1"></i>Registrar Nuevo Comercio
                        </a>
                    </div>
                </div>
                
                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-building text-primary mb-2" style="font-size: 2rem;"></i>
                                <h5 class="card-title">0</h5>
                                <p class="card-text text-muted">Registrados Hoy</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-calendar-week text-success mb-2" style="font-size: 2rem;"></i>
                                <h5 class="card-title">0</h5>
                                <p class="card-text text-muted">Esta Semana</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-calendar-month text-info mb-2" style="font-size: 2rem;"></i>
                                <h5 class="card-title">0</h5>
                                <p class="card-text text-muted">Este Mes</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-check-circle text-warning mb-2" style="font-size: 2rem;"></i>
                                <h5 class="card-title">0</h5>
                                <p class="card-text text-muted">Total Personal</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Registrations -->
                <div class="card border-0 shadow">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Registros Recientes</h5>
                        <a href="<?= SITE_URL ?>dashboard/my-work" class="btn btn-sm btn-outline-primary">Ver Historial</a>
                    </div>
                    <div class="card-body">
                        <div class="text-center py-5">
                            <i class="bi bi-clipboard-plus text-muted mb-3" style="font-size: 4rem;"></i>
                            <h5>Sin registros recientes</h5>
                            <p class="text-muted">Los comercios que registres aparecerán aquí.</p>
                            <a href="<?= SITE_URL ?>dashboard/business-entry/new" class="btn btn-primary">
                                <i class="bi bi-plus me-1"></i>Registrar Primer Comercio
                            </a>
                            <div class="alert alert-info mt-3" role="alert">
                                <i class="bi bi-info-circle me-2"></i>
                                <strong>Nota:</strong> Esta funcionalidad estará completamente operativa cuando se configure la base de datos.
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