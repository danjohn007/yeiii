-- Sample data for YEIII Platform

-- Insert sample users with different roles
INSERT INTO `users` (`email`, `password`, `full_name`, `whatsapp`, `birth_date`, `role`, `status`, `email_verified`) VALUES
('admin@yeiii.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Super Administrador', '+52155123456789', '1985-06-15', 'superadmin', 'active', 1),
('gestor@yeiii.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Gestor Regional', '+52155987654321', '1988-03-22', 'gestor', 'active', 1),
('capturista@yeiii.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'María Capturista', '+52155456789123', '1992-08-10', 'capturista', 'active', 1),
('restaurante@ejemplo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Restaurante El Buen Sabor', '+52155234567890', '1980-12-05', 'comercio', 'active', 1),
('farmacia@ejemplo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Farmacia San Juan', '+52155345678901', '1975-04-18', 'comercio', 'active', 1),
('juan.perez@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Juan Pérez García', '+52155567890123', '1995-11-28', 'usuario', 'active', 1),
('maria.gonzalez@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'María González López', '+52155678901234', '1990-07-14', 'usuario', 'active', 1),
('carlos.rodriguez@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Carlos Rodríguez Martín', '+52155789012345', '1987-09-03', 'usuario', 'active', 1);

-- Insert sample businesses
INSERT INTO `businesses` (`user_id`, `business_name`, `business_type`, `address`, `phone`, `description`, `opening_hours`, `latitude`, `longitude`, `rfc`, `legal_representative`, `status`) VALUES
(4, 'Restaurante El Buen Sabor', 'Restaurante', 'Av. Revolución 1234, Col. Centro, Ciudad de México', '+52155234567890', 'Restaurante familiar con comida mexicana tradicional y ambiente acogedor', '{"monday":"09:00-22:00","tuesday":"09:00-22:00","wednesday":"09:00-22:00","thursday":"09:00-22:00","friday":"09:00-23:00","saturday":"09:00-23:00","sunday":"10:00-21:00"}', 19.4326, -99.1332, 'RBS850605ABC', 'Roberto Sánchez Martínez', 'approved'),
(5, 'Farmacia San Juan', 'Farmacia', 'Calle Juárez 567, Col. San Juan, Ciudad de México', '+52155345678901', 'Farmacia con servicio las 24 horas, medicamentos genéricos y de patente', '{"monday":"00:00-23:59","tuesday":"00:00-23:59","wednesday":"00:00-23:59","thursday":"00:00-23:59","friday":"00:00-23:59","saturday":"00:00-23:59","sunday":"00:00-23:59"}', 19.4284, -99.1276, 'FSJ750418DEF', 'Ana Patricia Morales', 'approved');

-- Insert sample digital cards
INSERT INTO `digital_cards` (`user_id`, `card_number`, `qr_code`, `card_type`, `membership_level`, `is_active`) VALUES
(6, 'YEIII-000001', 'QR-YEIII-000001-JP', 'digital', 'free', 1),
(7, 'YEIII-000002', 'QR-YEIII-000002-MG', 'digital', 'premium', 1),
(8, 'YEIII-000003', 'QR-YEIII-000003-CR', 'digital', 'free', 1);

-- Insert sample promotions
INSERT INTO `promotions` (`business_id`, `title`, `description`, `discount_type`, `discount_value`, `terms_conditions`, `start_date`, `end_date`, `max_uses_per_user`, `total_max_uses`, `minimum_purchase`, `applicable_days`, `applicable_hours`, `membership_required`, `is_active`, `is_featured`) VALUES
(1, '20% de descuento en platillos principales', 'Obtén 20% de descuento en todos nuestros platillos principales de lunes a viernes', 'percentage', 20.00, 'Válido de lunes a viernes. No aplica con otras promociones. Mínimo de consumo $200', '2024-01-01', '2024-12-31', 2, 1000, 200.00, '["monday","tuesday","wednesday","thursday","friday"]', '{"start":"12:00","end":"20:00"}', 'free', 1, 1),
(1, 'Postre gratis en cenas románticas', 'Postre cortesía de la casa en cenas para dos personas los fines de semana', 'other', 0.00, 'Válido sábados y domingos después de las 7 PM. Mínimo 2 personas. Una promoción por mesa', '2024-01-01', '2024-12-31', 1, 500, 400.00, '["saturday","sunday"]', '{"start":"19:00","end":"22:00"}', 'premium', 1, 0),
(2, '15% de descuento en medicamentos', 'Descuento del 15% en medicamentos genéricos y vitaminas', 'percentage', 15.00, 'No aplica en medicamentos controlados. Válido todos los días', '2024-01-01', '2024-12-31', 5, 2000, 100.00, '["monday","tuesday","wednesday","thursday","friday","saturday","sunday"]', '{"start":"00:00","end":"23:59"}', 'free', 1, 1),
(2, 'Consulta médica gratuita', 'Consulta médica general sin costo con doctor certificado', 'other', 0.00, 'Previa cita. De lunes a viernes. Una consulta por mes por usuario', '2024-01-01', '2024-12-31', 1, 300, 0.00, '["monday","tuesday","wednesday","thursday","friday"]', '{"start":"09:00","end":"17:00"}', 'premium', 1, 1);

-- Insert sample transactions
INSERT INTO `transactions` (`user_id`, `business_id`, `promotion_id`, `card_id`, `transaction_code`, `original_amount`, `discount_amount`, `final_amount`, `validation_method`, `transaction_date`) VALUES
(6, 1, 1, 1, 'TXN-001-2024', 350.00, 70.00, 280.00, 'qr_scan', '2024-01-15 14:30:00'),
(7, 2, 3, 2, 'TXN-002-2024', 250.00, 37.50, 212.50, 'phone_verification', '2024-01-16 10:15:00'),
(8, 1, 1, 3, 'TXN-003-2024', 420.00, 84.00, 336.00, 'qr_scan', '2024-01-17 19:45:00'),
(6, 2, 3, 1, 'TXN-004-2024', 180.00, 27.00, 153.00, 'qr_scan', '2024-01-18 16:20:00');

-- Insert sample favorites
INSERT INTO `user_favorites` (`user_id`, `business_id`) VALUES
(6, 1),
(6, 2),
(7, 1),
(8, 2);

-- Insert sample email logs
INSERT INTO `email_logs` (`user_id`, `email_to`, `email_subject`, `email_type`, `status`, `sent_at`) VALUES
(6, 'juan.perez@email.com', 'Bienvenido a YEIII Platform', 'welcome', 'sent', '2024-01-10 09:00:00'),
(7, 'maria.gonzalez@email.com', 'Bienvenido a YEIII Platform', 'welcome', 'sent', '2024-01-11 10:30:00'),
(8, 'carlos.rodriguez@email.com', 'Bienvenido a YEIII Platform', 'welcome', 'sent', '2024-01-12 11:15:00'),
(6, 'juan.perez@email.com', 'Nuevas promociones disponibles', 'newsletter', 'sent', '2024-01-15 08:00:00');

-- Note: All passwords are hashed version of "password123" for testing purposes