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
                    <small class="text-white-50">Gestor - <?= htmlspecialchars($city) ?></small>
                </div>
                
                <nav class="nav flex-column">
                    <a class="nav-link" href="<?= SITE_URL ?>dashboard">
                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                    </a>
                    <a class="nav-link active" href="<?= SITE_URL ?>dashboard/city-businesses">
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
                        <h1 class="h3 mb-0">Comercios de <?= htmlspecialchars($city) ?></h1>
                        <p class="text-muted">Gestión de comercios en tu región asignada</p>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-primary" disabled>
                            <i class="bi bi-download me-1"></i>Exportar
                        </button>
                        <button class="btn btn-primary" disabled>
                            <i class="bi bi-plus me-1"></i>Nuevo Comercio
                        </button>
                    </div>
                </div>
                
                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-building text-primary mb-2" style="font-size: 2rem;"></i>
                                <h5 class="card-title">0</h5>
                                <p class="card-text text-muted">Total Comercios</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-check-circle text-success mb-2" style="font-size: 2rem;"></i>
                                <h5 class="card-title">0</h5>
                                <p class="card-text text-muted">Aprobados</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-clock text-warning mb-2" style="font-size: 2rem;"></i>
                                <h5 class="card-title">0</h5>
                                <p class="card-text text-muted">Pendientes</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-x-circle text-danger mb-2" style="font-size: 2rem;"></i>
                                <h5 class="card-title">0</h5>
                                <p class="card-text text-muted">Rechazados</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Business List -->
                <div class="card border-0 shadow">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Lista de Comercios</h5>
                        <div class="d-flex gap-2">
                            <select class="form-select form-select-sm" style="width: auto;">
                                <option>Todos los estados</option>
                                <option>Aprobados</option>
                                <option>Pendientes</option>
                                <option>Rechazados</option>
                            </select>
                            <input type="search" class="form-control form-control-sm" placeholder="Buscar..." style="width: 200px;">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="text-center py-5">
                            <i class="bi bi-building text-muted mb-3" style="font-size: 4rem;"></i>
                            <h5>Sin comercios registrados</h5>
                            <p class="text-muted">Los comercios de <?= htmlspecialchars($city) ?> aparecerán aquí cuando se registren.</p>
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