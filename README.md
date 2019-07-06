# Password Manager

This project is written in PHP7.2 and uses MySQL 5.7 as the database. 

Create Users table: 
`CREATE TABLE 'password_manager'.'users' (
   'id' INT NOT NULL AUTO_INCREMENT,
   'username' VARCHAR(45) NULL,
   'first_name' VARCHAR(20) NULL,
   'last_name' VARCHAR(20) NULL,
   'password' VARCHAR(64) NULL,
   'salt' VARCHAR(45) NULL,
   'created_at' DATETIME NULL,
   PRIMARY KEY ('id'));`