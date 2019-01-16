-- MySQL Script generated by MySQL Workbench
-- Tue Jan 15 20:07:25 2019
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema db_up2date
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema db_up2date
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db_up2date` DEFAULT CHARACTER SET utf8 ;
USE `db_up2date` ;

-- -----------------------------------------------------
-- Table `db_up2date`.`tbl_courses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_up2date`.`tbl_courses` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(250) NOT NULL,
  `description` VARCHAR(5000) NOT NULL,
  `year` INT(11) NOT NULL,
  `code` VARCHAR(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `code_UNIQUE` (`code` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_up2date`.`tbl_roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_up2date`.`tbl_roles` (
  `id` TINYINT(2) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db_up2date`.`tbl_users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_up2date`.`tbl_users` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(1000) NOT NULL,
  `password` VARCHAR(200) NOT NULL,
  `salt` VARCHAR(100) NULL,
  `creation_date` INT(11) NOT NULL,
  `role_id` TINYINT(2) UNSIGNED NOT NULL DEFAULT 3,
  PRIMARY KEY (`id`),
  INDEX `fk_tbl_users_tbl_roles1_idx` (`role_id` ASC),
  CONSTRAINT `fk_tbl_users_tbl_roles1`
    FOREIGN KEY (`role_id`)
    REFERENCES `db_up2date`.`tbl_roles` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_up2date`.`tbl_subjects`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_up2date`.`tbl_subjects` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(250) NOT NULL,
  `description` VARCHAR(5000) NOT NULL,
  `course_id` INT(11) UNSIGNED NOT NULL,
  `instructor_id` INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tbl_subjects_tbl_courses1_idx` (`course_id` ASC),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC),
  INDEX `fk_tbl_subjects_tbl_users1_idx` (`instructor_id` ASC),
  CONSTRAINT `fk_tbl_subjects_tbl_courses1`
    FOREIGN KEY (`course_id`)
    REFERENCES `db_up2date`.`tbl_courses` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_subjects_tbl_users1`
    FOREIGN KEY (`instructor_id`)
    REFERENCES `db_up2date`.`tbl_users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_up2date`.`tbl_assignments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_up2date`.`tbl_assignments` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `subject_id` INT(11) UNSIGNED NOT NULL,
  `name` VARCHAR(250) NOT NULL,
  `due_date` DATE NOT NULL,
  `description` VARCHAR(2000) NULL DEFAULT NULL,
  `points` INT(3) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tbl_assignments_tbl_subjects1_idx` (`subject_id` ASC),
  CONSTRAINT `fk_tbl_assignments_tbl_subjects1`
    FOREIGN KEY (`subject_id`)
    REFERENCES `db_up2date`.`tbl_subjects` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_up2date`.`tbl_lessons`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_up2date`.`tbl_lessons` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `course_id` INT(11) UNSIGNED NOT NULL,
  `subject_id` INT(11) UNSIGNED NOT NULL,
  `day` VARCHAR(250) NOT NULL,
  `time` VARCHAR(250) NOT NULL,
  INDEX `fk_tbl_lessons_tbl_subjects1_idx` (`subject_id` ASC),
  PRIMARY KEY (`id`),
  INDEX `fk_tbl_lessons_tbl_courses1_idx` (`course_id` ASC),
  CONSTRAINT `fk_tbl_lessons_tbl_subjects1`
    FOREIGN KEY (`subject_id`)
    REFERENCES `db_up2date`.`tbl_subjects` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_lessons_tbl_courses1`
    FOREIGN KEY (`course_id`)
    REFERENCES `db_up2date`.`tbl_courses` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_up2date`.`tbl_students`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_up2date`.`tbl_students` (
  `user_id` INT(11) UNSIGNED NOT NULL,
  `course_id` INT(11) UNSIGNED NOT NULL,
  INDEX `fk_tbl_students_tbl_users1_idx` (`user_id` ASC),
  INDEX `fk_tbl_students_tbl_courses1_idx` (`course_id` ASC),
  PRIMARY KEY (`user_id`, `course_id`),
  CONSTRAINT `fk_tbl_students_tbl_courses1`
    FOREIGN KEY (`course_id`)
    REFERENCES `db_up2date`.`tbl_courses` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_students_tbl_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `db_up2date`.`tbl_users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_up2date`.`tbl_user_auth`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_up2date`.`tbl_user_auth` (
  `user_id` INT(11) UNSIGNED NOT NULL,
  `auth_code` VARCHAR(200) NOT NULL,
  `ip_address` VARCHAR(50) NOT NULL,
  `expiration` INT(11) UNSIGNED NOT NULL,
  INDEX `fk_table4_tbl_users1_idx` (`user_id` ASC),
  CONSTRAINT `fk_table4_tbl_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `db_up2date`.`tbl_users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_up2date`.`tbl_user_details`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_up2date`.`tbl_user_details` (
  `user_id` INT(11) UNSIGNED NOT NULL,
  `name` VARCHAR(250) NOT NULL,
  `surname` VARCHAR(45) NOT NULL,
  `bio` VARCHAR(5000) NULL,
  INDEX `fk_tbl_user_details_tbl_users_idx` (`user_id` ASC),
  CONSTRAINT `fk_tbl_user_details_tbl_users`
    FOREIGN KEY (`user_id`)
    REFERENCES `db_up2date`.`tbl_users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `db_up2date`.`tbl_attendance`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_up2date`.`tbl_attendance` (
  `date` DATE NOT NULL,
  `tbl_subjects_id` INT(11) UNSIGNED NOT NULL,
  `user_id` INT(11) UNSIGNED NOT NULL,
  `tbl_attended` TINYINT(1) NULL,
  INDEX `fk_tbl_attendance_tbl_users2_idx` (`user_id` ASC),
  INDEX `fk_tbl_attendance_tbl_subjects2_idx` (`tbl_subjects_id` ASC),
  PRIMARY KEY (`tbl_subjects_id`, `date`, `user_id`),
  CONSTRAINT `fk_tbl_attendance_tbl_users2`
    FOREIGN KEY (`user_id`)
    REFERENCES `db_up2date`.`tbl_users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_attendance_tbl_subjects2`
    FOREIGN KEY (`tbl_subjects_id`)
    REFERENCES `db_up2date`.`tbl_subjects` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `db_up2date`.`tbl_roles`
-- -----------------------------------------------------
START TRANSACTION;
USE `db_up2date`;

COMMIT;

