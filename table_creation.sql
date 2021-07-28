CREATE DATABASE yii2basic CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

use yii2basic;

 create table article (
id varchar(255) NOT NULL, 
body text,
cert varchar(255),
class varchar(255),
duration int,
headline varchar(255),
lastUpdated varchar(255),
quote text,
rating int,
skyGoId varchar(255),
skyGoUrl text,
sum varchar(255),
synopsis text,
url text,
year varchar(255),
PRIMARY KEY (id))ENGINE=InnoDB DEFAULT CHARACTER SET=utf8mb4 COLLATE utf8mb4_unicode_ci;

create table cardImages (
id int NOT NULL AUTO_INCREMENT,
article_id varchar(255) NOT NULL, 
url text,
h int,
w int,
PRIMARY KEY(id),
FOREIGN KEY (article_id) REFERENCES article(id)
)ENGINE=InnoDB DEFAULT CHARACTER SET=utf8mb4 COLLATE utf8mb4_unicode_ci;

create table cast (
id int NOT NULL AUTO_INCREMENT,
article_id varchar(255) NOT NULL, 
name varchar(255),
PRIMARY KEY(id),
FOREIGN KEY (article_id) REFERENCES article(id)
)ENGINE=InnoDB DEFAULT CHARACTER SET=utf8mb4 COLLATE utf8mb4_unicode_ci;


create table directors (
id int NOT NULL AUTO_INCREMENT,
article_id varchar(255) NOT NULL, 
name varchar(255),
PRIMARY KEY(id),
FOREIGN KEY (article_id) REFERENCES article(id)
)ENGINE=InnoDB DEFAULT CHARACTER SET=utf8mb4 COLLATE utf8mb4_unicode_ci;

create table genres(
id int NOT NULL AUTO_INCREMENT,
article_id varchar(255) NOT NULL, 
name varchar(255),
PRIMARY KEY(id),
FOREIGN KEY (article_id) REFERENCES article(id)
)ENGINE=InnoDB DEFAULT CHARACTER SET=utf8mb4 COLLATE utf8mb4_unicode_ci;

create table artImages(
id int NOT NULL AUTO_INCREMENT,
article_id varchar(255) NOT NULL, 
url varchar(255),
h int,
w int,
PRIMARY KEY(id),
FOREIGN KEY (article_id) REFERENCES article(id)
)ENGINE=InnoDB DEFAULT CHARACTER SET=utf8mb4 COLLATE utf8mb4_unicode_ci;

create table videos(
id int NOT NULL AUTO_INCREMENT,
article_id varchar(255) NOT NULL, 
title varchar(255),
type varchar(255),
url varchar(255),
PRIMARY KEY (id),
FOREIGN KEY (article_id) REFERENCES article(id)
)ENGINE=InnoDB DEFAULT CHARACTER SET=utf8mb4 COLLATE utf8mb4_unicode_ci;

create table alternatives(
id int NOT NULL AUTO_INCREMENT,
video_id int NOT NULL, 
quality varchar(255),
url varchar(255),
PRIMARY KEY (id),
FOREIGN KEY (video_id) REFERENCES videos(id)
)ENGINE=InnoDB DEFAULT CHARACTER SET=utf8mb4 COLLATE utf8mb4_unicode_ci;

create table viewingWindow(
id int NOT NULL AUTO_INCREMENT,
article_id varchar(255) NOT NULL, 
startDate varchar(255),
wayToWatch varchar(255),
endDate varchar(255),
PRIMARY KEY (id),
FOREIGN KEY (article_id) REFERENCES article(id)
)ENGINE=InnoDB DEFAULT CHARACTER SET=utf8mb4 COLLATE utf8mb4_unicode_ci;

