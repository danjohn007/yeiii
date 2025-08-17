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
                    <a class="nav-link active" href="<?= SITE_URL ?>dashboard/user-management">
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
                        <h1 class="h3 mb-0">Gestión de Usuarios</h1>
                        <p class="text-muted">Administrar cuentas, roles y estados de usuarios</p>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-secondary" disabled>
                            <i class="bi bi-plus me-1"></i>Nuevo Usuario
                        </button>
                        <button class="btn btn-primary" disabled>
                            <i class="bi bi-download me-1"></i>Exportar
                        </button>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="row mb-4">
                    <?php foreach ($userStats as $stat): ?>
                    <div class="col-md-3 mb-3">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <i class="bi bi-people text-primary mb-2" style="font-size: 2rem;"></i>
                                <h5 class="mb-0"><?= number_format($stat['count']) ?></h5>
                                <small class="text-muted"><?= ucfirst($stat['role']) ?></small>
                                <div class="text-success small">
                                    <?= $stat['active_count'] ?> activos
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Search and Filters -->
                <div class="card border-0 shadow mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Filtros de Búsqueda</h5>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="<?= SITE_URL ?>dashboard/user-management">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="search" class="form-label">Buscar</label>
                                    <input type="text" class="form-control" id="search" name="search" 
                                           placeholder="Nombre o email..." value="<?= htmlspecialchars($search) ?>">
                                </div>
                                <div class="col-md-3">
                                    <label for="role" class="form-label">Rol</label>
                                    <select class="form-control" id="role" name="role">
                                        <option value="">Todos los roles</option>
                                        <option value="superadmin" <?= $selectedRole === 'superadmin' ? 'selected' : '' ?>>Super Admin</option>
                                        <option value="gestor" <?= $selectedRole === 'gestor' ? 'selected' : '' ?>>Gestor</option>
                                        <option value="capturista" <?= $selectedRole === 'capturista' ? 'selected' : '' ?>>Capturista</option>
                                        <option value="comercio" <?= $selectedRole === 'comercio' ? 'selected' : '' ?>>Comercio</option>
                                        <option value="usuario" <?= $selectedRole === 'usuario' ? 'selected' : '' ?>>Usuario</option>
                                    </select>
                                </div>
                                <div class="col-md-3 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary me-2">
                                        <i class="bi bi-search me-1"></i>Buscar
                                    </button>
                                    <a href="<?= SITE_URL ?>dashboard/user-management" class="btn btn-outline-secondary">
                                        Limpiar
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Users Table -->
                <div class="card border-0 shadow">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Lista de Usuarios</h5>
                        <small class="text-muted">
                            Mostrando <?= count($users) ?> de <?= number_format($totalUsers) ?> usuarios
                        </small>
                    </div>
                    <div class="card-body p-0">
                        <?php if (empty($users)): ?>
                        <div class="text-center p-4">
                            <i class="bi bi-people text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-2">No se encontraron usuarios</p>
                        </div>
                        <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Usuario</th>
                                        <th>Email</th>
                                        <th>Rol</th>
                                        <th>Estado</th>
                                        <th>Registro</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $userItem): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" 
                                                     style="width: 40px; height: 40px;">
                                                    <i class="bi bi-person text-white"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-bold"><?= htmlspecialchars($userItem['full_name']) ?></div>
                                                    <?php if ($userItem['whatsapp']): ?>
                                                    <small class="text-muted"><?= htmlspecialchars($userItem['whatsapp']) ?></small>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <?= htmlspecialchars($userItem['email']) ?>
                                            <?php if ($userItem['email_verified']): ?>
                                                <i class="bi bi-check-circle text-success ms-1" title="Email verificado"></i>
                                            <?php else: ?>
                                                <i class="bi bi-x-circle text-warning ms-1" title="Email no verificado"></i>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="badge bg-<?= $userItem['role'] === 'superadmin' ? 'danger' : 
                                                                    ($userItem['role'] === 'gestor' ? 'warning' : 
                                                                    ($userItem['role'] === 'comercio' ? 'info' : 'secondary')) ?>">
                                                <?= ucfirst($userItem['role']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-<?= $userItem['status'] === 'active' ? 'success' : 
                                                                    ($userItem['status'] === 'pending' ? 'warning' : 'danger') ?>">
                                                <?= ucfirst($userItem['status']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                <?= date('d/m/Y', strtotime($userItem['created_at'])) ?>
                                            </small>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button class="btn btn-outline-primary user-view-btn" 
                                                        data-user-id="<?= $userItem['id'] ?>" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#userViewModal" 
                                                        title="Ver detalles">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                                <button class="btn btn-outline-warning user-edit-btn" 
                                                        data-user-id="<?= $userItem['id'] ?>" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#userEditModal" 
                                                        title="Editar">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <?php if ($userItem['id'] !== $user['id']): ?>
                                                <button class="btn btn-outline-<?= $userItem['status'] === 'active' ? 'danger' : 'success' ?> user-status-btn" 
                                                        data-user-id="<?= $userItem['id'] ?>" 
                                                        data-current-status="<?= $userItem['status'] ?>"
                                                        title="<?= $userItem['status'] === 'active' ? 'Suspender' : 'Activar' ?>">
                                                    <i class="bi bi-<?= $userItem['status'] === 'active' ? 'ban' : 'check-circle' ?>"></i>
                                                </button>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Pagination -->
                    <?php if ($totalPages > 1): ?>
                    <div class="card-footer bg-white">
                        <nav aria-label="Paginación de usuarios">
                            <ul class="pagination justify-content-center mb-0">
                                <?php if ($currentPage > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $currentPage - 1])) ?>">
                                        Anterior
                                    </a>
                                </li>
                                <?php endif; ?>
                                
                                <?php for ($i = max(1, $currentPage - 2); $i <= min($totalPages, $currentPage + 2); $i++): ?>
                                <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
                                    <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>">
                                        <?= $i ?>
                                    </a>
                                </li>
                                <?php endfor; ?>
                                
                                <?php if ($currentPage < $totalPages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $currentPage + 1])) ?>">
                                        Siguiente
                                    </a>
                                </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- User View Modal -->
