CREATE TABLE blog__post (
	id int(11) NOT NULL auto_increment,
	category_id int(11),
	title varchar(100) NOT NULL,
	text LONGTEXT NOT NULL,
	PRIMARY KEY (id),
	INDEX category (category_id),
	FOREIGN KEY (category_id)
		REFERENCES blog__category(id)
		ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=INNODB;

INSERT INTO blog__post (category_id, title, text)
VALUES  (1, 'Blog #1',  'Welcome to my first blog post');
INSERT INTO blog__post (category_id, title, text)
VALUES  (2, 'Blog #2',  'Welcome to my second blog post');
INSERT INTO blog__post (category_id, title, text)
VALUES  (3, 'Blog #3',  'Welcome to my third blog post');
INSERT INTO blog__post (category_id, title, text)
VALUES  (3, 'Blog #4',  'Welcome to my fourth blog post');
INSERT INTO blog__post (category_id, title, text)
VALUES  (2, 'Blog #5',  'Welcome to my fifth blog post');