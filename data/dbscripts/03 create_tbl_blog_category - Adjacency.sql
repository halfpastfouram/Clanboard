CREATE TABLE blog__category
(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	parent_category_id INT,
	left_position INT NOT NULL,
	right_position INT NOT NULL,
	title VARCHAR(100) NOT NULL,
	description LONGTEXT,
	INDEX parent (parent_category_id),
	FOREIGN KEY (parent_category_id)
		REFERENCES blog__category(id)
		ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=INNODB;

INSERT INTO blog__category ( id, parent_category_id, left_position, right_position, title, description)
	VALUES( 1, NULL, 1, 6, "Main category", "The main category." ),
	( 2, 1, 2, 3, "Sub category", "Main's subcategory 1." ),
	( 3, 1, 4, 5, "Another category", "Main's subcategory 2" ),
	( 4, NULL, 7, 14, "Another category", "Another root category." ),
	( 5, 4, 8, 9, "Another category 1", "Another category's subcategory 1." ),
	( 6, 4, 10, 11, "Another category 2", "Another category's subcategory 2." ),
	( 7, 4, 12, 13, "Another category 3", "Another category's subcategory 3." );
