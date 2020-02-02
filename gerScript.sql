-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema GerGarage
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema GerGarage
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `GerGarage` DEFAULT CHARACTER SET utf8 ;
USE `GerGarage` ;

-- -----------------------------------------------------
-- Table `GerGarage`.`Customer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GerGarage`.`Customer` (
  `email` VARCHAR(30) NOT NULL,
  `Name` VARCHAR(45) NULL,
  `Surname` VARCHAR(45) NULL,
  `Mob_phone` INT NULL,
  `Gender` VARCHAR(1) NULL,
  `Password` VARCHAR(45) NULL,
  PRIMARY KEY (`email`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GerGarage`.`ListOfBookings`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GerGarage`.`ListOfBookings` (
  `idList_of_bookings` INT NOT NULL AUTO_INCREMENT,
  `Status` VARCHAR(45) NULL,
  PRIMARY KEY (`idList_of_bookings`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GerGarage`.`Booking`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GerGarage`.`Booking` (
  `id_Booking` INT NOT NULL AUTO_INCREMENT,
  `Service_type` VARCHAR(45) NULL,
  `Comment` VARCHAR(150) NULL,
  `Date` DATETIME NULL,
  `Customer_email` VARCHAR(30) NOT NULL,
  `ListOfBookings_idList_of_bookings` INT NOT NULL,
  PRIMARY KEY (`id_Booking`),
  INDEX `fk_Booking_Customer1_idx` (`Customer_email` ASC),
  INDEX `fk_Booking_ListOfBookings1_idx` (`ListOfBookings_idList_of_bookings` ASC) ,
  CONSTRAINT `fk_Booking_Customer1`
    FOREIGN KEY (`Customer_email`)
    REFERENCES `GerGarage`.`Customer` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Booking_ListOfBookings1`
    FOREIGN KEY (`ListOfBookings_idList_of_bookings`)
    REFERENCES `GerGarage`.`ListOfBookings` (`idList_of_bookings`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GerGarage`.`Vehicle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GerGarage`.`Vehicle` (
  `License` VARCHAR(15) NOT NULL,
  `Type` VARCHAR(45) NULL,
  `Engine_type` VARCHAR(45) NULL,
  `Make` VARCHAR(45) NULL,
  `Customer_email` VARCHAR(30) NULL,
  `Booking_id_Booking` INT NOT NULL,
  PRIMARY KEY (`License`),
  INDEX `fk_Vehicle_Customer_idx` (`Customer_email` ASC) ,
  INDEX `fk_Vehicle_Booking1_idx` (`Booking_id_Booking` ASC) ,
  CONSTRAINT `fk_Vehicle_Customer`
    FOREIGN KEY (`Customer_email`)
    REFERENCES `GerGarage`.`Customer` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Vehicle_Booking1`
    FOREIGN KEY (`Booking_id_Booking`)
    REFERENCES `GerGarage`.`Booking` (`id_Booking`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GerGarage`.`Services`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GerGarage`.`Services` (
  `id_Services` INT NOT NULL,
  `Service_name` VARCHAR(45) NULL,
  `Service_price` DOUBLE NULL,
  `ListOfBookings_idList_of_bookings` INT NOT NULL,
  PRIMARY KEY (`id_Services`),
  INDEX `fk_Services_ListOfBookings1_idx` (`ListOfBookings_idList_of_bookings` ASC) ,
  CONSTRAINT `fk_Services_ListOfBookings1`
    FOREIGN KEY (`ListOfBookings_idList_of_bookings`)
    REFERENCES `GerGarage`.`ListOfBookings` (`idList_of_bookings`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `GerGarage`.`UserAdmin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `GerGarage`.`UserAdmin` (
  `Email` VARCHAR(45) NOT NULL,
  `Name` VARCHAR(45) NULL,
  `Surname` VARCHAR(45) NULL,
  `Password` VARCHAR(45) NULL,
  PRIMARY KEY (`Email`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
