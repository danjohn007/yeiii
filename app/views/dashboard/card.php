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
                        <i class="bi bi-person-circle text-primary" style="font-size: 2rem;"></i>
                    </div>
                    <h6 class="text-white mt-2 mb-0"><?= htmlspecialchars($user['full_name']) ?></h6>
                    <small class="text-white-50"><?= ucfirst($user['role']) ?></small>
                </div>
                
                <nav class="nav flex-column">
                    <a class="nav-link" href="<?= SITE_URL ?>dashboard">
                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                    </a>
                    <a class="nav-link" href="<?= SITE_URL ?>dashboard/profile">
                        <i class="bi bi-person me-2"></i>Mi Perfil
                    </a>
                    <a class="nav-link active" href="<?= SITE_URL ?>dashboard/card">
                        <i class="bi bi-credit-card me-2"></i>Mi Tarjeta
                    </a>
                    <a class="nav-link" href="<?= SITE_URL ?>dashboard/promotions">
                        <i class="bi bi-tags me-2"></i>Promociones
                    </a>
                    <a class="nav-link" href="<?= SITE_URL ?>dashboard/businesses">
                        <i class="bi bi-shop me-2"></i>Comercios
                    </a>
                    <a class="nav-link" href="<?= SITE_URL ?>dashboard/transactions">
                        <i class="bi bi-receipt me-2"></i>Transacciones
                    </a>
                    <a class="nav-link" href="<?= SITE_URL ?>dashboard/favorites">
                        <i class="bi bi-heart me-2"></i>Favoritos
                    </a>
                </nav>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="col-md-9 col-lg-10">
            <div class="p-4">
                <!-- Header -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h1 class="h3 mb-1">Mi Tarjeta Digital</h1>
                        <p class="text-muted">Gestiona tu tarjeta de beneficios YEIII</p>
                    </div>
                </div>

                <?php if ($card): ?>
                <!-- Digital Card Display -->
                <div class="row mb-4">
                    <div class="col-lg-8">
                        <div class="card border-0 shadow">
                            <div class="card-body p-0">
                                <!-- Card Front -->
                                <div class="digital-card m-4">
                                    <div class="row align-items-center h-100">
                                        <div class="col-md-8">
                                            <div class="d-flex justify-content-between align-items-start mb-4">
                                                <div>
                                                    <h4 class="mb-1 fw-bold">YEIII Platform</h4>
                                                    <small class="opacity-75">Tarjeta de Beneficios</small>
                                                </div>
                                                <div class="text-end">
                                                    <span class="badge bg-light text-dark px-3 py-2">
                                                        <?= strtoupper($card['membership_level']) ?>
                                                    </span>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-4">
                                                <h5 class="mb-1 fw-bold"><?= htmlspecialchars($user['full_name']) ?></h5>
                                                <small class="opacity-75">Titular</small>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-6">
                                                    <small class="opacity-75">Número de Tarjeta</small>
                                                    <div class="fw-bold"><?= htmlspecialchars($card['card_number']) ?></div>
                                                </div>
                                                <div class="col-6">
                                                    <small class="opacity-75">Miembro desde</small>
                                                    <div class="fw-bold"><?= date('m/Y', strtotime($card['created_at'])) ?></div>
                                                </div>
                                            </div>
                                            
                                            <div class="position-absolute bottom-0 end-0 m-3">
                                                <i class="bi bi-credit-card" style="font-size: 3rem; opacity: 0.2;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <div class="card border-0 shadow h-100">
                            <div class="card-body text-center d-flex flex-column justify-content-center">
                                <h5 class="mb-3">Código QR</h5>
                                <div class="qr-code mx-auto mb-3" style="width: 200px; height: 200px;">
                                    <div class="bg-light border rounded d-flex align-items-center justify-content-center h-100">
                                        <div class="text-center">
                                            <i class="bi bi-qr-code text-dark mb-2" style="font-size: 4rem;"></i>
                                            <div><small class="text-muted">Código QR</small></div>
                                            <div><small class="text-muted fw-bold"><?= htmlspecialchars($card['qr_code']) ?></small></div>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-muted small">
                                    Muestra este código en comercios afiliados para validar tus beneficios
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Information -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-0 shadow">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">Información de la Tarjeta</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td class="fw-bold">Número de Tarjeta:</td>
                                                <td><?= htmlspecialchars($card['card_number']) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold">Tipo:</td>
                                                <td>
                                                    <span class="badge bg-<?= $card['card_type'] === 'digital' ? 'info' : 'warning' ?>">
                                                        <?= ucfirst($card['card_type']) ?>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold">Nivel de Membresía:</td>
                                                <td>
                                                    <span class="badge bg-<?= $card['membership_level'] === 'free' ? 'secondary' : ($card['membership_level'] === 'premium' ? 'warning' : 'success') ?>">
                                                        <?= strtoupper($card['membership_level']) ?>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold">Estado:</td>
                                                <td>
                                                    <span class="badge bg-<?= $card['is_active'] ? 'success' : 'danger' ?>">
                                                        <?= $card['is_active'] ? 'Activa' : 'Inactiva' ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td class="fw-bold">Fecha de Creación:</td>
                                                <td><?= date('d/m/Y H:i', strtotime($card['created_at'])) ?></td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold">Código QR:</td>
                                                <td><small class="text-muted"><?= htmlspecialchars($card['qr_code']) ?></small></td>
                                            </tr>
                                            <tr>
                                                <td class="fw-bold">Tarjeta Física:</td>
                                                <td>
                                                    <?php if ($card['physical_requested']): ?>
                                                        <span class="badge bg-info">
                                                            <?= ucfirst($card['physical_delivery_status'] ?? 'Solicitada') ?>
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="text-muted">No solicitada</span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card border-0 shadow">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">Acciones</h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <?php if (!$card['physical_requested']): ?>
                                    <div class="col-md-4">
                                        <div class="card border h-100">
                                            <div class="card-body text-center">
                                                <i class="bi bi-credit-card text-warning mb-3" style="font-size: 2rem;"></i>
                                                <h6>Solicitar Tarjeta Física</h6>
                                                <p class="text-muted small">Recibe tu tarjeta física en casa</p>
                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#physicalCardModal">
                                                    Solicitar ($150 MXN)
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    
                                    <?php if ($card['membership_level'] === 'free'): ?>
                                    <div class="col-md-4">
                                        <div class="card border h-100">
                                            <div class="card-body text-center">
                                                <i class="bi bi-star text-success mb-3" style="font-size: 2rem;"></i>
                                                <h6>Actualizar Membresía</h6>
                                                <p class="text-muted small">Accede a beneficios premium</p>
                                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#upgradeModal">
                                                    Actualizar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    
                                    <div class="col-md-4">
                                        <div class="card border h-100">
                                            <div class="card-body text-center">
                                                <i class="bi bi-download text-primary mb-3" style="font-size: 2rem;"></i>
                                                <h6>Descargar QR</h6>
                                                <p class="text-muted small">Guarda tu código QR en el móvil</p>
                                                <button class="btn btn-primary btn-sm" onclick="downloadQR()">
                                                    Descargar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Benefits Information -->
                <div class="row">
                    <div class="col-12">
                        <div class="card border-0 shadow">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">Beneficios de tu Membresía <?= strtoupper($card['membership_level']) ?></h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="text-success">✓ Incluido en tu plan:</h6>
                                        <ul class="list-unstyled">
                                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Acceso a promociones básicas</li>
                                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Tarjeta digital gratuita</li>
                                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Historial de transacciones</li>
                                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Localización de comercios</li>
                                            <?php if ($card['membership_level'] !== 'free'): ?>
                                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Promociones exclusivas</li>
                                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Soporte prioritario</li>
                                            <?php endif; ?>
                                            <?php if ($card['membership_level'] === 'vip'): ?>
                                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Eventos VIP exclusivos</li>
                                            <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Descuentos adicionales</li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="text-muted">Instrucciones de uso:</h6>
                                        <ol class="list-unstyled">
                                            <li class="mb-2"><span class="badge bg-primary me-2">1</span>Busca promociones disponibles</li>
                                            <li class="mb-2"><span class="badge bg-primary me-2">2</span>Ve al comercio afiliado</li>
                                            <li class="mb-2"><span class="badge bg-primary me-2">3</span>Muestra tu código QR o proporciona tu teléfono</li>
                                            <li class="mb-2"><span class="badge bg-primary me-2">4</span>¡Disfruta tu descuento!</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php else: ?>
                <!-- No Card Found -->
                <div class="row">
                    <div class="col-12">
                        <div class="card border-0 shadow text-center">
                            <div class="card-body py-5">
                                <i class="bi bi-credit-card text-muted mb-3" style="font-size: 4rem;"></i>
                                <h4>No tienes una tarjeta digital</h4>
                                <p class="text-muted">Parece que aún no tienes una tarjeta digital asignada.</p>
                                <button class="btn btn-primary" onclick="location.reload()">
                                    Generar Tarjeta Digital
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Modals would go here for physical card request and membership upgrade -->

<?php 
$content = ob_get_clean();
$pageScripts = '
<script>
function downloadQR() {
    alert("Funcionalidad de descarga QR será implementada próximamente");
}
</script>';
include APP_PATH . 'views/layouts/main.php';
?>