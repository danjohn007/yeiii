<?php
/**
 * Database Configuration
 * Configure your database connection here
 */

class Database {
    private $db_path;
    private $conn;

    public function __construct() {
        $this->db_path = ROOT_PATH . 'database.sqlite';
    }

    /**
     * Get database connection
     */
    public function connect() {
        $this->conn = null;
        
        try {
            $dsn = "sqlite:{$this->db_path}";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            
            $this->conn = new PDO($dsn, null, null, $options);
            
            // Create tables if they don't exist
            $this->createTables();
            
        } catch(PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }
        
        return $this->conn;
    }
    
    private function createTables() {
        $sql = "
        CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            email VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            full_name VARCHAR(255) NOT NULL,
            whatsapp VARCHAR(20),
            birth_date DATE,
            role VARCHAR(20) NOT NULL DEFAULT 'usuario',
            status VARCHAR(20) NOT NULL DEFAULT 'pending',
            email_verified INTEGER NOT NULL DEFAULT 0,
            email_verification_token VARCHAR(255),
            profile_image VARCHAR(255),
            city VARCHAR(100),
            last_login DATETIME,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );
        
        CREATE TABLE IF NOT EXISTS businesses (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            user_id INTEGER NOT NULL,
            business_name VARCHAR(255) NOT NULL,
            business_type VARCHAR(100) NOT NULL,
            description TEXT,
            address TEXT,
            phone VARCHAR(20),
            email VARCHAR(255),
            website VARCHAR(255),
            status VARCHAR(20) NOT NULL DEFAULT 'pending',
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users (id)
        );
        
        CREATE TABLE IF NOT EXISTS promotions (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            business_id INTEGER NOT NULL,
            title VARCHAR(255) NOT NULL,
            description TEXT,
            discount_percentage DECIMAL(5,2),
            discount_amount DECIMAL(10,2),
            start_date DATE,
            end_date DATE,
            is_active INTEGER NOT NULL DEFAULT 1,
            is_featured INTEGER NOT NULL DEFAULT 0,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (business_id) REFERENCES businesses (id)
        );
        
        CREATE TABLE IF NOT EXISTS digital_cards (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            user_id INTEGER NOT NULL,
            card_number VARCHAR(16) NOT NULL UNIQUE,
            qr_code VARCHAR(255),
            membership_level VARCHAR(20) NOT NULL DEFAULT 'free',
            is_active INTEGER NOT NULL DEFAULT 1,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users (id)
        );
        ";
        
        $this->conn->exec($sql);
        
        // Insert sample data if tables are empty
        $this->insertSampleData();
    }
    
    private function insertSampleData() {
        // Check if we already have users
        $stmt = $this->conn->query("SELECT COUNT(*) as count FROM users");
        $result = $stmt->fetch();
        
        if ($result['count'] == 0) {
            // Insert sample superadmin user
            $hashedPassword = password_hash('admin123', PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (email, password, full_name, role, status, email_verified, whatsapp, birth_date, city) VALUES 
                    ('admin@yeiii.com', ?, 'Super Administrador', 'superadmin', 'active', 1, '+525551234567', '1990-01-01', null),
                    ('gestor@yeiii.com', ?, 'Gestor Principal', 'gestor', 'active', 1, '+525551234568', '1985-05-15', 'Ciudad de México'),
                    ('capturista@yeiii.com', ?, 'Capturista Principal', 'capturista', 'active', 1, '+525551234569', '1992-08-20', 'Guadalajara'),
                    ('comercio@yeiii.com', ?, 'Comercio Demo', 'comercio', 'active', 1, '+525551234570', '1988-03-10', null),
                    ('usuario@yeiii.com', ?, 'Usuario Demo', 'usuario', 'active', 1, '+525551234571', '1995-12-05', null)";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$hashedPassword, $hashedPassword, $hashedPassword, $hashedPassword, $hashedPassword]);
            
            // Insert sample businesses
            $sql = "INSERT INTO businesses (user_id, business_name, business_type, description, address, phone, email, status) VALUES 
                    (4, 'Restaurante El Buen Sabor', 'Restaurante', 'Restaurante familiar con comida mexicana tradicional y ambiente acogedor.', 'Calle Principal 123, Centro', '+525551234570', 'contacto@elbuensabor.com', 'approved'),
                    (4, 'Farmacia San Juan', 'Farmacia', 'Farmacia con servicio las 24 horas, medicamentos genéricos y de patente.', 'Av. Juárez 456, Col. Centro', '+525551234571', 'info@farmaciasanjuan.com', 'approved')";
            
            $this->conn->exec($sql);
            
            // Insert sample promotions
            $sql = "INSERT INTO promotions (business_id, title, description, discount_percentage, start_date, end_date, is_active, is_featured) VALUES 
                    (1, '20% de descuento en platillos principales', 'Obtén 20% de descuento en todos nuestros platillos principales de lunes a viernes', 20.00, '2024-01-01', '2024-12-31', 1, 1),
                    (2, '15% de descuento en medicamentos', 'Descuento del 15% en medicamentos genéricos y vitaminas', 15.00, '2024-01-01', '2024-12-31', 1, 1)";
            
            $this->conn->exec($sql);
            
            // Insert sample digital cards
            $sql = "INSERT INTO digital_cards (user_id, card_number, membership_level) VALUES 
                    (5, '1234567890123456', 'free')";
            
            $this->conn->exec($sql);
        }
    }
}
?>
