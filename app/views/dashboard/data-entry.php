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
                    <a class="nav-link active" href="<?= SITE_URL ?>dashboard/data-entry">
                        <i class="bi bi-keyboard me-2"></i>Captura de Datos
                    </a>
                    <a class="nav-link" href="<?= SITE_URL ?>dashboard/business-entry">
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
                        <h1 class="h3 mb-0">Captura de Datos</h1>
                        <p class="text-muted">Registro de información general en la plataforma</p>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-secondary" disabled>
                            <i class="bi bi-download me-1"></i>Plantilla
                        </button>
                        <button class="btn btn-primary" disabled>
                            <i class="bi bi-plus me-1"></i>Nuevo Registro
                        </button>
                    </div>
                </div>
                
                <!-- Data Entry Options -->
                <div class="row mb-4">
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="card border h-100 hover-card" style="cursor: not-allowed; opacity: 0.7;">
                            <div class="card-body text-center">
                                <i class="bi bi-person-plus text-primary mb-3" style="font-size: 3rem;"></i>
                                <h6>Registro de Usuarios</h6>
                                <p class="text-muted small">Dar de alta nuevos usuarios en el sistema</p>
                                <button class="btn btn-outline-primary btn-sm" disabled>
                                    Acceder
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="card border h-100 hover-card" style="cursor: not-allowed; opacity: 0.7;">
                            <div class="card-body text-center">
                                <i class="bi bi-tag text-success mb-3" style="font-size: 3rem;"></i>
                                <h6>Promociones</h6>
                                <p class="text-muted small">Registrar promociones para comercios</p>
                                <button class="btn btn-outline-success btn-sm" disabled>
                                    Acceder
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="card border h-100 hover-card" style="cursor: not-allowed; opacity: 0.7;">
                            <div class="card-body text-center">
                                <i class="bi bi-credit-card text-info mb-3" style="font-size: 3rem;"></i>
                                <h6>Tarjetas Digitales</h6>
                                <p class="text-muted small">Gestionar tarjetas de usuarios</p>
                                <button class="btn btn-outline-info btn-sm" disabled>
                                    Acceder
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Active Data Entry Forms -->
                <div class="card border-0 shadow">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Herramientas de Captura</h5>
                        <small class="text-muted">Funcionalidades disponibles</small>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card border-primary">
                                    <div class="card-body text-center">
                                        <i class="bi bi-building text-primary mb-3" style="font-size: 3rem;"></i>
                                        <h5>Registro de Comercios</h5>
                                        <p class="text-muted">Dar de alta nuevos comercios en la plataforma</p>
                                        <a href="<?= SITE_URL ?>dashboard/business-entry/new" class="btn btn-primary">
                                            <i class="bi bi-plus me-1"></i>Registrar Comercio
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-info">
                                    <div class="card-body text-center">
                                        <i class="bi bi-check-square text-info mb-3" style="font-size: 3rem;"></i>
                                        <h5>Validación de Datos</h5>
                                        <p class="text-muted">Verificar y validar información registrada</p>
                                        <a href="<?= SITE_URL ?>dashboard/transaction-validation" class="btn btn-info">
                                            <i class="bi bi-check-circle me-1"></i>Validar Datos
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Instructions -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm bg-light">
                            <div class="card-body">
                                <h6><i class="bi bi-info-circle text-primary me-2"></i>Instrucciones de Captura</h6>
                                <ol class="mb-0">
                                    <li><strong>Verificar información:</strong> Asegúrate de que todos los datos estén completos y sean correctos.</li>
                                    <li><strong>Documentación:</strong> Revisa que se tengan todos los documentos necesarios.</li>
                                    <li><strong>Validación:</strong> Confirma la información antes de guardar.</li>
                                    <li><strong>Seguimiento:</strong> Registra el progreso en "Mi Trabajo".</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Note about functionality -->
                <div class="alert alert-info mt-4" role="alert">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>Nota:</strong> Algunas funcionalidades adicionales de captura estarán disponibles cuando se configure completamente la base de datos.
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