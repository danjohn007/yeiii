<?php

class DigitalCard extends Model {
    protected $table = 'digital_cards';
    
    public function createForUser($userId) {
        // Generate unique card number
        $cardNumber = $this->generateCardNumber();
        
        // Generate QR code
        $qrCode = 'QR-YEIII-' . $cardNumber . '-' . substr(md5($userId . time()), 0, 8);
        
        $cardData = [
            'user_id' => $userId,
            'card_number' => $cardNumber,
            'qr_code' => $qrCode,
            'card_type' => 'digital',
            'membership_level' => 'free',
            'is_active' => 1
        ];
        
        return $this->create($cardData);
    }
    
    private function generateCardNumber() {
        do {
            $cardNumber = 'YEIII-' . str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
        } while ($this->exists(['card_number' => $cardNumber]));
        
        return $cardNumber;
    }
    
    public function getByUser($userId) {
        $cards = $this->getWhere(['user_id' => $userId], 'id', 'DESC', 1);
        return !empty($cards) ? $cards[0] : null;
    }
    
    public function getByCardNumber($cardNumber) {
        $cards = $this->getWhere(['card_number' => $cardNumber], 'id', 'ASC', 1);
        return !empty($cards) ? $cards[0] : null;
    }
    
    public function getByQRCode($qrCode) {
        $cards = $this->getWhere(['qr_code' => $qrCode], 'id', 'ASC', 1);
        return !empty($cards) ? $cards[0] : null;
    }
    
    public function requestPhysicalCard($cardId, $deliveryAddress) {
        return $this->update($cardId, [
            'physical_requested' => 1,
            'physical_delivery_address' => $deliveryAddress,
            'physical_delivery_status' => 'pending'
        ]);
    }
    
    public function upgradeMembership($cardId, $level) {
        return $this->update($cardId, ['membership_level' => $level]);
    }
    
    public function getStats() {
        $sql = "SELECT 
                    membership_level,
                    COUNT(*) as count,
                    SUM(CASE WHEN physical_requested = 1 THEN 1 ELSE 0 END) as physical_requested_count,
                    SUM(CASE WHEN is_active = 1 THEN 1 ELSE 0 END) as active_count
                FROM {$this->table} 
                GROUP BY membership_level";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function getPhysicalCardRequests($status = null) {
        $sql = "SELECT dc.*, u.full_name, u.email, u.whatsapp 
                FROM {$this->table} dc 
                JOIN users u ON dc.user_id = u.id 
                WHERE dc.physical_requested = 1";
        
        if ($status) {
            $sql .= " AND dc.physical_delivery_status = :status";
        }
        
        $sql .= " ORDER BY dc.created_at DESC";
        
        $stmt = $this->db->prepare($sql);
        
        if ($status) {
            $stmt->bindParam(':status', $status);
        }
        
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function updatePhysicalCardStatus($cardId, $status) {
        return $this->update($cardId, ['physical_delivery_status' => $status]);
    }
    
    public function validateCard($identifier, $type = 'qr') {
        $sql = "SELECT dc.*, u.full_name, u.email, u.role, u.status as user_status 
                FROM {$this->table} dc 
                JOIN users u ON dc.user_id = u.id 
                WHERE dc.is_active = 1 AND u.status = 'active'";
        
        if ($type === 'qr') {
            $sql .= " AND dc.qr_code = :identifier";
        } elseif ($type === 'card') {
            $sql .= " AND dc.card_number = :identifier";
        } elseif ($type === 'phone') {
            $sql .= " AND u.whatsapp = :identifier";
        }
        
        $sql .= " LIMIT 1";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':identifier', $identifier);
        $stmt->execute();
        return $stmt->fetch();
    }
}
?>