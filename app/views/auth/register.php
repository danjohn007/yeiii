<?php 
ob_start(); 
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold">Registro de Usuario</h2>
                        <p class="text-muted">Crea tu cuenta gratuita y comienza a ahorrar</p>
                    </div>
                    
                    <form method="POST" action="<?= SITE_URL ?>auth/register" id="registerForm">
                        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?>">
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="full_name" class="form-label">Nombre Completo *</label>
                                <input type="text" class="form-control" id="full_name" name="full_name" required>
                                <div class="form-text">Mínimo 2 palabras</div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="whatsapp" class="form-label">WhatsApp *</label>
                                <input type="tel" class="form-control" id="whatsapp" name="whatsapp" 
                                       placeholder="+52155XXXXXXXX" pattern="^\+52\d{10}$" required>
                                <div class="form-text">Formato: +52155XXXXXXXX</div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="birth_date" class="form-label">Fecha de Nacimiento *</label>
                                <input type="date" class="form-control" id="birth_date" name="birth_date" required>
                                <div class="form-text">Debes ser mayor de 18 años</div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Contraseña *</label>
                                <input type="password" class="form-control" id="password" name="password" 
                                       minlength="8" required>
                                <div class="form-text">Mínimo 8 caracteres</div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="confirm_password" class="form-label">Confirmar Contraseña *</label>
                                <input type="password" class="form-control" id="confirm_password" 
                                       name="confirm_password" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="user_type" class="form-label">Tipo de Usuario</label>
                            <select class="form-select" id="user_type" name="user_type">
                                <option value="usuario">Usuario (Acceso a promociones)</option>
                                <option value="comercio">Comercio (Quiero ofrecer promociones)</option>
                            </select>
                        </div>
                        
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="terms" required>
                            <label class="form-check-label" for="terms">
                                Acepto los <a href="<?= SITE_URL ?>home/terms" target="_blank">términos y condiciones</a> 
                                y la <a href="<?= SITE_URL ?>home/privacy" target="_blank">política de privacidad</a>
                            </label>
                        </div>
                        
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="newsletter">
                            <label class="form-check-label" for="newsletter">
                                Deseo recibir el boletín semanal con promociones
                            </label>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 btn-lg">
                            <i class="bi bi-person-plus me-2"></i>Crear Cuenta
                        </button>
                    </form>
                    
                    <hr class="my-4">
                    
                    <div class="text-center">
                        <p class="mb-2">¿Ya tienes cuenta?</p>
                        <a href="<?= SITE_URL ?>auth/login" class="btn btn-outline-primary">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar Sesión
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean();
$pageScripts = '
<script>
document.getElementById("registerForm").addEventListener("submit", function(e) {
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirm_password").value;
    const fullName = document.getElementById("full_name").value;
    const birthDate = new Date(document.getElementById("birth_date").value);
    const today = new Date();
    
    // Validate full name (minimum 2 words)
    if (fullName.trim().split(" ").length < 2) {
        e.preventDefault();
        alert("El nombre completo debe contener al menos 2 palabras");
        return;
    }
    
    // Validate age (18+)
    const age = today.getFullYear() - birthDate.getFullYear();
    const monthDiff = today.getMonth() - birthDate.getMonth();
    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    
    if (age < 18) {
        e.preventDefault();
        alert("Debes ser mayor de 18 años para registrarte");
        return;
    }
    
    // Validate password match
    if (password !== confirmPassword) {
        e.preventDefault();
        alert("Las contraseñas no coinciden");
        return;
    }
});
</script>';
include APP_PATH . 'views/layouts/main.php';
?>