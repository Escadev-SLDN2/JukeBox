CREATE DATABASE jukebox CHARACTER SET 'utf8';
USE jukebox;

CREATE USER 'jukebox' IDENTIFIED BY 'A9Z8E1R2';
GRANT ALL privileges ON `jukebox`.* TO 'jukebox'@'%';
FLUSH PRIVILEGES;