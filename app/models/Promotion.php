<?php

class Promotion extends Model {
    protected $table = 'promotions';
    
    public function getFeatured($limit = 6) {
        $sql = "SELECT p.*, b.business_name, b.logo as business_logo 
                FROM {$this->table} p 
                JOIN businesses b ON p.business_id = b.id 
                WHERE p.is_active = 1 AND p.is_featured = 1 
                AND p.start_date <= CURDATE() AND p.end_date >= CURDATE()
                AND b.status = 'approved'
                ORDER BY p.created_at DESC 
                LIMIT :limit";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getActive($limit = null, $offset = 0) {
        $sql = "SELECT p.*, b.business_name, b.logo as business_logo 
                FROM {$this->table} p 
                JOIN businesses b ON p.business_id = b.id 
                WHERE p.is_active = 1 
                AND p.start_date <= CURDATE() AND p.end_date >= CURDATE()
                AND b.status = 'approved'
                ORDER BY p.is_featured DESC, p.created_at DESC";
        
        if ($limit) {
            $sql .= " LIMIT :limit OFFSET :offset";
        }
        
        $stmt = $this->db->prepare($sql);
        
        if ($limit) {
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        }
        
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function search($search = '', $businessId = '', $limit = 12, $offset = 0) {
        $sql = "SELECT p.*, b.business_name, b.logo as business_logo 
                FROM {$this->table} p 
                JOIN businesses b ON p.business_id = b.id 
                WHERE p.is_active = 1 
                AND p.start_date <= CURDATE() AND p.end_date >= CURDATE()
                AND b.status = 'approved'";
        $params = [];
        
        if (!empty($search)) {
            $sql .= " AND (p.title LIKE :search OR p.description LIKE :search)";
            $params['search'] = "%{$search}%";
        }
        
        if (!empty($businessId)) {
            $sql .= " AND p.business_id = :business_id";
            $params['business_id'] = $businessId;
        }
        
        $sql .= " ORDER BY p.is_featured DESC, p.created_at DESC LIMIT :limit OFFSET :offset";
        
        $stmt = $this->db->prepare($sql);
        
        foreach ($params as $key => $value) {
            $stmt->bindParam(":{$key}", $params[$key]);
        }
        
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function countSearch($search = '', $businessId = '') {
        $sql = "SELECT COUNT(*) as total FROM {$this->table} p 
                JOIN businesses b ON p.business_id = b.id 
                WHERE p.is_active = 1 
                AND p.start_date <= CURDATE() AND p.end_date >= CURDATE()
                AND b.status = 'approved'";
        $params = [];
        
        if (!empty($search)) {
            $sql .= " AND (p.title LIKE :search OR p.description LIKE :search)";
            $params['search'] = "%{$search}%";
        }
        
        if (!empty($businessId)) {
            $sql .= " AND p.business_id = :business_id";
            $params['business_id'] = $businessId;
        }
        
        $stmt = $this->db->prepare($sql);
        
        foreach ($params as $key => $value) {
            $stmt->bindParam(":{$key}", $params[$key]);
        }
        
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['total'];
    }
    
    public function getByBusiness($businessId) {
        $sql = "SELECT * FROM {$this->table} 
                WHERE business_id = :business_id AND is_active = 1 
                AND start_date <= CURDATE() AND end_date >= CURDATE()
                ORDER BY is_featured DESC, created_at DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':business_id', $businessId);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function canUsePromotion($promotionId, $userId) {
        // Check if user has reached max uses for this promotion
        $sql = "SELECT COUNT(*) as uses FROM transactions 
                WHERE promotion_id = :promotion_id AND user_id = :user_id";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':promotion_id', $promotionId);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        $result = $stmt->fetch();
        
        $promotion = $this->getById($promotionId);
        if (!$promotion) return false;
        
        // Check individual user limit
        if ($promotion['max_uses_per_user'] && $result['uses'] >= $promotion['max_uses_per_user']) {
            return false;
        }
        
        // Check total uses limit
        if ($promotion['total_max_uses'] && $promotion['current_uses'] >= $promotion['total_max_uses']) {
            return false;
        }
        
        // Check if promotion is still valid
        $today = date('Y-m-d');
        if ($promotion['start_date'] > $today || $promotion['end_date'] < $today) {
            return false;
        }
        
        return true;
    }
    
    public function incrementUses($promotionId) {
        $sql = "UPDATE {$this->table} SET current_uses = current_uses + 1 WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $promotionId);
        return $stmt->execute();
    }
    
    public function getByUserMembership($membershipLevel) {
        $sql = "SELECT p.*, b.business_name, b.logo as business_logo 
                FROM {$this->table} p 
                JOIN businesses b ON p.business_id = b.id 
                WHERE p.is_active = 1 
                AND p.start_date <= CURDATE() AND p.end_date >= CURDATE()
                AND b.status = 'approved'
                AND (p.membership_required = :membership OR p.membership_required = 'free')
                ORDER BY p.is_featured DESC, p.created_at DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':membership', $membershipLevel);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
?>