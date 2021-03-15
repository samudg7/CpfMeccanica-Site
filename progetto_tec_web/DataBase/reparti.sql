CREATE TABLE reparti(
	id int AUTO_INCREMENT NOT NULL,
	nome varchar(100) NOT NULL,
	descrizione varchar(100000) NOT NULL,
	immagine longblob,
	PRIMARY KEY(id)
)ENGINE='InnoDB'