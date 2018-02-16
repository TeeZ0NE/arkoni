-- create DB
CREATE DATABASE arkoni_db;
-- select DB
USE arkoni_db;
-- create admin user
CREATE USER 'arkoni_admin'@'localhost' identified BY 'CMRlpTQTfUQgM7';
GRANT ALL PRIVILEGES ON `arkoni\_db`.* TO 'arkoni_admin'@'localhost' WITH GRANT OPTION;

TRUNCATE arkoni_db.migrations;
DROP TABLE items;
DROP TABLE `attributes`;
SELECT c.id,c.name,c.url_slug, p.name "paren name",p.url_slug "parent url" FROM categories c INNER JOIN parent_categories p ON c.parent_id=p.id;