-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema treinamento_trainee
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema treinamento_trainee
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `treinamento_trainee`;
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
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `treinamento_trainee`.`matter`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `treinamento_trainee`.`matter` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `workload` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
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
  INDEX `fk_cursos_has_materias_materias1_idx` (`matter_id` ASC) ,
  INDEX `fk_cursos_has_materias_cursos_idx` (`course_id` ASC) ,
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
  INDEX `fk_alunos_cursos1_idx` (`course_id` ASC) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) ,
  UNIQUE INDEX `registration_UNIQUE` (`registration` ASC) ,
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
  INDEX `fk_alunos_has_materias_materias1_idx` (`matter_id` ASC) ,
  INDEX `fk_alunos_has_materias_alunos1_idx` (`student_registration` ASC) ,
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
  INDEX `fk_tasks_students_attend_matters1_idx` (`student_registration` ASC, `matter_id` ASC) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  CONSTRAINT `fk_tasks_students_attend_matters1`
    FOREIGN KEY (`student_registration` , `matter_id`)
    REFERENCES `treinamento_trainee`.`student_attend_matter` (`student_registration` , `matter_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Popula `treinamento_trainee`.`course`
-- -----------------------------------------------------

INSERT INTO `course` (`id`, `name`,`semesters`) VALUES (1, "Engenharia de Computação", "10");
INSERT INTO `course` (`name`,`semesters`) VALUES ("Sistemas de Informação", "10");

-- -----------------------------------------------------
-- Popula `treinamento_trainee`.`matter`
-- -----------------------------------------------------

INSERT INTO `matter` (`id`, `name`, `workload`) VALUES (1, "BANCO DE DADOS", 60);

INSERT INTO `matter` (`id`, `name`, `workload`) VALUES (2, "GEOMETRIA ANALITICA E ALGEBRA LINEAR", 60);
INSERT INTO `matter` (`id`, `name`, `workload`) VALUES (3, "QUIMICA GERAL", 60);
INSERT INTO `matter` (`id`, `name`, `workload`) VALUES (4, "CALCULO DIFERENCIAL E INTEGRAL I", 60);
INSERT INTO `matter` (`id`, `name`, `workload`) VALUES (5, "PROGRAMACAO DE COMPUTADORES I", 60);
INSERT INTO `matter` (`id`, `name`, `workload`) VALUES (6, "INTRODUCAO A ENGENHARIA DE COMPUTACAO", 30);
INSERT INTO `matter` (`id`, `name`, `workload`) VALUES (7, "METODOLOGIA DE PESQUISA APLICADA A COMPUTACAO", 30);
INSERT INTO `matter` (`id`, `name`, `workload`) VALUES (8, "COMUNICACAO E EXPRESSAO", 60);
INSERT INTO `matter` (`id`, `name`, `workload`) VALUES (9, "FISICA I", 60);
INSERT INTO `matter` (`id`, `name`, `workload`) VALUES (10, "CALCULO DIFERENCIAL E INTEGRAL II", 60);
INSERT INTO `matter` (`id`, `name`, `workload`) VALUES (11, "ESTATISTICA E PROBABILIDADE", 60);
INSERT INTO `matter` (`id`, `name`, `workload`) VALUES (12, "PROGRAMACAO DE COMPUTADORES II", 60);
INSERT INTO `matter` (`id`, `name`, `workload`) VALUES (13, "MATEMATICA DISCRETA", 60);
INSERT INTO `matter` (`id`, `name`, `workload`) VALUES (14, "CALCULO DIFERENCIAL E INTEGRAL III", 60);
INSERT INTO `matter` (`id`, `name`, `workload`) VALUES (15, "FISICA II", 60);
INSERT INTO `matter` (`id`, `name`, `workload`) VALUES (16, "INTRODUCAO AS EQUACOES DIFERENCIAIS ORDINARIAS", 60);
INSERT INTO `matter` (`id`, `name`, `workload`) VALUES (17, "PRINCIPIOS DE ELETRONICA DIGITAL", 60);
INSERT INTO `matter` (`id`, `name`, `workload`) VALUES (18, "ALGORITMOS E ESTRUTURA DE DADOS I", 60);
INSERT INTO `matter` (`id`, `name`, `workload`) VALUES (19, "FISICA III", 60);
INSERT INTO `matter` (`id`, `name`, `workload`) VALUES (20, "CIRCUITOS ELETRICOS I", 60);
INSERT INTO `matter` (`id`, `name`, `workload`) VALUES (21, "SINAIS E SISTEMAS", 60);
INSERT INTO `matter` (`id`, `name`, `workload`) VALUES (22, "ALGORITMOS E ESTRUTURA DE DADOS II", 60);
INSERT INTO `matter` (`id`, `name`, `workload`) VALUES (23, "TEORIA DOS GRAFOS", 60);
INSERT INTO `matter` (`id`, `name`, `workload`) VALUES (24, "FISICA IV", 60);
INSERT INTO `matter` (`id`, `name`, `workload`) VALUES (25, "ELETROMAGNETISMO", 60);
INSERT INTO `matter` (`id`, `name`, `workload`) VALUES (26, "ANALISE NUMERICA", 60);
INSERT INTO `matter` (`id`, `name`, `workload`) VALUES (27, "ORGANIZACAO E ARQUITETURA DE COMPUTADORES I", 60);
INSERT INTO `matter` (`id`, `name`, `workload`) VALUES (28, "ENGENHARIA DE SOFTWARE I", 60);

-- -----------------------------------------------------
-- Popula `treinamento_trainee`.`course_has_matter`
-- -----------------------------------------------------

INSERT INTO `course_has_matter` (`course_id`, `matter_id`, `type`, `semester`) VALUES (1, 1, "Obrigatória", 6);

INSERT INTO `course_has_matter` (`course_id`, `matter_id`, `type`, `semester`) VALUES (1, 2, "Obrigatória", 1);
INSERT INTO `course_has_matter` (`course_id`, `matter_id`, `type`, `semester`) VALUES (1, 3, "Obrigatória", 1);
INSERT INTO `course_has_matter` (`course_id`, `matter_id`, `type`, `semester`) VALUES (1, 4, "Obrigatória", 1);
INSERT INTO `course_has_matter` (`course_id`, `matter_id`, `type`, `semester`) VALUES (1, 5, "Obrigatória", 1);
INSERT INTO `course_has_matter` (`course_id`, `matter_id`, `type`, `semester`) VALUES (1, 6, "Obrigatória", 1);
INSERT INTO `course_has_matter` (`course_id`, `matter_id`, `type`, `semester`) VALUES (1, 7, "Obrigatória", 1);
INSERT INTO `course_has_matter` (`course_id`, `matter_id`, `type`, `semester`) VALUES (1, 8, "Obrigatória", 1);
INSERT INTO `course_has_matter` (`course_id`, `matter_id`, `type`, `semester`) VALUES (1, 9, "Obrigatória", 2);
INSERT INTO `course_has_matter` (`course_id`, `matter_id`, `type`, `semester`) VALUES (1, 10, "Obrigatória", 2);
INSERT INTO `course_has_matter` (`course_id`, `matter_id`, `type`, `semester`) VALUES (1, 11, "Obrigatória", 2);
INSERT INTO `course_has_matter` (`course_id`, `matter_id`, `type`, `semester`) VALUES (1, 12, "Obrigatória", 2);
INSERT INTO `course_has_matter` (`course_id`, `matter_id`, `type`, `semester`) VALUES (1, 13, "Obrigatória", 2);
INSERT INTO `course_has_matter` (`course_id`, `matter_id`, `type`, `semester`) VALUES (1, 14, "Obrigatória", 3);
INSERT INTO `course_has_matter` (`course_id`, `matter_id`, `type`, `semester`) VALUES (1, 15, "Obrigatória", 3);
INSERT INTO `course_has_matter` (`course_id`, `matter_id`, `type`, `semester`) VALUES (1, 16, "Obrigatória", 3);
INSERT INTO `course_has_matter` (`course_id`, `matter_id`, `type`, `semester`) VALUES (1, 17, "Obrigatória", 3);
INSERT INTO `course_has_matter` (`course_id`, `matter_id`, `type`, `semester`) VALUES (1, 18, "Obrigatória", 3);
INSERT INTO `course_has_matter` (`course_id`, `matter_id`, `type`, `semester`) VALUES (1, 19, "Obrigatória", 4);
INSERT INTO `course_has_matter` (`course_id`, `matter_id`, `type`, `semester`) VALUES (1, 20, "Obrigatória", 4);
INSERT INTO `course_has_matter` (`course_id`, `matter_id`, `type`, `semester`) VALUES (1, 21, "Obrigatória", 4);
INSERT INTO `course_has_matter` (`course_id`, `matter_id`, `type`, `semester`) VALUES (1, 22, "Obrigatória", 4);
INSERT INTO `course_has_matter` (`course_id`, `matter_id`, `type`, `semester`) VALUES (1, 23, "Obrigatória", 4);
INSERT INTO `course_has_matter` (`course_id`, `matter_id`, `type`, `semester`) VALUES (1, 24, "Obrigatória", 5);
INSERT INTO `course_has_matter` (`course_id`, `matter_id`, `type`, `semester`) VALUES (1, 25, "Obrigatória", 5);
INSERT INTO `course_has_matter` (`course_id`, `matter_id`, `type`, `semester`) VALUES (1, 26, "Obrigatória", 5);
INSERT INTO `course_has_matter` (`course_id`, `matter_id`, `type`, `semester`) VALUES (1, 27, "Obrigatória", 5);
INSERT INTO `course_has_matter` (`course_id`, `matter_id`, `type`, `semester`) VALUES (1, 28, "Obrigatória", 5);



-- -----------------------------------------------------
-- Popula `treinamento_trainee`.`student`
-- -----------------------------------------------------

INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("70693","Hashim","Kerr","leo@interdumlibero.org","QLF48BHM9FV","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("71816","Jelani","Mcpherson","sociis@sitametfaucibus.com","BJX42HIJ8GG","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("49008","Nichole","Melendez","id.blandit.at@nonenim.net","GOO41CNQ9MF","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("16378","Brenden","Coleman","ipsum.leo.elementum@nuncsed.net","FIM21HBF2OO","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("88497","Denise","Mccoy","ipsum.cursus@ante.com","SUD63XBA8BY","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("68416","Libby","Bradford","parturient.montes@ut.com","GKJ19RDM4YC","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("82868","Tate","Warren","ac.ipsum.Phasellus@malesuada.org","TXA64BLG4VJ","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("15225","Cameran","Herrera","Proin.ultrices.Duis@euismodacfermentum.com","EVB67IAF5VA","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("90046","Cameron","Mccoy","montes@Duis.ca","MAA76KZB9AR","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("61826","Amal","Dawson","Donec@arcu.ca","NML28FFM5II","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("98904","Christen","Black","nec@Mauris.com","WJP57WQF1CD","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("44524","Hiram","Sparks","vestibulum.lorem@tempor.com","RAO57FGA9ZT","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("34175","Amy","Harris","at.libero.Morbi@tincidunt.edu","APZ61VLZ8LH","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("36087","Hedley","Howell","Maecenas.malesuada@arcuSedet.edu","MQJ06DRY6YY","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("89518","Cameron","Boyle","ipsum@parturientmontes.ca","ELB94EGV1TK","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("72649","Candice","Castillo","volutpat.ornare.facilisis@interdumNunc.com","EXU89XCW6QN","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("42506","Troy","Dickson","tincidunt.vehicula.risus@feugiatnec.org","RTE96CQM4YR","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("11640","Maisie","Kemp","sodales@vel.com","RGP10GII2GD","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("93428","Lana","Stuart","tincidunt.aliquam@Duisac.edu","CID70RIA0SM","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("55600","Tiger","Santana","eros.Nam@nonummyFuscefermentum.edu","VTH91JRW9OL","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("35882","Tatum","Patterson","ante.lectus.convallis@Suspendisse.co.uk","CUD73OCS1HD","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("85430","Inez","Nichols","urna@aliquetsem.net","JIH63CRH2YP","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("98366","Cecilia","Stokes","sociosqu@sapien.edu","FOY06POU6XQ","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("80412","Giacomo","Hinton","nec@lectus.org","YDM06GDV2DT","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("49904","Halla","Mays","vel.arcu.eu@ullamcorper.org","XBJ17IDK0TC","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("77218","Julie","Burgess","purus.Maecenas.libero@perinceptoshymenaeos.com","PYV03OXM5EK","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("08076","Kylan","Horne","at.fringilla@feugiatSednec.edu","DFO99MKR9PX","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("46564","Urielle","Mooney","molestie.tellus@commodoatlibero.ca","JQF92IYW4FG","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("55252","Josephine","Sawyer","non.justo.Proin@volutpatnunc.ca","VYS38TZE4XJ","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("05025","Hammett","Sellers","sem@ullamcorper.com","XKL03ARZ3TX","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("27242","Rina","Bennett","morbi@dignissimMaecenas.com","RDE34YNU3QY","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("18435","Chase","Vang","fringilla@aliquetvel.edu","HSG85HPW5JR","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("18365","Pamela","Mcneil","Nulla@Phaselluslibero.org","PNK91EZU9CD","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("31301","Kaitlin","Michael","non.magna.Nam@nibhPhasellusnulla.edu","SJJ06GMY1VI","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("84047","Barrett","Kennedy","ultricies@dapibus.ca","XOR70LQC2RB","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("72147","Thor","Washington","mauris.sagittis.placerat@imperdietnonvestibulum.com","NVJ94NHL0VA","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("45490","James","Chapman","arcu.Sed.et@dictumcursusNunc.edu","ALS90SQS7UN","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("14425","Daphne","Boyle","non.sollicitudin@nisi.org","XIM74IXL9FQ","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("23390","Aretha","Huff","massa.non.ante@habitant.ca","MDC85TYN1PL","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("13179","Idola","Boyle","scelerisque@eleifend.org","NRN82NCK5KS","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("04363","Aquila","Bright","ultrices@utaliquamiaculis.net","LLY18TTD2LU","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("54313","Brenden","Hood","ac@elitpedemalesuada.co.uk","ONM32DGY1YF","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("09830","Demetria","Higgins","Integer.aliquam@Inscelerisque.net","VGU47BNX7SY","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("81635","Tamekah","Woodward","convallis.erat@risus.net","QAW85QUU9EK","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("35958","Elizabeth","Nixon","lacinia@lobortisrisusIn.org","TLU66TIY2ZW","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("83175","Emmanuel","Spears","non@sitametmetus.org","EAK61KPB1QB","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("39541","Ross","Combs","vestibulum.massa@lobortis.ca","EDU61GIG0XD","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("39901","Blaze","Riley","massa.Vestibulum@massaIntegervitae.org","HEN49AQR1YC","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("82267","Nolan","Cannon","tellus.Nunc@dolor.org","VZB20VUJ5PD","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("77987","Kirsten","Coleman","dolor@risusNulla.edu","XCC23POU9FK","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("36702","Tashya","Molina","Lorem.ipsum@ipsumcursusvestibulum.org","FMV69EWH6IV","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("08623","Xenos","Avery","Curae.Donec.tincidunt@Donectemporest.edu","ERY23QUT2FM","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("70746","Wesley","Gilliam","congue.elit@eu.co.uk","OMZ99PTT3HE","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("39625","Magee","Wilkerson","turpis.Aliquam.adipiscing@ipsum.edu","VLK29PSF3EW","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("76596","Sybill","Cantu","lorem.ac@estMauris.ca","FAQ69YEO8PF","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("25463","Desirae","Webb","non.cursus.non@purusNullam.net","DQE35VTI6YT","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("23622","Duncan","Camacho","magna@Cras.org","TQB96QZU1ZX","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("42706","Amena","Lawson","sem.mollis.dui@netuset.org","ITE92SKF5RX","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("21372","Bree","Tucker","lacinia@risusa.edu","ILA14KXC7LM","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("73757","Kiona","Grant","Duis@ac.com","VWC94FBE7JA","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("29721","Tanisha","Hood","Quisque@Sed.com","WJO20LAC2LP","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("78702","Gretchen","Hurst","neque@feugiatnonlobortis.com","PPJ80UCS7UU","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("51944","Donna","Whitley","adipiscing.elit.Curabitur@Phaselluslibero.org","SSK92LZM8PM","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("23118","Kasper","Mercer","Nam.ligula@faucibus.ca","NEJ67MFX8RD","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("04187","Lyle","Benson","lorem.fringilla.ornare@dolorFusce.edu","PNE35IOC2ZQ","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("52293","Jessica","Atkinson","Proin.non.massa@nuncest.org","SFM48CSQ0EN","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("57041","Otto","Cleveland","sed.orci.lobortis@Quisqueliberolacus.ca","NIT11XPO1QB","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("01970","Burke","Matthews","ipsum.nunc.id@lacusCras.ca","HDJ44CCE6PD","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("69303","Nash","Thomas","interdum.Curabitur@Duiselementum.ca","HBF81XUT9YC","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("92118","Clarke","James","Suspendisse.eleifend@ipsum.edu","OLA64AZM1NX","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("91094","Demetria","Mclean","quam.elementum.at@NullaaliquetProin.co.uk","BDJ08LOJ2TY","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("40917","Craig","Hood","sociis.natoque.penatibus@sagittis.co.uk","OFK30YWH0SZ","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("85585","Addison","Blackwell","Cum.sociis@portaelit.org","OUI74DZO2FT","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("27640","Baxter","Hamilton","dignissim.magna@egestasurnajusto.ca","HHO52DGS3FD","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("94660","Latifah","Washington","elit@facilisislorem.net","BRS47AVJ1FR","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("94588","Tallulah","Mayer","tempus@Cras.co.uk","GWU78XEE9DZ","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("63295","Joel","Harrington","blandit.congue.In@convallisdolor.edu","KTN93FYC9HJ","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("01537","Carlos","Brewer","eu.turpis@tincidunttempusrisus.co.uk","MWG51FBK7QU","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("51593","Martina","Harrison","odio.Aliquam@sollicitudin.com","QCS76ATK9XO","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("26931","Medge","Snow","tristique.senectus@viverra.co.uk","CAO25NKY7SN","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("25974","Skyler","Jones","cursus.a@facilisisSuspendisse.co.uk","ZXK38ZIC1MW","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("25986","Dorian","Sims","mattis@in.net","GAO09ZTV5AV","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("12445","Stella","Douglas","Maecenas.malesuada.fringilla@ametdiameu.ca","TOB52FPP7ZD","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("53867","Zenaida","Dunlap","tellus.Phasellus.elit@montesnasceturridiculus.co.uk","SVF05XGZ0UV","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("72655","Emi","Joseph","sit@odioEtiamligula.ca","YOL04YVT4MV","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("30142","Quynn","Maldonado","in.hendrerit.consectetuer@enim.ca","YAU86AKQ5NO","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("07946","Rhea","Salazar","ipsum.Suspendisse@pedeSuspendisse.org","WGE22NYE2TG","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("90043","Armando","Mcpherson","non.lorem.vitae@accumsaninterdumlibero.edu","RWY59KZL9YQ","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("07705","Otto","Walters","magna.tellus@Sed.org","FPO14ZOO4DI","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("39321","Tamara","Macias","dis.parturient@dolorquamelementum.ca","KPN66EGH9UK","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("47001","Adena","Obrien","ut@eratin.com","RQD98YVR3TR","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("90246","Illana","Espinoza","Donec.egestas@elitAliquamauctor.net","DLI61EHQ7UM","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("37666","Travis","Harvey","vel@et.net","BZI12GDJ6AC","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("07488","Jada","House","ullamcorper.viverra.Maecenas@infelisNulla.com","DLC63DZL4LA","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("41242","Reuben","Estes","pede.nonummy.ut@fermentummetus.co.uk","YDX95LEB4GW","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("42837","Pamela","Barlow","diam@scelerisqueloremipsum.edu","KTL67XTY2WV","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("63441","Justin","Dodson","orci.tincidunt@Maecenasornareegestas.co.uk","KNF08TBJ1BQ","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("72357","Jorden","Price","sociis.natoque.penatibus@Nuncmaurissapien.edu","XRJ06KEA5IC","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("45274","Mariko","Noel","at.nisi@velitPellentesque.net","RJX28KGQ5CB","1");
INSERT INTO `student` (`registration`,`name`,`surname`,`email`,`password`,`course_id`) VALUES ("83719","Blossom","Crawford","Donec.sollicitudin@acsem.org","IXD75QQU7GN","1");

-- -----------------------------------------------------
-- Popula `treinamento_trainee`.`student_attend_matter`
-- -----------------------------------------------------

INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (70,21,5);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (57,4,11);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (24,12,3);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (87,18,3);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (16,6,10);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (14,20,5);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (75,10,10);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (27,12,15);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (86,28,10);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (45,8,13);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (46,18,7);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (25,19,6);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (15,26,4);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (3,7,13);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (69,10,12);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (69,23,16);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (59,3,13);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (24,27,5);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (68,16,16);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (56,5,11);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (6,28,5);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (15,22,3);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (70,12,15);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (42,17,17);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (60,28,17);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (46,21,18);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (31,3,13);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (48,4,1);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (89,14,3);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (46,12,8);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (89,10,9);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (51,5,11);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (30,17,16);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (9,7,5);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (37,22,8);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (34,20,16);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (49,18,11);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (26,10,18);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (28,25,17);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (87,12,15);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (4,9,7);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (92,23,7);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (46,25,1);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (97,18,15);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (90,21,14);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (83,8,6);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (68,28,1);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (53,7,14);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (37,27,3);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (51,7,17);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (9,12,17);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (93,3,16);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (57,25,8);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (94,6,17);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (80,19,3);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (28,2,1);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (88,24,3);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (23,6,11);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (32,1,2);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (86,11,3);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (53,1,12);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (59,24,7);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (81,21,2);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (27,27,5);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (62,2,17);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (16,20,8);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (85,20,2);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (47,20,2);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (11,6,12);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (44,9,6);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (38,14,12);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (49,4,18);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (63,17,2);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (35,2,3);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (51,10,1);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (99,6,17);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (38,13,11);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (80,21,9);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (18,5,16);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (88,25,5);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (49,1,2);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (72,14,7);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (85,27,10);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (83,22,7);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (6,20,16);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (15,3,6);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (54,14,12);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (60,6,7);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (10,3,6);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (20,6,9);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (34,17,13);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (23,28,3);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (22,22,16);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (64,6,14);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (67,3,7);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (83,28,12);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (52,10,10);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (84,23,3);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (56,22,10);
INSERT INTO `student_attend_matter` (`student_registration`,`matter_id`,`skips`) VALUES (10,1,14);


-- -----------------------------------------------------
-- Triggers
-- -----------------------------------------------------

DELIMITER $$
USE `treinamento_trainee`$$
CREATE DEFINER = CURRENT_USER TRIGGER `treinamento_trainee`.`matter_BEFORE_DELETE` BEFORE DELETE ON `matter` FOR EACH ROW
BEGIN
  DELETE FROM `student_attend_matter` WHERE student_attend_matter.matter_id = old.id;
END$$