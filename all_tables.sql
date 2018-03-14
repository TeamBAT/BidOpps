CREATE SCHEMA IF NOT EXISTS `bidopps_db` DEFAULT CHARACTER SET utf8 ;
USE `bidopps_db` ;

-- -----------------------------------------------------
-- Table `bidopps_db`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bidopps_db`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(32) NOT NULL,
  `join_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `firstname` VARCHAR(45) NULL,
  `lastname` VARCHAR(45) NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `bidopps_db`.`bidders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bidopps_db`.`bidders` (
  `user_id` INT NOT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `bidder_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `bidopps_db`.`users` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE);


-- -----------------------------------------------------
-- Table `bidopps_db`.`administrators`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bidopps_db`.`administrators` (
  `user_id` INT NOT NULL,
  `permissions` ENUM('Admin', 'Author', 'Reviewer', 'Approver', 'Screener', 'Evaluator', 'Finalizer') NOT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `admin_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `bidopps_db`.`users` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE);


-- -----------------------------------------------------
-- Table `bidopps_db`.`opportunities`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bidopps_db`.`opportunities` (
  `id` INT NOT NULL,
  `final_filing_date` DATETIME NOT NULL,
  `type` VARCHAR(45) NOT NULL,
  `category` VARCHAR(45) NOT NULL,
  `title` VARCHAR(45) NOT NULL,
  `description` TEXT NOT NULL,
  `posted_date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` INT NOT NULL,
  `validated` INT DEFAULT 0,
  `approved` INT DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `admin_id_idx` (`created_by` ASC),
  CONSTRAINT `created_by`
    FOREIGN KEY (`created_by`)
    REFERENCES `bidopps_db`.`administrators` (`user_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE);


-- -----------------------------------------------------
-- Table `bidopps_db`.`opportunity_docs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bidopps_db`.`opportunity_docs` (
  `document_id` INT NOT NULL AUTO_INCREMENT,
  `filename` VARCHAR(45) NOT NULL,
  `filetype` VARCHAR(45) NOT NULL,
  `filesize` VARCHAR(45) NOT NULL,
  `data` LONGBLOB NULL,
  `opportunity_id` INT NOT NULL,
  PRIMARY KEY (`document_id`),
  INDEX `opportunity_id_idx` (`opportunity_id` ASC),
  CONSTRAINT `opportunity_id`
    FOREIGN KEY (`opportunity_id`)
    REFERENCES `bidopps_db`.`opportunities` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE);


-- -----------------------------------------------------
-- Table `bidopps_db`.`submissions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bidopps_db`.`submissions` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `bidder_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `bidder_id_idx` (`bidder_id` ASC),
  CONSTRAINT `bidder_submission`
    FOREIGN KEY (`bidder_id`)
    REFERENCES `bidopps_db`.`bidders` (`user_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE);


-- -----------------------------------------------------
-- Table `bidopps_db`.`submission_docs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bidopps_db`.`submission_docs` (
  `document_id` INT NOT NULL AUTO_INCREMENT,
  `filename` VARCHAR(45) NOT NULL,
  `filetype` VARCHAR(45) NOT NULL,
  `filesize` VARCHAR(45) NOT NULL,
  `data` LONGBLOB NULL,
  `submission_id` INT NOT NULL,
  PRIMARY KEY (`document_id`),
  INDEX `submission_id_idx` (`submission_id` ASC),
  CONSTRAINT `submission_id`
    FOREIGN KEY (`submission_id`)
    REFERENCES `bidopps_db`.`submissions` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE);