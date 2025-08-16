# YEIII - Plataforma de Comercios con Acceso Privilegiado

## Descripción

YEIII es una plataforma web digital Freemium que conecta a usuarios registrados con comercios locales que ofrecen descuentos y promociones exclusivas. La plataforma utiliza un sistema de tarjetas digitales con códigos QR para validar beneficios y facilitar transacciones.

## Características Principales

### Sistema de Usuarios
- **Registro gratuito** con validación de email
- **5 niveles de acceso**: SuperAdmin, Gestor/Métricas, Capturistas, Comercio/Empresa, Usuario Final
- **Tarjetas digitales** con QR codes únicos
- **Opción de tarjeta física** (con costo adicional)

### Funcionalidades para Comercios
- Registro y verificación de negocios
- Dashboard para gestión de promociones
- Sistema de validación de clientes (QR/teléfono)
- Reportes y estadísticas de uso
- Herramientas de análisis de datos

### Funcionalidades para Usuarios
- Acceso a promociones exclusivas
- Historial de transacciones
- Sistema de favoritos
- Geolocalización de comercios
- Boletín digital semanal

## Tecnologías Utilizadas

- **Backend**: PHP 7+ (puro, sin framework)
- **Base de Datos**: MySQL 5.7
- **Frontend**: HTML5, CSS3, JavaScript, Bootstrap 5
- **Autenticación**: Sesiones PHP con password_hash()
- **Gráficas**: Chart.js
- **Mapas**: Google Maps API
- **Arquitectura**: MVC (Model-View-Controller)

## Requisitos del Sistema

- **Servidor Web**: Apache 2.4+
- **PHP**: 7.0+ con extensiones PDO, MySQL
- **MySQL**: 5.7+
- **Módulos Apache**: mod_rewrite habilitado

## Instalación

### 1. Clonar o descargar el proyecto

```bash
git clone [URL_DEL_REPOSITORIO]
cd yeiii
```

### 2. Configurar la base de datos

1. Crear una base de datos MySQL:
```sql
CREATE DATABASE yeiii_platform CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

2. Importar el esquema:
```bash
mysql -u username -p yeiii_platform < sql/schema.sql
```

3. Importar datos de ejemplo (opcional):
```bash
mysql -u username -p yeiii_platform < sql/sample_data.sql
```

### 3. Configurar la aplicación

1. Editar el archivo `config/database.php` con tus credenciales de MySQL:
```php
private $host = 'localhost';
private $db_name = 'yeiii_platform';
private $username = 'tu_usuario';
private $password = 'tu_contraseña';
```

2. Configurar `config/config.php` según tu entorno:
```php
// Configurar URL base según tu servidor
define('SITE_URL', 'http://tu-dominio.com/yeiii/');

// Configurar Google Maps API Key
define('GOOGLE_MAPS_API_KEY', 'tu_google_maps_api_key');

// Configurar SMTP para emails
define('SMTP_HOST', 'tu_smtp_host');
define('SMTP_USERNAME', 'tu_email');
define('SMTP_PASSWORD', 'tu_contraseña_email');
```

### 4. Configurar permisos

```bash
chmod 755 public/uploads
chmod 644 config/*.php
```

### 5. Configurar Apache

El archivo `.htaccess` ya está incluido. Asegúrate de que `mod_rewrite` esté habilitado:

```apache
a2enmod rewrite
service apache2 restart
```

## Estructura de Directorios

```
yeiii/
├── app/
│   ├── controllers/     # Controladores MVC
│   ├── models/         # Modelos de datos
│   ├── views/          # Vistas/Templates
│   └── core/           # Clases base
├── config/             # Configuración
├── public/             # Archivos públicos
│   ├── css/           # Estilos CSS
│   ├── js/            # JavaScript
│   ├── images/        # Imágenes
│   └── uploads/       # Archivos subidos
├── sql/               # Scripts SQL
├── .htaccess          # Configuración Apache
├── index.php          # Punto de entrada
└── README.md          # Este archivo
```

## URLs Principales

- **Inicio**: `/`
- **Registro**: `/auth/register`
- **Login**: `/auth/login`
- **Dashboard**: `/dashboard`
- **Comercios**: `/home/businesses`
- **Promociones**: `/home/promotions`

## Usuarios de Prueba

Los datos de ejemplo incluyen usuarios con diferentes roles:

| Email | Contraseña | Rol |
|-------|------------|-----|
| admin@yeiii.com | password123 | superadmin |
| gestor@yeiii.com | password123 | gestor |
| capturista@yeiii.com | password123 | capturista |
| restaurante@ejemplo.com | password123 | comercio |
| juan.perez@email.com | password123 | usuario |

## Funcionalidades Implementadas

### ✅ Completadas
- [x] Estructura MVC básica
- [x] Sistema de autenticación y autorización
- [x] Registro de usuarios con validaciones
- [x] Base de datos con esquema completo
- [x] Landing page responsive
- [x] Sistema de rutas amigables
- [x] Configuración de Apache (.htaccess)
- [x] Estilos Bootstrap personalizados
- [x] Sistema básico de roles

### 🚧 En desarrollo
- [ ] Dashboard completo para cada rol
- [ ] Sistema de tarjetas digitales con QR
- [ ] Registro y validación de comercios
- [ ] Sistema de promociones y transacciones
- [ ] Geolocalización y mapas
- [ ] Sistema de emails y newsletters
- [ ] Reportes y exportación
- [ ] API para validación móvil

## API Endpoints

### Autenticación
- `POST /auth/login` - Iniciar sesión
- `POST /auth/register` - Registrar usuario
- `GET /auth/logout` - Cerrar sesión
- `GET /auth/verify/{token}` - Verificar email

### Dashboard
- `GET /dashboard` - Dashboard principal
- `GET /dashboard/profile` - Perfil de usuario
- `POST /dashboard/profile` - Actualizar perfil

### Comercios
- `GET /home/businesses` - Listar comercios
- `GET /home/business/{id}` - Detalle de comercio
- `POST /auth/register-business` - Registrar comercio

### Promociones
- `GET /home/promotions` - Listar promociones
- `GET /home/promotion/{id}` - Detalle de promoción

## Desarrollo

### Agregar un nuevo controlador

1. Crear archivo en `app/controllers/`:
```php
<?php
class NuevoController extends Controller {
    public function index() {
        $this->view('nuevo/index');
    }
}
?>
```

2. Crear vista en `app/views/nuevo/index.php`

### Agregar un nuevo modelo

1. Crear archivo en `app/models/`:
```php
<?php
class Nuevo extends Model {
    protected $table = 'nueva_tabla';
}
?>
```

## Seguridad

- **Protección CSRF**: Tokens en formularios
- **Validación de entrada**: Sanitización de datos
- **Contraseñas**: Hash con `password_hash()`
- **Sesiones**: Manejo seguro de sesiones
- **SQL Injection**: Prepared statements
- **XSS**: Escape de salida con `htmlspecialchars()`

## Contribuir

1. Fork el proyecto
2. Crear una rama para tu feature (`git checkout -b feature/nueva-funcionalidad`)
3. Commit tus cambios (`git commit -am 'Agregar nueva funcionalidad'`)
4. Push a la rama (`git push origin feature/nueva-funcionalidad`)
5. Crear un Pull Request

## Soporte

Para soporte técnico o reportar bugs:
- Crear un issue en el repositorio
- Email: soporte@yeiii.com

## Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para detalles.

## Créditos

Desarrollado por el equipo de YEIII Platform con tecnologías open source.

---

**Nota**: Este es un proyecto en desarrollo. Algunas funcionalidades están en proceso de implementación.