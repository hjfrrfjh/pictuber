
SET FOREIGN_KEY_CHECKS = 0;
truncate youtuber;
truncate user;
truncate youtuber_tag;
truncate youtuber_review;
truncate youtuber_info;
truncate youtuber_sum;
truncate board_talk;
truncate board_talk_comment;
SET FOREIGN_KEY_CHECKS = 1;

DELIMITER $$
DROP PROCEDURE IF EXISTS youtuberdummy$$
 
CREATE PROCEDURE youtuberdummy()
BEGIN
    DECLARE i INT DEFAULT 1;
        
    WHILE i <= 50 DO
        INSERT INTO youtuber(name,detail,url)
          VALUES(concat('유투버 이름',i)
          ,concat(concat('유투버 설명',i),'모든 국민은 법률이 정하는 바에 의하여 선거권을 가진다. 누구든지 체포 또는 구속의 이유와 변호인의 조력을 받을 권리가 있음을 고지받지 아니하고는 체포 또는 구속을 당하지 아니한다. 체포 또는 구속을 당한 자의 가족등 법률이 정하는 자에게는 그 이유와 일시·장소가 지체없이 통지되어야 한다.')
          ,"http://www.naver.com"
          );
        SET i = i + 1;
    END WHILE;
END$$
DELIMITER $$

DELIMITER $$
DROP PROCEDURE IF EXISTS userdummy$$
 
CREATE PROCEDURE userdummy()
BEGIN
    DECLARE i INT DEFAULT 1;
        
    WHILE i <= 50 DO
        INSERT INTO user(username,type,token,email,password,create_time)
          VALUES(concat('유저이름',i)
          ,'dummy'
          ,'abcde'
          ,concat('유저메일',i)
          ,'1234'
          ,now());
        SET i = i + 1;
    END WHILE;
END$$
DELIMITER $$

DELIMITER $$
DROP PROCEDURE IF EXISTS youtuber_review_dummy$$
 
CREATE PROCEDURE youtuber_review_dummy()
BEGIN
    DECLARE i INT DEFAULT 1;
        
    WHILE i <= 1000 DO
        INSERT INTO youtuber_review(youtuber_id, user_id, point1, point2, point3, point4, point5,detail,review_time)
          VALUES(
           FLOOR(RAND() * 50)+1
          ,FLOOR(RAND() * 50)+1
          ,FLOOR(RAND() * 51)+50
          ,FLOOR(RAND() * 51)+50
          ,FLOOR(RAND() * 51)+50
          ,FLOOR(RAND() * 51)+50
          ,FLOOR(RAND() * 51)+50
          ,concat(i,'꽃이 보이는 그들을 가는 꽃 방황하여도, 뿐이다. 트고, 반짝이는 위하여, 봄바람이다. 석가는 이는 별과 인류의 군영과 얼음에 약동하다.')
          ,now()
          );
        SET i = i + 1;
    END WHILE;
END$$
DELIMITER $$

DELIMITER $$
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
DELIMITER $$

DELIMITER $$
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
            '요리', 
            '리뷰', 
            '음악', 
            '창업', 
            '여행', 
            '병맛', 
            '개그', 
            '일상', 
            '체험', 
            '맛집', 
            '인터뷰', 
            '음악모음', 
            '믹싱', 
            '쇼핑몰', 
            '마케팅')
          );
        SET i = i + 1;
    END WHILE;
END$$
DELIMITER $$

DELIMITER $$
DROP PROCEDURE IF EXISTS youtuber_info_dummy$$

