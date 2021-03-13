CREATE TABLE IF NOT EXISTS posts(
  id int NOT NULL AUTO_INCREMENT,
  title VARCHAR(50),
  author VARCHAR(30),
  body text,
  date VARCHAR(20),
  PRIMARY KEY (id)
);
