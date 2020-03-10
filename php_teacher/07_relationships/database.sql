--
-- Database extension.
-- Table structure for table `joke`
--
-- 1. DELETE `joke` TABLE
DROP TABLE IF EXISTS `joke`;

-- 2. CREATE `joke` TABLE
CREATE TABLE `joke` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `joketext` TEXT,
  `jokedate` DATE NOT NULL
) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB;

-- CREATE TABLE `joke` (
--   `id` INT NOT NULL AUTO_INCREMENT,
--   `joketext` TEXT,
--   `jokedate` DATE NOT NULL,
--   PRIMARY KEY (`id`)
-- ) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB;

-- 3. INSERT DATA
INSERT INTO `joke` SET
    `joketext` = 'A: Hey, man! Please call me a taxi. B: Yes, sir. You are a taxi.',
    `jokedate` = '2020-03-01';

INSERT INTO `joke` (`joketext`,`jokedate`) 
VALUES ('Girl: You would be a good dancer except for two things. 
        Boy: What are the two things? Girl: Your feet.', "2020-03-01");

-- 4. ALTER TABLE (authorname, authoremail)
ALTER TABLE `joke` ADD COLUMN `authorname` VARCHAR(255);
ALTER TABLE `joke` ADD COLUMN `authoremail` VARCHAR(255);

-- 4-1 SELECT DISTINCT (removing overlap data - 중복 항목 제거)
SELECT DISTINCT `authorname`, `authoremail` FROM `joke`;

-- 4-2 ALTER TABLE(DROP COLUMN)
ALTER TABLE `ijdb`.`joke` 
    DROP COLUMN `authoremail`, 
    DROP COLUMN `authorname`;


DROP TABLE IF EXISTS `joke`;
-- 5.1 Table to which the Author ID column was added.
CREATE TABLE `joke` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `joketext` TEXT,
  `jokedate` DATE NOT NULL,
  `authorid` INT
) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB;

-- 5.2 CREATE `author` TABLE
CREATE TABLE `author` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255),
    `email` VARCHAR(255)
) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB;