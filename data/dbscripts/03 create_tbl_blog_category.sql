CREATE TABLE blog__category
(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	parent_category_id INT,
	title VARCHAR(100) NOT NULL,
	description LONGTEXT,
	INDEX parent (parent_category_id),
	FOREIGN KEY (parent_category_id)
		REFERENCES blog__category(id)
		ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=INNODB;

INSERT INTO blog__category ( id, parent_category_id, title, description)
	VALUES( 1, NULL, "Main category", "The main category." );
INSERT INTO blog__category (id, parent_category_id, title, description)
	VALUES( 2, 1, "Sub category", "Main's only subcategory." );
INSERT INTO blog__category (id, parent_category_id, title, description)
	VALUES( 3, NULL, "Another category", "Another root category." );