<div class="modal fade" id="userViewModal" tabindex="-1" aria-labelledby="userViewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userViewModalLabel">Detalles de Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="userViewContent">
                <div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Cargando...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- User Edit Modal -->
<div class="modal fade" id="userEditModal" tabindex="-1" aria-labelledby="userEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userEditModalLabel">Editar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="userEditContent">
                <div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Cargando...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // User View Modal
    document.querySelectorAll('.user-view-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const userId = this.dataset.userId;
            fetch(`<?= SITE_URL ?>dashboard/user-details/${userId}`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('userViewContent').innerHTML = html;
                })
                .catch(error => {
                    document.getElementById('userViewContent').innerHTML = '<div class="alert alert-danger">Error al cargar los detalles del usuario</div>';
                });
        });
    });

    // User Edit Modal
    document.querySelectorAll('.user-edit-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const userId = this.dataset.userId;
            fetch(`<?= SITE_URL ?>dashboard/user-edit/${userId}`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('userEditContent').innerHTML = html;
                })
                .catch(error => {
                    document.getElementById('userEditContent').innerHTML = '<div class="alert alert-danger">Error al cargar el formulario de edición</div>';
                });
        });
    });

    // User Status Toggle
    document.querySelectorAll('.user-status-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const userId = this.dataset.userId;
            const currentStatus = this.dataset.currentStatus;
            const newStatus = currentStatus === 'active' ? 'inactive' : 'active';
            const action = newStatus === 'active' ? 'activar' : 'suspender';
            
            if (confirm(`¿Estás seguro de que deseas ${action} este usuario?`)) {
                fetch(`<?= SITE_URL ?>dashboard/user-status/${userId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        status: newStatus,
                        csrf_token: '<?= $csrf_token ?? '' ?>'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Error al cambiar el estado del usuario');
                    }
                })
                .catch(error => {
                    alert('Error al cambiar el estado del usuario');
                });
            }
        });
    });
});
</script>

<?php 
$content = ob_get_clean();
include APP_PATH . 'views/layouts/main.php';
?>