CREATE DATABASE IF NOT EXISTS `jonesauto_db`;
USE `jonesauto_db`;

CREATE TABLE IF NOT EXISTS `Vehicle` (
    `vehicle_id` INT AUTO_INCREMENT PRIMARY KEY,
    `make` VARCHAR(50) NOT NULL,
    `model` VARCHAR(50) NOT NULL,
    `year` INT NOT NULL,
    `color` VARCHAR(30),
    `miles` INT,
    `condition` VARCHAR(30),
    `book_price` DECIMAL(10,2),
    `style` VARCHAR(30),
    `interior_color` VARCHAR(30),
    `status` VARCHAR(20) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `Seller` (
    `seller_id` INT AUTO_INCREMENT PRIMARY KEY,
    `seller_name` VARCHAR(100) NOT NULL,
    `seller_type` VARCHAR(30),
    `phone` VARCHAR(20),
    `address` VARCHAR(100),
    `city` VARCHAR(50),
    `state` VARCHAR(50),
    `zip` VARCHAR(15)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `Buyer` (
    `buyer_id` INT AUTO_INCREMENT PRIMARY KEY,
    `first_name` VARCHAR(50) NOT NULL,
    `last_name` VARCHAR(50) NOT NULL,
    `phone` VARCHAR(20),
    `email` VARCHAR(100)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `Customer` (
    `customer_id` INT AUTO_INCREMENT PRIMARY KEY,
    `first_name` VARCHAR(50) NOT NULL,
    `last_name` VARCHAR(50) NOT NULL,
    `phone` VARCHAR(20),
    `address` VARCHAR(100),
    `city` VARCHAR(50),
    `state` VARCHAR(50),
    `zip` VARCHAR(15),
    `gender` VARCHAR(20),
    `date_of_birth` DATE,
    `tax_payer_id` VARCHAR(30),
    `number_of_late_payments` INT DEFAULT 0,
    `average_days_late` DECIMAL(5,2) DEFAULT 0.00
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `Salesperson` (
    `salesperson_id` INT AUTO_INCREMENT PRIMARY KEY,
    `first_name` VARCHAR(50) NOT NULL,
    `last_name` VARCHAR(50) NOT NULL,
    `phone` VARCHAR(20)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `Warranty_Policy` (
    `policy_id` INT AUTO_INCREMENT PRIMARY KEY,
    `policy_name` VARCHAR(100) NOT NULL,
    `component_type` VARCHAR(50),
    `coverage_description` TEXT,
    `standard_length` INT,
    `standard_cost` DECIMAL(10,2),
    `standard_deductible` DECIMAL(10,2)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `Purchase` (
    `purchase_id` INT AUTO_INCREMENT PRIMARY KEY,
    `vehicle_id` INT NOT NULL UNIQUE,
    `buyer_id` INT NOT NULL,
    `seller_id` INT NOT NULL,
    `purchase_date` DATE NOT NULL,
    `location` VARCHAR(100),
    `is_auction` BOOLEAN,
    `price_paid` DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (`vehicle_id`) REFERENCES `Vehicle`(`vehicle_id`),
    FOREIGN KEY (`buyer_id`) REFERENCES `Buyer`(`buyer_id`),
    FOREIGN KEY (`seller_id`) REFERENCES `Seller`(`seller_id`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `Employment_History` (
    `employment_id` INT AUTO_INCREMENT PRIMARY KEY,
    `customer_id` INT NOT NULL,
    `employer` VARCHAR(100) NOT NULL,
    `title` VARCHAR(50),
    `supervisor_name` VARCHAR(100),
    `supervisor_phone` VARCHAR(20),
    `employer_address` VARCHAR(100),
    `start_date` DATE,
    FOREIGN KEY (`customer_id`) REFERENCES `Customer`(`customer_id`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `Sale` (
    `sale_id` INT AUTO_INCREMENT PRIMARY KEY,
    `vehicle_id` INT NOT NULL UNIQUE,
    `customer_id` INT NOT NULL,
    `salesperson_id` INT NOT NULL,
    `sale_date` DATE NOT NULL,
    `total_due` DECIMAL(10,2) NOT NULL,
    `down_payment` DECIMAL(10,2) NOT NULL,
    `financed_amount` DECIMAL(10,2) NOT NULL,
    `sale_price` DECIMAL(10,2) NOT NULL,
    `salesperson_commission` DECIMAL(10,2),
    FOREIGN KEY (`vehicle_id`) REFERENCES `Vehicle`(`vehicle_id`),
    FOREIGN KEY (`customer_id`) REFERENCES `Customer`(`customer_id`),
    FOREIGN KEY (`salesperson_id`) REFERENCES `Salesperson`(`salesperson_id`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `Repair` (
    `repair_id` INT AUTO_INCREMENT PRIMARY KEY,
    `purchase_id` INT NOT NULL,
    `vehicle_id` INT NOT NULL,
    `problem_number` INT,
    `problem_description` VARCHAR(255) NOT NULL,
    `estimated_repair_cost` DECIMAL(10,2),
    `actual_repair_cost` DECIMAL(10,2),
    FOREIGN KEY (`purchase_id`) REFERENCES `Purchase`(`purchase_id`),
    FOREIGN KEY (`vehicle_id`) REFERENCES `Vehicle`(`vehicle_id`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `Warranty_Sale` (
    `warranty_sale_id` INT AUTO_INCREMENT PRIMARY KEY,
    `sale_id` INT NOT NULL,
    `policy_id` INT NOT NULL,
    `vehicle_id` INT NOT NULL,
    `customer_id` INT NOT NULL,
    `salesperson_id` INT NOT NULL,
    `warranty_sale_date` DATE NOT NULL,
    `warranty_start_date` DATE,
    `warranty_length` INT,
    `deductible` DECIMAL(10,2),
    `total_cost` DECIMAL(10,2) NOT NULL,
    `monthly_cost` DECIMAL(10,2),
    `paid_upfront_flag` BOOLEAN,
    FOREIGN KEY (`sale_id`) REFERENCES `Sale`(`sale_id`),
    FOREIGN KEY (`policy_id`) REFERENCES `Warranty_Policy`(`policy_id`),
    FOREIGN KEY (`vehicle_id`) REFERENCES `Vehicle`(`vehicle_id`),
    FOREIGN KEY (`customer_id`) REFERENCES `Customer`(`customer_id`),
    FOREIGN KEY (`salesperson_id`) REFERENCES `Salesperson`(`salesperson_id`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `Payment` (
    `payment_id` INT AUTO_INCREMENT PRIMARY KEY,
    `customer_id` INT NOT NULL,
    `sale_id` INT NOT NULL,
    `warranty_sale_id` INT NULL,
    `payment_date` DATE NOT NULL,
    `due_date` DATE NOT NULL,
    `paid_date` DATE,
    `amount` DECIMAL(10,2) NOT NULL,
    `bank_account` VARCHAR(50),
    FOREIGN KEY (`customer_id`) REFERENCES `Customer`(`customer_id`),
    FOREIGN KEY (`sale_id`) REFERENCES `Sale`(`sale_id`),
    FOREIGN KEY (`warranty_sale_id`) REFERENCES `Warranty_Sale`(`warranty_sale_id`)
) ENGINE=InnoDB;
