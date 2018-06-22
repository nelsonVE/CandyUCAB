INSERT INTO rol (tipo) VALUES
('usuario'),
('empleado'),
('jefe de pasillo'),
('gerente'),
('encargado de compras'),
('supervisor'),
('encargado'),
('jefe'),
('administrador'),
('desarrollador');

INSERT INTO permiso (desc_per) VALUES
('Usuario común en el sistema'),
('Funcionalidades básicas de un empleado'),
('Administración de inventario'),
('Generación de ofertas'),
('Aprobar órdenes de compra'),
('Administrar empleados de una tienda'),
('Administrar gerentes y empleados de una tienda'),
('Administrar el personal de todas las tiendas'),
('Acceso a la información de la web'),
('Acceso a información de la BD');

INSERT INTO rol_per (fk_per, fk_rol) VALUES
(1,(SELECT id_rol FROM rol WHERE tipo LIKE '%usuario%')),

(1,(SELECT id_rol FROM rol WHERE tipo LIKE '%empleado%')),
(2,(SELECT id_rol FROM rol WHERE tipo LIKE '%empleado%')),

(1,(SELECT id_rol FROM rol WHERE tipo LIKE '%pasillo%')),
(2,(SELECT id_rol FROM rol WHERE tipo LIKE '%pasillo%')),
(3,(SELECT id_rol FROM rol WHERE tipo LIKE '%pasillo%')),

(1,(SELECT id_rol FROM rol WHERE tipo LIKE '%gerente%')),
(2,(SELECT id_rol FROM rol WHERE tipo LIKE '%gerente%')),
(3,(SELECT id_rol FROM rol WHERE tipo LIKE '%gerente%')),
(4,(SELECT id_rol FROM rol WHERE tipo LIKE '%gerente%')),

(1,(SELECT id_rol FROM rol WHERE tipo LIKE '%compras%')),
(2,(SELECT id_rol FROM rol WHERE tipo LIKE '%compras%')),
(3,(SELECT id_rol FROM rol WHERE tipo LIKE '%compras%')),
(4,(SELECT id_rol FROM rol WHERE tipo LIKE '%compras%')),

(1,(SELECT id_rol FROM rol WHERE tipo LIKE '%supervisor%')),
(2,(SELECT id_rol FROM rol WHERE tipo LIKE '%supervisor%')),
(3,(SELECT id_rol FROM rol WHERE tipo LIKE '%supervisor%')),
(4,(SELECT id_rol FROM rol WHERE tipo LIKE '%supervisor%')),
(5,(SELECT id_rol FROM rol WHERE tipo LIKE '%supervisor%')),
(6,(SELECT id_rol FROM rol WHERE tipo LIKE '%supervisor%')),

(1,(SELECT id_rol FROM rol WHERE tipo = 'encargado')),
(2,(SELECT id_rol FROM rol WHERE tipo = 'encargado')),
(3,(SELECT id_rol FROM rol WHERE tipo = 'encargado')),
(4,(SELECT id_rol FROM rol WHERE tipo = 'encargado')),
(5,(SELECT id_rol FROM rol WHERE tipo = 'encargado')),
(6,(SELECT id_rol FROM rol WHERE tipo = 'encargado')),
(7,(SELECT id_rol FROM rol WHERE tipo = 'encargado')),

(1,(SELECT id_rol FROM rol WHERE tipo = 'jefe')),
(2,(SELECT id_rol FROM rol WHERE tipo = 'jefe')),
(3,(SELECT id_rol FROM rol WHERE tipo = 'jefe')),
(5,(SELECT id_rol FROM rol WHERE tipo = 'jefe')),
(8,(SELECT id_rol FROM rol WHERE tipo = 'jefe')),

(1,(SELECT id_rol FROM rol WHERE tipo LIKE '%administrador%')),
(2,(SELECT id_rol FROM rol WHERE tipo LIKE '%administrador%')),
(3,(SELECT id_rol FROM rol WHERE tipo LIKE '%administrador%')),
(5,(SELECT id_rol FROM rol WHERE tipo LIKE '%administrador%')),
(8,(SELECT id_rol FROM rol WHERE tipo LIKE '%administrador%')),
(9,(SELECT id_rol FROM rol WHERE tipo LIKE '%administrador%')),

(1,(SELECT id_rol FROM rol WHERE tipo LIKE '%desarrollador%')),
(2,(SELECT id_rol FROM rol WHERE tipo LIKE '%desarrollador%')),
(3,(SELECT id_rol FROM rol WHERE tipo LIKE '%desarrollador%')),
(5,(SELECT id_rol FROM rol WHERE tipo LIKE '%desarrollador%')),
(8,(SELECT id_rol FROM rol WHERE tipo LIKE '%desarrollador%')),
(9,(SELECT id_rol FROM rol WHERE tipo LIKE '%desarrollador%')),
(10,(SELECT id_rol FROM rol WHERE tipo LIKE '%desarrollador%'));
