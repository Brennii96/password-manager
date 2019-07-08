# Password Manager

This project is written in PHP 7.2 and uses MySQL 5.7 as the database. 

If the website your adding a password for has hotlink protection you won't be able to get an icon.<br>

For security you must first generate your encryption keys and add them to core/init.php.

Create The First Key <br>
`echo base64_encode(openssl_random_pseudo_bytes(32));`

Create The Second Key<br>
`echo base64_encode(openssl_random_pseudo_bytes(64));`

Create Users table: <br>
`CREATE TABLE 'password_manager'.'users' (`<br>
`  'id' INT NOT NULL AUTO_INCREMENT,`<br>
`   'username' VARCHAR(45) NULL,`<br>
`   'first_name' VARCHAR(20) NULL,`<br>
`   'last_name' VARCHAR(20) NULL,`<br>
`   'password' VARCHAR(64) NULL,`<br>
`   'salt' VARCHAR(45) NULL,`<br>
`   'group' INT(11) NULL,` <br>
`   'created_at' DATETIME NULL,`<br>
`  PRIMARY KEY ('id'));`<br>
   
Create the Users Sessions table: <br>
`CREATE TABLE 'password_manager'.'users_session' (`<br>
`   'id' INT(11) NOT NULL AUTO_INCREMENT,`<br>
`   'user_id' INT(11) NULL,`<br>
`   'hash' VARCHAR(64) NULL,`<br>
`   PRIMARY KEY ('id'));`

Create the permissions table: <br>
`CREATE TABLE 'password_manager'.'user_permissions' (`<br>
`   'id' INT NOT NULL AUTO_INCREMENT,`<br>
`   'name' VARCHAR(45) NULL,`<br>
`   'permissions' JSON NULL,` <br>
`   'PRIMARY KEY ('id'));`

Create the password management table:<br>
`CREATE TABLE 'password_manager'.'password_management' (`<br>
`  'id' INT NOT NULL AUTO_INCREMENT,`<br>
`  'user_id' INT(11) NOT NULL,`<br>
`  'title' VARCHAR(45) NOT NULL,`<br>
`  'username' VARCHAR(100) NOT NULL,`<br>
`  'icon' VARCHAR(100) NOT NULL,`<br>
`  'password' VARCHAR(128) NOT NULL,`<br>
`  'url' VARCHAR(100) NOT NULL,`<br>
`  'created_at' VARCHAR(45) NOT NULL,`<br>
`  PRIMARY KEY ('id'));`