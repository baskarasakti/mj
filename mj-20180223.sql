-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema megahjaya2
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema megahjaya2
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `megahjaya2` DEFAULT CHARACTER SET utf8 ;
USE `megahjaya2` ;

-- -----------------------------------------------------
-- Table `megahjaya2`.`customers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`customers` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(25) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `description` VARCHAR(255) NULL,
  `address` VARCHAR(255) NOT NULL,
  `telp` VARCHAR(50) NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  `ppn` TINYINT NULL DEFAULT 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`projects`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`projects` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(25) NULL,
  `vat` TINYINT NULL DEFAULT 0,
  `description` VARCHAR(255) NULL,
  `created_at` DATETIME NOT NULL,
  `created_by` VARCHAR(100) NULL,
  `updated_at` DATETIME NULL,
  `updated by` VARCHAR(100) NULL,
  `customers_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_projects_customers1_idx` (`customers_id` ASC),
  CONSTRAINT `fk_projects_customers1`
    FOREIGN KEY (`customers_id`)
    REFERENCES `megahjaya2`.`customers` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`product_categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`product_categories` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `slug` VARCHAR(50) NOT NULL,
  `parent_id` INT UNSIGNED NULL DEFAULT 0,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`colours`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`colours` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(5) NULL,
  `name` VARCHAR(255) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`uom`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`uom` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(25) NULL,
  `symbol` VARCHAR(10) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`products` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(10) NULL,
  `name` VARCHAR(255) NOT NULL,
  `unit` VARCHAR(20) NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  `product_categories_id` INT UNSIGNED NOT NULL,
  `colours_id` INT UNSIGNED NULL,
  `qty` FLOAT NULL,
  `half_qty` FLOAT NULL,
  `uom_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_products_product_categories1_idx` (`product_categories_id` ASC),
  INDEX `fk_products_colours1_idx` (`colours_id` ASC),
  INDEX `fk_products_uom1_idx` (`uom_id` ASC),
  CONSTRAINT `fk_products_product_categories1`
    FOREIGN KEY (`product_categories_id`)
    REFERENCES `megahjaya2`.`product_categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_products_colours1`
    FOREIGN KEY (`colours_id`)
    REFERENCES `megahjaya2`.`colours` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_products_uom1`
    FOREIGN KEY (`uom_id`)
    REFERENCES `megahjaya2`.`uom` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`material_categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`material_categories` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `parent_id` INT UNSIGNED NULL DEFAULT 0,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`vendors`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`vendors` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(45) NULL,
  `name` VARCHAR(255) NOT NULL,
  `description` VARCHAR(255) NULL,
  `address` VARCHAR(255) NOT NULL,
  `telp` VARCHAR(25) NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`materials`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`materials` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(10) NULL,
  `name` VARCHAR(255) NOT NULL,
  `min_stock` FLOAT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  `material_categories_id` INT UNSIGNED NOT NULL,
  `vendors_id` INT UNSIGNED NULL,
  `uom_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_materials_material_categories_idx` (`material_categories_id` ASC),
  INDEX `fk_materials_vendors1_idx` (`vendors_id` ASC),
  INDEX `fk_materials_uom1_idx` (`uom_id` ASC),
  CONSTRAINT `fk_materials_material_categories`
    FOREIGN KEY (`material_categories_id`)
    REFERENCES `megahjaya2`.`material_categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_materials_vendors1`
    FOREIGN KEY (`vendors_id`)
    REFERENCES `megahjaya2`.`vendors` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_materials_uom1`
    FOREIGN KEY (`uom_id`)
    REFERENCES `megahjaya2`.`uom` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`product_materials`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`product_materials` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `products_id` INT UNSIGNED NOT NULL,
  `materials_id` INT UNSIGNED NOT NULL,
  `qty` FLOAT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `fk_product_materials_products1_idx` (`products_id` ASC),
  INDEX `fk_product_materials_materials1_idx` (`materials_id` ASC),
  CONSTRAINT `fk_product_materials_products1`
    FOREIGN KEY (`products_id`)
    REFERENCES `megahjaya2`.`products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_materials_materials1`
    FOREIGN KEY (`materials_id`)
    REFERENCES `megahjaya2`.`materials` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`roles` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `email` VARCHAR(50) NULL,
  `name` VARCHAR(50) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `address` VARCHAR(255) NULL,
  `telp` VARCHAR(25) NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  `roles_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  INDEX `fk_users_roles1_idx` (`roles_id` ASC),
  CONSTRAINT `fk_users_roles1`
    FOREIGN KEY (`roles_id`)
    REFERENCES `megahjaya2`.`roles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`processes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`processes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`product_process`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`product_process` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `processes_id` INT UNSIGNED NOT NULL,
  `products_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_product_process_processes1_idx` (`processes_id` ASC),
  INDEX `fk_product_process_products1_idx` (`products_id` ASC),
  CONSTRAINT `fk_product_process_processes1`
    FOREIGN KEY (`processes_id`)
    REFERENCES `megahjaya2`.`processes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_process_products1`
    FOREIGN KEY (`products_id`)
    REFERENCES `megahjaya2`.`products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`project_details`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`project_details` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `qty` FLOAT NULL,
  `projects_id` INT UNSIGNED NOT NULL,
  `products_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_project_details_projects1_idx` (`projects_id` ASC),
  INDEX `fk_project_details_products1_idx` (`products_id` ASC),
  CONSTRAINT `fk_project_details_projects1`
    FOREIGN KEY (`projects_id`)
    REFERENCES `megahjaya2`.`projects` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_project_details_products1`
    FOREIGN KEY (`products_id`)
    REFERENCES `megahjaya2`.`products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`work_orders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`work_orders` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(50) NULL,
  `start_date` DATETIME NOT NULL,
  `end_date` DATETIME NOT NULL,
  `ppn` TINYINT NULL DEFAULT 0,
  `created_at` DATETIME NOT NULL,
  `created_by` VARCHAR(100) NULL,
  `updated_at` DATETIME NULL,
  `updated_by` VARCHAR(100) NULL,
  `qty` FLOAT NULL,
  `projects_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `code_UNIQUE` (`code` ASC),
  INDEX `fk_work_orders_projects1_idx` (`projects_id` ASC),
  CONSTRAINT `fk_work_orders_projects1`
    FOREIGN KEY (`projects_id`)
    REFERENCES `megahjaya2`.`projects` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`currency`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`currency` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(25) NULL,
  `symbol` VARCHAR(10) NULL,
  `rate` FLOAT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`purchasing`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`purchasing` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(45) NOT NULL,
  `vat` TINYINT NULL DEFAULT 0,
  `delivery_date` DATETIME NOT NULL,
  `delivery_place` VARCHAR(255) NULL,
  `created_at` DATETIME NOT NULL,
  `created_by` VARCHAR(100) NULL,
  `updated_at` DATETIME NULL,
  `updated_by` VARCHAR(100) NULL,
  `note` TEXT NULL,
  `vendors_id` INT UNSIGNED NOT NULL,
  `currency_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `code_UNIQUE` (`code` ASC),
  INDEX `fk_purchasing_vendors1_idx` (`vendors_id` ASC),
  INDEX `fk_purchasing_currency1_idx` (`currency_id` ASC),
  CONSTRAINT `fk_purchasing_vendors1`
    FOREIGN KEY (`vendors_id`)
    REFERENCES `megahjaya2`.`vendors` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_purchasing_currency1`
    FOREIGN KEY (`currency_id`)
    REFERENCES `megahjaya2`.`currency` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`purchase_details`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`purchase_details` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `purchasing_id` INT UNSIGNED NOT NULL,
  `materials_id` INT UNSIGNED NOT NULL,
  `qty` FLOAT NULL,
  `rechrome` TINYINT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `fk_purchase_details_purchasing1_idx` (`purchasing_id` ASC),
  INDEX `fk_purchase_details_materials1_idx` (`materials_id` ASC),
  CONSTRAINT `fk_purchase_details_purchasing1`
    FOREIGN KEY (`purchasing_id`)
    REFERENCES `megahjaya2`.`purchasing` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_purchase_details_materials1`
    FOREIGN KEY (`materials_id`)
    REFERENCES `megahjaya2`.`materials` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`receiving`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`receiving` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(45) NOT NULL,
  `receive_date` DATETIME NOT NULL,
  `created_at` DATETIME NOT NULL,
  `created_by` VARCHAR(100) NULL,
  `updated_at` DATETIME NULL,
  `updated_by` VARCHAR(100) NULL,
  `purchasing_id` INT UNSIGNED NOT NULL,
  `doc_path` VARCHAR(255) NULL,
  `currency_id` INT UNSIGNED NOT NULL,
  `delivery_order` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_receiving_purchasing1_idx` (`purchasing_id` ASC),
  INDEX `fk_receiving_currency1_idx` (`currency_id` ASC),
  CONSTRAINT `fk_receiving_purchasing1`
    FOREIGN KEY (`purchasing_id`)
    REFERENCES `megahjaya2`.`purchasing` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_receiving_currency1`
    FOREIGN KEY (`currency_id`)
    REFERENCES `megahjaya2`.`currency` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`receive_details`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`receive_details` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `qty` FLOAT NOT NULL,
  `unit_price` FLOAT NOT NULL,
  `discount` FLOAT NULL,
  `total_price` FLOAT NOT NULL,
  `receiving_id` INT UNSIGNED NOT NULL,
  `materials_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_receive_details_receiving1_idx` (`receiving_id` ASC),
  INDEX `fk_receive_details_materials1_idx` (`materials_id` ASC),
  CONSTRAINT `fk_receive_details_receiving1`
    FOREIGN KEY (`receiving_id`)
    REFERENCES `megahjaya2`.`receiving` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_receive_details_materials1`
    FOREIGN KEY (`materials_id`)
    REFERENCES `megahjaya2`.`materials` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`usage_categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`usage_categories` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`machine`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`machine` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(45) NULL,
  `processes_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_machine_processes1_idx` (`processes_id` ASC),
  CONSTRAINT `fk_machine_processes1`
    FOREIGN KEY (`processes_id`)
    REFERENCES `megahjaya2`.`processes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`material_usage`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`material_usage` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(45) NULL,
  `usage_date` DATETIME NOT NULL,
  `usage_categories_id` INT UNSIGNED NOT NULL,
  `created_at` DATETIME NULL,
  `created_by` VARCHAR(100) NULL,
  `updated_at` DATETIME NULL,
  `updated_by` VARCHAR(100) NULL,
  `machine_id` INT UNSIGNED NOT NULL,
  `work_orders_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_material_usage_usage_categories1_idx` (`usage_categories_id` ASC),
  INDEX `fk_material_usage_machine1_idx` (`machine_id` ASC),
  INDEX `fk_material_usage_work_orders1_idx` (`work_orders_id` ASC),
  CONSTRAINT `fk_material_usage_usage_categories1`
    FOREIGN KEY (`usage_categories_id`)
    REFERENCES `megahjaya2`.`usage_categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_material_usage_machine1`
    FOREIGN KEY (`machine_id`)
    REFERENCES `megahjaya2`.`machine` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_material_usage_work_orders1`
    FOREIGN KEY (`work_orders_id`)
    REFERENCES `megahjaya2`.`work_orders` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`material_usage_categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`material_usage_categories` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `material_categories_id` INT UNSIGNED NOT NULL,
  `usage_categories_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_material_usage_categories_material_categories1_idx` (`material_categories_id` ASC),
  INDEX `fk_material_usage_categories_usage_categories1_idx` (`usage_categories_id` ASC),
  CONSTRAINT `fk_material_usage_categories_material_categories1`
    FOREIGN KEY (`material_categories_id`)
    REFERENCES `megahjaya2`.`material_categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_material_usage_categories_usage_categories1`
    FOREIGN KEY (`usage_categories_id`)
    REFERENCES `megahjaya2`.`usage_categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`material_usage_details`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`material_usage_details` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `qty` FLOAT NULL,
  `note` VARCHAR(255) NULL,
  `material_usage_id` INT UNSIGNED NOT NULL,
  `materials_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_material_usage_details_material_usage1_idx` (`material_usage_id` ASC),
  INDEX `fk_material_usage_details_materials1_idx` (`materials_id` ASC),
  CONSTRAINT `fk_material_usage_details_material_usage1`
    FOREIGN KEY (`material_usage_id`)
    REFERENCES `megahjaya2`.`material_usage` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_material_usage_details_materials1`
    FOREIGN KEY (`materials_id`)
    REFERENCES `megahjaya2`.`materials` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`product_movement`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`product_movement` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` DATETIME NULL,
  `created_by` VARCHAR(100) NULL,
  `updated_at` DATETIME NULL,
  `updated_by` VARCHAR(100) NULL,
  `work_orders_id` INT UNSIGNED NOT NULL,
  `products_id` INT UNSIGNED NOT NULL,
  `machine_id` INT UNSIGNED NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_product_movement_work_orders1_idx` (`work_orders_id` ASC),
  INDEX `fk_product_movement_products1_idx` (`products_id` ASC),
  INDEX `fk_product_movement_machine1_idx` (`machine_id` ASC),
  CONSTRAINT `fk_product_movement_work_orders1`
    FOREIGN KEY (`work_orders_id`)
    REFERENCES `megahjaya2`.`work_orders` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_movement_products1`
    FOREIGN KEY (`products_id`)
    REFERENCES `megahjaya2`.`products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_movement_machine1`
    FOREIGN KEY (`machine_id`)
    REFERENCES `megahjaya2`.`machine` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`product_movement_details`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`product_movement_details` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(50) NULL,
  `date` DATETIME NULL,
  `product_movement_id` INT UNSIGNED NULL,
  `qty` FLOAT NULL,
  `processes_id` INT(2) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_product_movement_details_product_movement1_idx` (`product_movement_id` ASC),
  CONSTRAINT `fk_product_movement_details_product_movement1`
    FOREIGN KEY (`product_movement_id`)
    REFERENCES `megahjaya2`.`product_movement` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`product_shipping`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`product_shipping` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(45) NULL,
  `shipping_date` DATETIME NOT NULL,
  `transport` VARCHAR(100) NULL,
  `note` VARCHAR(255) NULL,
  `created_at` DATETIME NOT NULL,
  `created_by` VARCHAR(100) NULL,
  `updated_at` DATETIME NULL,
  `updated_by` VARCHAR(100) NULL,
  `projects_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_product_shipping_projects1_idx` (`projects_id` ASC),
  CONSTRAINT `fk_product_shipping_projects1`
    FOREIGN KEY (`projects_id`)
    REFERENCES `megahjaya2`.`projects` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`product_shipping_detail`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`product_shipping_detail` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `qty` FLOAT NOT NULL,
  `unit_price` FLOAT NOT NULL,
  `total_price` FLOAT NOT NULL,
  `product_shipping_id` INT UNSIGNED NOT NULL,
  `products_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_product_shipping_detail_product_shipping1_idx` (`product_shipping_id` ASC),
  INDEX `fk_product_shipping_detail_products1_idx` (`products_id` ASC),
  CONSTRAINT `fk_product_shipping_detail_product_shipping1`
    FOREIGN KEY (`product_shipping_id`)
    REFERENCES `megahjaya2`.`product_shipping` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_shipping_detail_products1`
    FOREIGN KEY (`products_id`)
    REFERENCES `megahjaya2`.`products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`material_return`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`material_return` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(45) NULL,
  `return_date` DATETIME NOT NULL,
  `created_at` DATETIME NULL,
  `created_by` VARCHAR(100) NULL,
  `updated_at` DATETIME NULL,
  `updated_by` VARCHAR(100) NULL,
  `material_usage_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_matrial_return_material_usage1_idx` (`material_usage_id` ASC),
  CONSTRAINT `fk_matrial_return_material_usage1`
    FOREIGN KEY (`material_usage_id`)
    REFERENCES `megahjaya2`.`material_usage` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`material_return_detail`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`material_return_detail` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `qty` FLOAT NULL,
  `note` VARCHAR(255) NULL,
  `materials_id` INT UNSIGNED NOT NULL,
  `material_return_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_material_return_detail_materials1_idx` (`materials_id` ASC),
  INDEX `fk_material_return_detail_material_return1_idx` (`material_return_id` ASC),
  CONSTRAINT `fk_material_return_detail_materials1`
    FOREIGN KEY (`materials_id`)
    REFERENCES `megahjaya2`.`materials` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_material_return_detail_material_return1`
    FOREIGN KEY (`material_return_id`)
    REFERENCES `megahjaya2`.`material_return` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`ci_sessions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`ci_sessions` (
  `id` VARCHAR(128) NOT NULL,
  `ip_address` VARCHAR(45) NOT NULL,
  `timestamp` INT(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` BLOB NOT NULL,
  INDEX `ci_sessions_timestamp` (`timestamp` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`menu`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`menu` (
  `id` INT(2) UNSIGNED NOT NULL AUTO_INCREMENT,
  `menu` VARCHAR(50) NULL,
  `parent_id` INT(2) UNSIGNED NULL,
  `order` INT(2) NULL,
  `link` VARCHAR(50) NULL,
  `icon` VARCHAR(50) NULL,
  `category` VARCHAR(50) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`previlege`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`previlege` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `view` TINYINT NULL DEFAULT 0,
  `add` TINYINT NULL DEFAULT 0,
  `update` TINYINT NULL DEFAULT 0,
  `delete` TINYINT NULL,
  `roles_id` INT UNSIGNED NOT NULL,
  `menu_id` INT(2) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_previllage_roles1_idx` (`roles_id` ASC),
  INDEX `fk_previlege_menu1_idx` (`menu_id` ASC),
  CONSTRAINT `fk_previllage_roles1`
    FOREIGN KEY (`roles_id`)
    REFERENCES `megahjaya2`.`roles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_previlege_menu1`
    FOREIGN KEY (`menu_id`)
    REFERENCES `megahjaya2`.`menu` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`purchase_return`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`purchase_return` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(45) NULL,
  `date` DATETIME NULL,
  `created_at` DATETIME NULL,
  `created_by` VARCHAR(100) NULL,
  `updated_at` DATETIME NULL,
  `updated_by` VARCHAR(100) NULL,
  `receiving_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_return_receiving1_idx` (`receiving_id` ASC),
  CONSTRAINT `fk_return_receiving1`
    FOREIGN KEY (`receiving_id`)
    REFERENCES `megahjaya2`.`receiving` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`p_return_details`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`p_return_details` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `qty` FLOAT NULL,
  `note` TEXT NULL,
  `return_id` INT UNSIGNED NOT NULL,
  `materials_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_return_details_return1_idx` (`return_id` ASC),
  INDEX `fk_p_return_details_materials1_idx` (`materials_id` ASC),
  CONSTRAINT `fk_return_details_return1`
    FOREIGN KEY (`return_id`)
    REFERENCES `megahjaya2`.`purchase_return` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_p_return_details_materials1`
    FOREIGN KEY (`materials_id`)
    REFERENCES `megahjaya2`.`materials` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`sales_return`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`sales_return` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(45) NULL,
  `date` DATETIME NULL,
  `created_at` DATETIME NULL,
  `created_by` VARCHAR(100) NULL,
  `updated_at` DATETIME NULL,
  `updated_by` VARCHAR(100) NULL,
  `product_shipping_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_sales_return_product_shipping1_idx` (`product_shipping_id` ASC),
  CONSTRAINT `fk_sales_return_product_shipping1`
    FOREIGN KEY (`product_shipping_id`)
    REFERENCES `megahjaya2`.`product_shipping` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`s_return_details`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`s_return_details` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `qty` FLOAT NULL,
  `note` TEXT NULL,
  `sales_return_id` INT UNSIGNED NOT NULL,
  `products_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_s_return_details_sales_return1_idx` (`sales_return_id` ASC),
  INDEX `fk_s_return_details_products1_idx` (`products_id` ASC),
  CONSTRAINT `fk_s_return_details_sales_return1`
    FOREIGN KEY (`sales_return_id`)
    REFERENCES `megahjaya2`.`sales_return` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_s_return_details_products1`
    FOREIGN KEY (`products_id`)
    REFERENCES `megahjaya2`.`products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`product_inventory`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`product_inventory` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` DATETIME NULL,
  `type` VARCHAR(5) NULL,
  `product_shipping_detail_id` INT UNSIGNED NULL,
  `qty` FLOAT NULL DEFAULT 0,
  `products_id` INT UNSIGNED NOT NULL,
  `s_return_details_id` INT UNSIGNED NULL,
  `product_movement_id` INT UNSIGNED NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_product_inventory_product_shipping_detail1_idx` (`product_shipping_detail_id` ASC),
  INDEX `fk_product_inventory_products1_idx` (`products_id` ASC),
  INDEX `fk_product_inventory_s_return_details1_idx` (`s_return_details_id` ASC),
  INDEX `fk_product_inventory_product_movement1_idx` (`product_movement_id` ASC),
  CONSTRAINT `fk_product_inventory_product_shipping_detail1`
    FOREIGN KEY (`product_shipping_detail_id`)
    REFERENCES `megahjaya2`.`product_shipping_detail` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_inventory_products1`
    FOREIGN KEY (`products_id`)
    REFERENCES `megahjaya2`.`products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_inventory_s_return_details1`
    FOREIGN KEY (`s_return_details_id`)
    REFERENCES `megahjaya2`.`s_return_details` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_inventory_product_movement1`
    FOREIGN KEY (`product_movement_id`)
    REFERENCES `megahjaya2`.`product_movement` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`material_usages`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`material_usages` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` DATETIME NULL,
  `code_pick` VARCHAR(45) NULL,
  `code_return` VARCHAR(45) NULL,
  `created_at` DATETIME NULL,
  `created_by` VARCHAR(45) NULL,
  `updated_at` DATETIME NULL,
  `updated_by` VARCHAR(45) NULL,
  `work_orders_id` INT UNSIGNED NOT NULL,
  `machine_id` INT UNSIGNED NOT NULL,
  `usage_categories_id` INT UNSIGNED NULL,
  `products_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_material_usages_work_orders1_idx` (`work_orders_id` ASC),
  INDEX `fk_material_usages_machine1_idx` (`machine_id` ASC),
  INDEX `fk_material_usages_usage_categories1_idx` (`usage_categories_id` ASC),
  INDEX `fk_material_usages_products1_idx` (`products_id` ASC),
  CONSTRAINT `fk_material_usages_work_orders1`
    FOREIGN KEY (`work_orders_id`)
    REFERENCES `megahjaya2`.`work_orders` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_material_usages_machine1`
    FOREIGN KEY (`machine_id`)
    REFERENCES `megahjaya2`.`machine` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_material_usages_usage_categories1`
    FOREIGN KEY (`usage_categories_id`)
    REFERENCES `megahjaya2`.`usage_categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_material_usages_products1`
    FOREIGN KEY (`products_id`)
    REFERENCES `megahjaya2`.`products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`material_usages_detail`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`material_usages_detail` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `qty_pick` FLOAT NULL DEFAULT 0,
  `qty_return` FLOAT NULL DEFAULT 0,
  `pick_note` VARCHAR(255) NULL,
  `return_note` VARCHAR(255) NULL,
  `materials_id` INT UNSIGNED NOT NULL,
  `material_usages_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_material_usages_detail_materials1_idx` (`materials_id` ASC),
  INDEX `fk_material_usages_detail_material_usages1_idx` (`material_usages_id` ASC),
  CONSTRAINT `fk_material_usages_detail_materials1`
    FOREIGN KEY (`materials_id`)
    REFERENCES `megahjaya2`.`materials` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_material_usages_detail_material_usages1`
    FOREIGN KEY (`material_usages_id`)
    REFERENCES `megahjaya2`.`material_usages` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`material_inventory`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`material_inventory` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` DATETIME NULL,
  `type` VARCHAR(5) NULL,
  `receive_details_id` INT UNSIGNED NULL,
  `p_return_details_id` INT UNSIGNED NULL,
  `qty` FLOAT NULL DEFAULT 0,
  `materials_id` INT UNSIGNED NOT NULL,
  `adjustment` INT UNSIGNED NULL,
  `material_usages_detail_id` INT UNSIGNED NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_material_inventory_receive_details1_idx` (`receive_details_id` ASC),
  INDEX `fk_material_inventory_p_return_details1_idx` (`p_return_details_id` ASC),
  INDEX `fk_material_inventory_materials1_idx` (`materials_id` ASC),
  INDEX `fk_material_inventory_material_usages_detail1_idx` (`material_usages_detail_id` ASC),
  CONSTRAINT `fk_material_inventory_receive_details1`
    FOREIGN KEY (`receive_details_id`)
    REFERENCES `megahjaya2`.`receive_details` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_material_inventory_p_return_details1`
    FOREIGN KEY (`p_return_details_id`)
    REFERENCES `megahjaya2`.`p_return_details` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_material_inventory_materials1`
    FOREIGN KEY (`materials_id`)
    REFERENCES `megahjaya2`.`materials` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_material_inventory_material_usages_detail1`
    FOREIGN KEY (`material_usages_detail_id`)
    REFERENCES `megahjaya2`.`material_usages_detail` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`history`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`history` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` DATETIME NULL,
  `name` VARCHAR(255) NULL,
  `page` VARCHAR(255) NULL,
  `actions` VARCHAR(50) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`company_info`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`company_info` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NULL,
  `address` VARCHAR(255) NULL,
  `telp` VARCHAR(25) NULL,
  `logo_path` VARCHAR(255) NULL,
  `logo_title_path` VARCHAR(255) NULL,
  `taxpayer_reg_number` VARCHAR(100) NULL,
  `owner` VARCHAR(100) NULL,
  `currency_id` INT UNSIGNED NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_company_info_currency1_idx` (`currency_id` ASC),
  CONSTRAINT `fk_company_info_currency1`
    FOREIGN KEY (`currency_id`)
    REFERENCES `megahjaya2`.`currency` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`uom_converter`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`uom_converter` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `rate` FLOAT NULL,
  `uom_id` INT UNSIGNED NOT NULL,
  `uom_id1` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_uom_converter_uom1_idx` (`uom_id` ASC),
  INDEX `fk_uom_converter_uom2_idx` (`uom_id1` ASC),
  CONSTRAINT `fk_uom_converter_uom1`
    FOREIGN KEY (`uom_id`)
    REFERENCES `megahjaya2`.`uom` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_uom_converter_uom2`
    FOREIGN KEY (`uom_id1`)
    REFERENCES `megahjaya2`.`uom` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`process_dependency`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`process_dependency` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `processes_id` INT UNSIGNED NOT NULL,
  `processes_id1` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_process_dependency_processes1_idx` (`processes_id` ASC),
  INDEX `fk_process_dependency_processes2_idx` (`processes_id1` ASC),
  CONSTRAINT `fk_process_dependency_processes1`
    FOREIGN KEY (`processes_id`)
    REFERENCES `megahjaya2`.`processes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_process_dependency_processes2`
    FOREIGN KEY (`processes_id1`)
    REFERENCES `megahjaya2`.`processes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`request`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`request` (
  `id` INT NOT NULL,
  `date` DATETIME NULL,
  `code` VARCHAR(45) NULL,
  `created_at` DATETIME NULL,
  `created_by` VARCHAR(50) NULL,
  `updated_at` DATETIME NULL,
  `updated_by` VARCHAR(50) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`request_detail`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`request_detail` (
  `id` INT NOT NULL,
  `qty` FLOAT NULL,
  `request_id` INT NOT NULL,
  `materials_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_request_detail_request1_idx` (`request_id` ASC),
  INDEX `fk_request_detail_materials1_idx` (`materials_id` ASC),
  CONSTRAINT `fk_request_detail_request1`
    FOREIGN KEY (`request_id`)
    REFERENCES `megahjaya2`.`request` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_request_detail_materials1`
    FOREIGN KEY (`materials_id`)
    REFERENCES `megahjaya2`.`materials` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`work_order_detail`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`work_order_detail` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `qty` FLOAT NULL,
  `note` VARCHAR(255) NULL,
  `work_orders_id` INT UNSIGNED NOT NULL,
  `products_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_work_order_detail_work_orders1_idx` (`work_orders_id` ASC),
  INDEX `fk_work_order_detail_products1_idx` (`products_id` ASC),
  CONSTRAINT `fk_work_order_detail_work_orders1`
    FOREIGN KEY (`work_orders_id`)
    REFERENCES `megahjaya2`.`work_orders` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_work_order_detail_products1`
    FOREIGN KEY (`products_id`)
    REFERENCES `megahjaya2`.`products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`hpp`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`hpp` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `work_orders_id` INT UNSIGNED NOT NULL,
  `penyusutan` FLOAT NULL,
  `listrik` FLOAT NULL,
  `lain_lain` FLOAT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_hpp_work_orders1_idx` (`work_orders_id` ASC),
  CONSTRAINT `fk_hpp_work_orders1`
    FOREIGN KEY (`work_orders_id`)
    REFERENCES `megahjaya2`.`work_orders` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`btkl`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`btkl` (
  `id` INT NOT NULL,
  `qty` FLOAT NULL,
  `price` FLOAT NULL,
  `hpp_id` INT UNSIGNED NOT NULL,
  `processes_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_btkl_hpp1_idx` (`hpp_id` ASC),
  INDEX `fk_btkl_processes1_idx` (`processes_id` ASC),
  CONSTRAINT `fk_btkl_hpp1`
    FOREIGN KEY (`hpp_id`)
    REFERENCES `megahjaya2`.`hpp` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_btkl_processes1`
    FOREIGN KEY (`processes_id`)
    REFERENCES `megahjaya2`.`processes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `megahjaya2` ;

-- -----------------------------------------------------
-- Placeholder table for view `megahjaya2`.`material_stock`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`material_stock` (`id` INT, `name` INT, `total` INT);

-- -----------------------------------------------------
-- Placeholder table for view `megahjaya2`.`product_stock`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`product_stock` (`id` INT, `name` INT, `total` INT);

-- -----------------------------------------------------
-- View `megahjaya2`.`material_stock`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `megahjaya2`.`material_stock`;
USE `megahjaya2`;
CREATE  OR REPLACE VIEW `material_stock` AS
SELECT  materials_id as id, m.name as name, SUM(CASE WHEN type="in" THEN mi.qty ELSE 0 END) - SUM(CASE WHEN type="out" THEN mi.qty ELSE 0 END) AS total
FROM material_inventory mi
LEFT JOIN materials m ON mi.materials_id = m.id;

-- -----------------------------------------------------
-- View `megahjaya2`.`product_stock`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `megahjaya2`.`product_stock`;
USE `megahjaya2`;
CREATE  OR REPLACE VIEW `product_stock` AS
SELECT  products_id as id, p.name as name, SUM(CASE WHEN type="in" THEN pi.qty ELSE 0 END) - SUM(CASE WHEN type="out" THEN pi.qty ELSE 0 END) AS total
FROM product_inventory pi
LEFT JOIN products p ON pi.products_id = p.id;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `megahjaya2`.`roles`
-- -----------------------------------------------------
START TRANSACTION;
USE `megahjaya2`;
INSERT INTO `megahjaya2`.`roles` (`id`, `name`) VALUES (1, 'Admin');

COMMIT;


-- -----------------------------------------------------
-- Data for table `megahjaya2`.`users`
-- -----------------------------------------------------
START TRANSACTION;
USE `megahjaya2`;
INSERT INTO `megahjaya2`.`users` (`id`, `username`, `email`, `name`, `password`, `address`, `telp`, `created_at`, `updated_at`, `roles_id`) VALUES (1, 'admin', 'admin@mail.com', 'Admin Megahjaya', '$2y$10$jeczkYckxe90k3oSH9dmD.FAxAjamXH79unLVWkXdOQdd4CUOiBpm', 'Jl. Test No. 1', '123321123', DEFAULT, NULL, 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `megahjaya2`.`company_info`
-- -----------------------------------------------------
START TRANSACTION;
USE `megahjaya2`;
INSERT INTO `megahjaya2`.`company_info` (`id`, `name`, `address`, `telp`, `logo_path`, `logo_title_path`, `taxpayer_reg_number`, `owner`, `currency_id`) VALUES (1, 'Your Company Name', 'Your Company Address', '-', 'images/logo-dark.png', 'images/logo-text-dark.png', 'Your Company Tax Reg. Number', 'Your Company Owner', NULL);

COMMIT;

