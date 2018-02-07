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
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`projects`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`projects` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(25) NULL,
  `name` VARCHAR(255) NOT NULL,
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
  PRIMARY KEY (`id`),
  INDEX `fk_products_product_categories1_idx` (`product_categories_id` ASC),
  INDEX `fk_products_colours1_idx` (`colours_id` ASC),
  CONSTRAINT `fk_products_product_categories1`
    FOREIGN KEY (`product_categories_id`)
    REFERENCES `megahjaya2`.`product_categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_products_colours1`
    FOREIGN KEY (`colours_id`)
    REFERENCES `megahjaya2`.`colours` (`id`)
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
-- Table `megahjaya2`.`materials`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`materials` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(10) NULL,
  `name` VARCHAR(255) NOT NULL,
  `unit` VARCHAR(20) NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  `material_categories_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_materials_material_categories_idx` (`material_categories_id` ASC),
  CONSTRAINT `fk_materials_material_categories`
    FOREIGN KEY (`material_categories_id`)
    REFERENCES `megahjaya2`.`material_categories` (`id`)
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
  `unit_price` FLOAT NULL,
  `total_price` FLOAT NULL,
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
  `project_details_id` INT UNSIGNED NOT NULL,
  `qty` FLOAT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `code_UNIQUE` (`code` ASC),
  INDEX `fk_work_orders_project_details1_idx` (`project_details_id` ASC),
  CONSTRAINT `fk_work_orders_project_details1`
    FOREIGN KEY (`project_details_id`)
    REFERENCES `megahjaya2`.`project_details` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`productions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`productions` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(45) NULL,
  `production_date` DATETIME NOT NULL,
  `created_at` DATETIME NOT NULL,
  `created_by` VARCHAR(100) NULL,
  `updated_at` DATETIME NULL,
  `updated_by` VARCHAR(100) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`production_details`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`production_details` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `productions_id` INT UNSIGNED NOT NULL,
  `work_orders_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_production_details_productions1_idx` (`productions_id` ASC),
  INDEX `fk_production_details_work_orders1_idx` (`work_orders_id` ASC),
  CONSTRAINT `fk_production_details_productions1`
    FOREIGN KEY (`productions_id`)
    REFERENCES `megahjaya2`.`productions` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_production_details_work_orders1`
    FOREIGN KEY (`work_orders_id`)
    REFERENCES `megahjaya2`.`work_orders` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
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
-- Table `megahjaya2`.`purchasing`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`purchasing` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(45) NOT NULL,
  `delivery_date` DATETIME NOT NULL,
  `delivery_place` VARCHAR(255) NULL,
  `created_at` DATETIME NOT NULL,
  `created_by` VARCHAR(100) NULL,
  `updated_at` DATETIME NULL,
  `updated_by` VARCHAR(100) NULL,
  `note` TEXT NULL,
  `vendors_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `code_UNIQUE` (`code` ASC),
  INDEX `fk_purchasing_vendors1_idx` (`vendors_id` ASC),
  CONSTRAINT `fk_purchasing_vendors1`
    FOREIGN KEY (`vendors_id`)
    REFERENCES `megahjaya2`.`vendors` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`purchase_details`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`purchase_details` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `qty` FLOAT NULL,
  `unit_price` FLOAT NULL,
  `total_price` VARCHAR(45) NULL,
  `purchasing_id` INT UNSIGNED NOT NULL,
  `materials_id` INT UNSIGNED NOT NULL,
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
  PRIMARY KEY (`id`),
  INDEX `fk_receiving_purchasing1_idx` (`purchasing_id` ASC),
  CONSTRAINT `fk_receiving_purchasing1`
    FOREIGN KEY (`purchasing_id`)
    REFERENCES `megahjaya2`.`purchasing` (`id`)
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
-- Table `megahjaya2`.`material_usage`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`material_usage` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(45) NULL,
  `usage_date` DATETIME NOT NULL,
  `production_details_id` INT UNSIGNED NOT NULL,
  `usage_categories_id` INT UNSIGNED NOT NULL,
  `created_at` DATETIME NULL,
  `created_by` VARCHAR(100) NULL,
  `updated_at` DATETIME NULL,
  `updated_by` VARCHAR(100) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_material_usage_production_details1_idx` (`production_details_id` ASC),
  INDEX `fk_material_usage_usage_categories1_idx` (`usage_categories_id` ASC),
  CONSTRAINT `fk_material_usage_production_details1`
    FOREIGN KEY (`production_details_id`)
    REFERENCES `megahjaya2`.`production_details` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_material_usage_usage_categories1`
    FOREIGN KEY (`usage_categories_id`)
    REFERENCES `megahjaya2`.`usage_categories` (`id`)
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
-- Table `megahjaya2`.`product_receiving`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`product_receiving` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` VARCHAR(45) NULL,
  `receive_date` DATETIME NOT NULL,
  `processes_id` INT UNSIGNED NOT NULL,
  `processes_id1` INT UNSIGNED NOT NULL,
  `created_at` DATETIME NULL,
  `created_by` VARCHAR(100) NULL,
  `updated_at` DATETIME NULL,
  `updated_by` VARCHAR(100) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_product_receiving_processes1_idx` (`processes_id` ASC),
  INDEX `fk_product_receiving_processes2_idx` (`processes_id1` ASC),
  CONSTRAINT `fk_product_receiving_processes1`
    FOREIGN KEY (`processes_id`)
    REFERENCES `megahjaya2`.`processes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_receiving_processes2`
    FOREIGN KEY (`processes_id1`)
    REFERENCES `megahjaya2`.`processes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`product_receiving_details`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`product_receiving_details` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `qty` FLOAT NOT NULL,
  `note` VARCHAR(255) NULL,
  `product_receiving_id` INT UNSIGNED NOT NULL,
  `products_id` INT UNSIGNED NOT NULL,
  `production_details_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_product_receiving_details_product_receiving1_idx` (`product_receiving_id` ASC),
  INDEX `fk_product_receiving_details_products1_idx` (`products_id` ASC),
  INDEX `fk_product_receiving_details_production_details1_idx` (`production_details_id` ASC),
  CONSTRAINT `fk_product_receiving_details_product_receiving1`
    FOREIGN KEY (`product_receiving_id`)
    REFERENCES `megahjaya2`.`product_receiving` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_receiving_details_products1`
    FOREIGN KEY (`products_id`)
    REFERENCES `megahjaya2`.`products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_receiving_details_production_details1`
    FOREIGN KEY (`production_details_id`)
    REFERENCES `megahjaya2`.`production_details` (`id`)
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
  `id` INT(2) UNSIGNED NOT NULL,
  `menu` VARCHAR(50) NULL,
  `parent_id` INT(2) UNSIGNED NULL,
  `order` INT(2) NULL,
  `link` VARCHAR(50) NULL,
  `icon` VARCHAR(50) NULL,
  `category` VARCHAR(50) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`previllage`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`previllage` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `view` TINYINT NULL DEFAULT 0,
  `add` TINYINT NULL DEFAULT 0,
  `update` TINYINT NULL DEFAULT 0,
  `delete` TINYINT NULL,
  `roles_id` INT UNSIGNED NOT NULL,
  `menu_id` INT(2) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_previllage_roles1_idx` (`roles_id` ASC),
  INDEX `fk_previllage_menu1_idx` (`menu_id` ASC),
  CONSTRAINT `fk_previllage_roles1`
    FOREIGN KEY (`roles_id`)
    REFERENCES `megahjaya2`.`roles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_previllage_menu1`
    FOREIGN KEY (`menu_id`)
    REFERENCES `megahjaya2`.`menu` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`product_movement`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`product_movement` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` DATETIME NULL,
  `qty` FLOAT NULL,
  `production_details_id` INT UNSIGNED NOT NULL,
  `processes_id` INT UNSIGNED NOT NULL,
  `product_movement_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_product_movement_production_details1_idx` (`production_details_id` ASC),
  INDEX `fk_product_movement_processes1_idx` (`processes_id` ASC),
  INDEX `fk_product_movement_product_movement1_idx` (`product_movement_id` ASC),
  CONSTRAINT `fk_product_movement_production_details1`
    FOREIGN KEY (`production_details_id`)
    REFERENCES `megahjaya2`.`production_details` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_movement_processes1`
    FOREIGN KEY (`processes_id`)
    REFERENCES `megahjaya2`.`processes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_movement_product_movement1`
    FOREIGN KEY (`product_movement_id`)
    REFERENCES `megahjaya2`.`product_movement` (`id`)
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
  `id` INT NOT NULL,
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
  `s_return_details_id` INT NULL,
  `product_receiving_details_id` INT UNSIGNED NULL,
  `qty` FLOAT NULL DEFAULT 0,
  `products_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_product_inventory_product_shipping_detail1_idx` (`product_shipping_detail_id` ASC),
  INDEX `fk_product_inventory_s_return_details1_idx` (`s_return_details_id` ASC),
  INDEX `fk_product_inventory_product_receiving_details1_idx` (`product_receiving_details_id` ASC),
  INDEX `fk_product_inventory_products1_idx` (`products_id` ASC),
  CONSTRAINT `fk_product_inventory_product_shipping_detail1`
    FOREIGN KEY (`product_shipping_detail_id`)
    REFERENCES `megahjaya2`.`product_shipping_detail` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_inventory_s_return_details1`
    FOREIGN KEY (`s_return_details_id`)
    REFERENCES `megahjaya2`.`s_return_details` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_inventory_product_receiving_details1`
    FOREIGN KEY (`product_receiving_details_id`)
    REFERENCES `megahjaya2`.`product_receiving_details` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_inventory_products1`
    FOREIGN KEY (`products_id`)
    REFERENCES `megahjaya2`.`products` (`id`)
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
  `material_usage_details_id` INT UNSIGNED NULL,
  `material_return_detail_id` INT UNSIGNED NULL,
  `qty` FLOAT NULL DEFAULT 0,
  `materials_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_material_inventory_receive_details1_idx` (`receive_details_id` ASC),
  INDEX `fk_material_inventory_p_return_details1_idx` (`p_return_details_id` ASC),
  INDEX `fk_material_inventory_material_usage_details1_idx` (`material_usage_details_id` ASC),
  INDEX `fk_material_inventory_material_return_detail1_idx` (`material_return_detail_id` ASC),
  INDEX `fk_material_inventory_materials1_idx` (`materials_id` ASC),
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
  CONSTRAINT `fk_material_inventory_material_usage_details1`
    FOREIGN KEY (`material_usage_details_id`)
    REFERENCES `megahjaya2`.`material_usage_details` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_material_inventory_material_return_detail1`
    FOREIGN KEY (`material_return_detail_id`)
    REFERENCES `megahjaya2`.`material_return_detail` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_material_inventory_materials1`
    FOREIGN KEY (`materials_id`)
    REFERENCES `megahjaya2`.`materials` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`currency`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`currency` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `symbol` VARCHAR(5) NULL,
  `name` VARCHAR(45) NULL,
  `currency` FLOAT NULL,
  PRIMARY KEY (`id`))
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
  PRIMARY KEY (`id`))
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
-- Data for table `megahjaya2`.`menu`
-- -----------------------------------------------------
START TRANSACTION;
USE `megahjaya2`;
INSERT INTO `megahjaya2`.`menu` (`id`, `menu`, `parent_id`, `order`, `link`, `icon`, `category`) VALUES (1, 'Dashboard', 0, NULL, 'dashboard', 'zmdi-home', 'Dashboard');
INSERT INTO `megahjaya2`.`menu` (`id`, `menu`, `parent_id`, `order`, `link`, `icon`, `category`) VALUES (2, 'Master', 0, NULL, '', 'zmdi-smartphone-setup', 'Activities');
INSERT INTO `megahjaya2`.`menu` (`id`, `menu`, `parent_id`, `order`, `link`, `icon`, `category`) VALUES (3, 'Customers', 2, NULL, 'customers', NULL, '');
INSERT INTO `megahjaya2`.`menu` (`id`, `menu`, `parent_id`, `order`, `link`, `icon`, `category`) VALUES (4, 'Material Categories', 2, NULL, 'material_categories', NULL, NULL);
INSERT INTO `megahjaya2`.`menu` (`id`, `menu`, `parent_id`, `order`, `link`, `icon`, `category`) VALUES (5, 'Materials', 2, NULL, 'materials', NULL, NULL);
INSERT INTO `megahjaya2`.`menu` (`id`, `menu`, `parent_id`, `order`, `link`, `icon`, `category`) VALUES (6, 'Processes', 2, NULL, 'processes', NULL, NULL);
INSERT INTO `megahjaya2`.`menu` (`id`, `menu`, `parent_id`, `order`, `link`, `icon`, `category`) VALUES (7, 'Products Categories', 2, NULL, 'product_categories', NULL, NULL);
INSERT INTO `megahjaya2`.`menu` (`id`, `menu`, `parent_id`, `order`, `link`, `icon`, `category`) VALUES (8, 'Products', 2, NULL, 'products', NULL, NULL);
INSERT INTO `megahjaya2`.`menu` (`id`, `menu`, `parent_id`, `order`, `link`, `icon`, `category`) VALUES (9, 'Usage Categories', 2, NULL, 'usage_categories', NULL, NULL);
INSERT INTO `megahjaya2`.`menu` (`id`, `menu`, `parent_id`, `order`, `link`, `icon`, `category`) VALUES (10, 'Vendors', 2, NULL, 'vendors', NULL, NULL);
INSERT INTO `megahjaya2`.`menu` (`id`, `menu`, `parent_id`, `order`, `link`, `icon`, `category`) VALUES (11, 'Sales', 0, NULL, NULL, 'zmdi-smartphone-setup', 'Activities');
INSERT INTO `megahjaya2`.`menu` (`id`, `menu`, `parent_id`, `order`, `link`, `icon`, `category`) VALUES (12, 'Sales Orders', 11, NULL, 'sales_orders', NULL, NULL);
INSERT INTO `megahjaya2`.`menu` (`id`, `menu`, `parent_id`, `order`, `link`, `icon`, `category`) VALUES (13, 'Shippings', 11, NULL, 'shippings', NULL, NULL);

COMMIT;

