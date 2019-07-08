# Password Manager

This project is written in PHP 7.2 and uses MySQL 5.7 as the database. 

Few things need improvement, password generator doesn't insert into database properly. Copy to clipboard. CSRF needs enabling.

If the website your adding a password for has hotlink protection you won't be able to get an icon.<br>

For security you must first generate your encryption keys and add them to core/init.php.

Clone the github repo into your public_html folder or wherever your web root is and extract the zip. 
Go to `core/init.php` and set your database credentials. Follow the steps below to create your encryption keys to add to the keys array. These will be used for encrypting and decrypting passwords.

Create The First Key <br>
`echo base64_encode(openssl_random_pseudo_bytes(32));`

Create The Second Key<br>
`echo base64_encode(openssl_random_pseudo_bytes(64));`

Run the following table

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

Create the password management table:<br>
`CREATE TABLE 'password_manager'.'password_management' (`<br>
`  'id' INT NOT NULL AUTO_INCREMENT,`<br>
`  'user_id' VARCHAR(11) NOT NULL,`<br>
`  'title' VARCHAR(45) NOT NULL,`<br>
`  'username' VARCHAR(100) NOT NULL,`<br>
`  'icon' VARCHAR(500) NULL,`<br>
`  'password' VARCHAR(128) NOT NULL,`<br>
`  'url' VARCHAR(100) NOT NULL,`<br>
`  'created_at' VARCHAR(45) NOT NULL,`<br>
`  PRIMARY KEY ('id'));`