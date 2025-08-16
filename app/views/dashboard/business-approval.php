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
                    <a class="nav-link active" href="<?= SITE_URL ?>dashboard/business-approval">
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
                        <h1 class="h3 mb-0">Autorización de Comercios</h1>
                        <p class="text-muted">Revisar y aprobar solicitudes de registro de comercios</p>
                    </div>
                    <div class="d-flex gap-2">
                        <span class="badge bg-warning fs-6">
                            <?= count($pendingBusinesses) ?> pendientes
                        </span>
                    </div>
                </div>

                <!-- Pending Businesses -->
                <?php if (!empty($pendingBusinesses)): ?>
                <div class="card border-0 shadow mb-4">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0">
                            <i class="bi bi-clock me-2"></i>Comercios Pendientes de Aprobación
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <?php foreach ($pendingBusinesses as $business): ?>
                        <div class="border-bottom p-3">
                            <div class="row">
                                <div class="col-md-8">
                                    <h6 class="mb-1"><?= htmlspecialchars($business['business_name']) ?></h6>
                                    <p class="text-muted mb-2">
                                        <span class="badge bg-secondary me-2"><?= htmlspecialchars($business['business_type']) ?></span>
                                        <?= htmlspecialchars($business['address']) ?>
                                    </p>
                                    <p class="mb-1"><?= htmlspecialchars($business['description'] ?? 'Sin descripción') ?></p>
                                    <small class="text-muted">
                                        Solicitado el <?= date('d/m/Y', strtotime($business['created_at'])) ?>
                                    </small>
                                </div>
                                <div class="col-md-4 text-end">
                                    <div class="btn-group">
                                        <button class="btn btn-success" disabled title="Aprobar">
                                            <i class="bi bi-check-circle me-1"></i>Aprobar
                                        </button>
                                        <button class="btn btn-danger" disabled title="Rechazar">
                                            <i class="bi bi-x-circle me-1"></i>Rechazar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php else: ?>
                <div class="card border-0 shadow mb-4">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-check-circle text-success" style="font-size: 4rem;"></i>
                        <h4 class="text-success mt-3">¡Todas las solicitudes están al día!</h4>
                        <p class="text-muted">No hay comercios pendientes de aprobación en este momento.</p>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Recent Businesses -->
                <?php if (!empty($recentBusinesses)): ?>
                <div class="card border-0 shadow">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Comercios Procesados Recientemente</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Comercio</th>
                                        <th>Tipo</th>
                                        <th>Estado</th>
                                        <th>Fecha</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($recentBusinesses as $business): ?>
                                    <tr>
                                        <td>
                                            <div>
                                                <div class="fw-bold"><?= htmlspecialchars($business['business_name']) ?></div>
                                                <small class="text-muted"><?= htmlspecialchars($business['address']) ?></small>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary">
                                                <?= htmlspecialchars($business['business_type']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-<?= $business['status'] === 'approved' ? 'success' : 
                                                                    ($business['status'] === 'rejected' ? 'danger' : 'warning') ?>">
                                                <?= ucfirst($business['status']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                <?= date('d/m/Y H:i', strtotime($business['updated_at'])) ?>
                                            </small>
                                        </td>
                                        <td>
                                            <button class="btn btn-outline-primary btn-sm" disabled title="Ver detalles">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean();
include APP_PATH . 'views/layouts/main.php';
?>