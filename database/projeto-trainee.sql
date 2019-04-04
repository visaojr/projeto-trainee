-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema treinamento_trainee
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `treinamento_trainee`;
-- -----------------------------------------------------
-- Schema treinamento_trainee
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `treinamento_trainee` DEFAULT CHARACTER SET utf8 ;
USE `treinamento_trainee` ;

-- -----------------------------------------------------
-- Table `treinamento_trainee`.`course`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `treinamento_trainee`.`course` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `semesters` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `treinamento_trainee`.`matter`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `treinamento_trainee`.`matter` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `workload` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `treinamento_trainee`.`course_has_matter`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `treinamento_trainee`.`course_has_matter` (
  `course_id` INT UNSIGNED NOT NULL,
  `matter_id` INT UNSIGNED NOT NULL,
  `type` ENUM('Obrigatória', 'Eletiva') NOT NULL,
  `semester` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`course_id`, `matter_id`),
  INDEX `fk_cursos_has_materias_materias1_idx` (`matter_id` ASC) VISIBLE,
  INDEX `fk_cursos_has_materias_cursos_idx` (`course_id` ASC) VISIBLE,
  UNIQUE INDEX `course_id_UNIQUE` (`course_id` ASC) VISIBLE,
  UNIQUE INDEX `matter_id_UNIQUE` (`matter_id` ASC) VISIBLE,
  CONSTRAINT `fk_cursos_has_materias_cursos`
    FOREIGN KEY (`course_id`)
    REFERENCES `treinamento_trainee`.`course` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cursos_has_materias_materias1`
    FOREIGN KEY (`matter_id`)
    REFERENCES `treinamento_trainee`.`matter` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `treinamento_trainee`.`student`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `treinamento_trainee`.`student` (
  `registration` INT NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `surname` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `course_id` INT UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`registration`),
  INDEX `fk_alunos_cursos1_idx` (`course_id` ASC) VISIBLE,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE,
  UNIQUE INDEX `registration_UNIQUE` (`registration` ASC) VISIBLE,
  CONSTRAINT `fk_alunos_cursos1`
    FOREIGN KEY (`course_id`)
    REFERENCES `treinamento_trainee`.`course` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `treinamento_trainee`.`student_attend_matter`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `treinamento_trainee`.`student_attend_matter` (
  `student_registration` INT NOT NULL,
  `matter_id` INT UNSIGNED NOT NULL,
  `skips` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`student_registration`, `matter_id`),
  INDEX `fk_alunos_has_materias_materias1_idx` (`matter_id` ASC) VISIBLE,
  INDEX `fk_alunos_has_materias_alunos1_idx` (`student_registration` ASC) VISIBLE,
  UNIQUE INDEX `student_registration_UNIQUE` (`student_registration` ASC) VISIBLE,
  UNIQUE INDEX `matter_id_UNIQUE` (`matter_id` ASC) VISIBLE,
  CONSTRAINT `fk_alunos_has_materias_alunos1`
    FOREIGN KEY (`student_registration`)
    REFERENCES `treinamento_trainee`.`student` (`registration`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_alunos_has_materias_materias1`
    FOREIGN KEY (`matter_id`)
    REFERENCES `treinamento_trainee`.`matter` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `treinamento_trainee`.`task`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `treinamento_trainee`.`task` (
  `id` INT NOT NULL,
  `type` VARCHAR(255) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `total` INT UNSIGNED NOT NULL,
  `nota` INT UNSIGNED NULL,
  `date` DATETIME NULL,
  `color` CHAR(7) NULL,
  `student_registration` INT NOT NULL,
  `matter_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`, `student_registration`, `matter_id`),
  INDEX `fk_tasks_students_attend_matters1_idx` (`student_registration` ASC, `matter_id` ASC) VISIBLE,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE,
  CONSTRAINT `fk_tasks_students_attend_matters1`
    FOREIGN KEY (`student_registration` , `matter_id`)
    REFERENCES `treinamento_trainee`.`student_attend_matter` (`student_registration` , `matter_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
