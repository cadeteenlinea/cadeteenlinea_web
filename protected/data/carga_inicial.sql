CREATE TABLE perfil (
  idperfil INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  codigo VARCHAR(3) NOT NULL,
  nombre VARCHAR(15) NOT NULL,
  descripcion TEXT NOT NULL,
  PRIMARY KEY(idperfil)
);

CREATE TABLE usuario (
  rut INTEGER UNSIGNED NOT NULL,
  perfil_idperfil INTEGER UNSIGNED NOT NULL,
  password_2 VARCHAR(250) NOT NULL,
  last_login DATETIME NULL,
  PRIMARY KEY(rut),
  INDEX usuario_FKIndex1(perfil_idperfil)
);



CREATE TABLE apoderado (
  rut INTEGER UNSIGNED NOT NULL,
  nombres VARCHAR(75) NOT NULL,
  apellidoPat VARCHAR(25) NOT NULL,
  apellidoMat VARCHAR(25) NOT NULL,
  PRIMARY KEY(rut)
);

CREATE TABLE cadete (
  rut INTEGER UNSIGNED NOT NULL,
  nombres VARCHAR(75) NOT NULL,
  apellidoPat VARCHAR(25) NOT NULL,
  apellidoMat VARCHAR(25) NOT NULL,
  curso INTEGER UNSIGNED NOT NULL,
  nCadete INTEGER UNSIGNED NOT NULL,
  PRIMARY KEY(rut)
);


CREATE TABLE cadete_apoderado (
  idcadete_apoderado INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  cadete_rut INTEGER UNSIGNED NOT NULL,
  apoderado_rut INTEGER UNSIGNED NOT NULL,
  PRIMARY KEY(idcadete_apoderado),
  INDEX cadete_apoderado_FKIndex1(apoderado_rut),
  INDEX cadete_apoderado_FKIndex2(cadete_rut)
);



/*insert table perfil*/
INSERT INTO perfil (codigo, nombre, descripcion) VALUES ('AD', 'Administrador', 'Administrador de todo el sistema, acceso completo a los cadetes y usuarios');
INSERT INTO perfil (codigo, nombre, descripcion) VALUES ('CA', 'Cadete', '');
INSERT INTO perfil (codigo, nombre, descripcion) VALUES ('PA', 'Padre', '');