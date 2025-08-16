<?php
/**
 * Database Configuration
 * Configure your database connection here
 */

class Database {
    private $db_file = ROOT_PATH . 'yeiii_platform.db';
    private $conn;

    /**
     * Get database connection
     */
    public function connect() {
        $this->conn = null;
        
        try {
            $dsn = "sqlite:{$this->db_file}";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            
            $this->conn = new PDO($dsn, null, null, $options);
            
            // Enable foreign keys
            $this->conn->exec('PRAGMA foreign_keys = ON;');
            
        } catch(PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }
        
        return $this->conn;
    }
}
?>