DROP TABLE IF EXISTS ARTICULOS;
DROP TABLE IF EXISTS CATEGORIAS;

CREATE TABLE CATEGORIAS
	(
	cat_id INTEGER  AUTO_INCREMENT ,
	cat_nombre VARCHAR(50)  NOT NULL ,
	PRIMARY KEY(cat_id)  
	);

	CREATE TABLE ARTICULOS
	(
	art_id INTEGER AUTO_INCREMENT ,
	art_nombre VARCHAR(50)  NOT NULL ,
    art_categoria INTEGER NOT NULL,
    art_cantidad INTEGER  NOT NULL ,
	PRIMARY KEY(art_id),
    CONSTRAINT FK_categoria FOREIGN KEY (art_categoria)
    REFERENCES CATEGORIAS(cat_id)
	);

INSERT INTO CATEGORIAS ( cat_nombre) VALUES ( "ALIMENTACION");
INSERT INTO CATEGORIAS ( cat_nombre) VALUES ( "INFORMATICA");
INSERT INTO CATEGORIAS ( cat_nombre) VALUES ( "ROPA");
INSERT INTO CATEGORIAS ( cat_nombre) VALUES ( "PARAFARMACIA");
INSERT INTO CATEGORIAS ( cat_nombre) VALUES ( "BRICOLAJE");
	
INSERT INTO ARTICULOS (art_nombre, art_categoria, art_cantidad) VALUES ( 'Camiseta azul', 3, 7);
INSERT INTO ARTICULOS (art_nombre, art_categoria, art_cantidad) VALUES ( 'Teclado mecánico', 2, 20);
INSERT INTO ARTICULOS (art_nombre, art_categoria, art_cantidad) VALUES ( 'Caja de herramientas', 5, 10);
INSERT INTO ARTICULOS (art_nombre, art_categoria, art_cantidad) VALUES ( 'Vaqueros', 3, 12);
INSERT INTO ARTICULOS (art_nombre, art_categoria, art_cantidad) VALUES ( 'Gasas estériles', 4, 22);

