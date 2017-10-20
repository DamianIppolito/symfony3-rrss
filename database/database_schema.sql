CREATE DATABASE IF NOT EXISTS curso_social_network;
USE curso_social_network;

CREATE TABLE users(
id	int(255) AUTO_INCREMENT NOT NULL,
role varchar(20),
email varchar(255),
name varchar(255),
surname varchar(255),
password varchar(255),
nick varchar(50),
bio varchar(255),
active varchar(255),
image varchar(255),
CONSTRAINT users_uniques_fields UNIQUE (email,nick),
CONSTRAINT pk_users PRIMARY KEY (id)
)ENGINE=InnoDB;

CREATE TABLE publications(
id	int(255) AUTO_INCREMENT NOT NULL,
user_id int(255),
text mediumtext,
document varchar(100),
image varchar(255),
status varchar(30),
created_at datetime,
CONSTRAINT pk_publications PRIMARY KEY (id),
CONSTRAINT fk_publications_users FOREIGN KEY (user_id) REFERENCES users(id)
)ENGINE=InnoDB;

CREATE TABLE following(
id	int(255) AUTO_INCREMENT NOT NULL,
user int(255),
followed int(255),
CONSTRAINT pk_following PRIMARY KEY (id),
CONSTRAINT fk_following_users FOREIGN KEY (user) REFERENCES users(id),
CONSTRAINT fk_following_followed FOREIGN KEY (followed) REFERENCES users(id)
)ENGINE=InnoDB;

CREATE TABLE private_messages(
id	int(255) AUTO_INCREMENT NOT NULL,
message longtext,
emitter int(255),
receiver int(255),
file varchar(255),
image varchar(255),
readed varchar(3),
created_at datetime,
CONSTRAINT pk_private_messages PRIMARY KEY (id),
CONSTRAINT fk_emitter_privates FOREIGN KEY (emitter) REFERENCES users(id),
CONSTRAINT fk_receiver_privates FOREIGN KEY (receiver) REFERENCES users(id)
)ENGINE=InnoDB;

CREATE TABLE likes(
id	int(255) AUTO_INCREMENT NOT NULL,
user int(255),
publication int(255),
CONSTRAINT pk_likes PRIMARY KEY (id),
CONSTRAINT fk_likes_users FOREIGN KEY (user) REFERENCES users(id),
CONSTRAINT fk_likes_publications FOREIGN KEY (publication) REFERENCES publications(id)
)ENGINE=InnoDB;

CREATE TABLE notifications(
id	int(255) AUTO_INCREMENT NOT NULL,
user_id int(255),
type varchar(255),
type_id int(255),
readed varchar(3),
created_at datetime,
extra varchar(100)
CONSTRAINT pk_notifications PRIMARY KEY (id),
CONSTRAINT fk_notifications_users FOREIGN KEY (user_id) REFERENCES users(id),
CONSTRAINT fk_likes_publications FOREIGN KEY (publication) REFERENCES publications(id)
)ENGINE=InnoDB;