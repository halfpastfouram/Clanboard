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
VALUES( 1, NULL, "Main category", "The main category." ),
	( 2, 1, "Sub category", "Main's subcategory 1." ),
	( 3, 1, "Another category", "Main's subcategory 2" ),
	( 4, NULL, "Another category", "Another root category." ),
	( 5, 4, "Another category 1", "Another category's subcategory 1." ),
	( 6, 4, "Another category 2", "Another category's subcategory 2." ),
	( 7, 4, "Another category 3", "Another category's subcategory 3." );

CREATE TABLE blog__category_closure
(
	ancestor INT NOT NULL,
	descendant INT NOT NULL,
	depth INT NOT NULL,
	PRIMARY KEY (ancestor, descendant),
	FOREIGN KEY (ancestor) REFERENCES blog__category(id),
	FOREIGN KEY (descendant) REFERENCES blog__category(id)
) ENGINE=INNODB;

INSERT INTO blog__category_closure (ancestor, descendant, depth)
VALUES
	( 1, 1, 0 ),
	( 1, 2, 1 ),
	( 1, 3, 1 ),
	( 2, 2, 0 ),
	( 3, 3, 0 ),
	( 4,4, 0 ),
	( 4, 5, 1 ),
	( 4, 6, 1 ),
	( 4, 7, 1 );