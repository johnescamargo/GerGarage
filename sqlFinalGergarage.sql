-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema gergarage
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema gergarage
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `gergarage` DEFAULT CHARACTER SET utf8 ;
USE `gergarage` ;

-- -----------------------------------------------------
-- Table `gergarage`.`customer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gergarage`.`customer` (
  `email` VARCHAR(30) NOT NULL,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `surname` VARCHAR(45) NULL DEFAULT NULL,
  `mob_phone` INT(11) NULL DEFAULT NULL,
  `gender` VARCHAR(1) NULL DEFAULT NULL,
  `password` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`email`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `gergarage`.`staff`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gergarage`.`staff` (
  `id_staff` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `surname` VARCHAR(45) NULL DEFAULT NULL,
  `mob_phone` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id_staff`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `gergarage`.`vehicle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gergarage`.`vehicle` (
  `license` VARCHAR(15) NOT NULL,
  `type` VARCHAR(45) NULL DEFAULT NULL,
  `engine_type` VARCHAR(45) NULL DEFAULT NULL,
  `make` VARCHAR(45) NULL DEFAULT NULL,
  `customer_email` VARCHAR(30) NULL DEFAULT NULL,
  PRIMARY KEY (`license`),
  INDEX `fk_Vehicle_Customer_idx` (`customer_email` ASC) ,
  CONSTRAINT `fk_Vehicle_Customer`
    FOREIGN KEY (`customer_email`)
    REFERENCES `gergarage`.`customer` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `gergarage`.`booking`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gergarage`.`booking` (
  `id_booking` INT(11) NOT NULL AUTO_INCREMENT,
  `service_type` VARCHAR(45) NULL DEFAULT NULL,
  `comment` VARCHAR(150) NULL DEFAULT NULL,
  `date` DATE NULL DEFAULT NULL,
  `customer_email` VARCHAR(30) NULL DEFAULT NULL,
  `vehicle_license` VARCHAR(15) NULL DEFAULT NULL,
  `status` VARCHAR(45) NULL DEFAULT NULL,
  `staff_id_staff` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_booking`),
  INDEX `fk_Booking_Customer1_idx` (`customer_email` ASC) ,
  INDEX `fk_booking_vehicle1_idx` (`vehicle_license` ASC) ,
  INDEX `fk_booking_staff1_idx` (`staff_id_staff` ASC) ,
  CONSTRAINT `fk_Booking_Customer1`
    FOREIGN KEY (`customer_email`)
    REFERENCES `gergarage`.`customer` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_booking_staff1`
    FOREIGN KEY (`staff_id_staff`)
    REFERENCES `gergarage`.`staff` (`id_staff`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_booking_vehicle1`
    FOREIGN KEY (`vehicle_license`)
    REFERENCES `gergarage`.`vehicle` (`license`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 84
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `gergarage`.`invoice`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gergarage`.`invoice` (
  `id_invoice` INT(11) NOT NULL,
  `total_price` DOUBLE NULL,
  `date` DATE NOT NULL,
  `booking_id_booking` INT(11) NOT NULL,
  `vehicle_license` VARCHAR(15) NOT NULL,
  `customer_email` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`id_invoice`),
  INDEX `fk_invoice_booking1_idx` (`booking_id_booking` ASC) ,
  INDEX `fk_invoice_vehicle1_idx` (`vehicle_license` ASC) ,
  INDEX `fk_invoice_customer1_idx` (`customer_email` ASC) ,
  CONSTRAINT `fk_invoice_booking1`
    FOREIGN KEY (`booking_id_booking`)
    REFERENCES `gergarage`.`booking` (`id_booking`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_invoice_vehicle1`
    FOREIGN KEY (`vehicle_license`)
    REFERENCES `gergarage`.`vehicle` (`license`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_invoice_customer1`
    FOREIGN KEY (`customer_email`)
    REFERENCES `gergarage`.`customer` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `gergarage`.`services`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gergarage`.`services` (
  `id_services` INT(11) NOT NULL,
  `service_name` VARCHAR(45) NULL DEFAULT NULL,
  `service_price` DOUBLE NULL DEFAULT NULL,
  `invoice_id_invoice` INT(11) NOT NULL,
  PRIMARY KEY (`id_services`),
  INDEX `fk_services_invoice1_idx` (`invoice_id_invoice` ASC) ,
  CONSTRAINT `fk_services_invoice1`
    FOREIGN KEY (`invoice_id_invoice`)
    REFERENCES `gergarage`.`invoice` (`id_invoice`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `gergarage`.`useradmin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gergarage`.`useradmin` (
  `email` VARCHAR(45) NOT NULL,
  `name` VARCHAR(45) NULL DEFAULT NULL,
  `surname` VARCHAR(45) NULL DEFAULT NULL,
  `password` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`email`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `gergarage`.`service_cost`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gergarage`.`service_cost` (
  `id_service` INT NOT NULL,
  `name_service` VARCHAR(45) NOT NULL,
  `cost_service` DOUBLE NOT NULL,
  PRIMARY KEY (`id_service`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
