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
                    <a class="nav-link active" href="<?= SITE_URL ?>dashboard/transaction-validation">
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
                        <h1 class="h3 mb-0">Validar Transacciones</h1>
                        <p class="text-muted">Verificar y aprobar transacciones del sistema</p>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-secondary" disabled>
                            <i class="bi bi-funnel me-1"></i>Filtros
                        </button>
                        <button class="btn btn-primary" disabled>
                            <i class="bi bi-check-all me-1"></i>Validar Todas
                        </button>
                    </div>
                </div>
                
                <!-- Validation Stats -->
                <div class="row mb-4">
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
                                <i class="bi bi-check-circle text-success mb-2" style="font-size: 2rem;"></i>
                                <h5 class="card-title">0</h5>
                                <p class="card-text text-muted">Validadas Hoy</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-x-circle text-danger mb-2" style="font-size: 2rem;"></i>
                                <h5 class="card-title">0</h5>
                                <p class="card-text text-muted">Rechazadas</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-graph-up text-info mb-2" style="font-size: 2rem;"></i>
                                <h5 class="card-title">0%</h5>
                                <p class="card-text text-muted">Tasa de Validación</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Transactions to Validate -->
                <div class="card border-0 shadow">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Transacciones Pendientes de Validación</h5>
                        <div class="d-flex gap-2">
                            <select class="form-select form-select-sm" style="width: auto;">
                                <option>Todas las transacciones</option>
                                <option>Solo nuevas</option>
                                <option>Con errores</option>
                                <option>Prioritarias</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="text-center py-5">
                            <i class="bi bi-shield-check text-muted mb-3" style="font-size: 4rem;"></i>
                            <h5>Sin transacciones pendientes</h5>
                            <p class="text-muted">¡Excelente trabajo! No hay transacciones pendientes de validación en este momento.</p>
                            <div class="mt-3">
                                <button class="btn btn-outline-primary" disabled>
                                    <i class="bi bi-arrow-clockwise me-1"></i>Actualizar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Validation Guidelines -->
                <div class="row mt-4">
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-sm bg-light">
                            <div class="card-body">
                                <h6><i class="bi bi-clipboard-check text-success me-2"></i>Criterios de Validación</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <li><i class="bi bi-check text-success me-2"></i>Verificar monto y moneda</li>
                                            <li><i class="bi bi-check text-success me-2"></i>Confirmar fecha y hora</li>
                                            <li><i class="bi bi-check text-success me-2"></i>Validar comercio afiliado</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-unstyled">
                                            <li><i class="bi bi-check text-success me-2"></i>Revisar ID de usuario</li>
                                            <li><i class="bi bi-check text-success me-2"></i>Verificar promoción aplicada</li>
                                            <li><i class="bi bi-check text-success me-2"></i>Confirmar estado de la transacción</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <h6>Acciones Rápidas</h6>
                                <button class="btn btn-success btn-sm w-100 mb-2" disabled>
                                    <i class="bi bi-check-circle me-1"></i>Validar Todas Correctas
                                </button>
                                <button class="btn btn-warning btn-sm w-100 mb-2" disabled>
                                    <i class="bi bi-exclamation-triangle me-1"></i>Marcar como Dudosas
                                </button>
                                <button class="btn btn-danger btn-sm w-100" disabled>
                                    <i class="bi bi-x-circle me-1"></i>Rechazar Incorrectas
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Note about functionality -->
                <div class="alert alert-info mt-4" role="alert">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>Nota:</strong> Las transacciones aparecerán aquí cuando se configure la base de datos y se registren transacciones en el sistema.
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean();
include APP_PATH . 'views/layouts/main.php';
?>