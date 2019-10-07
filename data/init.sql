CREATE DATABASE test1;
	use test1;
CREATE TABLE user (
  EmailID VARCHAR(45) NOT NULL,
  Location VARCHAR(45) NULL,
  Name VARCHAR(45) NULL,
  Status VARCHAR(45) NOT NULL DEFAULT "Pas-Répondu",
  Password VARCHAR(45) NOT NULL DEFAULT 12345678,
  LastLogin DATETIME NOT NULL DEFAULT 0,
  PRIMARY KEY ( EmailID )
  );
  
CREATE TABLE pdf  (
	PDFID  INT NOT NULL AUTO_INCREMENT,
	EmailID VARCHAR(45) NULL,
	PDFName VARCHAR(45) NULL,
  PRIMARY KEY ( PDFID )
  );
	
CREATE TABLE admincredential (
	Username VARCHAR(45) NOT NULL,
	Password VARCHAR(45) NULL,
	PRIMARY KEY ( Username )
	);