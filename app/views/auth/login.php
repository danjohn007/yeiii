<?php 
ob_start(); 
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card shadow">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold">Iniciar Sesión</h2>
                        <p class="text-muted">Accede a tu cuenta UFF!</p>
                    </div>
                    
                    <form method="POST" action="<?= SITE_URL ?>auth/login">
                        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember">
                            <label class="form-check-label" for="remember">
                                Recordarme
                            </label>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 btn-lg">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar Sesión
                        </button>
                    </form>
                    
                    <hr class="my-4">
                    
                    <div class="text-center">
                        <p class="mb-2">¿No tienes cuenta?</p>
                        <a href="<?= SITE_URL ?>auth/register" class="btn btn-outline-primary">
                            <i class="bi bi-person-plus me-2"></i>Registrarse
                        </a>
                    </div>
                    
                    <div class="text-center mt-3">
                        <a href="#" class="text-muted text-decoration-none">¿Olvidaste tu contraseña?</a>
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