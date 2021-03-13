CREATE TABLE IF NOT EXISTS users(
  id int NOT NULL AUTO_INCREMENT,
  username VARCHAR(30),
  password VARCHAR(50),
  email VARCHAR(30),
  firstname VARCHAR(30),
  lastname VARCHAR(30),
  PRIMARY KEY (id)
);
