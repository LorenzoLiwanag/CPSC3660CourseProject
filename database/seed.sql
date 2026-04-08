-- seed.sql
-- Sample data for Lethbridge JonesAuto

USE `jonesauto_db`;

-- Sellers
INSERT INTO `Seller` (`seller_name`, `seller_type`, `phone`, `address`, `city`, `state`, `zip`) VALUES
('Lethbridge Auto Traders', 'Dealer', '403-555-0101', '111 Main St', 'Lethbridge', 'Alberta', 'T1H 1A1'),
('Prairie Car Auctions', 'Auction', '403-555-0202', '222 Market Ave', 'Lethbridge', 'Alberta', 'T1K 2B2'),
('Mountain Motors', 'Private', '403-555-0303', '333 Hill Rd', 'Lethbridge', 'Alberta', 'T1J 3C3');

-- Buyers
INSERT INTO `Buyer` (`first_name`, `last_name`, `phone`, `email`) VALUES
('Aaron', 'Brown', '403-555-1001', 'aaron.brown@example.com'),
('Beth', 'Carlson', '403-555-1002', 'beth.carlson@example.com'),
('Cindy', 'Davis', '403-555-1003', 'cindy.davis@example.com');

-- Customers
INSERT INTO `Customer` (`first_name`, `last_name`, `phone`, `address`, `city`, `state`, `zip`, `gender`, `date_of_birth`, `tax_payer_id`, `number_of_late_payments`, `average_days_late`) VALUES
('David', 'Evans', '403-555-2001', '10 College Way', 'Lethbridge', 'Alberta', 'T1K 4D4', 'Male', '1988-02-15', 'TX123456', 1, 2.00),
('Emily', 'Foster', '403-555-2002', '25 University Dr', 'Lethbridge', 'Alberta', 'T1K 5E5', 'Female', '1992-07-08', 'TX234567', 0, 0.00),
('Frank', 'Green', '403-555-2003', '40 River Rd', 'Lethbridge', 'Alberta', 'T1K 6F6', 'Male', '1975-11-30', 'TX345678', 2, 5.50),
('Grace', 'Hill', '403-555-2004', '55 Valley Way', 'Lethbridge', 'Alberta', 'T1K 7G7', 'Female', '1985-03-22', 'TX456789', 0, 0.00);

-- Salespersons
INSERT INTO `Salesperson` (`first_name`, `last_name`, `phone`) VALUES
('Henry', 'Irwin', '403-555-3001'),
('Isla', 'Jones', '403-555-3002'),
('Jake', 'King', '403-555-3003');

-- Vehicles
INSERT INTO `Vehicle` (`make`, `model`, `year`, `color`, `miles`, `condition`, `book_price`, `style`, `interior_color`, `status`) VALUES
('Toyota', 'Camry', 2015, 'Silver', 85000, 'Good', 13500.00, 'Sedan', 'Black', 'Available'),
('Honda', 'Civic', 2016, 'Blue', 76000, 'Good', 12500.00, 'Sedan', 'Gray', 'Available'),
('Ford', 'Escape', 2014, 'White', 92000, 'Fair', 11200.00, 'SUV', 'Beige', 'Available'),
('Chevrolet', 'Malibu', 2017, 'Red', 64000, 'Good', 14200.00, 'Sedan', 'Black', 'Available'),
('Nissan', 'Rogue', 2015, 'Green', 81000, 'Good', 13800.00, 'SUV', 'Gray', 'Available');

-- Purchases
INSERT INTO `Purchase` (`vehicle_id`, `buyer_id`, `seller_id`, `purchase_date`, `location`, `is_auction`, `price_paid`) VALUES
(1, 1, 1, '2024-01-10', 'Lethbridge', 0, 12000.00),
(2, 2, 2, '2024-02-18', 'Lethbridge', 1, 11000.00),
(3, 3, 3, '2024-03-22', 'Lethbridge', 0, 10500.00),
(4, 1, 1, '2024-04-05', 'Lethbridge', 0, 13000.00),
(5, 2, 2, '2024-05-12', 'Lethbridge', 1, 12800.00);

-- Repairs
INSERT INTO `Repair` (`purchase_id`, `vehicle_id`, `problem_number`, `problem_description`, `estimated_repair_cost`, `actual_repair_cost`) VALUES
(1, 1, 1, 'Front brake pads replacement', 400.00, 420.00),
(1, 1, 2, 'Oil change and filter', 75.00, 70.00),
(2, 2, 1, 'Battery replacement', 180.00, 175.00),
(3, 3, 1, 'AC compressor repair', 800.00, 820.00),
(5, 5, 1, 'Wheel alignment', 120.00, 115.00);

-- Warranty policies
INSERT INTO `Warranty_Policy` (`policy_name`, `component_type`, `coverage_description`, `standard_length`, `standard_cost`, `standard_deductible`) VALUES
('Basic Powertrain', 'Powertrain', 'Covers engine, transmission and drivetrain components.', 24, 950.00, 250.00),
('Premium Protection', 'Full Vehicle', 'Covers most major mechanical and electrical components.', 36, 1650.00, 200.00),
('Safety Systems', 'Safety', 'Covers airbags, ABS, and safety-related systems.', 18, 650.00, 150.00);
