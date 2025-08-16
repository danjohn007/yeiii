<?php 
ob_start(); 
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="display-1 fw-bold text-center text-muted">404</h1>
            <div class="text-center">
                <h2 class="mb-3">Página no encontrada</h2>
                <p class="text-muted mb-4">La página que estás buscando no existe o ha sido movida.</p>
                <div class="d-flex gap-3 justify-content-center">
                    <a href="<?= SITE_URL ?>" class="btn btn-primary">
                        <i class="bi bi-house me-2"></i>Volver al Inicio
                    </a>
                    <a href="javascript:history.back()" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Página Anterior
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean();
include APP_PATH . 'views/layouts/main.php';
?>