# Password Manager

This project is written in PHP7.2 and uses MySQL 5.7 as the database. 

Create Users table: <br>
`CREATE TABLE 'password_manager'.'users' (`<br>
`  'id' INT NOT NULL AUTO_INCREMENT,`<br>
`   'username' VARCHAR(45) NULL,`<br>
`   'first_name' VARCHAR(20) NULL,`<br>
`   'last_name' VARCHAR(20) NULL,`<br>
`   'password' VARCHAR(64) NULL,`<br>
`   'salt' VARCHAR(45) NULL,`<br>
`   'created_at' DATETIME NULL,`<br>
`  PRIMARY KEY ('id'));`<br>
   
Create the Users Sessions table: <br>
`CREATE TABLE 'password_manager'.'users_session' (`<br>
`   'id' INT(11) NOT NULL AUTO_INCREMENT,`<br>
`   'user_id' INT(11) NULL,`<br>
`   'hash' VARCHAR(64) NULL,`<br>
`   PRIMARY KEY ('id'));`