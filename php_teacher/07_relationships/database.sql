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

-- 3. INSERT SAMPLE DATA
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

-- 5.3 INSERT SAMPLE DATA
-- author
INSERT INTO `author` SET
    `id` = 1,
    `name` = 'Jeremy Park',
    `email` = 'jeremy@ittc.com';

INSERT INTO `author` (`id`, `name`, `email`)
    VALUES (2, 'David Jo', 'david@ittc.com');

-- joke
INSERT INTO `joke` SET
    `joketext` = 'A: Hey, man! Please call me a taxi. B: Yes, sir. You are a taxi.',
    `jokedate` = '2020-03-01',
    `authorid` = 1;

INSERT INTO `joke` (`joketext`, `jokedate`, `authorid`)
VALUES ('Girl: You would be a good dancer except for two things. Boy: What are the two things? Girl: Your feet.', 
        '2020-03-02',
        1
        );
INSERT INTO `joke` (`joketext`, `jokedate`, `authorid`)
VALUES ('I dreamed I was forced to eat a giant marshmallow. When I woke up, my pillow was gone.', 
        '2020-03-03',
        2
        );

    -- // join할 두 쿼리
    -- // SELECT `id`, LEFT(`joketext`, 20), `authorid` FROM `joke`
    -- // SELECT * FROM `author`
    -- $sql = 'SELECT `joke`.`id`, LEFT(`joketext`,20), `name`, `email`
    -- FROM `joke` INNER JOIN `author`
    -- ON `authorid` = `author`.`id`';

    -- many to one (joke - author) <==> one to many (author - joke)
    -- // Jeremy Park 이 작성한 글 전부 불러오기
    -- SELECT `joketext`, `name`, `email`
    -- FROM `joke` INNER JOIN `author`
    -- ON `authorid` = `author`.`id`
    -- WHERE `name` = "Jeremy Park";

--------------------------------------------------------------------------
    -- many to many 연습

    CREATE TABLE `category` (
        `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(255)
    ) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB;

    -- ++++++ [ lookup 테이블 ] +++++ (joke <==> jokcategory <==> category)
    CREATE TABLE `jokecategory` (
        `jokeid` INT NOT NULL,
        `categoryid` INT NOT NULL,
        PRIMARY KEY (`jokeid`, `categoryid`)
    ) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB;

    -- INSERT `category` SAMPLE DATA
    INSERT INTO `category` (`id`, `name`)
        VALUES  (1, 'Knock-knock'),
                (2, 'Cross the road'),
                (3, 'lawyers'),
                (4, 'Walk the bar'),
                (5, 'Light bulb');
    
    -- INSERT `jokecategory` SAMPLE DATA
    INSERT INTO `jokecategory` (`jokeid`, `categoryid`)
        VALUES  (1,2),
                (2,1),
                (2,4),
                (3,3),
                (1,5);

    -- ex1) "knock-knock" => category `name` 가져오기
    SELECT `joketext`,`jokeid`,`categoryid`,`name`
    FROM `joke`
    INNER JOIN `jokecategory`
        ON `joke`.`id` = `jokeid`
    INNER JOIN `category`
        ON `categoryid` = `category`.`id`
    WHERE `name` = 'knock-knock';

    -- ex2) "I dreamed I was" joke `joketext` 가져오기
    SELECT `joketext`,`jokeid`,`categoryid`,`name`
    FROM `joke`
    INNER JOIN `jokecategory`
        ON `joke`.`id` = `jokeid`
    INNER JOIN `category`
        ON `categoryid` = `category`.`id`
    WHERE `joketext` LIKE "I dreamed I was%";

    -- DELETE `category` TABLE
    DROP TABLE IF EXISTS `category`;
    -- DELETE `jokecategory` TABLE
    DROP TABLE IF EXISTS `jokecategory`;
--------------------------------------------------------------------------