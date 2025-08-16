<?php

class User extends Model {
    protected $table = 'users';
    
    public function emailExists($email) {
        return $this->exists(['email' => $email]);
    }
    
    public function getByEmail($email) {
        $users = $this->getWhere(['email' => $email], 'id', 'ASC', 1);
        return !empty($users) ? $users[0] : null;
    }
    
    public function getByVerificationToken($token) {
        $users = $this->getWhere(['email_verification_token' => $token], 'id', 'ASC', 1);
        return !empty($users) ? $users[0] : null;
    }
    
    public function verifyEmail($userId) {
        return $this->update($userId, [
            'email_verified' => 1,
            'email_verification_token' => null,
            'status' => 'active'
        ]);
    }
    
    public function getUsersByRole($role) {
        return $this->getWhere(['role' => $role], 'full_name', 'ASC');
    }
    
    public function updateLastLogin($userId) {
        $sql = "UPDATE {$this->table} SET last_login = NOW() WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $userId);
        return $stmt->execute();
    }
    
    public function getStats() {
        $sql = "SELECT 
                    role,
                    COUNT(*) as count,
                    SUM(CASE WHEN status = 'active' THEN 1 ELSE 0 END) as active_count
                FROM {$this->table} 
                GROUP BY role";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function searchUsers($search = '', $role = '', $limit = 20, $offset = 0) {
        $sql = "SELECT * FROM {$this->table} WHERE 1=1";
        $params = [];
        
        if (!empty($search)) {
            $sql .= " AND (full_name LIKE :search OR email LIKE :search)";
            $params['search'] = "%{$search}%";
        }
        
        if (!empty($role)) {
            $sql .= " AND role = :role";
            $params['role'] = $role;
        }
        
        $sql .= " ORDER BY created_at DESC LIMIT :limit OFFSET :offset";
        
        $stmt = $this->db->prepare($sql);
        
        foreach ($params as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }
        
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function countSearch($search = '', $role = '') {
        $sql = "SELECT COUNT(*) as total FROM {$this->table} WHERE 1=1";
        $params = [];
        
        if (!empty($search)) {
            $sql .= " AND (full_name LIKE :search OR email LIKE :search)";
            $params['search'] = "%{$search}%";
        }
        
        if (!empty($role)) {
            $sql .= " AND role = :role";
            $params['role'] = $role;
        }
        
        $stmt = $this->db->prepare($sql);
        
        foreach ($params as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }
        
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['total'];
    }
}
?>