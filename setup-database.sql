CREATE TABLE book (
  bookID varchar(10),
  title varchar(50) NOT NULL,
  author varchar(50) NOT NULL,
  stock smallint NOT NULL,
  PRIMARY KEY (bookID)
);

INSERT INTO book VALUES ('000', 'To Kill A Mockingbird', 'Harper Lee', 1);
INSERT INTO book VALUES ('001', 'The Name of the Wind', 'Patrick Rothfuss', 0);
INSERT INTO book VALUES ('002', 'The Hunger Games', 'Suzanne Collins', 3);

CREATE TABLE administrator (
  adminID varchar(10),
  a_username varchar(50) NOT NULL,
  a_userPWD varchar(50) NOT NULL,
  PRIMARY KEY (adminID)
);

INSERT INTO administrator VALUES ('000', 'admin123', 'Gue55Aga1n!');
INSERT INTO administrator VALUES ('001', 'admin321', 'N0tAdm1n!');

CREATE TABLE customer (
  customerID varchar(10),
  c_username varchar(50) NOT NULL,
  c_userPWD varchar(50) NOT NULL,
  fName varchar(50) NOT NULL,
  lname varchar(50) NOT NULL,
  stAdress varchar(50) NOT NULL,
  phNumber varchar(50) NOT NULL,
  PRIMARY KEY (customerID)
);

INSERT INTO customer VALUES ('000', 'Yashmellow99','Password123', 'Yashree', 'Sharma', 'somewhere', '224');
INSERT INTO customer VALUES ('001', 'Nicy_Spicy','Adm1nOne!', 'Enrico', 'Condino', 'over the rainbow', '123');

CREATE TABLE customerBooks (
  customerID varchar(10) references customer(customerID),
  bookID varchar(10) references book(bookID),
  constraint pk_customerBooks PRIMARY KEY (customerID, bookID)
);

INSERT INTO customerBooks(customerID, bookID)
SELECT "000", bookID FROM book WHERE bookID = "000";

INSERT INTO customerBooks(customerID, bookID)
SELECT "000", bookID FROM book WHERE bookID = "001";

INSERT INTO customerBooks(customerID, bookID)
SELECT "001", bookID FROM book WHERE bookID = "002";