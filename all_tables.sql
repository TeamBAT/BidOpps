CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(32) NOT NULL,
  `join_date` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `firstname` VARCHAR(45) NULL,
  `lastname` VARCHAR(45) NULL,
  PRIMARY KEY (`id`));


-- -----------------------------------------------------
-- Table `mydb`.`bidders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`bidders` (
  `user_id` INT NOT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `mydb`.`users` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`administrators`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`administrators` (
  `user_id` INT NOT NULL,
  `permissions` ENUM('Admin', 'Author', 'Reviewer', 'Approver', 'Screener', 'Evaluator', 'Finalizer') NOT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `mydb`.`users` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`opportunities`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`opportunities` (
  `id` INT NOT NULL,
  `final_filing_date` DATETIME NOT NULL,
  `type` VARCHAR(45) NOT NULL,
  `category` VARCHAR(45) NOT NULL,
  `title` VARCHAR(45) NOT NULL,
  `description` TEXT NOT NULL,
  `posted_date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `admin_id_idx` (`created_by` ASC),
  CONSTRAINT `admin_id`
    FOREIGN KEY (`created_by`)
    REFERENCES `mydb`.`administrators` (`user_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`opportunity_docs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`opportunity_docs` (
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
    REFERENCES `mydb`.`opportunities` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`submissions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`submissions` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `bidder_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `bidder_id_idx` (`bidder_id` ASC),
  CONSTRAINT `bidder_id`
    FOREIGN KEY (`bidder_id`)
    REFERENCES `mydb`.`bidders` (`user_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`submission_docs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`submission_docs` (
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
    REFERENCES `mydb`.`submissions` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
