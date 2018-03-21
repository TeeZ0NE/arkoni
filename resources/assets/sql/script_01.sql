INSERT into uatophost_db.regions (region) VALUES ('UK'),('RU');

select h.name,h.hoster_id,r.rait,h.region FROM uatophost_db.hosters h INNER JOIN uatophost_db.raitings r using(hoster_id);

SELECT h.name, h.region,reg.region, rate.rait FROM uatophost_db.hosters h 
INNER JOIN uatophost_db.raitings rate using(hoster_id)
LEFT JOIN uatophost_db.regions reg ON
h.region = reg.id WHERE reg.region='UK'
ORDER BY rate.rait;

CREATE TABLE uatophost_db.kind_of_hostings(
kind_id TINYINT UNSIGNED auto_increment PRIMARY KEY,
caption VARCHAR(24) CHARACTER SET UTF8 COLLATE utf8_general_ci not NULL UNIQUE,
INDEX caption_index(caption)
);

ALTER TABLE uatophost_db.types_of_hostings ADD kind_of_hosting_id TINYINT UNSIGNED,
ADD CONSTRAINT FOREIGN KEY(kind_of_hosting_id) REFERENCES uatophost_db.kind_of_hostings(kind_id);

INSERT INTO uatophost_db.kind_of_hostings (caption) VALUES ('vps'),('unlimited'),('vps server'), ('vds server');

-- select right types_of-hostings
SELECT h.hoster_id, h.name FROM uatophost_db.hosters h RIGHT JOIN uatophost_db.types_of_hostings t USING(hoster_id);

-- adding type and kind of hosters
INSERT INTO uatophost_db.types_of_hostings VALUES(NULL,'Mini',1,1),(NULL,'Comfort',2,1),(NULL,'Pro',4,2),
(NULL,'ser',4,3),(NULL,'ProMo',10,4),(NULL,'Prod',6,4);

-- h.name, h.hoster_id, k.caption,rate.rait
SELECT hosters.name, hosters.hoster_id, kind_of_hostings.caption,raitings.rait FROM uatophost_db.types_of_hostings
INNER JOIN uatophost_db.hosters ON types_of_hostings.hoster_id=hosters.hoster_id
INNER JOIN uatophost_db.kind_of_hostings ON types_of_hostings.kind_of_hosting_id=kind_of_hostings.kind_id
INNER JOIN uatophost_db.raitings ON raitings.hoster_id=hosters.hoster_id
WHERE kind_of_hostings.url_slug='vds-server' OR kind_of_hostings.url_slug='vps-server'
ORDER BY raitings.rait LIMIT 10;

SELECT title as promo_title,promo_text, name as hoster_name, hosters.url_slug FROM promotions INNER JOIN hosters on promotions.hoster_id = hosters.hoster_id
WHERE promo_display=1 ORDER BY promo_start;

ALTER TABLE promotions ADD promo_display TINYINT(1) UNSIGNED DEFAULT 1 comment "Does it display";
UPDATE promotions SET promo_display=0 WHERE hoster_id=2;
-- adding and using index
ALTER TABLE uatophost_db.types_of_hostings
ADD  url_slug VARCHAR(30) CHARACTER SET utf8 NOT NULL,
ADD INDEX url_slug_types_index (url_slug);

SELECT * FROM uatophost_db.hosters USE INDEX(url_slug_index) where url_slug='ukraina';

CREATE TABLE uatophost_db.locations(
hoster_id SMALLINT UNSIGNED PRIMARY KEY,
location JSON NOT NULL
);
Alter TABLE uatophost_db.locations ADD
CONSTRAINT `FK_location_hoster_id`  FOREIGN KEY (hoster_id) REFERENCES uatophost_db.hosters(hoster_id) 
ON DELETE RESTRICT on UPDATE CASCADE;
insert into uatophost_db.locations VALUES(1, '{"locale":["ru","ua"]}');

SELECT JSON_EXTRACT(location,"$.ua[0]") FROM uatophost_db.locations;
SELECT json_keys(location) FROM uatophost_db.locations;
SELECT hoster_id FROM uatophost_db.locations WHERE JSON_ECTRACT(location,);

-- checking which hoster has specific location
SELECT hoster_id FROM uatophost_db.locations where JSON_CONTAINS_PATH(location,'one','$.ru')=1;
-- count  hoster's locations 
SELECT json_length(location) FROM uatophost_db.locations;

SELECT location->"$.ru", json_length(location->'$.ru') FROM uatophost_db.locations WHERE hoster_id=1;
-- UPDATE uatophost_db.locations SET location json_set(uatophost_db.locations,'$.ua',23);

SELECT * FROM hosters INNER JOIN regions ON regions.id=hosters.region;

TRUNCATE TABLE raitings;
ALTER TABLE locations ADD UNIQUE(hoster_id);
INSERT INTO raitings(hoster_id,rait) VALUES (5,333);


INSERT INTO locations VALUES(3,'{"bg":["Lublin"]}'),
(4,'{"eu":[]}'),(5,'{"gb":[]}'),(6,'{"ro":["Romaneshty"]}'),(7,'{"ru":[]}'),(8,'{"it":["Rim"]}'),
(9,'{"gb":["London","York"]}'),(10,'{"ca":["Toronto","Princ Edvards"]}'),(11,'{"ca":["Monreal"]}'),(12,'{"en":["New York","Los Angeles"]}');

SELECT * FROM types_of_hostings INNER JOIN kind_of_hostings on (kind_of_hosting_id=kind_id);
SELECT * FROM hosters

SELECT * FROM uatophost_db.regions WHERE region="gb";

ALTER TABLE arkoni_db.ru_categories CHANGE ru_name name varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;
ALTER TABLE arkoni_db.uk_categories CHANGE uk_name name varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;
ALTER TABLE arkoni_db.ru_sub_categories CHANGE ru_name name varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;
ALTER TABLE arkoni_db.uk_sub_categories CHANGE uk_name name varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;
ALTER TABLE arkoni_db.ru_items CHANGE ru_name name varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;
ALTER TABLE arkoni_db.uk_items CHANGE uk_name name varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;
ALTER TABLE arkoni_db.ru_categories CHANGE `desc` description varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT 'page description' ;
ALTER TABLE arkoni_db.uk_categories CHANGE `desc` description varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT 'page description' ;
ALTER TABLE arkoni_db.uk_sub_categories CHANGE `desc` description varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT 'page description' ;
ALTER TABLE arkoni_db.ru_sub_categories CHANGE `desc` description varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT 'page description' ;
ALTER TABLE arkoni_db.ru_items CHANGE `desc` description longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;
ALTER TABLE arkoni_db.uk_items CHANGE `desc` description longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;




