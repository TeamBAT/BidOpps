CREATE SCHEMA IF NOT EXISTS `bidopps_db` DEFAULT CHARACTER SET utf8 ;
USE `bidopps_db` ;

-- -----------------------------------------------------
-- Table `bidopps_db`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bidopps_db`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL UNIQUE,
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
  `business` VARCHAR(45) NULL,
  `interests` TEXT NULL,
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
  PRIMARY KEY (`user_id`),
  CONSTRAINT `admin_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `bidopps_db`.`users` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE);
	
-- -----------------------------------------------------
-- Table `bidopps_db`.`permissions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bidopps_db`.`permissions` (
	`user_id` INT NOT NULL,
	`administrate` BIT(1) DEFAULT 0,
	`author` BIT(1) DEFAULT 0,
	`review` BIT(1) DEFAULT 0,
	`approve` BIT(1) DEFAULT 0,
	`screen` BIT(1) DEFAULT 0,
	`evaluate` BIT(1) DEFAULT 0,
	`finalize` BIT(1) DEFAULT 0,
	`bid` BIT(1) DEFAULT 0,
	CONSTRAINT `permission_id`
		FOREIGN KEY(`user_id`)
		REFERENCES `bidopps_db`.`users` (`id`)
		ON DELETE CASCADE
		ON UPDATE CASCADE);


-- -----------------------------------------------------
-- Table `bidopps_db`.`opportunities`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bidopps_db`.`opportunities` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `number` VARCHAR(9) NOT NULL UNIQUE,
  `final_filing_date` DATETIME NOT NULL,
  `type` VARCHAR(45) NOT NULL,
  `category` VARCHAR(45) NOT NULL,
  `title` VARCHAR(45) NOT NULL,
  `description` TEXT NOT NULL,
  `validated_date` DATETIME NULL,
  `reviewed_date` DATETIME NULL,
  `posted_date` DATETIME NULL,
  `last_updated` DATETIME ON UPDATE CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `message` TEXT NULL,
  `created_by` INT NOT NULL,
  `status` ENUM('Drafted', 'Submitted', 'Reviewed', 'Validated', 'Posted', 'Archived', 'Awarded') NOT NULL,
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
  `priority` INT NOT NULL,
  `title` VARCHAR(45) NOT NULL,
  `filename` VARCHAR(45) NOT NULL,
  `filetype` VARCHAR(45) NOT NULL,
  `filesize` VARCHAR(45) NOT NULL,
  `directory` VARCHAR(255) NOT NULL,
  `subheading` VARCHAR(255) NULL,
  `posted_date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `due_date` DATETIME NULL,
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
  `opportunity_id` INT NOT NULL,
  `status` ENUM('Submitted', 'Screened', 'Evaluated', 'Awarded', 'Denied') NOT NULL DEFAULT 'Submitted',
  `time_submitted` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `time_screened` DATETIME NULL,
  `time_reviewed` DATETIME NULL,
  `time_finalized` DATETIME NULL,
  `message` TEXT NULL,
  `last_updated` DATETIME ON UPDATE CURRENT_TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `bidder_id_idx` (`bidder_id` ASC),
  CONSTRAINT `bidder_submission`
    FOREIGN KEY (`bidder_id`)
    REFERENCES `bidopps_db`.`bidders` (`user_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `submission_opportunity`
    FOREIGN KEY (`opportunity_id`)
    REFERENCES `bidopps_db`.`opportunities` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE);


-- -----------------------------------------------------
-- Table `bidopps_db`.`submission_docs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bidopps_db`.`submission_docs` (
  `document_id` INT NOT NULL AUTO_INCREMENT,
  `priority` INT NOT NULL,
  `title` VARCHAR(45) NOT NULL,
  `filename` VARCHAR(45) NOT NULL,
  `filetype` VARCHAR(45) NOT NULL,
  `filesize` VARCHAR(255) NOT NULL,
  `directory` VARCHAR(255) NOT NULL,
  `subheading` VARCHAR(255) NULL,
  `posted_date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `due_date` DATETIME NULL,
  `submission_id` INT NOT NULL,
  PRIMARY KEY (`document_id`),
  INDEX `submission_id_idx` (`submission_id` ASC),
  CONSTRAINT `submission_id`
    FOREIGN KEY (`submission_id`)
    REFERENCES `bidopps_db`.`submissions` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE);
