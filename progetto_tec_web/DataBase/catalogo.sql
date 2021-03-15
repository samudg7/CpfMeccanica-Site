CREATE TABLE catalogo(
	id int AUTO_INCREMENT NOT NULL,
	nome varchar(100) NOT NULL,
	materiale varchar(100) NOT NULL,
	peso float NOT NULL,
	prezzo float NOT NULL,
	descrizione varchar(1000) NOT NULL,
	immagine longblob,
	PRIMARY KEY(id)
)ENGINE='InnoDB'