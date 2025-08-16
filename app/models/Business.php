<?php

class Business extends Model {
    protected $table = 'businesses';
    
    public function getFeatured($limit = 6) {
        $sql = "SELECT b.*, u.full_name as owner_name 
                FROM {$this->table} b 
                JOIN users u ON b.user_id = u.id 
                WHERE b.status = 'approved' 
                ORDER BY b.created_at DESC 
                LIMIT :limit";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getCategories() {
        $sql = "SELECT DISTINCT business_type FROM {$this->table} WHERE status = 'approved' ORDER BY business_type";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
    
    public function search($search = '', $category = '', $limit = 12, $offset = 0) {
        $sql = "SELECT b.*, u.full_name as owner_name 
                FROM {$this->table} b 
                JOIN users u ON b.user_id = u.id 
                WHERE b.status = 'approved'";
        $params = [];
        
        if (!empty($search)) {
            $sql .= " AND (b.business_name LIKE :search OR b.description LIKE :search)";
            $params['search'] = "%{$search}%";
        }
        
        if (!empty($category)) {
            $sql .= " AND b.business_type = :category";
            $params['category'] = $category;
        }
        
        $sql .= " ORDER BY b.business_name ASC LIMIT :limit OFFSET :offset";
        
        $stmt = $this->db->prepare($sql);
        
        foreach ($params as $key => $value) {
            $stmt->bindParam(":{$key}", $params[$key]);
        }
        
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function countSearch($search = '', $category = '') {
        $sql = "SELECT COUNT(*) as total FROM {$this->table} b WHERE b.status = 'approved'";
        $params = [];
        
        if (!empty($search)) {
            $sql .= " AND (b.business_name LIKE :search OR b.description LIKE :search)";
            $params['search'] = "%{$search}%";
        }
        
        if (!empty($category)) {
            $sql .= " AND b.business_type = :category";
            $params['category'] = $category;
        }
        
        $stmt = $this->db->prepare($sql);
        
        foreach ($params as $key => $value) {
            $stmt->bindParam(":{$key}", $params[$key]);
        }
        
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['total'];
    }
    
    public function getForSelect() {
        $sql = "SELECT id, business_name FROM {$this->table} WHERE status = 'approved' ORDER BY business_name";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getByUser($userId) {
        $users = $this->getWhere(['user_id' => $userId], 'id', 'DESC', 1);
        return !empty($users) ? $users[0] : null;
    }
    
    public function getWithStats($businessId) {
        $sql = "SELECT b.*, u.full_name as owner_name,
                (SELECT COUNT(*) FROM promotions WHERE business_id = b.id AND is_active = 1) as active_promotions,
                (SELECT COUNT(*) FROM transactions WHERE business_id = b.id) as total_transactions,
                (SELECT SUM(discount_amount) FROM transactions WHERE business_id = b.id) as total_discounts_given
                FROM {$this->table} b 
                JOIN users u ON b.user_id = u.id 
                WHERE b.id = :id";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $businessId);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    public function getPendingApproval() {
        return $this->getWhere(['status' => 'pending'], 'created_at', 'ASC');
    }
    
    public function approve($businessId) {
        return $this->update($businessId, ['status' => 'approved']);
    }
    
    public function reject($businessId) {
        return $this->update($businessId, ['status' => 'rejected']);
    }
}
?>