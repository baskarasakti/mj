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
  `updated_at` DATETIME NULL,
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
-- Table `megahjaya2`.`products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`products` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
  `product_categories_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_products_product_categories1_idx` (`product_categories_id` ASC),
  CONSTRAINT `fk_products_product_categories1`
    FOREIGN KEY (`product_categories_id`)
    REFERENCES `megahjaya2`.`product_categories` (`id`)
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
  `name` VARCHAR(255) NOT NULL,
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
  `name` VARCHAR(50) NULL,
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
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
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
  `production_date` DATETIME NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NULL,
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
  `updated_at` DATETIME NULL,
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
  `updated_at` DATETIME NULL,
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
  `usage_date` DATETIME NOT NULL,
  `production_details_id` INT UNSIGNED NOT NULL,
  `usage_categories_id` INT UNSIGNED NOT NULL,
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
  `receive_date` DATETIME NOT NULL,
  `production_details_id` INT UNSIGNED NOT NULL,
  `processes_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_product_receiving_production_details1_idx` (`production_details_id` ASC),
  INDEX `fk_product_receiving_processes1_idx` (`processes_id` ASC),
  CONSTRAINT `fk_product_receiving_production_details1`
    FOREIGN KEY (`production_details_id`)
    REFERENCES `megahjaya2`.`production_details` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_receiving_processes1`
    FOREIGN KEY (`processes_id`)
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
  PRIMARY KEY (`id`),
  INDEX `fk_product_receiving_details_product_receiving1_idx` (`product_receiving_id` ASC),
  INDEX `fk_product_receiving_details_products1_idx` (`products_id` ASC),
  CONSTRAINT `fk_product_receiving_details_product_receiving1`
    FOREIGN KEY (`product_receiving_id`)
    REFERENCES `megahjaya2`.`product_receiving` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_receiving_details_products1`
    FOREIGN KEY (`products_id`)
    REFERENCES `megahjaya2`.`products` (`id`)
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
  `updated_at` DATETIME NULL,
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
-- Table `megahjaya2`.`matrial_return`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`matrial_return` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `return_date` DATETIME NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `megahjaya2`.`material_return_detail`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `megahjaya2`.`material_return_detail` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `qty` FLOAT NULL,
  `note` VARCHAR(255) NULL,
  `matrial_return_id` INT UNSIGNED NOT NULL,
  `materials_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_material_return_detail_matrial_return1_idx` (`matrial_return_id` ASC),
  INDEX `fk_material_return_detail_materials1_idx` (`materials_id` ASC),
  CONSTRAINT `fk_material_return_detail_matrial_return1`
    FOREIGN KEY (`matrial_return_id`)
    REFERENCES `megahjaya2`.`matrial_return` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_material_return_detail_materials1`
    FOREIGN KEY (`materials_id`)
    REFERENCES `megahjaya2`.`materials` (`id`)
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


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
