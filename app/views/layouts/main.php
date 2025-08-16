<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? $pageTitle . ' - ' . SITE_NAME : SITE_NAME ?></title>
    <meta name="description" content="<?= isset($pageDescription) ? $pageDescription : SITE_DESCRIPTION ?>">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Custom CSS -->
    <link href="<?= SITE_URL ?>public/css/style.css" rel="stylesheet">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= SITE_URL ?>public/images/favicon.ico">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?= SITE_URL ?>">
                <i class="bi bi-credit-card-2-front me-2"></i>YEIII
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <?php if (!isset($_SESSION['user_id'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= SITE_URL ?>">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= SITE_URL ?>home/businesses">Comercios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= SITE_URL ?>home/promotions">Promociones</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= SITE_URL ?>dashboard">Dashboard</a>
                        </li>
                        <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'usuario'): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= SITE_URL ?>dashboard/promotions">Promociones</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= SITE_URL ?>dashboard/businesses">Comercios</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= SITE_URL ?>dashboard/card">Mi Tarjeta</a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
                
                <ul class="navbar-nav">
                    <?php if (!isset($_SESSION['user_id'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= SITE_URL ?>auth/login">Iniciar Sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-outline-light ms-2" href="<?= SITE_URL ?>auth/register">Registrarse</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i><?= htmlspecialchars($_SESSION['user_name'] ?? 'Usuario') ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= SITE_URL ?>dashboard/profile">
                                    <i class="bi bi-person me-2"></i>Mi Perfil
                                </a></li>
                                <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'usuario'): ?>
                                    <li><a class="dropdown-item" href="<?= SITE_URL ?>dashboard/transactions">
                                        <i class="bi bi-receipt me-2"></i>Mis Transacciones
                                    </a></li>
                                    <li><a class="dropdown-item" href="<?= SITE_URL ?>dashboard/favorites">
                                        <i class="bi bi-heart me-2"></i>Favoritos
                                    </a></li>
                                <?php endif; ?>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="<?= SITE_URL ?>auth/logout">
                                    <i class="bi bi-box-arrow-right me-2"></i>Cerrar Sesión
                                </a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    <?php if (isset($_SESSION['flash_message'])): ?>
        <div class="alert alert-<?= $_SESSION['flash_type'] ?? 'info' ?> alert-dismissible fade show m-0" role="alert">
            <?= htmlspecialchars($_SESSION['flash_message']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php 
        unset($_SESSION['flash_message']); 
        unset($_SESSION['flash_type']); 
        ?>
    <?php endif; ?>

    <!-- Main Content -->
    <main class="py-4">
        <?= $content ?? '' ?>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-light py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5 class="fw-bold">YEIII Platform</h5>
                    <p class="text-muted">Conectando usuarios con comercios locales a través de promociones exclusivas y beneficios únicos.</p>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-light"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-light"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-light"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="text-light"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="fw-bold">Enlaces</h6>
                    <ul class="list-unstyled">
                        <li><a href="<?= SITE_URL ?>" class="text-muted text-decoration-none">Inicio</a></li>
                        <li><a href="<?= SITE_URL ?>home/businesses" class="text-muted text-decoration-none">Comercios</a></li>
                        <li><a href="<?= SITE_URL ?>home/promotions" class="text-muted text-decoration-none">Promociones</a></li>
                        <li><a href="<?= SITE_URL ?>home/about" class="text-muted text-decoration-none">Acerca de</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h6 class="fw-bold">Soporte</h6>
                    <ul class="list-unstyled">
                        <li><a href="<?= SITE_URL ?>home/help" class="text-muted text-decoration-none">Ayuda</a></li>
                        <li><a href="<?= SITE_URL ?>home/contact" class="text-muted text-decoration-none">Contacto</a></li>
                        <li><a href="<?= SITE_URL ?>home/terms" class="text-muted text-decoration-none">Términos</a></li>
                        <li><a href="<?= SITE_URL ?>home/privacy" class="text-muted text-decoration-none">Privacidad</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 mb-4">
                    <h6 class="fw-bold">Boletín</h6>
                    <p class="text-muted mb-3">Recibe las últimas promociones y novedades</p>
                    <form class="d-flex" method="post" action="<?= SITE_URL ?>newsletter/subscribe">
                        <input type="email" class="form-control me-2" placeholder="Tu email" name="email" required>
                        <button class="btn btn-primary" type="submit">Suscribir</button>
                    </form>
                </div>
            </div>
            <hr class="my-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="text-muted mb-0">&copy; <?= date('Y') ?> YEIII Platform. Todos los derechos reservados.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="text-muted mb-0">Desarrollado con ❤️ en México</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="<?= SITE_URL ?>public/js/app.js"></script>
    
    <!-- Page specific scripts -->
    <?= $pageScripts ?? '' ?>
</body>
</html>