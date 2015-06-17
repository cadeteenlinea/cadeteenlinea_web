select count(*) from apoderado;
select count(*) from cadete;
select count(*) from usuario;
DELETE FROM apoderado WHERE rut not in (11111111, 22222222, 17558919, 5108249);
DELETE FROM cadete WHERE rut not in (11111111, 22222222, 17558919, 5108249);
DELETE FROM usuario WHERE rut not in (11111111, 22222222, 17558919, 5108249);