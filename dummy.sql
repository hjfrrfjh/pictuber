
SET FOREIGN_KEY_CHECKS = 0;
truncate youtuber;
truncate user;
truncate youtuber_tag;
truncate youtuber_review;
truncate youtuber_info;
truncate youtuber_sum;
SET FOREIGN_KEY_CHECKS = 1;

DELIMITER $$
DROP PROCEDURE IF EXISTS youtuberdummy$$
 
CREATE PROCEDURE youtuberdummy()
BEGIN
    DECLARE i INT DEFAULT 1;
        
    WHILE i <= 50 DO
        INSERT INTO youtuber(name,detail)
          VALUES(concat('유투버 이름',i),concat(concat('유투버 설명',i),'동해물과 백두산이 마르고 닳도록 하는님이 보우하사 우리날라만세 로렘입숨 입니다. 유투브 설명이 들어가는 곳입니다.'));
        SET i = i + 1;
    END WHILE;
END$$

DROP PROCEDURE IF EXISTS userdummy$$
 
CREATE PROCEDURE userdummy()
BEGIN
    DECLARE i INT DEFAULT 1;
        
    WHILE i <= 50 DO
        INSERT INTO user(username,email,password,create_time)
          VALUES(concat('유저이름',i)
          ,concat('유저메일',i)
          ,'1234'
          ,now());
        SET i = i + 1;
    END WHILE;
END$$


DROP PROCEDURE IF EXISTS youtuber_review_dummy$$
 
CREATE PROCEDURE youtuber_review_dummy()
BEGIN
    DECLARE i INT DEFAULT 1;
        
    WHILE i <= 1000 DO
        INSERT INTO youtuber_review(youtuber_id, user_id, point1, point2, point3, point4, point5,detail)
          VALUES(
           FLOOR(RAND() * 50)+1
          ,FLOOR(RAND() * 50)+1
          ,FLOOR(RAND() * 51)+50
          ,FLOOR(RAND() * 51)+50
          ,FLOOR(RAND() * 51)+50
          ,FLOOR(RAND() * 51)+50
          ,FLOOR(RAND() * 51)+50
          ,concat(i,'꽃이 보이는 그들을 가는 꽃 방황하여도, 뿐이다. 트고, 반짝이는 위하여, 봄바람이다. 석가는 이는 별과 인류의 군영과 얼음에 약동하다.')
          );
        SET i = i + 1;
    END WHILE;
END$$


DROP PROCEDURE IF EXISTS youtuber_sum_dummy$$
 
CREATE PROCEDURE youtuber_sum_dummy()
BEGIN

insert into youtuber_sum
select id, point1, point2, point3,point4,point5,tags from ( select youtuber_id as id, 
Floor(AVG(point1)) as point1,
Floor(AVG(point2)) as point2,
Floor(AVG(point3)) as point3,
Floor(AVG(point4)) as point4,
Floor(AVG(point5)) as point5 from youtuber_review GROUP BY youtuber_id) as A
left join (
SELECT youtuber_id, GROUP_CONCAT(tag SEPARATOR ',') as tags FROM youtuber_tag GROUP BY youtuber_id 
) as B
on A.id=B.youtuber_id;

END$$


DROP PROCEDURE IF EXISTS youtuber_tag_dummy$$
 
CREATE PROCEDURE youtuber_tag_dummy()
BEGIN
    DECLARE i INT DEFAULT 1;
        
    WHILE i <= 50 DO
        INSERT INTO youtuber_tag(
            youtuber_id, tag)
          VALUES(
            FLOOR(RAND() * 50)+1,
            ELT(FLOOR(RAND()*16)+1, 
            '게임', 
            '먹방', 
            '병맛', 
            '태그2', 
            '태그3', 
            '태그4', 
            '태그5', 
            '태그6', 
            '태그7', 
            '태그8', 
            '태그9', 
            '태그10', 
            '태그11', 
            '태그12', 
            '태그13', 
            '태그14')
          );
        SET i = i + 1;
    END WHILE;
END$$

DROP PROCEDURE IF EXISTS youtuber_info_dummy$$

CREATE PROCEDURE youtuber_info_dummy()
BEGIN
    DECLARE i INT DEFAULT 1;
        
    WHILE i <= 200 DO
        INSERT INTO youtuber_info(youtuber_id, info, url)
          VALUES(
              FLOOR(RAND() * 50)+1,
              concat(i,'정보 입니다~~ 로렘 입숨!!'),
              "http://www.anver.com"
            );
        SET i = i + 1;
    END WHILE;
END$$

DELIMITER $$

call youtuberdummy;
call userdummy;
call youtuber_review_dummy;
call youtuber_tag_dummy;
call youtuber_info_dummy;
call youtuber_sum_dummy;

SET SQL_SAFE_UPDATES = 0;
delete from youtuber_review where youtuber_id=user_id;
SET SQL_SAFE_UPDATES = 1;

