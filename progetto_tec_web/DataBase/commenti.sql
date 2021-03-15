CREATE TABLE commenti(
	id int AUTO_INCREMENT NOT NULL,
	articolo int NOT NULL,
	username varchar(80) NOT NULL,
	commento varchar(2000) NOT NULL,
	mipiace int NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(articolo)
		REFERENCES news(id)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)ENGINE='InnoDB'