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
                        <i class="bi bi-shop text-success" style="font-size: 2rem;"></i>
                    </div>
                    <h6 class="text-white mt-2 mb-0"><?= htmlspecialchars($user['full_name']) ?></h6>
                    <small class="text-white-50">Comercio</small>
                </div>
                
                <nav class="nav flex-column">
                    <a class="nav-link active" href="<?= SITE_URL ?>dashboard">
                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                    </a>
                    <a class="nav-link" href="<?= SITE_URL ?>dashboard/business-management">
                        <i class="bi bi-building me-2"></i>Mi Negocio
                    </a>
                    <a class="nav-link" href="<?= SITE_URL ?>dashboard/promotions">
                        <i class="bi bi-tag me-2"></i>Promociones
                    </a>
                    <a class="nav-link" href="<?= SITE_URL ?>dashboard/transactions">
                        <i class="bi bi-receipt me-2"></i>Transacciones
                    </a>
                    <a class="nav-link" href="<?= SITE_URL ?>dashboard/analytics">
                        <i class="bi bi-graph-up me-2"></i>Análisis
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
                        <h1 class="h3 mb-0">Bienvenido, <?= htmlspecialchars($user['full_name']) ?></h1>
                        <p class="text-muted">Panel de control para tu negocio en YEIII Platform</p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="<?= SITE_URL ?>dashboard/promotions/create" class="btn btn-outline-primary">
                            <i class="bi bi-plus me-1"></i>Nueva Promoción
                        </a>
                        <a href="<?= SITE_URL ?>dashboard/analytics" class="btn btn-primary">
                            <i class="bi bi-graph-up me-1"></i>Ver Análisis
                        </a>
                    </div>
                </div>
                
                <!-- Business Status Alert -->
                <?php if (isset($business) && $business['status'] !== 'approved'): ?>
                <div class="alert alert-warning" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <strong>Estado de tu negocio:</strong> 
                    <?php if ($business['status'] === 'pending'): ?>
                        Tu negocio está pendiente de aprobación. Te notificaremos cuando sea revisado.
                    <?php elseif ($business['status'] === 'rejected'): ?>
                        Tu negocio fue rechazado. Contacta al soporte para más información.
                    <?php elseif ($business['status'] === 'suspended'): ?>
                        Tu negocio está suspendido temporalmente.
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                
                <!-- Quick Stats -->
                <div class="row mb-4">
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-tag text-primary mb-2" style="font-size: 2rem;"></i>
                                <h5 class="card-title"><?= isset($promotions) ? count($promotions) : 0 ?></h5>
                                <p class="card-text text-muted">Promociones Activas</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-people text-success mb-2" style="font-size: 2rem;"></i>
                                <h5 class="card-title">0</h5>
                                <p class="card-text text-muted">Clientes Únicos</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-receipt text-warning mb-2" style="font-size: 2rem;"></i>
                                <h5 class="card-title">0</h5>
                                <p class="card-text text-muted">Transacciones</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-currency-dollar text-info mb-2" style="font-size: 2rem;"></i>
                                <h5 class="card-title">$0</h5>
                                <p class="card-text text-muted">Ventas del Mes</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Business Information -->
                <?php if (isset($business) && $business): ?>
                <div class="row mb-4">
                    <div class="col-lg-8">
                        <div class="card border-0 shadow">
                            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Información del Negocio</h5>
                                <a href="<?= SITE_URL ?>dashboard/business-management" class="btn btn-sm btn-outline-primary">Editar</a>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Nombre:</strong> <?= htmlspecialchars($business['business_name']) ?></p>
                                        <p><strong>Tipo:</strong> <?= htmlspecialchars($business['business_type']) ?></p>
                                        <p><strong>Estado:</strong> 
                                            <span class="badge bg-<?= $business['status'] === 'approved' ? 'success' : ($business['status'] === 'pending' ? 'warning' : 'danger') ?>">
                                                <?= ucfirst($business['status']) ?>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Teléfono:</strong> <?= htmlspecialchars($business['phone'] ?? 'No registrado') ?></p>
                                        <p><strong>Dirección:</strong> <?= htmlspecialchars($business['address']) ?></p>
                                        <p><strong>RFC:</strong> <?= htmlspecialchars($business['rfc'] ?? 'No registrado') ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card border-0 shadow">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">Acciones Rápidas</h5>
                            </div>
                            <div class="card-body">
                                <a href="<?= SITE_URL ?>dashboard/promotions/create" class="btn btn-primary btn-sm w-100 mb-2">
                                    <i class="bi bi-plus me-1"></i>Crear Promoción
                                </a>
                                <a href="<?= SITE_URL ?>dashboard/transactions" class="btn btn-outline-success btn-sm w-100 mb-2">
                                    <i class="bi bi-receipt me-1"></i>Ver Transacciones
                                </a>
                                <a href="<?= SITE_URL ?>dashboard/analytics" class="btn btn-outline-info btn-sm w-100 mb-2">
                                    <i class="bi bi-graph-up me-1"></i>Análisis de Ventas
                                </a>
                                <hr>
                                <p class="text-muted small mb-2">¿Necesitas ayuda?</p>
                                <a href="mailto:soporte@yeiii.com" class="btn btn-outline-secondary btn-sm w-100">
                                    <i class="bi bi-envelope me-1"></i>Contactar Soporte
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <!-- Business Not Registered State -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-0 shadow">
                            <div class="card-body text-center py-5">
                                <i class="bi bi-building text-warning mb-3" style="font-size: 4rem;"></i>
                                <h4 class="text-warning">Negocio No Registrado</h4>
                                <p class="text-muted mb-4">
                                    Para acceder a todas las funciones del dashboard de comercio, 
                                    necesitas registrar tu negocio en nuestra plataforma.
                                </p>
                                <div class="d-flex justify-content-center gap-3">
                                    <a href="<?= SITE_URL ?>auth/register-business" class="btn btn-primary">
                                        <i class="bi bi-plus me-1"></i>Registrar Mi Negocio
                                    </a>
                                    <a href="<?= SITE_URL ?>dashboard/profile" class="btn btn-outline-secondary">
                                        <i class="bi bi-person me-1"></i>Completar Perfil
                                    </a>
                                </div>
                                <hr class="my-4">
                                <div class="row">
                                    <div class="col-md-4">
                                        <i class="bi bi-check-circle text-success mb-2" style="font-size: 2rem;"></i>
                                        <h6>Registro Gratuito</h6>
                                        <small class="text-muted">Sin costos iniciales</small>
                                    </div>
                                    <div class="col-md-4">
                                        <i class="bi bi-lightning text-warning mb-2" style="font-size: 2rem;"></i>
                                        <h6>Activación Rápida</h6>
                                        <small class="text-muted">Proceso en 24-48 horas</small>
                                    </div>
                                    <div class="col-md-4">
                                        <i class="bi bi-graph-up text-info mb-2" style="font-size: 2rem;"></i>
                                        <h6>Más Ventas</h6>
                                        <small class="text-muted">Aumenta tu visibilidad</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Recent Promotions -->
                <?php if (isset($promotions) && !empty($promotions)): ?>
                <div class="card border-0 shadow">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Promociones Recientes</h5>
                        <a href="<?= SITE_URL ?>dashboard/promotions" class="btn btn-sm btn-outline-primary">Ver Todas</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Título</th>
                                        <th>Descuento</th>
                                        <th>Vigencia</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach (array_slice($promotions, 0, 5) as $promotion): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($promotion['title']) ?></td>
                                        <td>
                                            <?php if ($promotion['discount_type'] === 'percentage'): ?>
                                                <?= $promotion['discount_value'] ?>%
                                            <?php elseif ($promotion['discount_type'] === 'fixed_amount'): ?>
                                                $<?= number_format($promotion['discount_value'], 2) ?>
                                            <?php else: ?>
                                                <?= ucfirst($promotion['discount_type']) ?>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= date('d/m/Y', strtotime($promotion['start_date'])) ?> - <?= date('d/m/Y', strtotime($promotion['end_date'])) ?></td>
                                        <td>
                                            <span class="badge bg-<?= $promotion['is_active'] ? 'success' : 'secondary' ?>">
                                                <?= $promotion['is_active'] ? 'Activa' : 'Inactiva' ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="<?= SITE_URL ?>dashboard/promotions/edit/<?= $promotion['id'] ?>" class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <div class="card border-0 shadow">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-tag text-muted mb-3" style="font-size: 3rem;"></i>
                        <h5>No tienes promociones creadas</h5>
                        <p class="text-muted mb-4">Comienza a atraer más clientes creando tu primera promoción</p>
                        <a href="<?= SITE_URL ?>dashboard/promotions/create" class="btn btn-primary">
                            <i class="bi bi-plus me-1"></i>Crear Mi Primera Promoción
                        </a>
                    </div>
                </div>
                <?php endif; ?>
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