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
                    <a class="nav-link" href="<?= SITE_URL ?>dashboard/business-entry">
                        <i class="bi bi-building me-2"></i>Registro de Comercios
                    </a>
                    <a class="nav-link" href="<?= SITE_URL ?>dashboard/transaction-validation">
                        <i class="bi bi-check-circle me-2"></i>Validar Transacciones
                    </a>
                    <a class="nav-link active" href="<?= SITE_URL ?>dashboard/my-work">
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
                        <h1 class="h3 mb-0">Mi Trabajo</h1>
                        <p class="text-muted">Historial y estadísticas de tu trabajo de captura</p>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-primary" disabled>
                            <i class="bi bi-download me-1"></i>Exportar
                        </button>
                        <a href="<?= SITE_URL ?>dashboard/business-entry/new" class="btn btn-primary">
                            <i class="bi bi-plus me-1"></i>Nuevo Registro
                        </a>
                    </div>
                </div>
                
                <!-- Performance Stats -->
                <div class="row mb-4">
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-calendar-day text-primary mb-2" style="font-size: 2rem;"></i>
                                <h5 class="card-title">0</h5>
                                <p class="card-text text-muted">Registros Hoy</p>
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 0%"></div>
                                </div>
                                <small class="text-muted">Meta: 5 por día</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-calendar-week text-success mb-2" style="font-size: 2rem;"></i>
                                <h5 class="card-title">0</h5>
                                <p class="card-text text-muted">Esta Semana</p>
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 0%"></div>
                                </div>
                                <small class="text-muted">Meta: 25 por semana</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-calendar-month text-info mb-2" style="font-size: 2rem;"></i>
                                <h5 class="card-title">0</h5>
                                <p class="card-text text-muted">Este Mes</p>
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 0%"></div>
                                </div>
                                <small class="text-muted">Meta: 100 por mes</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-trophy text-warning mb-2" style="font-size: 2rem;"></i>
                                <h5 class="card-title">0</h5>
                                <p class="card-text text-muted">Total Personal</p>
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 0%"></div>
                                </div>
                                <small class="text-muted">¡Sigue trabajando!</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Work History -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card border-0 shadow">
                            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Historial de Trabajo</h5>
                                <div class="d-flex gap-2">
                                    <select class="form-select form-select-sm" style="width: auto;">
                                        <option>Últimos 7 días</option>
                                        <option>Últimos 30 días</option>
                                        <option>Este mes</option>
                                        <option>Mes anterior</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="text-center py-5">
                                    <i class="bi bi-clipboard-data text-muted mb-3" style="font-size: 4rem;"></i>
                                    <h5>Sin actividad registrada</h5>
                                    <p class="text-muted">Tu historial de trabajo aparecerá aquí cuando comiences a registrar datos.</p>
                                    <a href="<?= SITE_URL ?>dashboard/business-entry/new" class="btn btn-primary">
                                        <i class="bi bi-plus me-1"></i>Comenzar a Trabajar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <!-- Performance Chart -->
                        <div class="card border-0 shadow mb-3">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">Rendimiento Semanal</h5>
                            </div>
                            <div class="card-body text-center">
                                <i class="bi bi-bar-chart text-muted mb-3" style="font-size: 3rem;"></i>
                                <p class="text-muted">Gráfica disponible con datos</p>
                            </div>
                        </div>
                        
                        <!-- Quick Actions -->
                        <div class="card border-0 shadow">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">Acciones Rápidas</h5>
                            </div>
                            <div class="card-body">
                                <a href="<?= SITE_URL ?>dashboard/business-entry/new" class="btn btn-primary btn-sm w-100 mb-2">
                                    <i class="bi bi-building me-1"></i>Registrar Comercio
                                </a>
                                <a href="<?= SITE_URL ?>dashboard/data-entry" class="btn btn-outline-info btn-sm w-100 mb-2">
                                    <i class="bi bi-keyboard me-1"></i>Captura de Datos
                                </a>
                                <a href="<?= SITE_URL ?>dashboard/transaction-validation" class="btn btn-outline-success btn-sm w-100">
                                    <i class="bi bi-check-circle me-1"></i>Validar Transacciones
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Note about functionality -->
                <div class="alert alert-info mt-4" role="alert">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>Nota:</strong> Las estadísticas y el historial se actualizarán automáticamente cuando se configure la base de datos y comiences a registrar datos.
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean();
include APP_PATH . 'views/layouts/main.php';
?>