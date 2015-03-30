CREATE TABLE album (
	albumId     INT(11)      NOT NULL AUTO_INCREMENT,
	artist VARCHAR(100) NOT NULL,
	title  VARCHAR(100) NOT NULL,
	PRIMARY KEY (albumId)
);
INSERT INTO album (artist, title)
VALUES ('The  Military  Wives', 'In  My  Dreams');
INSERT INTO album (artist, title)
VALUES ('Adele', '21');
INSERT INTO album (artist, title)
VALUES ('Bruce  Springsteen', 'Wrecking Ball (Deluxe)');
INSERT INTO album (artist, title)
VALUES ('Lana  Del  Rey', 'Born  To  Die');
INSERT INTO album (artist, title)
VALUES ('Gotye', 'Making  Mirrors');