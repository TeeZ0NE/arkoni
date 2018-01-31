-- create DB
CREATE DATABASE arkoni_db;
-- select DB
USE arkoni_db;
-- create admin user
CREATE USER 'arkoni_admin'@'localhost' identified BY 'CMRlpTQTfUQgM7';
GRANT ALL PRIVILEGES ON `arkoni\_db`.* TO 'arkoni_admin'@'localhost' WITH GRANT OPTION;
