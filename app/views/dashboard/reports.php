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
                    <a class="nav-link active" href="<?= SITE_URL ?>dashboard/reports">
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
                        <h1 class="h3 mb-0">Informes y Reportes</h1>
                        <p class="text-muted">Generar y exportar reportes de la plataforma</p>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-primary" disabled>
                            <i class="bi bi-calendar me-1"></i>Programar Reporte
                        </button>
                    </div>
                </div>

                <!-- Available Reports -->
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card border-0 shadow h-100">
                            <div class="card-header bg-white">
                                <h5 class="mb-0"><i class="bi bi-people me-2"></i>Reporte de Usuarios</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">Exportar lista completa de usuarios con detalles de registro y actividad.</p>
                                <ul class="list-unstyled small text-muted">
                                    <li><i class="bi bi-check text-success me-1"></i>Información personal</li>
                                    <li><i class="bi bi-check text-success me-1"></i>Fechas de registro</li>
                                    <li><i class="bi bi-check text-success me-1"></i>Estado de verificación</li>
                                    <li><i class="bi bi-check text-success me-1"></i>Roles y permisos</li>
                                </ul>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-success btn-sm" disabled>
                                        <i class="bi bi-file-excel me-1"></i>Excel
                                    </button>
                                    <button class="btn btn-danger btn-sm" disabled>
                                        <i class="bi bi-file-pdf me-1"></i>PDF
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <div class="card border-0 shadow h-100">
                            <div class="card-header bg-white">
                                <h5 class="mb-0"><i class="bi bi-shop me-2"></i>Reporte de Comercios</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">Exportar datos de comercios registrados y su estado de aprobación.</p>
                                <ul class="list-unstyled small text-muted">
                                    <li><i class="bi bi-check text-success me-1"></i>Información del negocio</li>
                                    <li><i class="bi bi-check text-success me-1"></i>Estado de aprobación</li>
                                    <li><i class="bi bi-check text-success me-1"></i>Datos de contacto</li>
                                    <li><i class="bi bi-check text-success me-1"></i>Categorías y ubicación</li>
                                </ul>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-success btn-sm" disabled>
                                        <i class="bi bi-file-excel me-1"></i>Excel
                                    </button>
                                    <button class="btn btn-danger btn-sm" disabled>
                                        <i class="bi bi-file-pdf me-1"></i>PDF
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <div class="card border-0 shadow h-100">
                            <div class="card-header bg-white">
                                <h5 class="mb-0"><i class="bi bi-tags me-2"></i>Reporte de Promociones</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">Analizar el rendimiento y efectividad de las promociones activas.</p>
                                <ul class="list-unstyled small text-muted">
                                    <li><i class="bi bi-check text-success me-1"></i>Promociones activas</li>
                                    <li><i class="bi bi-check text-success me-1"></i>Fechas de vigencia</li>
                                    <li><i class="bi bi-check text-success me-1"></i>Tipos de descuento</li>
                                    <li><i class="bi bi-check text-success me-1"></i>Comercios participantes</li>
                                </ul>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-success btn-sm" disabled>
                                        <i class="bi bi-file-excel me-1"></i>Excel
                                    </button>
                                    <button class="btn btn-danger btn-sm" disabled>
                                        <i class="bi bi-file-pdf me-1"></i>PDF
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <div class="card border-0 shadow h-100">
                            <div class="card-header bg-white">
                                <h5 class="mb-0"><i class="bi bi-credit-card me-2"></i>Reporte de Tarjetas</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">Estadísticas y detalles de las tarjetas digitales emitidas.</p>
                                <ul class="list-unstyled small text-muted">
                                    <li><i class="bi bi-check text-success me-1"></i>Tarjetas emitidas</li>
                                    <li><i class="bi bi-check text-success me-1"></i>Niveles de membresía</li>
                                    <li><i class="bi bi-check text-success me-1"></i>Estado de activación</li>
                                    <li><i class="bi bi-check text-success me-1"></i>Usuarios asociados</li>
                                </ul>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-success btn-sm" disabled>
                                        <i class="bi bi-file-excel me-1"></i>Excel
                                    </button>
                                    <button class="btn btn-danger btn-sm" disabled>
                                        <i class="bi bi-file-pdf me-1"></i>PDF
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Report History -->
                <div class="card border-0 shadow">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Historial de Reportes</h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center py-4">
                            <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-2">No hay reportes generados aún</p>
                            <small class="text-muted">Los reportes que generes aparecerán aquí para su descarga.</small>
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