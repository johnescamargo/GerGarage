-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `gerGarage` DEFAULT CHARACTER SET utf8 ;
USE `gerGarage` ;

-- -----------------------------------------------------
-- Table `gerGarage`.`Customer`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gerGarage`.`Customer` (
  `email` VARCHAR(30) NOT NULL,
  `Name` VARCHAR(45) NULL,
  `Surname` VARCHAR(45) NULL,
  `Mob_phone` INT NULL,
  `Gender` VARCHAR(1) NULL,
  `Password` VARCHAR(45) NULL,
  PRIMARY KEY (`email`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gerGarage`.`Vehicle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gerGarage`.`Vehicle` (
  `License` VARCHAR(15) NOT NULL,
  `Type` VARCHAR(45) NULL,
  `Engine_type` VARCHAR(45) NULL,
  `Make` VARCHAR(45) NULL,
  `Customer_email` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`License`, `Customer_email`),
  INDEX `fk_Vehicle_Customer_idx` (`Customer_email` ASC) VISIBLE,
  CONSTRAINT `fk_Vehicle_Customer`
    FOREIGN KEY (`Customer_email`)
    REFERENCES `gerGarage`.`Customer` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Booking`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gerGarage`.`Booking` (
  `id_Booking` INT NOT NULL AUTO_INCREMENT,
  `Service_type` VARCHAR(45) NULL,
  `Comment` VARCHAR(150) NULL,
  `Date` DATETIME NULL,
  `Customer_email` VARCHAR(30) NOT NULL,
  `Vehicle_License` VARCHAR(15) NOT NULL,
  `Vehicle_Customer_email` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`id_Booking`, `Customer_email`, `Vehicle_License`, `Vehicle_Customer_email`),
  INDEX `fk_Booking_Customer1_idx` (`Customer_email` ASC) VISIBLE,
  INDEX `fk_Booking_Vehicle1_idx` (`Vehicle_License` ASC, `Vehicle_Customer_email` ASC) VISIBLE,
  CONSTRAINT `fk_Booking_Customer1`
    FOREIGN KEY (`Customer_email`)
    REFERENCES `gerGarage`.`Customer` (`email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Booking_Vehicle1`
    FOREIGN KEY (`Vehicle_License` , `Vehicle_Customer_email`)
    REFERENCES `gerGarage`.`Vehicle` (`License` , `Customer_email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Services`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gerGarage`.`Services` (
  `id_Services` INT NOT NULL,
  `Service_name` VARCHAR(45) NULL,
  `Service_price` DOUBLE NULL,
  PRIMARY KEY (`id_Services`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`User_Admin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gerGarage`.`User_Admin` (
  `Email` VARCHAR(45) NOT NULL,
  `Name` VARCHAR(45) NULL,
  `Surname` VARCHAR(45) NULL,
  `Password` VARCHAR(45) NULL,
  PRIMARY KEY (`Email`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`List_of_bookings`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gerGarage`.`List_of_bookings` (
  `idList_of_bookings` INT NOT NULL,
  `Status` VARCHAR(45) NULL,
  `Date` DATETIME NULL,
  `Booking_id_Booking` INT NOT NULL,
  `Booking_Customer_email` VARCHAR(30) NOT NULL,
  `Booking_Vehicle_License` VARCHAR(15) NOT NULL,
  `Booking_Vehicle_Customer_email` VARCHAR(30) NOT NULL,
  `Services_id_Services` INT NOT NULL,
  PRIMARY KEY (`idList_of_bookings`, `Booking_id_Booking`, `Booking_Customer_email`, `Booking_Vehicle_License`, `Booking_Vehicle_Customer_email`, `Services_id_Services`),
  INDEX `fk_List_of_bookings_Booking1_idx` (`Booking_id_Booking` ASC, `Booking_Customer_email` ASC, `Booking_Vehicle_License` ASC, `Booking_Vehicle_Customer_email` ASC) VISIBLE,
  INDEX `fk_List_of_bookings_Services1_idx` (`Services_id_Services` ASC) VISIBLE,
  CONSTRAINT `fk_List_of_bookings_Booking1`
    FOREIGN KEY (`Booking_id_Booking` , `Booking_Customer_email` , `Booking_Vehicle_License` , `Booking_Vehicle_Customer_email`)
    REFERENCES `gerGarage`.`Booking` (`id_Booking` , `Customer_email` , `Vehicle_License` , `Vehicle_Customer_email`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_List_of_bookings_Services1`
    FOREIGN KEY (`Services_id_Services`)
    REFERENCES `gerGarage`.`Services` (`id_Services`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_List_of_bookings_User_Admin1`
    FOREIGN KEY (`Services_id_Services`)
    REFERENCES `gerGarage`.`User_Admin` (`Surname`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
