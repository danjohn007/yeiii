<?php
/**
 * Database Configuration
 * Configure your database connection here
 */

class Database {
    private $host = 'localhost';
    private $db_name = 'ejercito_yeiii';
    private $username = 'ejercito_yeiii';
    private $password = 'Danjohn007!';
    private $charset = 'utf8mb4';
    private $conn;

    /**
     * Get database connection
     */
    public function connect() {
        $this->conn = null;
        
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset={$this->charset}";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            
            $this->conn = new PDO($dsn, $this->username, $this->password, $options);
        } catch(PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }
        
        return $this->conn;
    }
}
?>
