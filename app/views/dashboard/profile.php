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
                    <?php if ($user['role'] === 'superadmin'): ?>
                    <a class="nav-link" href="<?= SITE_URL ?>dashboard/user-management">
                        <i class="bi bi-people me-2"></i>Gestión de Usuarios
                    </a>
                    <a class="nav-link" href="<?= SITE_URL ?>dashboard/business-approval">
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
                    <?php elseif ($user['role'] === 'usuario'): ?>
                    <a class="nav-link" href="<?= SITE_URL ?>dashboard/card">
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
                    <?php endif; ?>
                    <a class="nav-link active" href="<?= SITE_URL ?>dashboard/profile">
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
                        <h1 class="h3 mb-0">Mi Perfil</h1>
                        <p class="text-muted">Administra tu información personal y configuración de cuenta</p>
                    </div>
                </div>

                <div class="row">
                    <!-- Profile Information -->
                    <div class="col-lg-8">
                        <div class="card border-0 shadow">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">Información Personal</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="<?= SITE_URL ?>dashboard/profile">
                                    <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="full_name" class="form-label">Nombre Completo *</label>
                                            <input type="text" class="form-control" id="full_name" name="full_name" 
                                                   value="<?= htmlspecialchars($user['full_name']) ?>" required>
                                            <div class="form-text">Debe contener al menos 2 palabras</div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" 
                                                   value="<?= htmlspecialchars($user['email']) ?>" disabled>
                                            <div class="form-text">No se puede modificar el email</div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="whatsapp" class="form-label">WhatsApp *</label>
                                            <input type="tel" class="form-control" id="whatsapp" name="whatsapp" 
                                                   value="<?= htmlspecialchars($user['whatsapp']) ?>" 
                                                   placeholder="+52XXXXXXXXXX" required>
                                            <div class="form-text">Formato internacional (+52XXXXXXXXXX)</div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="birth_date" class="form-label">Fecha de Nacimiento</label>
                                            <input type="date" class="form-control" id="birth_date" 
                                                   value="<?= htmlspecialchars($user['birth_date']) ?>" disabled>
                                            <div class="form-text">No se puede modificar la fecha de nacimiento</div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="role" class="form-label">Rol</label>
                                            <input type="text" class="form-control" 
                                                   value="<?= ucfirst($user['role']) ?>" disabled>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="status" class="form-label">Estado</label>
                                            <input type="text" class="form-control" 
                                                   value="<?= ucfirst($user['status']) ?>" disabled>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex justify-content-between">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-check-lg me-1"></i>Guardar Cambios
                                        </button>
                                        <a href="<?= SITE_URL ?>dashboard" class="btn btn-outline-secondary">
                                            <i class="bi bi-arrow-left me-1"></i>Volver al Dashboard
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Profile Summary -->
                    <div class="col-lg-4">
                        <div class="card border-0 shadow mb-4">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">Resumen de Cuenta</h5>
                            </div>
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center" 
                                         style="width: 80px; height: 80px;">
                                        <i class="bi bi-person-circle text-white" style="font-size: 3rem;"></i>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span>Estado de Verificación:</span>
                                    <?php if ($user['email_verified']): ?>
                                        <span class="badge bg-success">Verificado</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning">Pendiente</span>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span>Miembro desde:</span>
                                    <span class="text-muted"><?= date('d/m/Y', strtotime($user['created_at'])) ?></span>
                                </div>
                                
                                <?php if (isset($user['last_login']) && $user['last_login']): ?>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span>Último acceso:</span>
                                    <span class="text-muted"><?= date('d/m/Y H:i', strtotime($user['last_login'])) ?></span>
                                </div>
                                <?php endif; ?>
                                
                                <hr>
                                
                                <div class="text-center">
                                    <p class="text-muted mb-2">¿Necesitas ayuda?</p>
                                    <a href="mailto:soporte@uff.com" class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-envelope me-1"></i>Contactar Soporte
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Change Password -->
                        <div class="card border-0 shadow">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">Seguridad</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted mb-3">Mantén tu cuenta segura</p>
                                <button class="btn btn-outline-warning btn-sm w-100 mb-2" disabled>
                                    <i class="bi bi-key me-1"></i>Cambiar Contraseña
                                </button>
                                <button class="btn btn-outline-info btn-sm w-100" disabled>
                                    <i class="bi bi-shield-check me-1"></i>Configurar 2FA
                                </button>
                                <div class="form-text mt-2">Funciones próximamente disponibles</div>
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