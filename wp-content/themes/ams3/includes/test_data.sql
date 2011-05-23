DROP TABLE IF EXISTS users;
CREATE TABLE users (
  user_id int(10) unsigned NOT NULL auto_increment,
  user_name varchar(50) NOT NULL default 'No Name',
  email varchar(50) NOT NULL default 'No Email',
  date_added datetime default NULL,
  age int(24) NOT NULL default '0',
  random_text text NULL,
  PRIMARY KEY  (user_id)
);
INSERT INTO users VALUES (0, 'John Doe','john@doe.com','2002-05-23 04:01:03',32,'Hello World!');