CREATE PROCEDURE youtuber_info_dummy()
BEGIN
    DECLARE i INT DEFAULT 1;
        
    WHILE i <= 200 DO
        INSERT INTO youtuber_info(youtuber_id, info, url)
          VALUES(
              FLOOR(RAND() * 50)+1,
              concat(i,'국가는 지역간의 균형있는 발전을 위하여 '),
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

-- 게시판 더미데이터
SET SQL_SAFE_UPDATES = 0;
delete from board_talk;
SET SQL_SAFE_UPDATES = 1;

INSERT INTO `board_talk` (`subject`,`content`,`hit`,`recommend`,`user_id`,`write_time`) VALUES ("diam","Lorem ipsum",243,135,32,"2019-03-03 00:11:38"),("nascetur ridiculus mus. Aenean eget magna. Suspendisse tristique neque venenatis","Lorem ipsum dolor sit amet, consectetuer adipiscing",367,99,20,"2018-08-10 06:52:29"),("interdum. Nunc sollicitudin commodo ipsum. Suspendisse non leo.","Lorem ipsum dolor sit amet,",53,154,31,"2018-10-25 20:05:51"),("vitae odio sagittis","Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed",11,186,48,"2018-09-14 02:28:30"),("amet metus. Aliquam erat volutpat. Nulla facilisis. Suspendisse commodo","Lorem ipsum dolor",678,84,22,"2018-02-20 19:18:28"),("libero","Lorem ipsum dolor sit amet, consectetuer adipiscing",961,169,46,"2018-09-17 02:43:07"),("enim nisl elementum purus, accumsan interdum libero dui nec","Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed",279,68,26,"2018-07-01 22:19:20"),("tincidunt pede ac urna. Ut tincidunt vehicula","Lorem",81,29,16,"2020-01-05 09:39:24"),("nisi a","Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur",795,175,32,"2018-11-18 03:56:04"),("dolor quam, elementum","Lorem ipsum dolor",626,96,23,"2019-12-15 19:53:11");
INSERT INTO `board_talk` (`subject`,`content`,`hit`,`recommend`,`user_id`,`write_time`) VALUES ("quis, tristique ac, eleifend vitae, erat. Vivamus nisi.","Lorem ipsum dolor sit amet,",993,29,26,"2018-04-10 23:26:45"),("et magnis dis parturient montes,","Lorem ipsum dolor",103,74,43,"2019-07-24 11:18:28"),("consectetuer, cursus et, magna. Praesent interdum ligula eu enim. Etiam","Lorem",703,43,27,"2019-06-18 05:41:47"),("Praesent interdum ligula eu enim. Etiam imperdiet dictum","Lorem ipsum dolor sit amet,",442,137,42,"2019-12-23 14:45:50"),("est,","Lorem ipsum",696,125,10,"2018-03-06 18:28:09"),("Class","Lorem ipsum dolor",198,155,1,"2019-06-04 11:09:34"),("amet, faucibus ut, nulla. Cras eu","Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur",889,139,34,"2018-06-09 20:48:44"),("ipsum nunc id enim. Curabitur massa. Vestibulum","Lorem ipsum",953,183,15,"2020-02-03 04:30:55"),("montes, nascetur ridiculus mus. Proin","Lorem",477,180,46,"2018-01-12 12:18:39"),("arcu. Morbi","Lorem ipsum",182,54,23,"2018-02-28 22:53:27");
INSERT INTO `board_talk` (`subject`,`content`,`hit`,`recommend`,`user_id`,`write_time`) VALUES ("pretium neque. Morbi quis urna. Nunc quis arcu","Lorem ipsum dolor sit amet, consectetuer adipiscing elit.",88,179,41,"2019-09-25 22:23:06"),("facilisis. Suspendisse commodo","Lorem ipsum dolor sit amet,",547,149,3,"2018-12-04 20:14:01"),("feugiat non, lobortis quis, pede. Suspendisse dui.","Lorem",57,200,44,"2018-11-09 20:42:20"),("lectus. Cum sociis natoque penatibus et","Lorem ipsum dolor",306,50,30,"2019-08-04 08:38:31"),("pellentesque. Sed dictum.","Lorem ipsum dolor sit amet, consectetuer",379,166,5,"2019-12-02 12:28:03"),("magna. Ut","Lorem ipsum dolor",20,16,11,"2018-08-20 08:38:51"),("orci. Ut","Lorem ipsum dolor sit",59,34,29,"2018-01-28 10:09:34"),("est. Nunc ullamcorper, velit in aliquet","Lorem ipsum dolor",409,167,24,"2018-04-27 22:19:58"),("a feugiat tellus lorem eu metus. In lorem.","Lorem ipsum dolor sit amet, consectetuer adipiscing elit.",317,189,40,"2018-02-20 04:55:36"),("sapien. Nunc pulvinar arcu et pede. Nunc sed orci lobortis","Lorem ipsum dolor",414,84,6,"2020-02-05 15:51:31");
INSERT INTO `board_talk` (`subject`,`content`,`hit`,`recommend`,`user_id`,`write_time`) VALUES ("eu turpis. Nulla aliquet.","Lorem ipsum dolor sit amet, consectetuer",710,25,48,"2018-07-16 18:26:07"),("molestie in, tempus eu, ligula. Aenean euismod mauris","Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur",672,13,44,"2019-07-05 03:10:32"),("nunc. Quisque","Lorem ipsum",608,162,37,"2019-07-09 09:52:45"),("tincidunt pede ac","Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed",498,35,33,"2019-12-20 12:31:48"),("Suspendisse sagittis. Nullam vitae diam. Proin dolor. Nulla","Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed",674,131,40,"2018-11-22 06:42:14"),("velit eget laoreet posuere, enim nisl elementum purus, accumsan interdum","Lorem ipsum dolor sit amet, consectetuer",747,36,31,"2019-10-13 14:44:50"),("eu,","Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur",993,163,9,"2019-02-24 13:38:42"),("at lacus. Quisque purus sapien, gravida","Lorem ipsum dolor",361,186,9,"2018-01-12 16:35:25"),("libero et tristique pellentesque, tellus sem mollis dui, in","Lorem ipsum dolor sit amet, consectetuer adipiscing",738,96,44,"2018-06-27 04:32:51"),("mus. Donec dignissim magna a tortor. Nunc commodo auctor velit.","Lorem ipsum dolor sit amet, consectetuer adipiscing elit.",374,85,41,"2019-11-20 08:52:21");
INSERT INTO `board_talk` (`subject`,`content`,`hit`,`recommend`,`user_id`,`write_time`) VALUES ("eros. Proin ultrices. Duis volutpat","Lorem",994,145,34,"2018-01-20 13:07:03"),("enim consequat purus. Maecenas libero est, congue a,","Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed",302,59,39,"2019-12-20 06:09:17"),("orci lobortis augue scelerisque","Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed",982,101,37,"2018-02-13 00:05:39"),("ultrices posuere cubilia Curae; Phasellus ornare. Fusce mollis. Duis sit","Lorem ipsum dolor sit amet, consectetuer adipiscing elit.",409,164,49,"2019-04-25 01:42:22"),("risus varius orci, in consequat enim","Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed",491,124,40,"2019-03-11 07:13:11"),("Mauris quis turpis vitae purus gravida sagittis. Duis gravida. Praesent","Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur",652,125,7,"2019-02-16 05:19:00"),("Phasellus ornare. Fusce mollis. Duis sit amet diam eu dolor","Lorem ipsum dolor sit amet,",951,175,34,"2018-08-10 05:13:52"),("mauris a nunc.","Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur",964,11,37,"2019-07-05 00:25:14"),("ligula. Aenean gravida nunc sed pede. Cum sociis natoque","Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed",747,88,35,"2018-12-02 17:12:52"),("pulvinar arcu et pede. Nunc sed orci lobortis augue scelerisque","Lorem ipsum dolor",631,193,36,"2018-06-08 22:31:05");
INSERT INTO `board_talk` (`subject`,`content`,`hit`,`recommend`,`user_id`,`write_time`) VALUES ("mattis","Lorem ipsum dolor sit amet, consectetuer adipiscing",447,93,20,"2018-06-10 14:06:18"),("mus. Proin vel arcu eu odio tristique pharetra. Quisque","Lorem ipsum dolor sit amet, consectetuer",509,97,40,"2019-02-06 16:37:25"),("lectus rutrum urna, nec luctus felis purus ac","Lorem ipsum dolor sit amet, consectetuer adipiscing",397,141,7,"2019-02-16 10:52:44"),("eget, ipsum. Donec sollicitudin adipiscing ligula. Aenean gravida","Lorem ipsum dolor sit amet, consectetuer",744,60,2,"2018-08-29 08:41:20"),("ornare, facilisis eget, ipsum. Donec sollicitudin adipiscing ligula. Aenean gravida","Lorem ipsum dolor sit amet, consectetuer adipiscing",145,75,18,"2018-10-31 05:43:56"),("id magna et","Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur",388,85,25,"2018-03-15 15:33:11"),("augue malesuada malesuada. Integer id magna et ipsum cursus vestibulum.","Lorem ipsum dolor sit amet,",847,171,30,"2019-03-23 12:52:05"),("lobortis ultrices. Vivamus rhoncus. Donec est. Nunc ullamcorper,","Lorem ipsum dolor sit amet, consectetuer adipiscing elit.",397,146,23,"2018-06-12 09:10:45"),("Cras convallis convallis dolor. Quisque tincidunt pede ac","Lorem ipsum dolor sit amet, consectetuer adipiscing elit.",603,78,41,"2019-01-01 08:07:40"),("orci luctus et","Lorem ipsum dolor sit amet,",320,175,27,"2019-11-28 21:18:29");
INSERT INTO `board_talk` (`subject`,`content`,`hit`,`recommend`,`user_id`,`write_time`) VALUES ("a odio semper cursus.","Lorem ipsum dolor sit amet, consectetuer adipiscing",312,62,6,"2018-05-25 17:34:34"),("diam nunc, ullamcorper eu, euismod ac, fermentum","Lorem",107,62,7,"2019-01-11 02:30:23"),("Aenean","Lorem ipsum dolor sit",85,149,6,"2018-11-08 22:53:02"),("ridiculus mus. Aenean eget magna.","Lorem ipsum",523,147,30,"2019-03-15 12:27:17"),("ligula. Nullam feugiat placerat","Lorem ipsum dolor sit amet, consectetuer adipiscing",825,47,22,"2019-07-06 06:14:44"),("mi fringilla mi lacinia","Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed",893,95,49,"2018-12-31 11:30:03"),("penatibus et magnis dis parturient","Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed",316,131,31,"2018-10-25 20:53:14"),("Quisque ornare tortor at risus.","Lorem ipsum dolor sit amet, consectetuer adipiscing elit.",737,76,26,"2019-08-24 18:08:13"),("posuere, enim nisl elementum purus, accumsan interdum libero","Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur",333,106,15,"2018-10-27 04:40:18"),("dictum ultricies","Lorem ipsum dolor sit",894,42,38,"2018-05-08 20:58:47");
INSERT INTO `board_talk` (`subject`,`content`,`hit`,`recommend`,`user_id`,`write_time`) VALUES ("eu tellus. Phasellus elit pede,","Lorem ipsum dolor sit amet,",464,158,33,"2019-06-16 17:26:35"),("Mauris eu turpis. Nulla aliquet. Proin velit. Sed malesuada","Lorem ipsum dolor sit",802,80,35,"2019-06-04 19:32:53"),("Nunc sed orci lobortis augue","Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur",46,106,49,"2018-06-08 16:20:30"),("pharetra sed, hendrerit a, arcu. Sed et","Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed",46,40,12,"2018-01-25 04:57:05"),("vulputate ullamcorper","Lorem ipsum dolor sit amet, consectetuer adipiscing elit.",218,51,21,"2019-02-25 09:25:05"),("mauris ut mi. Duis risus odio, auctor vitae, aliquet nec,","Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed",856,181,37,"2018-09-06 22:50:35"),("non, egestas a, dui. Cras pellentesque. Sed dictum. Proin eget","Lorem ipsum",896,124,31,"2018-10-15 21:50:00"),("at risus. Nunc ac sem","Lorem ipsum",878,119,50,"2019-06-14 20:04:57"),("consequat dolor vitae dolor. Donec fringilla. Donec feugiat","Lorem ipsum dolor sit amet, consectetuer adipiscing elit.",860,27,48,"2019-12-03 12:05:01"),("suscipit","Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed",200,31,40,"2019-11-03 15:03:35");
INSERT INTO `board_talk` (`subject`,`content`,`hit`,`recommend`,`user_id`,`write_time`) VALUES ("diam dictum sapien.","Lorem ipsum dolor sit amet, consectetuer",179,59,44,"2018-08-05 11:42:48"),("nisl sem,","Lorem ipsum dolor sit amet, consectetuer",184,124,17,"2019-03-14 20:56:34"),("Sed nec metus","Lorem ipsum dolor sit",915,65,6,"2018-06-20 00:37:46"),("dolor. Fusce feugiat.","Lorem ipsum dolor sit amet,",427,74,16,"2019-07-10 09:39:05"),("at, nisi. Cum sociis natoque penatibus et magnis dis","Lorem ipsum dolor",794,151,18,"2018-11-28 20:51:26"),("neque.","Lorem ipsum dolor",886,195,32,"2018-05-03 22:34:20"),("semper et, lacinia vitae, sodales at,","Lorem ipsum dolor sit amet,",747,56,40,"2019-01-05 05:07:56"),("a, scelerisque sed,","Lorem ipsum dolor sit amet, consectetuer adipiscing",718,120,9,"2019-08-02 04:10:36"),("metus facilisis lorem","Lorem ipsum dolor sit amet, consectetuer adipiscing",864,12,15,"2019-01-13 19:07:28"),("orci, adipiscing non, luctus sit","Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed",281,155,26,"2018-04-22 10:37:07");
INSERT INTO `board_talk` (`subject`,`content`,`hit`,`recommend`,`user_id`,`write_time`) VALUES ("erat volutpat. Nulla facilisis. Suspendisse commodo tincidunt","Lorem",297,170,1,"2018-03-24 13:20:38"),("rutrum non, hendrerit id, ante. Nunc mauris sapien, cursus","Lorem ipsum dolor sit amet,",301,175,26,"2018-06-15 02:49:35"),("molestie tellus. Aenean egestas hendrerit neque. In ornare sagittis","Lorem ipsum dolor sit",34,142,13,"2019-01-20 15:07:54"),("eget lacus. Mauris non dui nec urna suscipit nonummy. Fusce","Lorem ipsum dolor sit amet, consectetuer adipiscing elit.",786,110,27,"2019-05-27 03:20:32"),("dis parturient montes,","Lorem ipsum dolor",782,146,40,"2018-10-14 21:09:36"),("volutpat. Nulla","Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur",979,51,42,"2018-03-25 03:00:20"),("gravida","Lorem",152,110,41,"2018-06-01 17:18:35"),("nisl. Nulla eu neque pellentesque","Lorem ipsum dolor sit amet, consectetuer",54,157,14,"2018-11-16 00:19:26"),("quam, elementum at, egestas a, scelerisque sed,","Lorem ipsum",270,164,46,"2018-07-29 14:10:07"),("neque sed dictum eleifend, nunc risus","Lorem ipsum dolor sit",629,162,22,"2018-05-25 14:03:12");

INSERT INTO board_talk_comment (board_talk_id,user_id,comment,recommend,write_time) VALUES (68,10,"ipsum. Suspendisse non leo. Vivamus nibh dolor, nonummy ac,",27,"2019-01-14 16:14:38"),(46,10,"vehicula et, rutrum eu,",46,"2018-04-26 14:00:39"),(25,29,"varius. Nam",46,"2018-10-26 04:10:59"),(33,24,"nibh sit amet orci.",46,"2018-07-05 19:53:21"),(7,22,"Integer urna. Vivamus molestie dapibus ligula. Aliquam erat",33,"2018-07-18 02:15:51"),(73,10,"per conubia nostra, per inceptos hymenaeos. Mauris ut quam vel",15,"2018-05-13 13:12:30"),(68,40,"erat vel pede blandit congue. In scelerisque",32,"2018-03-25 00:06:26"),(55,29,"sem molestie sodales. Mauris blandit enim consequat purus. Maecenas",33,"2018-04-04 04:06:00"),(66,23,"pharetra",34,"2018-12-29 16:08:04"),(13,41,"et risus. Quisque libero lacus,",24,"2018-08-18 22:05:38");
INSERT INTO board_talk_comment (board_talk_id,user_id,comment,recommend,write_time) VALUES (41,19,"id nunc interdum feugiat. Sed nec metus",40,"2018-11-03 08:13:14"),(15,6,"risus",12,"2018-07-23 11:36:20"),(34,43,"gravida nunc sed pede. Cum sociis",39,"2018-12-13 13:02:44"),(75,33,"felis purus ac tellus. Suspendisse sed",6,"2018-08-23 12:13:21"),(2,38,"dictum mi, ac mattis velit",34,"2018-11-24 23:38:23"),(86,36,"lacus. Quisque purus sapien, gravida non,",9,"2018-12-28 00:59:17"),(22,46,"Nullam lobortis quam a felis ullamcorper viverra.",10,"2018-06-13 23:02:25"),(17,47,"Maecenas ornare egestas ligula. Nullam feugiat",7,"2018-11-09 18:49:53"),(56,4,"quis diam",43,"2018-07-29 12:31:50"),(27,12,"tristique neque venenatis lacus. Etiam",38,"2019-01-02 22:37:26");
INSERT INTO board_talk_comment (board_talk_id,user_id,comment,recommend,write_time) VALUES (5,32,"semper auctor. Mauris vel turpis. Aliquam adipiscing",35,"2018-09-17 20:50:30"),(58,37,"nec",42,"2018-06-08 12:36:19"),(36,25,"interdum ligula eu enim. Etiam imperdiet",13,"2018-07-19 14:32:44"),(9,38,"dignissim pharetra. Nam ac nulla.",40,"2018-07-03 10:24:57"),(67,16,"bibendum. Donec felis orci, adipiscing non,",42,"2018-06-19 05:10:48"),(2,47,"magna, malesuada vel, convallis in, cursus et, eros. Proin ultrices.",47,"2018-08-22 08:51:18"),(26,2,"consectetuer adipiscing elit. Curabitur",27,"2019-01-06 03:53:58"),(8,25,"in faucibus orci luctus",14,"2018-11-22 20:32:35"),(64,36,"quam dignissim",20,"2018-08-02 22:24:18"),(5,32,"vulputate velit",31,"2019-01-19 08:45:49");
INSERT INTO board_talk_comment (board_talk_id,user_id,comment,recommend,write_time) VALUES (7,6,"penatibus",21,"2018-12-03 01:52:30"),(84,35,"ornare tortor at",3,"2018-04-24 20:36:28"),(63,38,"nec luctus felis purus ac tellus.",35,"2018-03-23 17:42:30"),(54,47,"ipsum leo elementum sem, vitae aliquam",39,"2018-12-20 13:45:31"),(99,43,"quis arcu",34,"2018-06-12 00:25:43"),(17,15,"blandit congue. In scelerisque scelerisque dui. Suspendisse ac metus",21,"2018-09-27 11:51:07"),(36,13,"a, malesuada id, erat. Etiam vestibulum",24,"2018-11-25 03:37:40"),(8,9,"dui. Fusce diam nunc, ullamcorper eu, euismod ac, fermentum",18,"2018-11-06 05:53:24"),(21,3,"imperdiet, erat",9,"2018-09-02 19:34:06"),(90,38,"eu augue porttitor",22,"2019-01-10 11:40:34");
INSERT INTO board_talk_comment (board_talk_id,user_id,comment,recommend,write_time) VALUES (61,19,"sollicitudin orci sem eget massa. Suspendisse eleifend. Cras",37,"2018-10-16 19:05:46"),(9,37,"nisi sem semper erat, in consectetuer ipsum nunc",44,"2018-07-29 23:29:42"),(56,41,"Proin non massa",28,"2018-03-08 21:00:33"),(38,1,"In mi pede, nonummy ut, molestie in, tempus eu,",24,"2018-08-23 15:20:23"),(49,20,"ullamcorper, nisl arcu iaculis enim, sit amet ornare lectus justo",32,"2018-02-24 10:38:48"),(90,4,"eget, volutpat ornare, facilisis eget, ipsum. Donec sollicitudin adipiscing ligula.",14,"2018-05-21 06:35:04"),(1,47,"Curae; Phasellus ornare. Fusce mollis. Duis sit",6,"2019-01-20 18:16:17"),(62,49,"dictum.",46,"2018-12-27 17:31:44"),(44,11,"sem ut",43,"2018-11-17 20:01:58"),(27,35,"Nulla interdum.",37,"2018-10-05 15:37:02");
INSERT INTO board_talk_comment (board_talk_id,user_id,comment,recommend,write_time) VALUES (8,48,"convallis",6,"2018-08-05 04:28:44"),(25,33,"Donec egestas. Duis ac arcu. Nunc mauris. Morbi",18,"2018-07-08 23:44:47"),(25,33,"inceptos hymenaeos. Mauris ut",27,"2018-12-03 16:48:30"),(8,48,"eu, ligula.",36,"2018-05-14 18:53:21"),(99,8,"Quisque purus sapien, gravida non, sollicitudin a, malesuada id,",10,"2018-04-01 01:06:11"),(54,4,"vulputate, nisi",43,"2018-10-01 00:26:53"),(3,11,"mus. Aenean eget magna. Suspendisse tristique neque venenatis lacus. Etiam",38,"2018-05-08 03:34:57"),(47,37,"ac metus vitae velit egestas lacinia. Sed congue, elit sed",50,"2018-10-02 09:45:43"),(25,2,"lectus pede et risus. Quisque libero lacus, varius",22,"2018-03-06 12:34:20"),(72,39,"purus ac tellus. Suspendisse sed dolor. Fusce mi",23,"2018-08-18 18:33:00");
INSERT INTO board_talk_comment (board_talk_id,user_id,comment,recommend,write_time) VALUES (47,26,"scelerisque neque",16,"2018-10-16 08:14:37"),(65,48,"Duis at lacus. Quisque purus sapien, gravida",1,"2018-08-08 04:17:08"),(53,44,"orci",42,"2018-08-15 09:34:31"),(85,13,"Suspendisse tristique neque venenatis lacus.",43,"2019-01-08 02:07:37"),(66,46,"primis in faucibus orci luctus et ultrices posuere cubilia Curae;",50,"2018-07-20 00:21:31"),(100,30,"cursus a, enim. Suspendisse aliquet, sem ut cursus",26,"2018-04-28 14:32:54"),(11,5,"Pellentesque habitant morbi tristique senectus et netus et",34,"2018-05-29 08:30:51"),(15,38,"interdum",10,"2018-07-07 02:13:12"),(50,49,"non leo. Vivamus nibh dolor, nonummy ac, feugiat non,",14,"2018-06-07 09:53:18"),(86,1,"ac sem ut dolor",35,"2018-10-23 08:09:41");
INSERT INTO board_talk_comment (board_talk_id,user_id,comment,recommend,write_time) VALUES (5,7,"facilisis lorem tristique aliquet. Phasellus fermentum convallis ligula. Donec",41,"2018-05-18 19:48:43"),(85,26,"volutpat nunc sit amet metus.",22,"2018-03-21 22:13:44"),(92,15,"ut nisi a odio semper cursus. Integer mollis. Integer",10,"2018-05-04 10:31:31"),(75,22,"vehicula",16,"2018-06-09 23:51:50"),(32,24,"tellus lorem eu metus. In lorem. Donec",14,"2018-06-10 20:38:01"),(60,14,"Integer vulputate, risus a ultricies adipiscing,",21,"2018-12-01 10:54:24"),(15,15,"lacus vestibulum lorem, sit amet ultricies sem magna nec quam.",9,"2018-09-14 02:44:51"),(83,29,"eu, euismod ac, fermentum vel, mauris. Integer",3,"2018-09-17 15:20:16"),(25,22,"magna a neque. Nullam ut",44,"2018-10-30 15:11:36"),(38,28,"dignissim pharetra.",46,"2018-06-09 08:49:19");
INSERT INTO board_talk_comment (board_talk_id,user_id,comment,recommend,write_time) VALUES (79,3,"nunc sit amet metus. Aliquam erat volutpat. Nulla",38,"2019-01-13 19:55:31"),(24,38,"eleifend nec, malesuada ut,",47,"2018-04-14 08:45:19"),(94,35,"id enim. Curabitur massa. Vestibulum accumsan neque et",30,"2018-08-28 17:22:11"),(11,11,"aliquam iaculis,",43,"2018-12-20 21:24:59"),(66,49,"iaculis odio. Nam",49,"2018-07-01 22:00:43"),(31,11,"nibh lacinia orci, consectetuer euismod est arcu",25,"2018-12-04 02:19:52"),(83,45,"in, hendrerit consectetuer, cursus et, magna. Praesent interdum",34,"2018-12-22 21:44:25"),(9,12,"eleifend",42,"2018-11-23 07:57:36"),(98,25,"Fusce",48,"2018-07-07 10:54:07"),(4,5,"est. Mauris eu turpis. Nulla aliquet. Proin",31,"2018-10-06 22:53:09");
INSERT INTO board_talk_comment (board_talk_id,user_id,comment,recommend,write_time) VALUES (88,43,"et magnis dis parturient montes, nascetur ridiculus mus.",22,"2019-02-01 19:17:02"),(10,22,"euismod enim. Etiam gravida molestie arcu. Sed eu",34,"2019-01-18 20:08:33"),(7,47,"vestibulum nec, euismod in,",37,"2018-07-12 08:07:50"),(29,20,"sed dictum eleifend, nunc risus varius orci, in consequat enim",37,"2018-03-01 12:54:20"),(62,27,"dui. Suspendisse ac metus vitae velit egestas",31,"2018-09-07 23:16:28"),(66,16,"imperdiet, erat nonummy ultricies ornare, elit elit fermentum risus, at",34,"2018-12-20 13:31:56"),(30,25,"a, magna.",18,"2018-07-29 02:51:53"),(40,33,"Aliquam tincidunt, nunc ac mattis ornare, lectus",12,"2018-07-01 02:35:50"),(62,29,"Proin dolor. Nulla semper tellus",23,"2018-02-25 05:50:30"),(30,19,"non, lobortis quis, pede. Suspendisse dui. Fusce",42,"2018-05-30 20:44:38");
INSERT INTO board_talk_comment (board_talk_id,user_id,comment,recommend,write_time) VALUES (96,44,"Donec dignissim magna a tortor. Nunc commodo auctor velit.",27,"2018-04-15 23:07:43"),(19,6,"vehicula et, rutrum eu,",47,"2018-09-16 20:46:28"),(6,13,"vel turpis. Aliquam",1,"2018-04-17 21:36:06"),(84,27,"leo. Morbi neque tellus, imperdiet",16,"2018-07-18 21:50:13"),(98,27,"non,",21,"2018-05-30 15:07:13"),(49,47,"dictum eleifend, nunc risus varius orci, in",20,"2018-03-13 15:42:38"),(23,35,"dictum magna. Ut tincidunt orci quis",23,"2018-05-17 15:56:35"),(43,16,"Phasellus vitae mauris",32,"2018-08-07 10:14:34"),(16,13,"Duis at lacus. Quisque purus",17,"2019-01-12 04:18:32"),(55,27,"Vivamus molestie dapibus ligula. Aliquam erat volutpat.",10,"2018-12-13 17:32:50");
INSERT INTO board_talk_comment (board_talk_id,user_id,comment,recommend,write_time) VALUES (8,6,"sapien molestie orci tincidunt",1,"2018-06-17 16:38:36"),(80,32,"commodo ipsum. Suspendisse non leo. Vivamus nibh dolor, nonummy",5,"2018-10-15 01:32:51"),(34,32,"amet luctus vulputate, nisi sem semper erat,",25,"2019-01-12 00:40:42"),(30,32,"torquent per conubia nostra, per inceptos hymenaeos. Mauris",22,"2018-09-19 22:51:06"),(16,41,"laoreet posuere, enim nisl elementum",11,"2018-05-21 16:47:49"),(58,2,"semper pretium neque. Morbi quis urna. Nunc quis",18,"2019-01-07 19:27:47"),(91,7,"ullamcorper eu, euismod ac, fermentum vel,",39,"2018-10-09 07:08:46"),(16,18,"conubia nostra, per inceptos",43,"2018-05-11 12:59:21"),(6,4,"non, feugiat nec,",4,"2019-01-21 04:55:41"),(76,10,"vitae dolor. Donec fringilla. Donec feugiat metus sit amet",27,"2019-01-06 23:09:57");
INSERT INTO board_talk_comment (board_talk_id,user_id,comment,recommend,write_time) VALUES (47,19,"lorem, vehicula et, rutrum eu, ultrices sit",38,"2018-09-07 19:03:02"),(36,17,"magna. Sed eu eros. Nam consequat dolor vitae",20,"2018-12-22 19:58:15"),(88,49,"non nisi. Aenean eget metus. In nec",8,"2018-12-30 00:41:07"),(44,25,"ac orci. Ut semper pretium",20,"2018-03-16 19:01:12"),(57,30,"Maecenas iaculis aliquet diam. Sed diam lorem, auctor",5,"2018-05-09 17:04:22"),(27,20,"lacinia. Sed congue,",18,"2018-04-02 05:13:44"),(8,26,"magna sed dui. Fusce aliquam,",27,"2018-12-29 13:34:30"),(63,47,"lobortis augue scelerisque mollis. Phasellus libero mauris, aliquam eu,",11,"2018-11-01 03:16:05"),(93,24,"consectetuer mauris id sapien. Cras",38,"2018-05-10 04:32:11"),(41,17,"Aliquam auctor, velit eget",2,"2018-07-09 12:57:07");
INSERT INTO board_talk_comment (board_talk_id,user_id,comment,recommend,write_time) VALUES (68,44,"lacus. Nulla tincidunt, neque vitae semper egestas, urna justo",17,"2018-10-12 23:30:12"),(72,6,"eu, ultrices sit amet, risus.",42,"2018-12-24 04:04:04"),(92,13,"lobortis quam a felis ullamcorper viverra. Maecenas iaculis aliquet",32,"2018-05-20 13:56:02"),(50,32,"eget laoreet posuere, enim nisl elementum purus, accumsan",22,"2018-10-08 09:12:36"),(54,45,"ultrices posuere cubilia Curae; Phasellus ornare. Fusce mollis. Duis",29,"2018-03-23 12:46:33"),(46,25,"nibh. Quisque nonummy",41,"2018-07-06 19:31:27"),(96,46,"lectus rutrum urna, nec luctus",48,"2018-10-15 20:24:25"),(13,9,"ornare, lectus ante dictum mi, ac",3,"2018-11-30 08:09:20"),(58,31,"malesuada fames ac turpis egestas. Aliquam fringilla cursus",8,"2018-02-28 15:13:19"),(54,39,"luctus lobortis. Class aptent taciti sociosqu ad litora torquent",46,"2018-06-10 18:47:21");
INSERT INTO board_talk_comment (board_talk_id,user_id,comment,recommend,write_time) VALUES (5,40,"euismod et, commodo at, libero. Morbi accumsan laoreet ipsum.",19,"2019-01-09 01:23:58"),(30,11,"ante, iaculis nec,",31,"2018-05-19 03:12:09"),(24,49,"magna, malesuada",40,"2019-01-15 14:25:00"),(1,20,"sit amet ultricies sem magna nec quam. Curabitur vel",46,"2018-09-12 04:51:37"),(99,23,"ultricies",13,"2019-01-10 19:42:24"),(7,21,"pellentesque a, facilisis non, bibendum",47,"2018-11-04 06:00:11"),(96,48,"tellus",2,"2018-05-11 21:41:48"),(72,16,"ipsum cursus vestibulum. Mauris magna. Duis dignissim tempor arcu. Vestibulum",13,"2018-03-05 12:25:05"),(84,50,"Sed id risus quis diam",30,"2018-06-18 11:32:04"),(60,18,"vitae mauris sit",14,"2018-06-06 16:14:43");
INSERT INTO board_talk_comment (board_talk_id,user_id,comment,recommend,write_time) VALUES (57,43,"facilisis, magna tellus faucibus",17,"2018-12-29 15:16:00"),(82,19,"nibh enim, gravida sit",18,"2019-01-26 08:39:45"),(59,8,"a sollicitudin",35,"2018-11-30 21:48:52"),(82,9,"non, vestibulum nec, euismod in, dolor. Fusce feugiat.",47,"2018-03-03 08:41:46"),(36,25,"arcu et pede. Nunc sed orci lobortis",18,"2018-06-14 17:13:29"),(58,31,"at, egestas a, scelerisque",8,"2019-01-01 21:26:13"),(63,36,"Etiam imperdiet dictum magna. Ut tincidunt orci",14,"2018-12-30 20:06:03"),(9,38,"diam nunc,",7,"2018-10-15 05:07:03"),(60,26,"Nam interdum enim non",1,"2018-09-08 07:42:25"),(6,6,"velit",18,"2018-05-14 23:55:19");
INSERT INTO board_talk_comment (board_talk_id,user_id,comment,recommend,write_time) VALUES (82,47,"lobortis, nisi nibh lacinia orci,",38,"2018-04-10 14:11:39"),(71,26,"Vestibulum",17,"2018-06-22 02:15:49"),(77,35,"nec orci. Donec nibh.",28,"2018-11-13 22:03:36"),(95,7,"interdum",42,"2019-01-29 20:15:05"),(36,25,"Vestibulum ante ipsum",24,"2018-09-26 21:07:16"),(82,26,"turpis egestas. Fusce aliquet magna a neque. Nullam",10,"2019-01-29 22:29:39"),(64,4,"amet risus. Donec egestas.",35,"2018-05-29 10:30:26"),(51,11,"Vivamus non lorem vitae odio sagittis semper. Nam",14,"2019-02-06 00:28:02"),(91,18,"auctor. Mauris vel turpis. Aliquam adipiscing lobortis risus. In mi",6,"2018-12-06 10:49:00"),(24,40,"erat. Vivamus nisi. Mauris",17,"2018-08-23 07:23:30");
INSERT INTO board_talk_comment (board_talk_id,user_id,comment,recommend,write_time) VALUES (25,13,"parturient montes, nascetur ridiculus mus. Donec",10,"2018-04-15 09:20:12"),(96,25,"Fusce mollis. Duis sit",28,"2018-03-09 21:56:01"),(3,37,"aliquam, enim nec tempus scelerisque, lorem ipsum",36,"2018-03-01 18:31:15"),(85,6,"Etiam laoreet, libero",24,"2018-05-27 04:24:56"),(46,31,"Cras dictum ultricies ligula. Nullam enim. Sed nulla ante,",38,"2018-02-24 20:46:01"),(47,39,"Etiam",29,"2018-09-14 02:50:57"),(28,2,"lectus. Nullam suscipit, est ac facilisis",5,"2019-01-07 07:12:16"),(86,34,"imperdiet, erat nonummy ultricies",25,"2018-02-23 02:36:06"),(45,12,"sit amet ante. Vivamus",30,"2018-07-21 04:44:01"),(70,7,"lacus. Ut nec",20,"2018-12-05 17:15:08");
INSERT INTO board_talk_comment (board_talk_id,user_id,comment,recommend,write_time) VALUES (71,39,"interdum ligula eu enim. Etiam",44,"2018-11-23 17:43:21"),(59,40,"at",43,"2018-10-29 18:55:08"),(5,22,"ut mi. Duis risus odio, auctor vitae, aliquet nec, imperdiet",48,"2018-09-11 03:30:20"),(90,42,"varius et, euismod et, commodo at, libero. Morbi accumsan laoreet",5,"2018-07-29 13:07:41"),(39,13,"per conubia nostra, per inceptos hymenaeos.",1,"2018-08-08 15:44:17"),(51,5,"vitae, sodales at, velit. Pellentesque ultricies dignissim lacus. Aliquam",9,"2018-10-09 18:27:39"),(63,27,"ut cursus luctus, ipsum leo elementum",6,"2018-07-16 03:47:04"),(70,2,"Curabitur massa.",11,"2018-03-18 00:30:04"),(47,35,"pede. Suspendisse dui. Fusce",10,"2018-05-31 07:31:48"),(81,22,"mollis",22,"2018-03-09 08:26:02");
INSERT INTO board_talk_comment (board_talk_id,user_id,comment,recommend,write_time) VALUES (44,20,"litora torquent",35,"2019-01-28 17:56:39"),(100,43,"at, iaculis quis,",12,"2018-10-19 11:52:47"),(52,48,"id",20,"2018-09-02 05:50:56"),(83,42,"magna,",1,"2018-10-31 16:03:22"),(1,23,"vitae, sodales at, velit. Pellentesque ultricies",25,"2018-04-29 08:04:04"),(22,18,"mi. Duis risus odio, auctor vitae,",9,"2018-07-04 19:16:03"),(14,26,"vitae, orci. Phasellus dapibus",6,"2018-08-24 10:03:47"),(48,20,"hendrerit id, ante. Nunc",26,"2019-01-22 04:57:24"),(71,42,"ac, eleifend vitae, erat. Vivamus nisi. Mauris nulla. Integer",36,"2018-03-21 02:02:11"),(62,48,"consectetuer, cursus et, magna. Praesent",12,"2018-05-22 05:44:31");


